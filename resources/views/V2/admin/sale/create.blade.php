@extends('V2.admin.layouts.app')

@section('title', 'Sales - Ajout ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Sales</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Sales</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('v2.sale.index') }}">Listes</a>
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
                <h5>Ajouter un nouveau Sale</h5>
            </div>
            <div class="ibox-content">
                <form class="form-validation form-padding" action="{{ route('v2.sale.store') }}" method="post">

                    {{ csrf_field() }}
                                                        
                    {!! \Nvd\Crud\Form::input('status','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('price','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('tma','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('currency','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('apl_id','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('apl_paid_at','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('apl_amount','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('apl_transaction_id','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('apl_payment_type','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('afa_id','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('afa_paid_at','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('afa_amount','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('afa_transaction_id','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('afa_payment_type','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('cancelled_by','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('cancelled_at','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('cancelled_by_role','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('cancelled_desc','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('product_id','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('author_id','text')->show() !!}
                                                                                    
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Créer</button>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
