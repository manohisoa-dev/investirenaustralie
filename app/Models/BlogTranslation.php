<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTranslation extends Model
{
    protected $fillable=[
        'id',
        'blog_id',
        'translation_id',
    ];
}
