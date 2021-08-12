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
                            <td>Conjunction Agreement</td>
                            <td>{{ $record->file_name }}</td>
                            <td>
                            @if($record->status=='0')
                                <span class="badge badge-pill badge-danger white-color">@lang('afa.folders.status.to_download')</span>
                            @else
                                <span class="badge badge-pill badge-success white-color">@lang('afa.folders.status.finalized')</span>
                            @endif
                            </td>
                            <td align="center">
                                <a href="javascript:void(0)" onclick="showTimeline({{$record}})" title="Show timeline for this product" class="">
                                    <i class="fa fa-eye"></i>
                                </a>&nbsp;
                            </td>
                        </tr>
                    @endforeach
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
                    <h4 class="modal-title white-color">Timeline</h4>
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
        function showTimeline(folder){
            var content = $('#showTimelineModal .modal-body');
            content.html();

            // set timeline data
            content.html(timelineContent(folder));

            // show timeline
            $('#showTimelineModal').modal('show');
        }

        function timelineContent(folderInfo){
            var dayCreate = $.format.prettyDate(folderInfo.created_at, 'yyyy MMM dd');
            var dateCreate = $.format.date(folderInfo.created_at, 'yyyy MMM dd');
            var origin   = window.location.origin;
            var downloadLink = origin+'/'+folderInfo.path;
            var status = folderInfo.status;
            var disabledLink = status!==0?'disabled':'';
            var textBtnUpload = status!==0?'File sent':'Upload file';
            var fileName = status!==0?folderInfo.file_name:'';
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
                                    '</div>'+
                                '</div>'+

                                '<div class="vertical-timeline-block">'+
                                    '<div class="vertical-timeline-icon black-bg">'+
                                        '<i class="fa fa-upload"></i>'+
                                    '</div>'+
                                    '<div class="vertical-timeline-content">'+
                                        '<h2>SEND FINALIZED CONJUNCTION AGREEMENT</h2>'+
                                        '<p>Send the finalized conjunction agreement.</p>'+
                                        '<button href="javascript:void(0)" class="m-btn m-btn-sm m-btn-theme float-right" id="btnUploadFile" onclick="uploadFile('+folderInfo.id+')" value="'+folderInfo.id+'" '+disabledLink+'> '+textBtnUpload+' </button>'+
                                        '<span id="spnFilePath">'+fileName+'</span>'+
                                        '<form id="formSendCaFile">'+
                                            '<input type="file" id="FileUpload1" onchange="fileUploadChange('+folderInfo.id+')" name="file_ca" style="display: none" />'+
                                        '</form>'+
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
            var buttonsend = '<button type="button" class="m-btn m-btn-sm m-btn-theme4rd" onclick="sendFile('+folderId+')" id="btnSendFile">Send</button>';

            button.click(function () {
                fileupload.click();
            });
            fileupload.change(function () {
                var fileName = $(this).val().split('\\')[$(this).val().split('\\').length - 1];
                filePath.html("<b>Selected File: </b>" + fileName +" " +buttonsend);
            });
        });

        function uploadFile(){
            var fileupload = $("#FileUpload1");
            var filePath = $("#spnFilePath");
            var button = $("#btnUploadFile");
            var folderId = button.val();
            var buttonsend = '<button type="button" class="m-btn m-btn-sm m-btn-theme4rd" onclick="sendFile('+folderId+')" id="btnSendFile">Send</button>';

            fileupload.click();
        }

        function fileUploadChange(folderId){
            var fileName = $('#FileUpload1').val().split('\\')[$('#FileUpload1').val().split('\\').length - 1];
            var filePath = $("#spnFilePath");
            var button = $("#btnUploadFile");
            var buttonsend = '<button type="button" class="m-btn m-btn-sm m-btn-theme4rd" onclick="sendFile('+folderId+')" id="btnSendFile">Send</button>';
                filePath.html("<b>Selected File: </b>" + fileName +" " +buttonsend);
        }

        function sendFile(caId){
            var fileToUpload = new FormData();

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

                    if(data.success == 'false'){
					swal("Upload Conjunction Agreement", "Upload error", "error");
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
                            // reload page
                            location.reload();
                        }
                        );
                    }
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