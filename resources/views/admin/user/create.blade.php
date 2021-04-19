@extends('admin.layouts.app')

@section('title', 'Users - Ajout ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Users</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Users</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.user.index') }}">Listes</a>
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
                <h5>Ajouter un nouveau partie prenante</h5>
            </div>
            <div class="ibox-content">
                <form class="form-validation form-padding" action="{{ route('admin.user.store') }}" method="post">
					<h3 class="m-t-none m-b">Informations de connexion</h3>
                    {{ csrf_field() }}
                    <div class="row">
						<div class="col-md-3">                                    
							<div class="form-group">
								<label for="title">Nom d'utilisateur *</label>
								<input name="name" id="name" class="form-control" type="text" value="">
							</div>
						</div>						
						<div class="col-md-3">  
							<div class="form-group">
								<label for="title">Type *</label>
								<select class="form-control" name="type_users_id" id="type_users_id">
									<option value="">Choisir...</option>
									@foreach(\App\Models\TypeUser::all() as $typeU)
										<option value="{{$typeU->id}}">{{$typeU->type_user_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-3">  
							<div class="form-group">
								<label for="title">Rôle *</label>
								<select class="form-control" name="role" id="role">
									<option value="">Choisir...</option>
									@foreach(\App\Models\Role::all() as $role)
										<option value="{{$role->id}}">{{$role->role_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						
						<div class="col-md-3">  
							<div id="type_membre" style="display:none">
								<div class="form-group">
									<label for="title">Type membre *</label>
									<select class="form-control" name="membre_type" id="membre_type">
										<option value="person">Particulier</option>
										<option value="organization">Organisation</option>
									</select>
								</div>
							</div>
						</div>
					</div>
                    
					<div class="row">
						<div class="col-md-4">   
							<div class="form-group">
								<label for="title">Adresse email *</label>
								<input name="email" id="email" class="form-control" type="email" value="">
							</div>
						</div>  
						<div class="col-md-4">   
							<div class="form-group">
								<label for="title">Mot de passe *</label>
								<input name="password" id="password" class="form-control" type="password" value="">
							</div>
						</div>  
						<div class="col-md-4">  
							<div class="form-group">
								<label for="title">Langue *</label>
								<select name="language" class="form-control" id="language">
									<option value="fr">Français</option>
									<option value="en">English</option>
								</select>
							</div>
						</div>
					</div>
					<div class="hr-line-dashed"></div>    
					
					<!-- info en tant que vendeur -->
					<div id="info_seller" style="display:none">
						<h3 class="m-t-none m-b">Détails de l'entreprise (info pour le vendeur)</h3>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="title">Type de l'entreprise *</label>
									<select name="type_seller" class="form-control" id="type_seller">
										<option value="builder"> Builder</option>
										<option value="developer"> Developer</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="title">Nom de l'entreprise *</label>
									<input type="text" class="form-control" id="orga_name_seller" name="orga_name_seller" placeholder="Business Name" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="title">Email de l'entreprise *</label>
									<input type="email" class="form-control" id="orga_email_seller" name="orga_email_seller" placeholder="Business Email" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="title">Tél de l'entreprise *</label>
									<input type="text" class="form-control" id="orga_phone_seller" name="orga_phone_seller" placeholder="Business Phone" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="title">Site web de l'entreprise *</label>
									<input type="text" class="form-control" id="orga_website_seller" name="orga_website_seller" placeholder="Business Website" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="title">Logo *</label>
									<input type="file" class="form-control" id="image_seller" name="image_seller" >
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="title">Présentation de l'entreprise *</label>
									<textarea class="form-control" id="orga_presentation_seller" name="orga_presentation_seller" placeholder="Business Presentation" rows="5"></textarea>
								</div>
							</div>
						</div>
						<div class="hr-line-dashed"></div>
					</div>
					<!-- fin info en tant que vendeur -->
					
					
					<!-- info en tant que afa -->
					<div id="info_afa" style="display:none">
						<h3 class="m-t-none m-b">Détails de l'entreprise (info pour AFA)</h3>
						<div class="row">							
							<div class="col-md-4">
								<div class="form-group">
									<label for="title">Nom de l'entreprise *</label>
									<input type="text" class="form-control" id="orga_name_afa" name="orga_name_afa" placeholder="Business Name" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="title">Email de l'entreprise *</label>
									<input type="email" class="form-control" id="orga_email_afa" name="orga_email_afa" placeholder="Business Email" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="title">Tél de l'entreprise *</label>
									<input type="text" class="form-control" id="orga_phone_afa" name="orga_phone_afa" placeholder="Business Phone" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="title">Site web de l'entreprise *</label>
									<input type="text" class="form-control" id="orga_website_afa" name="orga_website_afa" placeholder="Business Website" required>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="title">Logo *</label>
									<input type="file" class="form-control" id="image_afa" name="image_afa" >
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="title">State of legal operation of your present office *</label>
									<select class="form-control" name="orga_operation_state_afa">
										<option value="0">@lang('app.select_state')</option>
										@foreach(\App\Models\State::all() as $state)
											<option value="{{$state->id}}">{{$state->content}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="title">Range of operation of your present office *</label>
									<select class="form-control" name="orga_operation_range" id="orga_operation_range">
										<option value="10"> 10km</option>
										<option value="25"> 25km</option>
										<option value="50"> 50km</option>
										<option value="100"> 100km</option>
										<option value="250"> 250km</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="title">Présentation de l'entreprise *</label>
									<textarea class="form-control" id="orga_presentation_afa" name="orga_presentation_afa" placeholder="Business Presentation" rows="5"></textarea>
								</div>
							</div>
						</div>
						<div class="hr-line-dashed"></div>
					</div>
					<!-- fin info en tant que afa -->
					
					
					<!-- info en tant que apl -->
					<div id="info_apl" style="display:none">
						<h3 class="m-t-none m-b">Détails de l'entreprise (info pour APL)</h3>
						<div class="row">							
							<div class="col-md-4">
								<div class="form-group">
									<label for="title">Nom de l'entreprise *</label>
									<input type="text" class="form-control" id="orga_name_apl" name="orga_name_apl" placeholder="Business Name" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="title">Email de l'entreprise *</label>
									<input type="email" class="form-control" id="orga_email_apl" name="orga_email_apl" placeholder="Business Email" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="title">Tél de l'entreprise *</label>
									<input type="text" class="form-control" id="orga_phone_apl" name="orga_phone_apl" placeholder="Business Phone" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="title">Site web de l'entreprise *</label>
									<input type="text" class="form-control" id="orga_website_apl" name="orga_website_apl" placeholder="Business Website" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="title">Logo *</label>
									<input type="file" class="form-control" id="image_apl" name="image_apl" >
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="title">Range of operation of your present office *</label>
									<select class="form-control" name="orga_operation_range_apl" id="orga_operation_range_apl">
										<option value="10"> 10km</option>
										<option value="25"> 25km</option>
										<option value="50"> 50km</option>
										<option value="100"> 100km</option>
										<option value="250"> 250km</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="title">Présentation de l'entreprise *</label>
									<textarea class="form-control" id="orga_presentation_apl" name="orga_presentation_apl" placeholder="Business Presentation" rows="5"></textarea>
								</div>
							</div>
						</div>
						<div class="hr-line-dashed"></div>
					</div>
					<!-- fin info en tant que apl -->
					
					
					<!-- info en tant que membre -->
					<div id="info_membre" style="display:none">
						<h3 class="m-t-none m-b">Informations de l'Utilisateur</h3>
						<div class="row">		
							<div class="col-md-6">
								<div class="form-group">
									<label for="title">Nom *</label>
									<input name="nom_membre" id="nom_membre" class="form-control" type="text" value="">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="title">Prénom *</label>
									<input name="prenom_membre" id="prenom_membre" class="form-control" type="text" value="">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="title">Sexe *</label>
									<select class="form-control" name="sexe">
										<option value="0" selected="" disabled="">Choisir un sexe</option>
										<option value="M">Masculin</option>
										<option value="F">Féminin</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="title">Pays *</label>
									<select class="form-control" name="pays_membre" id="pays_membre">
										<option value="0" selected="" disabled="">Choisir un pays</option>
										@foreach(\App\Models\Country::all() as $country)
											<option value="{{$country->id}}">{{$country->content}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-6">   
								<div class="form-group">
									<label for="title">Avatar *</label>
									<input name="avatar_membre" id="avatar_membre" class="form-control" type="file" value="">
								</div>
							</div>  
						</div>
						<div class="hr-line-dashed"></div>
					</div>
					<!-- fin info en tant que membre -->
					
					<!-- info organisation -->
					<div id="info_organisation" style="display:none">
						<h3 class="m-t-none m-b">Détails de l'organisation</h3>
						<div class="row">
							<div class="col-md-8">
								<div class="form-group">
									<label for="title">Nom de l'organisation *</label>
									<input type="text" class="form-control" id="nom_organisation" name="nom_organisation" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="title">Logo *</label>
									<input type="file" class="form-control" id="logo_organisation" name="logo_organisation" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="title">Adresse Email *</label>
									<input type="email" class="form-control" id="email_organisation" name="email_organisation" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="title">Téléphone *</label>
									<input type="text" class="form-control" id="tel_organisation" name="tel_organisation" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="title">Site Web URL *</label>
									<input type="text" class="form-control" id="web_organisation" name="web_organisation" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="title">Présentation de l'organisation * *</label>
									<textarea class="form-control" name="orga_presentation" rows="10" required=""></textarea>
								</div>
							</div>
						</div>
						<div class="hr-line-dashed"></div>
					</div>
					<!-- fin info organisation-->
					
					<!-- information localité-->
					<div id="info_localite" style="display:none">
						<h3 class="m-t-none m-b">Information localité</h3> 					
						<div class="row">
							<div class="col-md-4">   
								<div class="form-group">
									<label for="title">Etat *</label>
									<select class="form-control" name="state_user" id="state_user">
										<option value="">Choisir...</option>
										@foreach(\App\Models\State::all() as $state)
											<option value="{{$state->id}}">{{$state->content}}</option>
										@endforeach
									</select>
								</div>
							</div>  
							<div class="col-md-4">   
								<div class="form-group">
									<label for="title">Suburb *</label>
									<input type="text" class="form-control" id="area_level_2" name="area_level_2" placeholder="Suburb" required>
								</div>
							</div>  
							<div class="col-md-4">  
								<div class="form-group">
									<label for="title">Ville *</label>
									<input type="text" class="form-control" id="locality" name="locality" placeholder="City" required>
								</div>
							</div>
						</div> 
						<div class="row">
							<div class="col-md-8">
								<div class="form-group">
									<label for="title">Adresse *</label>
									<input type="text" class="form-control" id="route" name="route" placeholder="Street Address" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="title">Code postal *</label>
									<input type="text" class="form-control" id="route" name="route" placeholder="Street Address" required>
								</div>
							</div>
						</div>
						<div class="hr-line-dashed"></div>
					</div>  
					<!-- information localité-->
					
					<!-- info contact -->
					<div id="info_contact" style="display:none">
						<h3 class="m-t-none m-b">Détails du contact</h3> 
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="title">Nom du contact *</label>
									<input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Contact Name" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="title">Email du contact *</label>
									<input type="text" class="form-control" id="contact_email" name="contact_email" placeholder="Contact Email" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="title">Tél du contact *</label>
									<input type="text" class="form-control" id="contact_phone" name="contact_phone" placeholder="Contact Phone" required>
								</div>
							</div>
						</div>
						<div class="hr-line-dashed"></div>
					</div>
					<!-- fin info contact -->
					
					<!-- info du fournisseur -->
					<div id="info_fournisseur" style="display:none">
						<h3 class="m-t-none m-b">CRM du Fournisseur</h3>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="title">CRM nom du fournisseur *</label>
									<input type="text" class="form-control" id="crm_name" name="crm_name" placeholder="CRM Provider Name" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="title">CRM email du fournisseur *</label>
									<input type="text" class="form-control" id="crm_email" name="crm_email" placeholder="CRM Provider Email" required>
								</div>
							</div>
						</div>
					</div>
					<!-- fin info du fournisseur -->
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Créer</button>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('custom-script')
<script>
$(document).ready(function(){
	$('#role').change(function() {
	    var role = this.value;
		if(role == 2){
			<!--en tant que vendeur -->
			$('#info_seller').show();
			$('#info_localite').show();
			$('#info_contact').show();
			$('#info_fournisseur').show();
			
			$('#info_afa').hide();
			$('#info_apl').hide();
			$('#info_membre').hide();
			$('#type_membre').hide();
			$('#info_organisation').hide();
		}else if(role == 3){
			<!-- en tant que afa -->
			$('#info_afa').show();
			$('#info_localite').show();
			$('#info_contact').show();
			$('#info_fournisseur').show();
			
			$('#info_seller').hide();
			$('#info_apl').hide();
			$('#info_membre').hide();
			$('#type_membre').hide();
			$('#info_organisation').hide();
		}else if(role == 4){
			<!-- en tant que apl -->
			$('#info_apl').show();
			$('#info_localite').show();
			$('#info_contact').show();
			$('#info_fournisseur').show();
			
			$('#info_seller').hide();
			$('#info_afa').hide();
			$('#info_membre').hide();
			$('#type_membre').hide();
			$('#info_organisation').hide();
		}else if(role == 5){
			<!--en tant que membre -->			
			$('#info_membre').show();
			$('#info_organisation').hide();
			$('#type_membre').show();
			$('#membre_type').change(function() {
				var type = this.value;
				if(type == 'organization'){
					$('#info_organisation').show();
					$('#info_localite').show();
					$('#info_contact').show();
					$('#info_membre').hide();
				}else{
					$('#info_membre').show();
					$('#info_organisation').hide();
					$('#info_seller').hide();
					$('#info_afa').hide();
					$('#info_apl').hide();
					$('#info_localite').hide();
					$('#info_contact').hide();
				}
			});
		}
	});
});
</script>
@endsection