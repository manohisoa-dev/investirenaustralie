@extends('V2.admin.layouts.app')

@section('title', 'Products - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Products</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('v2.product.index') }}">Products</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ route('v2.product.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Ajouter un nouveau Product            </a>
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Products</h5>
			</div>
			<div class="ibox-content">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
                                                    {!!\Nvd\Crud\Html::sortableTh('id','v2.product.index','Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('reference','v2.product.index','Reference')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('slug','v2.product.index','Slug')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('title','v2.product.index','Title')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('content','v2.product.index','Content')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('quantity','v2.product.index','Quantity')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('is_new','v2.product.index','Is New')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('view_count','v2.product.index','View Count')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('area','v2.product.index','Area')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('carport_spaces','v2.product.index','Carport Spaces')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('garage_spaces','v2.product.index','Garage Spaces')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('off_street_spaces','v2.product.index','Off Street Spaces')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('bathrooms','v2.product.index','Bathrooms')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('bedrooms','v2.product.index','Bedrooms')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('ensuite','v2.product.index','Ensuite')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('land_area','v2.product.index','Land Area')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('floor_area','v2.product.index','Floor Area')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('number_of_floors','v2.product.index','Number Of Floors')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('new_construction','v2.product.index','New Construction')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('year_built','v2.product.index','Year Built')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('display_address','v2.product.index','Display Address')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('price','v2.product.index','Price')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('currency','v2.product.index','Currency')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('tma','v2.product.index','Tma')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('commision','v2.product.index','Commision')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('commision_edited','v2.product.index','Commision Edited')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('status','v2.product.index','Status')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('type_id','v2.product.index','Type Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('location_type_id','v2.product.index','Location Type Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('category_id','v2.product.index','Category Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('buyer_id','v2.product.index','Buyer Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('seller_id','v2.product.index','Seller Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('author_id','v2.product.index','Author Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('postalCode','v2.product.index','PostalCode')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('state_id','v2.product.index','State Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('location_id','v2.product.index','Location Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('image_id','v2.product.index','Image Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('created_at','v2.product.index','Créer le')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('updated_at','v2.product.index','Mise à jour le')!!}
                                            <th><a href="javascript:void(0)">Actions</a></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
                                                            <td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
                                                            <td><input type="text" class="form-control" name="reference" value="{{Request::input("reference")}}"></td>
                                                            <td><input type="text" class="form-control" name="slug" value="{{Request::input("slug")}}"></td>
                                                            <td><input type="text" class="form-control" name="title" value="{{Request::input("title")}}"></td>
                                                            <td><input type="text" class="form-control" name="content" value="{{Request::input("content")}}"></td>
                                                            <td><input type="text" class="form-control" name="quantity" value="{{Request::input("quantity")}}"></td>
                                                            <td><input type="text" class="form-control" name="is_new" value="{{Request::input("is_new")}}"></td>
                                                            <td><input type="text" class="form-control" name="view_count" value="{{Request::input("view_count")}}"></td>
                                                            <td><input type="text" class="form-control" name="area" value="{{Request::input("area")}}"></td>
                                                            <td><input type="text" class="form-control" name="carport_spaces" value="{{Request::input("carport_spaces")}}"></td>
                                                            <td><input type="text" class="form-control" name="garage_spaces" value="{{Request::input("garage_spaces")}}"></td>
                                                            <td><input type="text" class="form-control" name="off_street_spaces" value="{{Request::input("off_street_spaces")}}"></td>
                                                            <td><input type="text" class="form-control" name="bathrooms" value="{{Request::input("bathrooms")}}"></td>
                                                            <td><input type="text" class="form-control" name="bedrooms" value="{{Request::input("bedrooms")}}"></td>
                                                            <td><input type="text" class="form-control" name="ensuite" value="{{Request::input("ensuite")}}"></td>
                                                            <td><input type="text" class="form-control" name="land_area" value="{{Request::input("land_area")}}"></td>
                                                            <td><input type="text" class="form-control" name="floor_area" value="{{Request::input("floor_area")}}"></td>
                                                            <td><input type="text" class="form-control" name="number_of_floors" value="{{Request::input("number_of_floors")}}"></td>
                                                            <td><input type="text" class="form-control" name="new_construction" value="{{Request::input("new_construction")}}"></td>
                                                            <td><input type="text" class="form-control" name="year_built" value="{{Request::input("year_built")}}"></td>
                                                            <td><input type="text" class="form-control" name="display_address" value="{{Request::input("display_address")}}"></td>
                                                            <td><input type="text" class="form-control" name="price" value="{{Request::input("price")}}"></td>
                                                            <td><input type="text" class="form-control" name="currency" value="{{Request::input("currency")}}"></td>
                                                            <td><input type="text" class="form-control" name="tma" value="{{Request::input("tma")}}"></td>
                                                            <td><input type="text" class="form-control" name="commision" value="{{Request::input("commision")}}"></td>
                                                            <td><input type="text" class="form-control" name="commision_edited" value="{{Request::input("commision_edited")}}"></td>
                                                            <td><input type="text" class="form-control" name="status" value="{{Request::input("status")}}"></td>
                                                            <td><input type="text" class="form-control" name="type_id" value="{{Request::input("type_id")}}"></td>
                                                            <td><input type="text" class="form-control" name="location_type_id" value="{{Request::input("location_type_id")}}"></td>
                                                            <td><input type="text" class="form-control" name="category_id" value="{{Request::input("category_id")}}"></td>
                                                            <td><input type="text" class="form-control" name="buyer_id" value="{{Request::input("buyer_id")}}"></td>
                                                            <td><input type="text" class="form-control" name="seller_id" value="{{Request::input("seller_id")}}"></td>
                                                            <td><input type="text" class="form-control" name="author_id" value="{{Request::input("author_id")}}"></td>
                                                            <td><input type="text" class="form-control" name="postalCode" value="{{Request::input("postalCode")}}"></td>
                                                            <td><input type="text" class="form-control" name="state_id" value="{{Request::input("state_id")}}"></td>
                                                            <td><input type="text" class="form-control" name="location_id" value="{{Request::input("location_id")}}"></td>
                                                            <td><input type="text" class="form-control" name="image_id" value="{{Request::input("image_id")}}"></td>
                                                            <td><input type="text" class="form-control" name="created_at" value="{{Request::input("created_at")}}"></td>
                                                            <td><input type="text" class="form-control" name="updated_at" value="{{Request::input("updated_at")}}"></td>
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
                                          data-name="reference"
                                          data-value="{{ $record->reference }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->reference }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="slug"
                                          data-value="{{ $record->slug }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->slug }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="title"
                                          data-value="{{ $record->title }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->title }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="content"
                                          data-value="{{ $record->content }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ str_limit(strip_tags($record->content), "100", "...") }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="quantity"
                                          data-value="{{ $record->quantity }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->quantity }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="number"
                                          data-name="is_new"
                                          data-value="{{ $record->is_new }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->is_new }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="view_count"
                                          data-value="{{ $record->view_count }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->view_count }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="area"
                                          data-value="{{ $record->area }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->area }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="number"
                                          data-name="carport_spaces"
                                          data-value="{{ $record->carport_spaces }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->carport_spaces }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="number"
                                          data-name="garage_spaces"
                                          data-value="{{ $record->garage_spaces }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->garage_spaces }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="number"
                                          data-name="off_street_spaces"
                                          data-value="{{ $record->off_street_spaces }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->off_street_spaces }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="number"
                                          data-name="bathrooms"
                                          data-value="{{ $record->bathrooms }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->bathrooms }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="number"
                                          data-name="bedrooms"
                                          data-value="{{ $record->bedrooms }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->bedrooms }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="number"
                                          data-name="ensuite"
                                          data-value="{{ $record->ensuite }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->ensuite }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="number"
                                          data-name="land_area"
                                          data-value="{{ $record->land_area }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->land_area }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="number"
                                          data-name="floor_area"
                                          data-value="{{ $record->floor_area }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->floor_area }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="number"
                                          data-name="number_of_floors"
                                          data-value="{{ $record->number_of_floors }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->number_of_floors }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="new_construction"
                                          data-value="{{ $record->new_construction }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->new_construction }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="year_built"
                                          data-value="{{ $record->year_built }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->year_built }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="display_address"
                                          data-value="{{ $record->display_address }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->display_address }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="price"
                                          data-value="{{ $record->price }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->price }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="currency"
                                          data-value="{{ $record->currency }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->currency }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="tma"
                                          data-value="{{ $record->tma }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->tma }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="commision"
                                          data-value="{{ $record->commision }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->commision }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="number"
                                          data-name="commision_edited"
                                          data-value="{{ $record->commision_edited }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->commision_edited }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="status"
                                          data-value="{{ $record->status }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->status }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="type_id"
                                          data-value="{{ $record->type_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->type_id }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="location_type_id"
                                          data-value="{{ $record->location_type_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->location_type_id }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="category_id"
                                          data-value="{{ $record->category_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->category_id }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="buyer_id"
                                          data-value="{{ $record->buyer_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->buyer_id }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="seller_id"
                                          data-value="{{ $record->seller_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->seller_id }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="author_id"
                                          data-value="{{ $record->author_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->author_id }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="postalCode"
                                          data-value="{{ $record->postalCode }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->postalCode }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="state_id"
                                          data-value="{{ $record->state_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->state_id }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="location_id"
                                          data-value="{{ $record->location_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->location_id }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="image_id"
                                          data-value="{{ $record->image_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->image_id }}</span>
                                                                    </td>
                                                                <td>
                                                                            {{ $record->created_at ? $record->created_at->diffForHumans() : '' }}
                                                                    </td>
                                                                <td>
                                                                            {{ $record->updated_at ? $record->updated_at->diffForHumans() : '' }}
                                                                    </td>
                                                                @include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => route('v2.product.index'), 'record' => $record ] )
                            </tr>
                        @empty
                            @include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 40])
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
