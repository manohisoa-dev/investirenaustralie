<?php
namespace App\Http\Controllers\Admin;

use App\Models\Postalcode;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class PostalcodeController extends Controller
{
    public $viewDir = "admin.postalcode";

    public function index()
    {
        $records = Postalcode::findRequested();
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
        $this->validate($request, Postalcode::validationRules());

        Postalcode::create($request->all());

        # notification
        Notify::success('Postalcode a été créer avec succès');
        return redirect(route('v2.adminpostalcode.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Postalcode $postalcode)
    {
        return $this->view("show",['postalcode' => $postalcode]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Postalcode $postalcode)
    {
        return $this->view( "edit", ['postalcode' => $postalcode] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Postalcode $postalcode)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, Postalcode::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $postalcode->update($data);
            return "Record updated";
        }

        $this->validate($request, Postalcode::validationRules());

        $postalcode->update($request->all());

        # notification
        Notify::success('Postalcode a été mise à jour avec succès');
        return redirect(route('v2.adminpostalcode.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Postalcode $postalcode)
    {
        $postalcode->delete();

        # notification
        Notify::success('Postalcode a été supprimer avec succès');
        return redirect(route('v2.adminpostalcode.index'));
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
