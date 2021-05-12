<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsImage extends Model
{
    protected $table = 'products_images';
    
    /**
     * Get the type record associated with the product.
     */
    public function photo()
    {
        return $this->belongsToMany(Image::class, 'products_images', 'product_id', 'image_id');
    }
}
