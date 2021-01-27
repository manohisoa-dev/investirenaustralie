@extends('V2.admin.layouts.app')

@section('title', 'Products - Détail ')

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
                <h5>Détail Product : {{$product->reference}}</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>Id</h4>
                        <h5>{{$product->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Reference</h4>
                        <h5>{{$product->reference}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Slug</h4>
                        <h5>{{$product->slug}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Title</h4>
                        <h5>{{$product->title}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Content</h4>
                        <h5>{{$product->content}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Quantity</h4>
                        <h5>{{$product->quantity}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Is New</h4>
                        <h5>{{$product->is_new}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>View Count</h4>
                        <h5>{{$product->view_count}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Area</h4>
                        <h5>{{$product->area}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Carport Spaces</h4>
                        <h5>{{$product->carport_spaces}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Garage Spaces</h4>
                        <h5>{{$product->garage_spaces}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Off Street Spaces</h4>
                        <h5>{{$product->off_street_spaces}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Bathrooms</h4>
                        <h5>{{$product->bathrooms}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Bedrooms</h4>
                        <h5>{{$product->bedrooms}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Ensuite</h4>
                        <h5>{{$product->ensuite}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Land Area</h4>
                        <h5>{{$product->land_area}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Floor Area</h4>
                        <h5>{{$product->floor_area}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Number Of Floors</h4>
                        <h5>{{$product->number_of_floors}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>New Construction</h4>
                        <h5>{{$product->new_construction}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Year Built</h4>
                        <h5>{{$product->year_built}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Display Address</h4>
                        <h5>{{$product->display_address}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Price</h4>
                        <h5>{{$product->price}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Currency</h4>
                        <h5>{{$product->currency}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Tma</h4>
                        <h5>{{$product->tma}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Commision</h4>
                        <h5>{{$product->commision}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Commision Edited</h4>
                        <h5>{{$product->commision_edited}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Status</h4>
                        <h5>{{$product->status}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Type Id</h4>
                        <h5>{{$product->type_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Location Type Id</h4>
                        <h5>{{$product->location_type_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Category Id</h4>
                        <h5>{{$product->category_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Buyer Id</h4>
                        <h5>{{$product->buyer_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Seller Id</h4>
                        <h5>{{$product->seller_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Author Id</h4>
                        <h5>{{$product->author_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>PostalCode</h4>
                        <h5>{{$product->postalCode}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>State Id</h4>
                        <h5>{{$product->state_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Location Id</h4>
                        <h5>{{$product->location_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Image Id</h4>
                        <h5>{{$product->image_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Created At</h4>
                        <h5>{{$product->created_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Updated At</h4>
                        <h5>{{$product->updated_at}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection