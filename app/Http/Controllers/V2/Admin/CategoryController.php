<?php
namespace App\Http\Controllers\V2\Admin;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class CategoryController extends Controller
{
    public $viewDir = "V2.admin.category";

    public function index()
    {
        $records = Category::findRequested();
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
        $this->validate($request, Category::validationRules());

        Category::create($request->all());

        # notification
        Notify::success('Category a été créer avec succès');
        return redirect(route('v2.admin.category.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Category $category)
    {
        return $this->view("show",['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Category $category)
    {
        return $this->view( "edit", ['category' => $category] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, Category::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $category->update($data);
            return "Record updated";
        }

        $this->validate($request, Category::validationRules());

        $category->update($request->all());

        # notification
        Notify::success('Category a été mise à jour avec succès');
        return redirect(route('v2.admin.category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category)
    {
        $category->delete();

        # notification
        Notify::success('Category a été supprimer avec succès');
        return redirect(route('v2.admin.category.index'));
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
