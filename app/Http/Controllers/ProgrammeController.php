<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Product;
use App\Models\Category;
use App\Models\State;
use App\Models\Localisation;
use App\Models\Search;
use App\Models\Page;
use App\Models\User;
use App\Models\Blog;
use App\Models\Parameter;
use App\Models\Config;
use App\Models\FondsDossier;

class ProgrammeController extends Controller {

    /**
     * Show the row product at the front.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function show(Request $request, $slug) {

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

                $apls = User::ofRole('apl')->isActive()->get();

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

                if (Auth::check()) {
                    if (Auth::user()->role == 1 || Auth::user()->role == 3 || Auth::user()->role == 4) {
                        $fonDossier = FondsDossier::where('products_fond_dossier.product_id', '=', $product->id)->join('images',
                            'products_fond_dossier.image_id', '=', 'images.id')->select('*',
                            'products_fond_dossier.id as prdFondId')->get();
                    }else{
                        $fonDossier = array();
                    }
                } else {
                    $fonDossier = array();
                }


                return view('programme.single')->with('item', $product)->with('location', $product->location)->with('pubs',
                    $pubs)->with('products', $products)->with('apls', $apls)->with('data',
                    json_encode($data))->with('states', $states)->with('locationTypes', $locationTypes)->with('types',
                    $types)->with('lapls', $lapls)->with('afas', $afas)->with('categories', $categories)->with('dossier',
                    $fonDossier);
            }
        } else {
            abort(404);
        }
    }

    public function all(Request $request, Category $category = null, $cat = null) {

        $page = $request->get('page');
        if (empty($page))
            $page = 1;

        $orderBy = $request->get('orderBy');
        if (!in_array($orderBy, ['price', 'created_at', 'view_count']))
            $orderBy = Config::where('name', '=', 'order_by')->first()->content;

        $order = $request->get('order');
        if (!in_array($order, ['desc', 'asc']))
            $order = 'asc';

        $viewProd = $request->get('view_prod');
        if (!in_array($viewProd, ['grid', 'list']))
            $viewProd = 'list';

        $items = Product::ofStatus('published')->isParent(0)->where('quantity', '>', 0);

        if ($cat) {
            $cat_id = Category::where('slug', $cat)->first()->id;
            $items = $items->where('category_id', $cat_id);
        }

        $show = $request->get('show');
        if (!in_array($show, ['10', '25', '50', '100']))
            $show = ' ';

        $showBy = $request->get('showBy');
        if (!in_array($showBy, ['map', 'mat']))
            $showBy = 'mat';

        // Save search key on data base
        $search = new Search();
        $q = $request->q;
        if ($q) {
            $items = $items->where(function ($query)use ($q) {
                return $query->where('content', 'LIKE', '%' . $q . '%')->orWhere('title', 'LIKE',
                    '%' . $q . '%'); }
            );
            $search->keyword = $q;
            // $search->save();
        }

        $items = $items->orderBy($orderBy, $order);

        $items = $items->paginate($show ? (int)$show : $this->pageSize);

        if ($request->ajax()) {
            return response()->json(array('html' => view('ajax.product.all', compact('items'))->render
                    ()));
        }

        $products = Product::orderBy('created_at', 'desc')->ofStatus('published')->isProduct()->get();

        $programmes = Product::orderBy('created_at', 'desc')->isParent(0)->ofStatus('published')
            // ->take($show?(int)$show:$this->recentSize)
            ->get();

        $categories = Category::orderBy('created_at', 'desc')->has('products')->withCount('products')->take($this->recentSize)->get();

        $page2 = Page::where('path', '=', '/products*')->first();
        if ($page2) {
            $pubs = $page2->pubs;
        } else {
            $pubs = [];
        }

        $typesRes = Type::orderBy('title', 'asc')->where('object_type', 'type')->where('categories_id',
            1)->get();

        $typesFonc = Type::orderBy('title', 'asc')->where('object_type', 'type')->where('categories_id',
            2)->get();

        $typesInd = Type::orderBy('title', 'asc')->where('object_type', 'type')->where('categories_id',
            3)->get();

        $typesComm = Type::orderBy('title', 'asc')->where('object_type', 'type')->where('categories_id',
            4)->get();

        $locationTypes = Type::orderBy('title', 'asc')->where('object_type', 'location')->get();

        $anciennetes = Type::orderBy('title', 'asc')->where('object_type', 'anciennete')->get();

        $agricoles = Type::orderBy('title', 'asc')->where('object_type', 'agricole')->get();

        $industriels = Type::orderBy('title', 'asc')->where('object_type', 'industriel')->get();

        $commercials = Type::orderBy('title', 'asc')->where('object_type', 'commercial')->get();

        $states = State::orderBy('content', 'asc')->get();

        $lapls = Localisation::select('localizations.*')->join('users',
            'users.location_id', '=', 'localizations.id')->where('users.role', '=', '4')->groupBy('localizations.locality')->get();

        $min_price_residentiel = Product::groupBy('category_id')->where('category_id',
            '=', 1)->min('price');

        $max_price_residentiel = Product::groupBy('category_id')->where('category_id',
            '=', 1)->max('price');

        $min_land_area_residentiel = Product::groupBy('category_id')->where('category_id',
            '=', 1)->min('land_area');

        $max_land_area_residentiel = Product::groupBy('category_id')->where('category_id',
            '=', 1)->max('land_area');

        $min_garage_space_residentiel = Product::groupBy('category_id')->where('category_id',
            '=', 1)->min('garage_spaces');

        $max_garage_space_residentiel = Product::groupBy('category_id')->where('category_id',
            '=', 1)->max('garage_spaces');

        $min_bathrooms_residentiel = Product::groupBy('category_id')->where('category_id',
            '=', 1)->min('bathrooms');

        $max_bathrooms_residentiel = Product::groupBy('category_id')->where('category_id',
            '=', 1)->max('bathrooms');

        $min_bedrooms_residentiel = Product::groupBy('category_id')->where('category_id',
            '=', 1)->min('bedrooms');

        $max_bedrooms_residentiel = Product::groupBy('category_id')->where('category_id',
            '=', 1)->max('bedrooms');

        $min_number_of_floors_residentiel = Product::groupBy('category_id')->where('category_id',
            '=', 1)->min('number_of_floors');

        $max_number_of_floors_residentiel = Product::groupBy('category_id')->where('category_id',
            '=', 1)->max('number_of_floors');

        $min_price_foncier = Product::groupBy('category_id')->where('category_id', '=',
            2)->min('price');

        $max_price_foncier = Product::groupBy('category_id')->where('category_id', '=',
            2)->max('price');

        $min_land_area_foncier = Product::groupBy('category_id')->where('category_id',
            '=', 2)->min('land_area');

        $max_land_area_foncier = Product::groupBy('category_id')->where('category_id',
            '=', 2)->max('land_area');

        $min_price_industriel = Product::groupBy('category_id')->where('category_id',
            '=', 3)->min('price');

        $max_price_industriel = Product::groupBy('category_id')->where('category_id',
            '=', 3)->max('price');

        $min_price_commercial = Product::groupBy('category_id')->where('category_id',
            '=', 4)->min('price');

        $max_price_commercial = Product::groupBy('category_id')->where('category_id',
            '=', 4)->max('price');

        $min_area_commercial = Product::groupBy('category_id')->where('category_id', '=',
            4)->min('land_area');

        $max_area_commercial = Product::groupBy('category_id')->where('category_id', '=',
            4)->max('land_area');


        $data = [];
        foreach ($programmes as $item) {
            $data[] = ['id' => $item->id, 'slug' => $item->slug, 'lat' => $item->location ?
                $item->location->latitude : 0, 'lng' => $item->location ? $item->location->longitude :
                0, 'title' => $item->title, 'area' => $item->area, 'type' => 'product', ];
        }


        $xLine = Parameter::where('name', 'x_line')->first();


        return view('programme.index')->with('items', $items)->with('search', $search)->with('q',
            $q)->with('orderBy', $orderBy)->with('order', $order)->with('viewProd', $viewProd)->with('xLine',
            $xLine)->with('page', $page)->with('pubs', $pubs)->with('products', $products)->with('typesRes',
            $typesRes)->with('typesFonc', $typesFonc)->with('typesInd', $typesInd)->with('typesComm',
            $typesComm)->with('locationTypes', $locationTypes)->with('anciennetes', $anciennetes)->with('agricoles',
            $agricoles)->with('industriels', $industriels)->with('commercials', $commercials)->with('states',
            $states)->with('category', $cat)->with('lapls', $lapls)->with('min_price_residentiel',
            $min_price_residentiel)->with('max_price_residentiel', $max_price_residentiel)->with('min_land_area_residentiel',
            $min_land_area_residentiel)->with('max_land_area_residentiel', $max_land_area_residentiel)->with('min_garage_space_residentiel',
            $min_garage_space_residentiel)->with('max_garage_space_residentiel', $max_garage_space_residentiel)->with('min_bathrooms_residentiel',
            $min_bathrooms_residentiel)->with('max_bathrooms_residentiel', $max_bathrooms_residentiel)->with('min_bedrooms_residentiel',
            $min_bedrooms_residentiel)->with('max_bedrooms_residentiel', $max_bedrooms_residentiel)->with('min_number_of_floors_residentiel',
            $min_number_of_floors_residentiel)->with('max_number_of_floors_residentiel', $max_number_of_floors_residentiel)->with('min_price_foncier',
            $min_price_foncier)->with('max_price_foncier', $max_price_foncier)->with('min_land_area_foncier',
            $min_land_area_foncier)->with('max_land_area_foncier', $max_land_area_foncier)->with('min_price_industriel',
            $min_price_industriel)->with('max_price_industriel', $max_price_industriel)->with('min_price_commercial',
            $min_price_commercial)->with('max_price_commercial', $max_price_commercial)->with('min_area_commercial',
            $min_area_commercial)->with('max_area_commercial', $max_area_commercial)->with('categories',
            $categories)->with('show', $show)->with('showBy', $showBy)->with(['data' =>
            json_encode($data)]);
    }


    public function getShowProgramme($slug) {
        $url = url('programme/' . $slug);

        return response()->json(['res' => $url]);
    }

}
