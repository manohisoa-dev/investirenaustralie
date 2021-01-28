<?php
namespace App\Http\Controllers\V2\Admin;

use App\Pub;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class PubController extends Controller
{
    public $viewDir = "V2.admin.pub";

    public function index()
    {
        $records = Pub::findRequested();
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
        $this->validate($request, Pub::validationRules());

        Pub::create($request->all());

        # notification
        Notify::success('Pub a été créer avec succès');
        return redirect(route('v2.admin.pub.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Pub $pub)
    {
        return $this->view("show",['pub' => $pub]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Pub $pub)
    {
        return $this->view( "edit", ['pub' => $pub] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Pub $pub)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, Pub::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $pub->update($data);
            return "Record updated";
        }

        $this->validate($request, Pub::validationRules());

        $pub->update($request->all());

        # notification
        Notify::success('Pub a été mise à jour avec succès');
        return redirect(route('v2.admin.pub.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Pub $pub)
    {
        $pub->delete();

        # notification
        Notify::success('Pub a été supprimer avec succès');
        return redirect(route('v2.admin.pub.index'));
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
