<div class="property clearfix">
    <a href="javascript:void(0)" onclick="delete_email({{$mail->id}})" class="pull-right submit-btn btn btn-default" data-hover="@lang('app.btn.delete')" title="@lang('app.btn.delete')"><i class="fa fa-trash-alt text-danger"></i></a>
    <a href="{{route(App\Models\User::find(Auth::id())->roleUser->role_initial.'.mail.index', $mail)}}" class="pull-right submit-btn btn btn-default" data-hover="@lang('app.btn.view')" title="@lang('app.btn.view')"><i class="fa fa-eye"></i></a>
    <h6 class="entry-title"> <a href="{{route(App\Models\User::find(Auth::id())->roleUser->role_initial.'.mail.index',['mail'=>$mail])}}">{!! $mail->subject !!}</a></h6>
    <p>{{str_limit(strip_tags($mail->content),"100","...")}}</p>
</div>