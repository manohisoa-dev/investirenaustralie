<?php

use App\Entite\Membre;
use Dedicated\GoogleTranslate\Translator;
use Illuminate\Support\Str;

/**
 * creer le lien css du dashboard ADMIN en ligne
 * @param $url_css string : lien du fichier en local
 * format : lib/bootstrap (bootstrap.css)
 */
//http://dev2.investirenaustralie.com
if (!function_exists('helper_css')) {
    function helper_css($url_css) {
        return '<link href="' . asset('assets/css/' . $url_css . '.css') .
            '" rel="stylesheet">';
    }
}

/**
 * creer le lien image vers le dashboard ADMIN en ligne
 * @param $url_img string : lien de l'image en local
 */
if (!function_exists('link_img')) {
    function link_img($url_img) {
        return asset($url_img);
    }
}
/**
 * Alias to acces to storage image path
 * @param String $path : Local storage path
 */
if (!function_exists('storage')) {
    function storage($path) {
        return asset('' . $path);
    }
}

/**
 * Alias to acces to storage thumbnail image path
 * @param String $path : Local storage path
 */
if (!function_exists('thumbnail')) {
    function thumbnail($path) {
        $file = public_path('' . $path);
        if (!File::exists($file)) {
            return asset('' . $path);
        }

        $filename = str_replace('\\', '/', $path);
        $pos = strrpos($filename, '/');
        $filename = false === $pos ? $filename : substr($filename, $pos + 1);

        $thumbnail = public_path('uploads/app/thumb_' . $filename);
        if (!File::exists($thumbnail)) {
            InterventionImage::make($file)->resize(320, 240)->save($thumbnail);
        }

        return asset('uploads/app/thumb_' . $filename);
    }
}

/**
 * Alias to acces to storage thumbnail image path
 * @param String $path : Local storage path
 */
if (!function_exists('option')) {
    function option($keys, $default = null) {
        $keys = explode('.', $keys);
        if (count($keys) == 2) {
            $group = $keys[0];
            $key = $keys[1];

            $model = App\Models\Config::where('name', $group)->get()->first();
            if (!$model)
                return $default;

            $meta = $model->get_meta($key);
            if ($meta)
                return $meta->value;
        }
        return $default;
    }
}

if (!function_exists('app_name')) {
    function app_name($default = null) {
        $default = config('app.name', $default);
        $default = option('site.meta_title', $default);
        return $default;
    }
}

/**
 * creer le lien javascript vers le dashboard ADMIN en ligne
 * @param $url_js string : lien de l'image en local
 * format : assets/js/lib/jquery.js ou assets/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.min.js
 */

if (!function_exists('helper_js')) {
    function helper_js($url_js) {
        return '<script src="' . asset($url_js . '.js') . '"></script>';
    }
}
/**
 * creer le lien css plugin vers le frontEnd en ligne
 * @param $url_css string : lien du css/plugin en local
 * format : plugins/slick-nav/slicknav
 */
if (!function_exists('plugin_css')) {
    function plugin_css($plugin_css) {
        return '<link href="' . asset($plugin_css . '.css') . '" rel="stylesheet">';
    }
}
/**
 *chargement des fichiers xml_loader_files
 * @param Route Xml
 * @return Array Xml
 */
if (!function_exists('xml_loader_files')) {
    function xml_loader_files($xml_name) {
        $xml_routes = public_path() . '/xml/' . $xml_name . '.xml';

        if (File::exists($xml_routes)) {
            $xml = simplexml_load_file($xml_routes);
            return $xml;
        } else {
            echo "Fichier xml non trouvé";
        }
    }
}

/**
 * Helpers Pagination bootstrap boo-admin
 * @param Object LengthAwarePaginator
 * @return view : pagination-admin
 */

if (!function_exists('paginationAdmin')) {
    function paginationAdmin($lengthAwarePaginator) {
        return view('admin.pagination-admin', compact('lengthAwarePaginator'));
    }
}

/**
 * Generate slug
 *
 * @param String $text
 * @return String $slug
 */
if (!function_exists('generateSlug')) {
    function generateSlug($text) {
        /*$textToLower = strtolower($text);
        $remSpecialChar = preg_replace('/[^ \w-]/', ' ', $textToLower);
        $remDoubleSpace = preg_replace('/\s{2,}/', ' ', $remSpecialChar);
        return str_replace(' ', '-', $remDoubleSpace);*/
        return str_slug($text);
    }
}

/**
 * Helpers affichage Image Publicite
 * @param string $nom_image
 * @return string url image publicite
 */
if (!function_exists('pub')) {
    function pub($nom_image) {
        return asset('admin/img/publicite/' . $nom_image);
    }
}

