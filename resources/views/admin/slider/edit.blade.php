@extends('admin.layouts.app')

@section('title', 'Sliders - Edition ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Sliders</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Sliders</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.slider.index') }}">Listes</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Edition</strong>
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
                <h5>Mise à jour Slider : {{$slider->content}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('admin.slider.index')}}/{{$slider->id}}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    {{ method_field("PUT") }}
                    <div class="form-group">
                        <label for="Type">Type</label>
                        <select name="type" id="type" class="form-control">
							<option value="">Choisir...</option>							
							<option value="image" {{$slider->type == 'image' ? 'selected' : ''}}>Image</option>
							<option value="pub" {{$slider->type == 'pub' ? 'selected' : ''}}>Pub</option>
                        </select>
                    </div>
					
					<div id="slideProduct" style="display:none">
						<div class="form-group">
							<label>Choisir produit</label>
							<select name="product_id" id="product_id" class="form-control" style="width:100%">
								<option value="">Choisir...</option>
								@foreach(\App\Models\Product::all() as $prd)
									<option value="{{$prd->id}}" {{$slider->product_id == $prd->id ? 'selected' : ''}}>{{$prd->title}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="title">@lang('app.admin.content')</label>
							<input type="text" name="content" id="content" class="form-control" value="" readonly="" />
						</div>
						<input type="hidden" name="image_id" />
					</div>
					
					
					
					<div id="slideImage" style="display:none">
						<div class="form-group">
							<label for="title">@lang('app.admin.content')</label>
							<input type="text" name="content1" id="content1" class="form-control" value=""/>
						</div>
						<div class="form-group">
							<label for="title">Image</label>
							<input type="file" name="image" class="form-control"/>
						</div>
					</div>
					                                                               
                            
                    <div class="form-group">
                        <label for="Type">Status</label>
                        <select name="status" id="status" class="form-control">
							<option value="0">Non actif</option>
							<option value="1">Actif</option>
                        </select>
                    </div>                                                                                                                               
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Enregistrer</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
	<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
	<script>
        $(document).ready(function(){
			$("#product_id").select2();
			var typel = '{{$slider->type}}';
			$('[name="status"]').val('{{$slider->status}}');	
			
			if(typel == 'image'){
				$('#slideImage').show();
				$('[name="content1"]').val('{{$slider->content}}');				
				$('#slideProduct').hide();
			}else if(typel == 'pub'){
				$('#slideProduct').show();
				$('[name="content"]').val('{{$slider->content}}');
				$('[name="image_id"]').val('{{$slider->image_id}}');
				$('#slideImage').hide();
			}
			
			$('#type').change(function() {
				var type = $(this).val();
				if(type == 'image'){
					$('[name="content"]').val('');
					$('#slideImage').show();
					$('#slideProduct').hide();
				}else if(type == 'pub'){
					$('#slideProduct').show();
					$('[name="content"]').val('');
					$('#slideImage').hide();
				}else{
					$('#slideImage').hide();
					$('#slideProduct').hide();
				}
			});
			
			$('#product_id').change(function() {
				var productId = $(this).val();
				if(productId != 0){
					$.ajax({
					   type:'POST',
					   url:"{{ route('admin.ajaxRequestProduct.post') }}",
					   data: {"_token": "{{ csrf_token() }}","productId": productId},
					   success:function(data) {
						  console.log(data.slug);
						  $('[name="content"]').val(data.slug);
						  $('[name="image_id"]').val(data.image_id);
					   }
					});
				}
			});
		});
	</script>
@endsection