@extends('layouts.backend')

@section('style')
    <link rel="stylesheet" href="{{ asset('style/timeline.css') }}">    
@endsection

@section('subcontent')

    <div class="profile-content-area m-40px-tb">
        <div class="card m-40px-b">
            <div class="card-header">
                <div class="row">
                    <div class="col-5 col-lg-8">
                        <span class="h6 font-w-500">@lang('afa.folders.title')</span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered" style="font-size:12px">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>File name</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (sizeOf($records)!==0)
                            @foreach($records as $index =>$record)
                                <tr>
                                    <td>
                                        @if (@getimagesize(App\Models\Product::whereId($record->product_id)->first()->imageUrl()))
                                            <a href="{{route('admin.product.index')}}/{{$record->id}}">
                                                <img src="{{App\Models\Product::whereId($record->product_id)->first()->imageUrl()}}" class="img-responsive" style="height:50px" />
                                            </a>
                                        @else
                                            <a href="{{route('admin.product.index')}}/{{$record->id}}">
                                                <img class="img-responsive" src="{{asset('img/500x500.jpg')}}" style="height:50px">
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{ App\Models\Product::whereId($record->product_id)->first()->title }}</td>
                                    <td>
                                        {{ sizeOf($record)!==0?'*'.trans('app.txt.conjunction_agreement'):'' }} <br>
                                        {{ sizeOf($mandatesearch)!==0?($index<sizeOf($mandatesearch)?'*'.trans('app.txt.research_mandate'):''):'' }}
                                    </td>
                                    <td>
                                        {{ sizeOf($record)!==0?'*'.$record->file_name:'' }} <br>
                                        {{ sizeOf($mandatesearch)!==0?($index<sizeOf($mandatesearch)?'*'.$mandatesearch[$index]->file_name:''):'' }}
                                    </td>
                                    <td>
                                    {{-- @if($record->status=='0') --}}
                                    {{-- if dossiier is current --}}
                                        <span class="badge badge-pill badge-info white-color">@lang('app.txt.file.current')</span>
                                    {{-- @else --}}
                                        {{-- if dossiier is closed --}}
                                        {{-- <span class="badge badge-pill badge-success white-color">@lang('afa.folders.status.finalized')</span> --}}
                                    {{-- @endif --}}
                                    </td>
                                    <td align="center">
                                        <a href="javascript:void(0)" onclick="showTimeline({{App\Models\DossierTransaction::where('product_id','=',$record->product_id)->where('user_id','=',$record->from_id)->first()}},{{App\Models\Product::whereId($record->product_id)->first()}},{{$record}},{{$index<sizeOf($mandatesearch)?$mandatesearch[$index]:''}})" title="Show timeline for this product" class="">
                                            <i class="fa fa-eye"></i>
                                        </a>&nbsp;
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="6">
                                    <small>@lang('app.txt.no_records_to_display')</small>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal to show timeline each CA folder -->
    <div id="showTimelineModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content white-bg">
                <div class="modal-header border-radius-0" style="background-color: #AE4435 !important;">
                    <h4 class="modal-title white-color"></h4>
                </div>
                <div class="modal-body">
                
                </div>
                <div class="modal-footer">
                    <a type="button" class="m-btn m-btn-theme" href="javascript:void(0)" data-dismiss="modal" id="btn_continue">@lang('app.btn.ok')</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
	<script src="{{ asset('administrator/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
	<script src="{{ asset('/js/jquery-dateFormat.min.js') }}"></script>
    
    <script type="text/javascript">
        var conjAgr = [];

        function showTimeline(doss,prod,ca,mr){
            var content = $('#showTimelineModal .modal-body');
            var title = 'N° Trans : '+doss.numero+' | '+prod.title+' ('+prod.reference+')';

            content.html();
            conjAgr = ca;

            // Set timeline title modal
            $('#showTimelineModal .modal-title').html(title);

            // set timeline data
            if(mr===undefined){
                mr= [];
                mr['created_at']='null',
                mr['updated_at']='null',
                mr['path']='null',
                mr['status']='null',
                mr['file_name']='';  
            }
            content.html(timelineContent(ca,mr));

            // show timeline
            $('#showTimelineModal').modal('show');
        }

        function timelineContent(ca,mr){
            var origin   = window.location.origin;
            var dayCreate = $.format.prettyDate(ca.created_at);
            var dateCreate = $.format.date(ca.created_at, 'yyyy MMM dd');
            var dayUpdate = $.format.prettyDate(ca.updated_at);
            var dateUpdate = $.format.date(ca.updated_at, 'yyyy MMM dd');
            var downloadLink = origin+'/'+ca.path;
            var status = ca.status;
            var disabledLink = status!==0?'disabled':'';
            var stepStatus = status!==0?'<i class="badge badge-pill badge-success white-color">@lang("app.txt.finalized")</i>':'<i class="badge badge-pill badge-danger white-color">@lang("afa.folders.status.to_download")</i>';
            var textBtnUpload = status!==0?'File sent':'Upload file';
            var fileName = status!==0?ca.file_name:'';
            var statusMr = mr.status;
            var dayCreateMr = mr.created_at!=='null'? (statusMr===0?'':$.format.prettyDate(mr.created_at)) :'';
            var dateCreateMr = mr.created_at!=='null'? (statusMr===0?'':$.format.date(mr.created_at, 'yyyy MMM dd')) :'';
            var dayUpdateMr = mr.updated_at!=='null'? (statusMr===0?'':$.format.prettyDate(mr.updated_at)) :'';
            var dateUpdateMr = mr.updated_at!=='null'? (statusMr===0?'':$.format.date(mr.updated_at, 'yyyy MMM dd')) :'';
            var downloadLinkMr = origin+'/uploads/pdf/transaction/'+mr.file_name;
            var disabledLinkMr = statusMr===0?'hidden':(statusMr==='null'?'disabled':'');
            var stepStatusMr = statusMr!==0?(statusMr!=='null'?'<i class="badge badge-pill badge-success white-color">@lang("app.txt.finalized")</i>':'{{ trans("app.txt.not_available") }}'):'<i class="badge badge-pill badge-info white-color">@lang("app.waiting")</i>';
            var textBtnUploadMr = statusMr!==0?'File sent':'Upload file';
            var fileNameMr = statusMr!==0?mr.file_name:'';
            var content = '<div class="profile-content-area m-40px-tb">'+
                '<div class="card m-40px-b">'+
                    '<div class="card-body">'+
                        '<div class="ibox-content" id="ibox-content">'+
                            '<div id="vertical-timeline" class="vertical-container dark-timeline center-orientation">'+
                                '<div class="vertical-timeline-block">'+
                                    '<div class="vertical-timeline-icon grenate-bg">'+
                                        '<i class="fa fa-file"></i>'+
                                    '</div>'+
                                    '<div class="vertical-timeline-content">'+
                                        '<h2>CONJUNCTION AGREEMENT</h2>'+
                                        '<p>Download the conjunction agreement.'+
                                        '</p>'+
                                        '<a href="'+downloadLink+'" class="m-btn m-btn-sm m-btn-theme2nd" '+disabledLink+'> Download</a>'+
                                        '<span class="vertical-date">'+
                                            dayCreate+'<br/>'+
                                            '<small>'+dateCreate+'</small>'+
                                        '</span>'+
                                        '<span class="col-lg-12 text-right"><small><b>@lang("app.status") : </b>'+stepStatus+'</small></span>'+
                                    '</div>'+
                                '</div>'+

                                '<div class="vertical-timeline-block">'+
                                    '<div class="vertical-timeline-icon black-bg">'+
                                        '<i class="fa fa-paper-plane"></i>'+
                                    '</div>'+
                                    '<div class="vertical-timeline-content">'+
                                        '<h2>SEND FINALIZED CONJUNCTION AGREEMENT</h2>'+
                                        '<p>Send the finalized conjunction agreement.</p>'+
                                        '<button href="javascript:void(0)" class="m-btn m-btn-sm m-btn-theme float-right" id="btnUploadFile" onclick="uploadFile('+ca.id+')" value="'+ca.id+'" '+disabledLink+'> '+textBtnUpload+' </button>'+
                                        '<span id="spnFilePath">'+fileName+'</span>'+
                                        '<form id="formSendCaFile">'+
                                            '<input type="file" id="FileUpload1" onchange="fileUploadChange('+ca.id+')" name="file_ca" style="display: none" />'+
                                        '</form>'+
                                        '<span class="vertical-date">'+
                                            dayUpdate+'<br/>'+
                                            '<small>'+dateUpdate+'</small>'+
                                        '</span>'+
                                        '<span class="col-lg-12 text-right"><small><b>@lang("app.status") : </b>'+stepStatus+'</small></span>'+
                                    '</div>'+
                                '</div>'+

                                '<div class="vertical-timeline-block">'+
                                    '<div class="vertical-timeline-icon grenate-bg">'+
                                        '<i class="fa fa-download"></i>'+
                                    '</div>'+
                                    '<div class="vertical-timeline-content">'+
                                        '<h2>RESERCH MANDATE</h2>'+
                                        '<p>Download the reseach mandate.'+
                                        '</p>'+
                                        '<a href="'+downloadLinkMr+'" class="m-btn m-btn-sm m-btn-theme2nd" '+disabledLinkMr+'> Download</a>'+
                                        '<span class="vertical-date">'+
                                            dayUpdateMr+'<br/>'+
                                            '<small>'+dateUpdateMr+'</small>'+
                                        '</span>'+
                                        '<span class="col-lg-12 text-right"><small><b>@lang("app.status") : </b>'+stepStatusMr+'</small></span>'+
                                    '</div>'+
                                '</div>'+

                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>';

            return content;
        }

        $(function () {
            var fileupload = $("#FileUpload1");
            var filePath = $("#spnFilePath");
            var button = $("#btnUploadFile");
            var folderId = button.val();
            var buttonsend = '<button type="button" class="m-btn m-btn-sm m-btn-theme4rd" onclick="sendFile('+folderId+')" title={{trans("app.btn.send")}} id="btnSendFile"><i class="fa fa-paper-plane"></i></button>';

            button.click(function () {
                fileupload.change(function () {
                    var fileName = $(this).val().split('\\')[$(this).val().split('\\').length - 1];
                    filePath.html("<b>Selected File: </b>" + fileName +" " +buttonsend);
                });
            });
        });

        function uploadFile(){
            var fileupload = $("#FileUpload1");
            var filePath = $("#spnFilePath");
            var button = $("#btnUploadFile");
            var folderId = button.val();
            var buttonsend = '<button type="button" class="m-btn m-btn-sm m-btn-theme4rd" onclick="sendFile('+folderId+')" id="btnSendFile"><i class="fa fa-paper-plane"></button>';

            fileupload.click();
        }

        function fileUploadChange(folderId){
            var fileName = $('#FileUpload1').val().split('\\')[$('#FileUpload1').val().split('\\').length - 1];
            var filePath = $("#spnFilePath");
            var button = $("#btnUploadFile");
            var buttonsend = '<button type="button" class="m-btn m-btn-sm m-btn-theme4rd" onclick="sendFile('+folderId+')" id="btnSendFile"><i class="fa fa-paper-plane"></button>';
                filePath.html("<b>Selected File: </b>" + fileName +" " +buttonsend);
        }

        function sendFile(caId){
            var fileToUpload = new FormData();
            var mrToId = conjAgr.from_id;
            var idProduct = conjAgr.product_id;

            // show loading icon
            loadingPage();

            fileToUpload.append( 'file_ca' , $( '#FileUpload1' )[0].files[0] );

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({               
                url: '{{ route("afa.dossier.upload_ca") }}',
                data: fileToUpload,
                processData: false,
                contentType: false,
                type: 'POST',
                dataType:'json',
                enctype: 'multipart/form-data',
                success: function( data ){
                    // hide loading icon
                    stopLoadingPage();

                    if(data.response == 'false'){
					swal("Upload Conjunction Agreement", "Upload error! Choose a right format .pdf", "error");
                    }else{
                        // Change ca status to 1: ca finalized
                        updateCaTable(caId);

                        // show loading icon
                        loadingPage();

                        swal({
                            title: "Upload Conjunction Agreement", 
                            text: "Conjunction Agreement Sent", 
                            type: "success"
                            },
                            function(){ 
                                if('{{ !Auth::user()->isMove() }}'){
                                    // send mandate to member
                                    $.ajax({
                                        url:'{{ route("ajaxSendMandatIeaToMember") }}',
                                        type:'get',
                                        data:{'id_product':idProduct, 'to_id':mrToId},
                                        dataType:'json',
                                        success:function(data){
                                            location.reload();
                                        }
                                    });
                                }
                                    
                                // reload page
                                location.reload();
                            }
                        );
                    }
                },
                error:function(){
                    // hide loading icon
                    stopLoadingPage();
                    swal("Upload Research Mandate", "Upload error", "error");
                }
            });  
        }

        function updateCaTable(id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({               
                url: '{{ route("afa.dossier.update_ca") }}',
                type: 'POST',
                data: {'id':id},
                dataType:'json',
                success: function( data ){
                    console.log(data.success);
                }
            });  
        }
    </script>
	
@endpush