<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MandatRecherche extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['file_name', 'path', 'product_id', 'from_id', 'to_id', 'afa_id', 'status', 'created_at', 'updated_at'];

    public function products(){
        return $this->hasMany(Product::class, 'id', 'product_id');
    }   

    public function scopeGetAllFolders(){
        return $this->where('to_id',Auth::user()->id)->get();
    }
}
