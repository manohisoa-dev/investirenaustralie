<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Mail extends Model {


    public $guarded = ["id","created_at","updated_at"];

    public static function findRequested()
    {
        $query = Mail::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('subject') and $query->where('subject','like','%'.\Request::input('subject').'%');
        \Request::input('content') and $query->where('content','like','%'.\Request::input('content').'%');
        \Request::input('copied_from') and $query->where('copied_from',\Request::input('copied_from'));
        \Request::input('status') and $query->where('status','like','%'.\Request::input('status').'%');
        \Request::input('sender_id') and $query->where('sender_id',\Request::input('sender_id'));
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
            'subject' => 'string',
            'content' => 'string',
            'copied_from' => 'required',
            'status' => 'required|string|max:20',
            'sender_id' => 'required',
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

