<?php
namespace App\Http\Controllers\admin;

use App\Models\TypeUser;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class TypeUserController extends Controller
{
    public $viewDir = "admin.type_user";

    public function index()
    {
        $records = TypeUser::findRequested();
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
        $this->validate($request, TypeUser::validationRules());

        TypeUser::create($request->all());

        # notification
        Notify::success('Type User a été créer avec succès');
        return redirect(route('v2.admin.type-user.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, TypeUser $typeUser)
    {
        return $this->view("show",['typeUser' => $typeUser]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, TypeUser $typeUser)
    {
        return $this->view( "edit", ['typeUser' => $typeUser] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, TypeUser $typeUser)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, TypeUser::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $typeUser->update($data);
            return "Record updated";
        }

        $this->validate($request, TypeUser::validationRules());

        $typeUser->update($request->all());

        # notification
        Notify::success('Type User a été mise à jour avec succès');
        return redirect(route('v2.admin.type-user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, TypeUser $typeUser)
    {
        $typeUser->delete();

        # notification
        Notify::success('Type User a été supprimer avec succès');
        return redirect(route('v2.admin.type-user.index'));
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
