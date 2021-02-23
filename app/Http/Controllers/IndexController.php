<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Product;
use App\Models\Page;
use App\Models\Pub;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Type;
use App\Models\State;
use App\Models\Localisation;
use App\Models\Menu;
use Session;
use View;


class IndexController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show home page
     *
     * @param  Illuminate\Http\Request  $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $types = Type::orderBy('title', 'asc')
            ->where('object_type', 'type')
            ->get();
        
        $locationTypes = Type::orderBy('title', 'asc')
            ->where('object_type', 'location')
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

        return $this->render($request, 1)
        ->with('states',$states)
        ->with('locationTypes',$locationTypes)
        ->with('min_price_residentiel',$min_price_residentiel)
        ->with('max_price_residentiel',$max_price_residentiel)
        ->with('min_land_area_residentiel',$min_land_area_residentiel)
        ->with('max_land_area_residentiel',$max_land_area_residentiel)
        ->with('min_garage_space_residentiel',$min_garage_space_residentiel)
        ->with('max_garage_space_residentiel',$max_garage_space_residentiel)
        ->with('min_bathrooms_residentiel',$min_bathrooms_residentiel)
        ->with('max_bathrooms_residentiel',$max_bathrooms_residentiel)
        ->with('min_bedrooms_residentiel',$min_bedrooms_residentiel)
        ->with('max_bedrooms_residentiel',$max_bedrooms_residentiel)
        ->with('min_number_of_floors_residentiel',$min_number_of_floors_residentiel)
        ->with('max_number_of_floors_residentiel',$max_number_of_floors_residentiel)
        ->with('min_price_foncier',$min_price_foncier)
        ->with('max_price_foncier',$max_price_foncier)
        ->with('min_land_area_foncier',$min_land_area_foncier)
        ->with('max_land_area_foncier',$max_land_area_foncier)
        ->with('types',$types);

    }

    /**
     * Show home page
     *
     * @param  Illuminate\Http\Request  $request
     * @return Illuminate\Http\Response
     */
    public function apl(Request $request)
    {
        $lapls = User::ofRole(4)
            ->isActive()
            ->has('location')
            ->with('location')
            ->get();

        $lapls_footer = Localisation::select('localizations.*')
            ->join('users','users.location_id','=','localizations.id')
            ->where('users.role','=','4')
            ->groupBy('localizations.locality')
            ->get();
        
        $data = [];
        foreach($lapls as $item){
            $html = view('user.map')->with('item', $item)->render();
            $data[] = [
              'id' => $item->id,
              'lat' => $item->location?$item->location->latitude:0,
              'lng' => $item->location?$item->location->longitude:0,
              'title' => $item->name,
              'content' => $item->get_meta('orga_description')?$item->get_meta('orga_description')->value:'',
              'type' => $item->role,
              'html' => $html,
            ];
        }
        
    	return view('index.apl')
            ->with('items', $lapls)
            ->with('lapls', $lapls_footer)
            ->with(['data' => json_encode($data)]);
    }

    /**
     * Show the service's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function services(Request $request)
    {
        return $this->render($request, 3);
    }

    /**
     * Show the service's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function services_v2(Request $request)
    {
        $id_page = 3;
        $page = Page::findOrFail($id_page);
        $blogs = Blog::ofStatus('published')
            ->orderBy('created_at', 'desc')
            ->take(6)->get();
        
        $page->load(['childs', 'childs.pubs', 'pubs']);
        
        $products = Product::orderBy('created_at','desc')
            ->ofStatus('published')
            ->take($this->recentSize)
            ->get();
        
        $categories = Category::orderBy('created_at', 'desc')
            ->has('products')
            ->withCount('products')
            ->take($this->recentSize)
            ->get();
        
        $page->load(['childs', 'childs.pubs', 'pubs']);

        $lapls = Localisation::select('localizations.*')
                ->join('users','users.location_id','=','localizations.id')
                ->where('users.role','=','4')
                ->groupBy('localizations.locality')
                ->get();
        
        if($page){$pubs = $page->pubs;}else{$pubs = [];}

        return view('index.service')
            ->with('item', $page)
            ->with('pubs', $page->pubs)
            ->with('products', $products)
            ->with('lapls', $lapls)
            ->with('categories', $categories);
    }


    /**
     * Show the publicity's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function publicities(Request $request)
    {
        return $this->render($request, 5);
    }

    /**
     * Show the publicity's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function publicities_v2(Request $request)
    {
        $id_page = 5;
        $page = Page::findOrFail($id_page);
        $blogs = Blog::ofStatus('published')
            ->orderBy('created_at', 'desc')
            ->take(6)->get();
        
        $page->load(['childs', 'childs.pubs', 'pubs']);
        
        $products = Product::orderBy('created_at','desc')
            ->ofStatus('published')
            ->take($this->recentSize)
            ->get();
        
        $categories = Category::orderBy('created_at', 'desc')
            ->has('products')
            ->withCount('products')
            ->take($this->recentSize)
            ->get();
        
        $page->load(['childs', 'childs.pubs', 'pubs']);

        $lapls = Localisation::select('localizations.*')
                ->join('users','users.location_id','=','localizations.id')
                ->where('users.role','=','4')
                ->groupBy('localizations.locality')
                ->get();
        
        if($page){$pubs = $page->pubs;}else{$pubs = [];}

        return view('index.publicite')
            ->with('item', $page)
            ->with('pubs', $page->pubs)
            ->with('products', $products)
            ->with('lapls', $lapls)
            ->with('categories', $categories);
    }

    /**
     * Show the term and condition page.
     *
     * @return \Illuminate\Http\Response
     */
    public function terms(Request $request)
    {                

        return $this->render($request, 6);

    }

    /**
     * Show the term and condition page.
     *
     * @return \Illuminate\Http\Response
     */
    public function terms_v2(Request $request)
    {      
        $id_page = 6;
        $page = Page::findOrFail($id_page);
        $blogs = Blog::ofStatus('published')
            ->orderBy('created_at', 'desc')
            ->take(6)->get();
        
        $page->load(['childs', 'childs.pubs', 'pubs']);
        
        $products = Product::orderBy('created_at','desc')
            ->ofStatus('published')
            ->take($this->recentSize)
            ->get();
        
        $categories = Category::orderBy('created_at', 'desc')
            ->has('products')
            ->withCount('products')
            ->take($this->recentSize)
            ->get();
        
        $page->load(['childs', 'childs.pubs', 'pubs']);

        $lapls = Localisation::select('localizations.*')
                ->join('users','users.location_id','=','localizations.id')
                ->where('users.role','=','4')
                ->groupBy('localizations.locality')
                ->get();
        
        if($page){$pubs = $page->pubs;}else{$pubs = [];}

        return view('index.term')
            ->with('item', $page)
            ->with('pubs', $page->pubs)
            ->with('products', $products)
            ->with('lapls', $lapls)
            ->with('categories', $categories);
    }

    /**
     * Show the guide's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function help(Request $request)
    {
        return $this->render($request, 8);
    }

    /**
     * Show the guide's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function help_v2(Request $request)
    {
        $id_page = 8;
        $page = Page::findOrFail($id_page);
        $blogs = Blog::ofStatus('published')
            ->orderBy('created_at', 'desc')
            ->take(6)->get();
        
        $page->load(['childs', 'childs.pubs', 'pubs']);
        
        $products = Product::orderBy('created_at','desc')
            ->ofStatus('published')
            ->take($this->recentSize)
            ->get();
        
        $categories = Category::orderBy('created_at', 'desc')
            ->has('products')
            ->withCount('products')
            ->take($this->recentSize)
            ->get();
        
        $page->load(['childs', 'childs.pubs', 'pubs']);

        $lapls = Localisation::select('localizations.*')
                ->join('users','users.location_id','=','localizations.id')
                ->where('users.role','=','4')
                ->groupBy('localizations.locality')
                ->get();
        
        if($page){$pubs = $page->pubs;}else{$pubs = [];}

        return view('index.help')
            ->with('item', $page)
            ->with('pubs', $page->pubs)
            ->with('products', $products)
            ->with('lapls', $lapls)
            ->with('categories', $categories);
    }

    /**
     * Show the confidentiality's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function confidentialities(Request $request)
    {
        return $this->render($request, 7);
    }

    /**
     * Show the confidentiality's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function confidentialities_v2(Request $request)
    {
        $id_page = 7;
        $page = Page::findOrFail($id_page);
        $blogs = Blog::ofStatus('published')
            ->orderBy('created_at', 'desc')
            ->take(6)->get();
        
        $page->load(['childs', 'childs.pubs', 'pubs']);
        
        $products = Product::orderBy('created_at','desc')
            ->ofStatus('published')
            ->take($this->recentSize)
            ->get();
        
        $categories = Category::orderBy('created_at', 'desc')
            ->has('products')
            ->withCount('products')
            ->take($this->recentSize)
            ->get();
        
        $page->load(['childs', 'childs.pubs', 'pubs']);

        $lapls = Localisation::select('localizations.*')
                ->join('users','users.location_id','=','localizations.id')
                ->where('users.role','=','4')
                ->groupBy('localizations.locality')
                ->get();
        
        if($page){$pubs = $page->pubs;}else{$pubs = [];}

        return view('index.confidentialite')
            ->with('item', $page)
            ->with('pubs', $page->pubs)
            ->with('products', $products)
            ->with('lapls', $lapls)
            ->with('categories', $categories);
    }

    /**
     * Render page 
     *
     * @param Integer $id
     * @return \Illuminate\Http\Response
     */
    private function render(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $ctrl = new PageController();
        return $ctrl->index($request, $page);
    }

    public function homestepmodal(Request $request,$val)
    {
        return View::make("includes.homestepmodal")
        ->with("val", $val)
        ->render();
    }

    public function editlangue()
    {
        // Read File
        $app = file_get_contents(base_path('resources/lang/en/app.php'));

        $txt = "salut les : gars";

        $data0 = str_replace("<?php", "", $app);
        $data1 = str_replace("return [", "", $data0);
        $data2 = str_replace("];", "", $data1);
        $data3 = str_replace(" ", "", $data2);
        $txt_split = explode("',",$data3);

        var_dump($txt_split);
        

        // return view('editlangue', compact('json'));
    }

    public function login()
    {
        $lapls = Localisation::select('localizations.*')
                ->join('users','users.location_id','=','localizations.id')
                ->where('users.role','=','4')
                ->groupBy('localizations.locality')
                ->get();

        return view('auth.login')
            ->with('lapls',$lapls);
    }
    
    public function getApl($apl)
    {
        $lapls = Localisation::select('users.*')
                ->join('users','users.location_id','=','localizations.id')
                ->where('localizations.locality', '=', $apl)
                ->where('users.role','=','4')
                ->get();

        return response()->json(['res'=>$lapls]);
    }

    public static function getListApls()
    {
        return $lapls = Localisation::select('localizations.*')
                ->join('users','users.location_id','=','localizations.id')
                ->where('users.role','=','4')
                ->groupBy('localizations.locality')
                ->get();
    }
}
