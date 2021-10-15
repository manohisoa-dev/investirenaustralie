<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Order;
use App\Models\User;
use App\Models\Mail;
use App\Models\MailUser;
use App\Models\Localisation;
use App\Models\Role;
use App\Notifications\NewMail;
use App\Notifications\NotifyMessage;
use Auth;
use Validator;
use Session;
use DB;

class MessageController extends Controller {
    public function getAllMessage(Request $request, $role) {
        $user_id = Auth::user()->id;

        if ($role === 'admin') {
            $to_id = 1;
        }

        if ($role === 'afa') {
            $to_id = Auth::user()->afa_id;
        }

        $messages = Message::whereRaw("(from_id = " . $user_id . " AND to_id = $to_id ) OR (to_id = " .
            $user_id . " AND from_id = $to_id )")->orderBy('created_at', 'ASC')->get();

        $data = [];
        foreach ($messages as $message) {
            $data[] = ['id' => $message->id, 'from_id' => $message->from_id, 'from_name' =>
                User::where('id', $message->from_id)->first()->name, 'to_id' => $message->to_id,
                'body' => nl2br(e($message->body)), 'created_at' => $message->created_at,
                'created_at_send' => $message->created_at->diffForHumans(), 'seen' => $message->seen ?
                trans('app.txt.read') : trans('app.txt.unread'), ];
        }


        // // update message showing
        Message::where('from_id', $to_id)->where('to_id', Auth::user()->id)->update(['seen' =>
            1]);


        return json_encode($data);
    }

    public function getUnreadMessage(Request $request) {
        $unreadMessage = Message::unreadMessageMember(1);

        return response()->json(['res' => $unreadMessage]);
    }


    public function showContactMessage(Request $request, $to_id) {
        $from_id = $request->get('contact_id');

        $messages = Message::whereRaw("(from_id = " . $from_id . " AND to_id = $to_id ) OR (to_id = " .
            $from_id . " AND from_id = $to_id )")->orderBy('created_at', 'ASC')->get();

        $data = [];
        foreach ($messages as $message) {
            $data[] = ['id' => $message->id, 'from_id' => $message->from_id, 'from_name' =>
                User::where('id', $message->from_id)->first()->name, 'to_id' => $message->to_id,
                'body' => nl2br(($message->body)), 'created_at' => $message->created_at,
                'created_at_send' => $message->created_at->diffForHumans(), 'seen' => $message->seen ?
                trans('app.txt.read') : trans('app.txt.unread'), ];
        }
    }


    // update message showing
    Message::where('from_id', $from_id)->where('to_id', $to_id)->update(['seen' => 1]);


    return json_encode($data);
}


public function sendMessage(Request $request) {
    // Validate request
    $datas = $request->all();
    $validator = Validator::make($datas, ['content' => 'required|max:1000',
        //'files.*' => 'mimes:jpeg,jpg,png,gif,svg|max:2048',
        ]);

    if ($validator->passes()) {
        $current = Auth::user();

        $item = new Message();
        $item->type = 'admin';
        $item->from_id = $current->id;
        $item->body = $request->content;
        $item->to_id = $request->to_id;
        $item->save();

        return response()->json(['success' => trans('app.txt.message_sent')]);
    }

    return response()->json(['error' => $validator->errors()->all()]);
}


public function getListContactMessage(Request $request) {
    $user_id = Auth::user()->id;

    $lists = Message::where("to_id", $user_id)->join('users', 'users.id', '=',
        'messages.from_id')->select('messages.*', 'messages.created_at as dt',
        'users.name', 'users.immat', 'users.id as user_id', 'users.role')->orderBy('created_at',
        'ASC')->groupBy('from_id')->get();

    $data = [];
    foreach ($lists as $key => $list) {
        $data[$key] = ['name' => $list->name, 'immat' => $list->immat, 'dateSend' => $list->created_at->diffForHumans(),
            'user_id' => $list->user_id, 'user_role' => trans('app.' . Role::where('id', $list->role)->first
            ()->role_initial), ];
    }

    return response()->json($data);
}

public function getUnreadCountMessageContact(Request $request) {
    $user_id = Auth::user()->id;

    $unreadCount = Message::where("to_id", $user_id)->selectRaw('messages.from_id, COUNT(messages.id) as count')->whereRaw('seen = 0')->orderBy('created_at',
        'ASC')->groupBy('from_id')->get();


    return response()->json($unreadCount);
}
}
