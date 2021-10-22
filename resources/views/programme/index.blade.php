@extends('layouts.app')

@section('content')

@component('includes.breadcrumb2', 
    $category ? [
        'cat'=>$category,
        'states'=>$states,
        'typesRes'=>$typesRes,
        'typesFonc'=>$typesFonc,
        'typesInd'=>$typesInd,
        'typesComm'=>$typesComm,
        'anciennetes'=>$anciennetes,
        'locationTypes'=>$locationTypes,
        'agricoles'=>$agricoles,
        'industriels'=>$industriels,
        'commercials'=>$commercials,
        'max_price_residentiel'=>$max_price_residentiel,
        'min_price_residentiel'=>$min_price_residentiel,
        'min_land_area_residentiel'=>$min_land_area_residentiel,
        'max_land_area_residentiel'=>$max_land_area_residentiel,
        'min_garage_space_residentiel'=>$min_garage_space_residentiel,
        'max_garage_space_residentiel'=>$max_garage_space_residentiel,
        'min_bathrooms_residentiel'=>$min_bathrooms_residentiel,
        'max_bathrooms_residentiel'=>$max_bathrooms_residentiel,
        'min_bedrooms_residentiel'=>$min_bedrooms_residentiel,
        'max_bedrooms_residentiel'=>$max_bedrooms_residentiel,
        'min_number_of_floors_residentiel'=>$min_number_of_floors_residentiel,
        'max_number_of_floors_residentiel'=>$max_number_of_floors_residentiel,
        'min_price_foncier'=>$min_price_foncier,
        'max_price_foncier'=>$max_price_foncier,
        'min_land_area_foncier'=>$min_land_area_foncier,
        'max_land_area_foncier'=>$max_land_area_foncier,
        'min_price_industriel'=>$min_price_industriel,
        'max_price_industriel'=>$max_price_industriel,
        'min_price_commercial'=>$min_price_commercial,
        'max_price_commercial'=>$max_price_commercial,
        'min_area_commercial'=>$min_area_commercial,
        'max_area_commercial'=>$max_area_commercial]
        : [
        'cat'=>'programme',
        'typesRes'=>$typesRes,
        'states'=>$states,
        'typesFonc'=>$typesFonc,
        'typesInd'=>$typesInd,
        'typesComm'=>$typesComm,
        'anciennetes'=>$anciennetes,
        'locationTypes'=>$locationTypes,
        'agricoles'=>$agricoles,
        'industriels'=>$industriels,
        'commercials'=>$commercials,
        'max_price_residentiel'=>$max_price_residentiel,
        'min_price_residentiel'=>$min_price_residentiel,
        'min_land_area_residentiel'=>$min_land_area_residentiel,
        'max_land_area_residentiel'=>$max_land_area_residentiel,
        'min_garage_space_residentiel'=>$min_garage_space_residentiel,
        'max_garage_space_residentiel'=>$max_garage_space_residentiel,
        'min_bathrooms_residentiel'=>$min_bathrooms_residentiel,
        'max_bathrooms_residentiel'=>$max_bathrooms_residentiel,
        'min_bedrooms_residentiel'=>$min_bedrooms_residentiel,
        'max_bedrooms_residentiel'=>$max_bedrooms_residentiel,
        'min_number_of_floors_residentiel'=>$min_number_of_floors_residentiel,
        'max_number_of_floors_residentiel'=>$max_number_of_floors_residentiel,
        'min_price_foncier'=>$min_price_foncier,
        'max_price_foncier'=>$max_price_foncier,
        'min_land_area_foncier'=>$min_land_area_foncier,
        'max_land_area_foncier'=>$max_land_area_foncier,
        'min_price_industriel'=>$min_price_industriel,
        'max_price_industriel'=>$max_price_industriel,
        'min_price_commercial'=>$min_price_commercial,
        'max_price_commercial'=>$max_price_commercial,
        'min_area_commercial'=>$min_area_commercial,
        'max_area_commercial'=>$max_area_commercial])
    @lang('our_programs')
@endcomponent

