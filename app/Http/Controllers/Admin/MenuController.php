<?php

namespace App\Http\Controllers\admin;

use App\Models\Menu;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class MenuController extends Controller {
    public $viewDir = "admin.menu";

    public function index() {
        $menus = Menu::all();
        $records = Menu::findRequested();
        return $this->view("index", ['records' => $records, 'menus' => $menus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create() {
        $menus = Menu::all();
        return $this->view("create", ['menus' => $menus]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, Menu::validationRules());
        $image = $request->file('photo');
        $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images/slider');
        $image->move($destinationPath, $input['imagename']);

        //Menu::create($request->all());
        $menu = new Menu();
        $menu->libelle = $request->libelle;
        $menu->photo = $input['imagename'];
        $menu->parent_id = $request->parent_id;
        $menu->save();

        # notification
        Notify::success('Menu a été créer avec succès');
        return redirect(route('admin.menu.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Menu $menu) {
        return $this->view("show", ['menu' => $menu]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Menu $menu) {
        $menus = Menu::all();
        return $this->view("edit", ['menu' => $menu, 'menus' => $menus]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu) {
        if ($request->isXmlHttpRequest()) {
            $data = [$request->name => $request->value];
            $validator = \Validator::make($data, Menu::validationRules($request->name));
            if ($validator->fails())
                return response($validator->errors()->first($request->name), 403);
            $menu->update($data);
            return "Record updated";
        }
        
        if ($_FILES['photo']['name'] != "") {
            $image = $request->file('photo');
            $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/slider');
            $image->move($destinationPath, $input['imagename']);
            $menu->photo = $input['imagename'];            
        } 
        $menu->parent_id = $request->parent_id;
        $menu->save();
        /*$this->validate($request, Menu::validationRules());

        $menu->update($request->all());*/

        # notification
        Notify::success('Menu a été mise à jour avec succès');
        return redirect(route('admin.menu.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Menu $menu) {
        $menu->delete();

        # notification
        Notify::success('Menu a été supprimer avec succès');
        return redirect(route('admin.menu.index'));
    }

    protected function view($view, $data = []) {
        return view($this->viewDir . "." . $view, $data);
    }

}
