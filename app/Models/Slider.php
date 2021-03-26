<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Slider extends Model
{
    protected $fillable=[
        'id',
        'content',
        'image_id'
    ];


    /**
     * An user can have any info
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->belongsTo(Image::class,'image_id','id');
    }
}
