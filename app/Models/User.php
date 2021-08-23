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
        'location_id', 'status', 'type', 'role', 'activation_code',
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

        // search results based on user input
        \Request::input('id') and $query->where('id', \Request::input('id'));
        \Request::input('name') and $query->where('name', 'like', '%' . \Request::input
            ('name') . '%');
        \Request::input('email') and $query->where('email', 'like', '%' . \Request::input
            ('email') . '%');
        \Request::input('password') and $query->where('password', 'like', '%' . \Request::input
            ('password') . '%');
        \Request::input('role') and $query->where('role', 'like', '%' . \Request::input
            ('role') . '%');
        \Request::input('type_users_id') and $query->where('type_users_id', 'like', '%' . \Request::input
            ('type_users_id') . '%');
        \Request::input('language') and $query->where('language', 'like', '%' . \Request::input
            ('language') . '%');
        \Request::input('status') and $query->where('status', 'like', '%' . \Request::input
            ('status') . '%');
        \Request::input('percent') and $query->where('percent', \Request::input('percent'));
        \Request::input('enabled_at') and $query->where('enabled_at', \Request::input('enabled_at'));
        \Request::input('disabled_at') and $query->where('disabled_at', \Request::input
            ('disabled_at'));
        \Request::input('use_default_password') and $query->where('use_default_password', \Request::input
            ('use_default_password'));
        \Request::input('is_seller') and $query->where('is_seller', \Request::input('is_seller'));
        \Request::input('apl_id') and $query->where('apl_id', \Request::input('apl_id'));
        \Request::input('apl_ends_at') and $query->where('apl_ends_at', \Request::input
            ('apl_ends_at'));
        \Request::input('image_id') and $query->where('image_id', \Request::input('image_id'));
        \Request::input('author_id') and $query->where('author_id', \Request::input('author_id'));
        \Request::input('location_id') and $query->where('location_id', \Request::input
            ('location_id'));
        \Request::input('country_id') and $query->where('country_id', \Request::input('country_id'));
        \Request::input('operation_range') and $query->where('operation_range', \Request::input
            ('operation_range'));
        \Request::input('state_id') and $query->where('state_id', \Request::input('state_id'));
        \Request::input('activation_code') and $query->where('activation_code', 'like',
            '%' . \Request::input('activation_code') . '%');
        \Request::input('remember_token') and $query->where('remember_token', 'like',
            '%' . \Request::input('remember_token') . '%');
        \Request::input('created_at') and $query->where('created_at', \Request::input('created_at'));
        \Request::input('updated_at') and $query->where('updated_at', \Request::input('updated_at'));
        \Request::input('braintree_id') and $query->where('braintree_id', 'like', '%' . \Request::input
            ('braintree_id') . '%');
        \Request::input('paypal_email') and $query->where('paypal_email', 'like', '%' . \Request::input
            ('paypal_email') . '%');
        \Request::input('stripe_id') and $query->where('stripe_id', 'like', '%' . \Request::input
            ('stripe_id') . '%');
        \Request::input('card_brand') and $query->where('card_brand', 'like', '%' . \Request::input
            ('card_brand') . '%');
        \Request::input('card_last_four') and $query->where('card_last_four', 'like',
            '%' . \Request::input('card_last_four') . '%');
        \Request::input('trial_ends_at') and $query->where('trial_ends_at', \Request::input
            ('trial_ends_at'));
        \Request::input('subscription_ends_at') and $query->where('subscription_ends_at', \Request::input
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
        return $query->where('type', $type);
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
    public function scopeHasPostalCode($query,$postal_code) {
        
        return $query->join('localizations','users.location_id','=','localizations.id')->where('localizations.postalCode',$postal_code);
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
        return $this->hasRole(5) && ($this->type == 2);
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
        return $this->hasMany(Product::class, 'seller_id', 'id');
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
        return $this->belongsToMany(Mail::class, 'mails_users', 'user_id', 'mail_id');
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
                if ($type == 'person') {
                    // Update MetaData
                    if ($value = $request->input('first_name'))
                        $userinfos->update(["first_name" => $value]);
                    if ($value = $request->input('last_name'))
                        $userinfos->update(["last_name" => $value]);
                    if ($value = $request->input('sexe'))
                        $userinfos->update(["sexe" => $value]);
                } elseif ($type == 'person_complete') {
                    $userloc = Localisation::whereId($user->location_id);

                    // Update userinfo
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
                    if ($value = $request->input('orga_phone'))
                        $userinfos->update(["orga_phone" => $value]);
                    if ($value = $request->input('orga_mobile_phone'))
                        $userinfos->update(["orga_mobile_phone" => $value]);
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
                    // Update MetaData
                    if ($value = $request->input('orga_name'))
                        $userinfos->update(["orga_name" => $value]);
                    if ($value = $request->input('orga_email'))
                        $userinfos->update(["orga_email" => $value]);
                    if ($value = $request->input('orga_phone'))
                        $userinfos->update(["orga_phone" => $value]);
                    if ($value = $request->input('orga_website'))
                        $userinfos->update(["orga_website" => $value]);
                    if ($value = $request->input('orga_presentation'))
                        $userinfos->update(["orga_presentation" => $value]);
                    // Create Contact MetaData
                    if ($value = $request->input('contact_name'))
                        $userinfos->update(["contact_name" => $value]);
                    if ($value = $request->input('contact_email'))
                        $userinfos->update(["contact_email" => $value]);
                    if ($value = $request->input('contact_phone'))
                        $userinfos->update(["contact_phone" => $value]);
                    // Create CRM MetaData
                    if ($value = $request->input('crm_name'))
                        $userinfos->update(["crm_name" => $value]);
                    if ($value = $request->input('crm_email'))
                        $userinfos->update(["crm_email" => $value]);
                }
                break;
            case 3:
                // Update MetaData
                if ($value = $request->input('orga_name'))
                    $userinfos->update(["orga_name" => $value]);
                if ($value = $request->input('orga_presentation'))
                    $userinfos->update(["orga_presentation" => $value]);
                if ($value = $request->input('orga_email'))
                    $userinfos->update(["orga_email" => $value]);
                if ($value = $request->input('orga_phone'))
                    $userinfos->update(["orga_phone" => $value]);
                if ($value = $request->input('orga_website'))
                    $userinfos->update(["orga_website" => $value]);
                if ($value = $request->input('orga_operation_state'))
                    $userinfos->update(["orga_operation_state" => $value]);
                if ($value = $request->input('orga_operation_range'))
                    $userinfos->update(["orga_operation_range" => $value]);

                // Create Contact MetaData
                if ($value = $request->input('contact_name'))
                    $userinfos->update(["contact_name" => $value]);
                if ($value = $request->input('contact_email'))
                    $userinfos->update(["contact_email" => $value]);
                if ($value = $request->input('contact_phone'))
                    $userinfos->update(["contact_phone" => $value]);

                // CRM Prodvider data
                if ($value = $request->input('crm_name'))
                    $userinfos->update(["crm_name" => $value]);
                if ($value = $request->input('crm_email'))
                    $userinfos->update(["crm_email" => $value]);
                break;
            case 4:
                // Update MetaData
                if ($value = $request->input('orga_name'))
                    $userinfos->update(["orga_name" => $value]);
                if ($value = $request->input('orga_presentation'))
                    $userinfos->update(["orga_presentation" => $value]);
                if ($value = $request->input('orga_email'))
                    $userinfos->update(["orga_email" => $value]);
                if ($value = $request->input('orga_phone'))
                    $userinfos->update(["orga_phone" => $value]);
                if ($value = $request->input('orga_website'))
                    $userinfos->update(["orga_website" => $value]);
                if ($value = $request->input('orga_operation_range'))
                    $userinfos->update(["orga_operation_range" => $value]);

                // Create Contact MetaData
                if ($value = $request->input('contact_name'))
                    $userinfos->update(["contact_name" => $value]);
                if ($value = $request->input('contact_email'))
                    $userinfos->update(["contact_email" => $value]);
                if ($value = $request->input('contact_phone'))
                    $userinfos->update(["contact_phone" => $value]);

                // Bank data
                if ($value = $request->input('bank_iban'))
                    $userinfos->update(["bank_iban" => $value]);
                if ($value = $request->input('bank_bic'))
                    $userinfos->update(["bank_bic" => $value]);

                // CRM Prodvider data
                if ($value = $request->input('crm_name'))
                    $userinfos->update(["crm_name" => $value]);
                if ($value = $request->input('crm_email'))
                    $userinfos->update(["crm_email" => $value]);
                break;
            case 2:
                // Create Organisation MetaData
                if ($value = $request->input('orga_name'))
                    $userinfos->update(["orga_name" => $value]);
                if ($value = $request->input('orga_presentation'))
                    $userinfos->update(["orga_presentation" => $value]);
                if ($value = $request->input('orga_email'))
                    $userinfos->update(["orga_email" => $value]);
                if ($value = $request->input('orga_phone'))
                    $userinfos->update(["orga_phone" => $value]);
                if ($value = $request->input('orga_website'))
                    $userinfos->update(["orga_website" => $value]);

                // Create Contact MetaData
                if ($value = $request->input('contact_name'))
                    $userinfos->update(["contact_name" => $value]);
                if ($value = $request->input('contact_email'))
                    $userinfos->update(["contact_email" => $value]);
                if ($value = $request->input('contact_phone'))
                    $userinfos->update(["contact_phone" => $value]);

                // CRM Prodvider data
                if ($value = $request->input('crm_name'))
                    $userinfos->update(["crm_name" => $value]);
                if ($value = $request->input('crm_email'))
                    $userinfos->update(["crm_email" => $value]);
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
        // return $this->hasOne(SellerIndividual::class,'user_id','id');
    }

    /**
     * An user can have any seller Business
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sellerBusiness() {
        // return $this->hasOne(SellerBusiness::class,'user_id','id');
    }

    public function historiques() {
        return $this->hasMany(RelationMembreApl::class,'apl_id','id');
    }

    public function  scopeHasAplActiveRelation(){
        return $this->where('role','=','5')
                    ->where('apl_id','!=','0')
                    ->where('apl_ends_at','>=',Carbon::now())
                    ->get();
    }

    public function isCheckedDossierTransaction($prod_id){
        $dosTransUser = DossierTransaction::where('user_id',$this->id)->where('product_id',$prod_id)->first();
        
        if($dosTransUser !== null){
            return true;
        }

        return false;
    }

    public function hasCurrentTransaction(){
        $dosTransUser = DossierTransaction::where('user_id',$this->id)->where('status','current')->get();

        if(sizeof($dosTransUser) !== 0){
            return true;
        }

        return false;
    }

    public function dossierTransaction(){
        $dossierTrans = DossierTransaction::where('user_id',$this->id)->where('status','current');

        return $dossierTrans;
    }

    public function afaHasSendCa($from_id,$to_id){
        $ca = Product::conjunctionAgreement()->where('from_id','=',$from_id)->where('to_id','=',$to_id)->first();

        if(sizeof($ca)!==0){
            if($ca->status === 0){
                return false;
            }else{
                return true;
            }
        }

        return true;
    }

    public function conjunctionAgreement($from_id,$to_id){
        $ca = Product::conjunctionAgreement()->where('from_id','=',$from_id)->where('to_id','=',$to_id)->first();

        if(sizeof($ca)!==0){
            return $ca;
        }

        return '';
    }

    public function memberHasSendMr($from_id,$to_id,$afa_id){
        $mr = Product::mandatRecherche()->where('from_id','=',$from_id)->where('to_id','=',$to_id)->where('afa_id','=',$afa_id)->first();

        if(sizeof($mr)!==0){
            if($mr->status === 0){
                return false;
            }else{
                return true;
            }
        }

        return true;
    }

    public function mandatRecherche($from_id,$to_id,$afa_id){
        $mr = Product::mandatRecherche()->where('from_id','=',$from_id)->where('to_id','=',$to_id)->where('afa_id','=',$afa_id)->first();

        if(sizeof($mr)!==0){
            return $mr;
        }

        return '';
    }

}
