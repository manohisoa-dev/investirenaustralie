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
use App\Notifications\MemberDownloadEoiMessage;
use App\Notifications\AfaMessage;
use App\Notifications\SellerSendMessage;
use App\Notifications\SollicitorMessage;
use App\Notifications\AdminMessage;

use App\Notifications\MemberMessage;

use Illuminate\Support\Facades\Storage;
use App\Mail\MailTemplate;
use App\Models\MailsTemplate;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;
use Mail;
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
        $idDossTrans = $datas['id_doss_trans'];
        $dossTrans = DossierTransaction::whereId($idDossTrans)->first();
        $prod_id = $dossTrans->product_id;
        $member_id = $dossTrans->user_id;
        
        // Handle file Upload
        $file = $request->file('file_ca');
        $path = public_path('uploads/pdf/ca');
        
        // store file in public folder
        $filenameWithExt = $file->getClientOriginalName();
        //Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $file->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $filename.'_finalized.'.$extension;
        // Upload Image
        $path = $file->move($path, $fileNameToStore);

        $user = User::whereId($member_id)->first();

        // Create Mandat de recherche form6 pdf
        $mdRch = $this->createForm6Pdf($prod_id,$user);
        $mdRchId = $mdRch->id;

        // Update mandat de recherche dossier transaction*
        DossierTransaction::whereId($idDossTrans)->update(['mr_id'=>$mdRchId]);

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
        $mdRecherche = MandatRecherche::whereId($mdRchId)->first();
        $uploadMrLink= url('uploads/pdf/mr').$mdRecherche->file_name;
        $template = MailsTemplate::where('id', 28)->get();
        $lang = $user->language;
        $body = 'template_' . $lang;
        $sujet_tpl = 'sujet_'.$lang;
        $uploadLink='<a href="'.$uploadMrLink.'">'.strtoupper(trans('app.txt.return_finalized_mandate_form')).'</a>';
        $abortLink = trans('member.btn.abort', ['link'=>'#']);
        $lia = Config::lia();
        $lia_name = $lia->get_meta('lia_name')->value;
        $vars = array(
            '{date}' => Carbon::now()->toFormattedDateString(),
            '{heure}' => Carbon::now()->toTimeString(),
            '{etat}' => $product->location->area_level_1,
            '{name}' => $user->isPerson()?$user->name:$user->userinfos->orga_name,
            '{afa}' => $user->afa->name,
            '{mandatofficielname}' => $lia_name, //Nom Officiel Mandat Agence Immobilière
            '{uploadLink}' => $uploadLink,
            '{abortLink}' => $abortLink
        );
        $sujet = $template[0]->$sujet_tpl;
        $contenu = strtr($template[0]->$body, $vars);
        $content = ['title' => '', 'body' => $contenu];

        $user->notify(new MemberMandateSearchMessage($sujet,$content));
        
        //Update status dossier transation
        DossierTransaction::whereId($idDossTrans)->update(['status'=>3, 'date_send_mr'=>Carbon::now()]);
        
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
        
        // Get dossier transaction
        $idDossTrans = $datas['id_doss_trans'];
        $dossTrans = DossierTransaction::whereId($idDossTrans)->first();
        $mdRecherche = MandatRecherche::whereId($dossTrans->mr_id)->first();
        $filenameMr = $mdRecherche->file_name;
        $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filenameMr);

        $product = Product::whereId($dossTrans->product_id)->first();
        $user = User::whereId($dossTrans->user_id)->first();

        // Handle file Upload to uploads/pdf/transaction path
        $file = $request->file('file_ca');
        $path = public_path('uploads/pdf/transaction');
        // store file in public folder
        $filenameWithExt = $file->getClientOriginalName();
        //Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $file->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $withoutExt.'_finalized.'.$extension;
        
        // Upload Image
        $path = $file->move($path, $fileNameToStore);
        $messageContent = "";

        if(Auth::user()->isMove()){
            $downloadMrLink= url('uploads/pdf/transaction/').$fileNameToStore;
            $template = MailsTemplate::where('id', 29)->get();
            $lang = 'en';
            $body = 'template_' . $lang;
            $sujet_tpl = 'sujet_'.$lang;
            $mrLink='<a href="'.$downloadMrLink.'">'.strtoupper(trans('app.txt.mandate_to_search_for_propreties')).'</a>';
            $vars = array(
                '{date}' => Carbon::now()->toFormattedDateString(),
                '{heure}' => Carbon::now()->toTimeString(),
                '{city}' => $product->location->locality,
                '{name}' => $user->isPerson()?$user->name:$user->userinfos->orga_name,
                '{immat}' => $user->immat,
                '{afa}' => $user->afa->name,
                '{mrLink}' => $mrLink,
            );
            $sujet = $template[0]->$sujet_tpl;
            $contenu = strtr($template[0]->$body, $vars);
            $content = ['title' => '', 'body' => $contenu];
            $messageContent = $contenu;
            // Message from IEA to AFA if Member moving
            // send email
            $user->afa->notify(new AfaMandateSearchMessage($sujet,$content));
            
            //Update status dossier transation
            DossierTransaction::whereId($idDossTrans)->update(['status'=>4, 'date_mr_finalize'=>Carbon::now(),'mr_finalize_file_name'=>$fileNameToStore]);

        }else{

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
        Message::create(['type'=>'admin','from_id'=>1,'to_id'=>$user->afa->id,'body'=>$messageContent]);
        
        
        return response()->json(['response'=>'true']);
    }

    public function updateDossierTrans(Request $request){
        $id_doss_trans = $request->id_doss_trans;
        $status = $request->status;

        return DossierTransaction::whereId($id_doss_trans)->update(['status'=>$status]);
    }

    /*
    * Store eoi for afa in transaction folders storage file
    *
    * @param  Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function uploadMemberDossierEoi(Request $request)
    {    
        $datas = $request->all();
        App::setLocale('en');
        
        // validation form
        $validator = Validator::make($datas, ['file_ca' => 'required|mimes:pdf']);
        
        $dossTransId = $request->id_doss_trans;
        $dossTrans = DossierTransaction::whereId($dossTransId)->first();
        $product = Product::whereId($dossTrans->product_id)->first();
        $filenameEoi = $product->productEoi->first()->image->first()->filename;
        $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filenameEoi);
        $dossNum = $dossTrans->numero;

        // Validate file
        if ($validator->fails()) {
            return response()->json(['response'=>'false']);
        }

        // Handle file Upload to uploads/pdf/transaction path
        $file = $request->file('file_ca');
        $path = public_path('uploads/pdf/transaction');
        // store file in public folder
        $filenameWithExt = $file->getClientOriginalName();
        //Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $file->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $withoutExt.'_'.$dossNum.'_finalized.'.$extension;
        
        // Upload Image
        $path = $file->move($path, $fileNameToStore);

        // Update dossier transaction status
        // Id sollicitor à définir
        DossierTransaction::whereId($dossTransId)->update(['eoi_finalize_file_name'=>$fileNameToStore,'date_eoi_finalize'=>Carbon::now(),'status'=>10,'sollicitor_id'=>0]);

        // Send Email to notify Sollicitor 
        // $template = MailsTemplate::where('id', 34)->get();
        // $lang = 'en';
        // $body = 'template_' . $lang;
        // $sujet_tpl = 'sujet_'.$lang;
        // $mrLink='<a href="'.$downloadMrLink.'">'.strtoupper(trans('app.txt.mandate_to_search_for_propreties')).'</a>';
        // $vars = array(
        //     '{date}' => Carbon::now()->toFormattedDateString(),
        //     '{heure}' => Carbon::now()->toTimeString(),
        //     '{name}' => $user->isPerson()?$user->name:$user->userinfos->orga_name,
        //     '{seller}' => $seller->name,
        //     '{sellerparentcompany}' => $seller->userinfos->orga_parent_name,
        //     '{title}' => $product->title,
        //     '{lottype}' => $dossTrans->lot_type,
        //     '{lotlevel}' => $dossTrans->lot_level,
        //     '{lotid}' => $dossTrans->lot_id,
        //     '{price}' => $dossTrans->final_sales_price,
        //     '{afa}' => $afa->name,
        //     '{abnafa}' => $afa->userinfos->orga_abn,
                // '{adrafa}' => $adrafa,
                // '{telafa}' => $afa->userinfos->orga_phone,
                // '{faxafa}' => $afa->userinfos->orga_fax,
                // '{emailafa}' => $afa->userinfos->orga_email,
                // '{state}' => $afa->location->area_level_1,
                // '{licenceafa}' => $afa->userinfos->orga_license_number,
        // );
        // $sujet = $template[0]->$sujet_tpl;
        // $contenu = strtr($template[0]->$body, $vars);
        // $content = ['title' => '', 'body' => $contenu];
        // send email
        // $user->notify(new SollicitorMessage($sujet,$content));

        // Send Email to notify Seller (propriétaire du produit)
        $seller = User::whereId($product->seller_id)->first();
        $member = User::whereId($dossTrans->user_id)->first();
        $afa = User::whereId($dossTrans->afa_id)->first();
        $template = MailsTemplate::where('id', 35)->get();
        $lang = 'en';
        $body = 'template_' . $lang;
        $sujet_tpl = 'sujet_'.$lang;
        $adrafa = $afa->location->route.', '.$afa->location->locality.' '.$afa->location->postalCode.' '.$afa->location->country;
        $pathLink = url('/uploads/pdf/transaction/').'/'.$dossTrans->eoi_finalize_file_name;
        $downloadeoiLink = setLinkDynamic($pathLink,strtoupper(trans('app.txt.eoi')));
        $vars = array(
            '{date}' => Carbon::now()->toFormattedDateString(),
            '{heure}' => Carbon::now()->toTimeString(),
            '{name}' => $member->isPerson()?$member->name:$member->userinfos->orga_name,
            '{title}' => $member->afa->name,
            '{lottype}' => $dossTrans->lot_type,
            '{lotlevel}' => $dossTrans->lot_level,
            '{lotid}' => $dossTrans->lot_id,
            '{price}' => $dossTrans->final_sales_price,
            '{afa}' => $afa->name,
            '{abnafa}' => $afa->userinfos->orga_abn,
            '{adrafa}' => $adrafa,
            '{telafa}' => $afa->userinfos->orga_phone,
            '{faxafa}' => $afa->userinfos->orga_fax,
            '{emailafa}' => $afa->userinfos->orga_email,
            '{state}' => $afa->location->area_level_1,
            '{licenceafa}' => $afa->userinfos->orga_license_number,
            '{downloadLink}' => $downloadeoiLink,
        );
        $sujet = $template[0]->$sujet_tpl;
        $contenu = strtr($template[0]->$body, $vars);
        $content = ['title' => '', 'body' => $contenu];
        // send email
        $seller->notify(new SellerSendMessage($sujet,$content));


        // Send Email to notify afa (propriétaire du produit)
        $seller = User::whereId($product->seller_id)->first();
        $template = MailsTemplate::where('id', 36)->get();
        $lang = 'en';
        $body = 'template_' . $lang;
        $sujet_tpl = 'sujet_'.$lang;
        $uploadeoiLink=setLinkDynamic(route('afa.transaction'),strtoupper(trans('app.txt.send_finalized_eoi')));
        $vars = array(
            '{date}' => Carbon::now()->toFormattedDateString(),
            '{heure}' => Carbon::now()->toTimeString(),
            '{name}' => $member->isPerson()?$member->name:$member->userinfos->orga_name,
            '{seller}' => $seller->name,
            '{sellerparentcompany}' => $seller->userinfos->orga_parent_name,
            '{title}' => $product->title,
            '{lottype}' => $dossTrans->lot_type,
            '{lotlevel}' => $dossTrans->lot_level,
            '{lotid}' => $dossTrans->lot_id,
            '{price}' => $dossTrans->final_sales_price,
            '{afa}' => $afa->name,
            '{uploadLink}' => $uploadeoiLink,
            '{downloadLink}' => $downloadeoiLink,
        );
        $sujet = $template[0]->$sujet_tpl;
        $contenu = strtr($template[0]->$body, $vars);
        $content = ['title' => '', 'body' => $contenu];
        // send email
        $afa->notify(new AfaMessage($sujet,$content));

        return response()->json(['response'=>'true']);
    }

    public function uploadMemberDossierEoiFinalized(Request $request)
    {    
        $datas = $request->all();
        
        // validation form
        $validator = Validator::make($datas, ['file_ca' => 'required|mimes:pdf']);
        
        $dossTransId = $request->id_doss_trans;
        $dossTrans = DossierTransaction::whereId($dossTransId)->first();
        $product = Product::whereId($dossTrans->product_id)->first();
        $filenameEoi = $product->productEoi->first()->image->first()->filename;
        $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $dossTrans->eoi_finalize_file_name);

        // Validate file
        if ($validator->fails()) {
            return response()->json(['response'=>'false']);
        }

        // Handle file Upload to uploads/pdf/transaction path
        $file = $request->file('file_ca');
        $path = public_path('uploads/pdf/transaction');
        // store file in public folder
        $filenameWithExt = $file->getClientOriginalName();
        //Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $file->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $withoutExt.'_afa.'.$extension;
        
        // Upload Image
        $path = $file->move($path, $fileNameToStore);

        // Update dossier transaction
        DossierTransaction::whereId($dossTransId)->update(['eoi_finalize_file_name_afa'=>$fileNameToStore,'date_eoi_finalize_afa'=>Carbon::now(),'status'=>11]);

        // Send Email to notify admin
        $admin= User::whereId(1)->first();
        $user = User::whereId($dossTrans->user_id)->first();
        $afa = User::whereId($dossTrans->afa_id)->first();
        $seller = User::whereId($product->seller_id)->first();
        $template = MailsTemplate::where('id', 37)->get();
        $lang = 'en';
        $body = 'template_' . $lang;
        $sujet_tpl = 'sujet_'.$lang;
        $pathLink = url('/uploads/pdf/transaction/').'/'.$dossTrans->eoi_finalize_file_name;
        $downloadeoiLink = setLinkDynamic($pathLink,strtoupper(trans('app.txt.eoi_finalized')));
        $vars = array(
            '{date}' => Carbon::now()->toFormattedDateString(),
            '{afa}' => $afa->name,
            '{name}' => $user->isPerson()?$user->name:$user->userinfos->orga_name,
            '{seller}' => $seller->name,
            '{sellerparentcompany}' => $seller->userinfos->orga_parent_name,
            '{title}' => $product->title,
            '{lottype}' => $dossTrans->lot_type,
            '{lotlevel}' => $dossTrans->lot_level,
            '{lotid}' => $dossTrans->lot_id,
            '{price}' => $dossTrans->final_sales_price,
            '{downloadLink}' => $downloadeoiLink,
        );
        $sujet = $template[0]->$sujet_tpl;
        $contenu = strtr($template[0]->$body, $vars);
        $content = ['title' => '', 'body' => $contenu];
        // send email
        $admin->notify(new AdminMessage($sujet,$content));
        
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
            $dossTrans = DossierTransaction::whereId($request->doss_id)->first();
            $member = User::whereId($dossTrans->user_id)->first();
            $user_name= $member->isPerson()?$member->name:$member->userinfos()->first()->orga_name;
            $afa = $member->afa->name;
            $product = Product::whereId($dossTrans->product_id)->first();
            $city = $product->location->locality;
            $etat = $product->location->area_level_1;
            $title = $product->title;
            $lotLevel = $request->lot_level;
            $lotType = $request->lot_type;
            $lotId = $request->lot_id;
            $finalSalesPrice = $request->final_sales_price;

            // udpate dossier transaction information with status
            DossierTransaction::where('id', $request->doss_id)->update(['lot_type'=>$lotType,'lot_level'=>$lotLevel,'lot_id'=>$lotId,'final_sales_price'=>$finalSalesPrice,'status'=>8]);
            
            // Send message and notif email to membre after transaction information sent
            // get template mail AFA
            $template = MailsTemplate::where('id', 32)->get();
            App::setLocale($member->language);
            $lang = $member->language;
            $body = 'template_' . $lang;
            $sujet_tpl = 'sujet_'.$lang;
            $confirmLink = setLinkDynamic(route('member.transaction'),strtoupper(trans('app.btn.confirm_purchase')));
            $vars = array(
                '{date}' => $dtDate,
                '{heure}' => $dtTime,
                '{name}' => $user_name,
                '{afa}' => $afa,
                '{city}' => $city,
                '{state}' => $etat,
                '{title}' => $title,
                '{lottype}' => $lotType,
                '{lotid}' => $lotId,
                '{lotlevel}' => $lotLevel,
                '{price}' => $finalSalesPrice,
                '{confirmLink}' => $confirmLink,
            );
            $sujet = $template[0]->$sujet_tpl;
            $contenu = strtr($template[0]->$body, $vars);
            $content = ['title' => '', 'body' => $contenu];
            
            // email
            $member->notify(new MemberMessage($sujet,$content));

            // message
            Message::create(['type'=>'admin','from_id'=>1,'to_id'=>$dossTrans->user_id,'body'=>$contenu]);

            return back()->with('success', trans('app.txt.dossier_transaction_information_complete', ['num'=>$dossTrans->numero]));
        }


        return back()->withErrors($validator)->withInput();
    }

    // update dossier transaction
    public function confirmDt(Request $request){
        $dtId = $request->doss_id;
        $user = Auth::user();

        // udpate dossier transaction status
        DossierTransaction::whereId($dtId)->update(['status'=>9]);

        // get template mail and send message and email to member for download eoi
        $dt = Carbon::now();
        $dtDate = $dt->format('m-d-Y');
        $dtTime = $dt->format('H:i:m');
        $dossTrans = DossierTransaction::whereId($dtId)->first();
        $member = User::whereId($dossTrans->user_id)->first();
        $product = Product::whereId($dossTrans->product_id)->first();
        $user_name= $member->isPerson()?$member->name:$member->userinfos()->first()->orga_name;
        $afa = $member->afa->name;
        $seller = $product->author->name;
        $city = $product->location->locality;
        $title = $product->title;
        $lotLevel = $dossTrans->lot_level;
        $lotType = $dossTrans->lot_type;
        $lotId = $dossTrans->lot_id;
        $finalSalesPrice = $dossTrans->final_sales_price;

        $template = MailsTemplate::where('id', 33)->get();
        App::setLocale($member->language);
        $lang = $member->language;
        $body = 'template_' . $lang;
        $sujet_tpl = 'sujet_'.$lang;

        $downloadeoiLink = $product->productEoi->first()?setLinkDynamic($product->productEoi->first()->image->first()->filepath,strtoupper(trans('app.txt.eoi'))):'';
        $uploadeoiLink = setLinkDynamic(route('member.transaction'),strtoupper(trans('app.txt.sent_eoi_finalized')));
        $vars = array(
            '{date}' => $dtDate,
            '{heure}' => $dtTime,
            '{name}' => $user_name,
            '{title}' => $title,
            '{afa}' => $afa,
            '{seller}' => $seller,
            '{city}' => $city,
            '{lottype}' => $lotType,
            '{lotlevel}' => $lotLevel,
            '{lotid}' => $lotId,
            '{price}' => $finalSalesPrice,
            '{downloadLink}' => $downloadeoiLink,
            '{uploadLink}' => $uploadeoiLink,
        );
        $sujet = $template[0]->$sujet_tpl;
        $contenu = strtr($template[0]->$body, $vars);
        $content = ['title' => '', 'body' => $contenu];
        
        // message
        Message::create(['type'=>'admin','from_id'=>1,'to_id'=>$member->id,'body'=>$contenu]);

        // email
        $user->notify(new MemberMessage($sujet,$content));
        
        return back()->with('success', trans('app.txt.purchase_confirmed'));
    }







    // update dossier transaction
    public function updateIsCompleteDt(Request $request){
        $isComplete = $request->is_complete;
        $dtId = $request->dt_id;
        $user = Auth::user();

        // udpate dossier transaction information
        DossierTransaction::where('id', $dtId)->update(['is_complete'=>$isComplete]);

        // send message and email to member for download eoi
        $dt = DossierTransaction::whereId($dtId)->first();
        $prod = Product::whereId($dt->product_id)->first();
        $seller = $prod->author->name;
        $downloadeoilink = url($prod->productEoi->first()->image->first()->filepath);
        $uploadeoilink = route('member.dossier');
        $content = trans('member.tobuy.eoi.message_to_member_for_download_eoi',['date'=>Carbon::now()->format('m-d-Y'),'hour'=>Carbon::now()->format('H:i:m'),'name'=>Auth::user()->isPerson()?Auth::user()->name:Auth::user()->userinfos()->first()->orga_name,'prodtitle'=>$prod->title,'lottype'=>$dt->lot_type,'lotlevel'=>$dt->lot_level,'lotid'=>$dt->lot_id,'price'=>$dt->final_sales_price,'seller'=>$seller,'afa'=>Auth::user()->afa->name,'downloadeoilink'=>$downloadeoilink,'uploadeoilink'=>$uploadeoilink]);
        // message
        Message::create(['type'=>'admin','from_id'=>1,'to_id'=>$user->id,'body'=>$content]);
        // // email
        $user->notify(new MemberDownloadEoiMessage($content));
        
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
        $path = public_path('uploads/pdf/form6/'.$pdfName);

        // Save form6 pdf in path
        PDF::loadView($pdf_template,['user'=>$user, 'iea'=>$iea, 'product'=>$product])->save($path);

        // Save Research Mandate
        return MandatRecherche::create(['file_name'=>$pdfName,'path'=>$path,'product_id'=>$prod_id,'from_id'=>1,'to_id'=>$user->id,'afa_id'=>$user->afa->id]);
    }

}
