@extends('V2.admin.layouts.app')

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
                <a href="{{ route('v2/admin.user.index') }}">Listes</a>
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
                <h5>Ajouter un nouveau User</h5>
            </div>
            <div class="ibox-content">
                <form class="form-validation form-padding" action="{{ route('v2/admin.user.store') }}" method="post">

                    {{ csrf_field() }}
                                                        
                    {!! \Nvd\Crud\Form::input('name','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('email','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('password','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('role','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('type','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('language','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('status','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('percent','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('enabled_at','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('disabled_at','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('use_default_password','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('is_seller','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('apl_id','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('apl_ends_at','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('image_id','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('author_id','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('location_id','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('country_id','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('operation_range','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('state_id','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('activation_code','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('remember_token','text')->show() !!}
                                                                                                    
                    {!! \Nvd\Crud\Form::input('braintree_id','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('paypal_email','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('stripe_id','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('card_brand','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('card_last_four','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('trial_ends_at','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('subscription_ends_at','text')->show() !!}
                            
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Créer</button>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
