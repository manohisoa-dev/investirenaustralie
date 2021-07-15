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
                                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="panel panel-primary">
                                            <div style="background: #F1F6FD; height:550px;" class="panel-body border-top-1 border-left-1 border-bottom-1 border-right-1 border-color-gray">
                                                <div id="show_contact"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="panel panel-primary">
                                            <div id="panel-show-message-default">
                                                <div class="center chat-body clearfix">
                                                    <p class="text-center p-50px-t">
                                                        <div class="p-25px text-center">
                                                            <div class="avatar-80 border-radius-50 d-inline-block">
                                                                <img src="{{ asset("images/ico/chat.png") }}" title="" alt="">
                                                            </div>
                                                            <h6 class="font-w-500 m-15px-t m-0px"><span class="font-w-700">  </span></h6>
                                                            <span class="font-small"></span>
                                                            <div class="p-10px-t">
                                                                <span class="font-small"><i> {{ trans("app.txt.welcome_your_chat") }} </i></span>
                                                            </div>
                                                        </div>
                                                    </p>
                                                </div>
                                            </div>
                                            
                                            <div id="panel-show-message" hidden>
                                                <div class="panel-body p-10px-t p-20px-lr border-top-1 border-left-1 border-bottom-1 border-right-1 border-color-gray">
                                                    <ul class="chat">
                                                        <div id="show_message"></div>
                                                    </ul>
                                                </div>
                                                <div class="panel-footer p-25px-t">
                                                    <div class="input-group">
                                                        @if ($role === 'afa')
                                                            <input type="hidden" name="to_id" id="to_id" value="0">
                                                        @endif
                                                        <textarea id="content" name="content" class="no-resize-bar form-control" rows="2" placeholder="@lang('app.txt.write_message') ..." disabled></textarea>
                                                        <span class="input-group-btn">
                                                            <button class="m-btn m-btn-warning btn-sm" id="btn_send" disabled>
                                                                @lang('app.btn.send')
                                                            </button>
                                                        </span>
                                                    </div>
                                                    <span id="error_message" class="text-danger"></span>
                                                </div>
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
            var listContactArray = new Array();
            var contact_id = 0;
            

            // Show list contact
            showContact();

            // Show unread message count in left sidebar
            showUnreadCount();
            
            // Show message
            // showMessageContact();

            // Show recent message
            showRecentMessage();

            // Update show list contact and unread message count
            setInterval(() => {
                showContact();
            }, 1500);

            setInterval(() => {
                showUnreadCount();
            }, 2500);

            setInterval(() => {
                contact_id = $('#to_id').val();
                // showContact();
                // showUnreadCount();
                showMessageContact(contact_id);
            }, 4500);


            $('#show_contact').on('click','.btn-select-contact',function(){
                var contactId = $(this).attr('value');
                contact_id = contactId;

                $('#show_message').html('');
                $('#panel-show-message-default').attr('hidden','hidden');
                $('#panel-show-message').removeAttr('hidden');
                $('#formContact #to_id').val(contactId);

                showMessageContact(contact_id);       
                showRecentMessage();
            });


            function showMessageContact(contact_id){
                // var contact_id = $('#to_id').val();
                var datas = {
                    'contact_id' : contact_id,
                };
                var showMessage = $('#show_message');
                var content= "";

                if(contact_id !== '0'){
                    $.ajax({
                        url: '{{ route("show.contact.message", ["to_id"=>Auth::user()->id]) }}',
                        type: "GET",
                        data : datas,
                        dataType: "json",
                        success : function(dt){
                            // Enabled input content and button send message
                            $('#content').removeAttr('disabled');
                            $('#btn_send').removeAttr('disabled');

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


                                    if(dt[i].from_id !== {{ Auth::user()->id }}){

                                        content += '<li class="left clearfix">'+
                                                '<span class="chat-img pull-left">'+
                                                    '<img src="http://placehold.it/50/555658/fff&text='+(fromName.charAt(0)).toUpperCase()+'" alt="User Avatar" class="img-circle" />'+
                                                '</span>'+
                                                '<div class="chat-body clearfix">'+
                                                    '<div class="header">'+
                                                        '<strong class="primary-font">'+fromName+'</strong> <small class="pull-right text-muted">'+
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
                                                        '<strong class="pull-right primary-font"> {{ Auth::user()->name }} </strong>'+
                                                    '</div>'+
                                                    '<p class="pull-right p-10px-t">'+
                                                        message +
                                                    '</p>'+
                                                '</div>'+
                                            '</li>';
                                    }
                                    
                                }
                            
                                return showMessage.html(content);

                            }else{
                                content = '';
                                $('#panel-show-message-default').removeAttr('hidden');
                                $('#panel-show-message').attr('hidden','hidden');
                                $('#to_id').val('0');
                            }

                            return showMessage.html(content);
                        }
                    }); 
                }
                
            }
            

            function showUnreadCount(){

                $.ajax({
                    url: '{{ route("get.unread.count.message.contact") }}',
                    type: "GET",
                    dataType: "json",
                    success:function(data){
                        var unreadCountContactArray = new Array();

                        $.each(data, function(key,val){
                            unreadCountContactArray.push(val.from_id);
                        });

                        for(var i=0; i<data.length; i++){ 
                            var contact_id = data[i].from_id;
                            var unreadCount = $('#'+contact_id);
                            
                            $.each(listContactArray, function(k,v) {
                                if ($.inArray(v, unreadCountContactArray) !== -1) {
                                    unreadCount.html(data[i].count);
                                } else {
                                    $('#'+v).html('');
                                }
                            });
                        }
                    },
                    error:function(e){
                        console.log(e);
                    }
                });

                return false;
            }

            
            function showContact(){
                var showContact = $('#show_contact');
                
                $.ajax({
                    url: '{{ route("get.list.contact.message") }}',
                    type: "GET",
                    dataType: "json",
                    success:function(data){
                        listShowContact = "";
                        listContactArray = new Array();

                        if(data.length !== 0){
                            for(var i=0; i<data.length; i++){
                                listContactArray.push(data[i].user_id);

                                listShowContact +=  '<div class="list-group">'+
                                                    '<a href="javascript:void(0)" value="'+data[i].user_id+'" id="contact-'+data[i].user_id+'" class="btn-select-contact list-group-item list-group-item-action flex-column align-items-start">'+
                                                        '<div class="d-flex w-100 justify-content-between">'+
                                                        '<h5 class="mb-1">'+data[i].name+'</h5>'+
                                                        '<small><span id="'+data[i].user_id+'" class="badge badge-pill badge-primary"></span></small>'+
                                                        '</div>'+
                                                        // '<p class="mb-1"></p>'+
                                                        '<p class="mb-1">'+data[i].user_role+', <small>'+data[i].dateSend+'</small></p>'+
                                                    '</a>'+
                                                '</div>';                                  
                            }
                        }

                        return showContact.html(listShowContact);
                    },
                    error:function(e){
                        console.log(e);
                    }
                });
            }


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
                            $('#content').val(' ');
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
        })
        
    </script>    
@endpush
