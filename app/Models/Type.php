<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Type extends Model {


    public $guarded = ["id", "created_at", "updated_at"];

    public static function findRequested() {
        $query = Type::query();
        // search results based on user input
        \Request::input('id') and $query->where('id', \Request::input('id'));
        \Request::input('slug') and $query->where('slug', 'like', '%' . \Request::input
            ('slug') . '%');
        \Request::input('title') and $query->where('title', 'like', '%' . \Request::input
            ('title') . '%');
        \Request::input('title_en') and $query->where('title_en', 'like', '%' . \Request::input
            ('title_en') . '%');
        \Request::input('content') and $query->where('content', \Request::input('content'));
        \Request::input('categories_id') and $query->where('categories_id', 'like', '%' . \Request::input
            ('categories_id') . '%');
        \Request::input('author_id') and $query->where('author_id', \Request::input('author_id'));
        \Request::input('created_at') and $query->where('created_at', \Request::input('created_at'));
        \Request::input('updated_at') and $query->where('updated_at', \Request::input('updated_at'));

        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"), \Request::input
            ("sortType", "asc"));

        // paginate results
        return $query->paginate(15);
    }

    public static function validationRules($attributes = null) {
        $rules = ['title' => 'required|string|max:150'];
        $rules = ['title_en' => 'required|string|max:150'];

        // no list is provided
        if (!$attributes)
            return $rules;

        // a single attribute is provided
        if (!is_array($attributes))
            return [$attributes => $rules[$attributes]];

        // a list of attributes is provided
        $newRules = [];
        foreach ($attributes as $attr)
            $newRules[$attr] = $rules[$attr];
        return $newRules;
    }

    /**
     * Get the author record associated with the blog.
     */
    public function author() {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    /**
     * A type can have many products
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products() {
        return $this->hasMany(Product::class, 'type_id', 'id');
    }

    public function categorie() {
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }

}
