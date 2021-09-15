<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EoiDossier extends Model
{
    protected $table = 'product_eoi';
    
    /**
     * Get the type record associated with the product.
     */
    public function photo()
    {
        return $this->belongsToMany(Image::class, 'product_eoi', 'product_id', 'image_id');
    }

    public function image()
    {
        return $this->belongsToMany(Image::class, 'product_eoi', 'id', 'image_id');
    }
}
