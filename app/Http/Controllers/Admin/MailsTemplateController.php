<?php
namespace App\Http\Controllers\admin;

use App\Models\MailsTemplate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class MailsTemplateController extends Controller
{
    public $viewDir = "admin.mails_template";

    public function index()
    {
        $records = MailsTemplate::findRequested();
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
        $this->validate($request, MailsTemplate::validationRules());

        MailsTemplate::create($request->all());

        # notification
        Notify::success('Mails Template a été créer avec succès');
        return redirect(route('admin.mails-template.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, MailsTemplate $mailsTemplate)
    {
        return $this->view("show",['mailsTemplate' => $mailsTemplate]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, MailsTemplate $mailsTemplate)
    {
        return $this->view( "edit", ['mailsTemplate' => $mailsTemplate] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, MailsTemplate $mailsTemplate)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, MailsTemplate::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $mailsTemplate->update($data);
            return "Record updated";
        }

        $this->validate($request, MailsTemplate::validationRules());

        $mailsTemplate->update($request->all());

        # notification
        Notify::success('Mails Template a été mise à jour avec succès');
        return redirect(route('admin.mails-template.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, MailsTemplate $mailsTemplate)
    {
        $mailsTemplate->delete();

        # notification
        Notify::success('Mails Template a été supprimer avec succès');
        return redirect(route('admin.mails-template.index'));
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
