@extends('admin.layouts.app')

@section('title', 'Menus - Listes ')


@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.media.titre')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{Auth::user()->isAdmin()?route('admin.media'):route('admin.collaborators.admin.media')}}">@lang('app.media.titre')</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.lists')</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
		
        </div>
    </div>
</div>

@endsection

@section('content')

<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-3">
			<div class="ibox ">
				<div class="ibox-content">
					<div class="file-manager">
						<h5>@lang('app.txt.folders_media') {{ Session::get('dirFile') }}</h5>
						<ul class="folder-list" style="padding: 0">
							@php
								foreach($folder as $key=>$val){
									echo '<li><a href="javascript:void(0)" onclick="read_folder(this)" data-href="'.$val.'"><i class="fa fa-folder"></i> '.$val.'</a></li>';
								}
							@endphp
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-9 animated fadeInRight">
			<div class="row">
				<div class="col-lg-12" id="zone_drop" style="display:none">
					<form action="{{ Auth::user()->isAdmin()?route('admin.ajaxFile'):route('admin.collaborators.admin.ajaxFile') }}" class="dropzone" id="fileupload">
						{{ csrf_field() }}
						<input type="hidden" name="dir_name" id="dir_nam" value="" />
						<div class="fallback">						
						<input name="file" type="file" multiple />
						</div>
					</form>
				</div>
            	<div class="col-lg-12" id="fileContent">

				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('custom-script')
<script src="{{ asset('administrator/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script>
Dropzone.options.fileupload = {
  paramName: "file", // The name that will be used to transfer the file
  maxFilesize: 2, // MB
  dictDefaultMessage: "@lang('app.dropzone.libelle')",
  success: function(file, response){
      console.log($('#dir_name').val());
	  set_content_file(response.success);
	  this.removeAllFiles();
      $('#zone_drop').hide();
	  
  },
};
</script>
<script type="text/javascript">
$(document).ready(function(){
    @if(Session::has('dirFile'))
	set_content_file("{{ Session::get('dirFile') }}");
	@else
	set_content_file('');
	@endif
	$('#zone_drop').hide();
});

function show_upload()
{
	var dir = $('#path_directory').val();
	$('[name="dir_name"]').val(dir);
	$('#zone_drop').show();
}

function read_folder(folder)
{	
	//set_content_file(folder.getAttribute("data-href"));
	var directory = folder.getAttribute("data-href");
	$.ajax({
	   type:'GET',
	   url:"{{ Auth::user()->isAdmin()?route('admin.ajaxReadFile'):route('admin.collaborators.admin.ajaxReadFile') }}",
	   data: {"_token": "{{ csrf_token() }}","directory_name": directory},
	   cache: false,
	   success:function(data) {
	   	  	location.reload();	    
	   }
	});
	
	return false
}

function set_content_file(folder_name)
{
	$.ajax({
	   type:'GET',
	   url:"{{ Auth::user()->isAdmin()?route('admin.midia.get'):route('admin.collaborators.admin.midia.get') }}",
	   data: {"_token": "{{ csrf_token() }}","directory_name": folder_name},
	   cache: false,
	   success:function(data) {
	   	  $('#zone_drop').hide();
		  $('#fileContent').html(data);			    
	   }
	});
	
	return false
}

function delete_file(file)
{
	var file_name = file.getAttribute("data-name");
	var folder = file.getAttribute("data-info");
	var id_file_base = file.getAttribute("data-base");
	
	//file.preventDefault();
    swal({
            title: "@lang('app.table.confirm_delete')",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "@lang('app.yes')",
			cancelButtonText: "@lang('app.btn.cancel')",
            showCancelButton: true,
        },
        function() {
            $.ajax({
                type: "POST",
                url:"{{ Auth::user()->isAdmin()?route('admin.ajaxDeleteFile'):route('admin.collaborators.admin.ajaxDeleteFile') }}",
                data: {"_token": "{{ csrf_token() }}","file_name": file_name,"folder":folder,"id_file_base":id_file_base},
                success: function (data) {
                	set_content_file(data.success); 
                }         
            });
    });
}

function edit_file(file)
{
	$('#form_file')[0].reset();
	var file_name = file.getAttribute("data-name");
	var folder = file.getAttribute("data-info");
	var id_file_base = file.getAttribute("data-base");
	var mime_file = file.getAttribute("data-mime");
	
	$.ajax({
		type: "POST",
		url:"{{ Auth::user()->isAdmin()?route('admin.ajaxGetFile'):route('admin.collaborators.admin.ajaxGetFile') }}",
		data: {"_token": "{{ csrf_token() }}","file_name": file_name,"folder":folder,"id_file_base":id_file_base},
		timeout : 6000,
		success: function (data) {
			$('#info_image').html(data);
			$('#new_file').html('<input type="file" class="form-control" name="new_file" id="new_file" accept=".'+mime_file+'">');
			$('#editFile').modal('show'); 
		}         
	});
}

function save_file()
{
	var formData = new FormData($('#form_file')[0]);
	var url = "{{ Auth::user()->isAdmin()?route('admin.ajaxSaveFileEdit'):route('admin.collaborators.admin.ajaxSaveFileEdit') }}";
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
		contentType: false,
        success: function (data) {	 	
            //set_content_file(data.success);
			setTimeout(function() {$('#editFile').modal('hide');}, 2000);
			location.reload();
			//window.location = "{{route('admin.media')}}";
        },
        contentType: false,
        processData: false,
		cache: false
    });
}
</script>

<div class="modal inmodal" id="editFile" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">@lang('app.media.btn_edit')</h4>
			</div>
			<div class="modal-body">
			<form action="#" id="form_file" class="form-horizontal" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="row" id="info_image">
					
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							<label>@lang('app.media.lab_fileinput')</label> 
							<div id="new_file"></div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">@lang('app.media.btn_close')</button>
				<button type="button" class="btn btn-primary" onclick="save_file()">@lang('app.media.btn_save')</button>
			</div>
		</div>
	</div>
</div>
@endsection
