@extends('layouts.app')

@section('style')
<style type="text/css">
    .ajax-load{
        background: #e1e1e1;
        padding: 10px 0px;
        width: 100%;
    }
</style>
@endsection

@section('content')
@component('includes.breadcrumb')
    @lang('app.blogs')
@endcomponent

<!-- Section -->
<section class="section">
    <div class="container">
        <div class="row md-m-25px-b m-45px-b justify-content-center text-center">
            <div class="col-lg-8">
                <h3 class="h1 m-20px-b p-20px-b theme-after after-50px">@lang('app.txt.blog_iea')</h3>
                <p class="m-0px font-2">@lang('app.txt.blog_def')</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-12 m-10px-l p-25px-b">
                        <div class="property-sorting">
                            <form id="filter-form" method="get" action="">
                                <div  class="pull-left form-group col-md-3">
                                    <label for="orderBy"> @lang('app.form.filterBy'):   </label>
                                    <select class="form-control" name="orderBy" id="orderBy" onchange="document.getElementById('filter-form').submit();">
                                        <option value="created_at" {{$orderBy=='created_at'?'selected':''}}>@lang('app.pub_date')</option>
                                        <option value="view_count" {{$orderBy=='view_count'?'selected':''}}>@lang('app.most_view')</option>
                                    </select>
                                </div>
                                <div  class="pull-left ml-4 form-group col-md-3">
                                    <label for="order"> @lang('app.form.order'):   </label>
                                    <select class="form-control" name="order" id="order" onchange="document.getElementById('filter-form').submit();">
                                        <option value="asc" {{$order=='asc'?'selected':''}}>@lang('app.form.asc')</option>
                                        <option value="desc" {{$order=='desc'?'selected':''}}>@lang('app.form.desc')</option>
                                    </select>
                                </div>
                                <div  class="pull-left ml-4 form-group col-md-3">
                                    <label for="show"> @lang('app.form.show'):   </label>
                                    <select class="form-control" name="show" id="show" onchange="document.getElementById('filter-form').submit();">
                                        <option value="0" {{$show=='0'?'selected':''}}>@lang('app.txt.any')</option>
                                        <option value="10" {{$show=='10'?'selected':''}}>10</option>
                                        <option value="20" {{$show=='20'?'selected':''}}>20</option>
                                        <option value="50" {{$show=='50'?'selected':''}}>50</option>
                                        <option value="100" {{$show=='100'?'selected':''}}>100</option>
                                    </select>
                                </div>
                                <div  class="pull-right">
                                    <p class="layout-view">
                                        @lang('app.form.vue'):
                                        <a href="javascript:void(0)" id="grid" title="@lang('app.txt.grid')"><i class="fa fa-th-large selected" data-layout="6"></i></a>
                                        <a href="javascript:void(0)" id="list" title="@lang('app.txt.list')"><i class="fa fa-list-ul" data-layout="12"></i></a>
                                        <a href="{{ route('blog.all.random') }}" id="random" title="@lang('app.txt.random')"><i class="fa fa-random" data-layout="12"></i></a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Show all blog -->
                    @include('ajax.blog.all',['items'=>$items])

                </div>
            </div>
            <div class="col-lg-4 md-m-15px-tb m-35px-t">
                <div class="card">
                    <p class="text-center" style="font-size: 11px;">@lang('app.txt.advertisement')</p>
                    @forelse (App\Models\Pub::limit(3)->get() as $item)
                        <div id="ads" class="ads-section col-lg-12 p-15px-tb white-bg">
                            <div class="ads-header col-lg-12 float-left p-5px-t p-20px-l p-10px-b border-top-1 border-color-gray">
                                <div class="row col-lg-12">
                                    <div class="col-lg-6">
                                        <img src="{{ asset('images/ads-logo.png') }}" alt="logo_iea">
                                    </div>
                                    <div class="col-lg-6">
                                        <p class="text-right">{{$item->title}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="ads-content">
                                <a href="{{ $item->links?$item->links:'#' }}" target="_blank"><img src="{{ asset($item->image->filepath) }}" alt=""></a>
                            </div>
                        </div>
                    @empty
                        <div id="ads" class="ads-section col-lg-12 p-15px-tb white-bg">
                            <div class="p-5px-t p-10px-b border-top-1 border-color-gray">
                                <p class="text-center">@lang('app.txt.no_ads')</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Section -->

<!-- Section no sidebar -->
{{-- <section class="section">
    <div class="container">
        <div class="row md-m-25px-b m-45px-b justify-content-center text-center">
            <div class="col-lg-8">
                <h3 class="h1 m-20px-b p-20px-b theme-after after-50px">@lang('app.txt.blog_iea')</h3>
                <p class="m-0px font-2">@lang('app.txt.blog_def')</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 m-10px-l p-25px-b">
                <div class="property-sorting">
                    <form id="filter-form" method="get" action="">
                        <div  class="pull-left form-group col-md-3">
                            <label for="orderBy"> @lang('app.form.filterBy'):   </label>
                            <select class="form-control" name="orderBy" id="orderBy" onchange="document.getElementById('filter-form').submit();">
                                <option value="created_at" {{$orderBy=='created_at'?'selected':''}}>@lang('app.pub_date')</option>
                                <option value="view_count" {{$orderBy=='view_count'?'selected':''}}>@lang('app.most_view')</option>
                            </select>
                        </div>
                        <div  class="pull-left ml-4 form-group col-md-3">
                            <label for="order"> @lang('app.form.order'):   </label>
                            <select class="form-control" name="order" id="order" onchange="document.getElementById('filter-form').submit();">
                                <option value="asc" {{$order=='asc'?'selected':''}}>@lang('app.form.asc')</option>
                                <option value="desc" {{$order=='desc'?'selected':''}}>@lang('app.form.desc')</option>
                            </select>
                        </div>
                        <div  class="pull-left ml-4 form-group col-md-3">
                            <label for="show"> @lang('app.form.show'):   </label>
                            <select class="form-control" name="show" id="show" onchange="document.getElementById('filter-form').submit();">
                                <option value="0" {{$show=='0'?'selected':''}}>@lang('app.txt.any')</option>
                                <option value="10" {{$show=='10'?'selected':''}}>10</option>
                                <option value="20" {{$show=='20'?'selected':''}}>20</option>
                                <option value="50" {{$show=='50'?'selected':''}}>50</option>
                                <option value="100" {{$show=='100'?'selected':''}}>100</option>
                            </select>
                        </div>
                        <div  class="pull-right">
                            <p class="layout-view"> @lang('app.form.vue'): <a href="javascript:void(0)" id="grid"><i class="fa fa-th-large selected" data-layout="6"></i></a> <a href="javascript:void(0)" id="list"><i class="fa fa-list-ul" data-layout="12"></i></a> </p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Show all blog -->
            @include('ajax.blog.all',['items'=>$items])

            <!-- <div class="col-12 p-30px-t">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active">
                        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                    </li>
                </ul>
            </div> -->
        </div>
    </div>
</section> --}}
<!-- End Section no sidebar -->

    @push('script')
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    @endpush

@endsection


