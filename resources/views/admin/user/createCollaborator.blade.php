@extends('admin.layouts.app')

@section('title', 'Users - Ajout ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.stakeholders')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.txt.stakeholders')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">@lang('app.txt.collaborator')</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.add_collaborator')</strong>
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
                <h5>@lang('app.txt.add_collaborator')</h5>
            </div>
            <div class="ibox-content">
                <form class="form-validation form-padding" action="{{ route('admin.user.store') }}" method="post">
					<h3 class="m-t-none m-b">@lang('app.txt.login_info')</h3>
                    {{ csrf_field() }}
                    <div class="row">
						<div class="col-md-12 col-lg-6">                                    
							<div class="form-group">
								<label for="login">@lang('app.form.login') *</label>
								<input name="login" id="login" class="form-control" type="text" value="">
								<span class="text-danger">{{ $errors->has('login') ? $errors->first('login') : '' }}</span>
							</div>
						</div>
						<div class="col-md-12 col-lg-6">   
							<div class="form-group">
								<label for="email">@lang('app.form.email') *</label>
								<input name="email" id="email" class="form-control" type="email" value="">
								<span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
							</div>
						</div>
						<div class="col-md-12 col-lg-6">                                    
							<div class="form-group">
								<label for="first_name">@lang('app.form.first_name')</label>
								<input name="first_name" id="first_name" class="form-control" type="text" value="">
							</div>
						</div>
						<div class="col-md-12 col-lg-6">                                    
							<div class="form-group">
								<label for="last_name">@lang('app.form.last_name')</label>
								<input name="last_name" id="last_name" class="form-control" type="text" value="">
							</div>
						</div>  	
						<div class="col-md-12 col-lg-6">   
							<div class="form-group">
								<label for="password">@lang('app.password') *</label>
								<div class="row col-lg-12">
									<div class="input-password">
										<input hidden="hidden" name="password" id="password" class="form-control" type="text" value="{{ genMdpAleatoire() }}">
									</div>
									<div class="col-lg-4">
										<button type="button" class="btn btn-outline-info" id="btn_show_password">@lang('app.txt.show_password')</button>
										<button type="button" class="btn btn-success" id="btn_hide_password" hidden="hidden">@lang('app.txt.hide_password')</button>
									</div>
								</div>
							</div>
						</div> 
						<div class="col-md-12 col-lg-6">
							
							<div class="form-group">
								<label for="send_notification">@lang('app.txt.send_user_notification')</label>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="1" id="send_notification" name="send_notification" {{ old('send_notification')?'checked':'' }}>
									<label class="form-check-label" for="flexCheckChecked">
										@lang('app.txt.send_new_user_an_email_about_their_account')
									</label>
								</div>
							</div>
						</div> 
						<div class="col-md-12 col-lg-6">  
							<div class="form-group">
								<label for="language">@lang('app.language') *</label>
								<select name="language" class="form-control" id="language">
									<option value="fr">Français</option>
									<option value="en">English</option>
								</select>
							</div>
						</div>
						<div class="col-md-12 col-lg-6">  
							<div class="form-group">
								<label for="permission">@lang('app.txt.role') *</label>
								<div class="form-check">
									<div class="row col-lg-12">
										<div class="col-lg-6">
											<input class="form-check-input" type="checkbox" value="0" name="permission" id="role_1" checked>
											<label class="form-check-label" for="flexCheckChecked">
												@lang('app.txt.blog_admin')
											</label>
										</div>
										<div class="col-lg-6">
											<input class="form-check-input" type="checkbox" value="1" name="permission" id="role_2" {{ old('permission')?'checked':'' }}>
											<label class="form-check-label" for="flexCheckChecked">
												@lang('app.txt.managing_director')
											</label>	
										</div>
									</div>
								</div>
								<span class="text-danger">{{ $errors->has('permission') ? $errors->first('permission') : '' }}</span>
							</div>
						</div>
					</div>
                    
					<div class="hr-line-dashed"></div>    
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

	$('#btn_show_password').click(function(){
		$('.input-password').addClass('col-lg-8');
		$('.input-password input').removeAttr('hidden');
		$('#btn_hide_password').removeAttr('hidden');
		$('#btn_hide_password').show();

		return $(this).hide();
	});

	$('#btn_hide_password').click(function(){
		$('.input-password').removeClass('col-lg-8');
		$('.input-password input').attr('hidden','hidden');
		$('#btn_show_password').show();

		return $(this).hide();
	});
});
</script>
@endsection