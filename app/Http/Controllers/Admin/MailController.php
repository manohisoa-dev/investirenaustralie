<?php
namespace App\Http\Controllers\Admin;

use App\Models\Mail;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class MailController extends Controller
{
    public $viewDir = "admin.mail";

    public function index()
    {
        $records = Mail::findRequested();
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
        $this->validate($request, Mail::validationRules());

        Mail::create($request->all());

        # notification
        Notify::success('Mail a été créer avec succès');
        return redirect(route('v2.admin.mail.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Mail $mail)
    {
        return $this->view("show",['mail' => $mail]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Mail $mail)
    {
        return $this->view( "edit", ['mail' => $mail] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Mail $mail)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, Mail::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $mail->update($data);
            return "Record updated";
        }

        $this->validate($request, Mail::validationRules());

        $mail->update($request->all());

        # notification
        Notify::success('Mail a été mise à jour avec succès');
        return redirect(route('v2.admin.mail.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Mail $mail)
    {
        $mail->delete();

        # notification
        Notify::success('Mail a été supprimer avec succès');
        return redirect(route('v2.admin.mail.index'));
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
