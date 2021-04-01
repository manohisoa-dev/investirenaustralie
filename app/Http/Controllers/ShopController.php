<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;

use App\Models\Product;
use App\Models\Sale;
use App\Models\Category;
use App\Models\Page;
use App\Models\Pub;
use App\Models\User;
use App\Models\Type;
use App\Models\State;
use App\Models\Search;
use App\Models\Localisation;

class ShopController extends Controller
{
    
    /**
     * Show the list of product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String $category
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Category $category = null)
    {
        $page = $request->get('page');
        if(empty($page)) $page = 1;
        
        $orderBy = $request->get('orderBy');
        if(!in_array($orderBy, ['price', 'created_at', 'view_count'])) $orderBy = 'price';
        
        $order = $request->get('order');
        if(!in_array($order, ['desc', 'asc'])) $order = 'desc';
        
        $items = Product::ofStatus('published')
                ->where('quantity', '>', 0);
        
        if($category&&$category->id>0){
            $items = $items->where("category_id", $category->id);
        }
        
        $search = new Search();
        $q = $request->q;
        if($q){
            $items = $items->where(function($query) use ($q){
                return $query->where('content', 'LIKE', '%'.$q.'%')
                    ->orWhere('title', 'LIKE', '%'.$q.'%');
            });
            $search->keyword = $q;
            $search->save();
        }
        
        $items = $items->orderBy($orderBy, $order);

        $items = $items->paginate($this->pageSize);
        
        if($request->ajax()){
            return response()->json(array(
                'html' => view('ajax.product.all', compact('items'))->render()
            ));
        }
        
        $products = Product::orderBy('created_at','desc')
            ->ofStatus('published')
            ->get();
        
        $categories = Category::orderBy('created_at', 'desc')
            ->has('products')
            ->withCount('products')
            ->take($this->recentSize)
            ->get();
        
        $page2 = Page::where('path', '=', '/products*')->first();
        if($page2){$pubs = $page2->pubs;}else{$pubs=[];}

        
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

        $lapls = Localisation::select('localizations.*')
            ->join('users','users.location_id','=','localizations.id')
            ->where('users.role','=','4')
            ->groupBy('localizations.locality')
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
        
        $lapls = User::ofRole(4)
            ->isActive()
            ->has('location')
            ->with('location')
            ->get();

        $data = [];
        foreach($products as $item){
            $data[] = [
                'id' => $item->id,
                'slug' => $item->slug,
                'lat' => $item->location?$item->location->latitude:0,
                'lng' => $item->location?$item->location->longitude:0,
                'title' => $item->title,
                'area' => $item->area,
                'type' => 'product',
            ];
        }

        

        return view('shop.index')
            ->with('items', $items)
            ->with('search', $search)
            ->with('q', $q)
            ->with('orderBy', $orderBy)
            ->with('order', $order)
            ->with('page', $page)
            ->with('pubs', $pubs)
            ->with('products', $products)
            ->with('typesRes',$typesRes)
            ->with('typesFonc',$typesFonc)
            ->with('typesInd',$typesInd)
            ->with('typesComm',$typesComm)
            ->with('locationTypes', $locationTypes)
            ->with('anciennetes', $anciennetes)
            ->with('agricoles', $agricoles)
            ->with('industriels',$industriels)
            ->with('commercials',$commercials)
            ->with('states', $states)
            ->with('category', $category)
            ->with('lapls', $lapls)
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
            ->with('categories', $categories)
            ->with(['data' => json_encode($data)]);
    }
    
    /**
     * Select Apl for an product
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product
     * @return \Illuminate\Http\Response
     */
    public function selectApl(Request $request, Product $product){
        $this->middleware('auth');
        $this->middleware('role:member');
        
        $distance = $request->get('distance');
        if(empty($distance)) $distance = 100;
        
        $data = [];
        if($product && $product->id>0){
            if(!$product->isDisponible()){
               return redirect()->route('product.index', $product)
                   ->with('error','Stock en rupture');
            }

            if(!$product->location){
               return redirect()->route('product.index', $product)
                    ->with('error','Le systeme ne peut pas localiser le produit');
            }
            
            $data[] = [
              'id' => $product->id,
              'lat' => $product->location?$product->location->latitude:0,
              'lng' => $product->location?$product->location->longitude:0,
              'title' => $product->title,
              'type' => 'product',
            ];
        }else{
            
        }
        
        $apls = User::ofRole('apl')
            ->isActive()
            ->has('location')
            ->with('location')
            ->get();
        
        $userApl = Auth::user()->apl;
        
        $selected = null;
        
        foreach($apls as $item){
            $dataTemp = [
              'id' => $item->id,
              'lat' => $item->location?$item->location->latitude:0,
              'lng' => $item->location?$item->location->longitude:0,
              'title' => $item->name,
              'content' => $item->get_meta('orga_description')?$item->get_meta('orga_description')->value:'',
              'type' => $item->role,
            ];
            
            $data[] = $dataTemp;
            
            if($userApl && ($item->id == $userApl->id)){
                $selected = $dataTemp;
            }
        }
        
        
        $action = route('shop.order', $product);
    	return view('backend.apl.select')
            ->with('action', $action)
            ->with('location', Auth::user()->location)
            ->with('items', $apls)
            ->with('item', $product)
            ->with('distance', $distance)
            ->with('distances', $this->distances)
            ->with('selected', json_encode($selected))
            ->with('data', json_encode($data));
    }
    
