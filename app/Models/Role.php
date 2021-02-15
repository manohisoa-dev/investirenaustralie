<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Role extends Model {


    public $guarded = ["id","created_at","updated_at"];
    protected $fillable = ['role_name', 'role_initial'];

    public static function findRequested()
    {
        $query = Role::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('role_name') and $query->where('role_name','like','%'.\Request::input('role_name').'%');
        \Request::input('role_initial') and $query->where('role_initial','like','%'.\Request::input('role_initial').'%');
        
        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(15);
    }

    public static function validationRules( $attributes = null )
    {
        $rules = [
            'role_name' => 'required|string|max:100',
            'role_initial' => 'required|string|max:60',
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
    
    /**
     * An user can have any role
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->belongsTo(User::class,'role','id');
    }

}

