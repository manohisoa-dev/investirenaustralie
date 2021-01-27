<?php
namespace App\Http\Controllers\V2\Admin;

use App\Blog;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class BlogController extends Controller
{
    public $viewDir = "V2/admin.blog";

    public function index()
    {
        $records = Blog::findRequested();
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
        $this->validate($request, Blog::validationRules());

        Blog::create($request->all());

        # notification
        Notify::success('Blog a été créer avec succès');
        return redirect(route('v2.blog.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Blog $blog)
    {
        return $this->view("show",['blog' => $blog]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Blog $blog)
    {
        return $this->view( "edit", ['blog' => $blog] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, Blog::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $blog->update($data);
            return "Record updated";
        }

        $this->validate($request, Blog::validationRules());

        $blog->update($request->all());

        # notification
        Notify::success('Blog a été mise à jour avec succès');
        return redirect(route('v2.blog.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Blog $blog)
    {
        $blog->delete();

        # notification
        Notify::success('Blog a été supprimer avec succès');
        return redirect(route('v2.blog.index'));
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
