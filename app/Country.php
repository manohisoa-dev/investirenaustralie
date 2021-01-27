<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Country extends Model {


    public $guarded = ["id","created_at","updated_at"];

    public static function findRequested()
    {
        $query = Country::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('code') and $query->where('code','like','%'.\Request::input('code').'%');
        \Request::input('content') and $query->where('content','like','%'.\Request::input('content').'%');
        \Request::input('prefixPhone') and $query->where('prefixPhone','like','%'.\Request::input('prefixPhone').'%');
        \Request::input('placeholder') and $query->where('placeholder','like','%'.\Request::input('placeholder').'%');
        \Request::input('created_at') and $query->where('created_at',\Request::input('created_at'));
        \Request::input('updated_at') and $query->where('updated_at',\Request::input('updated_at'));
        
        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(Config::get('constants.perpage.admin'));
    }

    public static function validationRules( $attributes = null )
    {
        $rules = [
            'code' => 'string|max:191',
            'content' => 'string|max:191',
            'prefixPhone' => 'string|max:191',
            'placeholder' => 'string|max:191',
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

}

