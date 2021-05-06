<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $fillable = ['id', 'type', 'from_id', 'to_id', 'body', 'attachment', 'seen'];


    public static function unreadCount(int $user_id, int $from_id){
        return Message::where('to_id', $user_id)
        ->where('from_id', $from_id)
        ->groupBy('from_id')
        ->selectRaw('from_id, COUNT(id) as count')
        ->whereRaw('seen = 0')
        ->first();
    }

    public static function unreadCountAfa(int $user_id){
        return Message::where('to_id', $user_id)
        ->selectRaw('from_id, COUNT(id) as count')
        ->whereRaw('seen = 0')
        ->first();
    }

}
