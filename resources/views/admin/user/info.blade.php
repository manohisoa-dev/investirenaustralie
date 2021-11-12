@extends('admin.layouts.app')

@section('title', 'Users - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.stakeholders')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.txt.stakeholders')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.user.index') }}">@lang('app.txt.lists')</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.detail')</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

    </div>
</div>

@endsection

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="ibox ">
		<div class="ibox-title">
			<h5><i class="fa fa-user-circle" aria-hidden="true"></i> Profile</h5>
			<div class="ibox-tools">
				<a class="collapse-link">
					<i class="fa fa-chevron-up"></i>
				</a>
			</div>
		</div>
		<div class="ibox-content">
			<div class="row">
				<div class="col-sm-2 b-r">
					<h4>Avatar</h4>
					<p class="text-center">
						@if (@getimagesize($user->imageUrl()))
							<img src="{{$user->imageUrl(false)}}" alt="{{$user->name}}" class="img-responsive" style="width:100%">
						@else
							<img src="{{asset('img/500x500.jpg')}}" alt="{{$user->name}}" class="img-responsive" style="width:100%">
						@endif
					</p>
				</div>
				<div class="col-sm-4 b-r">
					<h3 class="m-t-none m-b">@lang('app.login_info')</h3>
					<table class='table table-borderless'>
						<tr>
							<th width="45%">Immatriculation</th>
							<td>{{$user->immat}}</td>
						</tr>
						<tr>
							<th width="45%">Rôle</th>
							<td>{{$user->roleUser['role_initial']}}</td>
						</tr>
						@if ($user->hasRole(5) && $user->isPerson())
							<tr>
								<th width="45%">@lang('app.form.last_name')</th>
								<td>{{$user->userinfos?$user->userinfos->last_name:''}}</td>
							</tr>
							<tr>
								<th width="45%">@lang('app.form.first_name')</th>
								<td>{{$user->userinfos?$user->userinfos->first_name:''}}</td>
							</tr>
						@endif
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
							<th width="45%">@lang('app.status')</th>
							<td>
							@if($user->status == 'temp')
								<span class="label label-warning">@lang('app.txt.status_pending')</span>
							@else
								{{ $user->status?trans('app.txt.'.$user->status):'-' }}
							@endif
							</td>
						</tr>
					</table>
				</div>
				<div class="col-sm-3 b-r">
					<h3 class="m-t-none m-b">@lang('app.location_info')</h3>
					<table class='table table-borderless'>
						<tr>
							<th width="45%">@lang('app.country')</th>
							<td>{{$user->location->country}}</td>
						</tr>
						<tr>
							<th width="45%">@lang('app.form.programme_suburb')</th>
							<td>{{$user->location->locality}}</td>
						</tr>
						<tr>
							<th width="45%">@lang('app.form.programme_ville')</th>
							<td>{{$user->location->area_level_2}}</td>
						</tr>
						<tr>
							<th width="45%">@lang('app.form.programme_adresse')</th>
							<td>{{$user->location->route}}</td>
						</tr>
						<tr>
							<th width="45%">@lang('app.form.programme_cp')</th>
							<td>{{$user->location->postalCode}}</td>
						</tr>
						<tr>
							<th width="45%">@lang('app.latitude')</th>
							<td>{{$user->location->latitude}}</td>
						</tr>
						<tr>
							<th width="45%">@lang('app.longitude')</th>
							<td>{{$user->location->longitude}}</td>
						</tr>
					</table>
				</div>
				<div class="col-sm-3 b-r">
					<h3 class="m-t-none m-b">@lang('app.txt.contactinfo')</h3>
					<table class='table table-borderless'>
						<tr>
							<th>@lang('app.txt.contactname')</th>
							<td>{{$user->userinfos ?$user->userinfos->contact_name : ''}}</td>
						</tr>
						<tr>
							<th>@lang('app.txt.contactemail')</th>
							<td>{{$user->userinfos ?$user->userinfos->contact_email : ''}}</td>
						</tr>
						<tr>
							<th>@lang('app.txt.contactphone')</th>
							<td>{{$user->userinfos ?$user->userinfos->contact_phone : ''}}</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- info en tant que AFA -->
	@if($user->hasRole(3) || $user->hasRole(4))
	<div class="ibox ">
		<div class="ibox-title">
			<h5><i class="fa fa-list" aria-hidden="true"></i> @lang('app.txt.businessdetail')</h5>
			<div class="ibox-tools">
				<a class="collapse-link">
					<i class="fa fa-chevron-up"></i>
				</a>
			</div>
		</div>
		<div class="ibox-content">
			<div class="row">
				<div class="col-sm-4 b-r">
					<table class='table table-borderless'>
						<tr>
							<th>@lang('app.txt.type_of_business')</th>
							<td>{{$user->userinfos ?$user->TypeUser->type_user_name : ''}}</td>
						</tr>
						<tr>
							<th>@lang('app.txt.businessname')</th>
							<td>{{$user->userinfos ?$user->userinfos->orga_name : ''}}</td>
						</tr>
						<tr>
							<th>@lang('app.txt.businesstradingname')</th>
							<td>{{$user->userinfos ?$user->userinfos->orga_trading_name : ''}}</td>
						</tr>
						<tr>
							<th>@lang('app.txt.stateoflegaloperation')</th>
							<td>
							@if (isset($user->userinfos->orga_operation_state))
								@foreach (unserialize($user->userinfos->orga_operation_state) as $orgOpState)
									{{$orgOpState}}
								@endforeach
							@endif
							</td>
						</tr>
					</table>
				</div>
				<div class="col-sm-4 b-r">
					<table class='table table-borderless'>
						@if($user->hasRole(4))
							<tr>
								<th>@lang('app.txt.organizationregistrationnumber')</th>
								<td>{{$user->userinfos ?$user->userinfos->orga_registration_number:''}}</td>
							</tr>
							<tr>
								<th>@lang('app.txt.organizationrepregistrationofficial')</th>
								<td>{{$user->userinfos ?$user->userinfos->orga_rep_official_registration:''}}</td>
							</tr>
						@else
							<tr>
								<th>@lang('app.txt.business_abn')</th>
								<td>{{$user->userinfos ?$user->userinfos->orga_abn : ''}}</td>
							</tr>
							<tr>
								<th>@lang('app.txt.business_acn')</th>
								<td>{{$user->userinfos ?$user->userinfos->orga_acn : ''}}</td>
							</tr>
						@endif
						<tr>
							<th>@lang('app.txt.real_estate_agent_licence_number')</th>
							<td>{{$user->userinfos ?$user->userinfos->orga_license_number : ''}}</td>
						</tr>
						<tr>
							<th>@lang('app.txt.rangeofoperation')</th>
							<td>{{$user->userinfos ?$user->userinfos->orga_operation_range : ''}} Km</td>
						</tr>
					</table>
				</div>
				<div class="col-sm-4">
					<table class='table table-borderless'>
						<tr>
							<th>@lang('app.txt.businessphone')</th>
							<td>{{$user->userinfos ?$user->userinfos->orga_phone : ''}}</td>
						</tr>
						<tr>
							<th>@lang('app.txt.businessfax')</th>
							<td>{{$user->userinfos ?$user->userinfos->orga_fax : ''}}</td>
						</tr>
						<tr>
							<th>@lang('app.txt.businessmobile')</th>
							<td>{{$user->userinfos ?$user->userinfos->orga_mobile_phone : ''}}</td>
						</tr>
						<tr>
							<th>@lang('app.txt.websiteurl')</th>
							<td>{{$user->userinfos ?$user->userinfos->orga_website : ''}}</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<table class='table table-borderless'>
						<tr>
							<th>@lang('app.txt.businesspresentation')</th>							
						</tr>
						<tr>
							<td>{{$user->userinfos ?$user->userinfos->orga_presentation:''}}</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	<div class="ibox ">
		<div class="ibox-title">
			<h5><i class="fa fa-list" aria-hidden="true"></i> @lang('app.txt.office_address')</h5>
			<div class="ibox-tools">
				<a class="collapse-link">
					<i class="fa fa-chevron-up"></i>
				</a>
			</div>
		</div>
		<div class="ibox-content">
			<div class="row">
				<div class="col-sm-4 b-r">
					<table class='table table-borderless'>
						<tr>
							<th>@lang('app.txt.name_building')</th>
							<td>{{$user->location?$user->location->building_name:trans('app.txt.noinfo')}}</td>
						</tr>
						<tr>
							<th>@lang('app.txt.name_of_the_road')</th>
							<td>{{$user->location?$user->location->route:trans('app.txt.noinfo')}}</td>
						</tr>
						<tr>
							<th>@lang('app.txt.number_of_the_road')</th>
							<td>{{$user->location?$user->location->route_number:trans('app.txt.noinfo')}}</td>
						</tr>
						<tr>
							<th>@lang('app.txt.number_of_rooms')</th>
							<td>{{$user->location?$user->location->num_rooms:trans('app.txt.noinfo')}}</td>
						</tr>
					</table>
				</div>
				<div class="col-sm-4 b-r">
					<table class='table table-borderless'>
						<tr>
							<th>@lang('app.txt.level')</th>
							<td>{{$user->location?$user->location->num_floor:trans('app.txt.noinfo')}}</td>
						</tr>
						<tr>
							<th>@lang('app.txt.suburb')</th>
							<td>{{$user->location?$user->location->locality:trans('app.txt.noinfo')}}</td>
						</tr>
						<tr>
							<th>@lang('app.txt.city')</th>
							<td>{{$user->location?$user->location->area_level_2:trans('app.txt.noinfo')}}</td>
						</tr>
						<tr>
							<th>@lang('app.txt.codepostal')</th>
							<td>{{$user->location?$user->location->postalCode:trans('app.txt.noinfo')}}</td>
						</tr>
					</table>
				</div>
				<div class="col-sm-4 b-r">
					<table class='table table-borderless'>
						<tr>
							<th>@lang('app.txt.etat')</th>
							<td>{{$user->location?$user->location->area_level_1:trans('app.txt.noinfo')}}</td>
						</tr>
						<tr>
							<th>@lang('app.txt.country')</th>
							<td>{{$user->location?$user->location->country:trans('app.txt.noinfo')}}</td>
						</tr>
						<tr>
							<th>@lang('app.txt.postal_address')</th>
							<td>
							@if (isset($user->location) && $user->location->adrpost_postal_box=='')
								@lang('app.txt.as_above')
							@else
								{{$user->location?$user->location->adrpost_postal_box:trans('app.txt.noinfo')}}
							@endif
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
	@endif
	<!-- info en tant que APL -->
	@if($user->hasRole(4))
	<div class="ibox ">
		<div class="ibox-title">
			<h5><i class="fa fa-list" aria-hidden="true"></i> @lang('app.txt.bank_account')</h5>
			<div class="ibox-tools">
				<a class="collapse-link">
					<i class="fa fa-chevron-up"></i>
				</a>
			</div>
		</div>
		<div class="ibox-content">
			<div class="row">
				<div class="col-sm-4 b-r">
					<table class='table table-borderless'>
						<tr>
							<th>@lang('app.txt.bank')</th>
							<td>{{$user->userinfos?$user->userinfos->bank_iban:''}}</td>
						</tr>
						<tr>
							<th>@lang('app.txt.agency')</th>
							<td>{{$user->userinfos?$user->userinfos->bank_agency:''}}</td>
						</tr>
						<tr>
							<th>@lang('app.txt.postal_box')</th>
							<td>{{$user->location?$user->location->bank_postal_box:''}}</td>
						</tr>
					</table>
				</div>
				<div class="col-sm-4 b-r">
					<table class='table table-borderless'>
						<tr>
							<th>@lang('app.txt.city')</th>
							<td>{{$user->location?$user->location->bank_locality:''}}</td>
						</tr>
						<tr>
							<th>@lang('app.txt.codepostal')</th>
							<td>{{$user->location?$user->location->bank_postalCode:''}}</td>
						</tr>
						<tr>
							<th>@lang('app.txt.etat') (@lang('app.txt.etat.libelle'))</th>
							<td>{{$user->location?$user->location->bank_area_level_1:''}}</td>
						</tr>
					</table>
				</div>
				<div class="col-sm-4">
					<table class='table table-borderless'>
						<tr>
							<th>@lang('app.txt.country')</th>
							<td>{{$user->location?$user->location->bank_country:''}}</td>
						</tr>
						<tr>
							<th>@lang('app.txt.iban_bank_account')</th>
							<td>{{$user->userinfos?$user->userinfos->bank_iban:''}}</td>
						</tr>
						<tr>
							<th>@lang('app.txt.bic_code')</th>
							<td>{{$user->userinfos?$user->userinfos->bank_bic:''}}</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
	@endif
	
	@if($user->role==5)
		<!-- info membre organisation-->
		@if($user->type_users_id == 1)
		<div class="row">
			<div class="col-md-12">
				<div class="ibox">
					<div class="ibox-title">
						<h5><i class="fa fa-info"></i> @lang('app.txt.organization_details')</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-6">
								<table class='table table-borderless'>
									<tr>
										<th>@lang('app.txt.businessname')</th>
										<td>{{$user->userinfos ?$user->userinfos->orga_name:''}}</td>
									</tr>
									<tr>
										<th>@lang('app.txt.organizationregistrationnumber')</th>
										<td>{{$user->userinfos ?$user->userinfos->orga_registration_number:''}}</td>
									</tr>
									<tr>
										<th>@lang('app.txt.organizationrepregistrationofficial')</th>
										<td>{{$user->userinfos ?$user->userinfos->orga_rep_official_registration:''}}</td>
									</tr>
									<tr>
										<th>@lang('app.txt.type_of_organization')</th>
										<td>{{$user->userinfos->orga_type}}</td>
									</tr>
									<tr>
										<th>@lang('app.txt.company_form')</th>
										<td>{{$user->userinfos->orga_form_mixte}}</td>
									</tr>
									<tr>
										<th>@lang('app.txt.presentation.organisation')</th>
										<td>{{$user->userinfos->orga_presentation}}</td>
									</tr>
									<tr>
										<th>@lang('app.txt.businessphone')</th>
										<td>{{$user->userinfos->orga_phone}}</td>
									</tr>
									<tr>
										<th>@lang('app.txt.businessfax')</th>
										<td>{{$user->userinfos->orga_fax}}</td>
									</tr>
									<tr>
										<th>@lang('app.txt.businessmobile')</th>
										<td>{{$user->userinfos->orga_mobile_phone}}</td>
									</tr>
								</table>
							</div>
							<div class="col-md-6">
								<table class='table table-borderless'>									
									<tr>
										<th>@lang('app.txt.name_building')</th>
										<td>{{$user->location->building_name}}</td>
									</tr>
									<tr>
										<th>@lang('app.txt.name_of_the_road')</th>
										<td>{{$user->location->route}}</td>
									</tr>
									<tr>
										<th>@lang('app.txt.number_of_the_road')</th>
										<td>{{$user->location->route_number}}</td>
									</tr>
									<tr>
										<th>@lang('app.txt.number_of_rooms')</th>
										<td>{{$user->location->num_rooms}}</td>
									</tr>
									<tr>
										<th>@lang('app.txt.floor')</th>
										<td>{{$user->location->num_floor}}</td>
									</tr>
									<tr>
										<th>@lang('app.txt.city')</th>
										<td>{{$user->location->locality}}</td>
									</tr>
									<tr>
										<th>@lang('app.txt.codepostal')</th>
										<td>{{$user->location->postalCode}}</td>
									</tr>
									<tr>
										<th>@lang('app.txt.etat') (@lang('app.txt.etat.libelle'))</th>
										<td>{{$user->location->area_level_1}}</td>
									</tr>
									<tr>
										<th>@lang('app.txt.country')</th>
										<td>{{$user->location->country}}</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
		<!-- fin info membre particulier-->
		<!-- info membre particulier-->
		@if($user->type_users_id == 2)
		<div class="row">
			<div class="col-md-12">
				<div class="ibox">
					<div class="ibox-title">
						<h5><i class="fa fa-info"></i> @lang('member.member_identity')</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-6">
								<table class='table table-borderless'>
									<tr>
										<th>@lang('app.txt.typemembre')</th>
										<td>{{$user->isPerson()?trans('app.txt.particulier'):trans('app.txt.organisation')}}</td>
									</tr>
									<tr>
										<th>@lang('app.txt.civility')</th>
										<td>{{$user->userinfos->civility}}</td>
									</tr>
									<tr>
										<th>@lang('app.txt.nationality')</th>
										<td>{{$user->userinfos->nationality}}</td>
									</tr>
									<tr>
										<th>@lang('app.txt.nom')</th>
										<td>{{$user->userinfos->first_name}}</td>
									</tr>
									<tr>
										<th>@lang('app.txt.prenom')</th>
										<td>{{$user->userinfos->last_name}}</td>
									</tr>
								</table>
							</div>
							<div class="col-md-6">
								<table class='table table-borderless'>
									<tr>
										<th>@lang('app.txt.sexe')</th>
										<td>{{$user->userinfos->sexe}}</td>
									</tr>
									<tr>
										<th>@lang('app.txt.date_of_birth')</th>
										<td>{{$user->userinfos?$user->userinfos->date_of_birth:trans('app.txt.noinfo')}}</td>
									</tr>
									<tr>
										<th>@lang('app.txt.place_of_birth')</th>
										<td>{{$user->userinfos?$user->userinfos->place_of_birth:trans('app.txt.noinfo')}}</td>
									</tr>
									<tr>
										<th>@lang('app.country')</th>
										<td>{{$user->location->country}}</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
		<!-- fin info membre particulier-->
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
		@if($user->type_users_id == 3 || $user->type_users_id == 1)
			<div class="row">
				<div class="col-md-6">
					<div class="ibox">
						<div class="ibox-title">
							<h5><i class="fa fa-info"></i> @lang('app.txt.business_details')</h5>
						</div>
						<div class="ibox-content">
							<table class='table table-borderless'>
								<tr>
									<th>@lang('app.txt.type_of_business')</th>
									<td>{{$user->isSbu()?trans('app.txt.builder'):trans('app.txt.developer')}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.businessname')</th>
									<td>{{$user->userinfos->orga_name}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.businesstradingname')</th>
									<td>{{$user->userinfos->orga_trading_name}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.business_abn')</th>
									<td>{{$user->userinfos->orga_abn}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.business_acn')</th>
									<td>{{$user->userinfos->orga_acn}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.businessparentname')</th>
									<td>{{$user->userinfos->orga_parent_name}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.businessphone')</th>
									<td>{{$user->userinfos->orga_phone}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.businessfax')</th>
									<td>{{$user->userinfos->orga_fax}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.businessmobile')</th>
									<td>{{$user->userinfos->orga_mobile_phone}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.websiteurl')</th>
									<td>{{$user->userinfos->orga_website}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.businesspresentation')</th>
									<td>{{$user->userinfos->orga_presentation}}</td>
								</tr>
							</table>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="ibox">
						<div class="ibox-title">
							<h5><i class="fa fa-home"></i> @lang('app.txt.office_address')</h5>
						</div>
						<div class="ibox-content">
							<table class='table table-borderless'>									
								<tr>
									<th>@lang('app.txt.name_building')</th>
									<td>{{$user->location->building_name}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.name_of_the_road')</th>
									<td>{{$user->location->route}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.number_of_the_road')</th>
									<td>{{$user->location->route_number}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.number_of_rooms')</th>
									<td>{{$user->location->num_rooms}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.floor')</th>
									<td>{{$user->location->num_floor}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.city')</th>
									<td>{{$user->location->locality}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.codepostal')</th>
									<td>{{$user->location->postalCode}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.etat') (@lang('app.txt.etat.libelle'))</th>
									<td>{{$user->location->area_level_1}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.country')</th>
									<td>{{$user->location->country}}</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		@endif
		
		@if($user->type_users_id == 2)
			<div class="row">
				<div class="col-md-12">
					<div class="ibox">
						<div class="ibox-title">
							<h5><i class="fa fa-info"></i> @lang('app.txt.seller_details')</h5>
						</div>
						<div class="ibox-content">
							<div class="row">
								<div class="col-md-6">
									<h5>Seller #1</h5>
									<table class='table table-borderless'>
										<tr>
											<th>@lang('app.txt.last_name')</th>
											<td>{{$user->sellerIndividual() && count($user->sellerIndividual()) > 0?$user->sellerIndividual()[0]->last_name:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.first_name')</th>
											<td>{{$user->sellerIndividual() && count($user->sellerIndividual()) > 0?$user->sellerIndividual()[0]->first_name:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.date_of_birth')</th>
											<td>{{$user->sellerIndividual() && count($user->sellerIndividual()) > 0?$user->sellerIndividual()[0]->date_of_birth:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.place_of_birth')</th>
											<td>{{$user->sellerIndividual() && count($user->sellerIndividual()) > 0?$user->sellerIndividual()[0]->place_of_birth:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.nationality')</th>
											<td>{{$user->sellerIndividual() && count($user->sellerIndividual()) > 0?$user->sellerIndividual()[0]->nationality:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.streetaddress')</th>
											<td>{{$user->sellerIndividual() && count($user->sellerIndividual()) > 0?$user->sellerIndividual()[0]->street_adr:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.suburb')</th>
											<td>{{$user->sellerIndividual() && count($user->sellerIndividual()) > 0?$user->sellerIndividual()[0]->suburb:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.city')</th>
											<td>{{$user->sellerIndividual() && count($user->sellerIndividual()) > 0?$user->sellerIndividual()[0]->city:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.codepostal')</th>
											<td>{{$user->sellerIndividual() && count($user->sellerIndividual()) > 0?$user->sellerIndividual()[0]->post_code:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.etat') (@lang('app.txt.etat.libelle'))</th>
											<td>{{$user->sellerIndividual() && count($user->sellerIndividual()) > 0?$user->sellerIndividual()[0]->state:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.country')</th>
											<td>{{$user->sellerIndividual() && count($user->sellerIndividual()) > 0?$user->sellerIndividual()[0]->country:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.mobile_seller',['num'=>1])</th>
											<td>{{$user->sellerIndividual()?$user->sellerIndividual()[0]->mobile:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.email')</th>
											<td>{{$user->sellerIndividual() && count($user->sellerIndividual()) > 0?$user->sellerIndividual()[0]->email_adr:trans('app.txt.noinfo')}}</td>
										</tr>
									</table>
								</div>
								<div class="col-md-6">
									<h5>Seller #2</h5>
									<table class='table table-borderless'>
										<tr>
											<th>@lang('app.txt.last_name')</th>
											<td>{{$user->sellerIndividual() && count($user->sellerIndividual()) > 0?$user->sellerIndividual()[1]->last_name:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.first_name')</th>
											<td>{{$user->sellerIndividual() && count($user->sellerIndividual()) > 0?$user->sellerIndividual()[1]->first_name:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.date_of_birth')</th>
											<td>{{$user->sellerIndividual() && count($user->sellerIndividual()) > 0?$user->sellerIndividual()[1]->date_of_birth:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.place_of_birth')</th>
											<td>{{$user->sellerIndividual() && count($user->sellerIndividual()) > 0?$user->sellerIndividual()[1]->place_of_birth:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.nationality')</th>
											<td>{{$user->sellerIndividual() && count($user->sellerIndividual()) > 0?$user->sellerIndividual()[1]->nationality:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.streetaddress')</th>
											<td>{{$user->sellerIndividual() && count($user->sellerIndividual()) > 0?$user->sellerIndividual()[1]->street_adr:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.suburb')</th>
											<td>{{$user->sellerIndividual() && count($user->sellerIndividual()) > 0?$user->sellerIndividual()[1]->suburb:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.city')</th>
											<td>{{$user->sellerIndividual() && count($user->sellerIndividual()) > 0?$user->sellerIndividual()[1]->city:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.codepostal')</th>
											<td>{{$user->sellerIndividual() && count($user->sellerIndividual()) > 0?$user->sellerIndividual()[1]->post_code:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.etat') (@lang('app.txt.etat.libelle'))</th>
											<td>{{$user->sellerIndividual() && count($user->sellerIndividual()) > 0?$user->sellerIndividual()[1]->state:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.country')</th>
											<td>{{$user->sellerIndividual() && count($user->sellerIndividual()) > 0?$user->sellerIndividual()[1]->country:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.mobile_seller',['num'=>2])</th>
											<td>{{$user->sellerIndividual() && count($user->sellerIndividual()) > 0?$user->sellerIndividual()[1]->mobile:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.email')</th>
											<td>{{$user->sellerIndividual() && count($user->sellerIndividual()) > 0?$user->sellerIndividual()[1]->email_adr:trans('app.txt.noinfo')}}</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endif
		
		<!-- info seller by AFA-->
		@if($user->type_users_id == 8 || $user->type_users_id == 9)
		<div class="row">
			<div class="col-md-4">
				<div class="ibox">
					<div class="ibox-title">
						<h5><i class="fa fa-info"></i> @lang('app.txt.registering_afa')</h5>
					</div>
					<div class="ibox-content">
						<table class='table table-borderless'>
							@php
								$afaInfo = App\Models\User::where('id',$user->afa_id)->first();
							@endphp
							<tr>
								<th>@lang('app.txt.afa_name')</th>
								<td>{{$afaInfo->name}}</td>
							</tr>
							<tr>
								<th>@lang('app.txt.afa_id')</th>
								<td>{{$afaInfo->immat}}</td>
							</tr>
							<tr>
								<th>@lang('app.txt.name_of_property_to_be_sold')</th>
								<td>{{$user->property_name}}</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			
			<div class="col-md-8">
				<div class="ibox">
					<div class="ibox-title">
						<h5><i class="fa fa-info"></i> @lang('app.txt.seller_details')</h5>
					</div>
					<div class="ibox-content">
						@if($user->type_users_id == 8)
							<div class="row">
								<div class="col-md-6">
									<h5>Seller #1</h5>
									<table class='table table-borderless'>
										<tr>
											<th>@lang('app.txt.last_name')</th>
											<td>{{$user->sellerIndividual()?$user->sellerIndividual()[0]->last_name:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.first_name')</th>
											<td>{{$user->sellerIndividual()?$user->sellerIndividual()[0]->first_name:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.date_of_birth')</th>
											<td>{{$user->sellerIndividual()?$user->sellerIndividual()[0]->date_of_birth:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.place_of_birth')</th>
											<td>{{$user->sellerIndividual()?$user->sellerIndividual()[0]->place_of_birth:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.nationality')</th>
											<td>{{$user->sellerIndividual()?$user->sellerIndividual()[0]->nationality:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.streetaddress')</th>
											<td>{{$user->sellerIndividual()?$user->sellerIndividual()[0]->street_adr:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.suburb')</th>
											<td>{{$user->sellerIndividual()?$user->sellerIndividual()[0]->suburb:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.city')</th>
											<td>{{$user->sellerIndividual()?$user->sellerIndividual()[0]->city:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.codepostal')</th>
											<td>{{$user->sellerIndividual()?$user->sellerIndividual()[0]->post_code:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.etat') (@lang('app.txt.etat.libelle'))</th>
											<td>{{$user->sellerIndividual()?$user->sellerIndividual()[0]->state:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.country')</th>
											<td>{{$user->sellerIndividual()?$user->sellerIndividual()[0]->country:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.mobile_seller',['num'=>1])</th>
											<td>{{$user->sellerIndividual()?$user->sellerIndividual()[0]->mobile:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.email')</th>
											<td>{{$user->sellerIndividual()?$user->sellerIndividual()[0]->email_adr:trans('app.txt.noinfo')}}</td>
										</tr>
									</table>
								</div>
								<div class="col-md-6">
									<h5>Seller #2</h5>
									<table class='table table-borderless'>
										<tr>
											<th>@lang('app.txt.last_name')</th>
											<td>{{$user->sellerIndividual()?$user->sellerIndividual()[1]->last_name:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.first_name')</th>
											<td>{{$user->sellerIndividual()?$user->sellerIndividual()[1]->first_name:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.date_of_birth')</th>
											<td>{{$user->sellerIndividual()?$user->sellerIndividual()[1]->date_of_birth:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.place_of_birth')</th>
											<td>{{$user->sellerIndividual()?$user->sellerIndividual()[1]->place_of_birth:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.nationality')</th>
											<td>{{$user->sellerIndividual()?$user->sellerIndividual()[1]->nationality:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.streetaddress')</th>
											<td>{{$user->sellerIndividual()?$user->sellerIndividual()[1]->street_adr:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.suburb')</th>
											<td>{{$user->sellerIndividual()?$user->sellerIndividual()[1]->suburb:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.city')</th>
											<td>{{$user->sellerIndividual()?$user->sellerIndividual()[1]->city:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.codepostal')</th>
											<td>{{$user->sellerIndividual()?$user->sellerIndividual()[1]->post_code:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.etat') (@lang('app.txt.etat.libelle'))</th>
											<td>{{$user->sellerIndividual()?$user->sellerIndividual()[1]->state:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.country')</th>
											<td>{{$user->sellerIndividual()?$user->sellerIndividual()[1]->country:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.mobile_seller',['num'=>2])</th>
											<td>{{$user->sellerIndividual()?$user->sellerIndividual()[1]->mobile:trans('app.txt.noinfo')}}</td>
										</tr>
										<tr>
											<th>@lang('app.txt.email')</th>
											<td>{{$user->sellerIndividual()?$user->sellerIndividual()[1]->email_adr:trans('app.txt.noinfo')}}</td>
										</tr>
									</table>
								</div>
							</div>
						@endif
						@if($user->type_users_id == 9)
							<table class='table table-borderless'>
								<tr>
									<th>@lang('app.txt.businessname')</th>
									<td>{{$user->sellerBusiness()->business_name}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.businessparentname') (@lang('app.txt.for_information'))</th>
									<td>{{$user->sellerBusiness()->business_parent}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.streetaddress')</th>
									<td>{{$user->sellerBusiness()->street_adr}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.suburb')</th>
									<td>{{$user->sellerBusiness()->suburb}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.city')</th>
									<td>{{$user->sellerBusiness()->city}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.codepostal')</th>
									<td>{{$user->sellerBusiness()->post_code}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.etat')</th>
									<td>{{$user->sellerBusiness()->state}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.country')</th>
									<td>{{$user->sellerBusiness()->country}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.businessphone')</th>
									<td>{{$user->sellerBusiness()->phone}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.businessmobile')</th>
									<td>{{$user->sellerBusiness()->mobile}}</td>
								</tr>
								<tr>
									<th>@lang('app.txt.businessemail')</th>
									<td>{{$user->sellerBusiness()->email_adr}}</td>
								</tr>
							</table>
						@endif
					</div>
				</div>
			</div>
		</div>
		@endif
		<!-- fin info seller by AFA-->
	<div class="row">
		<div class="col-md-12">
			<div class="ibox">
				<div class="ibox-title">
					<h5><i class="fa fa-product-hunt"></i> @lang('app.products')</h5>
				</div>
				<div class="ibox-content">
					<div class="table-responsive">
						@include('admin.table.product',[
							'products'=>$user->products
						])
					</div>

				</div>
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="ibox">
				<div class="ibox-title">
					<h5><i class="fa fa-calendar"></i> @lang('app.orders')</h5>
				</div>
				<div class="ibox-content">
					<div class="table-responsive">
						@include('admin.table.product',[
							'products'=>$user->products()->where('products.status', 'ordered')
						])
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="ibox">
				<div class="ibox-title">
					<h5><i class="fa fa-briefcase"></i> @lang('app.sales')</h5>
				</div>
				<div class="ibox-content">
					<div class="table-responsive">
						@include('admin.table.product',[
							'products'=>$user->products()->where('products.status', 'paid')
						])
					</div>
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