<?php
namespace App\Http\Controllers\admin;

use App\Models\ModelMessage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class ModelMessageController extends Controller
{
    public $viewDir = "admin.model_message";

    public function index()
    {
        $records = ModelMessage::findRequested();
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
        $this->validate($request, ModelMessage::validationRules());

        ModelMessage::create($request->all());

        # notification
        Notify::success('Model Message a été créer avec succès');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, ModelMessage $modelMessage)
    {
        return $this->view("show",['modelMessage' => $modelMessage]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, ModelMessage $modelMessage)
    {
        return $this->view( "edit", ['modelMessage' => $modelMessage] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, ModelMessage $modelMessage)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, ModelMessage::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $modelMessage->update($data);
            return "Record updated";
        }

        $this->validate($request, ModelMessage::validationRules());

        $modelMessage->update($request->all());

        # notification
        Notify::success('Model Message a été mise à jour avec succès');
        return redirect(route('admin.model-message.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, ModelMessage $modelMessage)
    {
        $modelMessage->delete();

        # notification
        Notify::success('Model Message a été supprimer avec succès');
        return redirect(route('admin.model-message.index'));
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
