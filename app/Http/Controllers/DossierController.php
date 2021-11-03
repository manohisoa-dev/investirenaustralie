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
use App\Models\Country;
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
        $user_name= $user->isPerson()?$user->userinfos->first_name.' '.$user->userinfos->last_name:$user->userinfos->orga_name;
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
        $uploadMrLink= route('member.transaction');
        $downloadMrLink= url('/pdf/form6/form6_').strtolower($user->afa->location->area_level_1).'.pdf';
        $template = MailsTemplate::where('id', 28)->get();
        $lang = $user->language;
        $body = 'template_' . $lang;
        $sujet_tpl = 'sujet_'.$lang;
        $downloadLink= setLinkDynamic($downloadMrLink,strtoupper(trans('app.txt.mandate_to_search_for_propreties')));
        $uploadLink= setLinkDynamic($uploadMrLink,strtoupper(trans('app.txt.return_finalized_mandate_form')));
        $abortLink = trans('member.btn.abort', ['link'=>'#']);
        $lia = Config::lia(); 
        $vars = array(
            '{date}' => Carbon::now()->toFormattedDateString(),
            '{heure}' => Carbon::now()->toTimeString(),
            '{etat}' => $product->location->area_level_1,
            '{name}' => $user->isPerson()?$user->userinfos->first_name.' '.$user->userinfos->last_name:$user->userinfos->orga_name,
            '{afa}' => $user->afa->name,
            '{mandatofficielname}' => $downloadLink,
            '{uploadLink}' => $uploadLink,
            '{abortLink}' => $abortLink
        );
        $sujet = $template[0]->$sujet_tpl;
        $contenu = strtr($template[0]->$body, $vars);
        $content = ['title' => '', 'body' => $contenu];

        Mail::to($user->email)->send(new MailTemplate($content, $sujet));
        
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
            App::setLocale($lang);
            $body = 'template_' . $lang;
            $sujet_tpl = 'sujet_'.$lang;
            $mrLink=setLinkDynamic($downloadMrLink,strtoupper(trans('app.txt.mandate_to_search_for_propreties')));
            $vars = array(
                '{date}' => Carbon::now()->toFormattedDateString(),
                '{heure}' => Carbon::now()->toTimeString(),
                '{city}' => $product->location->locality,
                '{name}' => $user->isPerson()?$user->userinfos->first_name.' '.$user->userinfos->last_name:$user->userinfos->orga_name,
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
            // $user->afa->notify(new AfaMandateSearchMessage($sujet,$content));
            Mail::to($user->afa->email)->send(new MailTemplate($content, $sujet));
            
            //Update status dossier transation
            DossierTransaction::whereId($idDossTrans)->update(['status'=>4, 'date_mr_finalize'=>Carbon::now(),'mr_finalize_file_name'=>$fileNameToStore]);

        }else{

            // Send message and email to afa from IEA
            App::setLocale('en'); //change lang to en
            $user=Auth::user();
            $dt = Carbon::now();
            $dtDate = $dt->format('m-d-Y');
            $dtTime = $dt->format('H:i:m');
            $user_name= $user->isPerson()?$user->userinfos->first_name.' '.$user->userinfos->last_name:$user->userinfos->orga_name;
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
        if($product->parent_id!=0 || $product->parent_id!=-1){
            $parent = Product::whereId($product->parent_id)->first();
            $filenameEoi=$parent->productEoi->first()->image->first()->filename;
        }else{
            $filenameEoi = $product->productEoi->first()->image->first()->filename;
        }
        $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filenameEoi);
        $dossNum = $dossTrans->numero;
        $sollicitorId = $product->solicitor_id;

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
        DossierTransaction::whereId($dossTransId)->update(['eoi_finalize_file_name'=>$fileNameToStore,'date_eoi_finalize'=>Carbon::now(),'status'=>10,'sollicitor_id'=>$sollicitorId]);

        // Send Email to notify Sollicitor 
        if($dossTrans->sollicitor_id != 0){
            $sollicitor = Solicitor::whereId($dossTrans->sollicitor_id)->first();
            $user = User::whereId($dossTrans->user_id)->first();
            $afa = User::whereId($dossTrans->afa_id)->first();
            $template = MailsTemplate::where('id', 34)->get();
            $lang = 'en';
            $body = 'template_' . $lang;
            $sujet_tpl = 'sujet_'.$lang;
            $vars = array(
                '{date}' => Carbon::now()->toFormattedDateString(),
                '{heure}' => Carbon::now()->toTimeString(),
                '{name}' => $user->isPerson()?$user->userinfos->first_name.' '.$user->userinfos->last_name:$user->userinfos->orga_name,
                '{seller}' => $seller->name,
                '{sellerparentcompany}' => $seller->userinfos->orga_parent_name,
                '{title}' => $product->title,
                '{lottype}' => $dossTrans->lot_type,
                '{lotlevel}' => $dossTrans->lot_level,
                '{lotid}' => $dossTrans->lot_id,
                '{price}' => $dossTrans->final_sales_price,
                '{sollicitor}' => $sollicitor->cabinet_name,
                '{afa}' => $afa->name,
                '{abnafa}' => $afa->userinfos->orga_abn,
                '{adrafa}' => $adrafa,
                '{telafa}' => $afa->userinfos->orga_phone,
                '{faxafa}' => $afa->userinfos->orga_fax,
                '{emailafa}' => $afa->userinfos->orga_email,
                '{state}' => $afa->location->area_level_1,
                '{licenceafa}' => $afa->userinfos->orga_license_number,
            );
            $sujet = $template[0]->$sujet_tpl;
            $contenu = strtr($template[0]->$body, $vars);
            $content = ['title' => '', 'body' => $contenu];

            // send email to solicitor
            Mail::to($sollicitor->cabinet_email)->send(new MailTemplate($content, $sujet));
        }

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
            '{seller}' => $seller->name,
            '{sellerparentcompany}' => $seller->userinfos?$seller->userinfos->orga_parent_name:'',
            '{name}' => $member->isPerson()?$member->userinfos->first_name.' '.$member->userinfos->last_name:$member->userinfos->orga_name,
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
        // $seller->notify(new SellerSendMessage($sujet,$content));
        Mail::to($seller->email)->send(new MailTemplate($content, $sujet));


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
            '{name}' =>$member->isPerson()?$member->userinfos->first_name.' '.$member->userinfos->last_name:$member->userinfos->orga_name,
            '{seller}' => $seller->name,
            '{sellerparentcompany}' => $seller->userinfos?$seller->userinfos->orga_parent_name:'',
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
        // $afa->notify(new AfaMessage($sujet,$content));
        Mail::to($afa->email)->send(new MailTemplate($content, $sujet));

        return response()->json(['response'=>'true']);
    }

    public function uploadMemberDossierEoiFinalized(Request $request)
    {    
        $datas = $request->all();
         
        $dossTransId = $request->id_doss_trans;
        $dossTrans = DossierTransaction::whereId($dossTransId)->first();
        $product = Product::whereId($dossTrans->product_id)->first();
        $filenameEoiFinalized = $dossTrans->eoi_finalize_file_name;

        // Handle file Upload to uploads/pdf/transaction path
        // $file = $request->file('file_ca');
        $path = public_path('uploads/pdf/transaction');
        $nomFile = $filenameEoiFinalized;
        $source = $path.'/'.$nomFile;
        // Get just ext
        $extension = 'pdf';
        // Filename to store
        $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $nomFile);
        $fileNameToStore = $withoutExt.'_afa.'.$extension;
        $destination = $path.'/'.$fileNameToStore;
        // store eoi finalized by afa
        copy($source,$destination);

        // Update dossier transaction
        DossierTransaction::whereId($dossTransId)->update(['eoi_finalize_file_name_afa'=>$fileNameToStore,'date_eoi_finalize_afa'=>Carbon::now(),'status'=>11]);

        return response()->json(['response'=>'true']);
    }

    public function sendDossierEoiFinalized(Request $request)
    {    
        $datas = $request->all();
        $dossTransId = $request->doss_id;
        $dossTrans = DossierTransaction::whereId($dossTransId)->first();
        $product = Product::whereId($dossTrans->product_id)->first();

        // Update dossier transaction
        DossierTransaction::whereId($dossTransId)->update(['status'=>12]);

        // Send Email SELLING PROCESS CLEARANCE to admin
        $admin = User::whereId(1)->first();
        $user = User::whereId($dossTrans->user_id)->first();
        $afa = User::whereId($dossTrans->afa_id)->first();
        $seller = User::whereId($product->seller_id)->first();
        $template = MailsTemplate::where('id', 37)->get();
        App::setLocale('fr');
        $lang = 'fr';
        $body = 'template_' . $lang;
        $sujet_tpl = 'sujet_'.$lang;
        $pathLink = url('/uploads/pdf/transaction/').'/'.$dossTrans->eoi_finalize_file_name_afa;
        $downloadeoiLink = '<b>'.setLinkDynamic($pathLink,strtoupper(trans('app.txt.eoi_finalized'))).'</b>';
        $vars = array(
            '{date}' => Carbon::now()->toFormattedDateString(),
            '{afa}' => $afa->name,
            '{name}' => $user->isPerson()?$user->userinfos->first_name.' '.$user->userinfos->last_name:$user->userinfos->orga_name,
            '{seller}' => $seller->name,
            '{sellerparentcompany}' => $seller->userinfos->orga_parent_name,
            '{title}' => $product->title,
            '{lottype}' => $dossTrans->lot_type,
            '{lotlevel}' => $dossTrans->lot_level,
            '{lotid}' => $dossTrans->lot_id,
            '{price}' => $dossTrans->final_sales_price,
            '{checkbox}' => '<input type="checkbox" checked disabled>',
            '{downloadLink}' => $downloadeoiLink,
        );
        $sujet = $template[0]->$sujet_tpl;
        $contenu = strtr($template[0]->$body, $vars);
        $content = ['title' => '', 'body' => $contenu];
        // send email admin
        Mail::to($admin->email)->send(new MailTemplate($content, $sujet));

        // Send Email to member (PROCEDURE DE VENTE TRANSFEREE)
        $nomMembre = $user->isPerson()?$user->userinfos->first_name.' '.$user->userinfos->last_name:$user->userinfos->orga_name;
        $adrPostAfa = $afa->location->adrpost_locality.' '.$afa->location->adrpost_postalCode.' '.Country::where('code',$afa->location->adrpost_country)->first()->content;
        $adrPhyAfa = $afa->location->route.', '.$afa->location->locality.' '.$afa->location->postalCode.' '.Country::where('code',$afa->location->country)->first()->content;
        $adrPostSeller = $seller->location->adrpost_locality.' '.$seller->location->adrpost_postalCode.' '.Country::where('code',$seller->location->adrpost_country)->first()->content;
        $adrPhySeller = $seller->location->route.', '.$seller->location->locality.' '.$seller->location->postalCode.' '.Country::where('code',$seller->location->country)->first()->content;
        $template2 = MailsTemplate::where('id', 38)->get();
        App::setLocale($user->language);
        $lang = App::getLocale();
        $body = 'template_' . $lang;
        $sujet_tpl = 'sujet_'.$lang;
        $vars = array(
            '{datesysteme}' => Carbon::now()->toFormattedDateString(),
            '{heuresysteme}' => Carbon::now()->toTimeString(),
            '{Nom Membre}' => $nomMembre,
            '{Nom AFA}' => $afa->name,
            '{ABN AFA}' => $afa->userinfos->orga_abn,
            '{adresse physique complete AFA}' => $adrPhyAfa,
            '{adresse postale complete AFA}' => $adrPostAfa,
            '{telephone AFA}' => $afa->userinfos->orga_phone,
            '{Mobile AFA}' => $afa->userinfos->orga_mobile_phone,
            '{fax AFA}' => $afa->userinfos->orga_fax,
            '{email AFA}' => $afa->userinfos->orga_email,
            '{licence AFA}' => $afa->userinfos->orga_license_number,
            '{Seller Business Name}' => $seller->userinfos->orga_name,
            '{Parent Companyname}' => $seller->userinfos->orga_parent_name,
            '{ABN Vendeur}' => $seller->userinfos->orga_name,
            '{adresse physique complete Vendeur}' => $adrPhySeller,
            '{adresse postale complete Vendeur}' => $adrPostSeller,
            '{telephone Vendeur}' => $seller->userinfos->orga_phone,
            '{Mobile Vendeur}' => $seller->userinfos->orga_mobile_phone,
            '{fax Vendeur}' => $seller->userinfos->orga_mobile_phone,
            '{email Vendeur}' => $seller->userinfos->orga_email,
        );
        $sujet2 = $template2[0]->$sujet_tpl;
        $contenu2 = strtr($template2[0]->$body, $vars);
        $content2 = ['title' => '', 'body' => $contenu2];
        // send email to member
        Mail::to($user->email)->send(new MailTemplate($content2, $sujet2));

        // Send Email to Seller  (vendeur)
        $title = $product->title;
        $lotLevel = $dossTrans->lot_level;
        $lotType = $dossTrans->lot_type;
        $lotId = $dossTrans->lot_id;
        $finalSalesPrice = $dossTrans->final_sales_price;
        $adrPostMember = ($user->location!==''?$user->location->adrpost_locality:'').' '.($user->location!==''?$user->location->adrpost_postalCode:'').' '.($user->location!==''?Country::where('code',$user->location->country)->first()->content:'');
        $adrPhyMember = $user->location->route.', '.$user->location->locality.' '.$user->location->postalCode.' '.Country::where('code',$user->location->country)->first()->content;
        $template3 = MailsTemplate::where('id', 39)->get();
        App::setLocale($seller->language);
        $lang = App::getLocale();
        $body = 'template_' . $lang;
        $sujet_tpl = 'sujet_'.$lang;
        $vars = array(
            '{Date system}' => Carbon::now()->toFormattedDateString(),
            '{Heure system}' => Carbon::now()->toTimeString(),
            '{Nom Membre}' => $nomMembre,
            '{Programm name}' => $title,
            '{lot type}'=> $lotType,
            '{lot level}'=> $lotLevel,
            '{lot ID}'=> $lotId,
            '{final sales price}'=> $finalSalesPrice,
            '{adresse physique complete Membre}'=>$adrPhyMember,
            '{adresse postale complete Membre}'=>$adrPostMember,
            '{telephone Membre}'=>$user->userinfos->orga_phone,
            '{Mobile Membre}'=>$user->userinfos->orga_mobile_phone,
            '{fax Membre}'=>$user->userinfos->orga_fax,
            '{Email Membre}'=>$user->userinfos->orga_email,
            '{Nom AFA}' => $afa->name,
            '{ABN AFA}' => $afa->userinfos->orga_abn,
            '{adresse physique complete AFA}'=>$adrPhyAfa,
            '{adresse postale complete AFA}'=>$adrPostAfa,
            '{telephone AFA}'=>$afa->userinfos->orga_phone,
            '{AFA mobile}'=>$afa->userinfos->orga_mobile_phone,
            '{Fax AFA}'=>$afa->userinfos->orga_fax,
            '{Email AFA}'=>$afa->userinfos->orga_email,
            '{licence AFA}'=>$afa->userinfos->orga_license_number,
        );
        $sujet3 = $template3[0]->$sujet_tpl;
        $contenu3 = strtr($template3[0]->$body, $vars);
        $content3 = ['title' => '', 'body' => $contenu3];
        // send email to seller
        Mail::to($seller->email)->send(new MailTemplate($content3, $sujet3));

        // Send Email to AFA
        $confirmationInitialDepotLink= setLinkDynamic(route('afa.transaction'),strtoupper(trans('app.txt.initial_deposit_confirmation')));
        $lia = Config::lia();
        $lia_name = $lia->get_meta('lia_name')->value;
        $template4 = MailsTemplate::where('id', 40)->get();
        App::setLocale($afa->language);
        $lang = App::getLocale();
        $body = 'template_' . $lang;
        $sujet_tpl = 'sujet_'.$lang;
        $vars = array(
            '{Date system}' => Carbon::now()->toFormattedDateString(),
            '{Heure system}' => Carbon::now()->toTimeString(),
            '{Nom Membre}' => $nomMembre,
            '{Nom programm}' => $title,
            '{Type lot}'=> $lotType,
            '{Niveau lot}'=> $lotLevel,
            '{identifiant lot}'=> $lotId,
            '{Prix vente final}'=> $finalSalesPrice,
            '{adresse physique complete Membre}'=>$adrPhyMember,
            '{adresse postale complete Membre}'=>$adrPostMember,
            '{telephone Membre}'=>$user->userinfos->orga_phone,
            '{Mobile Membre}'=>$user->userinfos->orga_mobile_phone,
            '{fax Membre}'=>$user->userinfos->orga_fax,
            '{Email Membre}'=>$user->userinfos->orga_email,
            '{Nom commercial du vendeur}'=>$seller->userinfos->orga_name,
            '{nom de la societe mere}'=>$seller->userinfos->orga_parent_name,
            '{ABN entreprise}'=>$seller->userinfos->orga_abn,
            '{adresse physique complete vendeur}'=>$adrPhySeller,
            '{adresse postale complete vendeur}'=>$adrPostSeller,
            '{telephone vendeur}'=>$lotType,
            '{Vendeur mobile}'=>$seller->userinfos->orga_phone,
            '{fax Vendeur}'=>$seller->userinfos->orga_mobile_phone,
            '{Email du vendeur}'=>$seller->userinfos->orga_email,
            '{Nom societe manager portail IEA}'=>$lia_name,
            '{confirmation_initial_depot_link}'=>$confirmationInitialDepotLink,
        );
        $sujet4 = $template4[0]->$sujet_tpl;
        $contenu4 = strtr($template4[0]->$body, $vars);
        $content4 = ['title' => '', 'body' => $contenu4];
        // send email to seller
        Mail::to($afa->email)->send(new MailTemplate($content4, $sujet4));

        return back()->with('success',trans('app.txt.eoi_finalized_sent'));
    }

    public function resendEoiToSeller(Request $request)
    {    
        $dossTransId = $request->id_doss_trans;
        App::setLocale('en');

        // Send Email to notify Seller (propriétaire du produit)
        $dossTrans = DossierTransaction::whereId($dossTransId)->first();
        $product = Product::whereId($dossTrans->product_id)->first();
        if($product->parent_id!=0 || $product->parent_id!=-1){
            $parent = Product::whereId($product->parent_id)->first();
            $filenameEoi=$parent->productEoi->first()->image->first()->filename;
        }else{
            $filenameEoi = $product->productEoi->first()->image->first()->filename;
        }
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
            '{seller}' => $seller->name,
            '{sellerparentcompany}' => $seller->userinfos?$seller->userinfos->orga_parent_name:'',
            '{name}' => $member->isPerson()?$member->userinfos->first_name.' '.$member->userinfos->last_name:$member->userinfos->orga_name,
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
        // $seller->notify(new SellerSendMessage($sujet,$content));
        Mail::to($seller->email)->send(new MailTemplate($content, $sujet));

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
            $user_name= $member->isPerson()?$member->userinfos->first_name.' '.$member->userinfos->last_name:$member->userinfos->orga_name;
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
            Mail::to($member->email)->send(new MailTemplate($content, $sujet));
            // $member->notify(new MemberMessage($sujet,$content));

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

        // get template mail and send message and email to member for download eoi
        $dt = Carbon::now();
        $dtDate = $dt->format('m-d-Y');
        $dtTime = $dt->format('H:i:m');
        $dossTrans = DossierTransaction::whereId($dtId)->first();
        $member = User::whereId($dossTrans->user_id)->first();
        $product = Product::whereId($dossTrans->product_id)->first();
        $user_name= $member->isPerson()?$member->userinfos->first_name.' '.$member->userinfos->last_name:$member->userinfos->orga_name;
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

        if($product->parent_id!=0 || $product->parent_id!=-1){
            $parent = Product::whereId($product->parent_id)->first();
            $eoipath=$parent->productEoi->first()->image->first()->filepath;
        }else{
            $eoipath = $product->productEoi->first()->image->first()->filepath;
        }
        
        $downloadeoiLink = setLinkDynamic($eoipath,strtoupper(trans('app.txt.eoi')));
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
        Mail::to($user->email)->send(new MailTemplate($content, $sujet));
        // $user->notify(new MemberMessage($sujet,$content));

        // udpate dossier transaction status
        DossierTransaction::whereId($dtId)->update(['status'=>9]);
        
        return back()->with('success', trans('app.txt.purchase_confirmed'));
    }

    // Confirm initial deposit
    public function initialDepositConfirm(Request $request){
        $dtId = $request->doss_id;
        $user = Auth::user();

        // udpate dossier transaction status
        DossierTransaction::whereId($dtId)->update(['status'=>12]);

        // get template mail and send message and email to afa
        $admin = User::whereId(1)->first();
        $dt = Carbon::now();
        $dtDate = $dt->format('m-d-Y');
        $dtTime = $dt->format('H:i:m');
        $dossTrans = DossierTransaction::whereId($dtId)->first();
        $member = User::whereId($dossTrans->user_id)->first();
        $product = Product::whereId($dossTrans->product_id)->first();
        $NomMembre= $member->isPerson()?$member->userinfos->first_name.' '.$member->userinfos->last_name:$member->userinfos->orga_name;
        $afaId = $member->afa->id;
        $afa = $member->afa->name;
        $title = $product->title;
        $lotLevel = $dossTrans->lot_level;
        $lotType = $dossTrans->lot_type;
        $lotId = $dossTrans->lot_id;
        $finalSalesPrice = $dossTrans->final_sales_price;
        $lia = Config::lia();
        $lia_name = $lia->get_meta('lia_name')->value;
        $template = MailsTemplate::where('id', 41)->get();
        App::setLocale($member->language);
        $lang = $member->language;
        $body = 'template_' . $lang;
        $sujet_tpl = 'sujet_'.$lang;
        $vars = array(
            '{Date system}' => $dtDate,
            '{Heure system}' => $dtTime,
            '{Nom AFA}' => $afa,
            '{NomMembre}' => $NomMembre,
            '{NomProgramme}' => $title,
            '{TypeLot}' => $lotType,
            '{NiveauLot}' => $lotLevel,
            '{IdentifiantLot}' => $lotId,
            '{PrixVenteFinal}' => $finalSalesPrice,
            '{Nom societe gestionnaire portail IEA}' => $lia_name,
        );
        $sujet = $template[0]->$sujet_tpl;
        $contenu = strtr($template[0]->$body, $vars);
        $content = ['title' => '', 'body' => $contenu];
        
        // message
        Message::create(['type'=>'admin','from_id'=>$afaId,'to_id'=>1,'body'=>$contenu]);

        // email
        Mail::to($admin->email)->send(new MailTemplate($content, $sujet));
        
        return response()->json(['msg'=>trans('app.txt.initial_deposit_confirmed')]);
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
        $sujet="";
        // message
        Message::create(['type'=>'admin','from_id'=>1,'to_id'=>$user->id,'body'=>$content]);
        // // email
        Mail::to($user->email)->send(new MailTemplate($content, $sujet));
        // $user->notify(new MemberDownloadEoiMessage($content));
        
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
        $user_name= $user->isPerson()?$user->userinfos->first_name.' '.$user->userinfos->last_name:$user->userinfos->orga_name;
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
