<div class="row border-bottom">
    <nav class="navbar navbar-static-top {{Request::is('*/admin') ? 'white-bg' : ''}}" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Cherchez quelque chose ..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li style="padding: 20px">
                <span class="m-r-sm text-muted welcome-message">Bienvenue dans IEA | e-marketplace.</span>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-envelope"></i>  
					<span class="label label-warning">8</span>
                </a>

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
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell"></i>  <span class="label label-primary">{{\App\Models\Mail::inboxcount(Auth::user()->id)}}</span>
                </a>
                <ul class="dropdown-menu dropdown-messages dropdown-menu-right">
                    @foreach(\App\Models\Mail::inboxlist(Auth::user()->id) as $mail)
                        <li>
                            <div class="dropdown-messages-box">
                                <a class="dropdown-item float-left" href="{{route('admin.mail.index')}}/{{$mail->id}}">
                                    <img alt="image" class="rounded-circle" src="{{$mail->sender->imageUrl()}}">
                                </a>
                                <div class="media-body">
                                    Vous avez reçu une message de la part de <strong>{{ $mail->sender->name}}</strong>. <br>
                                    <small class="text-muted">{{ $mail->created_at ? $mail->created_at->diffForHumans() : '' }}</small>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-divider"></li>
                    @endforeach
                    <li>
                        <div class="text-center link-block">
                            <a href="{{route('admin.mail.index')}}" class="dropdown-item">
                                <i class="fa fa-envelope"></i> <strong>Lire tous les messages</strong>
                            </a>
                        </div>
                    </li>
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