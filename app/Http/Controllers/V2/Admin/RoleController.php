<?php
namespace App\Http\Controllers\V2\Admin;

use App\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class RoleController extends Controller
{
    public $viewDir = "V2.admin.role";

    public function index()
    {
        $records = Role::findRequested();
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
        $this->validate($request, Role::validationRules());

        Role::create($request->all());

        # notification
        Notify::success('Role a été créer avec succès');
        return redirect(route('v2.admin.role.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Role $role)
    {
        return $this->view("show",['role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Role $role)
    {
        return $this->view( "edit", ['role' => $role] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, Role::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $role->update($data);
            return "Record updated";
        }

        $this->validate($request, Role::validationRules());

        $role->update($request->all());

        # notification
        Notify::success('Role a été mise à jour avec succès');
        return redirect(route('v2.admin.role.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Role $role)
    {
        $role->delete();

        # notification
        Notify::success('Role a été supprimer avec succès');
        return redirect(route('v2.admin.role.index'));
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
