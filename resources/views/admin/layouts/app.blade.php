<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title', '') | IEA ADMIN </title>

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}">

    <link href="{{ asset('administrator/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('administrator/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ asset('administrator/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{ asset('administrator/js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">
	
	<!-- dropzone -->
	<link href="{{ asset('administrator/css/plugins/dropzone/basic.css') }}" rel="stylesheet">
    <link href="{{ asset('administrator/css/plugins/dropzone/dropzone.css') }}" rel="stylesheet">
	
	<!-- select2 -->
    <link href="{{ asset('administrator/css/plugins/select2/select2.min.css') }}" rel="stylesheet">
	<link href="{{ asset('administrator/css/plugins/select2/select2.min.css') }}" rel="stylesheet">

    <link href="{{ asset('administrator/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('administrator/css/style.css') }}" rel="stylesheet">
	
	<!-- step -->
	<link href="{{ asset('administrator/css/plugins/steps/jquery.steps.css') }}" rel="stylesheet">
	<!-- Sweet Alert -->
    <link href="{{ asset('administrator/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
	<!--fancybox-->
	<link rel="stylesheet" href="{{ asset('plugin/fancybox/jquery.fancybox.css') }}" type="text/css" media="screen" />
    @yield('custom-css')

</head>

<body>

<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                @include('admin.layouts.menu')
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('admin.layouts.head')

        @yield('breadcrumb')

        <div class="wrapper wrapper-content">
            @yield('content')
        </div>
        @include('admin.layouts.footer')
    </div>

    {{-- Content each Chat --}}
    <div id="small-chat-box" class="small-chat-box fadeInRight animated" osc_id="">
        {{-- head chat --}}
        <div class="heading" id="small-chat-box-heading" draggable="true">
            <small class="chat-date float-right">
                <i class="fa fa-times white-color chat-close"></i>
            </small>
            <span></span>
        </div>
        {{-- content chat --}}
        <div class="content" id="small-chat-box-content">
            @lang('app.txt.no_message_found')
        </div>
        {{-- footer chat --}}
        <div class="form-chat">
            <div class="input-group input-group-sm">
                <input type="hidden" id="_token" value="{{ csrf_token() }}" class="form-control">
                <input type="hidden" id="to_id" class="form-control">
                <textarea id="chat_content" name="chat_content" class="no-resize-bar form-control" rows="3" placeholder="@lang('app.txt.write_message') ..."></textarea>
                <span class="input-group-append">
                    <button
                        class="btn btn-primary" type="button" id="btn_send">@lang('app.btn.send')
                    </button>
                </span>
            </div>
            <span id="error_message" class="text-danger"></span>
        </div>
    </div>

    {{-- Content all Chat --}}
    <div id="small-chat-box-main" class="small-chat-box-main fadeInRight animated">
        {{-- head chat --}}
        <div class="heading" draggable="true" id="small-chat-box-main-heading">
            <small class="chat-date float-right"></small>
            @lang('app.txt.all_messages')
        </div>
        {{-- content chat --}}
        <div class="content" id="small-chat-box-main-content">
            <div class="left">
                <ul style="list-style: none;padding:0px;"></ul>
            </div>
        </div>
        {{-- footer chat --}}
        {{-- <div class="form-chat">
            <div class="input-group input-group-sm">
                <div class="text-center link-block">
                    <a href="{{route('admin.mail.index')}}" class="dropdown-item">
                        <i class="fa fa-envelope"></i> <strong>@lang('app.txt.read_all_messages')</strong>
                    </a>
                </div>
            </div>
        </div> --}}
    </div>

    {{-- show chat bull --}}
    <div id="small-chat">
        <span class="badge badge-warning float-right"></span>
        <a class="open-small-chat-main" href="javascript:void(0)">
            <i class="fa fa-comments"></i>
        </a>
    </div>
    {{-- End Chat --}}

    <div id="right-sidebar" class="animated">
        <div class="sidebar-container">

            <ul class="nav nav-tabs navs-3">
                <li>
                    <a class="nav-link active" data-toggle="tab" href="#tab-1"> Notes </a>
                </li>
                <li>
                    <a class="nav-link" data-toggle="tab" href="#tab-2"> Projects </a>
                </li>
                <li>
                    <a class="nav-link" data-toggle="tab" href="#tab-3"> <i class="fa fa-gear"></i> </a>
                </li>
            </ul>

            <div class="tab-content">


                <div id="tab-1" class="tab-pane active">

                    <div class="sidebar-title">
                        <h3> <i class="fa fa-comments-o"></i> Latest Notes</h3>
                        <small><i class="fa fa-tim"></i> You have 10 new message.</small>
                    </div>

                    <div>

                        <div class="sidebar-message">
                            <a href="#">
                                <div class="float-left text-center">
                                    <img alt="image" class="rounded-circle message-avatar" src="{{ asset('administrator/img/a1.jpg') }}">

                                    <div class="m-t-xs">
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                    </div>
                                </div>
                                <div class="media-body">

                                    There are many variations of passages of Lorem Ipsum available.
                                    <br>
                                    <small class="text-muted">Today 4:21 pm</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="float-left text-center">
                                    <img alt="image" class="rounded-circle message-avatar" src="{{ asset('administrator/img/a2.jpg') }}">
                                </div>
                                <div class="media-body">
                                    The point of using Lorem Ipsum is that it has a more-or-less normal.
                                    <br>
                                    <small class="text-muted">Yesterday 2:45 pm</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="float-left text-center">
                                    <img alt="image" class="rounded-circle message-avatar" src="{{ asset('administrator/img/a3.jpg') }}">

                                    <div class="m-t-xs">
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    Mevolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                    <br>
                                    <small class="text-muted">Yesterday 1:10 pm</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="float-left text-center">
                                    <img alt="image" class="rounded-circle message-avatar" src="{{ asset('administrator/img/a4.jpg') }}">
                                </div>

                                <div class="media-body">
                                    Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the
                                    <br>
                                    <small class="text-muted">Monday 8:37 pm</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="float-left text-center">
                                    <img alt="image" class="rounded-circle message-avatar" src="{{ asset('administrator/img/a8.jpg') }}">
                                </div>
                                <div class="media-body">

                                    All the Lorem Ipsum generators on the Internet tend to repeat.
                                    <br>
                                    <small class="text-muted">Today 4:21 pm</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="float-left text-center">
                                    <img alt="image" class="rounded-circle message-avatar" src="{{ asset('administrator/img/a7.jpg') }}">
                                </div>
                                <div class="media-body">
                                    Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
                                    <br>
                                    <small class="text-muted">Yesterday 2:45 pm</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="float-left text-center">
                                    <img alt="image" class="rounded-circle message-avatar" src="{{ asset('administrator/img/a3.jpg') }}">

                                    <div class="m-t-xs">
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    The standard chunk of Lorem Ipsum used since the 1500s is reproduced below.
                                    <br>
                                    <small class="text-muted">Yesterday 1:10 pm</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="float-left text-center">
                                    <img alt="image" class="rounded-circle message-avatar" src="{{ asset('administrator/img/a4.jpg') }}">
                                </div>
                                <div class="media-body">
                                    Uncover many web sites still in their infancy. Various versions have.
                                    <br>
                                    <small class="text-muted">Monday 8:37 pm</small>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>

                <div id="tab-2" class="tab-pane">

                    <div class="sidebar-title">
                        <h3> <i class="fa fa-cube"></i> Latest projects</h3>
                        <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                    </div>

                    <ul class="sidebar-list">
                        <li>
                            <a href="#">
                                <div class="small float-right m-t-xs">9 hours ago</div>
                                <h4>Business valuation</h4>
                                It is a long established fact that a reader will be distracted.

                                <div class="small">Completion with: 22%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                </div>
                                <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="small float-right m-t-xs">9 hours ago</div>
                                <h4>Contract with Company </h4>
                                Many desktop publishing packages and web page editors.

                                <div class="small">Completion with: 48%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 48%;" class="progress-bar"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="small float-right m-t-xs">9 hours ago</div>
                                <h4>Meeting</h4>
                                By the readable content of a page when looking at its layout.

                                <div class="small">Completion with: 14%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="label label-primary float-right">NEW</span>
                                <h4>The generated</h4>
                                There are many variations of passages of Lorem Ipsum available.
                                <div class="small">Completion with: 22%</div>
                                <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="small float-right m-t-xs">9 hours ago</div>
                                <h4>Business valuation</h4>
                                It is a long established fact that a reader will be distracted.

                                <div class="small">Completion with: 22%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                </div>
                                <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="small float-right m-t-xs">9 hours ago</div>
                                <h4>Contract with Company </h4>
                                Many desktop publishing packages and web page editors.

                                <div class="small">Completion with: 48%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 48%;" class="progress-bar"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="small float-right m-t-xs">9 hours ago</div>
                                <h4>Meeting</h4>
                                By the readable content of a page when looking at its layout.

                                <div class="small">Completion with: 14%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="label label-primary float-right">NEW</span>
                                <h4>The generated</h4>
                                <!--<div class="small float-right m-t-xs">9 hours ago</div>-->
                                There are many variations of passages of Lorem Ipsum available.
                                <div class="small">Completion with: 22%</div>
                                <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                            </a>
                        </li>

                    </ul>

                </div>

                <div id="tab-3" class="tab-pane">

                    <div class="sidebar-title">
                        <h3><i class="fa fa-gears"></i> Settings</h3>
                        <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                    </div>

                    <div class="setings-item">
                    <span>
                        Show notifications
                    </span>
                        <div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example">
                                <label class="onoffswitch-label" for="example">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="setings-item">
                    <span>
                        Disable Chat
                    </span>
                        <div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" name="collapsemenu" checked class="onoffswitch-checkbox" id="example2">
                                <label class="onoffswitch-label" for="example2">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="setings-item">
                    <span>
                        Enable history
                    </span>
                        <div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example3">
                                <label class="onoffswitch-label" for="example3">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="setings-item">
                    <span>
                        Show charts
                    </span>
                        <div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example4">
                                <label class="onoffswitch-label" for="example4">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="setings-item">
                    <span>
                        Offline users
                    </span>
                        <div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox" id="example5">
                                <label class="onoffswitch-label" for="example5">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="setings-item">
                    <span>
                        Global search
                    </span>
                        <div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox" id="example6">
                                <label class="onoffswitch-label" for="example6">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="setings-item">
                    <span>
                        Update everyday
                    </span>
                        <div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example7">
                                <label class="onoffswitch-label" for="example7">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-content">
                        <h4>Settings</h4>
                        <div class="small">
                            I belive that. Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            And typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                            Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mainly scripts -->
