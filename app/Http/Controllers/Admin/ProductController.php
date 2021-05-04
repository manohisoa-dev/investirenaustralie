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
use Auth;

use GuzzleHttp;
use GuzzleHttp\Client;

class ProductController extends Controller {
    public $viewDir = "admin.product";

    public function index() {
        $records = Product::findRequested();
        $status = Product::groupBy('status')->pluck('status', 'status');
        return $this->view("index", ['records' => $records, 'status' => $status]);
    }

    public function programme() {
        $records = Product::allProgramme();
        $status = Product::groupBy('status')->pluck('status', 'status');
        return $this->view("programme", ['records' => $records, 'status' => $status]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create() {
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
        if ($request->type == 'programme') {
            //creation simple programme
            $id_location = $this->save_location($request->countryId, $request->suburb, $request->postalCode,
                '', '', $request->ville);
            $this->save_programme($request->cat_programmme_id, $request->ancienneteBien, $request->natureBien,
                $request->file('image_programme'), $request->prix_min, $request->prix_max, $request->type_id,
                $request->display_address, $request->postalCode, $request->state_id, $request->title_programme,
                $request->description, $id_location);

            # notification
            Notify::success('Programme a été créer avec succès');
            return redirect(route('admin.product.programme'));
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
                            '', '', $request->ville);
                        $id_programme = $this->save_programme($request->cat_programmme_id, $request->ancienneteBien,
                            $request->natureBien, $request->file('image_programme'), $request->prix_min, $request->prix_max,
                            $request->type_id, $request->display_address, $request->postalCode, $request->state_id,
                            $request->title_programme, $request->description, $id_location);
                        //creation produit
                        $this->save_new_produit($anciennete, $nature, $request->title_product, $request->file
                            ('image'), $request->desc_product, $request->quantity, 0, $request->interior_area,
                            $request->exterior_area, $request->total_area, $request->carport_spaces, $request->garage_spaces,
                            $request->bathrooms, $request->bedrooms, $request->ensuite, 0, 1, date('Y'), $request->display_address_product,
                            $request->price, $request->currency, $request->status, $request->product_type_id,
                            $request->cat_programmme_id, $request->postalCode_product, $request->state_id_product,
                            $id_programme, $id_location, 0, $avoir_parking, 0);
                    } else {
                        //creation produit avec programme existant
                        $id_location = Product::where('id', $request->parent_id)->get(['location_id']);
                        $this->save_new_produit($anciennete, $nature, $request->title_product, $request->file
                            ('image'), $request->desc_product, $request->quantity, 0, $request->interior_area,
                            $request->exterior_area, $request->total_area, $request->carport_spaces, $request->garage_spaces,
                            $request->bathrooms, $request->bedrooms, $request->ensuite, 0, 1, date('Y'), $request->display_address_product,
                            $request->price, $request->currency, $request->status, $request->product_type_id,
                            $request->cat_programmme_id, $request->postalCode_product, $request->state_id_product,
                            $request->parent_id, $id_location, 0, $avoir_parking, 0);
                    }
                } else {
                    //creation produit isolé
                    //creation location produit isolé
                    $id_location = $this->save_location($request->countryId_product, $request->suburb_product,
                        $request->postalCode_product, '', '', $request->ville_product);

                    $this->save_new_produit($anciennete, $nature, $request->title_product, $request->file
                        ('image'), $request->desc_product, $request->quantity, 0, $request->interior_area,
                        $request->exterior_area, $request->total_area, $request->carport_spaces, $request->garage_spaces,
                        $request->bathrooms, $request->bedrooms, $request->ensuite, 0, 1, date('Y'), $request->display_address_product,
                        $request->price, $request->currency, $request->status, $request->product_type_id,
                        $request->cat_programmme_id, $request->postalCode_product, $request->state_id_product,
                        -1, $id_location, $request->superficie_jardin, $avoir_parking, $avoir_piscine);
                }
            } else {
                //si ancienneté == ancien
                $id_location = $this->save_location($request->countryId_product, $request->suburb_product,
                    $request->postalCode_product, '', '', $request->ville_product);

                $this->save_new_produit($anciennete, '', $request->title_product, $request->file
                    ('image'), $request->desc_product, $request->quantity, 0, $request->interior_area,
                    $request->exterior_area, $request->total_area, $request->carport_spaces, $request->garage_spaces,
                    $request->bathrooms, $request->bedrooms, $request->ensuite, 0, 1, date('Y'), $request->display_address_product,
                    $request->price, $request->currency, $request->status, $request->product_type_id,
                    $request->cat_programmme_id, $request->postalCode_product, $request->state_id_product,
                    -1, $id_location, $request->superficie_jardin, $avoir_parking, $avoir_piscine);
            }


