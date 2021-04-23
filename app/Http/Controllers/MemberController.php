<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;

use App\Notifications\NewMail;
use App\Notifications\AplChanged;
use App\Notifications\AfaChanged;
use App\Notifications\AfaCourriel;

use App\Models\Order;
use App\Models\User;
use App\Models\Mail;
use App\Models\MailUser;
use App\Models\Localisation;
use App\Models\Message;
use Session;

class MemberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:5');
    }

    /**
     * Liste des commandes en attente
     *
     * @return \Illuminate\Http\Response
     */
    public function carts()
    {
        $items = Auth::user()->orders()
            ->where('status', 'pinged')
            ->paginate($this->pageSize);
        
        return view('backend.sale.all')
            ->with('title', __('member.carts'))
            ->with('items', $items);
    }

    /**
     * Liste des commandes en cours d'achat effectue par le client
     *
     * @return \Illuminate\Http\Response
     */
    public function orders()
    {
        $items = Auth::user()->orders()
            ->where('status', 'ordered')
            ->paginate($this->pageSize);
        $lapls = Localisation::select('localizations.*')
        ->join('users','users.location_id','=','localizations.id')
        ->where('users.role','=','4')
        ->groupBy('localizations.locality')
        ->get();
        
        return view('backend.sale.all')
            ->with('title', __('member.orders'))
            ->with('lapls', $lapls)
            ->with('items', $items);
    }

    /**
     * Liste des achats effectues par le client
     *
     * @return \Illuminate\Http\Response
     */
    public function purchases()
    {
        $items = Auth::user()->orders()
            ->where('status', 'paid')
            ->paginate($this->pageSize);
        $lapls = Localisation::select('localizations.*')
            ->join('users','users.location_id','=','localizations.id')
            ->where('users.role','=','4')
            ->groupBy('localizations.locality')
            ->get();
        
        return view('backend.sale.all')
            ->with('title', __('member.purchases'))
            ->with('lapls', $lapls)
            ->with('items', $items);
    }

    public function contact(Request $request, $role){
        $action = route('member.send.message', ['role'=>$role]);
        $lapls = Localisation::select('localizations.*')
            ->join('users','users.location_id','=','localizations.id')
            ->where('users.role','=','4')
            ->groupBy('localizations.locality')
            ->get();
        $apls = User::ofRole(4)->isActive()->get();
        $user_name = "";

        if($request->get('afa'))
        $user_name = $request->get('afa');

        if($request->get('apl'))
        $user_name = $request->get('apl');
        
        if(($role=='apl') && !Auth::user()->apl){
            return redirect()->route('member.select.apl')
                ->with('error', trans('app.txt.choose_an_apl'));
        }

        $lafas = User::where('role',3)
            ->where('status','active')
            ->where('location_id',Auth::user()->location_id)
            ->orderBy('id','desc')
            ->get();
        
        return view('backend.contact.member')
            ->with('action', $action)
            ->with('lapls', $lapls)
            ->with('lafas', $lafas)
            ->with('apls', $apls)
            ->with('role', $role)
            ->with('user_name', $user_name)
            ->with('title', __('app.contact_'.$role));
    }

    public function sendMessage(Request $request, $role)
    {
        $current = Auth::user();
        $to_id = $request->to;

        // Validate request
        $datas = $request->all();
        $validator = Validator::make($datas,[
            'content' => 'required|max:1000',
            //'files.*' => 'mimes:jpeg,jpg,png,gif,svg|max:2048',
        ]);

        if ($validator->passes()) {

            $item = new Message();
            $item->type = 'user';
            $item->from_id = $current->id;
            $item->body = $request->content;
            if($to_id === 'admin'){
                $item->to_id = 1;
            }else{
                $item->to_id = $request->to_id;
            }

            $item->save();

			return response()->json(['success'=>trans('app.txt.message_sent')]);
        }

    	return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function sendMail(Request $request, $role)
    {
        
        if(($role=='apl') && !Auth::user()->apl){
            return redirect()->route('member.select.apl')
                ->with('error', 'Vous devez choisir un APL d\'abord.');
        }
        
        $current = Auth::user();

        // Validate request
        $datas = $request->all();
        $validator = Validator::make($datas,[
            'subject' => 'required|max:100',
            'content' => 'required|max:1000',
            //'files.*' => 'mimes:jpeg,jpg,png,gif,svg|max:2048',
        ]);
        
        
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        if($role=='admin'){
            $receiver = User::ofRole('admin')
                    ->isActive()
                    ->first();
            if(!$receiver){
                return back()->with('error', 'Une erreur est survenue.');
            }
            $to = option('site.admin_email', $receiver->email);
            $toName = option('site.admin_name', $receiver->name);
        }else if($role=='apl'){
            $receiver = $current->apl;
            if(!$receiver||!$receiver->active()){
                return back()->with('error', 'Une erreur est survenue.');
            }
            $to = $receiver->email;
            $toName = $receiver->name;
        }else{
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

        try{
            $receiver->notify(new NewMail($item));
        }catch(\Exception $e){}
        
        $to = 'joelinjatovo@gmail.com';
        
        $files = $request->file('files');
        if(!$files){
            $files = [];
        }
        try{
            $data = array(
                'name'    => $toName,
                'content' => $item->content
            );
            \Mail::send('mail', $data, function($message) use($item, $to, $toName, $files) {
                
                $message->to($to, $toName);
                $message->subject($item->subject.' '.count($files));
                $message->from($item->sender->email, $item->sender->name);
                
                if(count($files)>0) {
                    foreach($files as $file) {
                        $message->attach($file->getRealPath(), array(
                            'as' => $file->getClientOriginalName(), // If you want you can change original name to custom name      
                            'mime' => $file->getMimeType())
                        );
                    }
                }
            });
            
            \Mail::send('mail', $data, function($message) {
                $message->to('joelinjatovo@gmail.com', 'Tutorials Point');
                $message->subject('AFTER MAIL');
                $message->from('joelinjatovo@gmail.com','Virat Gandhi');
            });
            
        }catch(\Exception $e){
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
    public function contactAfa(Request $request){
        $this->middleware('auth');
        $this->middleware('role:member');

        if(Auth::user()->hasAfa()){
            return redirect(url()->previous())
                ->with('has_afa',trans('app.txt.member_has_afa'));
        }
        else{
            return redirect()->route('member.select.afa')
                ->with('info', trans('app.txt.choose_an_afa'));
        }
    }
    
    
    /**
     * Add product in cart
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product
     * @return \Illuminate\Http\Response
     */
    public function selectApl(Request $request){
        $this->middleware('auth');
        $this->middleware('role:member');

        // check if user has apl or add if user has no apl
        $message="";
        if($request->get('apl')){
            if(Auth::user()->hasApl()){
                $message = trans('app.txt.member_has_apl', ['apl'=>User::find(Auth::user()->apl_id)->name]);
            }else{
                // // Add APL on member
                User::whereId(Auth::id())->update(['apl_id'=>$request->get('apl'), 'apl_ends_at'=>\Carbon\Carbon::now()->addDays(180)]);

                $message = trans('app.txt.member_has_new_apl', ['apl'=>User::find($request->get('apl'))->name]);
            }
        }
        
        
        $distance = $request->get('distance');
        if(empty($distance)) $distance = 100;
        
        $data = [];
        
        $apls = User::ofRole(4)
            ->isActive()
            ->has('location')
            ->with('location')
            ->get();

        $lapls = Localisation::select('localizations.*')
            ->join('users','users.location_id','=','localizations.id')
            ->where('users.role','=','4')
            ->groupBy('localizations.locality')
            ->get();
        
        $userApl = Auth::user()->apl;
        
        $selected = null;
        
        foreach($apls as $item){
            $html = view('backend.apl.html')->with('item', $item)->render();
            $dataTemp = [
              'id' => $item->id,
              'lat' => $item->location?$item->location->latitude:0,
              'lng' => $item->location?$item->location->longitude:0,
              'title' => $item->name,
              'content' => $item->get_meta('orga_description')?$item->get_meta('orga_description')->value:'',
              'type' => $item->role,
              'html' => $html,
            ];
            
            $data[] = $dataTemp;
            
            if($userApl && ($item->id == $userApl->id)){
                $selected = $dataTemp;
            }
        }
        
        $action = route('member.select.apl');

    	return view('backend.apl.select')
            ->with('location', Auth::user()->location)
            ->with('action', $action)
            ->with('items', $apls)
            ->with('distance', $distance)
            ->with('lapls', $lapls)
            ->with('distances', $this->distances)
            ->with('selected', json_encode($selected))
            ->with('message', $message)
            ->with('data', json_encode($data));
    }
    
    
    /**
     * Update APl
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product
     * @return \Illuminate\Http\Response
     */
    public function updateApl(Request $request){
        $this->middleware('auth');
        $this->middleware('role:5');

        $apl = null;
        if($request->has('apl')){
            $apl = User::ofRole('apl')
                ->isActive()
                ->where('id', '=', $request->apl)
                ->first();
        }else{
            return back()->withInput()
                ->with('error','Vous devez choisir un apl.');
        }
        
        // No APL selected
        if(!$apl){
    	   return back()->withInput()
               ->with('error','Vous devez choisir un apl.');
        }
        
        if(!$request->input('confirm')){
            return back()->withInput()
               ->with('error','Vous devez accepter les termes et les conditions.');
        }
        
        // Update APL
        Auth::user()->apl_id = $apl->id;
        Auth::user()->apl_ends_at = \Carbon\Carbon::now()->addDays(option('payment.apl_ends_at', 180));
        Auth::user()->save();
        
        try{
            Auth::user()->notify(new AplChanged(Auth::user(), false));
        }catch(\Exception $e){}
        
        try{
            $apl->notify(new AplChanged(Auth::user(), true));
        }catch(\Exception $e){}
        
    	return back()
            ->with('success', 'Apl modifié!');
    }

    /**
     * Select afa
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product
     * @return \Illuminate\Http\Response
     */
    public function selectAfa(Request $request){
        $this->middleware('auth');
        $this->middleware('role:member');
        
        $distance = $request->get('distance');
        if(empty($distance)) $distance = 100;
        
        $data = [];
        
        $afas = User::ofRole(3)
            ->isActive()
            ->has('location')
            ->with('location')
            ->get();
        $lapls = Localisation::select('localizations.*')
            ->join('users','users.location_id','=','localizations.id')
            ->where('users.role','=','4')
            ->groupBy('localizations.locality')
            ->get();
        
        $userApl = Auth::user()->apl;
        
        $selected = null;
        
        foreach($afas as $item){
            $html = view('backend.afa.html')->with('item', $item)->render();
            $dataTemp = [
              'id' => $item->id,
              'lat' => $item->location?$item->location->latitude:0,
              'lng' => $item->location?$item->location->longitude:0,
              'title' => $item->name,
              'content' => $item->get_meta('orga_description')?$item->get_meta('orga_description')->value:'',
              'type' => $item->role,
              'html' => $html,
            ];
            
            $data[] = $dataTemp;
            
            if($userApl && ($item->id == $userApl->id)){
                $selected = $dataTemp;
            }
        }
        
        $action = route('member.select.afa');

    	return view('backend.afa.select')
            ->with('location', Auth::user()->location)
            ->with('action', $action)
            ->with('items', $afas)
            ->with('distance', $distance)
            ->with('lapls', $lapls)
            ->with('distances', $this->distances)
            ->with('selected', json_encode($selected))
            ->with('data', json_encode($data));
    }


    /**
     * Update AFA
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product
     * @return \Illuminate\Http\Response
     */
    public function updateAfa(Request $request){
        $this->middleware('auth');
        $this->middleware('role:5');

        $afa = null;

        if($request->has('afa')){
            $afa = User::ofRole('3')
                ->isActive()
                ->where('id', '=', $request->afa)
                ->first();
        }else{
            return back()->withInput()
                ->with('error', trans('app.txt.choose_an_afa'));
        }
        
        // No AFA selected
        if(!$afa){
    	   return back()->withInput()
               ->with('error', trans('app.txt.choose_an_afa'));
        }
        
        if(!$request->input('confirm')){
            return back()->withInput()
               ->with('error', trans('app.txt.mustagreeterme'));
        }
        
        // Update AFA
        Auth::user()->afa_id = $afa->id;
        // Auth::user()->afa_ends_at = \Carbon\Carbon::now()->addDays(option('payment.afa_ends_at', 180));
        Auth::user()->save();
        
        // Notify User
        try{
            Auth::user()->notify(new AfaChanged(Auth::user(), false));
        }catch(\Exception $e){}
        
        // Nofity AFA
        try{
            $afa->notify(new AfaChanged(Auth::user(), true));
        }catch(\Exception $e){}
        
    	return back()
            ->with('success', trans('app.txt.info_saved'));
    }


    /**
     * Select afa
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product
     * @return \Illuminate\Http\Response
     */
    public function goThere(Request $request){
        $this->middleware('auth');
        $this->middleware('role:5');
        
        if(Auth::user()->hasAfa()){
            return redirect(url()->previous())
                ->with('engagement',trans('afa.condition_deplacement_afa', ['afa'=>Auth::user()?Auth::user()->afa->name:'']));
        }
        else{
            return redirect()->route('member.select.afa')
                ->with('error', trans('app.txt.choose_an_afa'));
        }
    }


    /**
     * Send Courriel for member
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product
     * @return \Illuminate\Http\Response
     */
    public function sendCourriel(Request $request){
        $this->middleware('auth');
        $this->middleware('role:5');
        session()->forget('engagement');

        // Update info member
            Auth::user()->is_move = 1;
            Auth::user()->save();
        
        // Notify User
        Auth::user()->notify(new AfaCourriel(Auth::user(), Auth::user()->afa->name));

        try {
            return redirect(url()->previous())
                ->with('engagement',trans('afa.notif_after_send_mail'))
                ->with('mail_send',"send");
        } catch (\Exception $exception) {
            
        }
        
    }




}
