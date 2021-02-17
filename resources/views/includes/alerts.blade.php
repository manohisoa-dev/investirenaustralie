@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>@lang('app.txt.probleme.survenu')</strong>
    <br><br>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(Session::has('info')) 
<div class="alert alert-info alert-dismissible fade show col-lg-12 m-40px-t" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    <strong>{!!Session::get('info')!!}</strong> 
</div>
@endif

@if(Session::has('error')) 
<div class="alert alert-danger alert-dismissible fade show col-lg-12 m-40px-t" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    <strong>{!!Session::get('error')!!}</strong> 
</div>
@endif

@if(Session::has('warning')) 
<div class="alert alert-warning alert-dismissible fade show col-lg-12 m-40px-t" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    <strong>{!!Session::get('warning')!!}</strong> 
</div>
@endif

@if(Session::has('success')) 
<div class="alert alert-success alert-dismissible fade show col-lg-12 m-40px-t" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    <strong>{!!Session::get('success')!!}</strong> 
</div>
@endif