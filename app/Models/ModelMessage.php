<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelMessage extends Model {

    use SoftDeletes;
    public $guarded = ["id","created_at","updated_at"];
    protected $dates = ['deleted_at'];
    
    public static function findRequested()
    {
        $query = ModelMessage::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('titre') and $query->where('titre','like','%'.\Request::input('titre').'%');
        \Request::input('message_fr') and $query->where('message_fr','like','%'.\Request::input('message_fr').'%');
        \Request::input('message_en') and $query->where('message_en','like','%'.\Request::input('message_en').'%');
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
            'titre' => 'required|string|max:255',
            'message_fr' => 'required|string',
            'message_en' => 'required|string',
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

