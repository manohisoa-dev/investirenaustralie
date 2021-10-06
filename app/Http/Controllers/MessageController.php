<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use Session;
use DB;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Order;
use App\Models\User;
use App\Models\Email;
use App\Models\MailUser;
use App\Models\Localisation;
use App\Models\Role;
use App\Notifications\NewMail;
use App\Notifications\NotifyMessage;



class MessageController extends Controller
{
    public function getAllMessage(Request $request, $role){
        $user_id=Auth::user()->id;
        $hasSendCa = "";

        if($role==='admin'){
            $to_id=1;
        }

        if($role==='afa'){
            $to_id= Auth::user()->afa_id;
        }

        if($role==='apl'){
            $to_id= Auth::user()->apl_id;
        }

        $messages = Message::whereRaw("(from_id = ".$user_id." AND to_id = $to_id ) OR (to_id = ".$user_id." AND from_id = $to_id )" )
                            ->orderBy('created_at', 'ASC')
                            ->get();
        
        if(Auth::user()->hasRole(5) && $user_id !== '1'){
            //$hasSendCa = Auth::user()->afaHasSendCa($user_id,$to_id)?1:0; // 0: CA not send  1:CA send 
        }

        $data = [];
        foreach($messages as $message){
            $data[] = [
                'id' => $message->id,
                'from_id' => $message->from_id,
                'from_immat' => User::where('id',$message->from_id)->first()->immat,
                'from_name' => User::where('id',$message->from_id)->first()->name,
                'to_id' => $message->to_id,
                'body' => nl2br(e($message->body)),
                'created_at' => $message->created_at,
                'created_at_send' => $message->created_at->diffForHumans(),
                'seen' => $message->seen? trans('app.txt.read') : trans('app.txt.unread'),
                'hasSendCa' => $hasSendCa
            ];
        }

        
        // // update message showing
        Message::where('from_id',$to_id)->where('to_id', Auth::user()->id)->update(['seen' => 1]);
        

        return json_encode($data);
    }

    public function getUnreadMessage(Request $request, $user_id){
        $role = Auth::user()->role;

        $unreadCountAdmin = '';
        $unreadCountAfa = '';
        $unreadCountApl = '';
        $unreadCount = '';
        $data = [];

        if($role == 5){
            if(isset(Message::unreadCount($user_id , 1)->count)){
                $unreadCountAdmin = Message::unreadCount($user_id, 1)->count;
            }
            
            if(isset(Message::unreadCount($user_id , User::where('id', $user_id)->first()->afa_id)->count)){
                $unreadCountAfa = Message::unreadCount($user_id, User::where('id', $user_id)->first()->afa_id)->count;
            }
            
            if(isset(Message::unreadCount($user_id , User::where('id', $user_id)->first()->apl_id)->count)){
                $unreadCountApl = Message::unreadCount($user_id, User::where('id', $user_id)->first()->apl_id)->count;
            }
            
            $data = [
                'role_id'=>$role, 
                'unreadCountAdmin'=>$unreadCountAdmin, 
                'unreadCountAfa'=>$unreadCountAfa, 
                'unreadCountApl'=>$unreadCountApl, 
            ];

        }else{
            if(isset(Message::unreadCountAfa(Auth::user()->id)->count)){
            $unreadCount = Message::unreadCountAfa(Auth::user()->id)->count;
            }

            $data = [
                'role_id'=>$role, 
                'unreadCount'=>$unreadCount,
            ];
        }
        

        return response()->json(['res'=>$data]);
    }


    public function showContactMessage(Request $request ,$to_id){
        $from_id = $request->get('contact_id');
        $hasSendCa = "";

        $messages = Message::whereRaw("(from_id = ".$from_id." AND to_id = $to_id ) OR (to_id = ".$from_id." AND from_id = $to_id )" )
                            ->orderBy('created_at', 'ASC')
                            ->get();

        if(Auth::user()->hasRole(3) && $from_id !== '1'){
            //$hasSendCa = Auth::user()->afaHasSendCa($from_id,$to_id)?1:0; // 0: CA not send  1:CA send 
        }

        $data = [];
        foreach($messages as $message){
            $data[] = [
                'id' => $message->id,
                'from_id' => $message->from_id,
                'from_immat' => User::where('id',$message->from_id)->first()->immat,
                'from_name' => User::where('id',$message->from_id)->first()->name,
                'to_id' => $message->to_id,
                'body' => nl2br(e($message->body)),
                'created_at' => $message->created_at,
                'created_at_send' => $message->created_at->diffForHumans(),
                'seen' => $message->seen? trans('app.txt.read') : trans('app.txt.unread'),
                'hasSendCa' => $hasSendCa,
            ];
        }

        
        // update message showing
        Message::where('from_id',$from_id)->where('to_id', $to_id)->update(['seen' => 1]);
        

        return json_encode($data);
    }


    public function sendMessage(Request $request, $role)
    {
        // Validate request
        $datas = $request->all();
        $validator = Validator::make($datas,[
            'content' => 'required|max:1000',
            //'files.*' => 'mimes:jpeg,jpg,png,gif,svg|max:2048',
        ]);

        
        if ($validator->passes()) {
            $current = Auth::user();

            $item = new Message();
            $item->type = 'user';
            $item->from_id = $current->id;
            $item->body = $request->content;

            if($request->get('to_id')){
                $item->to_id = $request->get('to_id');
            }
            else{
                if($role === 'admin'){
                    $item->to_id = 1;
                }else if($role === 'afa'){
                    $item->to_id = $current->afa_id;
                }else{
                    $item->to_id = $current->apl_id;
                }
            }

            $item->save();

            // Notification user
            // try{
            //     $user->notify(new NotifyMessage(Auth::user()));
            // }catch(\Exception $e){}

			return response()->json(['success'=>trans('app.txt.message_sent')]);
        }

    	return response()->json(['error'=>$validator->errors()->all()]);

    }


    public function getListContactMessage(Request $request){
        $user_id= Auth::user()->id;

        $lists = Message::where("to_id", $user_id)
        ->join('users', 'users.id','=','messages.from_id')
        ->select('messages.*', 'messages.created_at as dt' , 'users.name', 'users.immat', 'users.id as user_id', 'users.role')
        ->orderBy('created_at' , 'ASC')
        ->groupBy('from_id')
        ->get();

        $data = [];
        foreach ($lists as $key=>$list) {
            $data[$key] = [
                'name' => $list->name,
                'dateSend' => $list->created_at->diffForHumans(),
                'user_id' => $list->user_id,
                'user_immat' => $list->immat,
                'user_role'=> trans('app.'.Role::where('id', $list->role)->first()->role_initial),
            ];
        }

        return response()->json($data);
    }

    public function getUnreadCountMessageContact(Request $request){
        $user_id=Auth::user()->id;

        $unreadCount = Message::where("to_id", $user_id)
        ->selectRaw('messages.from_id, COUNT(messages.id) as count')
        ->whereRaw('seen = 0')
        ->orderBy('created_at' , 'ASC')
        ->groupBy('from_id')
        ->get();
        

        return response()->json($unreadCount);
    }

    public function getUnreadMessageNotification(Request $request, $user_id){
        
        // $unreadCountNotification = Message::unreadCountNotification($user_id)->count;
        $data = Message::unreadMessageNotification($user_id);
            
        return response()->json(['res'=>$data]);
    }
}
