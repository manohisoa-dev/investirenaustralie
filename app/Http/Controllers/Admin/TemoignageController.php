<?php

namespace App\Http\Controllers\admin;

use App\Models\Temoignage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;
use Auth;
use PDF;
use setasign\Fpdi\Fpdi;

class TemoignageController extends Controller {
    public $viewDir = "admin.temoignage";

    public function index() {
        /*$pdf = new Fpdi('l');
        $pdf_file = public_path('uploads/certificate.pdf');
        $pagecount = $pdf->setSourceFile($pdf_file);
        // Import the first page from the PDF and add to dynamic PDF
        $tpl = $pdf->importPage(1);
        $pdf->AddPage();

        // Use the imported page as the template
        $pdf->useTemplate($tpl);
        // Set the default font to use
        $pdf->SetFont('Helvetica');
        
        // First box - the user's Name
        $pdf->SetFontSize('30'); // set font size
        $pdf->SetXY(10, 89); // set the position of the box
        $pdf->Cell(0, 10, 'Vicky RAZAFINDRAIBE', 1, 0, 'C'); // add the text, align to Center of cell

        $pdf->Output();*/
        
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
        return back();
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
        return redirect(Auth::user()->isAdmin()?route('admin.temoignage.index'):route('admin.collaborators.admin.temoignage.index'));
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
        return back();
    }

    protected function view($view, $data = []) {
        return view($this->viewDir . "." . $view, $data);
    }

    public function pdfTest(Request $request) {
        //echo $request->id;
        $temoignage = Temoignage::find($request->id);

        $pdf = PDF::loadView('admin.temoignage.pdf', compact('temoignage'));
        return $pdf->download('invoice.pdf');
    }

}
