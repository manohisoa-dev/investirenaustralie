<?php
namespace App\Http\Controllers\V2\Admin;

use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

use App\Models\Image;
use App\Models\User;

class ProductController extends Controller
{
    public $viewDir = "V2.admin.product";

    public function index()
    {
        $records = Product::findRequested();
        
        return $this->view( "index", ['records' => $records] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->view("create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $this->validate($request, Product::validationRules());

        Product::create($request->all());

        # notification
        Notify::success('Product a été créer avec succès');
        return redirect(route('v2.adminproduct.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Product $product)
    {
        return $this->view("show",['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Product $product)
    {
        return $this->view( "edit", ['product' => $product] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, Product::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $product->update($data);
            return "Record updated";
        }

        $this->validate($request, Product::validationRules());

        $product->update($request->all());

        # notification
        Notify::success('Product a été mise à jour avec succès');
        return redirect(route('v2.adminproduct.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product)
    {
        $product->delete();

        # notification
        Notify::success('Product a été supprimer avec succès');
        return redirect(route('v2.adminproduct.index'));
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
