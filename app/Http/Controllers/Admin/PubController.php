<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pub;
use App\Models\Page;
use App\Models\PubPage;
use App\Models\Image;
use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class PubController extends Controller {
    public $viewDir = "admin.pub";

    public function index() {
        $records = Pub::findRequested();
        return $this->view("index", ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create() {
        $pages = Page::all();
        return $this->view("create", ['pages' => $pages]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, Pub::validationRules());

        //Pub::create($request->all());
        $pub = new Pub();

        if ($file = $request->file('image')) {
            $image = Image::storeAndSave($file);
            $pub->image_id = $image->id;
        }

        $pub->title = $request->title;
        $pub->content = $request->content;
        $pub->links = $request->links;
        $pub->author_id = Auth::user()->id;
        $pub->save();

        // Add Publicity to the selected page
        if ($pages = $request->page) {
            foreach ($pages as $pageId) {
                $row = new PubPage();
                $row->page_id = $pageId;
                $row->pub_id = $pub->id;
                $row->author_id = Auth::user()->id;
                $row->save();
            }
        }

        # notification
        Notify::success('Pub a été créer avec succès');
        return redirect(route('admin.pub.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Pub $pub) {
        return $this->view("show", ['pub' => $pub]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Pub $pub) {
        $pageIds = [];
        foreach ($pub->pages as $page) {
            $pageIds[] = $page->id;
        }
        $pages = Page::all();
        return $this->view("edit", ['pub' => $pub, 'pages' => $pages, 'pageIds' => $pageIds]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Pub $pub) {
        if ($request->isXmlHttpRequest()) {
            $data = [$request->name => $request->value];
            $validator = \Validator::make($data, Pub::validationRules($request->name));
            if ($validator->fails())
                return response($validator->errors()->first($request->name), 403);
            $pub->update($data);
            return "Record updated";
        }

        //$this->validate($request, Pub::validationRules());
        if ($file = $request->file('image')) {
            $image = Image::storeAndSave($file);
            $pub->image_id = $image->id;
        }
        $pub->title = $request->title;
        $pub->content = $request->content;
        $pub->links = $request->links;
        $pub->save();

        // remove Old Page
        PubPage::where('pub_id', '=', $pub->id)->delete();

        // Add Publicity to the selected page
        if ($pages = $request->page) {
            foreach ($pages as $pageId) {
                $row = new PubPage();
                $row->page_id = $pageId;
                $row->pub_id = $pub->id;
                $row->author_id = Auth::user()->id;
                $row->save();
            }
        }

        # notification
        Notify::success('Pub a été mise à jour avec succès');
        return redirect(route('admin.pub.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Pub $pub) {
        $pub->delete();

        # notification
        Notify::success('Pub a été supprimer avec succès');
        return redirect(route('admin.pub.index'));
    }

    protected function view($view, $data = []) {
        return view($this->viewDir . "." . $view, $data);
    }

    public function ajaxRequestPost(Request $request) {
        $pubs = Pub::find($request->pubId);
        return response()->json(['title' => $pubs->title, 'content' => $pubs->content,
            'links' => $pubs->links]);
    }

}
