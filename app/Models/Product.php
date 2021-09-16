<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\EoiDossier;


class Product extends Model {

    use SoftDeletes;
    public $guarded = ["id","created_at","updated_at"];
    protected $dates = ['deleted_at'];

    public static function findRequested()
    {
        $query = Product::query();
        $query->where('parent_id','!=',0);
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
        \Request::input('commission_type') and $query->where('commission_type',\Request::input('commission_type'));
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
        return $query->paginate(15);
    }
    
    public static function allProduitIsole()
    {
        $query = Product::query();
        $query->where('parent_id','=',-1);
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
        \Request::input('commission_type') and $query->where('commission_type',\Request::input('commission_type'));
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
        return $query->paginate(15);
    }
    
    public static function allProductUser()
    {
        $query = Product::query();
        $query->where('parent_id','!=',0);
        $query->where('author_id', Auth::id());
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
        \Request::input('commission_type') and $query->where('commission_type',\Request::input('commission_type'));
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
        return $query->paginate(15);
    }
    
    public static function allProgramme()
    {
        $query = Product::query();
        $query->where('parent_id',0);
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
        \Request::input('commission_type') and $query->where('commission_type',\Request::input('commission_type'));
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
        \Request::input('min_price') and $query->where('min_price',\Request::input('min_price'));
        \Request::input('max_price') and $query->where('max_price',\Request::input('max_price'));
        
        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(15);
    }
    
    public static function allProgrammeUser()
    {
        $query = Product::query();
        $query->where('parent_id',0);
        $query->where('author_id',Auth::id());
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
        \Request::input('commission_type') and $query->where('commission_type',\Request::input('commission_type'));
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
        \Request::input('min_price') and $query->where('min_price',\Request::input('min_price'));
        \Request::input('max_price') and $query->where('max_price',\Request::input('max_price'));
        
        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(15);
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
            'commission_type' => '',
            'commision' => '',
            'commision_edited' => 'required|integer',
            'status' => 'required|string|max:20',
            'type_id' => 'required',
            'location_type_id' => 'required',
            'category_id' => '',
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

    /**
     * Scope a query to only include products of a given $status.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to only include products is parent.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $parent_id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsParent($query, $parent_id)
    {
        return $query->where('parent_id', $parent_id);
    }

    /**
     * Scope a query to only include products have parent.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsProduct($query)
    {
        return $query->where('parent_id', '!=', 0);
    }


    /**
     * Check if product is disponible (quantity>0)
     *
     * @return Boolean
     */
    public function isDisponible()
    {
        return ($this->quantity>0 && $this->status=='published');
    }

    /**
     * Excerpt
     *
     * @param int $length
     * @return String
     */
    public function excerpt($length = 100)
    {
        return substr($this->content, 0, $length);
    }

    /**
     * Get Url of Attached Image OR Default Image
     *
     * @param Boolean $thumb
     * @return String
     */
    public function imageUrl($thumb=false)
    {
        // Image is setted
        if($this->image){
            if($thumb) return thumbnail($this->image->filepath);
            return storage($this->image->filepath);
        }
        return asset('images/product.png');
    }

    /**
     * Get the type record associated with the product.
     */
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id')
            ->ofObject('type');
    }

    /**
     * Get the location type record associated with the product.
     */
    public function locationType()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id')
            ->ofObject('location');
    }

    /**
     * Get the image record associated with the product.
     */
    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id', 'id');
    }

    /**
     * A product can have many images
     *
     * @return \Illuminate\Database\Eloquent\Relations\ManyToMany
     */
    public function images()
    {
        return $this->belongsToMany(Image::class, 'products_images', 'product_id', 'image_id');
    }

    /**
     * Get the buyer record associated with the product.
     */
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id', 'id');
    }

    /**
     * Get the seller record associated with the product.
     */
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }

    /**
     * Get the author record associated with the product.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    /**
     * A product can have one category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    /**
     * A product can have many categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\ManyToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'objects_categories', 'object_id', 'category_id')
            ->wherePivot('object_type', Product::class);
    }


    /**
     * A product can have one location
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function location()
    {
        return $this->hasOne(Localisation::class, 'id', 'location_id');
    }


    /**
     * A product can have many images
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product_image()
    {
        return $this->hasMany(ProductsImage::class, 'product_id', 'id');
    }

    public function scopeConjunctionAgreement(){
        
        return Product::select('ca.*')->join('conjunction_agreements as ca','products.id','=','ca.product_id');
    }

    public function scopeMandatRecherche(){
        
        return Product::select('mr.*')->join('mandat_recherches as mr','products.id','=','mr.product_id');
    }
    
    /**
     * Check if product is exclusive agency
     *
     * @return Boolean
     */
    public function isExclusiveAgency()
    {
        if($this->author->role !== 3){
            return true;
        }

        return false;
    }

    /**
     * Check if product is save by Seller by afa.
     */
    public function isSellerByAfa()
    {
        if($this->author->afa_id !== 0){
            return true;
        }

        return false;
    }

    /**
     * Check if product is save by Seller by afa.
     */
    public function afa()
    {
        return User::whereId($this->author->afa_id)->get();
    }

    public function productEoi()
    {
        return $this->hasMany(EoiDossier::class);
    }

    /**
     * Check if IEO product is finalized
     * boolean
     */
    public function eoiIsFinalized(){
        return file_exists(public_path('uploads/pdf/transaction/'.$this->productEoi->first()->image->first()->filename));
    }

}

