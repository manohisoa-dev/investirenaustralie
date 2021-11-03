<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class MailsTemplate extends Model {

    protected $table = 'mails_template';
    public $guarded = ["id","created_at","updated_at"];

    public static function findRequested()
    {
        $query = MailsTemplate::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('titre') and $query->where('titre','like','%'.\Request::input('titre').'%');
        \Request::input('sujet_fr') and $query->where('sujet_fr','like','%'.\Request::input('sujet_fr').'%');
        \Request::input('template_fr') and $query->where('template_fr','like','%'.\Request::input('template_fr').'%');
        \Request::input('sujet_en') and $query->where('sujet_en','like','%'.\Request::input('sujet_en').'%');
        \Request::input('template_en') and $query->where('template_en','like','%'.\Request::input('template_en').'%');
        \Request::input('params') and $query->where('params','like','%'.\Request::input('params').'%');
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
            'sujet_fr' => 'required|string|max:255',
            'template_fr' => 'required|string',
            'sujet_en' => 'required|string|max:255',
            'template_en' => 'required|string',
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
    
    public static function set_content_email($id_email)
    {
        $template = MailsTemplate::where('id', $id_email)->get();
        return $template;
    }

}

