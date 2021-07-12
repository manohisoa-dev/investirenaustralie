<div class="widget widget-simple widget-table">
	<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">@lang('app.table.photo') <span class="column-sorter"></span></th>
                <th scope="col">@lang('app.table.title')/@lang('app.table.content') <span class="column-sorter"></span></th>
                <th scope="col">@lang('app.table.comment') <span class="column-sorter"></span></th>
                <th scope="col">@lang('app.table.meta_tag') <span class="column-sorter"></span></th>
                <th scope="col">@lang('app.table.meta_desc') <span class="column-sorter"></span></th>
                <th scope="col">@lang('app.table.status') <span class="column-sorter"></span></th>
                <th scope="col">@lang('app.table.date') <span class="column-sorter"></span></th>
                <th scope="col">@lang('app.table.actions')</th>
            </tr>
        </thead>
        <tbody>
          @foreach($blogs as $blog) 
            <tr>
                <td>
                    <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.index', ['blog'=>$blog]):route('blog.index', ['blog'=>$blog])}}"><img class="thumb" src="{{$blog->imageUrl(true)}}" width="50"></a>
                <td>
                    <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.index', ['blog'=>$blog]):route('blog.index', ['blog'=>$blog])}}">{{$blog->title}}</a><br>
                     {{$blog->excerpt()}}
                </td>
                <td><a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.comment.list', $blog):route('admin.comment.list', $blog)}}">{{$blog->comments_count}}</a></td>
                <td>{{$blog->meta_tag}}</td>
                <td>{{$blog->meta_description}}</td>
                <td>
                     <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.list', ['filter'=>$blog->status]):route('admin.blog.list', ['filter'=>$blog->status])}}">
                         @if($blog->status=='published')
                         <span class="label label-success">{{$blog->status}}</span>
                         @else
                         <span class="label label-warning">{{$blog->status}}</span>
                         @endif
                     </a>
                </td>
                <td>{{$blog->created_at->diffForHumans()}}</td>
                <td>
                    <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.edit', $blog):route('admin.blog.edit', $blog)}}" class="btn btn-small btn-default btn-delete">@lang('app.btn.edit')</a>
                 @if($blog->status=='pinged' || $blog->status=='archived')
                    <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.publish', $blog):route('admin.blog.publish', $blog)}}" class="btn btn-small btn-success btn-publish">@lang('app.btn.publish')</a>
                    <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.trash', $blog):route('admin.blog.trash', $blog)}}" class="btn btn-small btn-info btn-trash">@lang('app.btn.trash')</a>
                 @elseif($blog->status=='trashed')
                    <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.restore', $blog):route('admin.blog.restore', $blog)}}" class="btn btn-small btn-info btn-restore">Restore</a>
                 @endif
                 @if($blog->status=='published')
                    <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.archive', $blog):route('admin.blog.archive', $blog)}}" class="btn btn-small btn-default  btn-archive">@lang('app.btn.archive')</a>
                    <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.trash', $blog):route('admin.blog.trash', $blog)}}" class="btn btn-small btn-info btn-trash">@lang('app.btn.trash')</a>
                 @endif
                    <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.delete', $blog):route('admin.blog.delete', $blog)}}" class="btn btn-small btn-warning btn-delete">@lang('app.btn.delete')</a>
                </td>
            </tr>
           @endforeach
        </tbody>
    </table>
	</div>
</div>