<!-- Section -->
<section class="section">
    <div class="container">
        <div class="row md-m-25px-b m-65px-b justify-content-center text-center">
            <div class="col-lg-8">
                @if ($category=='residentiel')
                    <h3 class="h1 m-20px-b p-20px-b theme-after after-50px">@lang('app.txt.list_programme_immobilier_residentiel')</h3>
                @elseif($category=='foncier')
                    <h3 class="h1 m-20px-b p-20px-b theme-after after-50px">@lang('app.txt.list_bien_nature_foncière')</h3>
                @elseif($category=='industriel')
                    <h3 class="h1 m-20px-b p-20px-b theme-after after-50px">@lang('app.txt.list_bien_industriel')</h3>
                @elseif($category=='commercial')
                    <h3 class="h1 m-20px-b p-20px-b theme-after after-50px">@lang('app.txt.list_bien_commercial')</h3>
                @else
                    <h3 class="h1 m-20px-b p-20px-b theme-after after-50px">@lang('app.txt.list_programme')</h3>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8" style="margin-top: -9%;">
                <section class="section" style="margin-bottom:-150px;">
                    <div class="m-15px-l">
                        <div class="property-sorting">        
                            <form id="filter-form" class="form-group row col-lg-12" method="get" action="">
                                <div  class="pull-left form-group col-lg-3 col-md-12">
                                    <label for="showBy"> @lang('app.form.represent'):   </label>  
                                    <select class="form-control" name="showBy" id="showBy" onchange="document.getElementById('filter-form').submit();"> 
                                        <option value="mat" {{$showBy=='mat'?'selected':''}}>@lang('app.txt.repr_mat')</option>
                                        <option value="map" {{$showBy=='map'?'selected':''}}>@lang('app.txt.loc_geo')</option>  
                                    </select>
                                </div>
                                <div  class="pull-left form-group col-lg-3 col-md-12">
                                    <label for="show"> @lang('app.form.show'):   </label>  
                                    <select class="form-control" name="show" id="show" onchange="document.getElementById('filter-form').submit();"> 
                                        <option value="any" {{$show=='any'?'selected':''}}>@lang('app.txt.any')</option>
                                        <option value="10" {{$show=='10'?'selected':''}} >10</option> 
                                        <option value="20" {{$show=='25'?'selected':''}} >25</option> 
                                        <option value="50" {{$show=='50'?'selected':''}} >50</option> 
                                        <option value="100" {{$show=='100'?'selected':''}} >100</option> 
                                    </select>
                                </div>
                                <div  class="pull-left form-group col-lg-3 col-md-12">
                                    <label for="orderBy"> @lang('app.form.filterBy'):   </label>  
                                    <select class="form-control" name="orderBy" id="orderBy" onchange="document.getElementById('filter-form').submit();" @if($showBy!=='mat') disabled @endif> 
                                        <option value="price" {{$orderBy=='price'?'selected':''}}>@lang('app.txt.price')</option>  
                                        <option value="created_at" {{$orderBy=='created_at'?'selected':''}}>@lang('app.create_date')</option>  
                                        <option value="view_count" {{$orderBy=='view_count'?'selected':''}}>@lang('app.most_view')</option>
                                    </select>
                                </div>
                                <div  class="pull-left form-group col-lg-3 col-md-12">
                                    <label for="order"> @lang('app.form.order_price'):   </label>  
                                    <select class="form-control" name="order" id="order" onchange="document.getElementById('filter-form').submit();" @if($showBy!=='mat') disabled @endif> 
                                        <option value="asc" {{$order=='asc'?'selected':''}}>@lang('app.form.asc')</option> 
                                        <option value="desc" {{$order=='desc'?'selected':''}}>@lang('app.form.desc')</option> 
                                    </select>
                                </div>
                                <div  class="pull-left col-lg-3 col-md-12 m-50px-t" id="showType" @if($showBy!=='mat' || sizeOf($items)===0) hidden @endif>
                                    <p class="layout-view"> @lang('app.form.vue'): <a href="javascript:void(0)" id="grid"><i class="fa fa-th-large selected" data-layout="6"></i></a> <a href="javascript:void(0)" id="list"><i class="fa fa-list-ul" data-layout="12"></i></a> </p>
                                    <input type="hidden" name="view_prod" id="view_prod" value="list">
                                </div>
                            </form>
                        </div>           
                    </div>
                </section>

                <!-- Section show map -->
                <section class="section" id="show-map" @if($showBy!=='map') hidden @endif>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="row col-lg-12">
                                <div class="col-lg-12 col-md-12 p-5px white-bg box-shadow">
                                  <div id="map"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End Section show map -->

                <!-- Section show programme -->
                <section class="section" id="show-mat" @if($showBy!=='mat') hidden @endif>
                    <div class="container">
                        <div class="row w-100" >
                            <div id="infinite-scroll" class="product-data">
                                @if (sizeOf($items)!==0)
                                    @include('programme.all',['items'=>$items])
                                @else
                                    <p class="text-center m-100px-l p-100px-l">@lang('app.txt.no_program')</p>
                                @endif
                            </div>
                            <div class="row">
                                <div class="ajax-load text-center" style="display:none">
                                    <p><img src="{{asset('images/loader.gif')}}">@lang('app.load_more_product')</p>
                                </div>  
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End Section show product -->
            </div>

            <!-- Sidebar -->
            @include('includes.sidebar')
            <!-- fin sidebar -->
        </div>
    </div>
</section>
<!-- End Section -->

