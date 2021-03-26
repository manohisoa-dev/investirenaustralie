<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageImage extends Model
{
    protected $fillable=[
        'id',
        'page_id',
        'image_id'
    ];
}
