<?php
namespace App\Http\Controllers\admin;

use App\Models\Newsletter;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;
use Auth;

class NewsletterController extends Controller
{
    public $viewDir = "admin.newsletter";

    public function index()
    {
        $records = Newsletter::findRequested();
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
        $this->validate($request, Newsletter::validationRules());

        Newsletter::create($request->all());

        # notification
        Notify::success('Newsletter a été créer avec succès');
        return redirect(route('admin.newsletter.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Newsletter $newsletter)
    {
        return $this->view("show",['newsletter' => $newsletter]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Newsletter $newsletter)
    {
        return $this->view( "edit", ['newsletter' => $newsletter] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Newsletter $newsletter)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, Newsletter::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $newsletter->update($data);
            return "Record updated";
        }

        $this->validate($request, Newsletter::validationRules());

        $newsletter->update($request->all());

        # notification
        Notify::success('Newsletter a été mise à jour avec succès');
        return redirect(route('admin.newsletter.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Newsletter $newsletter)
    {
        $newsletter->delete();

        # notification
        Notify::success('Newsletter a été supprimer avec succès');
        return redirect(route('admin.newsletter.index'));
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
