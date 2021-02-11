<div class="property clearfix">
    <a href="{{route('v2.'.\App\User::find(Auth::id())->roleUser->role_initial.'.mail.index', $mail)}}" class="pull-right submit-btn btn btn-default" data-hover="@lang('app.btn.view')" title="@lang('app.btn.view')"><i class="fa fa-eye"></i></a>
    <a href="{{route('v2.'.\App\User::find(Auth::id())->roleUser->role_initial.'.mail.delete', $mail)}}" class="pull-right submit-btn btn btn-default" data-hover="@lang('app.btn.delete')" title="@lang('app.btn.delete')"><i class="fa fa-trash-alt"></i></a>
    <h6 class="entry-title"> <a href="{{route('v2.'.\App\User::find(Auth::id())->roleUser->role_initial.'.mail.index',['mail'=>$mail])}}">{!! $mail->subject !!}</a></h6>
    <p>{{$mail->content}}</p>
</div>