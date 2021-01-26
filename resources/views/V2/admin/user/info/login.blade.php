<div class="ibox ">
	<div class="ibox-title">
		<h5>@lang('app.login_info')</h5>
	</div>
	<div class="ibox-content">
		<div class="row">
			<div class="col-md-4">
				<img src="{{$item->imageUrl(false)}}" alt="{{$item->name}}"  width="100%">
			</div>
			<div class="col-md-8">
				<table class='table table-borderless'>
					<tr>
						<th width="35%">@lang('app.form.login')</th>
						<td>{{$item->name}}</td>
					</tr>
					<tr>
						<th width="35%">@lang('app.form.email')</th>
						<td>{{$item->email}}</td>
					</tr>
					<tr>
						<th width="35%">@lang('app.form.language')</th>
						<td>{{$item->language=='en'?'English':'Français'}}</td>
					</tr>
					<tr>
						<th width="35%">@lang('app.user.ontrial')</th>
						<td>{{$item->onTrial()?'oui':'non'}}</td>
					</tr>
					<tr>
						<th width="35%">@lang('app.user.trial_end_at')</th>
						<td>{{$item->trial_ends_at}}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- // Widget -->