/**
 * Helpers fichier de configuration personnalisée config
 * @param string $key , string $default
 * @return Array
 */
if (!function_exists('param')) {
    function param($key = null, $default = null) {
        $xml = xml_loader_files('config');
        $instance = $xml->config;
        $config = json_decode(json_encode($instance), true);

        $parametres = array(
            'app' => ['identifiant' => $config['identifiant'],
            'nom' => $config['nom'],
            'titre' => $config['titre'],
            'email' => $config['email'],
            'latitude' => $config['latitude'],
            'longitude' => $config['longitude']]);

        if (is_null($key)) {
            return $parametres;
        }

        if (!is_null($key) && !is_null($default)) {
            $parametres['app'][$key] = $default;
            $instance->$key = $default;
            $xml->saveXML(public_path() . '/xml/config.xml');
            return $parametres;
        }

        if (!is_null($key) && is_null($default)) {
            return $parametres['app'][$key];
        }
    }
}

/**
 * Helpers fichier de configuation Social Media
 * @param string $key , string $default
 * @return Array
 */
if (!function_exists('social')) {
    function social($key = null, $default = null) {
        $xml = xml_loader_files('config');
        $instance = $xml->socialmedia;
        $xml_media = json_decode(json_encode($instance), true);

        if (is_null($key))
            return $xml_media;

        if (!is_null($key) && is_null($default)) {
            $indice = explode('.', $key);
            return $xml_media[$indice[0]][$indice[1]];

        }
        if (!is_null($key) && !is_null($default)) {
            $indice = explode('.', $key);
            $instance->$indice[0]->$indice[1] = $default;

            $xml->saveXML(public_path() . '/xml/config.xml');
            return $xml_media[$indice[0]][$indice[1]];
        }
    }
}


//test session existe et include l'entete
function affichageHeader() {
    $membre = new Membre();
    $email = $membre->getEmail(session('login'));
    $TypeNature = $membre->getNature($email);

    if (session('login') == '') {
        echo view('front.header-bar');
    } else {
        if ($TypeNature == 0) {
            echo view('front.header_CM');
        }
        if ($TypeNature == 1) {
            echo view('front.header_V');
        }
        if ($TypeNature == 2) {
            echo view('front.header_APL');
        }
        if ($TypeNature == 3) {
            echo view('front.header_AFA');
        }
    }
}

if (!function_exists('midia_time_elapsed')) {

    /**
     * Midia Human-readable Time
     *
     * @param  string  $datetime
     * @param  boolean $full
     * @return string
     */
    function midia_time_elapsed($datetime, $full = false) {
        $datetime = date('Y-m-d h:i:s', $datetime);
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
            );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full)
            $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) : 'just now';
    }
}

if (!function_exists('genMdpAleatoire')) {
    function genMdpAleatoire() {
        // Liste des caractères possibles
        $cars = "!(){}*^%AZERTYUIOPQSDFGHJKLMWXCVBN?&#@azertyiopqsdfghjklmwxcvbn0123456789$";
        $mdp = '';
        $long = strlen($cars);

        srand((double)microtime() * 1000000);
        //Initialise le générateur de nombres aléatoires
        for ($i = 0; $i < 24; $i++)
            $mdp = $mdp . substr($cars, rand(0, $long - 1), 1);

        return $mdp;
    }
}

if (!function_exists('setIconFile')) {
    function setIconFile($filename) {
        if ($filename != '') {
            $mime = mime_content_type($filename);
            if ($mime == 'image/gif' || $mime == 'image/jpeg' || $mime == 'image/png') {
                $type = 'images';
            } elseif ($mime == 'application/pdf') {
                $type = 'pdf';
            } elseif ($mime == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                $type = 'doc';
            } elseif ($mime == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
                $type = 'excel';
            } else {
                $type = 'file';
            }

            return $type;
        }else{
            return '';   
        }
    }
}

if (!function_exists('getListAplGrpByCountry')) {
    function getListAplGrpByCountry() {
        $lcountry = App\Models\Localisation::select('localizations.*')->join('users',
            'users.location_id', '=', 'localizations.id')->where('users.role', '=', '4')->groupBy('localizations.country')->get();


        return $lcountry;
    }
}

if (!function_exists('getListAplGrpByCity')) {
    function getListAplGrpByCity($country) {
        $iso_country = App\Models\Country::where('content', '=', $country)->first()->code;

        $lcity = App\Models\Localisation::select('localizations.*')->join('users',
            'users.location_id', '=', 'localizations.id')->where('users.role', '=', '4')->where('localizations.country',
            '=', $iso_country)->groupBy('localizations.locality')->get();

        return $lcity;
    }
}

