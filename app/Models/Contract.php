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

    public static function getAllContractToBeValidated(){
        return Contract::where("status_contract",'=', 1)->get();
    }
    
    public static function findRequested()
    {
        $query = Contract::query()->where('status_contract',1);
        $user = User::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('user_id') and $query->where('user_id','like','%'.\Request::input('user_id').'%');
        \Request::input('url_contract') and $query->where('url_contract','like','%'.\Request::input('url_contract').'%');
        
        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(15);
    }

    
    
}
