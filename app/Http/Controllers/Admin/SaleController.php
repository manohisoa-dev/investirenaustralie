<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Models\Image;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class SaleController extends Controller {
    public $viewDir = "admin.sale";

    public function index() {
        $records = Sale::findRequested();
        return $this->view("index", ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create() {
        return $this->view("create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, Sale::validationRules());

        Sale::create($request->all());

        # notification
        Notify::success('Sale a été créer avec succès');
        return redirect(route('admin.sale.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Sale $sale) {
        $this->middleware('auth');
        switch (\Auth::user()->role) {
            case 3:
                if (!$sale->afa || $sale->afa->id != \Auth::user()->id) {
                    abort(404);
                } else {
                    $view = view('backend.cartitem.index');
                }
                break;
            case 4:
                if (!$sale->apl || $sale->apl->id != \Auth::user()->id) {
                    abort(404);
                } else {
                    $view = view('backend.cartitem.index');
                }
                break;
            case 5:
                if (!$sale->author || $sale->author->id != \Auth::user()->id) {
                    abort(404);
                } else {
                    $view = view('backend.cartitem.index');
                }
                break;
            case 1:
                $view = 'show';
                break;
            default:
                abort(404);
                break;
        }
        
        $title = __('app.cartitem.index');

        /*return $view->with('title', $title)->with('item', $sale)->with('breadcrumbs',
            $title);*/
        return $this->view($view,['sale' => $sale]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Sale $sale) {
        return $this->view("edit", ['sale' => $sale]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale) {
        if ($request->isXmlHttpRequest()) {
            $data = [$request->name => $request->value];
            $validator = \Validator::make($data, Sale::validationRules($request->name));
            if ($validator->fails())
                return response($validator->errors()->first($request->name), 403);
            $sale->update($data);
            return "Record updated";
        }

        $this->validate($request, Sale::validationRules());

        $sale->update($request->all());

        # notification
        Notify::success('Sale a été mise à jour avec succès');
        return redirect(route('admin.sale.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Sale $sale) {
        $this->middleware('auth');
        $this->middleware('role:1');
        $sale->delete();

        # notification
        Notify::success('Vente a été supprimer avec succès');
        return redirect(route('admin.sale.index'));
    }

    protected function view($view, $data = []) {
        return view($this->viewDir . "." . $view, $data);
    }

    /**
     * Pay user by role
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale $sale
     * @param  Mixed $role
     * @return \Illuminate\Http\Response
     */
    public function pay(Request $request, Sale $sale, $role) {
        $this->middleware('auth');
        $this->middleware('role:1');

        if (($sale->status != 'ordered') || !$sale->product || !$sale->apl || !$sale->afa) {
            abort(404);
        }

        switch ($role) {
            case 'apl':
                if (!empty($sale->apl_paid_at)) {
                    abort(404);
                }
                $user = $sale->apl;
                break;
            case 'afa':
                if (!empty($sale->afa_paid_at)) {
                    abort(404);
                }
                $user = $sale->afa;
                break;
            default:
                abort(404);
                break;
        }

        $action = route('admin.sale.pay', ['sale' => $sale, 'role' => $role]);
        $title = __('app.shop.pay.' . $role);
        return view('admin.sale.pay')->with('title', $title)->with('role', $role)->with('action',
            $action)->with('item', $sale)->with('user', $user)->with('breadcrumbs', $title);
    }

}
