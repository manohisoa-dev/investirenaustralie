<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use AstritZeqiri\Metadata\Traits\HasManyMetaDataTrait;
use App\Notifications\PasswordReseted;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Session;
use App\Models\Product;
use App\Models\SellerIndividual;
use App\Models\SellerBusiness;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable {
    use Notifiable;
    use HasManyMetaDataTrait;
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'immat', 'email', 'password', 'image_id',
        'location_id', 'status', 'role', 'language', 'activation_code', 'afa_id',
        'use_default_password', 'is_complete', 'trial_ends_at', 'type_users_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', ];

    /**
     * The attributes that should be a date
     *
     * @var array
     */
    protected $dates = ['apl_ends_at', 'trial_ends_at', 'subscription_ends_at'];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $events = [ //'saved' => UserSaved::class,
        //'deleted' => UserDeleted::class,
    ];
    public $guarded = ["id", "created_at", "updated_at"];

    public static function findRequested() {
        $query = User::query();
        $query->join('localizations', 'localizations.id', '=', 'users.location_id');
        $query->select('users.id AS uid', 'users.name AS name',
            'users.image_id AS image_id', 'users.email as email',
            'users.created_at as created_at', 'users.role as role', 'users.status as status',
            'users.author_id as author_id', 'localizations.country as country',
            'localizations.locality as locality', 'users.type_users_id as type_users_id');
        // search results based on user input
        \Request::input('id') and $query->where('users.id', \Request::input('id'));
        \Request::input('name') and $query->where('users.name', 'like', '%' . \Request::input
            ('name') . '%');
        \Request::input('email') and $query->where('users.email', 'like', '%' . \Request::input
            ('email') . '%');
        \Request::input('password') and $query->where('users.password', 'like', '%' . \Request::input
            ('password') . '%');
        \Request::input('role') and $query->where('users.role', 'like', '%' . \Request::input
            ('role') . '%');
        \Request::input('type_users_id') and $query->where('users.type_users_id', 'like',
            '%' . \Request::input('type_users_id') . '%');
        \Request::input('language') and $query->where('users.language', 'like', '%' . \Request::input
            ('language') . '%');
        \Request::input('status') and $query->where('users.status', 'like', '%' . \Request::input
            ('status') . '%');
        \Request::input('percent') and $query->where('users.percent', \Request::input('percent'));
        \Request::input('enabled_at') and $query->where('users.enabled_at', \Request::input
            ('enabled_at'));
        \Request::input('disabled_at') and $query->where('users.disabled_at', \Request::input
            ('disabled_at'));
        \Request::input('use_default_password') and $query->where('users.use_default_password', \Request::input
            ('use_default_password'));
        \Request::input('is_seller') and $query->where('users.is_seller', \Request::input
            ('is_seller'));
        \Request::input('apl_id') and $query->where('users.apl_id', \Request::input('apl_id'));
        \Request::input('apl_ends_at') and $query->where('users.apl_ends_at', \Request::input
            ('apl_ends_at'));
        \Request::input('image_id') and $query->where('users.image_id', \Request::input
            ('image_id'));
        \Request::input('author_id') and $query->where('users.author_id', \Request::input
            ('author_id'));
        \Request::input('location_id') and $query->where('users.location_id', \Request::input
            ('location_id'));
        \Request::input('country_id') and $query->where('localizations.country', \Request::input
            ('country_id'));
        \Request::input('operation_range') and $query->where('users.operation_range', \Request::input
            ('operation_range'));
        \Request::input('state_id') and $query->where('users.state_id', \Request::input
            ('state_id'));
        \Request::input('activation_code') and $query->where('users.activation_code',
            'like', '%' . \Request::input('activation_code') . '%');
        \Request::input('remember_token') and $query->where('users.remember_token',
            'like', '%' . \Request::input('remember_token') . '%');
        \Request::input('created_at') and $query->where('users.created_at', \Request::input
            ('created_at'));
        \Request::input('updated_at') and $query->where('users.updated_at', \Request::input
            ('updated_at'));
        \Request::input('braintree_id') and $query->where('users.braintree_id', 'like',
            '%' . \Request::input('braintree_id') . '%');
        \Request::input('paypal_email') and $query->where('users.paypal_email', 'like',
            '%' . \Request::input('paypal_email') . '%');
        \Request::input('stripe_id') and $query->where('users.stripe_id', 'like', '%' . \Request::input
            ('stripe_id') . '%');
        \Request::input('card_brand') and $query->where('users.card_brand', 'like', '%' . \Request::input
            ('card_brand') . '%');
        \Request::input('card_last_four') and $query->where('users.card_last_four',
            'like', '%' . \Request::input('card_last_four') . '%');
        \Request::input('trial_ends_at') and $query->where('users.trial_ends_at', \Request::input
            ('trial_ends_at'));
        \Request::input('subscription_ends_at') and $query->where('users.subscription_ends_at', \Request::input
            ('subscription_ends_at'));

        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"), \Request::input
            ("sortType", "asc"));

        // paginate results
        return $query->paginate(15);
    }
    
    public static function findRequested_byRole($role) {
        $query = User::query();
        $query->join('localizations', 'localizations.id', '=', 'users.location_id');
        $query->select('users.id AS uid', 'users.name AS name',
            'users.image_id AS image_id', 'users.email as email',
            'users.created_at as created_at', 'users.role as role', 'users.status as status',
            'users.author_id as author_id', 'localizations.country as country',
            'localizations.locality as locality', 'users.type_users_id as type_users_id');
        $query->where('role',$role);
        // search results based on user input
        \Request::input('id') and $query->where('users.id', \Request::input('id'));
        \Request::input('name') and $query->where('users.name', 'like', '%' . \Request::input
            ('name') . '%');
        \Request::input('email') and $query->where('users.email', 'like', '%' . \Request::input
            ('email') . '%');
        \Request::input('password') and $query->where('users.password', 'like', '%' . \Request::input
            ('password') . '%');
        \Request::input('role') and $query->where('users.role', 'like', '%' . \Request::input
            ('role') . '%');
        \Request::input('type_users_id') and $query->where('users.type_users_id', 'like',
            '%' . \Request::input('type_users_id') . '%');
        \Request::input('language') and $query->where('users.language', 'like', '%' . \Request::input
            ('language') . '%');
        \Request::input('status') and $query->where('users.status', 'like', '%' . \Request::input
            ('status') . '%');
        \Request::input('percent') and $query->where('users.percent', \Request::input('percent'));
        \Request::input('enabled_at') and $query->where('users.enabled_at', \Request::input
            ('enabled_at'));
        \Request::input('disabled_at') and $query->where('users.disabled_at', \Request::input
            ('disabled_at'));
        \Request::input('use_default_password') and $query->where('users.use_default_password', \Request::input
            ('use_default_password'));
        \Request::input('is_seller') and $query->where('users.is_seller', \Request::input
            ('is_seller'));
        \Request::input('apl_id') and $query->where('users.apl_id', \Request::input('apl_id'));
        \Request::input('apl_ends_at') and $query->where('users.apl_ends_at', \Request::input
            ('apl_ends_at'));
        \Request::input('image_id') and $query->where('users.image_id', \Request::input
            ('image_id'));
        \Request::input('author_id') and $query->where('users.author_id', \Request::input
            ('author_id'));
        \Request::input('location_id') and $query->where('users.location_id', \Request::input
            ('location_id'));
        \Request::input('country_id') and $query->where('users.country_id', \Request::input
            ('country_id'));
        \Request::input('operation_range') and $query->where('users.operation_range', \Request::input
            ('operation_range'));
        \Request::input('state_id') and $query->where('users.state_id', \Request::input
            ('state_id'));
        \Request::input('activation_code') and $query->where('users.activation_code',
            'like', '%' . \Request::input('activation_code') . '%');
        \Request::input('remember_token') and $query->where('users.remember_token',
            'like', '%' . \Request::input('remember_token') . '%');
        \Request::input('created_at') and $query->where('users.created_at', \Request::input
            ('created_at'));
        \Request::input('updated_at') and $query->where('users.updated_at', \Request::input
            ('updated_at'));
        \Request::input('braintree_id') and $query->where('users.braintree_id', 'like',
            '%' . \Request::input('braintree_id') . '%');
        \Request::input('paypal_email') and $query->where('users.paypal_email', 'like',
            '%' . \Request::input('paypal_email') . '%');
        \Request::input('stripe_id') and $query->where('users.stripe_id', 'like', '%' . \Request::input
            ('stripe_id') . '%');
        \Request::input('card_brand') and $query->where('users.card_brand', 'like', '%' . \Request::input
            ('card_brand') . '%');
        \Request::input('card_last_four') and $query->where('users.card_last_four',
            'like', '%' . \Request::input('card_last_four') . '%');
        \Request::input('trial_ends_at') and $query->where('users.trial_ends_at', \Request::input
            ('trial_ends_at'));
        \Request::input('subscription_ends_at') and $query->where('users.subscription_ends_at', \Request::input
            ('subscription_ends_at'));

        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"), \Request::input
            ("sortType", "asc"));

        // paginate results
        return $query->paginate(15);
    }
    
    
    public static function seller_real_estate_professionals() {
        $query = User::query();
        $query->join('localizations', 'localizations.id', '=', 'users.location_id');
        $query->select('users.id AS uid', 'users.name AS name',
            'users.image_id AS image_id', 'users.email as email',
            'users.created_at as created_at', 'users.role as role', 'users.status as status',
            'users.author_id as author_id', 'localizations.country as country',
            'localizations.locality as locality', 'users.type_users_id as type_users_id');
        $query->where('role',2)->whereIn('type_users_id',array(3, 4));
        // search results based on user input
        \Request::input('id') and $query->where('users.id', \Request::input('id'));
        \Request::input('name') and $query->where('users.name', 'like', '%' . \Request::input
            ('name') . '%');
        \Request::input('email') and $query->where('users.email', 'like', '%' . \Request::input
            ('email') . '%');
        \Request::input('password') and $query->where('users.password', 'like', '%' . \Request::input
            ('password') . '%');
        \Request::input('role') and $query->where('users.role', 'like', '%' . \Request::input
            ('role') . '%');
        \Request::input('type_users_id') and $query->where('users.type_users_id', 'like',
            '%' . \Request::input('type_users_id') . '%');
        \Request::input('language') and $query->where('users.language', 'like', '%' . \Request::input
            ('language') . '%');
        \Request::input('status') and $query->where('users.status', 'like', '%' . \Request::input
            ('status') . '%');
        \Request::input('percent') and $query->where('users.percent', \Request::input('percent'));
        \Request::input('enabled_at') and $query->where('users.enabled_at', \Request::input
            ('enabled_at'));
        \Request::input('disabled_at') and $query->where('users.disabled_at', \Request::input
            ('disabled_at'));
        \Request::input('use_default_password') and $query->where('users.use_default_password', \Request::input
            ('use_default_password'));
        \Request::input('is_seller') and $query->where('users.is_seller', \Request::input
            ('is_seller'));
        \Request::input('apl_id') and $query->where('users.apl_id', \Request::input('apl_id'));
        \Request::input('apl_ends_at') and $query->where('users.apl_ends_at', \Request::input
            ('apl_ends_at'));
        \Request::input('image_id') and $query->where('users.image_id', \Request::input
            ('image_id'));
        \Request::input('author_id') and $query->where('users.author_id', \Request::input
            ('author_id'));
        \Request::input('location_id') and $query->where('users.location_id', \Request::input
            ('location_id'));
        \Request::input('country_id') and $query->where('users.country_id', \Request::input
            ('country_id'));
        \Request::input('operation_range') and $query->where('users.operation_range', \Request::input
            ('operation_range'));
        \Request::input('state_id') and $query->where('users.state_id', \Request::input
            ('state_id'));
        \Request::input('activation_code') and $query->where('users.activation_code',
            'like', '%' . \Request::input('activation_code') . '%');
        \Request::input('remember_token') and $query->where('users.remember_token',
            'like', '%' . \Request::input('remember_token') . '%');
        \Request::input('created_at') and $query->where('users.created_at', \Request::input
            ('created_at'));
        \Request::input('updated_at') and $query->where('users.updated_at', \Request::input
            ('updated_at'));
        \Request::input('braintree_id') and $query->where('users.braintree_id', 'like',
            '%' . \Request::input('braintree_id') . '%');
        \Request::input('paypal_email') and $query->where('users.paypal_email', 'like',
            '%' . \Request::input('paypal_email') . '%');
        \Request::input('stripe_id') and $query->where('users.stripe_id', 'like', '%' . \Request::input
            ('stripe_id') . '%');
        \Request::input('card_brand') and $query->where('users.card_brand', 'like', '%' . \Request::input
            ('card_brand') . '%');
        \Request::input('card_last_four') and $query->where('users.card_last_four',
            'like', '%' . \Request::input('card_last_four') . '%');
        \Request::input('trial_ends_at') and $query->where('users.trial_ends_at', \Request::input
            ('trial_ends_at'));
        \Request::input('subscription_ends_at') and $query->where('users.subscription_ends_at', \Request::input
            ('subscription_ends_at'));

        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"), \Request::input
            ("sortType", "asc"));

        // paginate results
        return $query->paginate(15);
    }
    
    public static function seller_non_professional($type) {
        $query = User::query();
        $query->join('localizations', 'localizations.id', '=', 'users.location_id');
        $query->select('users.id AS uid', 'users.name AS name',
            'users.image_id AS image_id', 'users.email as email',
            'users.created_at as created_at', 'users.role as role', 'users.status as status',
            'users.author_id as author_id', 'localizations.country as country',
            'localizations.locality as locality', 'users.type_users_id as type_users_id');
        $query->where('role',2)->where('type_users_id',$type);
        // search results based on user input
        \Request::input('id') and $query->where('users.id', \Request::input('id'));
        \Request::input('name') and $query->where('users.name', 'like', '%' . \Request::input
            ('name') . '%');
        \Request::input('email') and $query->where('users.email', 'like', '%' . \Request::input
            ('email') . '%');
        \Request::input('password') and $query->where('users.password', 'like', '%' . \Request::input
            ('password') . '%');
        \Request::input('role') and $query->where('users.role', 'like', '%' . \Request::input
            ('role') . '%');
        \Request::input('type_users_id') and $query->where('users.type_users_id', 'like',
            '%' . \Request::input('type_users_id') . '%');
        \Request::input('language') and $query->where('users.language', 'like', '%' . \Request::input
            ('language') . '%');
        \Request::input('status') and $query->where('users.status', 'like', '%' . \Request::input
            ('status') . '%');
        \Request::input('percent') and $query->where('users.percent', \Request::input('percent'));
        \Request::input('enabled_at') and $query->where('users.enabled_at', \Request::input
            ('enabled_at'));
        \Request::input('disabled_at') and $query->where('users.disabled_at', \Request::input
            ('disabled_at'));
        \Request::input('use_default_password') and $query->where('users.use_default_password', \Request::input
            ('use_default_password'));
        \Request::input('is_seller') and $query->where('users.is_seller', \Request::input
            ('is_seller'));
        \Request::input('apl_id') and $query->where('users.apl_id', \Request::input('apl_id'));
        \Request::input('apl_ends_at') and $query->where('users.apl_ends_at', \Request::input
            ('apl_ends_at'));
        \Request::input('image_id') and $query->where('users.image_id', \Request::input
            ('image_id'));
        \Request::input('author_id') and $query->where('users.author_id', \Request::input
            ('author_id'));
        \Request::input('location_id') and $query->where('users.location_id', \Request::input
            ('location_id'));
        \Request::input('country_id') and $query->where('users.country_id', \Request::input
            ('country_id'));
        \Request::input('operation_range') and $query->where('users.operation_range', \Request::input
            ('operation_range'));
        \Request::input('state_id') and $query->where('users.state_id', \Request::input
            ('state_id'));
        \Request::input('activation_code') and $query->where('users.activation_code',
            'like', '%' . \Request::input('activation_code') . '%');
        \Request::input('remember_token') and $query->where('users.remember_token',
            'like', '%' . \Request::input('remember_token') . '%');
        \Request::input('created_at') and $query->where('users.created_at', \Request::input
            ('created_at'));
        \Request::input('updated_at') and $query->where('users.updated_at', \Request::input
            ('updated_at'));
        \Request::input('braintree_id') and $query->where('users.braintree_id', 'like',
            '%' . \Request::input('braintree_id') . '%');
        \Request::input('paypal_email') and $query->where('users.paypal_email', 'like',
            '%' . \Request::input('paypal_email') . '%');
        \Request::input('stripe_id') and $query->where('users.stripe_id', 'like', '%' . \Request::input
            ('stripe_id') . '%');
        \Request::input('card_brand') and $query->where('users.card_brand', 'like', '%' . \Request::input
            ('card_brand') . '%');
        \Request::input('card_last_four') and $query->where('users.card_last_four',
            'like', '%' . \Request::input('card_last_four') . '%');
        \Request::input('trial_ends_at') and $query->where('users.trial_ends_at', \Request::input
            ('trial_ends_at'));
        \Request::input('subscription_ends_at') and $query->where('users.subscription_ends_at', \Request::input
            ('subscription_ends_at'));

        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"), \Request::input
            ("sortType", "asc"));

        // paginate results
        return $query->paginate(15);
    }
    
    public static function seller_byAfa() {
        $query = User::query();
        $query->join('localizations', 'localizations.id', '=', 'users.location_id');
        $query->select('users.id AS uid', 'users.name AS name',
            'users.image_id AS image_id', 'users.email as email',
            'users.created_at as created_at', 'users.role as role', 'users.status as status',
            'users.author_id as author_id', 'localizations.country as country',
            'localizations.locality as locality', 'users.type_users_id as type_users_id');
        $query->where('role',2)->whereIn('type_users_id',array(8,9));
        // search results based on user input
        \Request::input('id') and $query->where('users.id', \Request::input('id'));
        \Request::input('name') and $query->where('users.name', 'like', '%' . \Request::input
            ('name') . '%');
        \Request::input('email') and $query->where('users.email', 'like', '%' . \Request::input
            ('email') . '%');
        \Request::input('password') and $query->where('users.password', 'like', '%' . \Request::input
            ('password') . '%');
        \Request::input('role') and $query->where('users.role', 'like', '%' . \Request::input
            ('role') . '%');
        \Request::input('type_users_id') and $query->where('users.type_users_id', 'like',
            '%' . \Request::input('type_users_id') . '%');
        \Request::input('language') and $query->where('users.language', 'like', '%' . \Request::input
            ('language') . '%');
        \Request::input('status') and $query->where('users.status', 'like', '%' . \Request::input
            ('status') . '%');
        \Request::input('percent') and $query->where('users.percent', \Request::input('percent'));
        \Request::input('enabled_at') and $query->where('users.enabled_at', \Request::input
            ('enabled_at'));
        \Request::input('disabled_at') and $query->where('users.disabled_at', \Request::input
            ('disabled_at'));
        \Request::input('use_default_password') and $query->where('users.use_default_password', \Request::input
            ('use_default_password'));
        \Request::input('is_seller') and $query->where('users.is_seller', \Request::input
            ('is_seller'));
        \Request::input('apl_id') and $query->where('users.apl_id', \Request::input('apl_id'));
        \Request::input('apl_ends_at') and $query->where('users.apl_ends_at', \Request::input
            ('apl_ends_at'));
        \Request::input('image_id') and $query->where('users.image_id', \Request::input
            ('image_id'));
        \Request::input('author_id') and $query->where('users.author_id', \Request::input
            ('author_id'));
        \Request::input('location_id') and $query->where('users.location_id', \Request::input
            ('location_id'));
        \Request::input('country_id') and $query->where('users.country_id', \Request::input
            ('country_id'));
        \Request::input('operation_range') and $query->where('users.operation_range', \Request::input
            ('operation_range'));
        \Request::input('state_id') and $query->where('users.state_id', \Request::input
            ('state_id'));
        \Request::input('activation_code') and $query->where('users.activation_code',
            'like', '%' . \Request::input('activation_code') . '%');
        \Request::input('remember_token') and $query->where('users.remember_token',
            'like', '%' . \Request::input('remember_token') . '%');
        \Request::input('created_at') and $query->where('users.created_at', \Request::input
            ('created_at'));
        \Request::input('updated_at') and $query->where('users.updated_at', \Request::input
            ('updated_at'));
        \Request::input('braintree_id') and $query->where('users.braintree_id', 'like',
            '%' . \Request::input('braintree_id') . '%');
        \Request::input('paypal_email') and $query->where('users.paypal_email', 'like',
            '%' . \Request::input('paypal_email') . '%');
        \Request::input('stripe_id') and $query->where('users.stripe_id', 'like', '%' . \Request::input
            ('stripe_id') . '%');
        \Request::input('card_brand') and $query->where('users.card_brand', 'like', '%' . \Request::input
            ('card_brand') . '%');
        \Request::input('card_last_four') and $query->where('users.card_last_four',
            'like', '%' . \Request::input('card_last_four') . '%');
        \Request::input('trial_ends_at') and $query->where('users.trial_ends_at', \Request::input
            ('trial_ends_at'));
        \Request::input('subscription_ends_at') and $query->where('users.subscription_ends_at', \Request::input
            ('subscription_ends_at'));

        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"), \Request::input
            ("sortType", "asc"));

        // paginate results
        return $query->paginate(15);
    }

    public static function validationRulesAdmin($attributes = null) {
        $rules = ['login' => 'required|string|max:100', 'email' =>
            'required|string|max:100|email', 'first_name' => 'string|max:100', 'last_name' =>
            'string|max:191', 'language' => 'required', 'password' => 'required|integer',
            'permission' => 'required', ];

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

    public static function validationRules($attributes = null) {
        $rules = ['name' => 'required|string|max:100', 'email' =>
            'required|string|max:100|email', 'password' => 'required|string|max:191', 'role' =>
            'required|string|max:20', 'type_users_id' => 'required', 'language' =>
            'required|string|max:191', 'status' => 'required|string|max:20', 'percent' => '',
            'enabled_at' => 'date', 'disabled_at' => 'date', 'use_default_password' =>
            'required|integer', 'is_seller' => 'required|integer', 'apl_id' => 'required',
            'apl_ends_at' => 'date', 'image_id' => 'required', 'author_id' => 'required',
            'location_id' => 'required', 'country_id' => 'required', 'operation_range' =>
            'required', 'state_id' => 'required', 'activation_code' => 'string|max:191',
            'remember_token' => 'string|max:100', 'braintree_id' => 'string|max:191',
            'paypal_email' => 'string|max:191|email', 'stripe_id' => 'string|max:191',
            'card_brand' => 'string|max:191', 'card_last_four' => 'string|max:191',
            'trial_ends_at' => '', 'subscription_ends_at' => '', ];

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
     * Scope a query to only include users of a given $role.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $role
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfRole($query, $role) {
        return $query->where('role', $role);
    }

    /**
     * Scope a query to only include users of a given $type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type) {
        return $query->where('type_users_id', $type);
    }

    /**
     * Scope a query to only include users of a given $status.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeOfStatus($query, $status) {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to only include users is active
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsActive($query) {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include users is active
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasPostalCode($query, $postal_code) {

        return $query->join('localizations', 'users.location_id', '=',
            'localizations.id')->where('localizations.postalCode', $postal_code);
    }

    // /**
    //  * Scope a query to only include users is active
    //  *
    //  * @param \Illuminate\Database\Eloquent\Builder $query
    //  * @return \Illuminate\Database\Eloquent\Builder
    //  */
    // public function isActive()
    // {
    //     return $this->status;
    // }

    /**
     * Scope a query to only include users has Location
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasLocation($query) {
        return $query->where('location_id', '>', '0');
    }

    /**
     * Is current user can contact $user
     *
     * @return Boolean
     */
    public function canContact(User $user) {
        if ($this->isAdmin())
            return true;

        if (!$user->active())
            return false;


        if ($this->hasRole(3)) {
            return !$user->hasRole(5);
        }

        if ($this->hasRole(2)) {
            return !$user->hasRole(5);
        }


        if ($this->hasRole(5)) {
            if ($user->hasRole(4)) {
                return $this->apl && ($this->apl->id == $user->id);
            }

            return $user->hasRole(1);
        }

        if ($this->hasRole(4)) {
            if ($user->hasRole(5)) {
                return $user->apl && ($user->apl->id == $this->id);
            }

            return true;
        }
    }

    /**
     * Is user active
     *
     * @return Boolean
     */
    public function active() {
        return ($this->status == 'active');
    }

    /**
     * Is user temp (seller by afa)
     *
     * @return Boolean
     */
    public function temp() {
        return ($this->status == 'temp');
    }

    /**
     * Is user active
     *
     * @return Boolean
     */
    public function useDefaultPassword() {
        return ($this->use_default_password == 1);
    }

    /**
     * Is user deleted
     *
     * @return Boolean
     */
    public function statusDeleted() {
        return ($this->status == 'deleted');
    }

    /**
     * Is user online
     *
     * @return Boolean
     */
    public function isOnline() {
        return $this->sessions()->activity()->exists();
    }

    /**
     * Is user admin
     *
     * @return Boolean
     */
    public function isAdmin() {
        return $this->hasRole(1);
    }

    /**
     * If user admin is admin blog
     *
     * @return Boolean
     */
    public function isAdminBlog() {
        return $this->hasTypeUser(5);
    }

    /**
     * If user admin is admin delegate
     *
     * @return Boolean
     */
    public function isAdminDelegate() {
        return $this->hasTypeUser(6);
    }

    /**
     * A user is admin || AFA || APL || member
     *
     * @return Boolean
     */
    public function hasRole($role) {
        return ($this->role == $role);
    }

    /**
     * A admin is Admin bolg || Admin delegate
     *
     * @return Boolean
     */
    public function hasTypeUser($type_users_id) {
        return ($this->type_users_id == $type_users_id);
    }

    /**
     * A user is person
     *
     * @return Boolean
     */
    public function isPerson() {
        return $this->hasRole(5) && ($this->type_users_id == 2);
    }

    /**
     * A user is member and has apl
     *
     * @return Boolean
     */
    public function hasApl() {
        return $this->hasRole(5) && $this->apl && (!empty($this->apl_ends_at)) && ($this->apl_ends_at >= \Carbon\Carbon::now
            ());
    }

    /**
     * A user is seller builder
     *
     * @return Boolean
     */
    public function isSbu() {
        return $this->hasRole(2) && ($this->type_users_id == 3);
    }
    
    /**
     * A user is seller developer
     *
     * @return Boolean
     */
    public function isSde() {
        return $this->hasRole(2) && ($this->type_users_id == 4);
    }

    /**
     * A user is seller natural person
     *
     * @return Boolean
     */
    public function isSnp() {
        return $this->hasRole(2) && ($this->type_users_id == 2);
    }
    
    /**
     * A user is seller legal person
     *
     * @return Boolean
     */
    public function isSlp() {
        return $this->hasRole(2) && ($this->type_users_id == 1);
    }

    /**
     * A user is seller by afa 
     *
     * @return Boolean
     */
    public function isSba() {
        return $this->hasRole(2) && ($this->type_users_id == 8 || $this->type_users_id == 9);
    }

    /**
     * A user is seller by afa business
     *
     * @return Boolean
     */
    public function isSbaBusiness() {
        return $this->hasRole(2) && ($this->type_users_id == 9);
    }
    
    /**
     * A user is seller by afa individual
     *
     * @return Boolean
     */
    public function isSbaIndividual() {
        return $this->hasRole(2) && ($this->type_users_id == 8);
    }

    /**
     * Get Url of Attached Image OR Default Image
     *
     * @param Boolean $thumb
     * @return String
     */
    public function imageUrl($thumb = false) {
        // Image is setted
        if ($this->image) {
            if ($thumb)
                return thumbnail($this->image->filepath);
            return storage($this->image->filepath);
        }
        return asset('images/avatar.png');
    }

    /**
     * A user can have one image
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image() {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }

    /**
     * A user can have one parent
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function author() {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    /**
     * A user can have one default APL
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function apl() {
        return $this->hasOne(User::class, 'id', 'apl_id');
    }

    /**
     * A user can have one location
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function location() {
        return $this->hasOne(Localisation::class, 'id', 'location_id');
    }

    /**
     * A user can have one role
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function roleUser() {
        //return $this->belongsTo('App\Role');
        return $this->hasOne(Role::class, 'id', 'role');
    }

    public function typeUser() {
        //return $this->belongsTo('App\Role');
        return $this->hasOne(TypeUser::class, 'id', 'type_users_id');
    }

    /**
     * A user can have many session
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sessions() {
        return $this->hasMany(Session::class, 'user_id', 'id');
    }

    /**
     * A user can have many observation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function observations() {
        return $this->hasMany(Observation::class, 'user_id', 'id');
    }

    /**
     * A user can have many messages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages() {
        return $this->hasMany(Message::class, 'user_id', 'id');
    }

    /**
     * An admin user can have many blogs
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blogs() {
        return $this->hasMany(Blog::class, 'author_id', 'id');
    }


    /**
     * A user can have many comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments() {
        return $this->hasMany(Comment::class, 'author_id', 'id');
    }

    /**
     * An admin can have many products
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function adminProducts() {
        return $this->hasMany(Product::class, 'author_id', 'id');
    }

    /**
     * A seller can have many products to sell
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products() {
        return $this->hasMany(Product::class, 'author_id', 'id');
    }

    /**
     * An APL can have many clients
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customers() {
        return $this->hasMany(User::class, 'apl_id', 'id');
    }

    /**
     * An many user can have many products from labels table
     *
     * @return \Illuminate\Database\Eloquent\Relations\ManyToMany
     */
    public function pins() {
        return $this->belongsToMany(Product::class, 'labels', 'author_id', 'product_id')->wherePivot('label',
            'saved');
    }

    /**
     * An many user can have many products from labels table
     *
     * @return \Illuminate\Database\Eloquent\Relations\ManyToMany
     */
    public function favorites() {
        return $this->belongsToMany(Product::class, 'labels', 'author_id', 'product_id')->wherePivot('label',
            'starred');
    }

    /**
     * An Client can have many orders
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders() {
        if ($this->hasRole(5))
            return $this->hasMany(Sale::class, 'author_id', 'id');
        if ($this->hasRole(4))
            return $this->hasMany(Sale::class, 'apl_id', 'id');
        if ($this->hasRole(3))
            return $this->hasMany(Sale::class, 'afa_id', 'id');
        return null;
    }

    /**
     * An Client can have many searches
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function searches() {
        return $this->hasMany(Search::class, 'author_id', 'id');
    }

    /**
     * An many afa/apl can have many products from sales table
     *
     * @return \Illuminate\Database\Eloquent\Relations\ManyToMany
     */
    public function sales() {
        if ($this->hasRole(3)) {
            return $this->belongsToMany(Product::class, 'sales', 'afa_id', 'product_id');
        }
        // else APL
        return $this->belongsToMany(Product::class, 'sales', 'apl_id', 'product_id');
    }

    /**
     * An many clients can buy many products from sales table
     *
     * @return \Illuminate\Database\Eloquent\Relations\ManyToMany
     */
    public function purchases() {
        return $this->belongsToMany(Product::class, 'sales', 'author_id', 'product_id');
    }

    /**
     * An user can have many mails with mails_users pivot table
     *
     * @return \Illuminate\Database\Eloquent\Relations\ManyToMany
     */
    public function mails() {
        return $this->belongsToMany(Email::class, 'mails_users', 'user_id', 'mail_id');
    }

    /*
    * Alias to get_meta()->value
    *
    */
    public function meta($key, $default = '') {
        $meta = $this->get_meta($key);
        if (!$meta)
            return $default;

        return $meta->value;

    }

    /*
    * Handle request to update_meta
    *
    * @param \Illuminate\Http\Request $request
    */
    public function handles(\Illuminate\Http\Request $request) {
        $user = $this;
        $role = $request->input('role');
        $userinfos = Userinfo::whereId($request->input('userinfos_id'));

        // update language
        if ($lang = $request->input('language')) {
            User::whereId($user->id)->update(["language" => $lang]);
            Session::put('locale', $lang);
        }
        switch ($this->role) {
            case 1:
                if ($value = $request->input('first_name'))                    
                    $userinfos->update(["first_name" => $value]);
                if ($value = $request->input('last_name'))
                    $userinfos->update(["last_name" => $value]);
                break;
            case 5:
                $type = $request->input('type');
                if (strtolower($type) == 'person') {
                    // Update userinfo Member particulier (person)
                    if ($value = $request->input('first_name'))
                        $userinfos->update(["first_name" => $value]);
                    if ($value = $request->input('last_name'))
                        $userinfos->update(["last_name" => $value]);
                    if ($value = $request->input('nationality'))
                        $userinfos->update(["nationality" => $value]);
                    if ($value = $request->input('civility'))
                        $userinfos->update(["civility" => $value]);
                    if ($value = $request->input('sexe'))
                        $userinfos->update(["sexe" => $value]);

                    // User is complete
                    if ($value = $request->input('date_of_birth'))
                        $userinfos->update(["date_of_birth" => (new Carbon($value))->toDateString()]);
                    if ($value = $request->input('place_of_birth'))
                        $userinfos->update(["place_of_birth" => $value]);
                    if ($value = $request->input('orga_phone')) {
                        $ct_phone = $request->input('indicatif') . $value;
                        $userinfos->update(["orga_phone" => $ct_phone]);
                    }
                    if ($value = $request->input('orga_mobile_phone')) {
                        $ct_phone = $request->input('indicatif') . $value;
                    }
                    if ($value = $request->input('orga_phone')) {
                        $ct_phone = '(' . $request->input('indicatif') . ')' . $value;
                        $userinfos->update(["orga_phone" => $ct_phone]);
                    }
                    if ($value = $request->input('orga_mobile_phone')) {
                        $ct_phone = '(' . $request->input('indicatif3') . ')' . $value;
                        $userinfos->update(["orga_mobile_phone" => $ct_phone]);
                    }
                    if ($value = $request->input('orga_email'))
                        $userinfos->update(["orga_email" => $value]);
                    if ($value = $request->input('orga_skype'))
                        $userinfos->update(["orga_skype" => $value]);
                    if ($value = $request->input('orga_fb'))
                        $userinfos->update(["orga_fb" => $value]);

                } elseif (strtolower($type) == 'person_complete') {
                    $userloc = Localisation::whereId($user->location_id);

                    // Update userinfo Member particulier complete info
                    if ($value = $request->input('last_name'))
                        $userinfos->update(["last_name" => $value]);
                    if ($value = $request->input('first_name'))
                        $userinfos->update(["first_name" => $value]);
                    if ($value = $request->input('civility'))
                        $userinfos->update(["civility" => $value]);
                    if ($value = $request->input('nationality'))
                        $userinfos->update(["nationality" => $value]);
                    if ($value = $request->input('date_of_birth'))
                        $userinfos->update(["date_of_birth" => (new Carbon($value))->toDateString()]);
                    if ($value = $request->input('place_of_birth'))
                        $userinfos->update(["place_of_birth" => $value]);
                    if ($value = $request->input('orga_phone')) {
                        $ct_phone = $request->input('indicatif') . $value;
                        $userinfos->update(["orga_phone" => $ct_phone]);
                    }
                    if ($value = $request->input('orga_mobile_phone')) {
                        $ct_phone = $request->input('indicatif') . $value;
                    }
                    if ($value = $request->input('orga_phone')) {
                        $ct_phone = '(' . $request->input('indicatif') . ')' . $value;
                        $userinfos->update(["orga_phone" => $ct_phone]);
                    }
                    if ($value = $request->input('orga_mobile_phone')) {
                        $ct_phone = '(' . $request->input('indicatif3') . ')' . $value;
                        $userinfos->update(["orga_mobile_phone" => $ct_phone]);
                    }
                    if ($value = $request->input('orga_email'))
                        $userinfos->update(["orga_email" => $value]);
                    if ($value = $request->input('orga_skype'))
                        $userinfos->update(["orga_skype" => $value]);
                    if ($value = $request->input('orga_fb'))
                        $userinfos->update(["orga_fb" => $value]);

                    // Update location
                    if ($value = $request->input('country'))
                        $userloc->update(["country" => $value]);
                    if ($value = $request->input('route'))
                        $userloc->update(["route" => $value]);
                    if ($value = $request->input('route_number'))
                        $userloc->update(["route_number" => $value]);
                    if ($value = $request->input('area_level_2'))
                        $userloc->update(["area_level_2" => $value]);
                    if ($value = $request->input('postalCode'))
                        $userloc->update(["postalCode" => $value]);
                    if ($value = $request->input('area_level_2'))
                        $userloc->update(["area_level_2" => $value]);
                    if ($value = $request->input('adrphy_country'))
                        $userloc->update(["adrphy_country" => $value]);
                    if ($value = $request->input('adrpost_postal_box'))
                        $userloc->update(["adrpost_postal_box" => $value]);
                    if ($value = $request->input('adrpost_area_level_2'))
                        $userloc->update(["adrpost_area_level_2" => $value]);
                    if ($value = $request->input('adrpost_postalCode'))
                        $userloc->update(["adrpost_postalCode" => $value]);
                    if ($value = $request->input('adrpost_country'))
                        $userloc->update(["adrpost_country" => $value]);
                } else {
                    // Update userinfo Member organization
                    if ($value = $request->input('orga_phone')) {
                        $ct_phone = '(' . $request->input('indicatif') . ')' . $value;
                        $userinfos->update(["orga_phone" => $ct_phone]);
                    }
                    if ($value = $request->input('orga_fax'))
                        $userinfos->update(["orga_fax" => $value]);
                    if ($value = $request->input('orga_mobile_phone')) {
                        $ct_phone = '(' . $request->input('indicatif3') . ')' . $value;
                        $userinfos->update(["orga_mobile_phone" => $ct_phone]);
                    }
                    if ($value = $request->input('orga_name'))
                        $userinfos->update(["orga_name" => $value]);
                    if ($value = $request->input('orga_registration_number'))
                        $userinfos->update(["orga_registration_number" => $value]);
                    if ($value = $request->input('orga_rep_official_registration'))
                        $userinfos->update(["orga_rep_official_registration" => $value]);
                    if ($value = $request->input('orga_type'))
                        $userinfos->update(["orga_type" => $value]);
                    if ($value = $request->input('orga_form'))
                        $userinfos->update(["orga_form" => $value]);
                    if ($value = $request->input('orga_presentation'))
                        $userinfos->update(["orga_presentation" => $value]);
                    if ($value = $request->input('contact_name'))
                        $userinfos->update(["contact_name" => $value]);
                    if ($value = $request->input('contact_phone')) {
                        $ct_phone = '(' . $request->input('indicatif2') . ')' . $value;
                        $userinfos->update(["contact_phone" => $ct_phone]);
                    }
                    if ($value = $request->input('contact_email'))
                        $userinfos->update(["contact_email" => $value]);
                    if ($value = $request->input('newsletter'))
                        $userinfos->update(["newsletter" => $value]);
                    if ($value = $request->input('allow_sharing'))
                        $userinfos->update(["allow_sharing" => $value]);

                    // update localisation
                    // $userloc = Localisation::whereId($user->location_id);
                    // if ($value = $request->input('building_name'))
                    //         $userloc->update(["building_name" => $value]);
                    // if ($value = $request->input('route'))
                    //         $userloc->update(["route" => $value]);
                    // if ($value = $request->input('route_number'))
                    //         $userloc->update(["route_number" => $value]);
                    // if ($value = $request->input('num_rooms'))
                    //         $userloc->update(["num_rooms" => $value]);
                    // if ($value = $request->input('num_floor'))
                    //         $userloc->update(["num_floor" => $value]);
                    // if ($value = $request->input('locality'))
                    //         $userloc->update(["locality" => $value]);
                    // if ($value = $request->input('postalCode'))
                    //         $userloc->update(["postalCode" => $value]);
                    // if ($value = $request->input('area_level_1'))
                    //         $userloc->update(["area_level_1" => $value]);
                    // if ($value = $request->input('adrpost_postal_box'))
                    //         $userloc->update(["adrpost_postal_box" => $value]);
                    // if ($value = $request->input('adrpost_locality'))
                    //         $userloc->update(["adrpost_locality" => $value]);
                    // if ($value = $request->input('adrpost_postalCode'))
                    //         $userloc->update(["adrpost_postalCode" => $value]);
                    // if ($value = $request->input('adrpost_area_level_1'))
                    //         $userloc->update(["adrpost_area_level_1" => $value]);
                    // if ($value = $request->input('adrpost_country'))
                    //         $userloc->update(["adrpost_country" => $value]);
                }
                break;
            case 3:
                // Update MetaData
                if ($value = $request->input('orga_name'))
                    $userinfos->update(["orga_name" => $value]);
                if ($value = $request->input('orga_trading_name'))
                    $userinfos->update(["orga_trading_name" => $value]);
                if ($value = $request->input('orga_abn'))
                    $userinfos->update(["orga_abn" => $value]);
                if ($value = $request->input('orga_acn'))
                    $userinfos->update(["orga_acn" => $value]);
                if ($value = $request->input('orga_license_number'))
                    $userinfos->update(["orga_license_number" => $value]);
                if ($value = $request->input('orga_email'))
                    $userinfos->update(["orga_email" => $value]);
                if ($value = $request->input('orga_phone')){
                    $userinfos->update(["orga_phone" => '(+61)'.$value]);
                }
                if ($value = $request->input('orga_fax'))
                    $userinfos->update(["orga_fax" => $value]);
                if ($value = $request->input('orga_mobile_phone')) {
                    $userinfos->update(["orga_mobile_phone" => '(+61)'.$value]);
                }
                if ($value = $request->input('orga_website'))
                    $userinfos->update(["orga_website" => $value]);
                if ($value = $request->input('orga_presentation'))
                    $userinfos->update(["orga_presentation" => $value]);
                if ($value = $request->input('orga_operation_state'))
                    $userinfos->update(["orga_operation_state" => serialize($value)]);
                if ($value = $request->input('orga_operation_range'))
                    $userinfos->update(["orga_operation_range" => $value]);

                // Create Contact MetaData
                if ($value = $request->input('contact_name'))
                    $userinfos->update(["contact_name" => $value]);
                if ($value = $request->input('contact_email'))
                    $userinfos->update(["contact_email" => $value]);
                if ($value = $request->input('contact_phone')) {
                    $userinfos->update(["contact_phone" => '(+61)'.$value]);
                }

                // CRM Prodvider data
                // if ($value = $request->input('crm_name'))
                //     $userinfos->update(["crm_name" => $value]);
                // if ($value = $request->input('crm_email'))
                //     $userinfos->update(["crm_email" => $value]);
                break;
            case 4:
                // Update MetaData
                if ($value = $request->input('orga_name'))
                    $userinfos->update(["orga_name" => $value]);
                if ($value = $request->input('orga_registration_number'))
                    $userinfos->update(["orga_registration_number" => $value]);
                if ($value = $request->input('orga_license_number'))
                    $userinfos->update(["orga_license_number" => $value]);
                if ($value = $request->input('orga_type'))
                    $userinfos->update(["orga_type" => $value]);
                if ($value = $request->input('orga_form'))
                    $userinfos->update(["orga_form" => $value]);
                if ($value = $request->input('orga_presentation'))
                    $userinfos->update(["orga_presentation" => $value]);
                if ($value = $request->input('orga_operation_range'))
                    $userinfos->update(["orga_operation_range" => $value]);
                if ($value = $request->input('contact_name'))
                    $userinfos->update(["contact_name" => $value]);
                if ($value = $request->input('contact_email'))
                    $userinfos->update(["contact_email" => $value]);
                if ($value = $request->input('contact_phone')) {
                    $ct_phone = '(' . $request->input('indicatif') . ')' . $value;
                    $userinfos->update(["contact_phone" => $ct_phone]);
                }
                
                if ($value = $request->input('bank_name'))
                    $userinfos->update(["bank_name" => $value]);
                if ($value = $request->input('bank_agency'))
                    $userinfos->update(["bank_agency" => $value]);
                if ($value = $request->input('bank_iban'))
                    $userinfos->update(["bank_iban" => $value]);
                if ($value = $request->input('bank_bic'))
                    $userinfos->update(["bank_bic" => $value]);
                
                break;
            case 2:
                // Seller Natural Person (SNP)
                if($user->isSnp() || $user->isSbaIndividual()){
                    for ($i=0; $i < 2; $i++) { 
                        $tot = $i+1;
                        $sfx = $i!==0?'_'.$tot:'';

                        $si = SellerIndividual::whereId($request->input('id_seller'.$sfx));
                        if ($value = $request->input('last_name'.$sfx))
                            $si->update(["last_name" => $value]);
                        if ($value = $request->input('first_name'.$sfx))
                            $si->update(["first_name" => $value]);
                        if ($value = $request->input('date_of_birth'.$sfx)){
                           $dOb = new Carbon($value);
                            $dt = $dOb->toDateString();
                            $si->update(["date_of_birth" => $dt]);
                        }
                        if ($value = $request->input('place_of_birth'.$sfx))
                            $si->update(["place_of_birth" => $value]);
                        if ($value = $request->input('nationality'.$sfx))
                            $si->update(["nationality" => $value]);
                        if ($value = $request->input('street_adr'.$sfx))
                            $si->update(["street_adr" => $value]);
                        if ($value = $request->input('suburb'.$sfx))
                            $si->update(["suburb" => $value]);
                        if ($value = $request->input('city'.$sfx))
                            $si->update(["city" => $value]);
                        if ($value = $request->input('post_code'.$sfx))
                            $si->update(["post_code" => $value]);
                        if ($value = $request->input('country'.$sfx))
                            $si->update(["country" => $value]);
                        if ($value = $request->input('phone'.$sfx)){
                            $phone = '('.$request->input('indicatif'.$sfx).')'.$value;
                            $si->update(["phone" => $phone]);
                        }else{
                            $si->update(["phone" => '']);
                        }
                        if ($value = $request->input('email_adr'.$sfx))
                            $si->update(["email_adr" => $value]);
                        if ($value = $request->input('mobile'.$sfx)){
                            $mobile = '('.$request->input('indicatif3'.$sfx).')'.$value;
                            $si->update(["mobile" => $mobile]);
                        }else{
                            $si->update(["mobile" => '']);
                        }
                    }

                    if ($value = $request->input('contact_name'))
                        $userinfos->update(["contact_name" => $value]);
                    if ($value = $request->input('contact_email'))
                        $userinfos->update(["contact_email" => $value]);
                    if ($value = $request->input('contact_phone')) {
                        $ct_phone = '(+61)'.$value;
                        $userinfos->update(["contact_phone" => $ct_phone]);
                    }
                }else{
                    $sb = SellerBusiness::whereId($request->input('id_seller'));
                    if ($value = $request->input('business_name'))
                        $sb->update(["business_name" => $value]);
                    if ($value = $request->input('business_parent'))
                        $sb->update(["business_parent" => $value]);
                    if ($value = $request->input('street_adr'))
                        $sb->update(["street_adr" => $value]);
                    if ($value = $request->input('suburb'))
                        $sb->update(["suburb" => $value]);
                    if ($value = $request->input('city'))
                        $sb->update(["city" => $value]);
                    if ($value = $request->input('post_code'))
                        $sb->update(["post_code" => $value]);
                    if ($value = $request->input('country'))
                        $sb->update(["country" => $value]);
                    if ($value = $request->input('phone')){
                        $phone = '('.$request->input('indicatif').')'.$value;
                        $sb->update(["phone" => $phone]);
                    }
                    if ($value = $request->input('email_adr'))
                        $sb->update(["email_adr" => $value]);
                    if ($value = $request->input('mobile')){
                        $mobile = '('.$request->input('indicatif3').')'.$value;
                        $sb->update(["mobile" => $mobile]);
                    }
                }
                break;
        }

        // Common datas
        if ($value = $request->input('newsletter'))
            $userinfos->update(["newsletter" => $value]);
        if ($value = $request->input('allow_sharing'))
            $userinfos->update(["allow_sharing" => $value]);
    }

    /**
     * An user can have any info
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userinfos() {
        return $this->hasOne(Userinfo::class, 'user_id', 'id');
    }

    public function sendPasswordResetNotification($token) {
        $user = $this;
        $this->notify(new PasswordReseted($user, $token));
    }

    /**
     * Check if user has afa
     *
     * @return Boolean
     */
    public function hasAfa() {
        return ($this->afa_id !== 0);
    }

    /**
     * Check if user is moving
     *
     * @return Boolean
     */
    public function isMove() {
        return ($this->is_move !== 0);
    }

    /**
     * A user can have one default AFA
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function afa() {
        return $this->hasOne(User::class, 'id', 'afa_id');
    }

    /**
     * Check if user info is complete 
     * 0:complete 1:uncomplete
     *
     * @return Boolean
     */
    public function isComplete() {
        return ($this->is_complete === 0);
    }

    /**
     * Check if user has avatar
     *
     * @return Boolean
     */
    public function hasAvatar() {
        return ($this->image_id !== 0);
    }

    /**
     * An user can have any seller individual
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sellerIndividual() {
        return $this->hasMany(SellerIndividual::class,'user_id','id')->orderBy('id','ASC')->get();
    }

    /**
     * An user can have any seller Business
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sellerBusiness() {
        return $this->hasMany(SellerBusiness::class,'user_id','id')->first();
    }

    public function historiques() {
        return $this->hasMany(RelationMembreApl::class, 'apl_id', 'id');
    }

    public function scopeHasAplActiveRelation() {
        return $this->where('role', '=', '5')->where('apl_id', '!=', '0')->where('apl_ends_at',
            '>=', Carbon::now())->get();
    }

    public function isCheckedDossierTransaction($prod_id) {
        $dosTransUser = DossierTransaction::where('user_id', $this->id)->where('product_id',
            $prod_id)->first();

        if ($dosTransUser !== null) {
            return true;
        }

        return false;
    }

    public function dossierTransactionIsComplete($prod_id) {
        $dosTransUser = DossierTransaction::where('user_id', $this->id)->where('product_id',
            $prod_id)->first();
        $isComplete = "";

        switch ($dosTransUser->is_complete) {
            case 1:
                $isComplete = 'to_be_completed';
                break;
            case 2:
                $isComplete = 'complete';
                break;
            case 3:
                $isComplete = 'validate';
                break;
            default:
                $isComplete = 'not_completed';
                break;
        }

        return $isComplete;
    }

    public function hasCurrentTransaction() {
        $dosTransUser = DossierTransaction::where('user_id', $this->id)->where('status',
            0)->get();

        if (sizeof($dosTransUser) !== 0) {
            return true;
        }

        return false;
    }

    public function hasDossierTransactionInitialDeposit() {
        $initDeposit = DossierTransaction::where('afa_id', $this->id)->where('status','=',
            11)->get();

        if (sizeof($initDeposit) !== 0) {
            return true;
        }

        return false;
    }
    
    public function hasCurrentDossierTransaction($id_product) {
        $dosTransUser = DossierTransaction::where('user_id', $this->id)->where('product_id',
        $id_product)->get();

        if (sizeof($dosTransUser) !== 0) {
            return true;
        }

        return false;
    }

    public function getCurrentStatusTransaction($prod_id) {
        $dosTransUser = DossierTransaction::where('user_id', $this->id)->where('product_id',$prod_id)->first();

        if (sizeof($dosTransUser) !== 0) {
            return $dosTransUser->status;
        }

        return 0;
    }

    public function getCurrentStatusTransactionAfa($prod_id) {
        $dosTransUser = DossierTransaction::where('afa_id', $this->id)->where('product_id',$prod_id)->first();

        if (sizeof($dosTransUser) !== 0) {
            return $dosTransUser->status;
        }

        return 0;
    }

    public function getUserCurrentTransaction($prod_id) {
        $dosTransUser = DossierTransaction::where('user_id', $this->id)->where('product_id',$prod_id)->first();

        if (sizeof($dosTransUser) !== 0) {
            return $dosTransUser->id;
        }

        return 0;
    }

    public function getDossierTransaction() {
        $dossierTrans = DossierTransaction::where('user_id', $this->id)->where('status','!=',14);

        return $dossierTrans;
    }
    
    public function getDossierTransactionAfa() {
        $dossierTrans = DossierTransaction::where('afa_id', $this->id)->where('status','!=',14);

        return $dossierTrans;
    }

    public function dossierTransaction() {
        $dossierTrans = DossierTransaction::where('user_id', $this->id)->where('status',0);

        return $dossierTrans;
    }

    public function afaHasSendCa($from_id, $to_id) {
        $ca = Product::conjunctionAgreement()->where('from_id', '=', $from_id)->where('to_id',
            '=', $to_id)->first();
        if (sizeof($ca) !== 0) {            
            if ($ca->status === 0) {
                return false;
            } else {
                return true;
            }
        }

        return true;
    }

    public function conjunctionAgreement($from_id, $to_id) {
        $ca = Product::conjunctionAgreement()->where('from_id', '=', $from_id)->where('to_id',
            '=', $to_id)->first();

        if (sizeof($ca) !== 0) {
            return $ca;
        }

        return '';
    }

    public function memberHasSendMr($from_id, $to_id, $afa_id) {
        $mr = Product::mandatRecherche()->where('from_id', '=', $from_id)->where('to_id',
            '=', $to_id)->where('afa_id', '=', $afa_id)->first();

        if (sizeof($mr) !== 0) {
            if ($mr->status === 0) {
                return false;
            } else {
                return true;
            }
        }

        return true;
    }

    public function mandatRecherche($from_id, $to_id, $afa_id) {
        $mr = Product::mandatRecherche()->where('from_id', '=', $from_id)->where('to_id',
            '=', $to_id)->where('afa_id', '=', $afa_id)->first();

        if (sizeof($mr) !== 0) {
            return $mr;
        }

        return '';
    }

    public function deleteUser(){
        DB::table('users')->where('id', $this->id)->delete();
        DB::table('localizations')->where('id', $this->location_id)->delete();

        return '';
    }

    public function contract(){
        return $this->hasMany(Contract::class,'user_id','id')->first();
    }

    public function isToSignContract(){
        $contr = Contract::whereRaw('id = (select max(`id`) from contracts where user_id=?)',[$this->id])->first();
        if (sizeof($contr) > 0) {
            if($contr->status_contract == 0)
                return true;
            else
                return false;
        }

        return false;
    }

    public function isSigned(){
        $contr = Contract::whereRaw('id = (select max(`id`) from contracts where user_id=?)',[$this->id])->first();
        if (sizeof($contr) > 0) {
            if($contr->status_contract == 1)
                return true;
            else
                return false;
        }

        return false;
    }
    
    public function isValidate(){
        $contr = Contract::whereRaw('id = (select max(`id`) from contracts where user_id=?)',[$this->id])->first();
        if (sizeof($contr) > 0) {
            if($contr->status_contract == 2)
                return true;
            else
                return false;
        }

        return false;
    }
    
    public function isRejected(){
        $contr = Contract::whereRaw('id = (select max(`id`) from contracts where user_id=?)',[$this->id])->first();
        if (sizeof($contr) > 0) {
            if($contr->status_contract == 3)
                return true;
            else
                return false;
        }

        return false;
    }


}
