<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $fillable = ['id', 'type', 'from_id', 'to_id', 'body', 'attachment', 'seen'];

}
