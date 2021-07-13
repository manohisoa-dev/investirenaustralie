@extends('admin.layouts.app')

@section('title', 'Mails - Edition ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.mails')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.txt.mails')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdmin()?route('admin.mail.index'):route('admin.collaborators.admin.mail.index') }}">@lang('app.txt.lists')</a>
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
                <h5>@lang('app.txt.update_mail', ['mail'=>$mail->subject])</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ Auth::user()->isAdmin()?route('admin.mail.index'):route('admin.collaborators.admin.mail.index')}}/{{$mail->id}}" method="post">

                    {{ csrf_field() }}

                    {{ method_field("PUT") }}
                                                                                                
                            {!! \Nvd\Crud\Form::input( 'subject' )->model($mail)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::textarea( 'content' )->model($mail)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('copied_from','text')->model($mail)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('status','text')->model($mail)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('sender_id','text')->model($mail)->show() !!}
                                                                                                                                                
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> @lang('app.btn.save')</button>

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
            CKEDITOR.replace( 'content' );
        }) ;
    </script>
@endsection
