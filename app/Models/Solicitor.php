<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Solicitor extends Model {

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $guarded = ["id","created_at","updated_at"];

    public static function validationRules( $attributes = null )
    {
        $rules = [
            'cabinet_name' => 'required',
            'cabinet_cp' => 'required',
            'cabinet_email' => 'required',
            'cabinet_phone' => 'required',
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

