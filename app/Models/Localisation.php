<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


// Eloquent Model to manage Latitude,Longitude, City, Country, etc
class Localisation extends Model
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'localizations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'formatted', 
        'country',
        'area_level_1',  
        'area_level_2', 
        'locality', 
        'route', 
        'postalCode', 
        'longitude',
        'latitude', 
        'altitude',
        'building_name',
        'route_number',
        'num_rooms',
        'num_floor',
        'neighborhood',
        'adrphy_country',
        'adrpost_postal_box',
        'adrpost_locality',
        'adrpost_postalCode',
        'adrpost_area_level_1',
        'adrpost_area_level_2',
        'adrpost_country',
        'bank_postal_box',
        'bank_locality',
        'bank_postalCode',
        'bank_area_level_1',
        'bank_country',
    ];
    
    
    /**
     * Return Location String
     *
     * @return String
     */
    public function toString()
    {
        return $this->route.', '. $this->locality.', '. $this->country;
    }
    
    /*
    * Description : Calcul de la distance entre 2 points en fonction de leur latitude/longitude
    *
    * @param Localization $location
    * @param mixed $unity
    * @return Double
    */
    function getDistance(Localisation $location, $unit = 'km') {
        $point1_lat = $this->latitude;
        $point1_long = $this->longitude;
        $point2_lat = $location->latitude;
        $point2_long = $location->longitude;
        
        // Calcul de la distance en degrés
        $degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));

        // Conversion de la distance en degrés à l'unité choisie (kilomètres, milles ou milles nautiques)
        switch($unit) {
            case 'km':
                $distance = $degrees * 111.13384; // 1 degré = 111,13384 km, sur base du diamètre moyen de la Terre (12735 km)
                break;
            case 'mi':
                $distance = $degrees * 69.05482; // 1 degré = 69,05482 milles, sur base du diamètre moyen de la Terre (7913,1 milles)
                break;
            case 'nmi':
                $distance =  $degrees * 59.97662; // 1 degré = 59.97662 milles nautiques, sur base du diamètre moyen de la Terre (6,876.3 milles nautiques)
        }
        return round($distance, 2);
    }
    
    /**
     * An location can have many products
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
      return $this->hasMany(Product::class, 'location_id', 'id');
    }
    
    /**
     * An location can have many users
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
      return $this->hasMany(User::class, 'location_id', 'id');
    }

    public static function updateLocalisation($id,$datas){
        $localisation = Localisation::whereId($id);

        if (isset($datas['country']))
            $localisation->update(["country" => $datas['country']]);
        if (isset($datas['area_level_1']))
            $localisation->update(["area_level_1" => $datas['area_level_1']]);
        if (isset($datas['area_level_2']))
            $localisation->update(["area_level_2" => $datas['area_level_2']]);
        if (isset($datas['locality'])){
            $localisation->update(["locality" => $datas['locality']]);
            $localisation->update(["formatted" => $datas['locality']]);
        }
        if (isset($datas['route']))
            $localisation->update(["route" => $datas['route']]);
        if (isset($datas['postalCode']))
            $localisation->update(["postalCode" => $datas['postalCode']]);
        if (isset($datas['longitude']))
            $localisation->update(["longitude" => $datas['longitude']]);
        if (isset($datas['latitude']))
            $localisation->update(["latitude" => $datas['route']]);
        if (isset($datas['altitude']))
            $localisation->update(["altitude" => $datas['altitude']]);
        if (isset($datas['building_name']))
            $localisation->update(["building_name" => $datas['building_name']]);
        if (isset($datas['route_number']))
            $localisation->update(["route_number" => $datas['route_number']]);
        if (isset($datas['num_rooms']))
            $localisation->update(["num_rooms" => $datas['num_rooms']]);
        if (isset($datas['num_floor']))
            $localisation->update(["num_floor" => $datas['num_floor']]);
        if (isset($datas['neighborhood']))
            $localisation->update(["neighborhood" => $datas['neighborhood']]);
        if (isset($datas['adrphy_country']))
            $localisation->update(["adrphy_country" => $datas['adrphy_country']]);
        if (isset($datas['adrpost_postal_box']))
            $localisation->update(["adrpost_postal_box" => $datas['adrpost_postal_box']]);
        if (isset($datas['adrpost_postal_locality']))
            $localisation->update(["adrpost_postal_locality" => $datas['adrpost_postal_locality']]);
        if (isset($datas['adrpost_postalCode']))
            $localisation->update(["adrpost_postalCode" => $datas['adrpost_postalCode']]);
        if (isset($datas['adrpost_locality']))
            $localisation->update(["adrpost_locality" => $datas['adrpost_locality']]);
        if (isset($datas['adrpost_area_level_1']))
            $localisation->update(["adrpost_area_level_1" => $datas['adrpost_area_level_1']]);
        if (isset($datas['adrpost_area_level_2']))
            $localisation->update(["adrpost_area_level_2" => $datas['adrpost_area_level_2']]);
        if (isset($datas['adrpost_country']))
            $localisation->update(["adrpost_country" => $datas['adrpost_country']]);
        if (isset($datas['bank_postal_box']))
            $localisation->update(["bank_postal_box" => $datas['bank_postal_box']]);
        if (isset($datas['bank_locality']))
            $localisation->update(["bank_locality" => $datas['bank_locality']]);
        if (isset($datas['bank_postalCode']))
            $localisation->update(["bank_postalCode" => $datas['bank_postalCode']]);
        if (isset($datas['bank_area_level_1']))
            $localisation->update(["bank_area_level_1" => $datas['bank_area_level_1']]);
        if (isset($datas['bank_country']))
            $localisation->update(["bank_country" => $datas['bank_country']]);
    }
}
