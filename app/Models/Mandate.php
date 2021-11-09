<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Mandate extends Model {


    public $guarded = ["id","created_at","updated_at"];

    public static function findRequested()
    {
        $query = Mandate::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('state_id') and $query->where('state_id',\Request::input('state_id'));
        \Request::input('mandate_name') and $query->where('mandate_name','like','%'.\Request::input('mandate_name').'%');
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
            'state_id' => 'required',
            'mandate_name' => 'required|string|max:255',
            'images_id' => 'required',
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
    
    public function state()
    {
        return $this->belongsTo(State::class,'state_id','id');
    }
    
    public function image()
    {
        return $this->belongsTo(Image::class, 'images_id', 'id');
    }

}