if (!function_exists('getListApl')) {
    function getListApl($country, $locality) {
        $aplInfo = [];
        $country = str_replace('_', ' ', $country);
        $locality = str_replace('_', ' ', $locality);
        $iso_country = App\Models\Country::where('content', '=', $country)->first()->code;
        $lapls = App\Models\Localisation::select('users.*')->join('users',
            'users.location_id', '=', 'localizations.id')->where('localizations.country',
            '=', $iso_country)->where('localizations.locality', '=', $locality)->where('users.role',
            '=', '4')->get();

        return $lapls;
    }
}


if (!function_exists('getTranslate')) {
    function getTranslate($tabName, $tab, $lang) {
        $tabId = $tabName . '_id';
        $ucfirstTabname = Str::ucfirst($tabName);
        $tabNameModel = "App\Models\\" . $ucfirstTabname . "Translation";
        $translation = "";

        // get list translation for tab id
        $listTrans = $tabNameModel::where($tabId, '=', $tab->id)->get();

        foreach ($listTrans as $key => $value) {
            $result = App\Models\Translation::whereId($value->translation_id)->where('lang',
                '=', $lang)->first();
            if ($result !== null) {
                $translation = $result->content;
                break;
            }
        }

        return $translation;

    }
}

if (!function_exists('setTranslate')) {
    function setTranslate($sourceLang, $targetLang, $text, $tabName, $tab) {
        $translator = new Translator;
        $tabId = $tabName . '_id';
        $ucfirstTabname = Str::ucfirst($tabName);
        $tabNameModel = "App\Models\\" . $ucfirstTabname . "Translation";

        // translate text with google translation
        $content = getGTranslate($sourceLang, $targetLang, $text);

        // save translation in translation table
        $_translation = App\Models\Translation::create(['key' => $targetLang, 'lang' =>
            $targetLang, 'content' => $content]);
        $_translation->save();

        // save foreign key in association table
        $_association = $tabNameModel::create([$tabId => $tab->id, 'translation_id' => $_translation->id]);
        $_association->save();


        return false;
    }
}

if (!function_exists('updateTranslate')) {
    function updateTranslate($tabName, $tab, $content) {
        $tabId = $tabName . '_id';
        $ucfirstTabname = Str::ucfirst($tabName);
        $tabNameModel = "App\Models\\" . $ucfirstTabname . "Translation";
        $detectLang = getGTranslateLangDetect(strip_tags($content));

        $newContent = "";
        $sourceLang = "";
        $targetLang = "";

        if ($detectLang === 'fr') {
            $sourceLang = 'fr';
            $targetLang = 'en';
        } else {
            $sourceLang = 'en';
            $targetLang = 'fr';
        }

        // translate content
        $newContent = getGTranslateAutoDetect($targetLang, strip_tags($content));
        // get list translation for tab id
        $listTrans = $tabNameModel::where($tabId, '=', $tab->id)->get();

        foreach ($listTrans as $key => $value) {
            $result = App\Models\Translation::whereId($value->translation_id)->where('lang',
                '=', $targetLang)->first();
            if ($result !== null) {
                $result->update(['content' => $newContent]);
                break;
            }
        }

        return false;

    }
}

if (!function_exists('getGTranslate')) {
    function getGTranslate($sourceLang, $targetLang, $text) {
        /*$translator = new Translator;
        $result = $translator->setSourceLang($sourceLang)->setTargetLang($targetLang)->translate($text);
        return $result;*/
        return $text;
    }
}

if (!function_exists('getGTranslateAutoDetectBd')) {
    function getGTranslateAutoDetectBd($tabName, $tab) {
        $tabId = $tabName . '_id';
        $ucfirstTabname = Str::ucfirst($tabName);
        $tabNameModel = "App\Models\\" . $ucfirstTabname . "Translation";

        // get list translation for tab id
        $listTrans = $tabNameModel::where($tabId, '=', $tab->id)->get();

        foreach ($listTrans as $key => $value) {
            $result = App\Models\Translation::whereId($value->translation_id)->where('lang',
                '=', App::getLocale())->first();
            if ($result !== null) {
                return $result->content;
                break;
            }
        }

        return false;
    }
}

if (!function_exists('getGTranslateAutoDetect')) {
    function getGTranslateAutoDetect($targetLang, $text) {
        $translator = new Translator;
        $lang = getGTranslateLangDetect($text);
        //dd($lang);
        $result = $text;

        if ($targetLang !== $lang) {
            $result = $translator->setTargetLang($targetLang)->translate($text);
        }

        return $result;
    }
}

