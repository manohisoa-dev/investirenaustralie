<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Product extends Model {


    public $guarded = ["id","created_at","updated_at"];

    public static function findRequested()
    {
        $query = Product::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('reference') and $query->where('reference','like','%'.\Request::input('reference').'%');
        \Request::input('slug') and $query->where('slug','like','%'.\Request::input('slug').'%');
        \Request::input('title') and $query->where('title','like','%'.\Request::input('title').'%');
        \Request::input('content') and $query->where('content',\Request::input('content'));
        \Request::input('quantity') and $query->where('quantity',\Request::input('quantity'));
        \Request::input('is_new') and $query->where('is_new',\Request::input('is_new'));
        \Request::input('view_count') and $query->where('view_count',\Request::input('view_count'));
        \Request::input('area') and $query->where('area',\Request::input('area'));
        \Request::input('carport_spaces') and $query->where('carport_spaces',\Request::input('carport_spaces'));
        \Request::input('garage_spaces') and $query->where('garage_spaces',\Request::input('garage_spaces'));
        \Request::input('off_street_spaces') and $query->where('off_street_spaces',\Request::input('off_street_spaces'));
        \Request::input('bathrooms') and $query->where('bathrooms',\Request::input('bathrooms'));
        \Request::input('bedrooms') and $query->where('bedrooms',\Request::input('bedrooms'));
        \Request::input('ensuite') and $query->where('ensuite',\Request::input('ensuite'));
        \Request::input('land_area') and $query->where('land_area',\Request::input('land_area'));
        \Request::input('floor_area') and $query->where('floor_area',\Request::input('floor_area'));
        \Request::input('number_of_floors') and $query->where('number_of_floors',\Request::input('number_of_floors'));
        \Request::input('new_construction') and $query->where('new_construction',\Request::input('new_construction'));
        \Request::input('year_built') and $query->where('year_built','like','%'.\Request::input('year_built').'%');
        \Request::input('display_address') and $query->where('display_address','like','%'.\Request::input('display_address').'%');
        \Request::input('price') and $query->where('price',\Request::input('price'));
        \Request::input('currency') and $query->where('currency','like','%'.\Request::input('currency').'%');
        \Request::input('tma') and $query->where('tma',\Request::input('tma'));
        \Request::input('commision') and $query->where('commision',\Request::input('commision'));
        \Request::input('commision_edited') and $query->where('commision_edited',\Request::input('commision_edited'));
        \Request::input('status') and $query->where('status','like','%'.\Request::input('status').'%');
        \Request::input('type_id') and $query->where('type_id',\Request::input('type_id'));
        \Request::input('location_type_id') and $query->where('location_type_id',\Request::input('location_type_id'));
        \Request::input('category_id') and $query->where('category_id',\Request::input('category_id'));
        \Request::input('buyer_id') and $query->where('buyer_id',\Request::input('buyer_id'));
        \Request::input('seller_id') and $query->where('seller_id',\Request::input('seller_id'));
        \Request::input('author_id') and $query->where('author_id',\Request::input('author_id'));
        \Request::input('postalCode') and $query->where('postalCode','like','%'.\Request::input('postalCode').'%');
        \Request::input('state_id') and $query->where('state_id',\Request::input('state_id'));
        \Request::input('location_id') and $query->where('location_id',\Request::input('location_id'));
        \Request::input('image_id') and $query->where('image_id',\Request::input('image_id'));
        \Request::input('created_at') and $query->where('created_at',\Request::input('created_at'));
        \Request::input('updated_at') and $query->where('updated_at',\Request::input('updated_at'));
        
        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(Config::get('constants.perpage.admin'));
    }

    public static function validationRules( $attributes = null )
    {
        $rules = [
            'reference' => 'required|string|max:150',
            'slug' => 'required|string|max:150',
            'title' => 'string|max:150',
            'content' => '',
            'quantity' => 'required',
            'is_new' => 'required|integer',
            'view_count' => 'required',
            'area' => '',
            'carport_spaces' => 'required|integer',
            'garage_spaces' => 'required|integer',
            'off_street_spaces' => 'required|integer',
            'bathrooms' => 'required|integer',
            'bedrooms' => 'required|integer',
            'ensuite' => 'required|integer',
            'land_area' => 'required|integer',
            'floor_area' => 'required|integer',
            'number_of_floors' => 'required|integer',
            'new_construction' => 'required',
            'year_built' => 'string|max:10',
            'display_address' => 'string|max:191',
            'price' => '',
            'currency' => 'string|max:10',
            'tma' => '',
            'commision' => '',
            'commision_edited' => 'required|integer',
            'status' => 'required|string|max:20',
            'type_id' => 'required',
            'location_type_id' => 'required',
            'category_id' => 'required',
            'buyer_id' => 'required',
            'seller_id' => 'required',
            'author_id' => 'required',
            'postalCode' => 'string|max:191',
            'state_id' => 'required',
            'location_id' => 'required',
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

}

