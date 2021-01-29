<?php
namespace App\Http\Controllers\V2\Admin;

use App\Country;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class CountryController extends Controller
{
    public $viewDir = "V2.admin.country";

    public function index()
    {
        $records = Country::findRequested();
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
        $this->validate($request, Country::validationRules());

        Country::create($request->all());

        # notification
        Notify::success('Country a été créer avec succès');
        return redirect(route('v2.admincountry.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Country $country)
    {
        return $this->view("show",['country' => $country]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Country $country)
    {
        return $this->view( "edit", ['country' => $country] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, Country::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $country->update($data);
            return "Record updated";
        }

        $this->validate($request, Country::validationRules());

        $country->update($request->all());

        # notification
        Notify::success('Country a été mise à jour avec succès');
        return redirect(route('v2.admincountry.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Country $country)
    {
        $country->delete();

        # notification
        Notify::success('Country a été supprimer avec succès');
        return redirect(route('v2.admincountry.index'));
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