    /**
     * Order product
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product
     * @return \Illuminate\Http\Response
     */
    public function order(Request $request, Product $product){
        $this->middleware('auth');
        $this->middleware('role:member');
        
        if(!$product->isDisponible()){
    	   return redirect()
               ->route('product.index', $product)
               ->withInput()->with('error','Stock en rupture');
        }
        
        $apl = null;
        if($request->has('apl')){
            $apl = User::ofRole('apl')
                ->isActive()
                ->where('id', '=', $request->apl)
                ->first();
        }
        
        // No APL selected
        if(!$apl && !Auth::user()->apl){
    	   return redirect()
               ->route('shop.select.apl', $product)
               ->withInput()
               ->with('error','Vous devez choisir un apl.');
        }
        
        // Update APL
        if($apl){
            Auth::user()->apl_id = $apl->id;
            Auth::user()->save();
        }
        
        // Get Default APL if no APL chosen
        if(!$apl || $apl->id==0){
            $apl = Auth::user()->apl;
        }
        
        // Get AFA
        if($product->location){
            $afas = User::ofRole('afa')->isActive()
                ->hasLocation()->get();
            
            $dists = [];
            $value = 10000000000;
            foreach($afas as $item){
                if($item->location){
                    $dist = $product->location->getDistance($item->location);
                    if($dist<=$value){
                        $value = $dist;
                        $afa = $item;
                    }
                }
            }
        }
        
        if(!isset($afa) || $afa->id==0){
    	   return redirect()->route('product.index', $product)
               ->withInput()
               ->with('error','Vous ne pouvez pas encore faire cet achat. Il n\'y a pas d\'agence dans la base');
        }
        
        try{
            $sale = Sale::add($product, $apl, $afa);
        }catch(\Exception $e){
            //return redirect()->route('product.index', $product)
              //  ->with('error', $e->getMessage());
        }

    	Session::put('sale', $sale);
    	Session::save();

    	return redirect()
            ->route('shop.checkout')
            ->with('success', 'Produit en cours d\'achat. Veuillez effectuer le paiement.');
    }

    public function getCheckout(){
        $this->middleware('auth');
        $this->middleware('role:member');
        
        $sale = Session::has('sale') ? Session::get('sale') : null;
        if (!$sale) {
            return redirect()->route('profile')
                ->with('error', 'Votre carte est encore vide.');
        }
        
        return view('shop.checkout')->with(['item' => $sale]);
    }

