@extends('admin.layouts.app')

@section('title', 'Sales - Edition ')

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
                <h5>Mise à jour Sale : {{$sale->status}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('v2.sale.index')}}/{{$sale->id}}" method="post">

                    {{ csrf_field() }}

                    {{ method_field("PUT") }}
                                                                                                
                            {!! \Nvd\Crud\Form::input('status','text')->model($sale)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('price','text')->model($sale)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('tma','text')->model($sale)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('currency','text')->model($sale)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('apl_id','text')->model($sale)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('apl_paid_at','text')->model($sale)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('apl_amount','text')->model($sale)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('apl_transaction_id','text')->model($sale)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('apl_payment_type','text')->model($sale)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('afa_id','text')->model($sale)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('afa_paid_at','text')->model($sale)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('afa_amount','text')->model($sale)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('afa_transaction_id','text')->model($sale)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('afa_payment_type','text')->model($sale)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('cancelled_by','text')->model($sale)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('cancelled_at','text')->model($sale)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('cancelled_by_role','text')->model($sale)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('cancelled_desc','text')->model($sale)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('product_id','text')->model($sale)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('author_id','text')->model($sale)->show() !!}
                                                                                                                                                
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Enregistrer</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
