@extends('admin.layouts.app')

@section('title', 'Model Message - Edition ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.titre.modele_message')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.titre.modele_message')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdmin()?route('admin.model-message.index'):route('admin.collaborators.admin.model-message.index') }}">
					@lang('app.txt.lists')
				</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.editing')</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>@lang('app.txt.edit_model_message') : {{$modelMessage->titre}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('admin.model-message.index')}}/{{$modelMessage->id}}" method="post">

                    {{ csrf_field() }}

                    {{ method_field("PUT") }}
                                                                                                
					{!! \Nvd\Crud\Form::input('titre','text')->model($modelMessage)->show() !!}
																
					<div class="form-group">
						<label for="contenu">@lang('app.message')</label>
						<textarea name="message" id="contenu" class="form-control">{!! $modelMessage->message !!}</textarea>
					</div>                                                 
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Enregistrer</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
	<script src="{{asset('administrator/plugins/ckeditor/ckeditor.js')}}"></script>
	<script>
        $(document).ready(function(){
            CKEDITOR.replace( 'contenu' );
		});
	</script>
@endsection
