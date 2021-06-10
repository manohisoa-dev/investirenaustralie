<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use SoftDeletes;
    public $guarded = ["id","created_at","updated_at"];
    protected $fillable=[
        'id',
        'content',
        'image_id'
    ];
    protected $dates = ['deleted_at'];

    public static function findRequested()
    {
        $query = Slider::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('content') and $query->where('content','like','%'.\Request::input('content').'%');
        \Request::input('type') and $query->where('type','like','%'.\Request::input('type').'%');
        \Request::input('status') and $query->where('status',\Request::input('status'));
        \Request::input('image_id') and $query->where('image_id',\Request::input('image_id'));
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
            'content' => 'string|max:191',
            'type' => 'required|string|max:191',
            'status' => 'integer',
            'image_id' => 'required',
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
     * An user can have any info
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->belongsTo(Image::class,'image_id','id');
    }

    /**
     * A slider is image || pub || video
     *
     * @return Boolean
     */
    public function hasSlider($type)
    {
      return ($this->type == $type);
    }
}
