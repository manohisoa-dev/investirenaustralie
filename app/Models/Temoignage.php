<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Temoignage extends Model {


    public $guarded = ["id","created_at","updated_at"];

    public static function findRequested()
    {
        $query = Temoignage::query();
        
        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('contenu') and $query->where('contenu','like','%'.\Request::input('contenu').'%');
        \Request::input('user_create') and $query->where('user_create',\Request::input('user_create'));
        \Request::input('pays') and $query->where('pays','like','%'.\Request::input('pays').'%');
        \Request::input('statut') and $query->where('statut','like','%'.\Request::input('statut').'%');
        \Request::input('created_at') and $query->where('created_at',\Request::input('created_at'));
        \Request::input('updated_at') and $query->where('updated_at',\Request::input('updated_at'));
        \Request::input('deleted_at') and $query->where('deleted_at',\Request::input('deleted_at'));
        
        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(15);
    }

    public static function validationRules( $attributes = null )
    {
        $rules = [
            'contenu' => 'required|string',
            'user_create' => 'required',
            'statut' => 'required|string|max:60',
            'deleted_at' => '',
        ];

        // no list is provided
        if(!$attributes)
            return $rules;

        // a single attribute is provided
        if(!is_array($attributes))
            return [ $attributes => $rules[$attributes] ];

        // a list of attributes is provided
        $newRules = [];
        foreach ( $attributes as $attr )
            $newRules[$attr] = $rules[$attr];
        return $newRules;
    }
    
    public function author()
    {
        return $this->belongsTo(User::class, 'user_create', 'id');
    }

}

