<?php
namespace App\Http\Controllers\V2\Admin;

use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

use App\Models\Image;
use App\User;

class ProductController extends Controller
{
    public $viewDir = "V2.admin.product";

    public function index()
    {
        $records = Product::findRequested();
        $status = Product::groupBy('status')->pluck('status', 'status');        
        return $this->view( "index", ['records' => $records,'status' => $status] );
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
        return redirect(route('V2.adminproduct.index'));
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
        Notify::success('Produit a été mise à jour avec succès');
        return redirect(route('V2.admin.product.index'));
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
        Notify::success('Produit a été supprimer avec succès');
        return redirect(route('V2.admin.product.index'));
    }
    
    public function archive(Request $request,Product  $product)
    {
        $product->status = 'archived';
        $product->save();
        Notify::success('Le produit a été archivé avec succés');
        return redirect(route('V2.admin.product.index'));
    }
    
    /**
    * Trash product
    *
    * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */
    public function trash(Request $request,Product  $product)
    {        
        $product->status = 'trashed';
        $product->save();
        
        Notify::success('Le produit a été ajouté au corbeille avec succés');
        return redirect(route('V2.admin.product.index'));
    }
    
    /**
    * Restore trashed product
    *
    * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */
    public function restore(Request $request,Product  $product)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $product->status = 'pinged';
        $product->save();
        
        Notify::success('Le produit a été restoré avec succés');
        return redirect(route('V2.admin.product.index'));
    }
    
    /**
    * Publish product
    *
    * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */
    public function publish(Request $request,Product  $product)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $product->status = 'published';
        $product->save();
        
        Notify::success('Le produit a été publié avec succés');
        return redirect(route('V2.admin.product.index'));
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
