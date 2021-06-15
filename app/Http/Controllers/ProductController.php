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
        $records = Product::allProgramme();
        return view('backend.product.all_programme')->with('title', __('afa.programme.title'))->with('records',
            $records);
    }

    public function nouveauProgrammes() {
        return view('backend.product.nouveau_programme')->with('title', __('afa.programme.title'));
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
        $display_address, $postalCode, $state_id, $title, $content, $location_id, $fond_dossier,$status) {
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
            $request->description, $id_location, $request->file('fond_dossier'),'waiting');

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
}
