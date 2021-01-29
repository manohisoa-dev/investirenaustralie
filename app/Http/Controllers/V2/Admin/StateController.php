<?php
namespace App\Http\Controllers\V2\Admin;

use App\State;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class StateController extends Controller
{
    public $viewDir = "V2.admin.state";

    public function index()
    {
        $records = State::findRequested();
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
        $this->validate($request, State::validationRules());

        State::create($request->all());

        # notification
        Notify::success('State a été créer avec succès');
        return redirect(route('V2.admin.state.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, State $state)
    {
        return $this->view("show",['state' => $state]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, State $state)
    {
        return $this->view( "edit", ['state' => $state] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, State::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $state->update($data);
            return "Record updated";
        }

        $this->validate($request, State::validationRules());

        $state->update($request->all());

        # notification
        Notify::success('State a été mise à jour avec succès');
        return redirect(route('V2.admin.state.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, State $state)
    {
        $state->delete();

        # notification
        Notify::success('State a été supprimer avec succès');
        return redirect(route('V2.admin.state.index'));
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
