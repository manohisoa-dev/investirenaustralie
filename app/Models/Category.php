<?php
namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model {

    use SoftDeletes;
    public $guarded = ["id","created_at","updated_at"];
    protected $dates = ['deleted_at'];

    public static function findRequested()
    {
        $query = Category::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('slug') and $query->where('slug','like','%'.\Request::input('slug').'%');
        \Request::input('title') and $query->where('title','like','%'.\Request::input('title').'%');
        \Request::input('content') and $query->where('content',\Request::input('content'));
        \Request::input('author_id') and $query->where('author_id',\Request::input('author_id'));
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
            'slug' => 'required|string|max:150',
            'title' => 'required|string|max:150',
            'content' => '',
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

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the author record associated with the blog.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    /**
     * A category can have many products
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    /**
     * A category can have many subProducts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subProducts()
    {
        return $this->belongsToMany(Product::class, 'objects_categories', 'category_id', 'object_id')
            ->wherePivot('object_type', Product::class);
    }

    /**
     * A category can have many blogs
     *
     * @return \Illuminate\Database\Eloquent\Relations\ManyToMany
     */
    public function blogs()
    {
        return $this->belongsToMany(Product::class, 'objects_categories', 'category_id', 'object_id')
            ->wherePivot('object_type', Blog::class);
    }
    
    public function types()
    {
        return $this->hasOne(Type::class, 'id', 'categories_id');
    }

}

