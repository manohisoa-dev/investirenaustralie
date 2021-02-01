@extends('V2.admin.layouts.app')

@section('title', 'Users - Edition ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Users</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Users</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('v2/admin.user.index') }}">Listes</a>
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
                <h5>Mise à jour User : {{$user->name}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('v2/admin.user.index')}}/{{$user->id}}" method="post">

                    {{ csrf_field() }}

                    {{ method_field("PUT") }}
                                                                                                
                            {!! \Nvd\Crud\Form::input('name','text')->model($user)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('email','text')->model($user)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('password','text')->model($user)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('role','text')->model($user)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('type','text')->model($user)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('language','text')->model($user)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('status','text')->model($user)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('percent','text')->model($user)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('enabled_at','text')->model($user)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('disabled_at','text')->model($user)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('use_default_password','text')->model($user)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('is_seller','text')->model($user)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('apl_id','text')->model($user)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('apl_ends_at','text')->model($user)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('image_id','text')->model($user)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('author_id','text')->model($user)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('location_id','text')->model($user)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('country_id','text')->model($user)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('operation_range','text')->model($user)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('state_id','text')->model($user)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('activation_code','text')->model($user)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('remember_token','text')->model($user)->show() !!}
                                                                                                                                                                        
                            {!! \Nvd\Crud\Form::input('braintree_id','text')->model($user)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('paypal_email','text')->model($user)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('stripe_id','text')->model($user)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('card_brand','text')->model($user)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('card_last_four','text')->model($user)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('trial_ends_at','text')->model($user)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('subscription_ends_at','text')->model($user)->show() !!}
                                                
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Enregistrer</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
