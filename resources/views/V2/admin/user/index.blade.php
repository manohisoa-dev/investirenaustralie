@extends('V2.admin.layouts.app')

@section('title', 'Users - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Users</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('V2.admin.user.index') }}">Users</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ route('V2.admin.user.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Ajouter un nouveau User            </a>
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Users</h5>
			</div>
			<div class="ibox-content">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
                                                    {!!\Nvd\Crud\Html::sortableTh('id','V2.admin.user.index','Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('name','V2.admin.user.index','Name')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('email','V2.admin.user.index','Email')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('password','V2.admin.user.index','Password')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('role','V2.admin.user.index','Role')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('type','V2.admin.user.index','Type')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('language','V2.admin.user.index','Language')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('status','V2.admin.user.index','Status')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('percent','V2.admin.user.index','Percent')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('enabled_at','V2.admin.user.index','Enabled At')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('disabled_at','V2.admin.user.index','Disabled At')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('use_default_password','V2.admin.user.index','Use Default Password')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('is_seller','V2.admin.user.index','Is Seller')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('apl_id','V2.admin.user.index','Apl Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('apl_ends_at','V2.admin.user.index','Apl Ends At')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('image_id','V2.admin.user.index','Image Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('author_id','V2.admin.user.index','Author Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('location_id','V2.admin.user.index','Location Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('country_id','V2.admin.user.index','Country Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('operation_range','V2.admin.user.index','Operation Range')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('state_id','V2.admin.user.index','State Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('activation_code','V2.admin.user.index','Activation Code')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('remember_token','V2.admin.user.index','Remember Token')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('created_at','V2.admin.user.index','Created At')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('updated_at','V2.admin.user.index','Updated At')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('braintree_id','V2.admin.user.index','Braintree Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('paypal_email','V2.admin.user.index','Paypal Email')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('stripe_id','V2.admin.user.index','Stripe Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('card_brand','V2.admin.user.index','Card Brand')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('card_last_four','V2.admin.user.index','Card Last Four')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('trial_ends_at','V2.admin.user.index','Trial Ends At')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('subscription_ends_at','V2.admin.user.index','Subscription Ends At')!!}
                                                <th><a href="javascript:void(0)">Actions</a></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
                                                            <td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
                                                            <td><input type="text" class="form-control" name="name" value="{{Request::input("name")}}"></td>
                                                            <td><input type="text" class="form-control" name="email" value="{{Request::input("email")}}"></td>
                                                            <td><input type="text" class="form-control" name="password" value="{{Request::input("password")}}"></td>
                                                            <td><input type="text" class="form-control" name="role" value="{{Request::input("role")}}"></td>
                                                            <td><input type="text" class="form-control" name="type" value="{{Request::input("type")}}"></td>
                                                            <td><input type="text" class="form-control" name="language" value="{{Request::input("language")}}"></td>
                                                            <td><input type="text" class="form-control" name="status" value="{{Request::input("status")}}"></td>
                                                            <td><input type="text" class="form-control" name="percent" value="{{Request::input("percent")}}"></td>
                                                            <td><input type="text" class="form-control" name="enabled_at" value="{{Request::input("enabled_at")}}"></td>
                                                            <td><input type="text" class="form-control" name="disabled_at" value="{{Request::input("disabled_at")}}"></td>
                                                            <td><input type="text" class="form-control" name="use_default_password" value="{{Request::input("use_default_password")}}"></td>
                                                            <td><input type="text" class="form-control" name="is_seller" value="{{Request::input("is_seller")}}"></td>
                                                            <td><input type="text" class="form-control" name="apl_id" value="{{Request::input("apl_id")}}"></td>
                                                            <td><input type="text" class="form-control" name="apl_ends_at" value="{{Request::input("apl_ends_at")}}"></td>
                                                            <td><input type="text" class="form-control" name="image_id" value="{{Request::input("image_id")}}"></td>
                                                            <td><input type="text" class="form-control" name="author_id" value="{{Request::input("author_id")}}"></td>
                                                            <td><input type="text" class="form-control" name="location_id" value="{{Request::input("location_id")}}"></td>
                                                            <td><input type="text" class="form-control" name="country_id" value="{{Request::input("country_id")}}"></td>
                                                            <td><input type="text" class="form-control" name="operation_range" value="{{Request::input("operation_range")}}"></td>
                                                            <td><input type="text" class="form-control" name="state_id" value="{{Request::input("state_id")}}"></td>
                                                            <td><input type="text" class="form-control" name="activation_code" value="{{Request::input("activation_code")}}"></td>
                                                            <td><input type="text" class="form-control" name="remember_token" value="{{Request::input("remember_token")}}"></td>
                                                            <td><input type="text" class="form-control" name="created_at" value="{{Request::input("created_at")}}"></td>
                                                            <td><input type="text" class="form-control" name="updated_at" value="{{Request::input("updated_at")}}"></td>
                                                            <td><input type="text" class="form-control" name="braintree_id" value="{{Request::input("braintree_id")}}"></td>
                                                            <td><input type="text" class="form-control" name="paypal_email" value="{{Request::input("paypal_email")}}"></td>
                                                            <td><input type="text" class="form-control" name="stripe_id" value="{{Request::input("stripe_id")}}"></td>
                                                            <td><input type="text" class="form-control" name="card_brand" value="{{Request::input("card_brand")}}"></td>
                                                            <td><input type="text" class="form-control" name="card_last_four" value="{{Request::input("card_last_four")}}"></td>
                                                            <td><input type="text" class="form-control" name="trial_ends_at" value="{{Request::input("trial_ends_at")}}"></td>
                                                            <td><input type="text" class="form-control" name="subscription_ends_at" value="{{Request::input("subscription_ends_at")}}"></td>
                                                        <td style="min-width: 6em;">@include('vendor.crud.single-page-templates.common.search-btn')</td>
                        </form>
                    </tr>
                    </thead>

                    <tbody>
                        @forelse ( $records as $record )
                            <tr>
                                                                <td>
                                                                            {{ $record->id }}
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="name"
                                          data-value="{{ $record->name }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->name }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="email"
                                          data-name="email"
                                          data-value="{{ $record->email }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->email }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="password"
                                          data-value="{{ $record->password }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->password }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="role"
                                          data-value="{{ $record->role }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->role }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="type"
                                          data-value="{{ $record->type }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->type }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="language"
                                          data-value="{{ $record->language }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->language }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="status"
                                          data-value="{{ $record->status }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->status }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="percent"
                                          data-value="{{ $record->percent }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->percent }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="datetime"
                                          data-name="enabled_at"
                                          data-value="{{ $record->enabled_at }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->enabled_at }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="datetime"
                                          data-name="disabled_at"
                                          data-value="{{ $record->disabled_at }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->disabled_at }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="number"
                                          data-name="use_default_password"
                                          data-value="{{ $record->use_default_password }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->use_default_password }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="number"
                                          data-name="is_seller"
                                          data-value="{{ $record->is_seller }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->is_seller }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="apl_id"
                                          data-value="{{ $record->apl_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->apl_id }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="datetime"
                                          data-name="apl_ends_at"
                                          data-value="{{ $record->apl_ends_at }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->apl_ends_at }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="image_id"
                                          data-value="{{ $record->image_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->image_id }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="author_id"
                                          data-value="{{ $record->author_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->author_id }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="location_id"
                                          data-value="{{ $record->location_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->location_id }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="country_id"
                                          data-value="{{ $record->country_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->country_id }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="operation_range"
                                          data-value="{{ $record->operation_range }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->operation_range }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="state_id"
                                          data-value="{{ $record->state_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->state_id }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="activation_code"
                                          data-value="{{ $record->activation_code }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->activation_code }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="remember_token"
                                          data-value="{{ $record->remember_token }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->remember_token }}</span>
                                                                    </td>
                                                                <td>
                                                                            {{ $record->created_at }}
                                                                    </td>
                                                                <td>
                                                                            {{ $record->updated_at }}
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="braintree_id"
                                          data-value="{{ $record->braintree_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->braintree_id }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="email"
                                          data-name="paypal_email"
                                          data-value="{{ $record->paypal_email }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->paypal_email }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="stripe_id"
                                          data-value="{{ $record->stripe_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->stripe_id }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="card_brand"
                                          data-value="{{ $record->card_brand }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->card_brand }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="card_last_four"
                                          data-value="{{ $record->card_last_four }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->card_last_four }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="trial_ends_at"
                                          data-value="{{ $record->trial_ends_at }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->trial_ends_at }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="subscription_ends_at"
                                          data-value="{{ $record->subscription_ends_at }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->subscription_ends_at }}</span>
                                                                    </td>
                                                                @include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => route('V2.admin.user.index'), 'record' => $record ] )
                            </tr>
                        @empty
                            @include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 33])
                        @endforelse
                    </tbody>

                </table>

                @include('vendor.crud.single-page-templates.common.pagination', [ 'records' => $records ] )

				<script>
					$(".editable").editable({ajaxOptions:{method:'PUT'}});
				</script>
			</div>
		</div>
	</div>
</div>
@endsection
