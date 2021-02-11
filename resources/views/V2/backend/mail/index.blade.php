@extends('V2.layouts.backend')

@section('subcontent')
<div class="col-lg-8 col-xl-9">
    <div class="profile-content-area m-40px-tb card card-body">
        <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
            <div class="row">
                <div class="col-md-12 m-10px-tb">
                    <div class="media">
                        <div class="media-body p-15px-l lh-normal">
                            <a href="{{route(App\Role::find(Auth::user()->role)->role_initial.'.mail.delete', $item)}}" class="pull-right submit-btn btn btn-default btn-lg" data-hover="@lang('app.btn.delete')" title="@lang('app.btn.delete')"><i class="fa fa-trash-alt"></i></a>
                            <section class="widget property-contents common">
                                <h3 class="entry-title">{{$item->subject}}</h3>
                                <p>{{$item->content}}</p>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="profile-content-area m-40px-tb card card-body">
        <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
            <h5>@lang('app.reply')</h5>
            <div class="row">
                <div class="col-md-12 m-10px-tb">
                    <div class="media">
                        <div class="media-body p-15px-l lh-normal">
                            <form class="rd-mailform" data-form-output="form-output-global" data-form-type="contact" method="post" action="{{route('contact')}}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label">@lang('app.subject')</label>
                                            <input id="subject" name="subject" type="text" placeholder="Sujet *" aria-required="true" required="required" value="{{old('subject')}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label">@lang('app.comment')</label>
                                            <textarea id="content" name="content" placeholder="@lang('app.message')" cols="45" rows="8" aria-required="true" required="required" data-constraints="@Required" class="form-control">{{old('content')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 p-10px-t">
                                        <button class="m-btn m-btn-theme m-btn-radius w-100" type="submit" name="send" data-hover="@lang('app.btn.send')">@lang('app.btn.send')</button>
                                        {{-- <span id="ajax-loader"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i><span class="sr-only">Loading...</span></span> --}}
                                        <div class="snackbars" id="form-output-global"></div>
                                    </div>
                                </div>
                                <div id="error-container"></div>
                                <div id="message-container"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection