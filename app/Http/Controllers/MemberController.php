<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;

use App\Notifications\NewMail;
use App\Notifications\AplChanged;
use App\Notifications\AfaChanged;
use App\Notifications\AfaCourriel;
use App\Notifications\MemberWaitingMessage;
use App\Notifications\AfaConjunctionAgreementMessage;
use App\Notifications\MemberMandateSearchMessage;
use App\Notifications\AfaMandateSearchFinalisedMessage;
use App\Notifications\MemberMandateSearchFinalisedMessage;
use App\Notifications\MemberMessage;

use App\Models\Order;
use App\Models\User;
use App\Models\Email;
use App\Models\MailUser;
use App\Models\Localisation;
use App\Models\Message;
use App\Models\Temoignage;
use App\Models\RelationMembreApl;
use App\Models\Parameter;
use App\Models\DossierTransaction;
use App\Models\Product;
use App\Models\ConjunctionAgreement;
use App\Models\MandatRecherche;
use App\Models\Config;
use App\Models\Country;
use App\Mail\MailTemplate;
use App\Models\MailsTemplate;
use App\Models\ModelMessage;
use Mail;
use Session;
use Carbon\Carbon;
use App;
use PDF;


class MemberController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:5');
        $this->middleware('user:active');
    }

    /**
     * Liste des commandes en attente
     *
     * @return \Illuminate\Http\Response
     */
    public function carts() {
        $items = Auth::user()->orders()->where('status', 'pinged')->paginate($this->pageSize);

        return view('backend.sale.all')->with('title', __('member.carts'))->with('items',
            $items);
    }

    /**
     * Liste des commandes en cours d'achat effectue par le client
     *
     * @return \Illuminate\Http\Response
     */
    public function orders() {
        $items = Auth::user()->orders()->where('status', 'ordered')->paginate($this->pageSize);
        $lapls = Localisation::select('localizations.*')->join('users',
            'users.location_id', '=', 'localizations.id')->where('users.role', '=', '4')->groupBy('localizations.locality')->get();

        return view('backend.sale.all')->with('title', __('member.orders'))->with('lapls',
            $lapls)->with('items', $items);
    }
    
    public function transactions() {
        $items = Auth::user()->getDossierTransaction()->paginate($this->pageSize);
        
        return view('backend.transactions.all')->with('title', __('member.orders'))->with('items', $items);
    }

    /**
     * Liste des achats effectues par le client
     *
     * @return \Illuminate\Http\Response
     */
    public function purchases() {
        $items = Auth::user()->orders()->where('status', 'paid')->paginate($this->pageSize);
        $lapls = Localisation::select('localizations.*')->join('users',
            'users.location_id', '=', 'localizations.id')->where('users.role', '=', '4')->groupBy('localizations.locality')->get();

        return view('backend.sale.all')->with('title', __('member.purchases'))->with('lapls',
            $lapls)->with('items', $items);
    }

    public function contact(Request $request, $role) {
        $action = route('send.message', ['role' => $role]);
        $apls = User::ofRole(4)->isActive()->get();
        $user_name = "";
        $lafas = User::where('role', 3)->where('status', 'active')->where('location_id',
            Auth::user()->location_id)->orderBy('id', 'desc')->get();
        $getAllMessage = $this->getAllMessage($role);


        if ($request->get('afa'))
            $user_name = $request->get('afa');

        if ($request->get('apl'))
            $user_name = $request->get('apl');

        if (($role == 'apl') && !Auth::user()->apl) {
            return redirect()->route('member.select.apl')->with('error', trans('app.txt.choose_an_apl_before_messaging'));
        }elseif ($role == 'afa') {
            if (!Auth::user()->hasAfa()){
                return redirect()->route('member.select.afa')->with('error', trans('app.txt.choose_an_afa_before_messaging'));
            }
        }else{
            return view('backend.contact.member')->with('action', $action)->with('lafas',
            $lafas)->with('apls', $apls)->with('role', $role)->with('user_name', $user_name)->with('title',
            __('app.contact_' . $role))->with(['data' => $getAllMessage]);
        }

        return view('backend.contact.member')->with('action', $action)->with('lafas',
            $lafas)->with('apls', $apls)->with('role', $role)->with('user_name', $user_name)->with('title',
            __('app.contact_' . $role))->with(['data' => $getAllMessage]);
    }

    public function getAllMessage($role) {
        $to_id = "";

        switch ($role) {
            case 'admin':
                $to_id = 1;
                break;

            case 'afa':
                $to_id = User::where('id', Auth::user()->id)->first()->afa_id;
                break;

            case 'apl':
                $to_id = User::where('id', Auth::user()->id)->first()->apl_id;
                break;

            default:
                # code...
                break;
        }

        $messages = Message::whereRaw("(from_id = " . Auth::user()->id . " AND to_id = $to_id ) OR (to_id = " .
            Auth::user()->id . " AND from_id = $to_id )")->orderBy('created_at', 'ASC')->get();

        $data = [];
        foreach ($messages as $message) {
            $data[] = ['id' => $message->id, 'from_id' => $message->from_id, 'from_name' =>
                User::where('id', $message->from_id)->first()->name, 'to_id' => $message->to_id,
                'body' => nl2br(e($message->body)), 'created_at' => $message->created_at,
                'created_at_send' => $message->created_at->diffForHumans(), 'seen' => $message->seen ?
                trans('app.txt.read') : trans('app.txt.unread'), ];
        }


        // update message showing
        Message::where('from_id', $to_id)->where('to_id', Auth::user()->id)->update(['seen' =>
            1]);


        return json_encode($data);
    }

    public function getUnreadMessage() {
        $role_id = Auth::user()->role;
        $unreadCountAdmin = '';
        $unreadCountAfa = '';
        $unreadCountApl = '';
        $data = [];

        if (isset(Message::unreadCount(Auth::user()->id, 1)->count)) {
            $unreadCountAdmin = Message::unreadCount(Auth::user()->id, 1)->count;
        }

        if (isset(Message::unreadCount(Auth::user()->id, User::where('id', Auth::user()->id)->first
            ()->afa_id)->count)) {
            $unreadCountAfa = Message::unreadCount(Auth::user()->id, User::where('id', Auth::user
                ()->id)->first()->afa_id)->count;
        }

        if (isset(Message::unreadCount(Auth::user()->id, User::where('id', Auth::user()->id)->first
            ()->apl_id)->count)) {
            $unreadCountApl = Message::unreadCount(Auth::user()->id, User::where('id', Auth::user
                ()->id)->first()->apl_id)->count;
        }

        $data = ['role_id' => $role_id, 'unreadCountAdmin' => $unreadCountAdmin,
            'unreadCountAfa' => $unreadCountAfa, 'unreadCountApl' => $unreadCountApl, ];


        return response()->json(['res' => $data]);
    }


    public function sendMessage(Request $request, $role) {
        // Validate request
        $datas = $request->all();
        $validator = Validator::make($datas, ['content' => 'required|max:1000',
            //'files.*' => 'mimes:jpeg,jpg,png,gif,svg|max:2048',
            ]);

        if ($validator->passes()) {
            $current = Auth::user();

            $item = new Message();
            $item->type = 'user';
            $item->from_id = $current->id;
            $item->body = $request->content;
            if ($role === 'admin') {
                $item->to_id = 1;
            } else
                if ($role === 'afa') {
                    $item->to_id = $current->afa_id;
                } else {
                    $item->to_id = $current->apl_id;
                }

                $item->save();

            return response()->json(['success' => trans('app.txt.message_sent')]);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function sendMail(Request $request, $role) {

        if (($role == 'apl') && !Auth::user()->apl) {
            return redirect()->route('member.select.apl')->with('error',
                'Vous devez choisir un APL d\'abord.');
        }

        $current = Auth::user();

        // Validate request
        $datas = $request->all();
        $validator = Validator::make($datas, ['subject' => 'required|max:100', 'content' =>
            'required|max:1000', //'files.*' => 'mimes:jpeg,jpg,png,gif,svg|max:2048',
            ]);


        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($role == 'admin') {
            $receiver = User::ofRole('admin')->isActive()->first();
            if (!$receiver) {
                return back()->with('error', 'Une erreur est survenue.');
            }
            $to = option('site.admin_email', $receiver->email);
            $toName = option('site.admin_name', $receiver->name);
        } else
            if ($role == 'apl') {
                $receiver = $current->apl;
                if (!$receiver || !$receiver->active()) {
                    return back()->with('error', 'Une erreur est survenue.');
                }
                $to = $receiver->email;
                $toName = $receiver->name;
            } else {
                abort(404);
            }

            $item = new Mail();
        $item->subject = $request->subject;
        $item->content = $request->content;
        $item->status = 'send';
        $item->save();

        $mailUser = new MailUser();
        $mailUser->user_id = $receiver->id;
        $mailUser->mail_id = $item->id;
        $mailUser->save();

        try {
            $receiver->notify(new NewMail($item));
        }
        catch (\Exception $e) {
        }

        $to = 'joelinjatovo@gmail.com';

        $files = $request->file('files');
        if (!$files) {
            $files = [];
        }
        try {
            $data = array('name' => $toName, 'content' => $item->content);
            \Mail::send('mail', $data, function ($message)use ($item, $to, $toName, $files) {

                $message->to($to, $toName); $message->subject($item->subject . ' ' . count($files));
                    $message->from($item->sender->email, $item->sender->name); if (count($files) > 0) {
                    foreach ($files as $file) {
                        $message->attach($file->getRealPath(), array('as' => $file->getClientOriginalName
                                (), // If you want you can change original name to custom name
                                'mime' => $file->getMimeType())); }
                }
            }
            );

            \Mail::send('mail', $data, function ($message) {
                $message->to('joelinjatovo@gmail.com', 'Tutorials Point'); $message->subject('AFTER MAIL');
                    $message->from('joelinjatovo@gmail.com', 'Virat Gandhi'); }
            );

        }
        catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Message envoyé avec succes.');
    }


    /**
     * Contact AFA
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Auth
     * @return \Illuminate\Http\Response
     */
    public function contactAfa(Request $request) {
        $this->middleware('auth');
        $this->middleware('role:member');

        if (Auth::user()->hasAfa()) {
            return redirect(url()->previous())->with('has_afa', trans('app.txt.member_has_afa'));
        } else {
            return redirect()->route('member.select.afa')->with('info', trans('app.txt.choose_an_afa'));
        }
    }


    /**
     * Show select apl
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product
     * @return \Illuminate\Http\Response
     */
    public function selectApl(Request $request) {
        $this->middleware('auth');
        $this->middleware('role:member');
        // check if user has apl or add if user has no apl
        $message = "";
        $nbDayAplMember = Parameter::nbDayEndApl();
        if ($request->get('apl')) {
            if (Auth::user()->hasApl()) {
                $message = trans('app.txt.member_has_apl', ['apl' => User::find(Auth::user()->apl_id)->name]);
            } else {
                // // Add APL on member
                User::whereId(Auth::id())->update(['apl_id' => $request->get('apl'),
                    'apl_ends_at' => \Carbon\Carbon::now()->addDays($nbDayAplMember)]);
                $relation = new RelationMembreApl();
                $relation->membre_id = Auth::id();
                $relation->apl_id = $request->get('apl');
                $relation->dt_debut_relation = \Carbon\Carbon::now();
                $relation->dt_end_relation = \Carbon\Carbon::now()->addDays($nbDayAplMember);
                $relation->save();
                $message = trans('app.txt.member_has_new_apl', ['apl' => User::find($request->get
                    ('apl'))->name]);
                //envoie notification APL
                $item = new Message();
                $item->type = 'user';
                $item->from_id = Auth::user()->id;
                $item->body = 'Message rélation entre APL et membre';
                $item->to_id = $request->get('apl');
                $item->save();
            }
        }

        $distance = $request->get('distance');
        if (empty($distance))
            $distance = 100;

        $data = [];

        $apls = User::ofRole(4)->isActive()->has('location')->with('location')->get();

        $userApl = Auth::user()->apl;

        $selected = null;

        foreach ($apls as $item) {
            $html = view('backend.apl.html')->with('item', $item)->render();
            $dataTemp = ['id' => $item->id, 'lat' => $item->location ? $item->location->latitude :
                0, 'lng' => $item->location ? $item->location->longitude : 0, 'title' => $item->name,
                'content' => $item->get_meta('orga_description') ? $item->get_meta('orga_description')->value :
                '', 'type' => $item->role, 'html' => $html, ];

            $data[] = $dataTemp;

            if ($userApl && ($item->id == $userApl->id)) {
                $selected = $dataTemp;
            }
        }

        $action = route('member.select.apl');

        return view('backend.apl.select')->with('location', Auth::user()->location)->with('action',
            $action)->with('items', $apls)->with('distance', $distance)->with('distances',
            $this->distances)->with('selected', json_encode($selected))->with('message', $message)->with('data',
            json_encode($data));
    }


    /**
     * Update APl
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product
     * @return \Illuminate\Http\Response
     */
    public function updateApl(Request $request) {
        $this->middleware('auth');
        $this->middleware('role:5');

        $apl = null;
        if ($request->has('apl')) {
            $apl = User::ofRole('apl')->isActive()->where('id', '=', $request->apl)->first();
        } else {
            return back()->withInput()->with('error', trans('app.txt.choose_an_apl'));
        }

        // No APL selected
        if (!$apl) {
            return back()->withInput()->with('error', trans('app.txt.choose_an_apl'));
        }

        if (!$request->input('confirm')) {
            return back()->withInput()->with('error',trans('app.txt.mustagreeterme'));
        }

        // Update APL
        Auth::user()->apl_id = $apl->id;
        Auth::user()->apl_ends_at = \Carbon\Carbon::now()->addDays(option('payment.apl_ends_at',
            Parameter::nbDayEndApl()));
        Auth::user()->save();

        try {
            Auth::user()->notify(new AplChanged(Auth::user(), false));
        }
        catch (\Exception $e) {
        }

        try {
            $apl->notify(new AplChanged(Auth::user(), true));
        }
        catch (\Exception $e) {
        }

        return back()->with('success', 'Apl modifié!');
    }

    /**
     * Select afa
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User
     * @param  \App\Models\Localisation
     * @return \Illuminate\Http\Response
     */
    public function selectAfa(Request $request, $id_doss_trans) {
        $this->middleware('auth');
        $this->middleware('role:5');

        $doss_trans = DossierTransaction::whereId($id_doss_trans)->first();
        $product=Product::whereId($doss_trans->product_id)->first();
        if($product){
            $prodUrl = url('product/'.$product->slug);
            session()->put('id_product',$product->id);
            session()->put('link_product',$prodUrl);
        }

        // Update dossier transaction status
        if($doss_trans->status===0){
            DossierTransaction::where('user_id',Auth::id())->where('product_id',$product->id)->update(['status'=>1]);
        }

        $distance = $request->get('distance');
        if (empty($distance))
            $distance = 100;
            
        $data = [];
        $postCode = $product->location()->first()->postalCode;

        // if product is deposed with AFA (SBA)
        if($product->isSellerByAfa()){
            $afas = $product->afa();
        }else{
            $afas = User::ofRole(3)->isActive()->has('location')->hasPostalCode($postCode)->get(['users.*']);
        }

        $userApl = Auth::user()->apl;

        $selected = null;

        foreach ($afas as $item) {
            $html = view('backend.afa.html')->with('item', $item)->render();
            $dataTemp = ['id' => $item->id, 'lat' => $item->location ? $item->location->latitude :
                0, 'lng' => $item->location ? $item->location->longitude : 0, 'title' => $item->name,
                'content' => $item->get_meta('orga_description') ? $item->get_meta('orga_description')->value :
                '', 'type' => $item->role, 'html' => $html, ];

            $data[] = $dataTemp;

            if ($userApl && ($item->id == $userApl->id)) {
                $selected = $dataTemp;
            }
        }

        $action = route('member.select.afa.update');


        return view('backend.afa.select')->with('location', Auth::user()->location)->with('action',
            $action)->with('items', $afas)->with('distance', $distance)->with('distances',
            $this->distances)->with('selected', json_encode($selected))->with('data',
            json_encode($data))->with('id_doss_trans',$id_doss_trans);
    }
    
    /**
     * Update AFA
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product
     * @return \Illuminate\Http\Response
     */
    public function updateAfa(Request $request) {
        $this->middleware('auth');
        $this->middleware('role:5');

        $idProd = session('id_product');
        $prod = Product::whereId($idProd)->first();

        $afa = null;
        $dt = Carbon::now();
        $dtDate = $dt->format('m-d-Y');
        $dtTime = $dt->format('H:i:m');
        $user = Auth::user();
        $user_name= $user->isPerson()?$user->userinfos->first_name.' '.$user->userinfos->last_name:$user->userinfos->orga_name;
        $id_doss_trans = $request->get('id_doss_trans');

        if ($request->has('afa')) {
            $afa = User::ofRole('3')->isActive()->where('id', '=', $request->afa)->first();
        } else {
            return back()->withInput()->with('error', trans('app.txt.choose_an_afa'));
        }

        // No AFA selected
        if (!$afa) {
            return back()->withInput()->with('error', trans('app.txt.choose_an_afa'));
        }

        if (!$request->input('confirm')) {
            return back()->withInput()->with('error', trans('app.txt.mustagreeterme'));
        }

        // Update AFA
        Auth::user()->afa_id = $afa->id;
        if($prod){
            if(!$prod->isSellerByAfa()){
                Auth::user()->afa_ends_at = \Carbon\Carbon::now()->addDays(option('payment.afa_ends_at',
                Parameter::nbDayEndAfa()));
            }
        }

        Auth::user()->save();

        // Notify User
        try {
            Auth::user()->notify(new AfaChanged(Auth::user(), false));
        }
        catch (\Exception $e) {
        }

        // Nofity AFA
        try {
            $afa->notify(new AfaChanged(Auth::user(), true));
        }
        catch (\Exception $e) {
        }

        if (session()->get('link_product')) {
            $user=Auth::user();
            $linkProduct = session()->get('link_product');
            session()->forget('link_product');
            $downloadCaLink = url("uploads/pdf/ca/CA-".Auth::user()->afa->immat."_".time().".pdf");
            $uploadCaLink = route('afa.transaction');
            $txtContent = Session()->get('buy_this_product')?'member.waiting_message':'member.gothere.select_afa.waiting_message';
            $afa_id=$user->afa_id;
            
            // send notification email to member from IEA
            // $user->notify(new MemberMessage($sujet,$content));
            // send notification email to member from IEA
            $afa =User::whereId($afa_id)->first();
            if($user->isMove()){
                $template = MailsTemplate::where('id', 49)->get();
            }else{
                $template = MailsTemplate::where('id', 50)->get();
            }
            App::setLocale($user->language);
            $lang = $user->language;
            $body = 'template_' . $lang;
            $sujet_tpl = 'sujet_'.$lang;
            $vars = array(
                '{date}' => Carbon::now()->toFormattedDateString(),
                '{heure}' => Carbon::now()->toTimeString(),
                '{nom}' => $user->isPerson()?$user->userinfos->first_name.' '.$user->userinfos->last_name:$user->userinfos->orga_name,
                '{afa}' => $user->afa->name,
            );
            $sujet = $template[0]->$sujet_tpl;
            $contenu = strtr($template[0]->$body, $vars);
            $content = ['title' => '', 'body' => $contenu];

            // send chat message to member from IEA (admin)
            Message::create(['type'=>'admin','from_id'=>1,'to_id'=>$user->id,'body'=>$contenu]);

            Mail::to($user->email)->send(new MailTemplate($content, $sujet));

            // Declenche Conjuction Agreement Module
            App::setLocale('en');
            $this->sendConjuctionAgreementModule($user->afa_id,$user->afa->email, $downloadCaLink, $uploadCaLink, $id_doss_trans);
            
            // set language to default
            App::setLocale($user->language);
            if($id_doss_trans == 0){
                return redirect($linkProduct)->with('engagement', trans('member.waiting_message', ['user'=>$user,'date'=>$dtDate,'hour'=>$dtTime,'afa' => Auth::user()->afa->name]))->with('waiting',1);
            }
        }  

        // Update status et ajouter id afa dans la table dossier transaction
        $doss_trans = DossierTransaction::whereId($id_doss_trans)->update(['status'=>2,'afa_id'=>$request->afa, 'date_choose_afa'=>Carbon::now()]);

        return redirect()->route('member.transaction')->with('success', trans('member.message.afa.selected',['afa'=>User::whereId($request->afa)->first()->name]));
    }

    // Declanche Conjunction Agreement (CA)
    public function sendConjuctionAgreementModule($afa_id,$afa_mail,$downloadCaLink,$uploadCaLink,$id_doss_trans){
        $afaId=$afa_id;

        // Create CA pdf
        $pdfName=explode('/',$downloadCaLink);
        $this->createCaPdf($pdfName[6],$id_doss_trans);

        // send notification email to afa from IEA
        $user=Auth::user();
        $afa =User::whereId($afa_id)->first();
        $template = MailsTemplate::where('id', 27)->get();
        $lang = App::getLocale();
        $body = 'template_' . $lang;
        $sujet_tpl = 'sujet_'.$lang;
        $downloadLink='<a href="'.$downloadCaLink.'">'.strtoupper(trans('app.txt.conjunction_agreement')).'</a>';
        $uploadLink='<a href="'.$uploadCaLink.'">'.strtoupper(trans('app.txt.send_the_finalized_conjuntion_agreement')).'</a>';
        $lia = Config::lia();
        $lia_name = $lia->get_meta('lia_name')->value;
        $vars = array(
            '{date}' => Carbon::now()->toFormattedDateString(),
            '{heure}' => Carbon::now()->toTimeString(),
            '{name}' => $user->isPerson()?$user->userinfos->first_name.' '.$user->userinfos->last_name:$user->userinfos->orga_name,
            '{immat}' => $user->immat,
            '{ieaagencyname}' => $lia_name,
            '{downloadlink}' => $downloadLink,
            '{submitlink}' => $uploadLink
        );
        $sujet = $template[0]->$sujet_tpl;
        $contenu = strtr($template[0]->$body, $vars);
        $content = ['title' => '', 'body' => $contenu];
        
        // send chat message to afa from IEA (admin)
        Message::create(['type'=>'admin','from_id'=>1,'to_id'=>$afa_id,'body'=>$content]);

        // $email_to = 'dev4.easydata@gmail.com';
        // Mail::to($email_to)->send(new MailTemplate($content, $sujet));
        // $afa->notify(new AfaConjunctionAgreementMessage($sujet,$content));
        Mail::to($afa->email)->send(new MailTemplate($content, $sujet));
    }

    public function createCaPdf($name,$id_doss_trans) {
        $pdf_template = 'pdf.conjunction_agreement';
        $user = Auth::user();
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
        $pdfName = $name;
        $path = 'uploads/pdf/ca/'.$pdfName;
        $prod_id = session()->get('id_product');

        // Save conjunction agreement in 
        $ca = ConjunctionAgreement::create(['file_name'=>$pdfName,'path'=>$path,'product_id'=>$prod_id,'from_id'=>$user->id,'to_id'=>$user->afa->id]);
        session()->forget('id_product');

        // Update ca_id dossier transation
        DossierTransaction::whereId($id_doss_trans)->update(['ca_id'=>$ca->id]);

        return PDF::loadView($pdf_template,['user'=>$user, 'iea'=>$iea])->save($path);
    }

    // Declanche Mandat de Recherche
    public function ajaxSendMandatIeaToMember(){

        // Create Mandat de recherche form6 pdf
        $mdRch = $this->createForm6Pdf();

        $dt = Carbon::now();
        $dtDate = $dt->format('m-d-Y');
        $dtTime = $dt->format('H:i:m');
        $downloadForm6Link = url($mdRch->path);
        $uploadForm6Link = route('member.dossier');
        $user = Auth::user();
        $user_name= $user->isPerson()?$user->userinfos->first_name.' '.$user->userinfos->last_name:$user->userinfos->orga_name;
        $user_immat = $user->immat;
        $afa = $user->afa->name;
        $prod_id = session()->get('id_product');
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

    public function createForm6Pdf() {
        $pdf_template = 'pdf.form6';
        $user = Auth::user();
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
        $prod_id = session()->get('id_product');
        $product = Product::whereId($prod_id)->first();

        $pdfName = 'Form6_'.$product->location->area_level_1.'_'.$user->immat."_".time().".pdf";
        $path = 'uploads/pdf/form6/'.$pdfName;

        // Save form6 pdf in path
        PDF::loadView($pdf_template,['user'=>$user, 'iea'=>$iea, 'product'=>$product])->save($path);

        // Save Research Mandate
        return MandatRecherche::create(['file_name'=>$pdfName,'path'=>$path,'product_id'=>$prod_id,'from_id'=>1,'to_id'=>$user->id,'afa_id'=>$user->afa->id]);
    }

    public function autoCompleteForm6(){

        // require (__DIR__.'/Fpdm/fpdm.php');
        
        // $fields = array(
        //     'name'    => 'My name',
        //     'address' => 'My address',
        //     'city'    => 'My city',
        //     'phone'   => 'My phone number'
        // );
        
        // $pdf = new FPDM(__DIR__.'/Fpdm/fom6.pdf');
        // $pdf->Load($fields, false); // second parameter: false if field values are in ISO-8859-1, true if UTF-8
        // $pdf->Merge();
        // $pdf->Output();

        return 'autoCompleteForm6';
    }

    /**
     * By this property
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product
     * @return \Illuminate\Http\Response
     */
    public function buyThisProduct(Request $request,Product $product) {
        $this->middleware('auth');
        $this->middleware('role:5');

        Session()->put('buy_this_product',true);

        if(Auth::user()->isPerson()){
            // Membre particulier
            if($product){
                $prod_id = $product->id;
                $prodUrl = url('product/'.$product->slug);
                $dt = Carbon::now();
                $dtDate = $dt->format('m-d-Y');
                $dtTime = $dt->format('H:i:m');
                $user= Auth::user()->isPerson()?Auth::user()->name:Auth::user()->userinfos()->first()->orga_name;
                $userAuth= Auth::user();
                $country = Country::where('code',$userAuth->location->country)->pluck('content')[0];
                $city=$userAuth->afa->location->locality;
                $mandatesearch = url(MandatRecherche::where('product_id','=',$prod_id)->where('to_id','=',$userAuth->id)->where('afa_id','=',$userAuth->afa->id)->first()->path);
                $linkcompletetrans = url('afa/dossier?action=complete_dossier_transaction_info&ID='.DossierTransaction::getDossierTransactionId($prod_id,$userAuth->id));
            
                Session()->put('complete_registration',true);
                return redirect($prodUrl)->with('complete_registration_content', trans('member.tobuy.complete_registration.header', ['date'=>$dtDate, 'hour'=>$dtTime, 'name'=>$user]))->with('complete_registration_message',1);
            }else{
                abort(404);
            }
        }else{
            // Membre organisation
            // Update dossier transaction
            DossierTransaction::where('product_id',$product->id)->with('user_id',Auth::id())->update(['status'=>7]);

            return redirect()->route('member.transaction');
        }

        
        abort(404);
    }


    /**
     * By this property not deplacement
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product
     * @return \Illuminate\Http\Response
     */
    public function buyThisProductDirectly(Request $request,Product $product) {
        $this->middleware('auth');
        $this->middleware('role:5');
        $dt = Carbon::now();
        $dtDate = $dt->format('m-d-Y');
        $dtTime = $dt->format('H:i:m');
        $user = Auth::user();
        $prod_id = $product->id;
        $prodUrl = url('product/'.$product->slug);
        $member_name= $user->isPerson()?Auth::user()->userinfos->first_name.' '.Auth::user()->userinfos->last_name:Auth::user()->userinfos->orga_name;

        if(!Auth::user()->isCheckedDossierTransaction($prod_id)){
            $this->creationDossierTransaction($product);
        }

        if(!$user->isComplete()){
            if(Auth::user()->isPerson()){
                // Membre particulier
                if($product){
                    $prod_id = $product->id;
                    $userAuth= Auth::user();
                    $country = Country::where('code',$userAuth->location->country)->pluck('content')[0];
                    $completeDossierInscriptionLink = setLinkDynamic(route('member.complete_registration',$product),strtoupper(trans('app.txt.complete_my_registration_form')));
                    $privacyPolicyLink=setLinkDynamic(route('confidentialities'),trans('app.txt.privacy_policy'));
                    // Get Model message
                    $message = ModelMessage::where('id', 9)->get();
                    if (count($message) > 0) {
                        $vars = array(
                            '{date}' => $dtDate,
                            '{heure}' => $dtTime,
                            '{nomMembre}' => $member_name,
                            '{completeDossierInscriptionLink}' => $completeDossierInscriptionLink,
                            '{Politique de Confidentialite Link}' => $privacyPolicyLink);
                        $contenu = strtr($message[0]->message_fr, $vars);
                    }
                
                    Session()->put('complete_registration',true);
                    return redirect($prodUrl)->with('complete_registration_directly_content', $contenu)->with('complete_registration_message',1);
                }else{
                    abort(404);
                }
            }
        }else{
            $dossTrans = $user->getCurrentDossierTransaction($prod_id);
            
            if($dossTrans->status == 1){
                return redirect($prodUrl)->with('engagement', trans('member.gothere.select_afa', ['date'=>$dtDate, 'hour'=>$dtTime, 'name'=>$member_name]))->with('hasAfa',0);
            }

            return redirect()->route('member.transaction');
        }
        
        abort(404);
    }

    /**
     * Show complete registration form
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User
     * @param  \App\Models\Localisation
     * @return \Illuminate\Http\Response
     */
    public function completeRegistration(Request $request,Product $product) {
        $this->middleware('auth');
        $this->middleware('role:5');

        
        if($product){
            $prodUrl = url('product/'.$product->slug);
            session()->put('id_product',$product->id);
            session()->put('link_product',$prodUrl);
            $prod_id = $product->id;
        }

        $dossTrans = DossierTransaction::where('user_id',Auth::id())->where('product_id',$product->id)->first();
        
        return view('login.memberpart')->with('user', Auth::user())->with('id_doss',$dossTrans->id);
    }

    /**
     * Go there
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product
     * @return \Illuminate\Http\Response
     */
    // public function goThere(Request $request, $slug=null,$prod=null) {
    public function goThere(Request $request, Product $product) {
        $this->middleware('auth');
        $this->middleware('role:5');

        $user = Auth::user();
        $doss_trans_status = Auth::user()->getCurrentStatusTransaction($product->id);
        
        if($product){
            $prod_id = $product->id;
            $prodUrl = url('product/'.$product->slug);
            $dt = Carbon::now();
            $dtDate = $dt->format('m-d-Y');
            $dtTime = $dt->format('H:i:m');
            $user= Auth::user()->isPerson()?Auth::user()->name:Auth::user()->userinfos()->first()->orga_name;

            if(!Auth::user()->isCheckedDossierTransaction($prod_id)){
                $this->creationDossierTransaction($product);

                // Update info member
                Auth::user()->is_move = 1;
                Auth::user()->save();
            }


            if (Auth::user()->hasAfa()) {
                if(Auth::user()->afaHasSendCa(Auth::user()->id,Auth::user()->afa->id)){
                    Session::put('id_product',$prod_id);
                    return redirect($prodUrl)->with('engagement', trans('member.notification.after_afa_send_finalized_ca'))->with('waiting',1);
                }else{
                    return redirect($prodUrl)->with('engagement', trans('member.gothere.select_afa.waiting_message', ['date'=>$dtDate,'hour'=>$dtTime,'name'=>$user,'afa' => Auth::user()->afa->name]))->with('waiting',1);
                }
            } else {
                return redirect($prodUrl)->with('engagement', trans('member.gothere.select_afa', ['date'=>$dtDate, 'hour'=>$dtTime, 'name'=>$user]))->with('hasAfa',0);
            }
        }
        
        abort(404);
    }

    public function continueTransaction(Request $request,$idtrans) {
        $this->middleware('auth');
        $this->middleware('role:5');

        $doss_trans=DossierTransaction::whereId($idtrans)->first();
        $doss_trans_status = $doss_trans->status;
        $prod = Product::whereId($doss_trans->product_id)->first();
        $user = User::whereId($doss_trans->user_id)->first();
        
        switch ($doss_trans_status) {
            // dossier transaction créer
            case '0':
                $dt = Carbon::now();
                $dtDate = $dt->format('m-d-Y');
                $dtTime = $dt->format('H:i:m');
                $prodUrl = url('product/'.$prod->slug);

                return redirect($prodUrl)->with('engagement', trans('member.gothere.select_afa', ['date'=>$dtDate, 'hour'=>$dtTime, 'name'=>$user->name]))->with('hasAfa',0);

                break;
            // dossier transaction choisir afa
            case '1':
                $id_dossier_transaction = $user->getUserCurrentTransaction($prod->id);

                return redirect()->route('member.select.afa',$idtrans);
                
                break;
            // dossier transaction AFA selectionner
            case '2':
                
                break;
            case '3':
                # code...
                break;
            case '4':
                # code...
                break;
            case '5':
                # code...
                break;
            case '6':
                # code...
                break;
            case '7':
                # code...
                break;
            case '8':
                # code...
                break;
            
            default:
                # code...
                break;
        }

        abort(404);
    }

    public function continueTransactionSansDeplacement(Request $request,$idtrans) {
        $this->middleware('auth');
        $this->middleware('role:5');
        $dt = Carbon::now();
        $dtDate = $dt->format('m-d-Y');
        $dtTime = $dt->format('H:i:m');
        $doss_trans=DossierTransaction::whereId($idtrans)->first();
        $doss_trans_status = $doss_trans->status;
        $prod = Product::whereId($doss_trans->product_id)->first();
        $user = User::whereId($doss_trans->user_id)->first();
        $member_name= $user->isPerson()?Auth::user()->userinfos->first_name.' '.Auth::user()->userinfos->last_name:Auth::user()->userinfos->orga_name;
        $prodUrl = url('product/'.$prod->slug);
        
        switch ($doss_trans_status) {
            // dossier transaction créer
            case '0':
                $completeDossierInscriptionLink = setLinkDynamic(route('member.complete_registration',$prod),strtoupper(trans('app.txt.complete_my_registration_form')));
                $privacyPolicyLink=setLinkDynamic(route('confidentialities'),trans('app.txt.privacy_policy'));
                // Get Model message
                $message = ModelMessage::where('id', 9)->get();
                if (count($message) > 0) {
                    $vars = array(
                        '{date}' => $dtDate,
                        '{heure}' => $dtTime,
                        '{nomMembre}' => $member_name,
                        '{completeDossierInscriptionLink}' => $completeDossierInscriptionLink,
                        '{Politique de Confidentialite Link}' => $privacyPolicyLink);
                    $contenu = strtr($message[0]->message_fr, $vars);
                }
            
                Session()->put('complete_registration',true);
                return redirect($prodUrl)->with('complete_registration_directly_content', $contenu)->with('complete_registration_message',1);

                break;
            // dossier transaction choisir afa
            case '1':
                $dt = Carbon::now();
                $dtDate = $dt->format('m-d-Y');
                $dtTime = $dt->format('H:i:m');

                return redirect($prodUrl)->with('engagement', trans('member.gothere.select_afa', ['date'=>$dtDate, 'hour'=>$dtTime, 'name'=>$user->name]))->with('hasAfa',0);
                
                break;
            // dossier transaction AFA selectionner
            case '2':
                
                break;
            case '3':
                # code...
                break;
            case '4':
                # code...
                break;
            case '5':
                # code...
                break;
            case '6':
                # code...
                break;
            case '7':
                # code...
                break;
            case '8':
                # code...
                break;
            
            default:
                # code...
                break;
        }

        abort(404);
    }

    public function creationDossierTransaction(Product $prod){
        $prefix = "";
        $status = 0; //0=>en_cours
        $user_id = Auth::id();
        $prod_id = $prod->id;
        $prod_cat_id = $prod->category_id;
        $numero = $this->generateNumDossier($prod_cat_id);
        
        return DossierTransaction::create(['numero'=>$numero, 'user_id'=>$user_id, 'product_id'=>$prod_id, 'status'=>$status]);
    }

    /*
    * Generate num dossier
    *
    */
    private function generateNumDossier($cat_id){
        $dossierPrefix = "";
        $dossierNum = 00000;
        $roleId=0;

        switch ($cat_id) {
            case '1':
                $dossierPrefix = 'RES-';
                break;

            case '2':
                $dossierPrefix = 'FON-';
                break;
            
            case '3':
                $dossierPrefix = 'IND-';
                break;
            
            case '4':
                $dossierPrefix = 'COM-';
                break;

            default:
                abort(404);
                break;
        }

        $dossierMax = DossierTransaction::where('numero', 'like', '%'.$dossierPrefix.'%')->orderBy('numero','DESC')->first();

        if($dossierMax !== null){
            $num = $dossierMax->numero;
            $explodeNum = explode('-',$num);
            $dossierNum = $explodeNum[1];
        }

        return $dossierPrefix . str_pad($dossierNum+1, 5, "0", STR_PAD_LEFT);
    }


    /**
     * Send Courriel for member
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product
     * @return \Illuminate\Http\Response
     */
    public function sendCourriel(Request $request) {
        $this->middleware('auth');
        $this->middleware('role:5');
        session()->forget('engagement');

        // Update info member
        Auth::user()->is_move = 1;
        Auth::user()->save();

        // Notify User
        Auth::user()->notify(new AfaCourriel(Auth::user(), Auth::user()->afa->name));

        try {
            return redirect(url()->previous())->with('engagement', trans('afa.notif_after_send_mail'))->with('mail_send',
                "send");
        }
        catch (\Exception $exception) {

        }

    }

    public function testimonial() {
        $record = Temoignage::where('user_create', Auth::user()->id)->paginate($this->pageSize);
        return view('backend.temoignage.all')->with('title', __('member.menu_temoignage'))->with('records',
            $record);
    }

    public function ajaxSaveTestimonial(Request $request) {
        Temoignage::create($request->all());
        return response()->json(['success' => 'true']);
    }

    public function ajaxGetTestimonialById(Request $request) {
        $testimonial = Temoignage::find($request->id);
        return response()->json(['testimonial' => $testimonial]);
    }

    public function ajaxModifTestimonial(Request $request) {
        Temoignage::where('id', $request->id)->update(['contenu' => $request->contenu]);
        return response()->json(['success' => 'true']);
    }

    public function ajaxDropTestimonial(Request $request) {
        Temoignage::where('id', $request->id)->delete();
        return response()->json(['success' => 'true']);
    }

    public function relationApl() {
        $aplActive = User::find(Auth::user()->id);
        $allApl = RelationMembreApl::where('membre_id', Auth::user()->id)->get();
        return view('backend.user.apl_membre')->with('title', __('member.menu_relation_apl'))->with('aplActive',
            $aplActive)->with('allApl', $allApl);
        /*foreach($allApl as $record){
        echo $record->Users->name;
        }*/
    }

    public function ajaxDropRelation(Request $request) {
        User::where('id', $request->id_membre)->update(['apl_id' => 0, 'apl_ends_at' =>
            '']);
        return response()->json(['success' => 'true']);
    }

    public function ajaxRenewRelation(Request $request) {
        User::where('id', $request->id_membre)->update(['apl_ends_at' => \Carbon\Carbon::now()->addDays(Parameter::nbDayEndApl())]);

        return response()->json(['success' => 'true']);
    }
    
    public function setMemberIsMove(Request $request) {
        Auth::user()->is_move = 1;
        Auth::user()->save();

        return response()->json(['success' => 'true']);
    }

}
