<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App;

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
use App\Models\FondsDossier;
use App\Models\EoiDossier;
use App\Models\LiaDossier;
use App\Models\Solicitor;

use Jleon\LaravelPnotify\Notify;
use Carbon\Carbon;
use App\Models\ProductsImage;
use App\Mail\MailTemplate;
use App\Models\MailsTemplate;
use Mail;
use App\Models\TemplateModel;
use App\Models\Message;
use App\Models\ModelMessage;
use DB;

class ProductController extends Controller {

    public function __construct() {
        // $this->middleware('auth');
        // $this->middleware('role', ['only' => ['3']]);
    }

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

                $afas = User::where('role', 3)->where('status', 'active')->where('location_id',
                    $product->location_id)->orderBy('id', 'desc')->get();

                return view('product.index')->with('item', $product)->with('location', $product->location)->with('pubs',
                    $pubs)->with('products', $products)->with('apls', $apls)->with('afas', $afas)->with('data',
                    json_encode($data))->with('states', $states)->with('locationTypes', $locationTypes)->with('types',
                    $types)->with('categories', $categories);

                // return view('product.index')->with('item', $product)->with('pubs',$pubs)->with('products', $products)->with('categories', $categories)->with('apls', $apls);
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

        return view('backend.product.all_programme')->with('title', __('afa.programme.title'))->with('records',
            $records);
    }

    public function nouveauProgrammes() {
        /*$send = new TemplateModel();
        $vars = array('{Nom AFA}'=>'Rakoto','{Ville}'=>'Ankadifotsy','{Etat}'=>'Mada','{Nom Programme}'=>'pro 897');
        $send->sendMailNotification(2,$vars,'dev4.easydata@gmail.com');*/

        $lapls = Localisation::select('localizations.*')->join('users',
            'users.location_id', '=', 'localizations.id')->where('users.role', '=', '4')->groupBy('localizations.locality')->get();

        return view('backend.product.nouveau_programme')->with('title', __('afa.programme.title'))->with('lapls',
            $lapls);
    }

    public function ajaxGetTypeProduitCategorie(Request $request) {
        $cat = $request->cat;
        if ($cat == 1) {
            //pour les produit autonome
            if ($request->categoryId == 2) {
                $typePrd = Type::where('categories_id', $request->categoryId)->where('is_autonome',
                    1)->get();
            } else {
                $typePrd = Type::where('categories_id', $request->categoryId)->get();
            }
        } else {
            //pour les programme
            if ($request->categoryId == 2) {
                $typePrd = Type::where('categories_id', $request->categoryId)->where('is_autonome',
                    0)->get();
            } else {
                $typePrd = Type::where('categories_id', $request->categoryId)->get();
            }
        }

        $lang = App::getLocale();
        if ($lang == 'en') {
            $lib_title = 'title_en';
        } else {
            $lib_title = 'title';
        }


        $output = '<option value="">' . trans('app.form.choix_txt') . '...</option>';
        foreach ($typePrd as $val) {
            if ($val->id == $request->type_id_active) {
                $type_active = 'selected="selected"';
            } else {
                $type_active = '';
            }
            $output .= '<option value="' . $val->id . '" ' . $type_active . '>' . $val->$lib_title .
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

    public function ajaxCheckAdresse(Request $request) {
        if ($request->display_address) {
            $adresse_exist = Product::where('display_address', $request->display_address)->get();
            if (count($adresse_exist) > 0) {
                echo "false";
            } else {
                echo "true";
            }
        }
    }

    public function ajaxCheckCreation(Request $request) {
        //trouver AFA par code postale
        $cp_programme = $request->postalCode;
        $slug = generateSlug($request->title_programme);
        $categorie = $request->cat_programmme_id;
        $type = $request->type_id;
        $programme_existe = Product::where('display_address', $request->display_address)->where('category_id',
            $categorie)->where('type_id', $type)->where('parent_id', 0)->get();
        $afa_possible = DB::select("SELECT `users`.id as id_afa, `users`.`name` FROM `users` LEFT JOIN `localizations` ON `users`.`location_id` = `localizations`.`id` WHERE `users`.`role` = 3 and `localizations`.`postalCode` = '$cp_programme'");
        $nb_programme = count($programme_existe) . '<br>';
        if ($nb_programme > 0) {
            return response()->json(['success' => 'false']);
        } else {
            $this->saveProgramme($request);
        }
        //dd(count($results));
        //$this->saveProgramme($request);
        //return response()->json(['success' => 'false']);
    }

    public function send_email_sellerByAfa_after_create_produit($id_produit) {
        $product = Product::find($id_produit);
        $localisation = Localisation::find($product->location_id);
        $state = State::find($product->state_id);
        $user = User::find($product->author_id);


        $template = MailsTemplate::where('id', 2)->get();
        $lang = App::getLocale();
        $body = 'template_' . $lang;
        $vars = array(
            '{Date system}' => Carbon::now()->toFormattedDateString(),
            '{Heure system}' => Carbon::now()->toTimeString(),
            '{Ville}' => $localisation->locality,
            '{Etat}' => $state->content,
            '{Nom Programme}' => $product->title,
            '{Code Postal}' => $localisation->postalCode);
        $sujet = $user->name . ' - ' . $product->title;
        $contenu = strtr($template[0]->$body, $vars);

        $content = ['title' => '', 'body' => $contenu];
        $email_to = $user->email;
        Mail::to($email_to)->send(new MailTemplate($content, $sujet));
    }

    public function send_email_afa_proprietaire_after_creat_produit($id_produit, $id_afa) {
        $product = Product::find($id_produit);
        $localisation = Localisation::find($product->location_id);
        $state = State::find($product->state_id);
        $user_afa = User::find($id_afa);

        $template = MailsTemplate::where('id', 11)->get();
        if (count($template) > 0) {
            $lang = App::getLocale();
            $body = 'template_' . $lang;
            $vars = array(
                '{Date system}' => Carbon::now()->toFormattedDateString(),
                '{Heure system}' => Carbon::now()->toTimeString(),
                '{Nom AFA}' => $user_afa->name,
                '{Nom Programme}' => $product->title,
                '{Ville}' => $localisation->locality,
                '{Etat}' => $state->content,
                '{Code Postal}' => $localisation->postalCode);
            $sujet_lab = 'sujet_' . $lang;
            $sujet = $template[0]->$sujet_lab;
            $contenu = strtr($template[0]->$body, $vars);
            $content = ['title' => '', 'body' => $contenu];
            $email_to = $user_afa->email;
            Mail::to($email_to)->send(new MailTemplate($content, $sujet));
        }
    }

    function save_location($country, $state, $suburb, $postalCode, $locality, $route,
        $longitude = '', $latitude = '') {
        $location = new Localisation();
        $location->country = $country;
        $location->area_level_1 = $state;
        $location->area_level_2 = $suburb;
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
        $display_address, $postalCode, $state_id, $title, $content, $location_id, $fond_dossier,
        $status, $type_commission, $commission, $id_afa = 0, $id_solicitor, $commencement_dt,
        $estimated_delvivery_dt, $programme_firb_pre_approved, $programme_pre_approved_sale,
        $seller_id) {

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
        $programme->quantity = 1;
        $programme->slug = $slug;
        $programme->location_id = $location_id;
        $programme->status = $status;
        $programme->commission_type = $type_commission;
        $programme->commision = $commission;
        $programme->author_id = Auth::user()->id;
        $programme->validated_at = Carbon::now();
        $programme->afaId_possible = $id_afa;
        $programme->solicitor_id = $id_solicitor;
        $programme->commencement_dt = $commencement_dt;
        $programme->estimated_delvivery_dt = $estimated_delvivery_dt;
        $programme->programme_firb_pre_approved = $programme_firb_pre_approved;
        $programme->programme_pre_approved_sale = $programme_pre_approved_sale;
        $programme->seller_id = $seller_id;
        $programme->save();

        // // save translation
        $detectLang = getGTranslateLangDetect($content);
        $detectLang === 'fr' ? setTranslate('fr', 'en', $content, 'programme', $programme) :
            setTranslate('en', 'fr', $content, 'programme', $programme);

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

    public function saveProgramme(Request $request) {
        $user = Auth::user();
        if ($user->isSbaBusiness() || $user->isSbaIndividual()) {
            $prefix = User::whereId($user->afa_id)->first();
            $seller_id = $prefix->id;
            $id_afa_p = $seller_id;
            //$titre_programme = Auth::user()->property_name . '-' . $request->title_programme;
            $titre_programme = $request->title_programme;
        } else {
            $prefix = '';
            $seller_id = $user->id;
            $titre_programme = $request->title_programme;

            $afa_possible = DB::select("SELECT `users`.id as id_afa FROM `users` LEFT JOIN `localizations` ON `users`.`location_id` = `localizations`.`id` WHERE `users`.`role` = 3 and `localizations`.`locality` = '$request->ville'");
            if (count($afa_possible) > 0) {
                $tab_afa = array();
                foreach ($afa_possible as $val) {
                    $tab_afa[] = $val->id_afa;
                }
                $id_afa_p = implode(', ', $tab_afa);
            } else {
                $id_afa_p = 0;
            }
        }

        $anciennete = $request->ancienneteBien;
        $nature = $request->natureBien;

        $programme_existe = Product::where('display_address', $request->display_address)->where('category_id',
            $request->cat_programmme_id)->where('type_id', $request->type_id)->where('parent_id',
            0)->get();


        if (count($programme_existe) > 0) {
            return back()->withInput()->withErrors(['msg' =>
                "We're sorry, but it appears that this program has already been registered or is on its way to be registered.\n Your program cannot be registered and your program registration form will be deleted.
"]);
        }

        $state = State::where('id', $request->state_id)->first();

        $id_location = $this->save_location($request->countryId, $state->content, $request->suburb,
            $request->postalCode, $request->ville, $request->display_address, $request->long,
            $request->lat);

        if ($request->commision == 'Sales commission rate (%)') {
            $taux_commision = $request->sales_rate;
        } else {
            $taux_commision = $request->rate_commission;
        }

        $id_programme = $this->save_programme($request->cat_programmme_id, $request->ancienneteBien,
            $request->natureBien, $request->prix_min, $request->prix_max, $request->type_id,
            $request->display_address, $request->postalCode, $request->state_id, $titre_programme,
            $request->description, $id_location, '', 'waiting', $request->commision, $taux_commision,
            $id_afa_p, $request->solicitor_id, $request->commencement_dt, $request->estimated_delvivery_dt,
            $request->programme_firb_pre_approved_program, $request->programme_pre_approved_sale,
            $seller_id);

        // save Solicitor info
        if ($request->cabinet_name && $request->cabinet_email && $request->cabinet_phone) {
            $solicitor = new Solicitor();
            $solicitor->cabinet_name = $request->cabinet_name;
            $solicitor->cabinet_email = $request->cabinet_email;
            $solicitor->cabinet_phone = $request->cabinet_phone;
            $solicitor->vendeur_id = Auth::user()->id;
            $solicitor->save();
        }


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
            $this->save_eoi_dossier($request->eoiDossier, $id_programme);
        }

        if (isset($request->liaDossier)) {
            foreach ($request->liaDossier as $key => $value) {
                $this->save_lia_dossier($value, $id_programme);
            }
        }

        if ($request->fondDossier) {
            foreach ($request->fondDossier as $key => $value) {
                $this->save_fond_dossier($value, $id_programme);
            }
        }
        //test si seller by afa qui crée le progremme
        if (Auth::user()->hasTypeUser(8) || Auth::user()->hasTypeUser(9)) {
            //envoie email à l'email à seller by afa
            $this->send_email_sellerByAfa_after_create_produit($id_programme);
            //envoie email au propriété
            $id_afa = Auth::user()->afa_id;
            //envoie email à l'AFA
            $this->send_email_afa_proprietaire_after_creat_produit($id_programme, $id_afa);
        }
        if (count($afa_possible) == 0) {
            //envoie message à l'admin pour lui dire fa tsis AFA
            $this->sendMessage_admin_after_create_programme($id_programme);
        }

        # notification
        return redirect()->route('mes-programmes')->with('success',
            "Produit a été créer avec succès");
    }

    public function sendMessage_admin_after_create_programme($id_produit) {
        $current = Auth::user();
        $message = ModelMessage::where('id', 1)->get();
        if (count($message) > 0) {
            $product = Product::find($id_produit);
            $localisation = Localisation::find($product->location_id);
            $state = State::find($product->state_id);

            $vars = array(
                '{Nom du Vendeur}' => $current->name,
                '{Nom Programme}' => $product->title,
                '{Ville}' => $localisation->locality,
                '{Etat}' => $state->content);
            $contenu = strtr($message[0]->message_fr, $vars);

            $item = new Message();
            $item->type = 'admin';
            $item->from_id = $current->id;
            $item->body = $contenu;
            $item->to_id = 1;
            $item->save();
        }
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

    public function editProgramme(Request $request, Product $product) {
        $localisation = Localisation::find($product->location_id);
        $produit_lie = Product::where('parent_id', $product->id)->get();

        $photo = ProductsImage::where('products_images.product_id', '=', $product->id)->join('images',
            'products_images.image_id', '=', 'images.id')->select('*',
            'products_images.id as prdImageId')->get();
        $fonDossier = FondsDossier::where('products_fond_dossier.product_id', '=', $product->id)->join('images',
            'products_fond_dossier.image_id', '=', 'images.id')->select('*',
            'products_fond_dossier.id as prdFondId')->get();

        $eoiDossier = EoiDossier::where('product_eoi.product_id', '=', $product->id)->join('images',
            'product_eoi.image_id', '=', 'images.id')->select('*',
            'product_eoi.id as prdEoiId')->get();

        $liaDossier = LiaDossier::where('product_lia.product_id', '=', $product->id)->join('images',
            'product_lia.image_id', '=', 'images.id')->select('*',
            'product_lia.id as prdLiaId')->get();

        $solicitor = "";
        if (Auth::user()->isSbaBusiness() || Auth::user()->isSbaIndividual()) {
            $solicitor = Solicitor::where('vendeur_id', Auth::id())->first();
        }

        return view('backend.product.edit_programme', ['product' => $product,
            'localisation' => $localisation, 'photos' => $photo, 'eoidossier' => $eoiDossier,
            'liadossier' => $liaDossier, 'product_lies' => $produit_lie, 'title' => __('afa.programme.title'),
            'dossier' => $fonDossier, 'solicitor' => $solicitor]);
    }

    public function editProduit(Request $request, Product $product) {
        $localisation = Localisation::find($product->location_id);
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

        return view('backend.product.edit_produit', ['product' => $product,
            'localisation' => $localisation, 'eoidossier' => $eoiDossier, 'dossier' => $fonDossier,
            'liadossier' => $liaDossier, 'photos' => $photo, 'title' => __('afa.programme.title')]);
    }

    public function updateProgramme(Request $request) {
        $product = Product::find($request->id);
        //modification localisation
        if ($request->location_Id != 0) {
            $localisation = Localisation::find($product->location_id);
            if ($localisation->route != $request->display_address || $localisation->locality !=
                $request->ville) {
                $longitude = $request->long;
                $latitude = $request->lat;
                Localisation::where('id', $product->location_id)->update(['area_level_1' => $request->suburb,
                    'country' => $request->countryId, 'postalCode' => $request->postalCode,
                    'locality' => $request->ville, 'route' => $request->display_address, 'longitude' =>
                    $longitude, 'latitude' => $latitude]);
                $id_location = $product->location_id;
            } else {
                $id_location = $request->location_Id;
            }
        } else {
            $state = State::where('id', $request->state_id)->first();
            $id_location = $this->save_location($request->countryId, $state->content, $request->suburb,
                $request->postalCode, $request->ville, $request->display_address, $request->long,
                $request->lat);
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
        $product->commencement_dt = $request->commencement_dt;
        $product->estimated_delvivery_dt = $request->estimated_delvivery_dt;
        $product->programme_firb_pre_approved = $request->programme_firb_pre_approved_program;
        $product->programme_pre_approved_sale = $request->programme_pre_approved_sale;
        $product->save();

        // update solicitor info
        if (isset($request->solicitor_id) && $request->solicitor_id != 0) {
            $solicitor = Solicitor::find($request->solicitor_id);

            $solicitor->cabinet_name = $request->cabinet_name;
            $solicitor->cabinet_email = $request->cabinet_email;
            $solicitor->cabinet_phone = $request->cabinet_phone;
            $solicitor->save();
        }

        // // update translation
        // updateTranslate('programme',$product,$request->description);

        return redirect()->route('edit.programme', $product->id)->with('success',
            "Produit mise à jour avec succès");
    }

    public function updateProduit(Request $request) {
        $product = Product::find($request->id);
        if ($product->location_id != 0) {
            $localisation = Localisation::find($product->location_id);
            if ($localisation->route != $request->display_address || $localisation->locality !=
                $request->ville_product) {
                Localisation::where('id', $product->location_id)->update(['area_level_1' => $request->suburb_product,
                    'country' => $request->countryId_product, 'postalCode' => $request->postalCode_product,
                    'locality' => $request->ville_product, 'route' => $request->display_address,
                    'longitude' => $request->long, 'latitude' => $request->lat]);
                $id_location = $product->location_id;
            } else {
                $id_location = $product->location_id;
            }
        } else {
            $state = State::where('id', $request->state_id)->first();
            $id_location = $this->save_location($request->countryId_product, $state->content,
                $request->suburb_product, $request->postalCode_product, $request->ville_product,
                $request->display_address, $request->long, $request->lat);
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

        // update solicitor info
        if(isset($request->solicitor_id) && $request->solicitor_id != 0){
            $solicitor = Solicitor::find($request->solicitor_id) ;

            $solicitor->cabinet_name = $request->cabinet_name ;
            $solicitor->cabinet_email = $request->cabinet_email ;
            $solicitor->cabinet_phone= $request->cabinet_phone ;
            $solicitor->save() ;
        }
        return redirect()->route('mes-produits')->with('success',
            "Produit a été créer avec succès");
    }

    public function produitProgramme(Request $request, Product $product) {
        $produit_lie = Product::where('parent_id', $product->id)->get();
        $localisation = Localisation::find($product->location_id);
        return view('backend.product.produit_programme', ['product' => $product, 'title' =>
            __('afa.programme.title'), 'product_lies' => $produit_lie, 'localisation' => $localisation]);
    }

    public function ajaxGetProductById(Request $request) {
        $product = Product::find($request->id_produit);
        $localisation = Localisation::find($product->location_id);
        $photo = ProductsImage::where('products_images.product_id', '=', $request->id_produit)->join('images',
            'products_images.image_id', '=', 'images.id')->select('*',
            'products_images.id as prdImageId')->get();
        return response()->json(['product' => $product, 'localisation' => $localisation,
            'photo' => $photo]);
    }

    function save_new_produit($anciennete, $nature = '', $title, $photo, $content, $qty,
        $area, $unite_area, $interior_area, $exterior_area, $total_area, $carport_spaces,
        $garage_spaces, $bathrooms, $bedrooms, $sweet, $number_of_floors, $new_construction,
        $year_built, $display_address, $price, $min_price, $max_price, $currency, $status,
        $type_id, $cat_programmme_id, $postalCode, $state_id, $programme_id, $location_id,
        $superficie_jardin, $avoir_parking_voie_public, $avoir_piscine, $type_commission,
        $taux_commission, $commencement_dt, $estimated_delvivery_dt, $avoir_bonus, $mt_bonus,
        $property_detail, $nb_parking_spots, $min_area, $max_area, $programme_firb_pre_approved_program,$id_afa) {

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
        $product->unite_area = $unite_area;
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
        $product->commencement_dt = $commencement_dt;
        $product->estimated_delvivery_dt = $estimated_delvivery_dt;
        $product->property_detail = $property_detail;
        $product->nb_parking_spots = $nb_parking_spots;
        $product->min_area = $min_area;
        $product->max_area = $max_area;
        $product->programme_firb_pre_approved = $programme_firb_pre_approved_program;
        $product->validated_at = Carbon::now();
        $product->afaId_possible = $id_afa;
        $product->save();

        // // save translation
        // $detectLang = getGTranslateLangDetect($content);
        // $detectLang==='fr'?setTranslate('fr','en',$content,'programme',$product):setTranslate('en','fr',$content,'programme',$product);
        return $product->id;
    }

    public function ajaxSaveProduct(Request $request) {
        $state = State::where('id', $request->state_id_product)->first();
        $id_location = $this->save_location($request->countryId_product, $state->content,
            $request->suburb_product, $request->postalCode_product, $request->ville_product,
            $request->display_address_product, $request->long, $request->lat);
        $titre_product = $request->title_new_programme . '-' . $request->title_product;

        if (isset($request->chk_parking)) {
            $avoir_parking = 1;
        } else {
            $avoir_parking = 0;
        }
        if ($request->commision_product == 'Sales commission rate (%)') {
            $taux_commission = $request->sales_rate_product;
        } else {
            $taux_commission = $request->rate_commission_product;
        }

        if ($request->prg_anciennete && $request->prg_nature) {
            if ($request->prg_cat_id == 1) {
                $id_produit = $this->save_new_produit($request->prg_anciennete, $request->prg_nature,
                    $titre_product, $request->file('image'), $request->desc_product, 1, 0, '', $request->interior_area,
                    $request->exterior_area, $request->total_area, $request->carport_spaces, $request->garage_spaces,
                    $request->bathrooms, $request->bedrooms, $request->ensuite, 0, 1, date('Y'), $request->display_address_product,
                    0, $request->price, $request->price_max_prd, 'AUD', $request->status, $request->product_type_id,
                    $request->prg_cat_id, $request->postalCode_product, $request->state_id_product,
                    $request->id_programme, $id_location, 0, $avoir_parking, 0, $request->commision_product,
                    $taux_commission, $request->dt_db_travaux, $request->dt_prevu_livraison, $request->bonus_vente,
                    $request->bonus_amount, '', 0, 0, 0, '');
            } else {
                $id_produit = $this->save_new_produit($request->prg_anciennete, $request->prg_nature,
                    $titre_product, $request->file('image'), $request->desc_product, 1, 0, '', 0, 0,
                    0, 0, 0, 0, 0, 0, 0, 1, date('Y'), $request->display_address_product, 0, $request->price,
                    $request->price_max_prd, 'AUD', $request->status, $request->product_type_id, $request->prg_cat_id,
                    $request->postalCode_product, $request->state_id_product, $request->id_programme,
                    $id_location, 0, $avoir_parking, 0, $request->commision_product, $taux_commission,
                    $request->dt_db_travaux, $request->dt_prevu_livraison, $request->bonus_vente, $request->bonus_amount,
                    '', 0, $request->min_area, $request->max_area);
            }

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
                    $this->save_photo_programme($value, $id_produit, $is_principal);
                }
            }

            return response()->json(['success' => 'true']);
        } else {
            return response()->json(['success' => 'false']);
        }
    }

    public function ajaxModifProduct(Request $request) {
        $product = Product::find($request->id_product);
        if ($request->location_id != 0) {
            $localisation = Localisation::find($product->location_id);
            if ($localisation->route != $request->display_address_product || $localisation->locality !=
                $request->ville_product) {
                $latitude = $request->lat;
                $longitude = $request->long;
                Localisation::where('id', $product->location_id)->update(['area_level_1' => $request->suburb_product,
                    'country' => $request->countryId_product, 'postalCode' => $request->postalCode_product,
                    'locality' => $request->ville_product, 'route' => $request->display_address_product,
                    'longitude' => $longitude, 'latitude' => $latitude]);
                $id_location = $product->location_id;
            }
        } else {
            $state = State::where('id', $request->state_id_product)->first();
            $id_location = $this->save_location($request->countryId_product, $state->content,
                $request->suburb_product, $request->postalCode_product, $request->ville_product,
                $request->display_address_product, $request->long, $request->lat);
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
        $product = Product::where('id', $request->id_product)->update(['title' => $titre_product,
            'content' => $request->desc_product, 'type_id' => $request->product_type_id,
            'postalCode' => $request->postalCode_product, 'display_address' => $request->display_address_product,
            'state_id' => $request->state_id_product, 'min_price' => $request->price,
            'max_price' => $request->price_max_prd, 'status' => $request->status, 'quantity' =>
            $request->quantity, 'bedrooms' => $request->bedrooms, 'ensuite' => $request->ensuite,
            'bathrooms' => $request->bathrooms, 'interior_area' => $request->interior_area,
            'exterior_area' => $request->exterior_area, 'total_area' => $request->total_area,
            'year_built' => $request->year_built, 'superficie_jardin' => $request->superficie_jardin,
            'garage_spaces' => $request->garage_spaces, 'carport_spaces' => $request->carport_spaces,
            'avoir_parking_voie_public' => $avoir_parking, 'avoir_piscine' => $avoir_piscine,
            'location_id' => $id_location, 'commission_type' => $request->commision_product,
            'commision' => $taux_commission, 'dt_db_travaux' => $request->dt_db_travaux,
            'dt_prevu_livraison' => $request->dt_prevu_livraison, 'avoir_bonus' => $request->bonus_vente,
            'amount_bonus' => $request->bonus_amount]);


        if ($request->dropPhoto) {
            foreach ($request->dropPhoto as $key => $value) {
                $this->save_photo_programme($value, $request->id_product, 0);
            }
        }

        if ($request->photo_trash) {
            foreach ($request->photo_trash as $key => $value) {
                Image::where('id', $value)->delete();
            }
        }

        // // update translation
        // updateTranslate('programme',$product,$request->desc_product);

        return response()->json(['success' => 'true']);
    }

    public function ajaxDropProduit(Request $request) {
        Product::where('id', $request->id_produit)->delete();
        return response()->json(['success' => 'true']);
    }

    public function ajaxDropProgramm(Request $request) {
        Product::where('id', $request->id_programm)->delete();
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
        $user = Auth::user();
        if ($user->isSbaBusiness() || $user->isSbaIndividual()) {
            $prefix = User::whereId($user->afa_id)->first();
            $seller_id = $prefix->id;
            $id_afa_p = $seller_id;
        } else {
            $seller_id = $user->id;
            $afa_possible = DB::select("SELECT `users`.id as id_afa FROM `users` LEFT JOIN `localizations` ON `users`.`location_id` = `localizations`.`id` WHERE `users`.`role` = 3 and `localizations`.`locality` = '$request->ville_product'");
            if (count($afa_possible) > 0) {
                $tab_afa = array();
                foreach ($afa_possible as $val) {
                    $tab_afa[] = $val->id_afa;
                }
                $id_afa_p = implode(', ', $tab_afa);
            } else {
                $id_afa_p = 0;
            }
        }

        $categorie = $request->cat_programmme_id;
        $anciennete = $request->ancienneteBien;
        $nature = '';

        $produit_existe = Product::where('display_address', $request->display_address_product)->where('category_id',
            $request->cat_programmme_id)->where('type_id', $request->product_type_id)->where('parent_id',
            -1)->get();

        if (count($produit_existe) > 0) {
            return back()->withInput()->withErrors(['msg' =>
                "We're sorry, but it appears that this product has already been registered or is on its way to be registered.\n Your program cannot be registered and your program registration form will be deleted.
"]);
        }

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

        if ($categorie == 1) {
            //enregistrement categorie résidentiel
            if ($anciennete == 'Neuf') {
                if ($nature == 'Programme immobilier') {
                    dd('1');
                    //creation location
                    $state = State::where('id', $request->state_id_product)->first();
                    $id_location = $this->save_location($request->countryId, $state->content, $request->suburb,
                        $request->postalCode, $request->ville, $request->display_address);
                    if ($request->commision == 'Sales commission rate (%)') {
                        $taux_commision = $request->sales_rate;
                    } else {
                        $taux_commision = $request->rate_commission;
                    }
                    //save programme
                    $id_programme = $this->save_programme($categorie, $anciennete, $nature, $request->prix_min,
                        $request->prix_max, $request->type_id, $request->display_address, $request->postalCode,
                        $request->state_id, $request->title_programme, $request->description, $id_location,
                        $request->file('fond_dossier'), 'waiting', $request->commision, $taux_commision);

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

                    //save eoi
                    if ($request->eoiDossier) {
                        foreach ($request->eoiDossier as $key => $value) {
                            $this->save_eoi_dossier($value, $id_programme);
                        }
                    }
                    //save lia
                    if ($request->liaDossier) {
                        foreach ($request->liaDossier as $key => $value) {
                            $this->save_lia_dossier($value, $id_programme);
                        }
                    }
                    //save fond dossier programme
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
                        $request->desc_product, 1, 0, 'm2', $request->interior_area, $request->exterior_area,
                        $request->total_area, $request->carport_spaces, $request->garage_spaces, $request->bathrooms,
                        $request->bedrooms, $request->ensuite, 0, 1, date('Y'), $request->display_address_product,
                        0, $request->price, $request->price_max_prd, 'AUD', $request->status, $request->product_type_id,
                        $request->cat_programmme_id, $request->postalCode_product, $request->state_id_product,
                        $id_programme, $id_location, 0, $avoir_parking, 0, $request->commision_product,
                        $taux_commision_prd, '', '', $request->bonus_vente, $request->bonus_amount, '',
                        0, 0, 0);
                } else {
                    //enregistrement produit autonome de Résidance new
                    $state = State::where('id', $request->state_id_product)->first();
                    dd($state->content);
                    $id_location = $this->save_location($request->countryId_product, $state->content,
                        $request->suburb_product, $request->postalCode_product, $request->ville_product,
                        $request->display_address_product, $request->long, $request->lat);
                    if ($request->commision_product == 'Sales commission rate (%)') {
                        $taux_commision_prd = $request->sales_rate_product;
                    } else {
                        $taux_commision_prd = $request->rate_commission_product;
                    }

                    $id_produit = $this->save_new_produit($anciennete, $nature, $request->title_product,
                        $request->file('image'), $request->desc_product, $request->quantity, 0, 'm2', $request->interior_area,
                        $request->exterior_area, $request->total_area, $request->carport_spaces, $request->garage_spaces,
                        $request->bathrooms, $request->bedrooms, $request->ensuite, 0, 1, date('Y'), $request->display_address_product,
                        $request->simple_price, 0, 0, 'AUD', $request->status, $request->product_type_id,
                        $request->cat_programmme_id, $request->postalCode_product, $request->state_id_product,
                        -1, $id_location, $request->superficie_jardin, $avoir_parking, $avoir_piscine, $request->commision_product,
                        $taux_commision_prd, $request->commencement_dt, $request->estimated_delvivery_dt,
                        $request->bonus_vente, $request->bonus_amount, '', 0, 0, 0, $request->programme_firb_pre_approved_program);

                    //save fond dossier programme
                    if ($request->p_fondDossier) {
                        foreach ($request->p_fondDossier as $key => $value) {
                            $this->save_fond_dossier($value, $id_produit);
                        }
                    }

                    if ($request->p_eoiDossier) {
                        $this->save_eoi_dossier($request->p_eoiDossier, $id_produit);
                    }

                    if ($request->p_liaDossier) {
                        foreach ($request->p_liaDossier as $key => $value) {
                            $this->save_lia_dossier($value, $id_produit);
                        }
                    }

                    if ($request->dropPhoto) {
                        foreach ($request->dropPhoto as $key => $value) {
                            $this->save_photo_programme($value, $id_produit, 0);
                        }
                    }
                }
            } else {
                //save produit autonome catégorie résidence de type old
                $state = State::where('id', $request->state_id_product)->first();
                $id_location = $this->save_location($request->countryId_product, $state->content,
                    $request->suburb_product, $request->postalCode_product, $request->ville_product,
                    $request->display_address_product, $request->long, $request->lat);
                if ($request->commision_product == 'Sales commission rate (%)') {
                    $taux_commision_prd = $request->sales_rate_product;
                } else {
                    $taux_commision_prd = $request->rate_commission_product;
                }

                $id_produit = $this->save_new_produit($anciennete, '', $request->title_product,
                    $request->file('image'), $request->desc_product, 1, 0, 'm2', $request->interior_area,
                    $request->exterior_area, $request->total_area, $request->carport_spaces, $request->garage_spaces,
                    $request->bathrooms, $request->bedrooms, $request->ensuite, 0, 1, date('Y'), $request->display_address_product,
                    $request->simple_price, 0, 0, 'AUD', $request->status, $request->product_type_id,
                    $request->cat_programmme_id, $request->postalCode_product, $request->state_id_product,
                    -1, $id_location, $request->superficie_jardin, $avoir_parking, $avoir_piscine, $request->commision_product,
                    $taux_commision_prd, $request->commencement_dt, $request->estimated_delvivery_dt,
                    $request->bonus_vente, $request->bonus_amount, '', 0, 0, 0, $request->programme_firb_pre_approved_program);

                //save fond dossier programme
                if ($request->p_fondDossier) {
                    foreach ($request->p_fondDossier as $key => $value) {
                        $this->save_fond_dossier($value, $id_produit);
                    }
                }

                if ($request->p_eoiDossier) {
                    $this->save_eoi_dossier($request->p_eoiDossier, $id_produit);
                }

                if ($request->p_liaDossier) {
                    foreach ($request->p_liaDossier as $key => $value) {
                        $this->save_lia_dossier($value, $id_produit);
                    }
                }

                if ($request->dropPhoto) {
                    foreach ($request->dropPhoto as $key => $value) {
                        $this->save_photo_programme($value, $id_produit, 0);
                    }
                }
            }
        } elseif ($categorie == 2) {
            //enregistrement produit autonome de catégorie FONCIER (LAND)
            $state = State::where('id', $request->state_id_product)->first();
            $id_location = $this->save_location($request->countryId_product, $state->content,
                $request->suburb_product, $request->postalCode_product, $request->ville_product,
                $request->display_address_product, $request->long, $request->lat);

            if ($request->commision_product == 'Sales commission rate (%)') {
                $taux_commision_prd = $request->sales_rate_product;
            } else {
                $taux_commision_prd = $request->rate_commission_product;
            }

            $id_produit = $this->save_new_produit('', 'Produit isolé', $request->title_product,
                $request->file('image'), $request->desc_product, 1, $request->surface_foncier, $request->unite_surface,
                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, date('Y'), $request->display_address_product, $request->simple_price,
                0, 0, 'AUD', $request->status, $request->product_type_id, $request->cat_programmme_id,
                $request->postalCode_product, $request->state_id_product, -1, $id_location, $request->superficie_jardin,
                0, 0, $request->commision_product, $taux_commision_prd, '', '', $request->bonus_vente,
                $request->bonus_amount, '', 0, 0, 0, $request->programme_firb_pre_approved_program);

            //save fond dossier programme
            if ($request->p_fondDossier) {
                foreach ($request->p_fondDossier as $key => $value) {
                    $this->save_fond_dossier($value, $id_produit);
                }
            }

            if ($request->p_eoiDossier) {
                $this->save_eoi_dossier($request->p_eoiDossier, $id_produit);
            }

            if ($request->p_liaDossier) {
                foreach ($request->p_liaDossier as $key => $value) {
                    $this->save_lia_dossier($value, $id_produit);
                }
            }

            if ($request->dropPhoto) {
                foreach ($request->dropPhoto as $key => $value) {
                    $this->save_photo_programme($value, $id_produit, 0);
                }
            }
        } elseif ($categorie == 3) {
            //produit industriel
            $state = State::where('id', $request->state_id_product)->first();
            $id_location = $this->save_location($request->countryId_product, $state->content,
                $request->suburb_product, $request->postalCode_product, $request->ville_product,
                $request->display_address_product, $request->long, $request->lat);

            if ($request->commision_product == 'Sales commission rate (%)') {
                $taux_commision_prd = $request->sales_rate_product;
            } else {
                $taux_commision_prd = $request->rate_commission_product;
            }

            $id_produit = $this->save_new_produit('', 'Produit isolé', $request->title_product,
                $request->file('image'), $request->desc_product, 1, 0, '', 0, 0, 0, 0, 0, 0, 0,
                0, 0, 0, date('Y'), $request->display_address_product, $request->simple_price, 0,
                0, 'AUD', $request->status, $request->product_type_id, $request->cat_programmme_id,
                $request->postalCode_product, $request->state_id_product, -1, $id_location, $request->superficie_jardin,
                0, 0, $request->commision_product, $taux_commision_prd, '', '', $request->bonus_vente,
                $request->bonus_amount, $request->property_detail, 0, 0, 0, $request->programme_firb_pre_approved_program);

            //save fond dossier programme
            if ($request->p_fondDossier) {
                foreach ($request->p_fondDossier as $key => $value) {
                    $this->save_fond_dossier($value, $id_produit);
                }
            }

            if ($request->p_eoiDossier) {
                $this->save_eoi_dossier($request->p_eoiDossier, $id_produit);
            }

            if ($request->p_liaDossier) {
                foreach ($request->p_liaDossier as $key => $value) {
                    $this->save_lia_dossier($value, $id_produit);
                }
            }
            if ($request->dropPhoto) {
                foreach ($request->dropPhoto as $key => $value) {
                    $this->save_photo_programme($value, $id_produit, 0);
                }
            }
        } elseif ($categorie == 4) {
            //produit commercial
            $state = State::where('id', $request->state_id_product)->first();
            $id_location = $this->save_location($request->countryId_product, $state->content,
                $request->suburb_product, $request->postalCode_product, $request->ville_product,
                $request->display_address_product, $request->long, $request->lat);
            if ($request->commision_product == 'Sales commission rate (%)') {
                $taux_commision_prd = $request->sales_rate_product;
            } else {
                $taux_commision_prd = $request->rate_commission_product;
            }

            $id_produit = $this->save_new_produit('', 'Produit isolé', $request->title_product,
                $request->file('image'), $request->desc_product, 1, $request->surface_commercial,
                'm2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, date('Y'), $request->display_address_product,
                $request->simple_price, 0, 0, 'AUD', $request->status, $request->product_type_id,
                $request->cat_programmme_id, $request->postalCode_product, $request->state_id_product,
                -1, $id_location, $request->superficie_jardin, $request->type_cutomer_parking, 0,
                $request->commision_product, $taux_commision_prd, '', '', $request->bonus_vente,
                $request->bonus_amount, $request->property_detail, $request->nombre_cutomer_parking,
                0, 0, $request->programme_firb_pre_approved_program);

            //save fond dossier programme
            if ($request->p_fondDossier) {
                foreach ($request->p_fondDossier as $key => $value) {
                    $this->save_fond_dossier($value, $id_produit);
                }
            }

            if ($request->p_eoiDossier) {
                $this->save_eoi_dossier($request->p_eoiDossier, $id_produit);
            }

            if ($request->p_liaDossier) {
                foreach ($request->p_liaDossier as $key => $value) {
                    $this->save_lia_dossier($value, $id_produit);
                }
            }

            if ($request->dropPhoto) {
                foreach ($request->dropPhoto as $key => $value) {
                    $this->save_photo_programme($value, $id_produit, 0);
                }
            }
        }

        // save Solicitor info
        if($request->cabinet_name && $request->cabinet_email && $request->cabinet_phone){
            $solicitor = new Solicitor();
            $solicitor->cabinet_name = $request->cabinet_name;
            $solicitor->cabinet_email = $request->cabinet_email;
            $solicitor->cabinet_phone = $request->cabinet_phone;
            $solicitor->vendeur_id = Auth::user()->id;
            $solicitor->save();
        }


        return redirect()->route('mes-produits')->with('success',
            "Produit a été créer avec succès");
    }

    public function ajaxDropZoneDeleteFile(Request $request) {
        $fileName = public_path('uploads/product') . '/' . $_POST['name'];
        unlink($fileName);
        return response()->json(['success' => 'true']);
    }
}
