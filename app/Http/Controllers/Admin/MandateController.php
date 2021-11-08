<?php
namespace App\Http\Controllers\admin;

use App\MOdels\Mandate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class MandateController extends Controller
{
    public $viewDir = "admin.mandate";

    public function index()
    {
        $records = Mandate::findRequested();
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
        $this->validate($request, Mandate::validationRules());

        Mandate::create($request->all());

        # notification
        Notify::success('Mandate a été créer avec succès');
        return redirect(route('admin.mandate.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Mandate $mandate)
    {
        return $this->view("show",['mandate' => $mandate]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Mandate $mandate)
    {
        return $this->view( "edit", ['mandate' => $mandate] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Mandate $mandate)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, Mandate::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $mandate->update($data);
            return "Record updated";
        }

        $this->validate($request, Mandate::validationRules());

        $mandate->update($request->all());

        # notification
        Notify::success('Mandate a été mise à jour avec succès');
        return redirect(route('admin.mandate.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Mandate $mandate)
    {
        $mandate->delete();

        # notification
        Notify::success('Mandate a été supprimer avec succès');
        return redirect(route('admin.mandate.index'));
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
