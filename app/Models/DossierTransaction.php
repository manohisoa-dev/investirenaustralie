<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;

class DossierTransaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['numero', 'user_id', 'product_id', 'status', 'created_at', 'updated_at'];


    public function users(){
        return $this->belongsToMany(User::class, 'id', 'user_id');
    }

    public function products(){
        return $this->belongsToMany(Product::class, 'id', 'product_id');
    }   
}
