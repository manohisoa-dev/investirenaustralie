@extends('V2.admin.layouts.app')

@section('title', 'Sales - Détail ')

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
                <h5>Détail Sale : {{$sale->status}}</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>Id</h4>
                        <h5>{{$sale->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Status</h4>
                        <h5>{{$sale->status}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Price</h4>
                        <h5>{{$sale->price}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Tma</h4>
                        <h5>{{$sale->tma}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Currency</h4>
                        <h5>{{$sale->currency}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Apl Id</h4>
                        <h5>{{$sale->apl_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Apl Paid At</h4>
                        <h5>{{$sale->apl_paid_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Apl Amount</h4>
                        <h5>{{$sale->apl_amount}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Apl Transaction Id</h4>
                        <h5>{{$sale->apl_transaction_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Apl Payment Type</h4>
                        <h5>{{$sale->apl_payment_type}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Afa Id</h4>
                        <h5>{{$sale->afa_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Afa Paid At</h4>
                        <h5>{{$sale->afa_paid_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Afa Amount</h4>
                        <h5>{{$sale->afa_amount}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Afa Transaction Id</h4>
                        <h5>{{$sale->afa_transaction_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Afa Payment Type</h4>
                        <h5>{{$sale->afa_payment_type}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Cancelled By</h4>
                        <h5>{{$sale->cancelled_by}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Cancelled At</h4>
                        <h5>{{$sale->cancelled_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Cancelled By Role</h4>
                        <h5>{{$sale->cancelled_by_role}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Cancelled Desc</h4>
                        <h5>{{$sale->cancelled_desc}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Product Id</h4>
                        <h5>{{$sale->product_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Author Id</h4>
                        <h5>{{$sale->author_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Created At</h4>
                        <h5>{{$sale->created_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Updated At</h4>
                        <h5>{{$sale->updated_at}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection