<?php
namespace App\Http\Controllers\admin;

use App\Models\ModelFichierPdf;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class ModelFichierPdfController extends Controller
{
    public $viewDir = "admin.model_fichier_pdf";

    public function index()
    {
        $records = ModelFichierPdf::findRequested();
        return $this->view( "index", ['records' => $records] );
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
        /*$this->validate($request, ModelFichierPdf::validationRules());
        ModelFichierPdf::create($request->all());
        # notification
        Notify::success('Model Fichier Pdf a été créer avec succès');
        return redirect(route('admin.model-fichier-pdf.index'));*/
        
        $this->validate($request, ModelFichierPdf::validationRules());
        $search = '';
        $search .= $request->contenu_fr;
        $valeur_var = '';
        preg_match_all('#\{.*?\}#si', $search, $matches);
        if ($matches) {
            foreach ($matches as $val) {
                $valeur_var .= implode(', ', array_unique($val));
            }

        }
        $model_pdf = new ModelFichierPdf();
        $model_pdf->pdf_titre = $request->pdf_titre;
        $model_pdf->contenu_fr = $request->contenu_fr;
        $model_pdf->contenu_en = $request->contenu_en;
        $model_pdf->params = $valeur_var;
        $model_pdf->save();
        # notification
        Notify::success('Modèle fichier a été créer avec succès');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, ModelFichierPdf $modelFichierPdf)
    {
        return $this->view("show",['modelFichierPdf' => $modelFichierPdf]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, ModelFichierPdf $modelFichierPdf)
    {
        return $this->view( "edit", ['modelFichierPdf' => $modelFichierPdf] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, ModelFichierPdf $modelFichierPdf)
    {
        $search = '';
        $search .= $request->contenu_fr;
        $valeur_var = '';
        preg_match_all('#\{.*?\}#si', $search, $matches);
        if ($matches) {
            foreach ($matches as $val) {
                $valeur_var .= implode(', ', array_unique($val));
            }

        }
        
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, ModelFichierPdf::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $modelFichierPdf->update($data);
            return "Record updated";
        }

        $this->validate($request, ModelFichierPdf::validationRules());
        $modelFichierPdf->update($request->all());
        ModelFichierPdf::where('id', $modelFichierPdf->id)->update(['params' => $valeur_var]);
        # notification
        Notify::success('Modèle fichier a été mise à jour avec succès');
        return redirect(route('admin.model-fichier-pdf.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, ModelFichierPdf $modelFichierPdf)
    {
        $modelFichierPdf->delete();

        # notification
        Notify::success('Modèle Fichier Pdf a été supprimer avec succès');
        return redirect(route('admin.model-fichier-pdf.index'));
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
