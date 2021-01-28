<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Blog extends Model {


    public $guarded = ["id","created_at","updated_at"];

    public static function findRequested()
    {
        $query = Blog::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('slug') and $query->where('slug','like','%'.\Request::input('slug').'%');
        \Request::input('title') and $query->where('title','like','%'.\Request::input('title').'%');
        \Request::input('content') and $query->where('content',\Request::input('content'));
        \Request::input('meta_tag') and $query->where('meta_tag','like','%'.\Request::input('meta_tag').'%');
        \Request::input('meta_description') and $query->where('meta_description','like','%'.\Request::input('meta_description').'%');
        \Request::input('view_count') and $query->where('view_count',\Request::input('view_count'));
        \Request::input('status') and $query->where('status','like','%'.\Request::input('status').'%');
        \Request::input('starred') and $query->where('starred',\Request::input('starred'));
        \Request::input('post_type') and $query->where('post_type','like','%'.\Request::input('post_type').'%');
        \Request::input('image_id') and $query->where('image_id',\Request::input('image_id'));
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
            'slug' => 'required|string|max:150',
            'title' => 'string|max:150',
            'content' => '',
            'meta_tag' => 'string|max:191',
            'meta_description' => 'string|max:191',
            'view_count' => 'required',
            'status' => 'required|string|max:20',
            'starred' => 'required|integer',
            'post_type' => 'required|string|max:150',
            'image_id' => 'required',
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

