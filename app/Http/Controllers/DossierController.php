<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RelationMembreApl;
use App\Models\Product;
use App\Models\ConjunctionAgreement;
use App\Models\MandatRecherche;
use App\Models\DossierTransaction;
use App\Models\Message;
use App\Models\Config;
use App\Notifications\AfaMandateSearchMessage;
use App\Notifications\AfaMandateSearchFinalisedMessage;
use App\Notifications\MemberMandateSearchFinalisedMessage;
use App\Notifications\MemberMandateSearchMessage;
use App\Notifications\MemberDossierTransactionCompleteMessage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;
use Validator;
use Auth;
use App;
use Session;
use PDF;


class DossierController extends Controller
{
    /**
     * Liste des dossiers
     *
     * @return \Illuminate\Http\Response
     */
    public function showMemberDossier() {
        $aplActive = User::find(Auth::user()->id);
        $allApl = RelationMembreApl::where('membre_id', Auth::user()->id)->get();
        return view('backend.dossier.member')->with('title', __('member.menu_relation_apl'))->with('aplActive',
            $aplActive)->with('allApl', $allApl);
    }

    /**
     * Liste des dossiers afa
     *
     * @return \Illuminate\Http\Response
     */
    public function showAfaDossier() {
        $records = ConjunctionAgreement::getAllFolders();
        $mandatesearch = MandatRecherche::getAllFolders();

        return view('backend.dossier.afa')->with('records',$records)->with('mandatesearch',$mandatesearch);
    }

