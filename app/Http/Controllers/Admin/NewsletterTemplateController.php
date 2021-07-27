<?php
namespace App\Http\Controllers\admin;

use App\Models\NewsletterTemplate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;
use Auth;

class NewsletterTemplateController extends Controller
{
    public $viewDir = "admin.newsletter_template";

    public function index()
    {
        $records = NewsletterTemplate::findRequested();
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
        $this->validate($request, NewsletterTemplate::validationRules());
        if($request->statuts == 'Actif'){
            NewsletterTemplate::query()->update(['statuts' => 'Inactif']);
        }
        NewsletterTemplate::create($request->all());

        # notification
        Notify::success('Paramètres des newsletter a été créer avec succès');
        return redirect(Auth::user()->isAdmin()?route('admin.newsletter-template.index'):route('admin.collaborators.admin.newsletter-template.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, NewsletterTemplate $newsletterTemplate)
    {
        return $this->view("show",['newsletterTemplate' => $newsletterTemplate]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, NewsletterTemplate $newsletterTemplate)
    {
        return $this->view( "edit", ['newsletterTemplate' => $newsletterTemplate] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, NewsletterTemplate $newsletterTemplate)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, NewsletterTemplate::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $newsletterTemplate->update($data);
            return "Record updated";
        }

        $this->validate($request, NewsletterTemplate::validationRules());
        if($request->statuts == 'Actif'){
            NewsletterTemplate::query()->update(['statuts' => 'Inactif']);
        }
        $newsletterTemplate->update($request->all());

        # notification
        Notify::success('Paramètres des newsletter a été mise à jour avec succès');
        return redirect(Auth::user()->isAdmin()?route('admin.newsletter-template.index'):route('admin.collaborators.admin.newsletter-template.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, NewsletterTemplate $newsletterTemplate)
    {
        $newsletterTemplate->delete();

        # notification
        Notify::success('Paramètres des newsletter a été supprimer avec succès');
        return redirect(Auth::user()->isAdmin()?route('admin.newsletter-template.index'):route('admin.collaborators.admin.newsletter-template.index'));
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
