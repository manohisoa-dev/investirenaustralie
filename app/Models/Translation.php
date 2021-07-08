<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $fillable=[
        'id',
        'trans_key',
        'lang',
        'content',
    ];
}
