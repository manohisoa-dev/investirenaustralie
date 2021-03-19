<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Product;
use App\Models\Search;
use App\Models\Localisation;
use App\Models\State;
use App\Models\Type;
use App\Models\Page;
class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
    /**
     * Perform global search.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Category $category = null)
    {
        $items = Product::ofStatus('published');
        
        $search = new Search();

        $lapls = Localisation::select('localizations.*')
            ->join('users','users.location_id','=','localizations.id')
            ->where('users.role','=','4')
            ->groupBy('localizations.locality')
            ->get();

        if($request->state){
            $items = $items->where('state_id', $request->state);
        }
        
        if($request->type){
            $items = $items->where('type_id', $request->type);
        }
        
        if($request->location_type){
            $items = $items->where('location_type_id', $request->location_type);
        }
        
        if($request->price){
            switch($request->price){
                case 1:
                    $sign = '<';
                    $price = 100000;
                    break;
                case 2:
                    $sign = '<';
                    $price = 200000;
                    break;
                case 3:
                    $sign = '<';
                    $price = 300000;
                    break;
                case 4:
                    $sign = '>';
                    $price = 100000;
                    break;
                case 5:
                    $sign = '>';
                    $price = 200000;
                    break;
                case 6:
                    $sign = '>';
                    $price = 300000;
                    break;
                default:
                    $sign = '>';
                    $price = 0;
                    break;
            }
            $items = $items->where('price', $sign, $price);
        }
        
        if($request->area){
            switch($request->area){
                case 1:
                    $sign = '<';
                    $area = 100;
                    break;
                case 2:
                    $sign = '<';
                    $area = 250;
                    break;
                case 3:
                    $sign = '<';
                    $area = 500;
                    break;
                case 4:
                    $sign = '>';
                    $area = 100;
                    break;
                case 5:
                    $sign = '>';
                    $area = 250;
                    break;
                case 6:
                    $sign = '>';
                    $area = 500;
                    break;
                default:
                    $sign = '>';
                    $area = 0;
                    break;
            }
            $items = $items->where('area', $sign, $area);
        }
        
        if($request->q){
            $items = $items->where('title', 'LIKE', '%'.$request->q.'%');
            $search->keyword = $request->q;
        }
        $items = $items->paginate(20);
        
        $search->content = serialize($request->all());
        $search->save();
        
    	return view('search.index')
            ->with('lapls', $lapls)
            ->with('items', $items);
    }
    
    public function edit(Request $request){
        $this->middleware('auth');
        
        $id = $request->search;
        $search = Search::find($id);
        if(!$search){
            return response()->json([
                'state'=>0,
                'code' => 'invalid_param',
                'message' => 'Object not found'
            ]);
        }
        
        if($search->author && ($search->author->id != \Auth::user()->id)){
            return response()->json([
                'state'=>0,
                'code' => 'unauthorized',
                'message' => 'Vous n\'etes pas autorise a modifier cette recherche.'
            ]);
        }
        
        $title = $request->title;
        if(empty($title)){
            return response()->json([
                'state'=>0,
                'code' => 'invalid_param',
                'message' => 'Le titre ne peut pas etre vide.'
            ]);
        }
        
        if(!$search->author){
            $search->author_id = \Auth::user()->id;
        }
        $search->title = $title;
        $search->save();
        
        return response()->json([
                'state'=>1,
                'code' => 'success',
                'message' => 'Modification avec succes.'
        ]);
    }
    
    public function delete(Request $request){
        $this->middleware('auth');
        
        $id = $request->search;
        $search = Search::find($id);
        if(!$search){
            return response()->json([
                'state'=>0,
                'code' => 'invalid_param',
                'message' => 'Object not found'
            ]);
        }
        
        if(!$search->author || ($search->author->id != \Auth::user()->id)){
            return response()->json([
                'state'=>0,
                'code' => 'unauthorized',
                'message' => 'Vous n\'etes pas autorise a modifier cette recherche.'
            ]);
        }
        
        $search->delete();
        
        return response()->json([
                'state'=>1,
                'code' => 'success',
                'message' => 'Suppression avec succes.'
        ]);
    }

    /**
     * Perform global search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search_old(Request $request)
    {
        $search = new Search();

        $lapls = Localisation::select('localizations.*')
            ->join('users','users.location_id','=','localizations.id')
            ->where('users.role','=','4')
            ->groupBy('localizations.locality')
            ->get();

        $city = $request->city;
        $state_id = $request->state?((State::where('content','=',$request->state))->get())[0]->id:'';
        $suburb = $request->suburb;
        
        $items = Product::ofStatus('published');

        $items = $items->join('localizations','localizations.id','=','products.location_id')
                ->where('products.state_id','!=',0);

        if($state_id){
            $items = $items->where('state_id','=',$state_id);
        }

        if($city){
            $items = $items->where('localizations.locality','=',$city);
        }

        if($suburb){
            $items = $items->where('localizations.area_level_2','=',$suburb);
        }
            
        
        

        // if($request->state){
        //     $items = $items->where('state_id', $request->state);
        // }
        
        // if($request->type){
        //     $items = $items->where('type_id', $request->type);
        // }
        
        // if($request->location_type){
        //     $items = $items->where('location_type_id', $request->location_type);
        // }
        
        // if($request->price){
        //     switch($request->price){
        //         case 1:
        //             $sign = '<';
        //             $price = 100000;
        //             break;
        //         case 2:
        //             $sign = '<';
        //             $price = 200000;
        //             break;
        //         case 3:
        //             $sign = '<';
        //             $price = 300000;
        //             break;
        //         case 4:
        //             $sign = '>';
        //             $price = 100000;
        //             break;
        //         case 5:
        //             $sign = '>';
        //             $price = 200000;
        //             break;
        //         case 6:
        //             $sign = '>';
        //             $price = 300000;
        //             break;
        //         default:
        //             $sign = '>';
        //             $price = 0;
        //             break;
        //     }
        //     $items = $items->where('price', $sign, $price);
        // }
        
        // if($request->area){
        //     switch($request->area){
        //         case 1:
        //             $sign = '<';
        //             $area = 100;
        //             break;
        //         case 2:
        //             $sign = '<';
        //             $area = 250;
        //             break;
        //         case 3:
        //             $sign = '<';
        //             $area = 500;
        //             break;
        //         case 4:
        //             $sign = '>';
        //             $area = 100;
        //             break;
        //         case 5:
        //             $sign = '>';
        //             $area = 250;
        //             break;
        //         case 6:
        //             $sign = '>';
        //             $area = 500;
        //             break;
        //         default:
        //             $sign = '>';
        //             $area = 0;
        //             break;
        //     }
        //     $items = $items->where('area', $sign, $area);
        // }
        
        // if($request->q){
        //     $items = $items->where('title', 'LIKE', '%'.$request->q.'%');
        //     $search->keyword = $request->q;
        // }
        $items = $items->paginate(20);
        
        $search->content = serialize($request->all());
        $search->save();
        
    	return view('search.index')
            ->with('lapls', $lapls)
            ->with('items', $items);
    }

    /**
     * Perform global search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = new Search();

        $lapls = Localisation::select('localizations.*')
            ->join('users','users.location_id','=','localizations.id')
            ->where('users.role','=','4')
            ->groupBy('localizations.locality')
            ->get();
        
        $page2 = Page::where('path', '=', '/products*')->first();
        if($page2){$pubs = $page2->pubs;}else{$pubs=[];}

        $products = Product::orderBy('created_at','desc')
            ->ofStatus('published')
            ->take($this->recentSize)
            ->get();
        
        $categories = Category::orderBy('created_at', 'desc')
            ->has('products')
            ->withCount('products')
            ->take($this->recentSize)
            ->get();

        $city = $request->city;
        $state_id = $request->state?((State::where('content','=',$request->state))->get())[0]->id:'';
        $suburb = $request->suburb;
        $prod = $request->prod;
        
        $items = Product::ofStatus('published');

        $items = $items->join('localizations','localizations.id','=','products.location_id')
                ->where('products.state_id','!=',0);

        if($state_id){
            $items = $items->where('state_id','=',$state_id);
        }

        if($city){
            $items = $items->where('localizations.locality','=',$city);
        }

        if($suburb){
            $items = $items->where('localizations.area_level_2','=',$suburb);
        }

        if($prod){
            switch ($prod) {
                case 'residentiel':
                    $items = $items->where('category_id', 1);

                    if($request->typeRes){
                        $items = $items->where('type_id', $request->typeRes);
                    }

                    if($request->anciennete){
                        $items = $items->where('type_id', $request->typeRes);
                    }

                    if($request->localisation){
                        $items = $items->where('location_type_id', $request->location_type);
                    }

                    if($request->residentiel_price_min && $request->residentiel_price_max){
                        $items = $items->whereBetween('price', [$request->residentiel_price_min, $request->residentiel_price_max]);
                    }

                    if($request->residentiel_bedrooms_min && $request->residentiel_bedrooms_max){
                        $items = $items->whereBetween('bedrooms', [$request->residentiel_bedrooms_min, $request->residentiel_bedrooms_max]);
                    }

                    break;
                
                case 'foncier':
                    $items = $items->where('category_id', 2);

                    if($request->typeFonc){
                        $items = $items->where('type_id', $request->typeFonc);
                    }

                    if($request->localisationFonc){
                        $items = $items->where('location_type_id', $request->localisationFonc);
                    }

                    if($request->agricoleFonc){
                        $items = $items->where('type_id', $request->agricoleFonc);
                    }

                    if($request->foncier_area_min && $request->foncier_area_max){
                        $items = $items->whereBetween('land_area', [$request->foncier_area_min, $request->foncier_area_max]);
                    }

                    if($request->foncier_price_min && $request->foncier_price_max){
                        $items = $items->whereBetween('price', [$request->foncier_price_min, $request->foncier_price_max]);
                    }

                    break;
                
                case 'industriel':
                    $items = $items->where('category_id', 3);

                    if($request->typeInd){
                        $items = $items->where('type_id', $request->typeInd);
                    }

                    if($request->typeSectInd){
                        $items = $items->where('type_id', $request->typeSectInd);
                    }

                    if($request->industriel_price_min && $request->industriel_price_max){
                        $items = $items->whereBetween('price', [$request->industriel_price_min, $request->industriel_price_max]);
                    }

                    break;

                case 'commercial':
                    $items = $items->where('category_id', 4);

                    if($request->typeComm){
                        $items = $items->where('type_id', $request->typeComm);
                    }

                    if($request->typeSectComm){
                        $items = $items->where('type_id', $request->typeSectComm);
                    }

                    if($request->parkingComm){
                        $items = $items->where('carport_spaces', $request->parkingComm);
                    }

                    if($request->commercial_price_min && $request->commercial_price_max){
                        $items = $items->whereBetween('price', [$request->commercial_price_min, $request->commercial_price_max]);
                    }

                    if($request->commercial_area_min && $request->commercial_area_max){
                        $items = $items->whereBetween('land_area', [$request->commercial_area_min, $request->commercial_area_max]);
                    }

                    break;
                
                default:
                    # code...
                    break;
            }
        }
    
        // if($request->q){
        //     $items = $items->where('title', 'LIKE', '%'.$request->q.'%');
        //     $search->keyword = $request->q;
        // }
            
        $items = $items->paginate(20);
        
        $search->content = serialize($request->all());
        $search->save();

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

        return view('search.index')
        ->with('states',$states)
        ->with('locationTypes',$locationTypes)
        ->with('anciennetes',$anciennetes)
        ->with('agricoles',$agricoles)
        ->with('industriels',$industriels)
        ->with('commercials',$commercials)
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
        ->with('min_price_industriel',$min_price_industriel)
        ->with('max_price_industriel',$max_price_industriel)
        ->with('min_price_commercial',$min_price_commercial)
        ->with('max_price_commercial',$max_price_commercial)
        ->with('min_area_commercial',$min_area_commercial)
        ->with('max_area_commercial',$max_area_commercial)
        ->with('typesRes',$typesRes)
        ->with('typesFonc',$typesFonc)
        ->with('typesInd',$typesInd)
        ->with('typesComm',$typesComm)
        ->with('lapls', $lapls)
        ->with('pubs', $pubs)
        ->with('products', $products)
        ->with('categories', $categories)
        ->with('items', $items);
            
    }
}