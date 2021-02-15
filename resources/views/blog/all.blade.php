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
        <div class="row">
            <div class="col-md-12 m-10px-l">
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
</section>
<!-- End Section -->

    @push('script') 
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    @endpush

@endsection


