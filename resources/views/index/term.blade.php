@extends('layouts.app')

@section('content')
<!-- Main -->
<main>
    <!-- Page Title -->
    @component('includes.breadcrumb')
        @lang('terme')
    @endcomponent
    <!-- Section -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="nav p-25px-b">
                        <span class="h2 dark-color font-w-600">{{ $item->title }}</span>
                    </div>
                    
                    {!! $item->content !!}
                    
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
