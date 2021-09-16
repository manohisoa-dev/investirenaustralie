<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Firb;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

use App\Models\Image;
use App\Models\User;
use App\Models\Localisation;
use App\Models\Type;
use App\Models\ProductsImage;
use App\Models\FondsDossier;
use App\Models\EoiDossier;
use App\Models\LiaDossier;
use App\Models\State;
use Auth;
use App;
use Carbon\Carbon;


use GuzzleHttp;
use GuzzleHttp\Client;

class ProductController extends Controller {
    public $viewDir = "admin.product";

    public function index() {
        if (isset($_GET['status'])) {
            $status_prd = $_GET['status'];
        } else {
            $status_prd = 'published';
        }
        $records = Product::allProduitIsole($status_prd);
        $status = Product::groupBy('status')->pluck('status', 'status');
        return $this->view("index", ['records' => $records, 'status' => $status,
            'statusPrd' => $status_prd]);
    }

    public function programme() {
        if (isset($_GET['status'])) {
            $status_pro = $_GET['status'];
        } else {
            $status_pro = 'published';
        }
        $records = Product::allProgramme($status_pro);
        $status = Product::groupBy('status')->pluck('status', 'status');
        return $this->view("programme", ['records' => $records, 'status' => $status,
            'statusPro' => $status_pro]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create() {
        // Set locale langage to English
        App::setLocale('en');

        if ($_GET['type'] == 'produit') {
            return $this->view("create", ['type' => $_GET['type']]);
        } else {
            return $this->view("create_programme", ['type' => $_GET['type']]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->middleware('auth');
        $this->middleware('role:1');
        $anciennete = $request->ancienneteBien;
        $nature = $request->natureBien;

        if ($request->commision == 'Sales commission rate (%)') {
            $taux_commision = $request->sales_rate;
        } else {
            $taux_commision = $request->rate_commission;
        }

        if ($request->type == 'programme') {
            //creation simple programme
            $id_location = $this->save_location($request->countryId, $request->suburb, $request->postalCode,
                $request->ville, $request->display_address);
            $id_programme = $this->save_programme($request->cat_programmme_id, $request->ancienneteBien,
                $request->natureBien, $request->prix_min, $request->prix_max, $request->type_id,
                $request->display_address, $request->postalCode, $request->state_id, $request->title_programme,
                $request->description, $id_location, $request->commision, $taux_commision);
            //save photo programme
            if ($request->dropPhoto) {
                foreach ($request->dropPhoto as $key => $value) {
                    if ($request->radioDrop) {
                        if ($request->radioDrop == $value) {
                            $is_principal = 1;
                        } else {
                            $is_principal = 0;
                        }
                    } else {
                        $is_principal = 0;
                    }
                    $this->save_photo_programme($value, $id_programme, $is_principal);
                }
            }
            if ($request->eoiDossier) {
                foreach ($request->eoiDossier as $key => $value) {
                    $this->save_eoi_dossier($value, $id_programme);
                }
            }
            if ($request->fondDossier) {
                foreach ($request->fondDossier as $key => $value) {
                    $this->save_fond_dossier($value, $id_programme);
                }
            }
            # notification
            Notify::success('Programme a été créer avec succès');
            return back();

        } else {
            //creation produit
            if (isset($request->chk_parking)) {
                $avoir_parking = 1;
            } else {
                $avoir_parking = 0;
            }

            if (isset($request->chk_picine)) {
                $avoir_piscine = 1;
            } else {
                $avoir_piscine = 0;
            }
            if ($anciennete == 'Neuf') {
                if ($nature == 'Programme immobilier') {
                    if ($request->parent_id == 0) {
                        //creation programme
                        $id_location = $this->save_location($request->countryId, $request->suburb, $request->postalCode,
                            $request->ville, $request->display_address);
                        $id_programme = $this->save_programme($request->cat_programmme_id, $request->ancienneteBien,
                            $request->natureBien, $request->prix_min, $request->prix_max, $request->type_id,
                            $request->display_address, $request->postalCode, $request->state_id, $request->title_programme,
                            $request->description, $id_location, $request->commision, $taux_commision);
                        //save photo programme
                        if ($request->dropPhoto) {
                            foreach ($request->dropPhoto as $key => $value) {
                                if ($request->radioDrop) {
                                    if ($request->radioDrop == $value) {
                                        $is_principal = 1;
                                    } else {
                                        $is_principal = 0;
                                    }
                                } else {
                                    $is_principal = 0;
                                }
                                $this->save_photo_programme($value, $id_programme, $is_principal);
                            }
                        }

                        if ($request->eoiDossier) {
                            foreach ($request->eoiDossier as $key => $value) {
                                $this->save_eoi_dossier($value, $id_programme);
                            }
                        }

                        if ($request->fondDossier) {
                            foreach ($request->fondDossier as $key => $value) {
                                $this->save_fond_dossier($value, $id_programme);
                            }
                        }
                        //creation produit
                        $titre_product = $request->title_programme . '-' . $request->title_product;
                        if ($request->commision_product == 'Sales commission rate (%)') {
                            $taux_commision_prd = $request->sales_rate_product;
                        } else {
                            $taux_commision_prd = $request->rate_commission_product;
                        }

                        $this->save_new_produit($anciennete, $nature, $titre_product, $request->file('image'),
                            $request->desc_product, 1, 0, $request->interior_area, $request->exterior_area,
                            $request->total_area, $request->carport_spaces, $request->garage_spaces, $request->bathrooms,
                            $request->bedrooms, $request->ensuite, 0, 1, date('Y'), $request->display_address_product,
                            0, $request->price, $request->price_max_prd, 'AUD', $request->status, $request->product_type_id,
                            $request->cat_programmme_id, $request->postalCode_product, $request->state_id_product,
                            $id_programme, $id_location, 0, $avoir_parking, 0, $request->commision_product,
                            $taux_commision_prd, $request->dt_db_travaux, $request->dt_prevu_livraison);
                    } else {
                        //creation produit avec programme existant
                        $id_location = Product::where('id', $request->parent_id)->get(['location_id']);

                        if ($request->commision_product == 'Sales commission rate (%)') {
                            $taux_commision_prd = $request->sales_rate_product;
                        } else {
                            $taux_commision_prd = $request->rate_commission_product;
                        }
                        $this->save_new_produit($anciennete, $nature, $request->title_product, $request->file
                            ('image'), $request->desc_product, $request->quantity, 0, $request->interior_area,
                            $request->exterior_area, $request->total_area, $request->carport_spaces, $request->garage_spaces,
                            $request->bathrooms, $request->bedrooms, $request->ensuite, 0, 1, date('Y'), $request->display_address_product,
                            0, $request->price, 'AUD', $request->status, $request->product_type_id, $request->cat_programmme_id,
                            $request->postalCode_product, $request->state_id_product, $request->parent_id, $id_location,
                            0, $avoir_parking, 0, $request->commision_product, $taux_commision_prd, $request->dt_db_travaux,
                            $request->dt_prevu_livraison);
                    }
                } else {
                    //creation produit isolé
                    //creation location produit isolé
                    $id_location = $this->save_location($request->countryId_product, $request->suburb_product,
                        $request->postalCode_product, $request->ville_product, $request->display_address_product);

                    if ($request->commision_product == 'Sales commission rate (%)') {
                        $taux_commision_prd = $request->sales_rate_product;
                    } else {
                        $taux_commision_prd = $request->rate_commission_product;
                    }
                    $id_produit = $this->save_new_produit($anciennete, $nature, $request->title_product,
                        $request->file('image'), $request->desc_product, $request->quantity, 0, $request->interior_area,
                        $request->exterior_area, $request->total_area, $request->carport_spaces, $request->garage_spaces,
                        $request->bathrooms, $request->bedrooms, $request->ensuite, 0, 1, date('Y'), $request->display_address_product,
                        $request->simple_price, 0, 0, 'AUD', $request->status, $request->product_type_id,
                        $request->cat_programmme_id, $request->postalCode_product, $request->state_id_product,
                        -1, $id_location, $request->superficie_jardin, $avoir_parking, $avoir_piscine, $request->commision_product,
                        $taux_commision_prd, $request->dt_db_travaux, $request->dt_prevu_livraison);

                    if ($request->p_eoiDossier) {
                        foreach ($request->p_eoiDossier as $key => $value) {
                            $this->save_eoi_dossier($value, $id_produit);
                        }
                    }
                }
            } else {
                //si ancienneté == ancien
                $id_location = $this->save_location($request->countryId_product, $request->suburb_product,
                    $request->postalCode_product, $request->ville_product, $request->display_address_product);

                if ($request->commision_product == 'Sales commission rate (%)') {
                    $taux_commision_prd = $request->sales_rate_product;
                } else {
                    $taux_commision_prd = $request->rate_commission_product;
                }
                $this->save_new_produit($anciennete, '', $request->title_product, $request->file
                    ('image'), $request->desc_product, $request->quantity, 0, $request->interior_area,
                    $request->exterior_area, $request->total_area, $request->carport_spaces, $request->garage_spaces,
                    $request->bathrooms, $request->bedrooms, $request->ensuite, 0, 1, date('Y'), $request->display_address_product,
                    0, $request->price, $request->price_max_prd, 'AUD', $request->status, $request->product_type_id,
                    $request->cat_programmme_id, $request->postalCode_product, $request->state_id_product,
                    -1, $id_location, $request->superficie_jardin, $avoir_parking, $avoir_piscine, $request->commision_product,
                    $taux_commision_prd, $request->dt_db_travaux, $request->dt_prevu_livraison);
            }


            # notification
            Notify::success('Produit a été créer avec succès');
            return back();
        }
    }

    function save_location($country, $suburb, $postalCode, $locality, $route) {
        $adresse = $route . ', ' . $locality . ' ' . $postalCode . ', ' . $country;
        $coordonne_tab = geocodeAddress($adresse);
        if ($coordonne_tab) {
            $latitude = $coordonne_tab['lat'];
            $longitude = $coordonne_tab['lng'];
        } else {
            $latitude = '';
            $longitude = '';
        }

        $location = new Localisation();
        $location->country = $country;
        $location->area_level_1 = $suburb;
        $location->postalCode = $postalCode;
        $location->longitude = $longitude;
        $location->latitude = $latitude;
        $location->locality = $locality;
        $location->route = $route;
        $location->author_id = Auth::user()->id;

        $location->save();
        return $location->id;
    }

    function save_programme($categorie, $ancienete, $nature, $prix_min, $prix_max, $type_id,
        $display_address, $postalCode, $state_id, $title, $content, $location_id, $type_commission,
        $commission) {
        $slug = generateSlug($title);
        $programme = new Product();
        $programme->category_id = $categorie;
        $programme->ancienneteBien = $ancienete;
        $programme->natureBien = $nature;
        $programme->min_price = $prix_min;
        $programme->max_price = $prix_max;
        $programme->type_id = $type_id;
        $programme->display_address = $display_address;
        $programme->postalCode = $postalCode;
        $programme->state_id = $state_id;
        $programme->title = $title;
        $programme->content = $content;
        $programme->slug = $slug;
        $programme->location_id = $location_id;
        $programme->commission_type = $type_commission;
        $programme->commision = $commission;
        $programme->author_id = Auth::user()->id;
        $programme->validated_at = Carbon::now();
        $programme->save();

        // save translation
        $detectLang = getGTranslateLangDetect($content);
        $detectLang === 'fr' ? setTranslate('fr', 'en', $content, 'programme', $programme) :
            setTranslate('en', 'fr', $content, 'programme', $programme);

        return $programme->id;
    }

    function save_new_produit($anciennete, $nature, $title, $photo, $content, $qty,
        $area, $interior_area, $exterior_area, $total_area, $carport_spaces, $garage_spaces,
        $bathrooms, $bedrooms, $sweet, $number_of_floors, $new_construction, $year_built,
        $display_address, $price, $min_price, $max_price, $currency, $status, $type_id,
        $cat_programmme_id, $postalCode, $state_id, $programme_id, $location_id, $superficie_jardin,
        $avoir_parking_voie_public, $avoir_piscine, $type_commission, $taux_commission,
        $dt_db_travaux, $dt_prevu_livraison, $avoir_bonus, $mt_bonus) {

        $product = new Product();
        $lastId = Product::latest('id')->first();
        $new_id = $lastId->id + 1;
        if ($photo) {
            $file = $photo;
            $image = Image::storeAndSave($file, 'product');
            $product->image_id = $image->id;
        }
        $slug = generateSlug($title);
        $product->ancienneteBien = $anciennete;
        $product->natureBien = $nature;
        $product->reference = 'ref-p00000' . $new_id;
        $product->title = $title;
        $product->slug = $slug;
        $product->content = $content;
        $product->quantity = $qty;
        $product->is_new = 1;
        $product->view_count = 0;
        $product->area = $area;
        $product->interior_area = $interior_area;
        $product->exterior_area = $exterior_area;
        $product->total_area = $total_area;
        $product->carport_spaces = $carport_spaces;
        $product->garage_spaces = $garage_spaces;
        $product->bathrooms = $bathrooms;
        $product->bedrooms = $bedrooms;
        $product->ensuite = $sweet;
        $product->number_of_floors = $number_of_floors;
        $product->new_construction = $new_construction;
        $product->year_built = $year_built;
        $product->display_address = $display_address;
        $product->price = $price;
        $product->min_price = $min_price;
        $product->max_price = $max_price;
        $product->currency = $currency;
        $product->tma = 0.20;
        $product->status = $status;
        $product->type_id = $type_id;
        $product->category_id = $cat_programmme_id;
        $product->author_id = Auth::user()->id;
        $product->postalCode = $postalCode;
        $product->state_id = $state_id;
        $product->parent_id = $programme_id;
        $product->location_id = $location_id;
        $product->superficie_jardin = $superficie_jardin;
        $product->avoir_parking_voie_public = $avoir_parking_voie_public;
        $product->avoir_piscine = $avoir_piscine;
        $product->commission_type = $type_commission;
        $product->commision = $taux_commission;
        $product->avoir_bonus = $avoir_bonus;
        $product->amount_bonus = $mt_bonus;
        $product->dt_db_travaux = $dt_db_travaux;
        $product->dt_prevu_livraison = $dt_prevu_livraison;
        $product->validated_at = Carbon::now();
        $product->save();

        // save translation
        $detectLang = getGTranslateLangDetect($content);
        $detectLang === 'fr' ? setTranslate('fr', 'en', $content, 'programme', $product) :
            setTranslate('en', 'fr', $content, 'programme', $product);

        return $product->id;
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Product $product) {
        $fonDossier = FondsDossier::where('products_fond_dossier.product_id', '=', $product->id)->join('images',
            'products_fond_dossier.image_id', '=', 'images.id')->select('*',
            'products_fond_dossier.id as prdFondId')->get();

        $eoiDossier = EoiDossier::where('product_eoi.product_id', '=', $product->id)->join('images',
            'product_eoi.image_id', '=', 'images.id')->select('*',
            'product_eoi.id as prdEoiId')->get();

        $liaDossier = LiaDossier::where('product_lia.product_id', '=', $product->id)->join('images',
            'product_lia.image_id', '=', 'images.id')->select('*',
            'product_lia.id as prdLiaId')->get();

        $produit_lie = Product::where('parent_id', $product->id)->get();
        $photo = ProductsImage::where('products_images.product_id', '=', $product->id)->join('images',
            'products_images.image_id', '=', 'images.id')->select('*',
            'products_images.id as prdImageId')->get();

        return $this->view("show", ['product' => $product, 'dossier' => $fonDossier,
            'eoidossier' => $eoiDossier, 'photos' => $photo, 'liadossier' => $liaDossier,
            'product_lies' => $produit_lie]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Product $product) {
        $localisation = Localisation::find($product->location_id);
        if ($product->parent_id == 0) {
            //modification programme
            $fonDossier = FondsDossier::where('products_fond_dossier.product_id', '=', $product->id)->join('images',
                'products_fond_dossier.image_id', '=', 'images.id')->select('*',
                'products_fond_dossier.id as prdFondId')->get();

            $eoiDossier = EoiDossier::where('product_eoi.product_id', '=', $product->id)->join('images',
                'product_eoi.image_id', '=', 'images.id')->select('*',
                'product_eoi.id as prdEoiId')->get();

            $liaDossier = LiaDossier::where('product_lia.product_id', '=', $product->id)->join('images',
                'product_lia.image_id', '=', 'images.id')->select('*',
                'product_lia.id as prdLiaId')->get();

            $produit_lie = Product::where('parent_id', $product->id)->get();
            $photo = ProductsImage::where('products_images.product_id', '=', $product->id)->join('images',
                'products_images.image_id', '=', 'images.id')->select('*',
                'products_images.id as prdImageId')->get();

            return $this->view("edit_programme", ['product' => $product, 'type' =>
                'programme', 'localisation' => $localisation, 'dossier' => $fonDossier,
                'eoidossier' => $eoiDossier, 'liadossier' => $liaDossier, 'photos' => $photo,
                'product_lies' => $produit_lie]);
        } else {
            //modification proudiut
            $fonDossier = FondsDossier::where('products_fond_dossier.product_id', '=', $product->id)->join('images',
                'products_fond_dossier.image_id', '=', 'images.id')->select('*',
                'products_fond_dossier.id as prdFondId')->get();

            $eoiDossier = EoiDossier::where('product_eoi.product_id', '=', $product->id)->join('images',
                'product_eoi.image_id', '=', 'images.id')->select('*',
                'product_eoi.id as prdEoiId')->get();
            $liaDossier = LiaDossier::where('product_lia.product_id', '=', $product->id)->join('images',
                'product_lia.image_id', '=', 'images.id')->select('*',
                'product_lia.id as prdLiaId')->get();
            $photo = ProductsImage::where('products_images.product_id', '=', $product->id)->join('images',
                'products_images.image_id', '=', 'images.id')->select('*',
                'products_images.id as prdImageId')->get();

            return $this->view("edit", ['product' => $product, 'type' => 'produit',
                'localisation' => $localisation, 'dossier' => $fonDossier, 'eoidossier' => $eoiDossier,
                'liadossier' => $liaDossier, 'photos' => $photo]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product) {
        if ($request->type == 'programme') {
            //modification localisation
            $product = Product::find($request->programme_id);
            if ($request->location_Id != 0) {
                $localisation = Localisation::find($product->location_id);
                if ($localisation->route != $request->display_address || $localisation->locality !=
                    $request->ville) {
                    $adresse = $request->display_address . ', ' . $request->ville . ' ' . $request->postalCode .
                        ', ' . $request->countryId;
                    $coordonne_tab = geocodeAddress($adresse);
                    if ($coordonne_tab) {
                        $latitude = $coordonne_tab['lat'];
                        $longitude = $coordonne_tab['lng'];
                    } else {
                        $latitude = '';
                        $longitude = '';
                    }
                    Localisation::where('id', $product->location_id)->update(['area_level_1' => $request->suburb,
                        'country' => $request->countryId, 'postalCode' => $request->postalCode,
                        'locality' => $request->ville, 'route' => $request->display_address, 'longitude' =>
                        $longitude, 'latitude' => $latitude]);
                    $id_location = $product->location_id;
                }
            } else {
                $id_location = $this->save_location($request->countryId, $request->suburb, $request->postalCode,
                    $request->ville, $request->display_address);
            }


            if ($request->file('fond_dossier')) {
                $fond_dossier = $request->file('fond_dossier');
                $image_pro = Image::storeAndSave($fond_dossier, 'product');
                $product->image_fond_dossier_id = $image_pro->id;
            }

            if ($request->commision == 'Sales commission rate (%)') {
                $taux_commision = $request->sales_rate;
            } else {
                $taux_commision = $request->rate_commission;
            }

            $slug = generateSlug($request->title_programme);
            $product->title = $request->title_programme;
            $product->slug = $slug;
            $product->content = $request->description;
            $product->min_price = $request->prix_min;
            $product->max_price = $request->prix_max;
            $product->display_address = $request->display_address;
            $product->type_id = $request->type_id;
            $product->location_id = $id_location;
            $product->commission_type = $request->commision;
            $product->commision = $taux_commision;
            $product->save();

            // update translation
            updateTranslate('programme', $product, $request->description);

            # notification
            Notify::success('Programme a été mise à jour avec succès');
            return redirect(Auth::user()->isAdminDelegate() ? route('admin.collaborators.admin.product.programme') :
                route('admin.product.programme'));
        } else {
            $product = Product::find($request->id);

            if ($request->location_id != 0) {
                $localisation = Localisation::find($product->location_id);
                if ($localisation->route != $request->display_address || $localisation->locality !=
                    $request->ville_product) {
                    $adresse = $request->display_address . ', ' . $request->ville_product . ' ' . $request->postalCode_product .
                        ', ' . $request->countryId_product;
                    $coordonne_tab = geocodeAddress($adresse);
                    if ($coordonne_tab) {
                        $latitude = $coordonne_tab['lat'];
                        $longitude = $coordonne_tab['lng'];
                    } else {
                        $latitude = '';
                        $longitude = '';
                    }
                    Localisation::where('id', $product->location_id)->update(['area_level_1' => $request->suburb_product,
                        'country' => $request->countryId_product, 'postalCode' => $request->postalCode_product,
                        'locality' => $request->ville_product, 'route' => $request->display_address,
                        'longitude' => $longitude, 'latitude' => $latitude]);
                    $id_location = $product->location_id;
                } else {
                    $id_location = $product->location_id;
                }
            } else {
                $id_location = $this->save_location($request->countryId_product, $request->suburb_product,
                    $request->postalCode_product, $request->ville_product, $request->display_address);
            }

            if ($request->commision_product == 'Sales commission rate (%)') {
                $taux_commision = $request->sales_rate_product;
            } else {
                $taux_commision = $request->rate_commission_product;
            }

            $slug = $slugOriginal = generateSlug($request->title);
            $product->slug = $slug;
            $product->title = $request->title;
            if ($request->file('image')) {
                $file = $request->file('image');
                $image = Image::storeAndSave($file, 'product');
                $product->image_id = $image->id;
            }
            $product->content = $request->desc_product;
            $product->type_id = $request->type_id;
            $product->display_address = $request->display_address;
            $product->postalCode = $request->postalCode_product;
            $product->state_id = $request->state_id;

            $product->commission_type = $request->commision_product;
            $product->commision = $taux_commision;
            $product->avoir_bonus = $request->bonus_vente;
            $product->amount_bonus = $request->bonus_amount;

            if ($product->category_id == 1) {
                $product->bedrooms = $request->bedrooms;
                $product->ensuite = $request->ensuite;
                $product->bathrooms = $request->bathrooms;
                $product->interior_area = $request->interior_area;
                $product->exterior_area = $request->exterior_area;
                $product->location_id = $id_location;
                $product->total_area = $request->total_area;
                $product->garage_spaces = $request->garage_spaces;
                $product->carport_spaces = $request->carport_spaces;

                if ($product->ancienneteBien == 'Neuf' && $product->natureBien ==
                    'Programme immobilier') {

                    $product->min_price = $request->min_price;
                    $product->max_price = $request->max_price;

                } elseif ($product->ancienneteBien == 'Neuf' && $product->natureBien ==
                'Produit isolé') {

                    $product->price = $request->simple_price;
                    $product->superficie_jardin = $request->superficie_jardin;
                    $product->dt_db_travaux = $request->dt_db_travaux;
                    $product->dt_prevu_livraison = $request->dt_prevu_livraison;

                } elseif ($product->ancienneteBien == 'Ancien') {

                    $product->price = $request->simple_price;
                    $product->year_built = $request->year_built;
                    $product->superficie_jardin = $request->superficie_jardin;
                }
            } elseif ($product->category_id == 2) {
                $product->price = $request->simple_price;
                $product->area = $request->surface_foncier;
                $product->unite_area = $request->unite_surface;
            } elseif ($product->category_id == 3) {
                $product->price = $request->simple_price;
                $product->display_address = $request->property_detail;
            } elseif ($product->category_id == 4) {
                $product->price = $request->simple_price;
                $product->area = $request->surface_commercial;
                $product->avoir_parking_voie_public = $request->type_cutomer_parking;
                $product->nb_parking_spots = $request->nombre_cutomer_parking;
            }


            $product->save();

            // update translation
            updateTranslate('programme', $product, $request->content);

            # notification
            Notify::success('Produit a été mise à jour avec succès');
            return redirect((Auth::user()->isAdmin() ? route('admin.product.index') : (Auth::user
                ()->isAdminDelegate() ? route('admin.collaborators.admin.product.index') : route
                ('admin.collaborator.admin.product.index'))));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product) {
        if ($product->parent_id == 0) {
            //suppression produit
            Product::where('parent_id', $product->id)->delete(); //suppression programme
            $product->delete(); # notification
            Notify::success('Programme a été supprimer avec succès');
            return back();
        } else {
            $nature = $product->natureBien;
            $product->delete(); # notification
            Notify::success('Produit a été supprimer avec succès');
            return back();
        }
    }

    public function archive(Request $request, Product $product) {
        $product->status = 'archived';
        $product->save();
        Notify::success('Le produit a été archivé avec succés');
        return back();
    }

    /**
     * Trash product
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request, Product $product) {
        $nature = $product->natureBien;
        $product->status = 'trashed';
        $product->save();
        Notify::success('Le produit a été ajouté au corbeille avec succés');
        return back();
    }

    /**
     * Restore trashed product
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, Product $product) {
        $this->middleware('auth');
        $this->middleware('role:admin');
        $nature = $product->natureBien;
        $product->status = 'pinged';
        $product->save();
        Notify::success('Le produit a été restoré avec succés');
        return back();
    }

    /**
     * Publish product
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function publish(Request $request, Product $product) {
        $this->middleware('auth');
        $this->middleware('role:admin');
        $product->status = 'published';
        $product->validated_at = Carbon::now();
        $product->save();
        Notify::success('Le produit a été publié avec succés');

        return back();
    }

    protected function view($view, $data = []) {
        return view($this->viewDir . "." . $view, $data);
    }

    public function ajaxRequestPost(Request $request) {
        $product = Product::find($request->productId);
        return response()->json(['slug' => $product->slug, 'id' => $product->id,
            'image_id' => $product->image_id]);
    }

    public function ajaxRequestProgramme(Request $request) {
        $product = Product::find($request->productId);
        $location = Localisation::find($product->location_id);
        return response()->json(['title' => $product->title, 'slug' => $product->slug,
            'id' => $product->id, 'category_id' => $product->category_id, 'min_price' => $product->min_price,
            'max_price' => $product->max_price, 'content' => $product->content, 'type_id' =>
            $product->type_id, 'suburb' => $location ? $location->area_level_1 : '',
            'country' => $location ? $location->country : 12, 'postalCode' => $location ? $location->postalCode :
            '', 'display_address' => $product->display_address, 'ville' => $location ? $location->locality :
            '']);
    }

    public function ajaxGetTypeProduitCategorie(Request $request) {
        $typePrd = Type::where('categories_id', $request->categoryId)->get();
        $output = '<option value="">Choisir...</option>';
        foreach ($typePrd as $val) {
            if ($val->id == $request->type_id_active) {
                $type_active = 'selected="selected"';
            } else {
                $type_active = '';
            }
            $output .= '<option value="' . $val->id . '" ' . $type_active . '>' . $val->title .
                '</option>';
        }
        return response()->json($output);
    }

    public function ajaxCheckFirb() {
        $code_postal = $_GET['postal_code'];
        $firb = Firb::where('codePostal', $code_postal)->get();
        if (count($firb) > 0) {
            echo "true";
        } else {
            echo "false";
        }
    }

    public function ajaxCheckTitreProgramme(Request $request) {

        if ($request->get('datas')) {
            $datas = $request->get('datas');
            $datasSplit = explode('|;|', $datas);
            $titre_programme = $datasSplit[0];
            $titre_programme_now = $datasSplit[1];

            if ($titre_programme_now !== $titre_programme) {
                $slug = generateSlug($titre_programme);
                $slug_exist = Product::where('slug', $slug)->get();
                if (count($slug_exist) > 0) {
                    echo "false";
                } else {
                    echo "true";
                }
            } else {
                echo "true";
            }
        } else {
            $slug = generateSlug($request->title_programme);
            $slug_exist = Product::where('slug', $slug)->get();
            if (count($slug_exist) > 0) {
                echo "false";
            } else {
                echo "true";
            }
        }
        /**/
    }

    public function ajaxDropZone(Request $request) {
        $image = $request->file('file');
        $fileInfo = $image->getClientOriginalName();
        $filename = pathinfo($fileInfo, PATHINFO_FILENAME);
        $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
        $file_name = $filename . '-' . time() . '.' . $extension;
        $image->move(public_path('uploads/product'), $file_name);

        return response()->json(['success' => $file_name]);
    }

    public function ajaxDropZoneEdit(Request $request) {
        $id_programme = $request->id_programme;
        $image = $request->file('file');
        $fileInfo = $image->getClientOriginalName();
        $filename = pathinfo($fileInfo, PATHINFO_FILENAME);
        $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
        $file_name = $filename . '-' . time() . '.' . $extension;
        $image->move(public_path('uploads/product'), $file_name);

        $this->save_photo_programme($file_name, $id_programme, 0);
        return response()->json(['success' => 'true']);
    }

    public function AjaxFonDossierEdit(Request $request) {
        $id_programme = $request->id_programme;
        $image = $request->file('file');

        $fileInfo = $image->getClientOriginalName();
        $filename = pathinfo($fileInfo, PATHINFO_FILENAME);
        $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
        $file_name = $filename . '-' . time() . '.' . $extension;
        $image->move(public_path('uploads/product'), $file_name);

        $this->save_fond_dossier($file_name, $id_programme);
        return response()->json(['success' => 'true']);
    }

    public function AjaxEoiDossierEdit(Request $request) {
        $id_programme = $request->id_programme;
        $image = $request->file('file');

        $fileInfo = $image->getClientOriginalName();
        $filename = pathinfo($fileInfo, PATHINFO_FILENAME);
        $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
        $file_name = $filename . '-' . time() . '.' . $extension;
        $image->move(public_path('uploads/product'), $file_name);

        $this->save_eoi_dossier($file_name, $id_programme);
        return response()->json(['success' => 'true']);
    }

    public function AjaxLiaDossierEdit(Request $request) {
        $id_programme = $request->id_programme;
        $image = $request->file('file');

        $fileInfo = $image->getClientOriginalName();
        $filename = pathinfo($fileInfo, PATHINFO_FILENAME);
        $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
        $file_name = $filename . '-' . time() . '.' . $extension;
        $image->move(public_path('uploads/product'), $file_name);

        $this->save_lia_dossier($file_name, $id_programme);
        return response()->json(['success' => 'true']);
    }

    public function ajaxDropPhotoIcon(Request $request) {
        ProductsImage::where('id', $request->id_photo_prd_image)->delete();
        return response()->json(['success' => 'true']);
    }

    public function ajaxDropFondDossier(Request $request) {
        FondsDossier::where('id', $request->id_fond_dossier)->delete();
        return response()->json(['success' => 'true']);
    }

    public function ajaxDropEoiDossier(Request $request) {
        EoiDossier::where('id', $request->id_eoi_dossier)->delete();
        return response()->json(['success' => 'true']);
    }

    public function ajaxDropLiaDossier(Request $request) {
        LiaDossier::where('id', $request->id_lia_dossier)->delete();
        return response()->json(['success' => 'true']);
    }

    public function ajaxDropProduit(Request $request) {
        Product::where('id', $request->id_produit)->delete();
        return response()->json(['success' => 'true']);
    }

    public function ajaxRejetProduit(Request $request) {
        $product = Product::find($request->id_produit);
        Product::where('parent_id', $product->id)->delete(); //suppression programme
        $product->delete();
        return response()->json(['success' => 'true']);
    }

    public function ajaxChangeIconPhotoActive(Request $request) {
        ProductsImage::where('product_id', $request->id_prd)->update(['is_principal' =>
            0]);
        ProductsImage::where('id', $request->id_photo_prd)->update(['is_principal' => 1]);
        return response()->json(['success' => 'true']);
    }

    public function save_photo_programme($nom_photo, $id_programme, $is_principale) {
        //save image "table image"
        $image = new Image();
        $image->url = $nom_photo;
        $image->filename = $nom_photo;
        $image->filemime = '';
        $image->filepath = 'uploads/product/' . $nom_photo;
        $image->author_id = Auth::user()->id;
        $image->save();

        //save photo programme "table products_images"
        $image_programme = new ProductsImage();
        $image_programme->product_id = $id_programme;
        $image_programme->image_id = $image->id;
        $image_programme->is_principal = $is_principale;
        $image_programme->author_id = Auth::user()->id;
        $image_programme->save();
    }

    public function save_fond_dossier($nom_photo, $id_programme) {
        //save image "table image"
        $image = new Image();
        $image->url = $nom_photo;
        $image->filename = $nom_photo;
        $image->filemime = '';
        $image->filepath = 'uploads/product/' . $nom_photo;
        $image->author_id = Auth::user()->id;
        $image->save();

        //save photo programme "table products_fond_dossier"
        $fond_dossier = new FondsDossier();
        $fond_dossier->product_id = $id_programme;
        $fond_dossier->image_id = $image->id;
        $fond_dossier->author_id = Auth::user()->id;
        $fond_dossier->save();
    }

    public function save_eoi_dossier($nom_photo, $id_programme) {
        //save image "table image"
        $image = new Image();
        $image->url = $nom_photo;
        $image->filename = $nom_photo;
        $image->filemime = '';
        $image->filepath = 'uploads/product/' . $nom_photo;
        $image->author_id = Auth::user()->id;
        $image->save();

        //save photo programme "table products_fond_dossier"
        $fond_dossier = new EoiDossier();
        $fond_dossier->product_id = $id_programme;
        $fond_dossier->image_id = $image->id;
        $fond_dossier->author_id = Auth::user()->id;
        $fond_dossier->save();
    }

    public function save_lia_dossier($nom_photo, $id_programme) {
        //save image "table image"
        $image = new Image();
        $image->url = $nom_photo;
        $image->filename = $nom_photo;
        $image->filemime = '';
        $image->filepath = 'uploads/product/' . $nom_photo;
        $image->author_id = Auth::user()->id;
        $image->save();

        //save photo programme "table products_fond_dossier"
        $fond_dossier = new LiaDossier();
        $fond_dossier->product_id = $id_programme;
        $fond_dossier->image_id = $image->id;
        $fond_dossier->author_id = Auth::user()->id;
        $fond_dossier->save();
    }

    public function ajaxSaveProduct(Request $request) {
        $id_location = $this->save_location($request->countryId_product, $request->suburb_product,
            $request->postalCode_product, $request->ville_product, $request->display_address_product);
        $titre_product = $request->title_new_programme . '-' . $request->title_product;

        if (isset($request->chk_parking)) {
            $avoir_parking = 1;
        } else {
            $avoir_parking = 0;
        }

        if ($request->prg_anciennete && $request->prg_nature) {
            if ($request->commision_product == 'Sales commission rate (%)') {
                $taux_commission = $request->sales_rate_product;
            } else {
                $taux_commission = $request->rate_commission_product;
            }

            $this->save_new_produit($request->prg_anciennete, $request->prg_nature, $titre_product,
                $request->file('image'), $request->desc_product, 1, 0, $request->interior_area,
                $request->exterior_area, $request->total_area, $request->carport_spaces, $request->garage_spaces,
                $request->bathrooms, $request->bedrooms, $request->ensuite, 0, 1, date('Y'), $request->display_address_product,
                0, $request->price, $request->price_max_prd, 'AUD', $request->status, $request->product_type_id,
                $request->prg_cat_id, $request->postalCode_product, $request->state_id_product,
                $request->id_programme, $id_location, 0, $avoir_parking, 0, $request->commision_product,
                $taux_commission, $request->dt_db_travaux, $request->dt_prevu_livraison, $request->bonus_vente,
                $request->bonus_amount);

            return response()->json(['success' => 'true']);
        } else {
            return response()->json(['success' => 'false']);
        }
    }

    public function ajaxGetProductById(Request $request) {
        $product = Product::find($request->id_produit);
        $localisation = Localisation::find($product->location_id);
        return response()->json(['product' => $product, 'localisation' => $localisation]);
    }

    public function ajaxModifProduct(Request $request) {
        if ($request->id_location_product == 0) {
            //create localisation
            $id_location = $this->save_location($request->countryId_product, $request->suburb_product,
                $request->postalCode_product, $request->ville_product, $request->display_address_product);
        } else {
            $id_location = $request->id_location_product;
            //modification localisation
            Localisation::where('id', $request->id_location_product)->update(['area_level_1' =>
                $request->suburb_product, 'country' => $request->countryId_product, 'postalCode' =>
                $request->postalCode_product, 'locality' => $request->ville_product, 'route' =>
                $request->display_address_product]);
        }

        $titre_product = $request->title_product;
        if (isset($request->chk_parking)) {
            $avoir_parking = 1;
        } else {
            $avoir_parking = 0;
        }

        if (isset($request->chk_picine)) {
            $avoir_piscine = 1;
        } else {
            $avoir_piscine = 0;
        }

        if ($request->commision_product == 'Sales commission rate (%)') {
            $taux_commission = $request->sales_rate_product;
        } else {
            $taux_commission = $request->rate_commission_product;
        }

        Product::where('id', $request->id_product)->update(['title' => $titre_product,
            'content' => $request->desc_product, 'type_id' => $request->product_type_id,
            'postalCode' => $request->postalCode_product, 'display_address' => $request->display_address_product,
            'state_id' => $request->state_id_product, 'min_price' => $request->price,
            'max_price' => $request->price_max_prd, 'status' => $request->status, 'quantity' =>
            $request->quantity, 'bedrooms' => $request->bedrooms, 'ensuite' => $request->ensuite,
            'bathrooms' => $request->bathrooms, 'interior_area' => $request->interior_area,
            'exterior_area' => $request->exterior_area, 'total_area' => $request->total_area,
            'garage_spaces' => $request->garage_spaces, 'carport_spaces' => $request->carport_spaces,
            'avoir_parking_voie_public' => $avoir_parking, 'avoir_piscine' => $avoir_piscine,
            'location_id' => $id_location, 'commission_type' => $request->commision_product,
            'commision' => $taux_commission, 'avoir_bonus' => $request->bonus_vente,
            'amount_bonus' => $request->bonus_amount]);


        if ($request->file('image')) {
            $photo = $request->file('image');
            $image_prod = Image::storeAndSave($photo, 'product');
            Product::where('id', $request->id_product)->update(['image_id' => $image_prod->id]);
        }

        return response()->json(['success' => 'true']);
    }

}
