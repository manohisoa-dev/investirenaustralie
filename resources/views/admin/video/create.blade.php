@extends('admin.layouts.app')

@section('title', 'Vidéos - Ajout ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Vidéos</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Vidéos</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.video.index') }}">Listes</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Ajout</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Ajouter un nouveau Vidéo</h5>
            </div>
            <div class="ibox-content">
                <form class="form-validation form-padding" action="{{ route('admin.video.store') }}" method="post" id="form-video" enctype="multipart/form-data">

                    {{ csrf_field() }}
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="video_titre">Source *</label>
								<select class="form-control" name="type_source" id="type_source">
									<option value="">Choisir</option>
									<option value="0">URL</option>
									<option value="1">Téléverser</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="video_titre">Video Titre *</label>
								<input name="video_titre" id="video_titre" class="form-control" type="text" value="">
							</div>
						</div> 
					</div>
					<div class="row">
						<div class="col-md-12" id="video_url" style="display:none">    
							<div class="form-group">
								<label for="video_url">Video Url</label>
								<input name="video_url" id="video_url" class="form-control" type="text" value="">
							</div> 
						</div>
						<div class="col-md-12" id="video_path" style="display:none">    
							<div class="form-group">
								<label for="video_path">Video Path (Max : {{ini_get('upload_max_filesize')}})</label>
								<input name="video_path" id="video_path" class="form-control" type="file" value="">
							</div>
						</div>
					</div>                                                                                    
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Créer</button>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom-script')
<!-- Jquery Validate -->
<script src="{{ asset('administrator/js/plugins/validate/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
$.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param * 1000000)
}, 'File size must be less than {0} Mo');

$(document).ready(function(){
	$('#type_source').on('change', function() {
		var type = this.value;
		if(type == 0){
			$('#video_url').show();
			$('#video_path').hide();
		}else if(type == 1){
			$('#video_url').hide();
			$('#video_path').show();
		}else{
			$('#video_url').hide();
			$('#video_path').hide();
		}
	});
	
	
	$('#form-video').validate({
		ignore: [],
		rules: {
			type_source: {
				required: true
			},
			video_titre: {
				required: true
			},
			video_url: {
				required: {
					depends: function(element) {
						if($("#type_source").val() == 0){
							return true;	
						}
					}
				}
			},
			video_path: {
				required: {
					depends: function(element) {
						if($("#type_source").val() == 1){
							return true;	
						}
					}
				},
				filesize: 2
			}
		},
		messages: {
			type_source: {
				required: "@lang('app.txt.champobligatoire')"
			},
			video_titre: {
				required: "@lang('app.txt.champobligatoire')"
			},
			video_url: {
				required: "@lang('app.txt.champobligatoire')"
			},
			video_path: {
				required: "@lang('app.txt.champobligatoire')"
			}
		},
		errorPlacement: function ( error, element ) {
			if(element.parent().hasClass('input-group')){
				error.insertAfter( element.parent() );
			}else{
				error.insertAfter( element );
			}
		},
	});
});
</script>
@endsection
