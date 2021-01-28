@extends('V2.admin.layouts.app')

@section('title', 'Products - Ajout ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Products</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Products</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('v2.admin.product.index') }}">Listes</a>
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
                <h5>Ajouter un nouveau Product</h5>
            </div>
            <div class="ibox-content">
                <form class="form-validation form-padding" action="{{ route('v2.admin.product.store') }}" method="post">

                    {{ csrf_field() }}
                                                        
                    {!! \Nvd\Crud\Form::input('reference','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('slug','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('title','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('content','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('quantity','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('is_new','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('view_count','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('area','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('carport_spaces','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('garage_spaces','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('off_street_spaces','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('bathrooms','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('bedrooms','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('ensuite','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('land_area','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('floor_area','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('number_of_floors','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('new_construction','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('year_built','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('display_address','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('price','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('currency','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('tma','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('commision','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('commision_edited','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('status','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('type_id','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('location_type_id','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('category_id','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('buyer_id','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('seller_id','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('author_id','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('postalCode','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('state_id','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('location_id','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('image_id','text')->show() !!}
                                                                                    
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Créer</button>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
