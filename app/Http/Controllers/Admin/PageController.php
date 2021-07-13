<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Models\Pub;
use App\Models\PubPage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class PageController extends Controller {
    public $viewDir = "admin.page";

    public function index() {
        $records = Page::findRequested();
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
        $this->middleware('auth');
        $this->middleware('role:1');

        // Create page
        $page = new Page();
        $page->title = $request->title;
        $page->content = $request->content;
        $page->parent_id = $request->parent_id;
        $page->page_order = $request->page_order;
        $page->path = $request->path;
        $page->language = $request->language;
        $page->author_id = $request->author_id;
        $page->is_pub = $request->is_pub;

        $page->save();
        //$this->validate($request, Page::validationRules());
        //Page::create($request->all());
        if ($request->is_pub == 1) {
            $pubPage = new PubPage();
            $pubPage->page_id = $page->id;
            $pubPage->pub_id = $request->pubid;
            $pubPage->save();
        }

        # notification
        Notify::success('Page a été créer avec succès');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Page $page) {
        return $this->view("show", ['page' => $page]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Page $page) {
        return $this->view("edit", ['page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page) {
        if ($request->is_pub == 1) {
            $page->update($request->only(['title', 'content', 'parent_id','page_order','path','language','is_pub']));
            if($request->pubid != $request->oldpubId){
                $pagePubold = PubPage::where('page_id', $page->id)->where('pub_id',$request->oldpubId)->delete();
                
                $pubPage = new PubPage();
                $pubPage->page_id = $page->id;
                $pubPage->pub_id = $request->pubid;
                $pubPage->save();
            }
        } else {
            if ($request->isXmlHttpRequest()) {
                $data = [$request->name => $request->value];
                $validator = \Validator::make($data, Page::validationRules($request->name));
                if ($validator->fails())
                    return response($validator->errors()->first($request->name), 403);
                $page->update($data);
                return "Record updated";
            }

            $this->validate($request, Page::validationRules());
            $page->update($request->all());
        }


        # notification
        Notify::success('Page a été mise à jour avec succès');
        return redirect(Auth::user()->isAdmin()?route('admin.page.index'):route('admin.collaborators.admin.page.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Page $page) {
        $page->delete();

        # notification
        Notify::success('Page a été supprimer avec succès');
        return back();
    }

    protected function view($view, $data = []) {
        return view($this->viewDir . "." . $view, $data);
    }

}
