<?php
namespace App\Http\Controllers\admin;

use App\Models\SearchMandate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;
use App\Models\State;
use App\Models\Image;

class SearchMandateController extends Controller
{
    public $viewDir = "admin.search_mandate";

    public function index()
    {
        $records = SearchMandate::findRequested();
        return $this->view( "index", ['records' => $records] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $state = State::all();
        return $this->view("create",['states' => $state]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $mandate = new SearchMandate();
        if ($file = $request->file('mandate_file')) {
            $image = Image::storeAndSave($file,'Mandat');
            $mandate->image_id = $image->id;
        }
        $mandate->state_id = $request->state_id;
        $mandate->search_mandate_name = $request->search_mandate_name;
        $mandate->save();
        # notification
        Notify::success('Mandat de recherche a été créer avec succès');
        return redirect(route('admin.search-mandate.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, SearchMandate $searchMandate)
    {
        return $this->view("show",['searchMandate' => $searchMandate]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, SearchMandate $searchMandate)
    {
        $state = State::all();
        return $this->view( "edit", ['searchMandate' => $searchMandate, 'states' => $state] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, SearchMandate $searchMandate)
    {
        if ($request->isXmlHttpRequest()) {
            $data = [$request->name => $request->value];
            $validator = \Validator::make($data, Mandate::validationRules($request->name));
            if ($validator->fails())
                return response($validator->errors()->first($request->name), 403);
            $searchMandate->update($data);
            return "Record updated";
        }
        
        if ($file = $request->file('mandate_file')) {
            $image = Image::storeAndSave($file,'Mandat');
            $searchMandate->image_id = $image->id;
        }
        //$this->validate($request, Mandate::validationRules());
        //$mandate->update($request->all());
        $searchMandate->state_id = $request->state_id;
        $searchMandate->search_mandate_name = $request->search_mandate_name;
        $searchMandate->save();

        # notification
        Notify::success('Mandat de recherche a été mise à jour avec succès');
        return redirect(route('admin.search-mandate.index'));
        
        
        
        
        /*if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, SearchMandate::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $searchMandate->update($data);
            return "Record updated";
        }

        $this->validate($request, SearchMandate::validationRules());

        $searchMandate->update($request->all());

        # notification
        Notify::success('Search Mandate a été mise à jour avec succès');
        return redirect(route('admin.search-mandate.index'));*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, SearchMandate $searchMandate)
    {
        $searchMandate->delete();

        # notification
        Notify::success('Search Mandate a été supprimer avec succès');
        return redirect(route('admin.search-mandate.index'));
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
