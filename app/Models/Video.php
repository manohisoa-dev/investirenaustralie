<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Video extends Model {


    public $guarded = ["id","created_at","updated_at"];

    public static function findRequested()
    {
        $query = Video::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('video_titre') and $query->where('video_titre',\Request::input('video_titre'));
        \Request::input('type_source') and $query->where('type_source',\Request::input('type_source'));
        \Request::input('video_url') and $query->where('video_url','like','%'.\Request::input('video_url').'%');
        \Request::input('video_path') and $query->where('video_path','like','%'.\Request::input('video_path').'%');
        \Request::input('created_at') and $query->where('created_at',\Request::input('created_at'));
        \Request::input('updated_at') and $query->where('updated_at',\Request::input('updated_at'));
        
        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(15);
    }

    public static function validationRules( $attributes = null )
    {
        $rules = [
            'video_titre' => 'required|string',
            'type_source' => 'required',
            'video_url' => 'string',
            'video_path' => 'string',
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

