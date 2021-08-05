<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\Category;
use App\Models\ObjectCategory;
use App\Models\Image;
use App\Models\Comment;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class BlogController extends Controller {
    public $viewDir = "admin.blog";
    protected $post_type = 'blog';

    public function index() {
        Blog::regenerateAllAvatar() ;
        $records = Blog::findRequested();
        $status = Blog::groupBy('status')->pluck('status', 'status');
        return $this->view("index", ['records' => $records, 'status' => $status]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create() {
        $categories = Category::all();
        return $this->view("create", ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->middleware('auth');
        $this->middleware('role', ['only' => [
            '1',
            '6',
        ]]);
        
        //$this->validate($request, Blog::validationRules());
        $blog = new Blog();
        if($file=$request->file('image')){
            $image = Image::storeAndSave($file,'blog');
            $blog::regenerateMyAvatar($image) ;
            $blog->image_id = $image->id;
        }
        $slug = $slugOriginal = generateSlug($request->title);
        $i = 1;
        while(Blog::where('slug', $slug)->exists()){
            $slug = $slugOriginal + '-' + $i++;
        }

        // Update order item if order item is affected
        if(Blog::where('view_order', $request->view_order)->exists()){ 
            $countItem = Blog::where('view_order','>=',$request->view_order)->count();
            $item = Blog::select('id')->where('view_order','>=',$request->view_order)->orderBy('view_order','ASC')->get();

            $j=1;
            foreach ($item as $value) {
                Blog::where('id','=',$value->id)->update(['view_order'=>$request->view_order+$j++]);
            }
        }
        
        $blog->slug = $slug;
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->meta_tag = $request->meta_tag;
        $blog->meta_description = $request->meta_description;
        $blog->post_type = $this->post_type;
        $blog->status = 'published';
        $blog->author_id = Auth::user()->id;
        $blog->view_order = $request->view_order;
        $blog->save();
        
        // Add Blog to the selected category
        if($categories = $request->category){
            foreach($categories as $categoryId){
                $row = new ObjectCategory();
                $row->category_id = $categoryId;
                $row->object_id = $blog->id;
                $row->object_type = get_class($blog);
                $row->author_id = Auth::user()->id;
                $row->save();
            }
        }

        // save translation
        $detectLang = getGTranslateLangDetect($request->content);
        $detectLang==='fr'?setTranslate('fr','en',$request->content,'blog',$blog):setTranslate('en','fr',$request->content,'blog',$blog);
        
        //Blog::create($request->all());

        # notification
        Notify::success("L'article a été bien enregistré.");
        return redirect(Auth::user()->isAdmin() ? route('admin.blog.index') : (Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.index'):route('admin.collaborator.admin.blog.index')));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Blog $blog) {
        return $this->view("show", ['blog' => $blog]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Blog $blog) {
        $categories = Category::all();
        $categoryIds = [];
        foreach ($blog->categories as $category) {
            $categoryIds[] = $category->id;
        }
        return $this->view("edit", ['blog' => $blog, 'categories' => $categories,
            'categoryIds' => $categoryIds]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog) {
        if ($request->isXmlHttpRequest()) {
            $data = [$request->name => $request->value];
            $validator = \Validator::make($data, Blog::validationRules($request->name));
            if ($validator->fails())
                return response($validator->errors()->first($request->name), 403);
            $blog->update($data);
            return "Record updated";
        }

        if ($file = $request->file('image')) {
            $image = Image::storeAndSave($file,'blog');
            $blog::regenerateMyAvatar($image) ;
            $blog->image_id = $image->id;
        }

        $slug = $slugOriginal = generateSlug($request->title);
        $i = 1;
        while (Blog::where('slug', $slug)->where('id', '<>', $blog->id)->exists()) {
            $slug = $slugOriginal + '-' + $i++;
        }

        // Update order item if order item is affected
        if($request->old_view_order !== $request->view_order){
            if(Blog::where('view_order', $request->view_order)->exists()){ 
                $countItem = Blog::where('view_order','>=',$request->view_order)->count();
                $oldItemOrder = Blog::select('id')->where('view_order','=',$request->view_order)->first();

                if($request->old_view_order > $request->view_order){
                    $item = Blog::select('id','view_order')->where('view_order','>=',$request->view_order)->orderBy('view_order','ASC')->get();
                    foreach ($item as $value) {
                        Blog::where('id','=',$value->id)->update(['view_order'=>$value->view_order+1]);
                    }
                }else{
                    $item = Blog::select('id','view_order')->where('view_order','>',$request->old_view_order)->orderBy('view_order','ASC')->get();
                    
                    foreach ($item as $value) {
                        Blog::where('id','=',$value->id)->update(['view_order'=>$value->view_order-1]);
                    }
                }
            }
        }

        $blog->slug = $slug;
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->meta_tag = $request->meta_tag;
        $blog->meta_description = $request->meta_description;
        $blog->post_type = $this->post_type;
        $blog->view_order = $request->view_order;
        $blog->status = 'published';
        $blog->save();

        // Delete Old Category
        ObjectCategory::where('object_id', '=', $blog->id)->where('object_type', '=',
            get_class($blog))->delete();
            
        // Add Blog to the selected category
        if($categories = $request->category){
            foreach($categories as $categoryId){
                $row = new ObjectCategory();
                $row->category_id = $categoryId;
                $row->object_id = $blog->id;
                $row->object_type = get_class($blog);
                $row->author_id = Auth::user()->id;
                $row->save();
            }
        }

        // update translation
        updateTranslate('blog',$blog,$request->content);

        # notification
        Notify::success('Blog a été mise à jour avec succès');
        return redirect(Auth::user()->isAdmin() ? route('admin.blog.index') : (Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.index'):route('admin.collaborator.admin.blog.index')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Blog $blog) {
        $this->middleware('auth');
        $this->middleware('role', ['only' => [
            '1',
            '6',
        ]]);
        
        $blog->delete();

        # notification
        Notify::success('Blog a été supprimer avec succès');
        return back();
    }

    protected function view($view, $data = []) {
        return view($this->viewDir . "." . $view, $data);
    }

    /**
     * Archive Blog
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function archive(Request $request, Blog $blog) {
        $this->middleware('auth');
        $this->middleware('role', ['only' => [
            '1',
            '6',
        ]]);

        $blog->status = "archived";
        $blog->save();
        Notify::success('L\'article a été achivé avec succés');
        return back();
    }
    
    /**
    * Publish Blog
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Blog  $blog
    * @return \Illuminate\Http\Response
    */
    public function publish(Request $request,Blog $blog)
    {
        $this->middleware('auth');
        $this->middleware('role', ['only' => [
            '1',
            '6',
        ]]);

        $blog->status = "published";
        $blog->save();
        
        Notify::success("L'article a été publié avec succés");
        return back();
    }
    
    /**
    * Trash Blog
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Blog  $blog
    * @return \Illuminate\Http\Response
    */
    public function trash(Request $request,Blog $blog)
    {
        $this->middleware('auth');
        $this->middleware('role', ['only' => [
            '1',
            '6',
        ]]);

        $blog->status = "trashed";
        $blog->save();
        
        Notify::success("L'article a été ajouté aux corbeilles avec succés");
        return back();
    }
    
    /**
    * Restore Blog
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Blog  $blog
    * @return \Illuminate\Http\Response
    */
    public function restore(Request $request,Blog $blog)
    {
        $this->middleware('auth');
        $this->middleware('role', ['only' => [
            '1',
            '6',
        ]]);

        $blog->status = "pinged";
        $blog->save();
        
        Notify::success("L'article a été restoré avec succés");
        return back();
    }

    public function updateBlogOrder(Request $request){
        $old_view_order = $request->old_view_order;
        $view_order = $request->view_order;
        $id = $request->blog_id;

        // Update order item if order item is affected
        $countItem = Blog::where('view_order','>=',$view_order)->count();
        $oldItemOrder = Blog::select('id')->where('view_order','=',$view_order)->first();
        $i=1;

        if($old_view_order > $view_order){
            $item = Blog::select('id','view_order')->where('view_order','>=',$view_order)->orderBy('view_order','ASC')->get();
            
            foreach ($item as $value) {
                if($i < $old_view_order){
                    Blog::where('id','=',$value->id)->update(['view_order'=>$value->view_order+1]);
                    $i++;
                }else{
                    break;
                }
            }
        }else{
            $item = Blog::select('id','view_order')->where('view_order','>',$old_view_order)->orderBy('view_order','ASC')->get();
            
            foreach ($item as $value) {
                if($i < $view_order){
                    Blog::where('id','=',$value->id)->update(['view_order'=>$value->view_order-1]);
                    $i++;
                }else{
                    break;
                }
            }
            
        }
        

        // Update this order
        Blog::where('id','=',$id)->update(['view_order'=>$view_order]);
        
        # notification
        // return response()->json(['msg'=>'Blog a été mise à jour avec succès']);
        return response()->json(['msg'=>$id, $view_order]);
    }

}
