<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Plan extends Model {


    public $guarded = ["id","created_at","updated_at"];

    public static function findRequested()
    {
        $query = Plan::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('slug') and $query->where('slug','like','%'.\Request::input('slug').'%');
        \Request::input('name') and $query->where('name','like','%'.\Request::input('name').'%');
        \Request::input('cost') and $query->where('cost',\Request::input('cost'));
        \Request::input('description') and $query->where('description','like','%'.\Request::input('description').'%');
        \Request::input('type') and $query->where('type','like','%'.\Request::input('type').'%');
        \Request::input('role') and $query->where('role','like','%'.\Request::input('role').'%');
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
            'slug' => 'required|string|max:191',
            'name' => 'required|string|max:191',
            'cost' => 'required',
            'description' => 'string',
            'type' => 'required|string|max:20',
            'role' => 'required|string|max:20',
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

