<?php
namespace App\Http\Controllers\V2\Admin;

use App\Badword;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class BadwordController extends Controller
{
    public $viewDir = "V2.admin.badword";

    public function index()
    {
        $records = Badword::findRequested();
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
        $this->validate($request, Badword::validationRules());

        Badword::create($request->all());

        # notification
        Notify::success('Badword a été créer avec succès');
        return redirect(route('v2.badword.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Badword $badword)
    {
        return $this->view("show",['badword' => $badword]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Badword $badword)
    {
        return $this->view( "edit", ['badword' => $badword] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Badword $badword)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, Badword::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $badword->update($data);
            return "Record updated";
        }

        $this->validate($request, Badword::validationRules());

        $badword->update($request->all());

        # notification
        Notify::success('Badword a été mise à jour avec succès');
        return redirect(route('v2.badword.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Badword $badword)
    {
        $badword->delete();

        # notification
        Notify::success('Badword a été supprimer avec succès');
        return redirect(route('v2.badword.index'));
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
