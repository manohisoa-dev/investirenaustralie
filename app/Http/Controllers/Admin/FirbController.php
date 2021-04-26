<?php
namespace App\Http\Controllers\admin;

use App\Models\Firb;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class FirbController extends Controller
{
    public $viewDir = "admin.firb";

    public function index()
    {
        $records = Firb::findRequested();
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
        $this->validate($request, Firb::validationRules());

        Firb::create($request->all());

        # notification
        Notify::success('Firb a été créer avec succès');
        return redirect(route('admin.firb.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Firb $firb)
    {
        return $this->view("show",['firb' => $firb]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Firb $firb)
    {
        return $this->view( "edit", ['firb' => $firb] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Firb $firb)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, Firb::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $firb->update($data);
            return "Record updated";
        }

        $this->validate($request, Firb::validationRules());

        $firb->update($request->all());

        # notification
        Notify::success('Firb a été mise à jour avec succès');
        return redirect(route('admin.firb.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Firb $firb)
    {
        $firb->delete();

        # notification
        Notify::success('Firb a été supprimer avec succès');
        return redirect(route('admin.firb.index'));
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