@if(isset($q)&&$q)
<!-- Modal -->
<div id="modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="title">@lang('app.txt.enregistrer_recherche')</h4>
      </div>
      <div class="modal-body">
          <form id="form-save-search" action="{{route('search.edit')}}" method="post">
            {{csrf_field()}}
            <input type="hidden" id="input-search-id" name="search" value="{{$search->id}}">
            <p class="form-subject">
                <input id="input-search-title" name="title" type="text" placeholder="Titre *" required="required" value="{{$search->title}}">
            </p>
                <a class="btn btn-default" data-dismiss="modal" aria-hidden="true">@lang('app.btn.cancel')</a>
                <button class="btn btn-success" type="submit">@lang('app.btn.save')</button>
          </form>
      </div>
    </div>
  </div>
</div>
@endif

@endsection

@section('script')
    @parent
    <script type="text/javascript">
    $(document).ready(function () {
        var page = {{$page}};
        var norecord = false;
        var load = false;
        $(window).scroll(function() {
            if($(window).scrollTop() + $(window).height() >= 
               $('#infinite-scroll').height()) {
                if(!load){
                    if(!norecord){
                        page++;
                        loadMoreData(page);
                    }else{
                        $('.ajax-load').show();
                    }
                }
            }
        });
        function loadMoreData(page){
            $.ajax({
                url: "{!!route("shop.index", ["category"=>$category, "q"=>$q, "order"=>$order, "orderBy"=>$orderBy])!!}&page="+page,
                type: "get",
                beforeSend: function()
                {
                    load = true;
                    $('.ajax-load').show();
                }
            }).done(function(data)
            {
                if(data.html == ""){
                    norecord = true;
                    $('.ajax-load').html("@lang('app.txt.no_more_data')");
                    return;
                }
                $('.ajax-load').hide();
                $(".product-data").append(data.html);
                load = false;
            }).fail(function(jqXHR, ajaxOptions, thrownError)
            {
                page--;
                $('.ajax-load').html("Server not responding....");
                load = false;
            });
        }
    });
    </script>
    

    @if(isset($q)&&$q)
        <script>
        $(document).ready(function () {
            $('.btn-save-search').on('click', function(e){
                $('#modal').modal('show');
                e.preventDefault();
            });

            $('#form-save-search').on('submit', function(e){
                $('#mute').addClass('on');
                $('#modal').modal('hide');
                var data = {
                    _token: $('meta[name=csrf-token]').attr('content'),
                    search: $('#input-search-id').val(),
                    title: $('#input-search-title').val(),
                };
                
                $('#success-message').html('');
                $('#error-message').html('');
                $.post('{{route("search.edit")}}', data, function(res){
                    if(res.state == 1){
                        $('#success-message').html(res.message);
                    }else{
                        $('#error-message').html(res.message);
                    }
                    $('#mute').removeClass('on');
                });
                e.preventDefault();
            });
        });
        </script>
    @endif
@endsection

@push('script')
    @php
        $key = env('GMAP_API_KEY');
        $url = "https://maps.googleapis.com/maps/api/js?key=".$key."&callback=initMap&libraries=places&v=weekly";
    @endphp
    <script async defer src={{$url}}></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // list view
            $('#list').click(function(event){
                // event.preventDefault();

                $('#view_prod').val('list');
                $('#filter-form').submit();
            });

            // grid view
            $('#grid').click(function(event){
                // event.preventDefault();

                $('#view_prod').val('grid');
                $('#filter-form').submit();
            });
        });
    </script>

    <style>
        #map{
        height: 25rem;
        }
    </style>

    <script>
        var _map;
        var _geocoder;
        var _marker;
        var _lat = -25.363;
        var _long = 131.044;
        
        var iconBase = "{{url('')}}";
        var icons = {
            product: {
                icon: iconBase + '/images/map/product.png'
            }
        };
        
        
        var datas = {!!$data!!};
        var markers = [];
        
        function initMap() {
            
            _map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: _lat, lng:  _long},
                zoom: 3.5
            });

        
            for (var i = 0; i < datas.length; i++) {
                placeMarker(datas[i], );
            }
        }
        
        function placeMarker(data) {
            markers[data.id] = new google.maps.Marker({
                position: {lat:parseFloat(data.lat), lng:parseFloat(data.lng)},
                map: _map,
                title: data.title,
                icon: icons[data.type].icon,
            });
            
            if(data.type == 'product'){
                google.maps.event.addListener(markers[data.id], 'click', function() {
                    var slug= data.slug;
                    var uri = '{{ URL::to("get/show/programme/") }}'+'/'+slug;
                    var envoi = $.get( uri );
    
                    envoi.done( function(url) {
                        window.open(url.res, '_blank');
                    });
    
                });
            }
        }

    </script>
@endpush

