<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Search extends BaseModel
{
    
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'searches';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'author_id'
    ];
    
    /**
     * Create a new model instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->author_id = (\Auth::check()?\Auth::user()->id:0);
    }
    
    /**
     * A user can have one parent
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function author()
    {
      return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function getDataSearchWithSlug(){

    }

    public function getDataSearchWithoutSlug(){
      $datas=[];

      $typesRes = Type::orderBy('title', 'asc')
            ->where('object_type', 'type')
            ->where('categories_id', 1)
            ->get();
        
        $typesFonc = Type::orderBy('title', 'asc')
            ->where('object_type', 'type')
            ->where('categories_id', 2)
            ->get();

        $typesInd = Type::orderBy('title', 'asc')
            ->where('object_type', 'type')
            ->where('categories_id', 3)
            ->get();
        
        $typesComm = Type::orderBy('title', 'asc')
            ->where('object_type', 'type')
            ->where('categories_id', 4)
            ->get();
        
        $locationTypes = Type::orderBy('title', 'asc')
            ->where('object_type', 'location')
            ->get();

        $anciennetes = Type::orderBy('title', 'asc')
            ->where('object_type', 'anciennete')
            ->get();

        $agricoles = Type::orderBy('title', 'asc')
            ->where('object_type', 'agricole')
            ->get();

        $industriels = Type::orderBy('title', 'asc')
            ->where('object_type', 'industriel')
            ->get();
        
        $commercials = Type::orderBy('title', 'asc')
            ->where('object_type', 'commercial')
            ->get();
        
        $states = State::orderBy('content', 'asc')
            ->get();

        $min_price_residentiel = Product::groupBy('category_id')
            ->where('category_id','=',1)
            ->min('price');

        $max_price_residentiel = Product::groupBy('category_id')
            ->where('category_id','=',1)
            ->max('price');
        
        $min_land_area_residentiel = Product::groupBy('category_id')
            ->where('category_id','=',1)
            ->min('land_area');

        $max_land_area_residentiel = Product::groupBy('category_id')
            ->where('category_id','=',1)
            ->max('land_area');
        
        $min_garage_space_residentiel = Product::groupBy('category_id')
            ->where('category_id','=',1)
            ->min('garage_spaces');

        $max_garage_space_residentiel = Product::groupBy('category_id')
            ->where('category_id','=',1)
            ->max('garage_spaces');

        $min_bathrooms_residentiel = Product::groupBy('category_id')
            ->where('category_id','=',1)
            ->min('bathrooms');

        $max_bathrooms_residentiel = Product::groupBy('category_id')
            ->where('category_id','=',1)
            ->max('bathrooms');

        $min_bedrooms_residentiel = Product::groupBy('category_id')
            ->where('category_id','=',1)
            ->min('bedrooms');

        $max_bedrooms_residentiel = Product::groupBy('category_id')
            ->where('category_id','=',1)
            ->max('bedrooms');
        
        $min_number_of_floors_residentiel = Product::groupBy('category_id')
            ->where('category_id','=',1)
            ->min('number_of_floors');

        $max_number_of_floors_residentiel = Product::groupBy('category_id')
            ->where('category_id','=',1)
            ->max('number_of_floors');
        
        $min_price_foncier = Product::groupBy('category_id')
            ->where('category_id','=',2)
            ->min('price');

        $max_price_foncier = Product::groupBy('category_id')
            ->where('category_id','=',2)
            ->max('price');
        
        $min_land_area_foncier = Product::groupBy('category_id')
            ->where('category_id','=',2)
            ->min('land_area');

        $max_land_area_foncier = Product::groupBy('category_id')
            ->where('category_id','=',2)
            ->max('land_area');
        
        $min_price_industriel = Product::groupBy('category_id')
            ->where('category_id','=',3)
            ->min('price');

        $max_price_industriel = Product::groupBy('category_id')
            ->where('category_id','=',3)
            ->max('price');

        $min_price_commercial = Product::groupBy('category_id')
            ->where('category_id','=',4)
            ->min('price');

        $max_price_commercial = Product::groupBy('category_id')
            ->where('category_id','=',4)
            ->max('price');
        
        $min_area_commercial = Product::groupBy('category_id')
            ->where('category_id','=',4)
            ->min('land_area');

        $max_area_commercial = Product::groupBy('category_id')
            ->where('category_id','=',4)
            ->max('land_area');

        $datas = [
          'cat'=>'search',
          'states'=>$states,
          'typesRes'=>$typesRes,
          'typesFonc'=>$typesFonc,
          'typesInd'=>$typesInd,
          'typesComm'=>$typesComm,
          'anciennetes'=>$anciennetes,
          'locationTypes'=>$locationTypes,
          'agricoles'=>$agricoles,
          'industriels'=>$industriels,
          'commercials'=>$commercials,
          'max_price_residentiel'=>$max_price_residentiel,
          'min_price_residentiel'=>$min_price_residentiel,
          'min_land_area_residentiel'=>$min_land_area_residentiel,
          'max_land_area_residentiel'=>$max_land_area_residentiel,
          'min_garage_space_residentiel'=>$min_garage_space_residentiel,
          'max_garage_space_residentiel'=>$max_garage_space_residentiel,
          'min_bathrooms_residentiel'=>$min_bathrooms_residentiel,
          'max_bathrooms_residentiel'=>$max_bathrooms_residentiel,
          'min_bedrooms_residentiel'=>$min_bedrooms_residentiel,
          'max_bedrooms_residentiel'=>$max_bedrooms_residentiel,
          'min_number_of_floors_residentiel'=>$min_number_of_floors_residentiel,
          'max_number_of_floors_residentiel'=>$max_number_of_floors_residentiel,
          'min_price_foncier'=>$min_price_foncier,
          'max_price_foncier'=>$max_price_foncier,
          'min_land_area_foncier'=>$min_land_area_foncier,
          'max_land_area_foncier'=>$max_land_area_foncier,
          'min_price_industriel'=>$min_price_industriel,
          'max_price_industriel'=>$max_price_industriel,
          'min_price_commercial'=>$min_price_commercial,
          'max_price_commercial'=>$max_price_commercial,
          'min_area_commercial'=>$min_area_commercial,
          'max_area_commercial'=>$max_area_commercial];

        return $datas;
    }
}
