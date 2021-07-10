<?php

namespace App\Http\Controllers\admin;

use App\Models\Temoignage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;
use Auth;
use PDF;

class TemoignageController extends Controller {
    public $viewDir = "admin.temoignage";

    public function index() {
        $records = Temoignage::findRequested();
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
        $this->validate($request, Temoignage::validationRules());

        Temoignage::create($request->all());

        # notification
        Notify::success('Temoignage a été créer avec succès');
        return redirect(route('admin.temoignage.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Temoignage $temoignage) {
        return $this->view("show", ['temoignage' => $temoignage]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Temoignage $temoignage) {
        return $this->view("edit", ['temoignage' => $temoignage]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Temoignage $temoignage) {
        if ($request->isXmlHttpRequest()) {
            $data = [$request->name => $request->value];
            $validator = \Validator::make($data, Temoignage::validationRules($request->name));
            if ($validator->fails())
                return response($validator->errors()->first($request->name), 403);
            $temoignage->update($data);
            return "Record updated";
        }

        $this->validate($request, Temoignage::validationRules());

        $temoignage->update($request->all());

        # notification
        Notify::success('Temoignage a été mise à jour avec succès');
        return redirect(route('admin.temoignage.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Temoignage $temoignage) {
        $temoignage->delete();

        # notification
        Notify::success('Temoignage a été supprimer avec succès');
        return redirect(route('admin.temoignage.index'));
    }

    protected function view($view, $data = []) {
        return view($this->viewDir . "." . $view, $data);
    }

    public function pdfTest(Request $request) {
        echo $request->id;
        $temoignage = Temoignage::find($request->id);

        $pdf = PDF::loadView('admin.temoignage.pdf', compact('temoignage'));
        return $pdf->download('invoice.pdf');
    }

}
