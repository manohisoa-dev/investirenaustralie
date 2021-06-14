@extends('layouts.backend')

@section('subcontent')
<div class="col-lg-8 col-xl-9">
    <div class="profile-content-area m-40px-tb">
		<div class="card m-40px-b">
			<div class="card-header">
				<div class="row">
					<div class="col-5 col-lg-8">
						<span class="h6 font-w-500">{{$title}}</span>
					</div>
					<div class="col-7 col-lg-4 text-right">
						<a href="{{route('nouveau_programmes')}}" class="m-btn m-btn-radius m-btn-theme m-btn-sm">@lang('app.txt.add_new_programme') </a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<table class="table" style="font-size:12px">
					<thead>
						<tr>
							<th>ID</th>
							<th>Image</th>
							<th>Titre</th>
							<th>Categorie</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
