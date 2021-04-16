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
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Détail User : {{$user->name}}</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>Id</h4>
                        <h5>{{$user->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Name</h4>
                        <h5>{{$user->name}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Email</h4>
                        <h5>{{$user->email}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Password</h4>
                        <h5>{{$user->password}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Role</h4>
                        <h5>{{$user->role}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Type</h4>
                        <h5>{{$user->type}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Language</h4>
                        <h5>{{$user->language}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Status</h4>
                        <h5>{{$user->status}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Percent</h4>
                        <h5>{{$user->percent}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Enabled At</h4>
                        <h5>{{$user->enabled_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Disabled At</h4>
                        <h5>{{$user->disabled_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Use Default Password</h4>
                        <h5>{{$user->use_default_password}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Is Seller</h4>
                        <h5>{{$user->is_seller}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Apl Id</h4>
                        <h5>{{$user->apl_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Apl Ends At</h4>
                        <h5>{{$user->apl_ends_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Image Id</h4>
                        <h5>{{$user->image_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Author Id</h4>
                        <h5>{{$user->author_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Location Id</h4>
                        <h5>{{$user->location_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Country Id</h4>
                        <h5>{{$user->country_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Operation Range</h4>
                        <h5>{{$user->operation_range}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>State Id</h4>
                        <h5>{{$user->state_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Activation Code</h4>
                        <h5>{{$user->activation_code}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Remember Token</h4>
                        <h5>{{$user->remember_token}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Créée le </h4>
                        <h5>{{$user->created_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Mis à jour le</h4>
                        <h5>{{$user->updated_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Braintree Id</h4>
                        <h5>{{$user->braintree_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Paypal Email</h4>
                        <h5>{{$user->paypal_email}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Stripe Id</h4>
                        <h5>{{$user->stripe_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Card Brand</h4>
                        <h5>{{$user->card_brand}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Card Last Four</h4>
                        <h5>{{$user->card_last_four}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Trial Ends At</h4>
                        <h5>{{$user->trial_ends_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Subscription Ends At</h4>
                        <h5>{{$user->subscription_ends_at}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection