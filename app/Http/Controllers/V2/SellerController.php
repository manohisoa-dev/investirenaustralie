<?php

namespace App\Http\Controllers\V2;

use Illuminate\Http\Request;
use Auth;
use App\Models\Localisation;

class SellerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:2');
    }
    
    /**
     * List of products
     *
     * @return \Illuminate\Http\Response
     */
    public function products()
    {
        $items = Auth::user()->products()
            ->paginate($this->pageSize);

        $lapls = Localisation::select('localizations.*')
            ->join('users','users.location_id','=','localizations.id')
            ->where('users.role','=','4')
            ->groupBy('localizations.locality')
            ->get();
        
        return view('V2.backend.product.all')
            ->with('title', __('seller.products'))
            ->with('lapls', $lapls)
            ->with('items', $items);
    }
    
    /**
     * List of ordered products
     *
     * @return \Illuminate\Http\Response
     */
    public function orders()
    {
        $items = Auth::user()->products()
            ->where('products.status', 'ordered')
            ->paginate($this->pageSize);

        $lapls = Localisation::select('localizations.*')
            ->join('users','users.location_id','=','localizations.id')
            ->where('users.role','=','4')
            ->groupBy('localizations.locality')
            ->get();
        
        return view('V2.backend.product.all')
            ->with('title', __('seller.orders'))
            ->with('lapls', $lapls)
            ->with('items', $items);
    }
    
    /**
     * List of sale products
     *
     * @return \Illuminate\Http\Response
     */
    public function sales()
    {
        $items = Auth::user()->products()
            ->where('products.status', 'paid')
            ->paginate($this->pageSize);
        $lapls = Localisation::select('localizations.*')
            ->join('users','users.location_id','=','localizations.id')
            ->where('users.role','=','4')
            ->groupBy('localizations.locality')
            ->get();
        
        return view('V2.backend.product.all')
            ->with('title', __('seller.sales'))
            ->with('lapls', $lapls)
            ->with('items', $items);
    }
    
}
