@if (count($errors) > 0)
    <div class="row">
        <div class="alert alert-danger">
            <strong>Whoops! Something went wrong!</strong>
            <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@if(Session::has('info'))
    <div class="row">
        <div class="alert alert-info">
            <strong>{!!Session::get('info')!!}</strong>
        </div>
    </div>
@endif

@if(Session::has('error'))
    <div class="row">
        <div class="alert alert-danger">
            <strong>{!!Session::get('error')!!}</strong>
        </div>
    </div>

@endif

@if(Session::has('warning'))
    <div class="row">
        <div class="alert alert-warning">
            <strong>{!!Session::get('warning')!!}</strong>
        </div>
    </div>
@endif

@if(Session::has('success'))
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                {!!Session::get('success')!!}
            </div>
        </div>
    </div>
@endif