<script src="{{ asset('administrator/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('administrator/js/popper.min.js') }}"></script>
<script src="{{ asset('administrator/js/bootstrap.js') }}"></script>
<script src="{{ asset('administrator/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('administrator/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Flot -->
<script src="{{ asset('administrator/js/plugins/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('administrator/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
<script src="{{ asset('administrator/js/plugins/flot/jquery.flot.spline.js') }}"></script>
<script src="{{ asset('administrator/js/plugins/flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('administrator/js/plugins/flot/jquery.flot.pie.js') }}"></script>

<!-- Flot demo data -->
<?php /*?><script src="{{ asset('administrator/js/demo/flot-demo.js') }}"></script><?php */?>

<!-- Peity -->
<script src="{{ asset('administrator/js/plugins/peity/jquery.peity.min.js') }}"></script>
<script src="{{ asset('administrator/js/demo/peity-demo.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('administrator/js/inspinia.js') }}"></script>
<script src="{{ asset('administrator/js/plugins/pace/pace.min.js') }}"></script>

<!-- jQuery UI -->
<script src="{{ asset('administrator/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

<!-- GITTER -->
<script src="{{ asset('administrator/js/plugins/gritter/jquery.gritter.min.js') }}"></script>

<!-- dropzone -->
<script src="{{ asset('administrator/js/plugins/dropzone/dropzone.js') }}"></script>

