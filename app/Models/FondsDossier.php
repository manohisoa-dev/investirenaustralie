<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FondsDossier extends Model
{
    protected $table = 'products_fond_dossier';
    
    /**
     * Get the type record associated with the product.
     */
    public function photo()
    {
        return $this->belongsToMany(Image::class, 'products_fond_dossier', 'product_id', 'image_id');
    }
}
