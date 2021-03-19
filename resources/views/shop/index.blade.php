@extends('layouts.app')

@section('content')

@component('includes.breadcrumb2', 
    $category->slug ? [
        'cat'=>$category->slug,
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
        'cat'=>'shop',
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
    @lang('all_products')
@endcomponent

<!-- Section -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8" style="margin-top: -10%;">
                <!-- Section -->
                <section class="section">
                    <div class="m-15px-l col-md-11">
                        <div class="property-sorting">        
                            <form id="filter-form" method="get" action="">
                                <div  class="pull-left form-group">
                                    <label for="orderBy"> @lang('app.form.filterBy'):   </label>  
                                    <select class="form-control" name="orderBy" id="orderBy" onchange="document.getElementById('filter-form').submit();"> 
                                        <option value="created_at" {{$orderBy=='created_at'?'selected':''}}>@lang('app.pub_date')</option>  
                                        <option value="view_count" {{$orderBy=='view_count'?'selected':''}}>@lang('app.most_view')</option>
                                    </select>
                                </div>
                                <div  class="pull-left ml-4 form-group">
                                    <label for="order"> @lang('app.form.order'):   </label>  
                                    <select class="form-control" name="order" id="order" onchange="document.getElementById('filter-form').submit();"> 
                                        <option value="asc" {{$order=='asc'?'selected':''}}>@lang('app.form.asc')</option> 
                                        <option value="desc" {{$order=='desc'?'selected':''}}>@lang('app.form.desc')</option> 
                                    </select>
                                </div>
                                <div  class="pull-right">
                                    <p class="layout-view"> @lang('app.form.vue'): <a href="javascript:void(0)" id="grid"><i class="fa fa-th-large selected" data-layout="6"></i></a> <a href="javascript:void(0)" id="list"><i class="fa fa-list-ul" data-layout="12"></i></a> </p>
                                </div>
                            </form>
                        </div>           
                    </div>
                    <div class="container">
                        <div class="row w-100" >
                            <div id="infinite-scroll" class="product-data"> 
                                @include('ajax.product.all',['items'=>$items])
                            </div>
                            <div class="row">
                                <div class="ajax-load text-center" style="display:none">
                                    <p><img src="{{asset('images/loader.gif')}}">@lang('app.load_more_product')</p>
                                </div>  
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End Section -->
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
    <script type="text/javascript">
        $(document).ready(function() {
            // list view
            $('#list').click(function(event){
                event.preventDefault();
                $('.view-item').removeClass('col-lg-6');
                $('.view-item').addClass('col-lg-12');
            });

            // grid view
            $('#grid').click(function(event){
                event.preventDefault();
                $('.view-item').removeClass('col-lg-12');
                $('.view-item').addClass('col-lg-6');
            });
        });
    </script>
@endpush


