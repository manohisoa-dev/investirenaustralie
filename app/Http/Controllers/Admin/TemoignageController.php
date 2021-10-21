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
use Carbon\Carbon;

class TemoignageController extends Controller {
    public $viewDir = "admin.temoignage";

    public function index() {
        return view('pdf.cpc_invoice_bonus');
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

        /*$records = Temoignage::findRequested();
        return $this->view("index", ['records' => $records]);*/
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

    public function pdfTest() {
        //$temoignage = Temoignage::find(1);

        //$pdf = PDF::loadView('admin.temoignage.pdf', compact('temoignage'));
        //return $pdf->download('invoice.pdf');
        return $this->view("pdf");
    }

    public function infoPost(Request $request) {
        $nom = $request->name;
        $titre = $request->titre;
        $dt = strtotime($request->dt);
        $day = date('d', $dt);
        $month = date('m', $dt);
        $year = date('Y', $dt);

        $pdf = new Fpdi('l');
        $pdf_file = public_path('uploads/FORM_6_MODEL_1.pdf');
        $pagecount = $pdf->setSourceFile($pdf_file);
        // Import the first page from the PDF and add to dynamic PDF
        $tpl = $pdf->importPage(1);
        $pdf->AddPage();

        // Use the imported page as the template
        $pdf->useTemplate($tpl);
        // Set the default font to use
        $pdf->SetFont('Helvetica');

        // modifier nom
        $pdf->SetFontSize('30'); // set font size
        $pdf->SetXY(7.41, 5.02); // set the position of the box
        $pdf->Cell(0, 10, $nom, 1, 0, 'C'); // add the text, align to Center of cell

        // modifier titre
        $pdf->SetFontSize('20');
        $pdf->SetXY(193.57, 207.87);
        $pdf->Cell(0, 10, '1', 1, 0, 'C');

        // modifier jour
        $pdf->SetFontSize('20');
        $pdf->SetXY(208, 208);
        $pdf->Cell(0, 10, '22', 1, 0, 'C');

        // modifier mois
        $pdf->SetXY(223.19, 207.87);
        $pdf->Cell(30, 10, '3', 1, 0, 'C');

        // modifier année
        //$pdf->SetXY(200, 122);
        //$pdf->Cell(20, 10, $year, 1, 0, 'L');
        
        //generer pdf
        $pdf->Output();
    }

}