<!-- Sparkline -->
<script src="{{ asset('administrator/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Sparkline demo data  -->
<script src="{{ asset('administrator/js/demo/sparkline-demo.js') }}"></script>

<!-- ChartJS-->
<script src="{{ asset('administrator/js/plugins/chartJs/Chart.min.js') }}"></script>

<!-- Toastr -->
<script src="{{ asset('administrator/js/plugins/toastr/toastr.min.js') }}"></script>

<!-- jquery select2-->
<script src="{{ asset('administrator/js/plugins/select2/select2.full.min.js') }}"></script>

<!-- jquery validate-->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>


<script>
    $(document).ready(function() {

        let toast = $('.toast');

        setTimeout(function() {
            toast.toast({
                delay: 5000,
                animation: true
            });
            toast.toast('show');

        }, 2200);

        // show list contact chat
        showContact()

        // get unread message
        getUnreadMessage();

        // Update message in 4500 ms
        setInterval(() => {
            to_id = $('#to_id').val();
            
            // get unread message
            getUnreadMessage();

            // show message of selected user
            if(to_id !== ''){
                // showContact();
                showMessageContact(to_id);
            }
        }, 25000);

    });

    $(window).bind("scroll", function () {
        let toast = $('.toast');
        toast.css("top", window.pageYOffset + 20);

    });
	
	
