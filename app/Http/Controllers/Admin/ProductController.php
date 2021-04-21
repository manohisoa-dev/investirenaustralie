<?php
namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

use App\Models\Image;
use App\Models\User;
use Auth;

class ProductController extends Controller
{
    public $viewDir = "admin.product";

    public function index()
    {
        $records = Product::findRequested();
        $status = Product::groupBy('status')->pluck('status', 'status');        
        return $this->view( "index", ['records' => $records,'status' => $status] );
    }
    
    public function programme()
    {
        $records = Product::allProgramme();
        $status = Product::groupBy('status')->pluck('status', 'status');        
        return $this->view( "programme", ['records' => $records,'status' => $status] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        if($_GET['type'] == 'produit'){
            return $this->view("create");
        }else{
            return $this->view("create_programme");
        }        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $this->middleware('auth');
        $this->middleware('role:1');
        $product = new Product();
        $lastId = Product::latest('id')->first();
        $new_id = $lastId->id + 1;
        if($file=$request->file('image')){
            $image = Image::storeAndSave($file,'product');
            $product->image_id = $image->id;
        }
        $slug = generateSlug($request->title);
        $product->reference = 'ref-p00000'.$new_id;
        $product->title = $request->title;
        $product->slug = $slug;
        $product->content = $request->content;
        $product->quantity = $request->quantity;
        $product->is_new = 1;
        $product->view_count = 0;
        $product->area = $request->area;
        $product->carport_spaces = $request->carport_spaces;
        $product->garage_spaces = $request->garage_spaces;
        $product->off_street_spaces = $request->off_street_spaces;
        $product->bathrooms = $request->bathrooms;
        $product->bedrooms = $request->bedrooms;
        $product->ensuite = $request->ensuite;
        $product->land_area = $request->land_area;
        $product->floor_area = $request->floor_area;
        $product->number_of_floors = $request->number_of_floors;
        $product->new_construction = $request->new_construction;
        $product->year_built = $request->year_built;
        $product->display_address = $request->display_address;
        $product->price = $request->price;
        $product->currency = $request->currency;
        $product->tma = 0.20;
        $product->status = $request->status;
        $product->type_id = $request->type_id;
        $product->category_id = $request->category_id;
        $product->seller_id = $request->seller_id;
        $product->author_id = Auth::user()->id;
        $product->postalCode = $request->postalCode;
        $product->state_id = $request->state_id;
        $product->location_id = $request->location_id;
        $product->parent_id = $request->parent_id;
        $product->save();
        /*$this->validate($request, Product::validationRules());

        Product::create($request->all());*/

        # notification
        Notify::success('Product a été créer avec succès');
        return redirect(route('admin.product.index'));
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
        return redirect(route('admin.product.index'));
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
        return redirect(route('admin.product.index'));
    }
    
    public function archive(Request $request,Product  $product)
    {
        $product->status = 'archived';
        $product->save();
        Notify::success('Le produit a été archivé avec succés');
        return redirect(route('admin.product.index'));
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
        return redirect(route('admin.product.index'));
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
        return redirect(route('admin.product.index'));
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
        return redirect(route('admin.product.index'));
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }
    
    public function ajaxRequestPost(Request $request) {
        $product = Product::find($request->productId);
        return response()->json(['slug' => $product->slug, 'id' => $product->id,
            'image_id' => $product->image_id]);
    }

}