    public function postCheckout(Request $request){
        $this->middleware('auth');
        $this->middleware('role:member');
        
        $this->validate($request, [
            'action' => 'required',
        ]);
        
        $action = $request->action;
        if($action == 'update_session'){
            $sale = Sale::findOrFail($request->sale);
            Session::put('sale', $sale);
            return redirect()
                ->route('shop.checkout')
                ->with('success', 'Votre commande a ete reprise. Veuillez effectuer le paiement.');
        }
        
        $this->validate($request, [
            'stripe_token' => 'required',
        ]);
        
        $sale = Session::has('sale') ? Session::get('sale') : null;
        if (!$sale) {
            return redirect()->route('profile')
                ->with('error', 'Votre carte est encore vide.');
        }

        $user = Auth::user();
                
        $total    = $sale->price;
        $currency = $sale->currency;
        
        // Get the submitted Stripe token
        $token = $request->stripe_token;

        // If empty stripe_id then create new customer
        if (empty($user->strip_id)) {
            // Create a new Stripe customer
            try {
                $customer = \Stripe\Customer::create([
                'source' => $token,
                'email' => $user->email,
                'metadata' => [
                    "First Name" => $user->name,
                    "Last Name" => $user->name
                ]
                ]);
            } catch (\Stripe\Error\Card $e) {
                return redirect()->to($action)
                    ->withErrors($e->getMessage())
                    ->withInput();
            }

            // Update user in the database with Stripe
            $user->stripe_id = $customer->id;
            $user->save();

        }

        try{
            // Create the charge
            $result = \Stripe\Charge::create(array(
                "amount" => $total,
                "currency" => "eur",
                "customer" => $user->stripe_id,
                "description" => 'Purchase'
            ));
            
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
        
        if ($result->status != 'succeeded') {
          return back()->with('error', "Votre commande n'a pas été éffectué. ".$result->message);
        }
    
        // Set as order and notify user
        $sale->setAsOrdered();

        Session::forget('sale');
        
        //do some other stuffs
        return redirect()->route('home');
    }


    /**
     * Show last order
     *
     * @return \Illuminate\Http\Response
     */
    public function lastOrder(){
        $this->middleware('auth');
        $this->middleware('role:member');
        $count = Sale::where('author_id', \AUth::user()->id)
            ->where('status', 'pinged')
            ->count();
        $sale = Session::has('sale') ? Session::get('sale') : null;
        $lapls = Localisation::select('localizations.*')
            ->join('users','users.location_id','=','localizations.id')
            ->where('users.role','=','4')
            ->groupBy('localizations.locality')
            ->get();
        return view('shop.order')->with(['item' => $sale])
            ->with('lapls', $lapls)
            ->with('count', $count);
    }
    
    /*
    * Cancelling order
    */
    public function cancel(Request $request){
        $this->middleware('auth');
        $this->middleware('role:member');
        
        $action = $request->input('action');
        switch($action){
            case 'item':
                $sale = Sale::findOrFail($request->sale);
                $sale->delete();
                
                $session = Session::has('sale') ? Session::get('sale') : null;
                if ($session && $session->id == $sale->id ) {
                    Session::forget('sale');
                }
                break;
            case 'session':
                $sale = Session::has('sale') ? Session::get('sale') : null;
                if (!$sale) {
                    return redirect()->route('profile')
                        ->with('error', 'Votre carte est encore vide.');
                }
                $sale->delete();
                Session::forget('sale');
                break;
            case 'all':
                Sale::where('author_id', \Auth::user()->id)
                    ->where('status', 'pinged')
                    ->delete();
                break;
            default:
                abort(404);
                break;
        }
        
        return redirect()->route('shop.order.last')->with('success', "Votre commande a bien été annulée.");
    }
}
