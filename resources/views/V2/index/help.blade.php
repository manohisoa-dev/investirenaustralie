@extends('V2.layouts.app')

@section('content')
<!-- Main -->
<main>
    <!-- Page Title -->
    @component('V2.includes.breadcrumb')
        @lang('help')
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
                    @include('V2.includes.sidebar')
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
