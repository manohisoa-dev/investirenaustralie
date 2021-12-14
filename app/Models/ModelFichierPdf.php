<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ModelFichierPdf extends Model {


    public $guarded = ["id","created_at","updated_at"];

    public static function findRequested()
    {
        $query = ModelFichierPdf::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('pdf_titre') and $query->where('pdf_titre','like','%'.\Request::input('pdf_titre').'%');
        \Request::input('contenu_fr') and $query->where('contenu_fr','like','%'.\Request::input('contenu_fr').'%');
        \Request::input('contenu_en') and $query->where('contenu_en','like','%'.\Request::input('contenu_en').'%');
        \Request::input('params') and $query->where('params','like','%'.\Request::input('params').'%');
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
            'pdf_titre' => 'required|string|max:255',
            'contenu_fr' => 'required|string',
            'contenu_en' => 'required|string',
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

