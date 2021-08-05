@extends('layouts.backend')

@section('subcontent')

    <div class="profile-content-area m-40px-tb card card-body">
        <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
            <h5>{{$title}}</h5>
            <div class="row">
                <div class="col-md-12 m-10px-tb">
                    <div class="media">
                        <div class="media-body p-15px-l lh-normal">
                            @if(count($items)>0)
                                @include('backend.table.product', ['products'=>$items])
                            @else
                                <span>@lang('member.empty')</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection