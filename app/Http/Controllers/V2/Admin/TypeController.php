<?php
namespace App\Http\Controllers\V2\Admin;

use App\Type;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class TypeController extends Controller
{
    public $viewDir = "V2.admin.type";

    public function index()
    {
        $records = Type::findRequested();
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
        $this->validate($request, Type::validationRules());

        Type::create($request->all());

        # notification
        Notify::success('Type a été créer avec succès');
        return redirect(route('v2.admin.type.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Type $type)
    {
        return $this->view("show",['type' => $type]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Type $type)
    {
        return $this->view( "edit", ['type' => $type] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, Type::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $type->update($data);
            return "Record updated";
        }

        $this->validate($request, Type::validationRules());

        $type->update($request->all());

        # notification
        Notify::success('Type a été mise à jour avec succès');
        return redirect(route('v2.admin.type.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Type $type)
    {
        $type->delete();

        # notification
        Notify::success('Type a été supprimer avec succès');
        return redirect(route('v2.admin.type.index'));
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
