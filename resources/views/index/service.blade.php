@extends('layouts.app')

@section('content')
<!-- Main -->
<main>
    <!-- Page Title -->
    @component('includes.breadcrumb')
        @lang('service')
    @endcomponent
    <!-- Section -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">

                    @if(!empty($item->content))
                        <div class="nav p-25px-b">
                            <span class="h2 dark-color font-w-600">{{ $item->title }}</span>
                        </div>
                    
                        {!! $item->content !!}

                        @if(Auth::check()&&Auth::user()->isAdmin())
                            <a href="{{route('admin.page.update',$item)}}" class="more pull-right"><i class="fa fa-pencil"></i> @lang('app.btn.edit')</a> 
                        @endif
                    @endif
                    @foreach($item->childs as $child)
                        <div class="nav p-25px-b">
                            <span class="h2 dark-color font-w-600">{{$child->title}}</span>
                        </div>
                    
                        {!! $child->content !!}

                        @if(Auth::check()&&Auth::user()->isAdmin())
                            <a href="{{route('admin.page.update',$child)}}" class="more pull-right"><i class="fa fa-pencil"></i> @lang('app.btn.edit')</a> 
                        @endif
                    
                        @foreach($child->pubs as $pub)
                        <div class="nav p-25px-b">
                            <span class="h2 dark-color font-w-600">{{$pub->title}}</span>
                        </div>
                    
                        <div class="content-box-large box-with-header">
                            <a target="_blank" href="{{$pub->links?$pub->links:'#'}}"><img src="{{$pub->imageUrl()}}" class="img-rounded" alt="Cinque Terre" width="604" height="236"></a>
                        </div>

                        @endforeach
                    @endforeach

                    
                    
                </div>
                <!-- Sidebar -->
                    @include('includes.sidebar')
                <!-- fin sidebar -->

            </div>
        </div>
    </section>
    <!-- End Section -->
</main>

@endsection

@section('script')
<script src="{{ asset('js/app.js') }}"></script>
@endsection
