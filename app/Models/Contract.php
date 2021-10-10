<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = "contracts";
    protected $fillable = ['user_id', 'url_contract', 'status_contract', 'date_envoie_contract', 'date_signature_contract', 'date_fin_reponse_contract', 'created_at', 'updated_at'];

    public static function getAllContractRejected(){
        return Contract::where("status_contract", 3)
            ->orderBy('updated_at' , 'DESC')
            ->groupBy('user_id')
            ->get();
    }

}
