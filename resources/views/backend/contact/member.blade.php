@extends('layouts.backend')

@section('subcontent')
<!-- Section -->
<div class="col-lg-8 col-xl-9">
    <div class="profile-content-area m-40px-tb card card-body">
        <div class="border-bottom-0 border-color-dark-gray m-15px-b p-15px-b">
            <h5>{{$title}}</h5>
            <div class="row">
                <div class="col-md-12 m-10px-tb">
                    <div class="media">
                        <div class="media-body p-15px-l lh-normal">

                            <form id="formContact" data-form-output="form-output-global" data-form-type="contact" method="post" action="{{$action}}">
                                {{ csrf_field() }}
                                <input type="hidden" id="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" id="to_id" value="@if($role==='admin') 1  @elseif($role==='afa'){{Auth::user()->afa_id}}@else {{ Auth::user()->apl_id }} @endif">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-primary">
                                            <div class="panel-body p-10px-t p-20px-lr border-top-1 border-left-1 border-bottom-1 border-right-1 border-color-gray">
                                                <ul class="chat">
                                                    <div id="show_message"></div>
                                                </ul>
                                            </div>
                                            <div class="panel-footer p-25px-t">
                                                <div class="input-group">
                                                    <textarea id="content" name="content" class="no-resize-bar form-control" rows="2" placeholder="@lang('app.txt.write_message') ..."></textarea>
                                                    <span class="input-group-btn">
                                                        <button class="m-btn m-btn-warning btn-sm" id="btn_send">
                                                            @lang('app.btn.send')</button>
                                                    </span>
                                                </div>
                                                <span id="error_message" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Section -->
@endsection

