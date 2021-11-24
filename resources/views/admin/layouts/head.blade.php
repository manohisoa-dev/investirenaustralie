<div class="row border-bottom">
    <nav class="navbar navbar-static-top {{Request::is('*/admin') ? 'white-bg' : ''}}" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            @if(!Auth::user()->isAdminBlog())
                <form role="search" class="navbar-form-custom" action="{{route('admin.product.programme')}}">
                    <input type="hidden" name="{{csrf_token()}}">
                    <div class="form-group">
                        <input type="text" placeholder="@lang('app.txt.head_title_admin')" class="form-control" id="top-search" name="title" style="width: 17rem !important;" value="{{Request::input("title")}}">
                    </div>
                </form>
            @endif
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li style="padding: 20px">
                <span class="m-r-sm text-muted welcome-message">@lang('app.txt.head_welcome_admin') | e-marketplace.</span>
            </li>
            <li class="dropdown">
			@php
				$id_user = Auth::user()->id;
				$nb_new_email = \App\Models\MailUser::where('user_id', '=', $id_user)->count();
			@endphp
                <a class="dropdown-toggle count-info" href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.mail.list',['filter'=>'inbox']):route('admin.mail.list',['filter'=>'inbox'])}}">
                    <i class="fa fa-envelope"></i>  
					<span class="label label-warning">{{$nb_new_email}}</span>
                </a>
				{{--
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="mailbox.html" class="dropdown-item">
                            <div>
                                <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                <span class="float-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <a href="profile.html" class="dropdown-item">
                            <div>
                                <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                <span class="float-right text-muted small">12 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <a href="grid_options.html" class="dropdown-item">
                            <div>
                                <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                <span class="float-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <div class="text-center link-block">
                            <a href="notifications.html" class="dropdown-item">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </li>
                </ul>
				--}}
            </li>
            <li class="dropdown">
				@php
					$messages = \App\Models\Message::where("to_id", Auth::user()->id)
					->join('users', 'users.id','=','messages.from_id')
					->select('messages.*', 'messages.created_at as dt' , 'users.name', 'users.immat', 'users.id as user_id', 'users.role')
					->where('messages.seen', 0)
					->orderBy('created_at' , 'DESC')
					->groupBy('from_id')
					->get();
				@endphp
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell"></i>  
					<span class="label label-primary">{{count($messages)}}</span>
                </a>
                <ul class="dropdown-menu dropdown-messages dropdown-menu-right">
                    @foreach($messages as $msg)
                        <li>
                            <div class="dropdown-messages-box">
                                <a class="dropdown-item float-left" href="javascript:void(0)" onclick="userChatBull('{{$msg->user_id}}','{{$msg->immat}}')">
                                    <img alt="image" class="rounded-circle" src="{{asset("images/iea.png")}}">
                                </a>
                                <div class="media-body" onclick="userChatBull('{{$msg->user_id}}','{{$msg->immat}}')">
                                    {!! trans('app.txt.you_have_received_message_from', ['user'=>$msg->name]) !!} <br>
                                    <small class="text-muted">{{ $msg->created_at ? $msg->created_at->diffForHumans() : '' }}</small>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-divider"></li>
                    @endforeach
                    {{--<li>
                        <div class="text-center link-block">
                            <a href="{{route('admin.mail.index')}}" class="dropdown-item">
                                <i class="fa fa-envelope"></i> <strong>@lang('app.txt.read_all_messages')</strong>
                            </a>
                        </div>
                    </li>--}}
                </ul>
            </li>


            <li>
                <a href="{{ route('logout') }}">
                    <i class="fa fa-sign-out"></i> {{__('app.logout')}}
                </a>
            </li>
            <li>
                <a class="right-sidebar-toggle">
                    <i class="fa fa-tasks"></i>
                </a>
            </li>
        </ul>

    </nav>
</div>