if (!function_exists('getGTranslateLangDetect')) {
    function getGTranslateLangDetect($text) {
        $translator = new Translator;
        $result = $translator->detect($text);
        return $result;
    }
}

if (!function_exists('getGTranslateTest')) {
    function getGTranslateTest($targetLang, $text) {
        $translator = new Translator;
        $result = $translator->setTargetLang($targetLang)->translate($text);
        return $result;
    }
}

if (!function_exists('set_coordooner')) {
    function set_coordooner($adresse) {
        $address = urlencode($adresse);
        $url = "https://nominatim.openstreetmap.org/search?q=" . $address .
            "&format=json&addressdetails=1&limit=1&polygon_svg=1";
        // get the json response
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT,
            'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        $html = curl_exec($ch);
        $resp = json_decode($html, true);
        if (!empty($resp)) {
            $result = array('user_lat' => $resp[0]['lat'], 'user_long' => $resp[0]['lon']);
        } else {
            $result = array();
        }
        return $result;
    }
}

if (!function_exists('geocodeAddress')) {
    function geocodeAddress($address) {
        $apikey = 'AIzaSyD2izG_M7K3gP6pFUH5cyzmDjuGpOYfgc4';
        $data = array(
            'address' => '',
            'lat' => '',
            'lng' => '',
            'city' => '',
            'department' => '',
            'region' => '',
            'country' => '',
            'postal_code' => '');
        //on formate l'adresse
        $address = str_replace(" ", "+", $address);
        //on fait l'appel à l'API google map pour géocoder cette adresse
        $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?key=" .
            $apikey . "&address=$address&sensor=false&region=fr");
        $json = json_decode($json);
        //on enregistre les résultats recherchés
        if ($json->status == 'OK' && count($json->results) > 0) {
            $res = $json->results[0];
            //adresse complète et latitude/longitude
            $data['address'] = $res->formatted_address;
            $data['lat'] = $res->geometry->location->lat;
            $data['lng'] = $res->geometry->location->lng;
            foreach ($res->address_components as $component) {
                //ville
                if ($component->types[0] == 'locality') {
                    $data['city'] = $component->long_name;
                }
                //départment
                if ($component->types[0] == 'administrative_area_level_2') {
                    $data['department'] = $component->long_name;
                }
                //région
                if ($component->types[0] == 'administrative_area_level_1') {
                    $data['region'] = $component->long_name;
                }
                //pays
                if ($component->types[0] == 'country') {
                    $data['country'] = $component->long_name;
                }
                //code postal
                if ($component->types[0] == 'postal_code') {
                    $data['postal_code'] = $component->long_name;
                }
            }
        }
        return $data;
    }
}

if (!function_exists('storeFile')) {
    function storeFile($file, $path) {
        // Get filename with the extension
        $filenameWithExt = $file->getClientOriginalName();
        //Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $file->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $filename . '.' . $extension;
        // Upload Image
        $path = $file->move($path, $fileNameToStore);

        return false;
    }
}


if (!function_exists('imageResizeUrl')) {
    function imageResizeUrl($path, $width = null, $height = null, $quality = null, $crop = null) {
        if (!$width && !$height) {
            $url = env('IMAGE_URL') . $path;
        } else {
            $url = url('/') . '/timthumb.php?src=' . env('IMAGE_URL') . $path;
            if (isset($width)) {
                $url .= '&w=' . $width;
            }
            if (isset($height) && $height > 0) {
                $url .= '&h=' . $height;
            }
            if (isset($crop)) {
                $url .= "&zc=" . $crop;
            } else {
                $url .= "&zc=1";
            }
            if (isset($quality)) {
                $url .= '&q=' . $quality . '&s=1';
            } else {
                $url .= '&q=95&s=1';
            }
        }

        return $url;
    }
}

if (!function_exists('setLinkDynamic')) {
    function setLinkDynamic($path_file, $label_link) {
        return link_to_asset($path_file, $label_link);
    }
}

if (!function_exists('countryLongName')) {
    function countryLongName($code) {
        $ct = App\Models\Country::select('content')->where('code', $code)->first();

        if ($ct != "") {
            $content = $ct->content;
        } else {
            $content = "";
        }

        return $content;
    }
}

/**
 * recuperer page image resize
 */
if (!function_exists('getImageResize')) {
    function getImageResizeUrl($model, $filename, $format){
        if($model != "" && $filename != "") {
            $format = $format != "" ? $format : "medium" ;
            return 'uploads/' . $model . '/' . $model . '-resize/' . $format . '/' . $filename . '';
        }
        else{
            return "" ;
        }
    }
}
