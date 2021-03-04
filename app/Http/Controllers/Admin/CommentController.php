<?php
namespace App\Http\Controllers\admin;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\CommentVote;
use App\Models\CommentSpam;
use App\Models\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class CommentController extends Controller
{
    public $viewDir = "admin.comment";

    public function index()
    {
        $records = Comment::findRequested();
        //$records = Comment::where('blog_id','=', $blog->id)->get();
        //dd($records);
        return $this->view( "index", ['records' => $records]);
    }
    
    /**
     * Show the list of comments
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String $filter
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request, Blog $blog, $filter='all')
    {
        $page = $request->get('page');
        if(!$page){ $page =1; }
        
        $items = Comment::where('blog_id','=', $blog->id)
            ->withCount('replies');
        $items = $items->paginate($this->pageSize);
        return $this->view( "index", ['records' => $items] );
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
        $this->validate($request, Comment::validationRules());

        Comment::create($request->all());

        # notification
        Notify::success('Comment a été créer avec succès');
        return redirect(route('admin.comment.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Comment $comment)
    {
        return $this->view("show",['comment' => $comment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Comment $comment)
    {
        return $this->view( "edit", ['comment' => $comment] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, Comment::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $comment->update($data);
            return "Record updated";
        }

        $this->validate($request, Comment::validationRules());

        $comment->update($request->all());

        # notification
        Notify::success('Comment a été mise à jour avec succès');
        return redirect(route('admin.comment.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Comment $comment)
    {
        $comment->delete();

        # notification
        Notify::success('Comment a été supprimer avec succès');
        return redirect(route('admin.comment.index'));
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
