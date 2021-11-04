<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;
use Auth;
use App\Models\Category;

class TypeController extends Controller {
    public $viewDir = "admin.type";

    public function index() {
        $records = Type::findRequested();
        $categories = Category::all();
        return $this->view("index", ['records' => $records,'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create() {
        $categories = Category::all();
        return $this->view("create",['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //$this->validate($request, Type::validationRules());
        if($request->is_autonome == 1){
            $slug = 'a-'.generateSlug($request->title);
        }else{
            $slug = generateSlug($request->title);
        }        
        
        $type = new Type();
        $type->slug = $slug;
        $type->title = $request->title;
        $type->title_en = $request->title_en;
        $type->categories_id = $request->categories_id;
        $type->is_autonome = $request->is_autonome;
        $type->author_id = Auth::user()->id;
        $type->save();

        # notification
        Notify::success('Type a été créer avec succès');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Type $type) {
        return $this->view("show", ['type' => $type]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Type $type) {
        $categories = Category::all();
        return $this->view("edit", ['type' => $type,'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type) {
        if ($request->isXmlHttpRequest()) {
            $data = [$request->name => $request->value];
            $validator = \Validator::make($data, Type::validationRules($request->name));
            if ($validator->fails())
                return response($validator->errors()->first($request->name), 403);
            $type->update($data);
            return "Record updated";
        }

        $this->validate($request, Type::validationRules());
        
        $type->update($request->all());
        if($request->is_autonome == 1){
            $slug = 'a-'.generateSlug($request->title);
        }else{
            $slug = generateSlug($request->title);
        }
        $type->slug = $slug;
        $type->save();

        # notification
        Notify::success('Type a été mise à jour avec succès');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Type $type) {
        $type->delete();

        # notification
        Notify::success('Type a été supprimer avec succès');
        return back();
    }

    protected function view($view, $data = []) {
        return view($this->viewDir . "." . $view, $data);
    }

}
