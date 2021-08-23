<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiaDossier extends Model
{
    protected $table = 'product_lia';
    
    /**
     * Get the type record associated with the product.
     */
    public function photo()
    {
        return $this->belongsToMany(Image::class, 'product_lia', 'product_id', 'image_id');
    }
}
