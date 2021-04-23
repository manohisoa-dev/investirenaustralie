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

class ProductController extends Controller {
    public $viewDir = "admin.product";

    public function index() {
        $records = Product::findRequested();
        $status = Product::groupBy('status')->pluck('status', 'status');
        return $this->view("index", ['records' => $records, 'status' => $status]);
    }

    public function programme() {
        $records = Product::allProgramme();
        $status = Product::groupBy('status')->pluck('status', 'status');
        return $this->view("programme", ['records' => $records, 'status' => $status]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create() {
        if ($_GET['type'] == 'produit') {
            return $this->view("create", ['type' => $_GET['type']]);
        } else {
            return $this->view("create_programme", ['type' => $_GET['type']]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->middleware('auth');
        $this->middleware('role:1');
        if ($request->type == 'programme') {
            //creation programme
            $slug = generateSlug($request->title);
            $programme = new Product();
            if ($file = $request->file('image_programme')) {
                $image = Image::storeAndSave($file, 'product');
                $programme->image_id = $image->id;
            }
            $programme->category_id = $request->category_id;
            $programme->min_price = $request->prix_min;
            $programme->max_price = $request->prix_max;
            $programme->content = $request->content;
            $programme->title = $request->title;
            $programme->slug = $slug;
            $programme->author_id = Auth::user()->id;
            $programme->save();

            # notification
            Notify::success('Programme a été créer avec succès');
            return redirect(route('admin.product.programme'));
        } else {
            //creation produit
            if ($request->parent_id == 0) {
                //cration programme
                $slug = generateSlug($request->title);
                $programme = new Product();

                if ($request->file('image_programme')) {
                    $file_pro = $request->file('image_programme') ;
                    $image_pro = Image::storeAndSave($file_pro, 'product');
                    $programme->image_id = $image_pro->id;
                }
                $programme->category_id = $request->cat_programmme_id;
                $programme->min_price = $request->prix_min;
                $programme->max_price = $request->prix_max;
                $programme->content = $request->description;
                $programme->title = $request->title;
                $programme->slug = $slug;
                $programme->author_id = Auth::user()->id;
                $programme->save();

                //creation produit
                $product = new Product();
                $lastId = Product::latest('id')->first();
                $new_id = $lastId->id + 1;
                if ($request->file('image')) {
                    $file = $request->file('image') ;
                    $image = Image::storeAndSave($file, 'product');
                    $product->image_id = $image->id;
                }
                $slug = generateSlug($request->title_product);
                $product->reference = 'ref-p00000' . $new_id;
                $product->title = $request->title_product;
                $product->slug = $slug;
                $product->content = $request->desc_product;
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
                $product->category_id = $request->cat_programmme_id;
                $product->author_id = Auth::user()->id;
                $product->postalCode = $request->postalCode;
                $product->state_id = $request->state_id;
                $product->parent_id = $programme->id;
                $product->save();
            } else {
                //creation simple produit
                $product = new Product();
                $lastId = Product::latest('id')->first();
                $new_id = $lastId->id + 1;
                if ($file = $request->file('image')) {
                    $image = Image::storeAndSave($file, 'product');
                    $product->image_id = $image->id;
                }
                $slug = generateSlug($request->title_product);
                $product->reference = 'ref-p00000' . $new_id;
                $product->title = $request->title_product;
                $product->slug = $slug;
                $product->content = $request->desc_product;
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
                $product->category_id = $request->cat_programmme_id;
                $product->author_id = Auth::user()->id;
                $product->postalCode = $request->postalCode;
                $product->state_id = $request->state_id;
                $product->parent_id = $request->parent_id;
                $product->save();
            }

            # notification
            Notify::success('Produit a été créer avec succès');
            return redirect(route('admin.product.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Product $product) {
        return $this->view("show", ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Product $product) {
        return $this->view("edit", ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product) {
        if ($request->isXmlHttpRequest()) {
            $data = [$request->name => $request->value];
            $validator = \Validator::make($data, Product::validationRules($request->name));
            if ($validator->fails())
                return response($validator->errors()->first($request->name), 403);
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
    public function destroy(Request $request, Product $product) {
        $product->delete();

        # notification
        Notify::success('Produit a été supprimer avec succès');
        return redirect(route('admin.product.index'));
    }

    public function archive(Request $request, Product $product) {
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
    public function trash(Request $request, Product $product) {
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
    public function restore(Request $request, Product $product) {
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
    public function publish(Request $request, Product $product) {
        $this->middleware('auth');
        $this->middleware('role:admin');

        $product->status = 'published';
        $product->save();

        Notify::success('Le produit a été publié avec succés');
        return redirect(route('admin.product.index'));
    }

    protected function view($view, $data = []) {
        return view($this->viewDir . "." . $view, $data);
    }

    public function ajaxRequestPost(Request $request) {
        $product = Product::find($request->productId);
        return response()->json(['slug' => $product->slug, 'id' => $product->id,
            'image_id' => $product->image_id]);
    }

    public function ajaxRequestProgramme(Request $request) {
        $product = Product::find($request->productId);
        return response()->json(['title' => $product->title, 'slug' => $product->slug,
            'id' => $product->id, 'category_id' => $product->category_id, 'min_price' => $product->min_price,
            'max_price' => $product->max_price, 'content' => $product->content]);
    }

}