    /*
    * Store ca for afa in storage file
    *
    * @param  Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function uploadAfaDossierCa(Request $request)
    {    
        $datas = $request->all();
        $validator = Validator::make($datas, ['file_ca' => 'required|mimes:pdf']);

        // Validate file
        if ($validator->fails()) {
            return response()->json(['response'=>'false']);
        }

        // Handle file Upload
        $file = $request->file('file_ca');
        $path = public_path('uploads/pdf/ca');
        $this->storeFile($file,$path);

        
        return response()->json(['response'=>'true']);
    }
    
    /*
    * Store mr for afa in storage file
    *
    * @param  Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function uploadMemberDossierMr(Request $request)
    {    
        $datas = $request->all();
        $validator = Validator::make($datas, ['file_mr' => 'required|mimes:pdf']);

        // Validate file
        if ($validator->fails()) {
            return response()->json(['response'=>'false']);
        }

        // Handle file Upload to uploads/pdf/transaction path
        $file = $request->file('file_mr');
        $path = public_path('uploads/pdf/transaction');
        $this->storeFile($file,$path);

        // Send message and email to afa from IEA
        App::setLocale('en'); //change lang to en
        $user=Auth::user();
        $dt = Carbon::now();
        $dtDate = $dt->format('m-d-Y');
        $dtTime = $dt->format('H:i:m');
        $user_name= $user->isPerson()?$user->name:$user->userinfos()->first()->orga_name;
        $mr_id=$request->mr_id;
        $mandatesearch= MandatRecherche::whereId($mr_id)->first();
        $mandatesearchLink= url($mandatesearch->path);
        $country = $userAuth->location->country;
        $city=$user->afa->location->locality;
        $linkcompletetrans = url('afa/dossier?action=complete_dossier_transaction_info&ID='.DossierTransaction::getDossierTransactionId($mandatesearch->product_id,$user->id));

        if(Auth::user()->isMove()){
            // Message from IEA to AFA if Member moving
            $content=trans('member.gothere.mr.message_to_afa', ['date'=>$dtDate,'hour'=>$dtTime,'name'=>$user_name,'immat'=>$user->immat,'city'=>$city,'afa' =>$user->afa->name,'mandatesearch'=>$mandatesearchLink]);
            // send email
            $user->afa->notify(new AfaMandateSearchMessage($user,$mandatesearchLink));
        }else{
            // Message from IEA to AFA if Member buy product not moving
            $content=trans('member.tobuy.mr.message_to_afa', ['date'=>$dtDate,'hour'=>$dtTime,'name'=>$user,'country'=>$country,'city'=>$city,'afa' =>$user->afa->name,'mandatesearch'=>$mandatesearchLink]);
            // send email to afa
            $user->afa->notify(new AfaMandateSearchFinalisedMessage($user,$linkcompletetrans,$mandatesearchLink));
            // send email to member
            App::setLocale($user->language);
            $user->notify(new MemberMandateSearchFinalisedMessage($user));
            // send message to member
            Message::create(['type'=>'admin','from_id'=>1,'to_id'=>$user->id,'body'=>$content]);
        }

        // send message to afa
        Message::create(['type'=>'admin','from_id'=>1,'to_id'=>$user->afa->id,'body'=>$content]);
        
        
        return response()->json(['response'=>'true']);
    }

    private function storeFile($file,$path){
        // Get filename with the extension
        $filenameWithExt = $file->getClientOriginalName();
        //Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $file->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $filename.'.'.$extension;
        // Upload Image
        $path = $file->move($path, $fileNameToStore);

        return false;
    }

    // update conjunction agreement
    public function updateCa(Request $request){
        ConjunctionAgreement::where('id', $request->id)->update(['status' => 1]);

        return response()->json(['success' => 'true']);
    }

    // update mandat research
    public function updateMr(Request $request){
        MandatRecherche::where('id', $request->id)->update(['status' => 1]);

        return response()->json(['success' => 'true']);
    }

    // update dossier transaction
    public function updateDt(Request $request){
        $datas = $request->all();
        $validator = Validator::make($datas, ['lot_type' => 'required','lot_level' => 'required','lot_id'=>'required','final_sales_price'=>'required']);

        // Validate file
        if (!$validator->fails()) {
            $dt = Carbon::now();
            $dtDate = $dt->format('m-d-Y');
            $dtTime = $dt->format('H:i:m');
            $member = User::whereId($request->doss_user_id)->first();
            $user_name= $member->isPerson()?$member->name:$member->userinfos()->first()->orga_name;
            $afa = $member->afa->name;
            $product = Product::whereId($request->prod_id)->first();
            $city = $product->location->locality;
            $etat = $product->location->area_level_1;
            $title = $product->title;
            $lotLevel = $request->lot_level;
            $lotType = $request->lot_type;
            $lotId = $request->lot_id;
            $finalSalesPrice = $request->final_sales_price;
            $confirmationlink = url('member/dossier?action=confirm_decision&ID='.$request->doss_id);

            // udpate dossier transaction information
            DossierTransaction::where('id', $request->doss_id)->update(['lot_type'=>$lotType,'lot_level'=>$lotLevel,'lot_id'=>$lotId,'final_sales_price'=>$finalSalesPrice,'is_complete'=>2]);
            
            // Send message and notif email to membre after transaction information sent
            $content = trans('member.tobuy.dt.message_to_member_after_info_complete', [
                'date'=>$dtDate,
                'hour'=>$dtTime,
                'name'=>$user_name,
                'afa'=>$afa,
                'city'=>$city,
                'etat'=>$etat,
                'title'=>$title,
                'lottype'=>$lotType,
                'lotid'=>$lotId,
                'lotlevel'=>$lotLevel,
                'price'=>$finalSalesPrice,
                'confirmationlink'=>$confirmationlink,
            ]);
            // message
            Message::create(['type'=>'admin','from_id'=>1,'to_id'=>$request->doss_user_id,'body'=>$content]);
            // email
            // $member->notify(new MemberDossierTransactionCompleteMessage($dtDate,$dtTime,$user_name,$afa,$city,$etat,$title,$lotType,$lotId,$lotLevel,$finalSalesPrice,$confirmationlink));
            $member->notify(new MemberDossierTransactionCompleteMessage($content));


            
            return redirect()->route('afa.dossier')->with('success', trans('app.txt.dossier_transaction_information_complete', ['num'=>$request->numero]));
        }


        return back()->withErrors($validator)->withInput();
    }

    // update dossier transaction
    public function updateIsCompleteDt(Request $request){
        $isComplete = $request->is_complete;
        $dtId = $request->dt_id;

        // udpate dossier transaction information
        DossierTransaction::where('id', $dtId)->update(['is_complete'=>$isComplete]);
            
        return response()->json(['success'=>'Success']);
    }

    // Declanche Mandat de Recherche
    public function ajaxSendMandatIeaToMember(Request $request){
        $prod_id = $request->get('id_product');
        $to_id = $request->get('to_id');
        $user = User::whereId($to_id)->first();

        // Create Mandat de recherche form6 pdf
        $mdRch = $this->createForm6Pdf($prod_id,$user);

        $dt = Carbon::now();
        $dtDate = $dt->format('m-d-Y');
        $dtTime = $dt->format('H:i:m');
        $downloadForm6Link = url($mdRch->path);
        $uploadForm6Link = route('member.dossier');
        $user_name= $user->isPerson()?$user->name:$user->userinfos()->first()->orga_name;
        $user_immat = $user->immat;
        $afa = $user->afa->name;
        $product = Product::whereId($prod_id)->first();
        $abort = trans('member.btn.abort', ['link'=>'#']);
        $content = trans('member.mr.message_to_member', ['date'=>$dtDate,'hour'=>$dtTime,'name'=>$user_name,'immat'=>$user_immat,'etat'=>$product->location->area_level_1,'afa'=>$afa,'download_mr'=>$downloadForm6Link,'upload_mr'=>$uploadForm6Link, 'abort'=>$abort]);
        session()->forget('id_product');

        // send chat message to Member from IEA (admin)
        Message::create(['type'=>'admin','from_id'=>1,'to_id'=>$user->id,'body'=>$content]);

        // send notification email to afa from IEA
        $user->notify(new MemberMandateSearchMessage($user,$product,$downloadForm6Link,$uploadForm6Link,$abort));


        return response()->json(['success'=>'Success']);
    }

    public function createForm6Pdf($prod_id,$user) {
        $pdf_template = 'pdf.form6';
        $lia = Config::lia();
        $lia_name = $lia->get_meta('lia_name')->value;
        $lia_abn = $lia->get_meta('lia_abn')->value;
        $lia_license = $lia->get_meta('lia_license')->value;
        $lia_license_expire_date = $lia->get_meta('lia_license_expire_date')->value;
        $lia_address = $lia->get_meta('lia_address')->value;
        $lia_mobile = $lia->get_meta('lia_mobile')->value;
        $lia_email = $lia->get_meta('lia_email')->value;
        $lia_dir = $lia->get_meta('lia_dir')->value;
        $lia_dir_license = $lia->get_meta('lia_dir_license')->value;
        $lia_dir_license_expire_date = $lia->get_meta('lia_dir_license_expire_date')->value;

        $iea = ['name'=>$lia_name, 'abn'=>$lia_abn, 'license'=>$lia_license, 'licence_expire_date'=>$lia_license_expire_date, 'address'=>$lia_address, 'mobile'=>$lia_mobile, 'email'=>$lia_email, 'director'=>$lia_dir, 'director_license'=>$lia_dir_license, 'directore_licence_expire_date'=>$lia_dir_license_expire_date];
        $product = Product::whereId($prod_id)->first();

        $pdfName = 'Form6_'.$product->location->area_level_1.'_'.$user->immat."_".time().".pdf";
        $path = 'uploads/pdf/form6/'.$pdfName;

        // Save form6 pdf in path
        PDF::loadView($pdf_template,['user'=>$user, 'iea'=>$iea, 'product'=>$product])->save($path);

        // Save Research Mandate
        return MandatRecherche::create(['file_name'=>$pdfName,'path'=>$path,'product_id'=>$prod_id,'from_id'=>1,'to_id'=>$user->id,'afa_id'=>$user->afa->id]);
    }

}
