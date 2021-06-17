<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\Product;
use App\Models\Category;
use App\Models\ObjectCategory;
use App\Models\Image;
use App\Models\Page;
use App\Models\Pub;
use App\Models\User;
use App\Models\State;
use App\Models\Type;
use App\Models\Localisation;
use App\Models\Firb;

use Jleon\LaravelPnotify\Notify;
use Carbon\Carbon;
use App\Models\ProductsImage;

class ProductController extends Controller {
    /**
     * Show the row product at the front.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $slug) {
        $products = Product::where('slug', '=', $slug)->get();

        if (sizeof($products) != 0) {
            foreach ($products as $key => $product) {

                if ($product->status == 'published') {
                    $product->view_count++;
                    $product->save();
                }

                $products = Product::orderBy('created_at', 'desc')->ofStatus('published')->isProduct()->take($this->recentSize)->get();

                $categories = Category::orderBy('created_at', 'desc')->has('products')->withCount('products')->take($this->recentSize)->get();

                $page = Page::where('path', '=', '/products*')->first();

                if ($page) {
                    $pubs = $page->pubs;
                } else {
                    $pubs = [];
                }

                $apls = User::ofRole(4)->isActive()->get();

                $data = ['id' => $product->id, 'lat' => $product->location ? $product->location->latitude :
                    0, 'lng' => $product->location ? $product->location->longitude : 0, 'title' => $product->title,
                    'area' => $product->area, 'type' => 'product', ];

                $product->load('images');

                $types = Type::orderBy('title', 'asc')->where('object_type', 'type')->get();

                $locationTypes = Type::orderBy('title', 'asc')->where('object_type', 'location')->get();

                $states = State::orderBy('content', 'asc')->get();

                $lapls = Localisation::select('localizations.*')->join('users',
                    'users.location_id', '=', 'localizations.id')->where('users.role', '=', '4')->groupBy('localizations.locality')->get();

                $afas = User::where('role', 3)->where('status', 'active')->where('location_id',
                    $product->location_id)->orderBy('id', 'desc')->get();

                return view('product.index')->with('item', $product)->with('location', $product->location)->with('pubs',
                    $pubs)->with('products', $products)->with('apls', $apls)->with('afas', $afas)->with('data',
                    json_encode($data))->with('states', $states)->with('locationTypes', $locationTypes)->with('types',
                    $types)->with('lapls', $lapls)->with('categories', $categories);
            }
        } else {
            abort(404);
        }
    }

    public function index2(Request $request, Product $product) {
        if ($product->status != 'published') {
            abort(404);
        }

        $product->view_count++;
        $product->save();

        $products = Product::orderBy('created_at', 'desc')->ofStatus('published')->isProduct()->take($this->recentSize)->get();

        $categories = Category::orderBy('created_at', 'desc')->has('products')->withCount('products')->take($this->recentSize)->get();

        $page = Page::where('path', '=', '/products*')->first();

        if ($page) {
            $pubs = $page->pubs;
        } else {
            $pubs = [];
        }

        $apls = User::ofRole('apl')->isActive()->get();

        $data = ['id' => $product->id, 'lat' => $product->location ? $product->location->latitude :
            0, 'lng' => $product->location ? $product->location->longitude : 0, 'title' => $product->title,
            'area' => $product->area, 'type' => 'product', ];

        $product->load('images');

        $types = Type::orderBy('title', 'asc')->where('object_type', 'type')->get();

        $locationTypes = Type::orderBy('title', 'asc')->where('object_type', 'location')->get();

        $states = State::orderBy('content', 'asc')->get();

        return view('product.index')->with('item', $product)->with('location', $product->location)->with('pubs',
            $pubs)->with('products', $products)->with('apls', $apls)->with('data',
            json_encode($data))->with('states', $states)->with('locationTypes', $locationTypes)->with('types',
            $types)->with('categories', $categories);
    }

    /**
     * Show the row product at the back.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $product) {
        return view('product.index')->with('item', $product)->with('breadcrumbs', __('app.product'));
    }

    /**
     * Show the list of product.
     * Admin Only
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String $filter
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request, $filter = 'all') {
        $this->middleware('auth');
        $this->middleware('role:admin');

        $categories = Category::orderBy('created_at', 'desc')->has('products')->withCount('products')->get();

        $page = $request->get('page');
        if (!$page)
            $page = 1;

        $record = $request->get('record');
        if (!$record)
            $record = $this->pageSize;

        $items = new Product();

        switch ($filter) {
            case 'ordered':
            case 'paid':
            case 'published':
            case 'pinged':
            case 'archived':
            case 'trashed':
                $items = $items->ofStatus($filter);
                $title = __('app.product.list.status', ['status' => __('app.' . $filter)]);
                break;
            default:
            case 'all':
                $title = __('app.product.list');
                break;
        }

        $category = $request->get('category');
        $category = intval($category);
        if ($category) {
            $items = $items->where('category_id', $category);
        }

        $q = $request->get('q');
        $q = trim($q);
        if ($q) {
            $items = $items->where(function ($query)use ($q) {
                return $query->orWhere('title', 'LIKE', '%' . $q . '%')->orWhere('content',
                    'LIKE', '%' . $q . '%'); }
            );
        }

        $states = State::all();
        $state = $request->get('state');
        $state = intval($state);
        if ($state) {
            $items = $items->where('state_id', $state);
        }

        $sellers = User::ofRole('seller')->isActive()->get();
        $seller = $request->get('seller');
        $seller = intval($seller);
        if ($seller) {
            $items = $items->where('seller_id', $seller);
        }

        $items = $items->isProduct();
        $items = $items->paginate($record);

        return view('admin.product.all', compact('items', 'filter', 'page'))->with('q',
            $q)->with('record', $record)->with('category', $category)->with('categories', $categories)->with('state',
            $state)->with('states', $states)->with('seller', $seller)->with('sellers', $sellers)->with('title',
            $title)->with('breadcrumbs', $title);
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

        return back()->with('success', "Le produit a été publié avec succés");
    }

    /**
     * Save product in archive
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function archive(Request $request, Product $product) {
        $this->middleware('auth');
        $this->middleware('role:admin');

        $product->status = 'archived';
        $product->save();

        return back()->with('success', "Le produit a été archivé avec succés");
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

        return back()->with('success', "Le produit a été restoré avec succés");
    }

    /**
     * Trash product
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request, Product $product) {
        $this->middleware('auth');
        $this->middleware('role:admin');

        $product->status = 'trashed';
        $product->save();

        return back()->with('success',
            "Le produit a été ajouté au corbeille avec succés");
    }

    /**
     * Delete Produt
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, Product $product) {
        $this->middleware('auth');
        $this->middleware('role:admin');

        $product->delete();

        return redirect()->route('admin.dashboard')->with('success',
            "Le produit a été supprimé avec succés");
    }

    public function mesProgramme(Request $request) {
        $records = Product::allProgrammeUser();
        $lapls = Localisation::select('localizations.*')
                    ->join('users','users.location_id','=','localizations.id')
                    ->where('users.role','=','4')
                    ->groupBy('localizations.locality')
                    ->get();

        return view('backend.product.all_programme')
            ->with('title', __('afa.programme.title'))
            ->with('records',$records)
            ->with('lapls',$lapls);
    }

    public function nouveauProgrammes() {
        $lapls = Localisation::select('localizations.*')
                    ->join('users','users.location_id','=','localizations.id')
                    ->where('users.role','=','4')
                    ->groupBy('localizations.locality')
                    ->get();

        return view('backend.product.nouveau_programme')
        ->with('title', __('afa.programme.title'))
        ->with('lapls',$lapls);
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

    public function ajaxDropZone(Request $request) {
        $image = $request->file('file');
        $fileInfo = $image->getClientOriginalName();
        $filename = pathinfo($fileInfo, PATHINFO_FILENAME);
        $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
        $file_name = $filename . '-' . time() . '.' . $extension;
        $image->move(public_path('uploads/product'), $file_name);

        return response()->json(['success' => $file_name]);
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

    function save_programme($categorie, $ancienete, $nature, $prix_min, $prix_max, $type_id,
        $display_address, $postalCode, $state_id, $title, $content, $location_id, $fond_dossier,
        $status) {
        $slug = generateSlug($title);
        $programme = new Product();
        if ($file = $fond_dossier) {
            $fond_dossier = Image::storeAndSave($fond_dossier, 'product');
            $programme->image_fond_dossier_id = $fond_dossier->id;
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
        $programme->status = $status;
        $programme->author_id = Auth::user()->id;
        $programme->validated_at = Carbon::now();
        $programme->save();
        return $programme->id;
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

    public function saveProgramme(Request $request) {
        $anciennete = $request->ancienneteBien;
        $nature = $request->natureBien;

        $id_location = $this->save_location($request->countryId, $request->suburb, $request->postalCode,
            '', '', $request->ville);
        $id_programme = $this->save_programme($request->cat_programmme_id, $request->ancienneteBien,
            $request->natureBien, $request->prix_min, $request->prix_max, $request->type_id,
            $request->display_address, $request->postalCode, $request->state_id, $request->title_programme,
            $request->description, $id_location, $request->file('fond_dossier'), 'waiting');

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

        # notification
        return redirect()->route('mes-programmes')->with('success',
            "Produit a été créer avec succès");
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

    public function ajaxChangeIconPhotoActive(Request $request) {
        ProductsImage::where('product_id', $request->id_prd)->update(['is_principal' =>
            0]);
        ProductsImage::where('id', $request->id_photo_prd)->update(['is_principal' => 1]);
        return response()->json(['success' => 'true']);
    }

    public function ajaxDropPhotoIcon(Request $request) {
        ProductsImage::where('id', $request->id_photo_prd_image)->delete();
        return response()->json(['success' => 'true']);
    }

    public function editProgramme(Request $request, Product $product) {
        $localisation = Localisation::find($product->location_id);
        $produit_lie = Product::where('parent_id', $product->id)->get();
        $photo = ProductsImage::where('products_images.product_id', '=', $product->id)->join('images',
            'products_images.image_id', '=', 'images.id')->select('*',
            'products_images.id as prdImageId')->get();
        return view('backend.product.edit_programme', ['product' => $product,
            'localisation' => $localisation, 'photos' => $photo, 'product_lies' => $produit_lie,
            'title' => __('afa.programme.title')]);
    }

    public function updateProgramme(Request $request) {
        $product = Product::find($request->id);
        //modification localisation
        Localisation::where('id', $request->location_Id)->update(['area_level_1' => $request->suburb,
            'country' => $request->countryId, 'postalCode' => $request->postalCode,
            'locality' => $request->ville]);

        $slug = generateSlug($request->title_programme);
        $product->title = $request->title_programme;
        $product->slug = $slug;
        $product->content = $request->description;
        $product->min_price = $request->prix_min;
        $product->max_price = $request->prix_max;
        $product->display_address = $request->display_address;
        $product->type_id = $request->type_id;
        $product->save();

        return redirect()->route('edit.programme', $product->id)->with('success',
            "Produit a été créer avec succès");
    }

    public function produitProgramme(Request $request, Product $product) {
        $produit_lie = Product::where('parent_id', $product->id)->get();
        return view('backend.product.produit_programme', ['product' => $product, 'title' =>
            __('afa.programme.title'), 'product_lies' => $produit_lie]);
    }

    public function ajaxGetProductById(Request $request) {
        $product = Product::find($request->id_produit);
        $localisation = Localisation::find($product->location_id);
        return response()->json(['product' => $product, 'localisation' => $localisation]);
    }

    function save_new_produit($anciennete, $nature, $title, $photo, $content, $qty,
        $area, $interior_area, $exterior_area, $total_area, $carport_spaces, $garage_spaces,
        $bathrooms, $bedrooms, $sweet, $number_of_floors, $new_construction, $year_built,
        $display_address, $min_price, $max_price, $currency, $status, $type_id, $cat_programmme_id,
        $postalCode, $state_id, $programme_id, $location_id, $superficie_jardin, $avoir_parking_voie_public,
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
        $product->validated_at = Carbon::now();
        $product->save();
    }

    public function ajaxSaveProduct(Request $request) {
        $id_location = $this->save_location($request->countryId_product, $request->suburb_product,
            $request->postalCode_product, '', '', $request->ville_product);
        $titre_product = $request->title_new_programme . '-' . $request->title_product;

        if (isset($request->chk_parking)) {
            $avoir_parking = 1;
        } else {
            $avoir_parking = 0;
        }

        if ($request->prg_anciennete && $request->prg_nature) {
            $this->save_new_produit($request->prg_anciennete, $request->prg_nature, $titre_product,
                $request->file('image'), $request->desc_product, 1, 0, $request->interior_area,
                $request->exterior_area, $request->total_area, $request->carport_spaces, $request->garage_spaces,
                $request->bathrooms, $request->bedrooms, $request->ensuite, 0, 1, date('Y'), $request->display_address_product,
                $request->price, $request->price_max_prd, 'AUD', $request->status, $request->product_type_id,
                $request->prg_cat_id, $request->postalCode_product, $request->state_id_product,
                $request->id_programme, $id_location, 0, $avoir_parking, 0);

            return response()->json(['success' => 'true']);
        } else {
            return response()->json(['success' => 'false']);
        }
    }

    public function ajaxModifProduct(Request $request) {
        //modification localisation
        Localisation::where('id', $request->id_location_product)->update(['area_level_1' =>
            $request->suburb_product, 'country' => $request->countryId_product, 'postalCode' =>
            $request->postalCode_product, 'locality' => $request->ville_product]);

        $titre_product = $request->title_new_programme . '-' . $request->title_product;
        if (isset($request->chk_parking)) {
            $avoir_parking = 1;
        } else {
            $avoir_parking = 0;
        }

        Product::where('id', $request->id_product)->update(['title' => $titre_product,
            'content' => $request->desc_product, 'type_id' => $request->product_type_id,
            'postalCode' => $request->postalCode_product, 'display_address' => $request->display_address_product,
            'state_id' => $request->state_id_product, 'min_price' => $request->price,
            'max_price' => $request->price_max_prd, 'status' => $request->status, 'quantity' =>
            $request->quantity, 'bedrooms' => $request->bedrooms, 'ensuite' => $request->ensuite,
            'bathrooms' => $request->bathrooms, 'interior_area' => $request->interior_area,
            'exterior_area' => $request->exterior_area, 'total_area' => $request->total_area,
            'garage_spaces' => $request->garage_spaces, 'carport_spaces' => $request->carport_spaces]);


        if ($request->file('image')) {
            $photo = $request->file('image');
            $image_prod = Image::storeAndSave($photo, 'product');
            Product::where('id', $request->id_product)->update(['image_id' => $image_prod->id]);
        }

        return response()->json(['success' => 'true']);
    }

    public function ajaxDropProduit(Request $request) {
        Product::where('id', $request->id_produit)->delete();
        return response()->json(['success' => 'true']);
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

    public function mesProduits(Request $request) {
        $records = Product::allProductUser();
        return view('backend.product.all_product')->with('title', __('afa.programme.title'))->with('records',
            $records);
    }

    public function nouveauProduit() {
        return view('backend.product.nouveau_produit')->with('title', __('afa.new.product.title'));
    }

    public function saveProduct(Request $request) {
        $anciennete = $request->ancienneteBien;
        $nature = $request->natureBien;

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
                //creation programme
                $id_location = $this->save_location($request->countryId, $request->suburb, $request->postalCode,
                    '', '', $request->ville);

                $id_programme = $this->save_programme($request->cat_programmme_id, $request->ancienneteBien,
                    $request->natureBien, $request->prix_min, $request->prix_max, $request->type_id,
                    $request->display_address, $request->postalCode, $request->state_id, $request->title_programme,
                    $request->description, $id_location, $request->file('fond_dossier'), 'waiting');

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
                //creation produit
                $titre_product = $request->title_programme . '-' . $request->title_product;
                $this->save_new_produit($anciennete, $nature, $titre_product, $request->file('image'),
                    $request->desc_product, 1, 0, $request->interior_area, $request->exterior_area,
                    $request->total_area, $request->carport_spaces, $request->garage_spaces, $request->bathrooms,
                    $request->bedrooms, $request->ensuite, 0, 1, date('Y'), $request->display_address_product,
                    $request->price, $request->price_max_prd, 'AUD', $request->status, $request->product_type_id,
                    $request->cat_programmme_id, $request->postalCode_product, $request->state_id_product,
                    $id_programme, $id_location, 0, $avoir_parking, 0);
            } else {
                //creation location produit isolé
                $id_location = $this->save_location($request->countryId_product, $request->suburb_product,
                    $request->postalCode_product, '', '', $request->ville_product);

                $this->save_new_produit($anciennete, $nature, $request->title_product, $request->file
                    ('image'), $request->desc_product, $request->quantity, 0, $request->interior_area,
                    $request->exterior_area, $request->total_area, $request->carport_spaces, $request->garage_spaces,
                    $request->bathrooms, $request->bedrooms, $request->ensuite, 0, 1, date('Y'), $request->display_address_product,
                    $request->price, $request->price_max_prd, 'AUD', $request->status, $request->product_type_id,
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
                $request->price, $request->price_max_prd, 'AUD', $request->status, $request->product_type_id,
                $request->cat_programmme_id, $request->postalCode_product, $request->state_id_product,
                -1, $id_location, $request->superficie_jardin, $avoir_parking, $avoir_piscine);
        }


        return redirect()->route('mes-produits')->with('success',
            "Produit a été créer avec succès");
    }
}