</script>

@if (Session::has('notifier.notice'))
    <?php
    $notif = json_decode(Session::get('notifier.notice'));

    $title = $notif->title;
    $text = isset($notif->text) && $notif->text != '' ? $notif->text : '';
    $type = $notif->type;
    ?>


    <script>
        toastr.options = {
            "icon" : false,
            "closeButton": true,
            "debug": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "400",
            "hideDuration": "1000",
            "timeOut": "7000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        if("{{$type}}" == 'success'){
            toastr.success("{{$text}}" , "{{$title}}")
        }
        if("{{$type}}" == 'warning'){
            toastr.warning("{{$text}}" , "{{$title}}")
        }
        if("{{$type}}" == 'error'){
            toastr.error("{{$text}}" , "{{$title}}")
        }
    </script>
@endif

<script>
    var chatBullUserArray = [];

    $('.open-small-chat-main').click(function(){
        // Hide chat main content
        $('#small-chat-box').removeClass('active');

        // Reset unread count in chat bull main
        $('#small-chat span').html('');
    });

    $('.small-chat-box .chat-close').click(function(){
        osc_id = $('.small-chat-box').attr('osc_id');
        id = osc_id.split('_')[1];
        
        // Hide chat main content
        $('#small-chat-box').toggleClass('active');

        // Remove bull
        $('#'+osc_id).remove();

        // Remove id in array
        removeUserIdChatBullUserArray(id);
    });

    
    function userChatBull(user_id,user_immat){
        var bull = '<a id="osc_'+user_id+'" class="open-small-chat" onclick=chatBull("'+user_id+'","'+user_immat+'") href="javascript:void(0)" style="margin-bottom:1px;" title="'+user_immat+'"><i class="fa fa-user"></i></a>';

        // Hide chat main content
        $('#small-chat-box-main').removeClass('active');
        
        // add chat at bull
        if(!checkChatBullUser(user_id)){
            chatBullUserArray.push(user_id);
            $('#small-chat').append(bull);
        }
        $('.open-small-chat-main i').removeClass('fa-times');
        $('.open-small-chat-main i').addClass('fa-comments');
        
        // show chat content
        $('#small-chat-box').toggleClass('active');
        $('#small-chat-box').attr('osc_id','osc_'+user_id);
        
        // Set chat content user
        $('#small-chat-box-heading span').html(user_immat);
        showMessageContact(user_id);
        $('#to_id').val(user_id);
    };

    function checkChatBullUser(user_id){
        if($.inArray(user_id, chatBullUserArray) !== -1){
            return true;
        }

        return false;
    }

    function removeUserIdChatBullUserArray(user_id){
        chatBullUserArray = $.grep(chatBullUserArray, function(value) {
            return value != user_id;
        });
    }
    
    function chatBull(id,immat){
        var osc_id = $('#small-chat-box').attr('osc_id');

        // Hide chat main content
        $('#small-chat-box-main').removeClass('active');

        // show chat content
        $('#small-chat-box').attr('osc_id','osc_'+id);
        if(osc_id === 'osc_'+id){
            $('#small-chat-box').toggleClass('active');
        }else{
            if(!$('#small-chat-box').hasClass('active')){
                $('#small-chat-box').toggleClass('active');
            }
        }

        // Set chat content user
        $('#small-chat-box-heading span').html(immat);
        showMessageContact(id);
        $('#to_id').val(id);
    }

    function showContact(){
        var showContact = $('#small-chat-box-main-content ul');
        
        $.ajax({
            url: '{{ Auth::user()->isAdmin()?route("admin.ajax.get.list.contact.message"):route("admin.collaborators.admin.ajax.get.list.contact.message") }}',
            type: "GET",
            dataType: "json",
            success:function(data){
                listShowContact = "";
                listContactArray = new Array();
                // set total message
                $('#small-chat-box-main-heading small').html(data.length);
                if(data.length !== 0){
                    for(var i=0; i<data.length; i++){
                        listContactArray.push(data[i].user_id);
                        user_immat = "'"+data[i].immat+"'";

                        listShowContact +=  '<li>'+
                            '<div class="dropdown-messages-box">'+
                                '<a class="dropdown-item float-left" onclick="userChatBull('+data[i].user_id+','+user_immat+')" href="javascript:void(0)" value="'+data[i].user_id+'">'+
                                    '<img alt="image" class="rounded-circle" src="{{asset("images/iea.png")}}">'+
                                '</a>'+
                                '<div class="media-body">'+
                                    data[i].immat+'<br>'+
                                    '<small class="text-muted">'+data[i].dateSend+'</small>'+
                                '</div>'+
                            '</div>'+
                        '</li>'+
                        '<li class="dropdown-divider"></li>';
                    }
                }

                return showContact.html(listShowContact);
            },
            error:function(e){
                console.log(e);
            }
        });
    }

    function showMessageContact(contact_id){
        // var contact_id = $('#to_id').val();
        var datas = {
            'contact_id' : contact_id,
        };
        var showMessage = $('#small-chat-box-content');
        var content= "";

        if(contact_id !== '0'){
            $.ajax({
                url: '{{ Auth::user()->isAdmin()?route("admin.ajax.show.contact.message", ["to_id"=>Auth::user()->id]):route("admin.collaborators.admin.ajax.show.contact.message", ["to_id"=>Auth::user()->id]) }}',
                type: "GET",
                data : datas,
                dataType: "json",
                success : function(dt){
                    
                    if(dt.length !== 0)
                    {
                        for(var i=0; i<dt.length; i++){
                            var fromId = dt[i].from_id;
                            var fromName = dt[i].from_name;
                            var chatingName = dt[i].chating_name;
                            var createdAt = dt[i].created_at;
                            var createdAtSend = dt[i].created_at_send;
                            var message = dt[i].body;
                            var seen = dt[i].seen;
                            var fromRole = dt[i].from_role;
                            var position = fromId!==1?'left':'right';
                            var active = fromId!==1?'active':'';
                            
                            content += '<div class="'+position+'">'+
                                            '<div class="author-name">'+
                                                fromName+' <small class="chat-date">'+createdAtSend+','+seen+
                                                '</small>'+
                                            '</div>'+
                                            '<div class="chat-message '+active+'">'+
                                                message+
                                            '</div>'+
                                        '</div>';
                            
                        }
                    }
                    
                    return showMessage.html(content);
                }
            }); 
        }
        
    }

    function getUnreadMessage(){
        $.ajax({
            url: '{{ Auth::user()->isAdmin()?route("admin.ajax.get.unread.message"):route("admin.collaborators.admin.ajax.get.unread.message") }}',
            type: "GET",
            dataType: "json",
            success:function(data){
                var unreadCountContactArray = new Array();
                var unreadCountMessage = (data.res).length!==0?(data.res).length:'';

                if(!$('#small-chat-box-main').hasClass('active')){
                    $('#small-chat span').html(unreadCountMessage);
                }else{
                    $('#small-chat span').html('');
                }
            },
            error:function(e){
                console.log(e);
            }
        });

        return false;
    }

    $('#btn_send').click(function(event){
        event.preventDefault();
        var datas = {
            _token: $('#_token').val(),
            to_id: $('#to_id').val(),
            content: $('#chat_content').val(),
        };

        // Initialize error message
        $('#error_message').html("");

        // disable button
        $('#btn_send').prop("disabled", true);
                
        $.ajax({
            url: '{{ Auth::user()->isAdmin()?route("admin.ajax.send.message"):route("admin.collaborators.admin.ajax.send.message") }}',
            type: "POST",
            data: datas,
            dataType: "json",
            success:function(data){
                // reset button and content input
                $('#btn_send').prop("disabled", false);
                $('#chat_content').val('');

                if(!$.isEmptyObject(data.error)){
                    // $('#chat_content').val(' ');
                    $('#chat_content').addClass('is-invalid');
                    $('#error_message').html(data.error);
                }
            },
            error:function(e){
                console.log(e);
            }
        });
    });

</script>

@yield('custom-script')
</body>
</html>
