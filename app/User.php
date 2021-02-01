<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class User extends Model {


    public $guarded = ["id","created_at","updated_at"];

    public static function findRequested()
    {
        $query = User::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('name') and $query->where('name','like','%'.\Request::input('name').'%');
        \Request::input('email') and $query->where('email','like','%'.\Request::input('email').'%');
        \Request::input('password') and $query->where('password','like','%'.\Request::input('password').'%');
        \Request::input('role') and $query->where('role','like','%'.\Request::input('role').'%');
        \Request::input('type') and $query->where('type','like','%'.\Request::input('type').'%');
        \Request::input('language') and $query->where('language','like','%'.\Request::input('language').'%');
        \Request::input('status') and $query->where('status','like','%'.\Request::input('status').'%');
        \Request::input('percent') and $query->where('percent',\Request::input('percent'));
        \Request::input('enabled_at') and $query->where('enabled_at',\Request::input('enabled_at'));
        \Request::input('disabled_at') and $query->where('disabled_at',\Request::input('disabled_at'));
        \Request::input('use_default_password') and $query->where('use_default_password',\Request::input('use_default_password'));
        \Request::input('is_seller') and $query->where('is_seller',\Request::input('is_seller'));
        \Request::input('apl_id') and $query->where('apl_id',\Request::input('apl_id'));
        \Request::input('apl_ends_at') and $query->where('apl_ends_at',\Request::input('apl_ends_at'));
        \Request::input('image_id') and $query->where('image_id',\Request::input('image_id'));
        \Request::input('author_id') and $query->where('author_id',\Request::input('author_id'));
        \Request::input('location_id') and $query->where('location_id',\Request::input('location_id'));
        \Request::input('country_id') and $query->where('country_id',\Request::input('country_id'));
        \Request::input('operation_range') and $query->where('operation_range',\Request::input('operation_range'));
        \Request::input('state_id') and $query->where('state_id',\Request::input('state_id'));
        \Request::input('activation_code') and $query->where('activation_code','like','%'.\Request::input('activation_code').'%');
        \Request::input('remember_token') and $query->where('remember_token','like','%'.\Request::input('remember_token').'%');
        \Request::input('created_at') and $query->where('created_at',\Request::input('created_at'));
        \Request::input('updated_at') and $query->where('updated_at',\Request::input('updated_at'));
        \Request::input('braintree_id') and $query->where('braintree_id','like','%'.\Request::input('braintree_id').'%');
        \Request::input('paypal_email') and $query->where('paypal_email','like','%'.\Request::input('paypal_email').'%');
        \Request::input('stripe_id') and $query->where('stripe_id','like','%'.\Request::input('stripe_id').'%');
        \Request::input('card_brand') and $query->where('card_brand','like','%'.\Request::input('card_brand').'%');
        \Request::input('card_last_four') and $query->where('card_last_four','like','%'.\Request::input('card_last_four').'%');
        \Request::input('trial_ends_at') and $query->where('trial_ends_at',\Request::input('trial_ends_at'));
        \Request::input('subscription_ends_at') and $query->where('subscription_ends_at',\Request::input('subscription_ends_at'));
        
        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(Config::get('constants.perpage.admin'));
    }

    public static function validationRules( $attributes = null )
    {
        $rules = [
            'name' => 'required|string|max:100',
            'email' => 'required|string|max:100|email',
            'password' => 'required|string|max:191',
            'role' => 'required|string|max:20',
            'type' => 'required|string|max:20',
            'language' => 'required|string|max:191',
            'status' => 'required|string|max:20',
            'percent' => '',
            'enabled_at' => 'date',
            'disabled_at' => 'date',
            'use_default_password' => 'required|integer',
            'is_seller' => 'required|integer',
            'apl_id' => 'required',
            'apl_ends_at' => 'date',
            'image_id' => 'required',
            'author_id' => 'required',
            'location_id' => 'required',
            'country_id' => 'required',
            'operation_range' => 'required',
            'state_id' => 'required',
            'activation_code' => 'string|max:191',
            'remember_token' => 'string|max:100',
            'braintree_id' => 'string|max:191',
            'paypal_email' => 'string|max:191|email',
            'stripe_id' => 'string|max:191',
            'card_brand' => 'string|max:191',
            'card_last_four' => 'string|max:191',
            'trial_ends_at' => '',
            'subscription_ends_at' => '',
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

