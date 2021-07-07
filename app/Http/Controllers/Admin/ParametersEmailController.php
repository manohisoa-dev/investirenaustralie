<?php
namespace App\Http\Controllers\admin;

use App\Models\ParametersEmail;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class ParametersEmailController extends Controller
{
    public $viewDir = "admin.parameters_email";

    public function index()
    {
        $records = ParametersEmail::findRequested();
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
        $this->validate($request, ParametersEmail::validationRules());

        ParametersEmail::create($request->all());

        # notification
        Notify::success('Parameters Email a été créer avec succès');
        return redirect(route('admin.parameters-email.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, ParametersEmail $parametersEmail)
    {
        return $this->view("show",['parametersEmail' => $parametersEmail]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, ParametersEmail $parametersEmail)
    {
        return $this->view( "edit", ['parametersEmail' => $parametersEmail] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, ParametersEmail $parametersEmail)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, ParametersEmail::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $parametersEmail->update($data);
            return "Record updated";
        }

        $this->validate($request, ParametersEmail::validationRules());

        $parametersEmail->update($request->all());

        # notification
        Notify::success('Parameters Email a été mise à jour avec succès');
        return redirect(route('admin.parameters-email.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, ParametersEmail $parametersEmail)
    {
        $parametersEmail->delete();

        # notification
        Notify::success('Parameters Email a été supprimer avec succès');
        return redirect(route('admin.parameters-email.index'));
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
