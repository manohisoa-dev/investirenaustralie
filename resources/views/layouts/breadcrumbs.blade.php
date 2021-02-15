<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>{{$title}}</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{url('V2/admin')}}">Acceuil</a>
			</li>
			@if(isset($breadcrumbs))
				@if(!is_array($breadcrumbs))
					<li class="breadcrumb-item active"><strong> {{$breadcrumbs}}</strong></li>
				@else
					@foreach($breadcrumbs as $breadcrumb)
						@if(isset($breadcrumb['active'])&&$breadcrumb['active'])
							<li class="breadcrumb-item active"><strong> {{$breadcrumb['label']}}</strong></li>
						@else
							<li class="breadcrumb-item"><a href="{{$breadcrumb['route']}}"> {{$breadcrumb['label']}}</a></li>
						@endif
					@endforeach
				@endif
			@endif
			<!--<li class="breadcrumb-item active">
				<strong>Profile</strong>
			</li>-->
		</ol>
	</div>
	<div class="col-lg-2">

	</div>
</div>