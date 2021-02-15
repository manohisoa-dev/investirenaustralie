<?php
namespace App\Http\Controllers\Admin;

use App\Plan;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class PlanController extends Controller
{
    public $viewDir = "admin.plan";

    public function index()
    {
        $records = Plan::findRequested();
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
        $this->validate($request, Plan::validationRules());

        Plan::create($request->all());

        # notification
        Notify::success('Plan a été créer avec succès');
        return redirect(route('admin.plan.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Plan $plan)
    {
        return $this->view("show",['plan' => $plan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Plan $plan)
    {
        return $this->view( "edit", ['plan' => $plan] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, Plan::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $plan->update($data);
            return "Record updated";
        }

        $this->validate($request, Plan::validationRules());

        $plan->update($request->all());

        # notification
        Notify::success('Plan a été mise à jour avec succès');
        return redirect(route('admin.plan.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Plan $plan)
    {
        $plan->delete();

        # notification
        Notify::success('Plan a été supprimer avec succès');
        return redirect(route('admin.plan.index'));
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
