@extends('admin.layouts.app')

@section('title', 'Users - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Parties prenantes</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Parties prenantes</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.user.index') }}">Listes</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Détail</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

    </div>
</div>

@endsection

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-md-6">
			<div class="ibox">
				<div class="ibox-title">
					<h5><i class="fa fa-toggle-on"></i> @lang('app.login_info')</h5>
				</div>
				<div class="ibox-content">
					<div class="row">
						<div class="col-md-3">
							@if (@getimagesize($user->imageUrl()))
								<img src="{{$user->imageUrl(false)}}" alt="{{$user->name}}" class="rounded-circle" style="width:150px">
							@else
								<img src="{{asset('img/500x500.jpg')}}" alt="{{$user->name}}" class="rounded-circle" style="width:150px">
							@endif
						</div>
						<div class="col-md-9">
							<table class='table table-borderless'>
								<tr>
									<th width="45%">@lang('app.form.login')</th>
									<td>{{$user->name}}</td>
								</tr>
								<tr>
									<th width="45%">@lang('app.form.email')</th>
									<td>{{$user->email}}</td>
								</tr>
								<tr>
									<th width="45%">@lang('app.form.language')</th>
									<td>{{$user->language=='en'?'English':'Français'}}</td>
								</tr>
								<tr>
									<th width="45%">@lang('app.user.ontrial')</th>
									<td><?php /*?>{{$user->onTrial()?'oui':'non'}}<?php */?></td>
								</tr>
								<tr>
									<th width="45%">@lang('app.user.trial_end_at')</th>
									<td>{{$user->trial_ends_at}}</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		@if($user->hasRole(5) && $user->type_users_id==2)
		<div class="col-md-6">
			<div class="ibox">
				<div class="ibox-title">
					<h5><i class="fa fa-user-circle"></i> @lang('app.user_info')</h5>
				</div>
				<div class="ibox-content">
					<table class='table table-borderless'>
						<tr>
							<th width="35%">@lang('app.person.first_name')</th>
							<td>{{$user->get_meta('first_name')?$user->get_meta('first_name')->value:''}}</td>
						</tr>
						<tr>
							<th width="35%">@lang('app.person.last_name')</th>
							<td>{{$user->get_meta('last_name')?$user->get_meta('last_name')->value:''}}</td>
						</tr>
						<tr>
							<th width="35%">@lang('app.person.phone')</th>
							<td>{{$user->get_meta('phone')?$user->get_meta('phone')->value:''}}</td>
						</tr>
						<tr><th>&nbsp;</th><td></td></tr>
						<tr><th>&nbsp;</th><td></td></tr>
					</table>
				</div>
			</div>
		</div>
		@else
		<div class="col-md-3">
			<div class="ibox">
				<div class="ibox-title">
					<h5><i class="fa fa-bank"></i> Organisation</h5>
				</div>
				<div class="ibox-content">
					<table class='table table-borderless'>
						<tr>
							<th width="35%">@lang('app.orga.name')</th>
							<td>{{$user->get_meta('orga_name')?$user->get_meta('orga_name')->value:''}}</td>
						</tr>
						<tr>
							<th width="35%">@lang('app.orga.desc')</th>
							<td>{{$user->get_meta('orga_desc')?$user->get_meta('orga_desc')->value:''}}</td>
						</tr>
						<tr>
							<th width="35%">@lang('app.orga.phone')</th>
							<td>{{$user->get_meta('orga_phone')?$user->get_meta('orga_phone')->value:''}}</td>
						</tr>
						<tr>
							<th width="35%">@lang('app.orga.website')</th>
							<td>{{$user->get_meta('orga_website')?$user->get_meta('orga_website')->value:''}}</td>
						</tr>
						<tr><th>&nbsp;</th><td></td></tr>
					</table>
				</div>
			</div>
		</div>
		
		<div class="col-md-3">
			<div class="ibox">
				<div class="ibox-title">
					<h5><i class="fa fa-phone-square"></i> @lang('app.contact_info')</h5>
				</div>
				<div class="ibox-content">
					<table class='table table-borderless'>
						<tr>
							<th width="35%">@lang('app.contact.name')</th>
							<td>{{$user->get_meta('contact_name')?$user->get_meta('contact_name')->value:''}}</td>
						</tr>
						<tr>
							<th width="35%">@lang('app.contact.email')</th>
							<td>{{$user->get_meta('contact_email')?$user->get_meta('contact_email')->value:''}}</td>
						</tr>
						<tr>
							<th width="35%">@lang('app.contact.phone')</th>
							<td>{{$user->get_meta('contact_phone')?$user->get_meta('contact_phone')->value:''}}</td>
						</tr>
						<tr><th>&nbsp;</th><td></td></tr>
						<tr><th>&nbsp;</th><td></td></tr>
					</table>
				</div>
			</div>
		</div>
		@endif
	</div>

	<div class="row">
		<div class="col-md-9">
			<div class="ibox">
				<div class="ibox-title">
					<h5><i class="fa fa-vcard-o"></i> @lang('app.observations')</h5>
				</div>
				<div class="ibox-content">
					<table class="table boo-table table-striped table-hover">
						<thead>
							<tr>
								<th scope="col">Id <span class="column-sorter"></span></th>
								<th scope="col">Photo<span class="column-sorter"></span></th>
								<th scope="col">Utilisateur<span class="column-sorter"></span></th>
								<th scope="col">Contenu <span class="column-sorter"></span></th>
								<th scope="col">Date <span class="column-sorter"></span></th>
							</tr>
						</thead>
						<tbody>
							<?php /*?>@foreach($user->observations as $observation)
							<tr>
								<td>{{$observation->id}}</td>
								<td><img class="thumb" width="50" src="{{$observation->user?$observation->user->imageUrl():''}}"></td>
								<td>{{$observation->user?$observation->user->name:''}}</td>
								<td>{{$observation->excerpt()}}</td>
								<td>{{$observation->created_at->diffForHumans()}}</td>
							</tr>
							@endforeach<?php */?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
		<div class="col-md-3">
			<div class="ibox">
				<div class="ibox-title">
					<h5><i class="fa fa-map-marker"></i> @lang('app.location_info')</h5>
				</div>
				<div class="ibox-content">
					<table class='table table-borderless'>
						<tr>
							<th width="">@lang('app.location.country')</th>
							<td>{{$user->location?$user->location->country:''}}</td>
						</tr>
						<tr>
							<th width="">@lang('app.location.area_level_1')</th>
							<td>{{$user->location?$user->location->area_level_1:''}}</td>
						</tr>
						<tr>
							<th width="">@lang('app.location.area_level_2')</th>
							<td>{{$user->location?$user->location->area_level_2:''}}</td>
						</tr>
						<tr>
							<th width="">@lang('app.location.locality')</th>
							<td>{{$user->location?$user->location->locality:''}}</td>
						</tr>
						<tr>
							<th width="">@lang('app.location.route')</th>
							<td>{{$user->location?$user->location->route:''}}</td>
						</tr>
						<tr>
							<th width="">@lang('app.location.postalCode')</th>
							<td>{{$user->location?$user->location->postalCode:''}}</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		
	</div>
	@if($user->role==5)
	<div class="row">
		<div class="col-md-12">
			<div class="ibox">
				<div class="ibox-title">
					<h5><i class="fa fa-calendar"></i> @lang('app.orders')</h5>
				</div>
				<div class="ibox-content">
					@include('admin.table.product',[
						'products'=>$user->purchases()->wherePivot('status', 'ordered')
					])
				</div>
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="ibox">
				<div class="ibox-title">
					<h5><i class="fa fa-shopping-cart"></i> @lang('app.purchases')</h5>
				</div>
				<div class="ibox-content">
					@include('admin.table.product',[
						'products'=>$user->purchases()->wherePivot('status', 'paid')
					])
				</div>
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="ibox">
				<div class="ibox-title">
					<h5><i class="fa fa-bookmark-o"></i> @lang('app.favorites')</h5>
				</div>
				<div class="ibox-content">
					@include('admin.table.product',['products'=>$user->favorites])
				</div>
			</div>
		</div>
	</div>
	@endif
	
	@if($user->role==4)
	<div class="row">
		<div class="col-md-12">
			<div class="ibox">
				<div class="ibox-title">
					<h5><i class="fa fa-handshake-o"></i> @lang('app.customers')</h5>
				</div>
				<div class="ibox-content">
					@include('admin.table.user',['users'=>$user->customers])
				</div>
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="ibox">
				<div class="ibox-title">
					<h5><i class="fa fa-calendar"></i> @lang('app.orders')</h5>
				</div>
				<div class="ibox-content">
					@include('admin.table.product',[
						'products'=>$user->sales()->wherePivot('status', 'ordered')
					])
				</div>
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="ibox">
				<div class="ibox-title">
					<h5><i class="fa fa-briefcase"></i> @lang('app.sales')</h5>
				</div>
				<div class="ibox-content">
					@include('admin.table.product',[
						'products'=>$user->sales()->wherePivot('status', 'paid')
					])
				</div>
			</div>
		</div>
	</div>
	@endif
	
	@if($user->role==2)
	<div class="row">
		<div class="col-md-12">
			<div class="ibox">
				<div class="ibox-title">
					<h5><i class="fa fa-product-hunt"></i> @lang('app.products')</h5>
				</div>
				<div class="ibox-content">
					@include('admin.table.product',[
						'products'=>$user->products
					])
				</div>
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="ibox">
				<div class="ibox-title">
					<h5><i class="fa fa-calendar"></i> @lang('app.orders')</h5>
				</div>
				<div class="ibox-content">
					@include('admin.table.product',[
						'products'=>$user->products()->where('products.status', 'ordered')
					])
				</div>
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="ibox">
				<div class="ibox-title">
					<h5><i class="fa fa-briefcase"></i> @lang('app.sales')</h5>
				</div>
				<div class="ibox-content">
					@include('admin.table.product',[
						'products'=>$user->products()->where('products.status', 'paid')
					])
				</div>
			</div>
		</div>
	</div>
	@endif
	
	@if($user->role==3)
	<div class="row">
		<div class="col-md-12">
			<div class="ibox">
				<div class="ibox-title">
					<h5><i class="fa fa-calendar"></i> @lang('app.orders')</h5>
				</div>
				<div class="ibox-content">
					@include('admin.table.product',[
						'products'=>$user->sales()->wherePivot('status', 'ordered')
					])
				</div>
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="ibox">
				<div class="ibox-title">
					<h5><i class="fa fa-briefcase"></i> @lang('app.sales')</h5>
				</div>
				<div class="ibox-content">
					@include('admin.table.product',[
						'products'=>$user->sales()->wherePivot('status', 'paid')
					])
				</div>
			</div>
		</div>
	</div>
	@endif
</div>
@endsection