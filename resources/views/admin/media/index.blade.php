@extends('admin.layouts.app')

@section('title', 'Menus - Listes ')


@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Menus</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.menu.index') }}">Menus</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <?php /*?><a href="{{ route('admin.menu.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> @lang('app.admin.menu.createBtn')            
			</a><?php */?>
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
						<h5>Folders media</h5>
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
					<form action="{{ route('admin.ajaxFile') }}" class="dropzone" id="fileupload">
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
    console.log($('#dir_name').val());
	set_content_file('');
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
    if(folder.getAttribute("data-parent") == ''){
		var parent = folder.getAttribute("data-href");
	}else{
		var parent = folder.getAttribute("data-href")+'/'+folder.getAttribute("data-parent");
	}
		
	set_content_file(folder.getAttribute("data-href"),parent);
	//alert(d.getAttribute("data-href"));
}

function set_content_file(folder_name,parent='')
{
	$.ajax({
	   type:'GET',
	   url:"{{ route('admin.midia.get') }}",
	   data: {"_token": "{{ csrf_token() }}","directory_name": folder_name,"directory_parent":parent},
	   success:function(data) {
	   	  $('#zone_drop').hide();
		  $('#fileContent').html(data);		  
	   }
	});
}

function delete_file(file)
{
	var file_name = file.getAttribute("data-name");
	var folder = file.getAttribute("data-info");
	var id_file_base = file.getAttribute("data-base");
	
	//file.preventDefault();
    swal({
            title: "Are you sure!",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes!",
            showCancelButton: true,
        },
        function() {
            $.ajax({
                type: "POST",
                url:"{{ route('admin.ajaxDeleteFile') }}",
                data: {"_token": "{{ csrf_token() }}","file_name": file_name,"folder":folder,"id_file_base":id_file_base},
                success: function (data) {
                	set_content_file(data.success); 
                }         
            });
    });
}
</script>
@endsection