            # notification
            Notify::success('Produit a été créer avec succès');
            return redirect(route('admin.product.index'));
        }
    }

    function get_lonlat($address) {
        try {
            //Converts address into Lat and Lng
            $client = new Client(); //GuzzleHttp\Client
            $result = (string )$client->post("https://maps.googleapis.com/maps/api/geocode/json?address=$address", ['form_params' => ['key' =>
                'AIzaSyCzqATs_wp3WXAVlt9iPVS9GcRFPGcIZZw']])->getBody();
            $json = json_decode($result);
            $address->lat = $json->results[0]->geometry->location->lat;
            $address->lng = $json->results[0]->geometry->location->lng;
            return $result;
        }
        catch (exception $e) {
        }
    }

    function save_location($country, $suburb, $postalCode, $longitude, $latitude, $locality) {
        $location = new Localisation();
        $location->country = $country;
        $location->area_level_1 = $suburb;
        $location->postalCode = $postalCode;
        $location->longitude = $longitude;
        $location->latitude = $latitude;
        $location->locality = $locality;
        $location->author_id = Auth::user()->id;

        $location->save();
        return $location->id;
    }

    function save_programme($categorie, $ancienete, $nature, $photo, $prix_min, $prix_max,
        $type_id, $display_address, $postalCode, $state_id, $title, $content, $location_id) {
        $slug = generateSlug($title);
        $programme = new Product();
        if ($file = $photo) {
            $image = Image::storeAndSave($file, 'product');
            $programme->image_id = $image->id;
        }
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
        $programme->author_id = Auth::user()->id;
        $programme->save();
        return $programme->id;
    }

    function save_new_produit($anciennete, $nature, $title, $photo, $content, $qty,
        $area, $interior_area, $exterior_area, $total_area, $carport_spaces, $garage_spaces,
        $bathrooms, $bedrooms, $sweet, $number_of_floors, $new_construction, $year_built,
        $display_address, $price, $currency, $status, $type_id, $cat_programmme_id, $postalCode,
        $state_id, $programme_id, $location_id, $superficie_jardin, $avoir_parking_voie_public,
        $avoir_piscine) {

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
        $product->save();
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Product $product) {
        return $this->view("show", ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Product $product) {
        if ($product->parent_id == 0) {
            //modification programme
            return $this->view("edit_programme", ['product' => $product, 'type' =>
                'programme']);
        } else {
            //modification proudiut
            return $this->view("edit", ['product' => $product, 'type' => 'programme']);
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
            if ($request->file('image_programme')) {
                $file_pro = $request->file('image_programme');
                $image_pro = Image::storeAndSave($file_pro, 'product');
                $product->image_id = $image_pro->id;
            }
            $slug = generateSlug($request->title);
            $product->title = $request->title;
            $product->slug = $slug;
            $product->category_id = $request->category_id;
            $product->min_price = $request->prix_min;
            $product->max_price = $request->prix_max;
            $product->save(); # notification
            Notify::success('Programme a été mise à jour avec succès');
            return redirect(route('admin.product.programme'));
        }
        /*if ($request->isXmlHttpRequest()) {
        $data = [$request->name => $request->value];
        $validator = \Validator::make($data, Product::validationRules($request->name));
        if ($validator->fails())
        return response($validator->errors()->first($request->name), 403);
        $product->update($data);
        return "Record updated";
        }

        $this->validate($request, Product::validationRules());

        $product->update($request->all());

        # notification
        Notify::success('Produit a été mise à jour avec succès');
        return redirect(route('admin.product.index'));*/
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
            return redirect(route('admin.product.programme'));
        } else {
            $product->delete(); # notification
            Notify::success('Produit a été supprimer avec succès');
            return redirect(route('admin.product.programme'));
        }
    }

    public function archive(Request $request, Product $product) {
        $product->status = 'archived';
        $product->save();
        Notify::success('Le produit a été archivé avec succés');
        return redirect(route('admin.product.index'));
    }

    /**
     * Trash product
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request, Product $product) {
        $product->status = 'trashed';
        $product->save();
        Notify::success('Le produit a été ajouté au corbeille avec succés');
        return redirect(route('admin.product.index'));
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
        $product->status = 'pinged';
        $product->save();
        Notify::success('Le produit a été restoré avec succés');
        return redirect(route('admin.product.index'));
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
        $product->save();
        Notify::success('Le produit a été publié avec succés');
        return redirect(route('admin.product.index'));
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

    public function ajaxCheckFirb() {
        $code_postal = $_GET['postal_code'];
        $firb = Firb::where('codePostal', $code_postal)->get();
        if (count($firb) > 0) {
            echo "true";
        } else {
            echo "false";
        }
    }

}
