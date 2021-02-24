@extends('layouts.backend')

@section('subcontent')
<div class="row col-lg-8 col-xl-9">
    @include('includes.alerts')
    <div class="col-lg-8 col-xl-8">
        <div class="profile-content-area m-40px-tb card card-body">
            <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                <h5>{{isset($title)?$title:__('app.list.mail')}}</h5>
                <div class="row">
                    <div class="col-md-12 m-10px-tb">
                        <div class="media">
                            <div class="media-body p-15px-l lh-normal">
                                @foreach($items as $item)
                                    @include('backend.mail.item', ['mail'=>$item])
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-xl-4">
        <div class="profile-content-area m-40px-tb card card-body">
            <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                <h5>{{isset($title)?$title:__('app.list.mail')}}</h5>
                <div class="row">
                    <div class="col-md-12 m-10px-tb">
                        <div class="media">
                            <div class="media-body p-15px-l lh-normal">
                                    <p><a href="{{route(\App\Models\User::find(Auth::id())->roleUser->role_initial.'.mail.list',['filter'=>'inbox'])}}"><i class="fa fa-envelope-open-text" aria-hidden="true"></i> @lang('app.mail.inbox')</a></p>
                                    <p><a href="{{route(\App\Models\User::find(Auth::id())->roleUser->role_initial.'.mail.list',['filter'=>'outbox'])}}"><i class="fa fa-paper-plane" aria-hidden="true"></i> @lang('app.mail.outbox')</a></p>
                                    <p><a href="{{route(\App\Models\User::find(Auth::id())->roleUser->role_initial.'.mail.list',['filter'=>'draft'])}}"><i class="fa fa-edit" aria-hidden="true"></i> @lang('app.mail.draft')</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
