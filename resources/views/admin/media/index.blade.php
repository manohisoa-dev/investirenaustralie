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
						<button class="btn btn-primary btn-block">Upload Files</button>
						<div class="hr-line-dashed"></div>
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
            	<div class="col-lg-12" id="fileContent">
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('custom-script')
<script type="text/javascript">
$(document).ready(function(){
	set_content_file('');
});

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
		  $('#fileContent').html(data);	  
	   }
	});
}
</script>
@endsection