@push('script')
    <style>
        .chat
        {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .chat li
        {
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px dotted #B3A9A9;
        }

        .chat li.left .chat-body
        {
            margin-left: 60px;
        }

        .chat li.right .chat-body
        {
            margin-right: 60px;
        }


        .chat li .chat-body p
        {
            margin: 0;
            color: #777777;
        }

        .panel .slidedown .glyphicon, .chat .glyphicon
        {
            margin-right: 5px;
        }

        .panel-body
        {
            overflow-y: scroll;
            height: 450px;
        }

    </style>
    <script>
        $(document).ready(function  (){
            var scroll=$('.panel-body');

            // Show message
            showMessages();
            
            // Show recent message
            showRecentMessage();
            
            function showMessages(){
                var showMessage = $('#show_message');
                var content= "";

                $.ajax({
                    url : '{{ route("get.message", ["role"=>$role]) }}',
                    method : 'get',
                    dataType : 'json',
                    success : function(dt){

                        if(dt.length !== 0)
                        {
                            for(var i=0; i<dt.length; i++){
                                var fromId = dt[i].from_id;
                                var fromImmat = dt[i].from_immat;
                                var fromName = dt[i].from_name;
                                var chatingName = dt[i].chating_name;
                                var createdAt = dt[i].created_at;
                                var createdAtSend = dt[i].created_at_send;
                                var message = dt[i].body;
                                var seen = dt[i].seen;


                                if(dt[i].from_id !== {{ Auth::user()->id }}){

                                    content += '<li class="left clearfix">'+
                                            '<span class="chat-img pull-left">'+
                                                '<img src="http://placehold.it/50/555658/fff&text='+(fromName.charAt(0)).toUpperCase()+'" alt="User Avatar" class="img-circle" />'+
                                            '</span>'+
                                            '<div class="chat-body clearfix">'+
                                                '<div class="header">'+
                                                    '<strong class="primary-font">'+fromImmat+'</strong> <small class="pull-right text-muted">'+
                                                    '<span class="glyphicon glyphicon-time"></span><i>'+createdAtSend+', '+seen+'</i></small>'+
                                                '</div>'+
                                                '<p class="pull-left p-10px-t">'+
                                                    message +
                                                '</p>'+
                                            '</div>'+
                                        '</li>';
                                }else{
                                    content += '<li class="right clearfix">'+
                                            '<span class="chat-img pull-right">'+
                                                '<img src="http://placehold.it/50/AE4435/fff&text='+(fromName.charAt(0)).toUpperCase()+'" alt="User Avatar" class="img-circle" />'+
                                            '</span>'+
                                            '<div class="chat-body clearfix">'+
                                                '<div class="header">'+
                                                    '<small class=" text-muted"><span class="glyphicon glyphicon-time"></span><i>'+createdAtSend+', '+seen+'</i></small>'+
                                                    '<strong class="pull-right primary-font"> {{ Auth::user()->immat }} </strong>'+
                                                '</div>'+
                                                '<p class="pull-right p-10px-t">'+
                                                    message +
                                                '</p>'+
                                            '</div>'+
                                        '</li>';
                                }
                                
                            }
                        }else{
                            content = '<li class="center clearfix">'+
                                            '<div class="chat-body clearfix">'+
                                                '<p class="text-center p-50px-t">'+
                                                    '<div class="p-25px text-center">'+
                                                        '<div class="avatar-80 border-radius-50 d-inline-block">'+
                                                            '<img src="@if($role!=="admin") @if($role==="apl") {{  Auth::user()->hasApl()?\App\Models\User::find(Auth::user()->apl_id)->imageUrl():'' }} @else {{  Auth::user()->hasAfa()?\App\Models\User::find(Auth::user()->afa_id)->imageUrl():'' }} @endif @else {{ \App\Models\User::where("role",1)->first()->imageUrl() }} @endif" title="" alt="">'+
                                                        '</div>'+
                                                        '<h6 class="font-w-500 m-15px-t m-0px"><span class="font-w-700"> @if($role=="admin") {{ App\Models\User::where("id",1)->first()->name }} @elseif($role=="afa") {{ App\Models\User::where("id",Auth::user()->afa_id)->first()->name }} @else {{ App\Models\User::where("id",Auth::user()->apl_id)->first()->name }} @endif </span></h6>'+
                                                        '<span class="font-small"></span>'+
                                                        '<div class="p-10px-t">'+
                                                            '<span class="font-small"><i> {{ trans("app.txt.welcome_chat") }} </i></span>'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</p>'+
                                            '</div>'+
                                        '</li>';
                        }
                        return showMessage.html(content);

                    }
                });

            }

            // Reload show message
            setInterval(() => {
                showMessages()
            }, 4500);


            function showRecentMessage(){
                scroll.animate({scrollTop: scroll.prop("scrollHeight")});
                scroll.animate({scrollTop:$(document).height()}, 'slow');

                return false;
            }
            
        
            $('#btn_send').click(function(event){
                event.preventDefault();

                var formData = $('#formContact').serialize();
                var thisHtml = $(this).html();

                // Initialize error message
                $('#error_message').html("");

                // disable button
                $(this).prop("disabled", true);
                // add spinner to button
                $(this).html(
                    `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
                );

                $.ajax({
                    url: '{{ $action }}',
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success:function(data){
                        // reset button
                        $('#btn_send').prop("disabled", false);
                        $('#btn_send').html(thisHtml);

                        if($.isEmptyObject(data.error)){
                            $('#formContact')[0].reset();
                            console.log(data.success);
                        }else{
                            $('#content').addClass('is-invalid');
                            $('#error_message').html(data.error);
                        }
                    },
                    error:function(e){
                        console.log(e);
                    }
                });
            });

            $('#content').focus(function(){
                $('#content').removeClass('is-invalid');
                $('#error_message').html('');

                return false;
            })

            function printErrorMsg (msg) {
                $(".print-msg").addClass('alert-danger');
                $(".print-msg").removeClass('alert-success');
                $(".print-msg").find("ul").html('');
                $(".print-msg").css('display','block');
                $.each( msg, function( key, value ) {
                    $(".print-msg").find("ul").append('<li>'+value+'</li>');
                });
            }

            function printSuccessMsg (msg) {
                $(".print-msg").addClass('alert-success');
                $(".print-msg").removeClass('alert-danger');
                $(".print-msg").find("ul").html('');
                $(".print-msg").css('display','block');
                $(".print-msg").find("ul").append('<li>'+msg+'</li>');
            }
        });
        
    </script>    
@endpush
