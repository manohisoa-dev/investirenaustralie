@extends('V2.admin.layouts.app')

@section('title', 'Products - Edition ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Products</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Products</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('v2.product.index') }}">Listes</a>
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
                <h5>Mise à jour Product : {{$product->reference}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('v2.product.index')}}/{{$product->id}}" method="post">

                    {{ csrf_field() }}

                    {{ method_field("PUT") }}
                                                                                                
                            {!! \Nvd\Crud\Form::input('reference','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('slug','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('title','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('content','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('quantity','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('is_new','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('view_count','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('area','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('carport_spaces','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('garage_spaces','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('off_street_spaces','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('bathrooms','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('bedrooms','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('ensuite','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('land_area','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('floor_area','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('number_of_floors','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('new_construction','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('year_built','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('display_address','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('price','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('currency','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('tma','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('commision','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('commision_edited','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('status','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('type_id','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('location_type_id','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('category_id','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('buyer_id','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('seller_id','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('author_id','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('postalCode','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('state_id','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('location_id','text')->model($product)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('image_id','text')->model($product)->show() !!}
                                                                                                                                                
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Enregistrer</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
