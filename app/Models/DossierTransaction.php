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

    public static function updateDossierTransaction($user_id,$prod_id,$is_complete){
        return DossierTransaction::where('user_id','=',$user_id)->where('product_id','=',$prod_id)->update(['is_complete' => 1]);
    }

    public static function toBeCompleted($prod_id,$user_id){
        $isComplete = DossierTransaction::where('user_id','=',$user_id)->where('product_id','=',$prod_id)->pluck('is_complete');

        if($isComplete !== ""){
            if($isComplete[0]===1){
                return true;
            }
        }

        return false;
    }

    public static function getDossierTransactionId($prod_id,$user_id){
        return DossierTransaction::where('user_id','=',$user_id)->where('product_id','=',$prod_id)->pluck('id')[0];
    }

    public static function getDossierTransactionInfo($prod_id,$user_id){
        return DossierTransaction::where('user_id','=',$user_id)->where('product_id','=',$prod_id)->first();
    }
    
    public static function getDossierTransactionWaiting(){
        return DossierTransaction::where('status','=',5)->get();
    }

}
