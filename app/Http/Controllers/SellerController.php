<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Localisation;
use App\Models\Solicitor;

class SellerController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:2');
        $this->middleware('user', ['only' => ['active','temp']]);
    }

    /**
     * List of products
     *
     * @return \Illuminate\Http\Response
     */
    public function products() {
        $items = Auth::user()->products()->paginate($this->pageSize);

        return view('backend.product.all')->with('title', __('seller.products'))->with('items',
            $items);
    }

    /**
     * List of ordered products
     *
     * @return \Illuminate\Http\Response
     */
    public function orders() {
        $items = Auth::user()->products()->where('products.status', 'ordered')->paginate($this->pageSize);

        return view('backend.product.all')->with('title', __('seller.orders'))->with('items',
            $items);
    }

    /**
     * List of sale products
     *
     * @return \Illuminate\Http\Response
     */
    public function sales() {
        $items = Auth::user()->products()->where('products.status', 'paid')->paginate($this->pageSize);

        return view('backend.product.all')->with('title', __('seller.sales'))->with('items',
            $items);
    }

    public function solicitor() {
        $solicitors = Solicitor::where('vendeur_id', Auth::user()->id)->get();
        return view('backend.solicitor.all')->with('title', __('seller.solicitor'))->with('solicitors',
            $solicitors);
    }

    public function ajaxGetSolicitorById(Request $request) {
        $solicitors = Solicitor::find($request->id);
        return response()->json(['solicitor' => $solicitors]);
    }

    public function ajaxSaveProduct(Request $request) {
        $solicitor = new Solicitor();
        $solicitor->cabinet_name = $request->cabinet_name;
        $solicitor->cabinet_cp = $request->cabinet_cp;
        $solicitor->cabinet_email = $request->cabinet_email;
        $solicitor->cabinet_phone = $request->cabinet_phone;
        $solicitor->vendeur_id = Auth::user()->id;
        $solicitor->save();
        return response()->json(['success' => 'true']);
    }

    public function ajaxModifSolicitor(Request $request) {
        Solicitor::where('id', $request->id)->update(['cabinet_name' => $request->cabinet_name,
            'cabinet_cp' => $request->cabinet_cp, 'cabinet_email' => $request->cabinet_email,
            'cabinet_phone' => $request->cabinet_phone]);
        return response()->json(['success' => 'true']);
    }
    
    public function ajaxDropSolicitor(Request $request)
    {
        Solicitor::where('id', $request->id)->delete();
        return response()->json(['success' => 'true']);
    }

}
