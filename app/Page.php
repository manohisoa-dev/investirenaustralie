<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Page extends Model {


    public $guarded = ["id","created_at","updated_at"];

    public static function findRequested()
    {
        $query = Page::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('title') and $query->where('title','like','%'.\Request::input('title').'%');
        \Request::input('content') and $query->where('content',\Request::input('content'));
        \Request::input('path') and $query->where('path','like','%'.\Request::input('path').'%');
        \Request::input('page_order') and $query->where('page_order',\Request::input('page_order'));
        \Request::input('is_pub') and $query->where('is_pub',\Request::input('is_pub'));
        \Request::input('language') and $query->where('language','like','%'.\Request::input('language').'%');
        \Request::input('parent_id') and $query->where('parent_id',\Request::input('parent_id'));
        \Request::input('author_id') and $query->where('author_id',\Request::input('author_id'));
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
            'title' => 'required|string|max:150',
            'content' => '',
            'path' => 'string|max:191',
            'page_order' => 'integer',
            'is_pub' => 'required|integer',
            'language' => 'required|string|max:2',
            'parent_id' => 'required',
            'author_id' => 'required',
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

