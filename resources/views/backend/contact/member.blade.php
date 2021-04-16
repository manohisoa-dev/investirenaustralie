@extends('layouts.backend')

@section('subcontent')
<!-- Section -->
<div class="col-lg-8 col-xl-9">
    <div class="profile-content-area m-40px-tb card card-body">
        <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
            <h5>{{$title}}</h5>
            <div class="row">
                <div class="col-md-12 m-10px-tb">
                    <div class="media">
                        <div class="media-body p-15px-l lh-normal">
                            {{-- <form class="rd-mailform" data-form-output="form-output-global" data-form-type="contact" method="post" action="{{$action}}"> --}}
                            <form id="formContact" data-form-output="form-output-global" data-form-type="contact" method="post" action="{{$action}}">
                                {{ csrf_field() }}
                                <div class="row">
                                    {{-- Si Member peut contacter une APL sans avoir être en relation avec une APL  --}}
                                    {{-- <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label">@lang('app.apl')</label>
                                            @if (Auth::user()->hasApl())
                                                <input id="subject" name="apl_name" type="text" placeholder="APL *" aria-required="true" required="required" value="" class="form-control" readonly>
                                            @else
                                                <select name="apl_name" class="form-control">
                                                    @forelse ($apls as $apl)
                                                        <option value="{{ $apl->name }}">{{ $apl->name }}</option>
                                                    @empty
                                                        <option value="">@lang('app.txt.no_apl')</option>
                                                    @endforelse
                                                </select>
                                            @endif
                                        </div>
                                    </div> --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{-- Contact afa --}}
                                            @if ($role === 'afa')
                                                <label class="form-control-label">@lang('app.afa')</label>
                                                @if ($user_name !== "")
                                                    <input id="subject" name="to" type="text" placeholder="AFA *" aria-required="true" required="required" value="{{ $user_name }}" class="form-control" readonly>
                                                @else
                                                    <select name="to" class="form-control">
                                                        <option value="" selected disabled>@lang('app.txt.list_afa')</option>
                                                        @forelse ($lafas as $afa)
                                                            <option value="{{ $afa->id }}">{{ $afa->name }}</option>
                                                        @empty
                                                            <option value="">@lang('app.txt.no_afa')</option>
                                                        @endforelse
                                                    </select>
                                                @endif
                                            @endif
                                            {{-- End contact afa --}}
                                        </div>
                                    </div>
                                    @if ($role !== 'admin')
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label">@lang('app.subject')</label>
                                            <input id="subject" name="subject" type="text" placeholder="Sujet *" aria-required="true" required="required" value="{{old('subject')}}" class="form-control">
                                        </div>
                                    </div>
                                    @endif
                                    <input id="to" name="to" type="hidden" class="form-control" value="{{ $role }}">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label">@lang('app.comment')</label>
                                            <textarea id="content" name="content" placeholder="@lang('app.message') ..." cols="45" rows="8" aria-required="true" required="required" data-constraints="@Required" class="form-control">{{old('content')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label>@lang('app.attachments') (jpg, jpeg, png, gif, pdf: Max: 2MB)</label>
                                            <input type="file" name="files[]" accept="file_extension|image/*|media_type" multiple>
                                        </div>
                                    </div>
                                    <div class="col-md-12 p-10px-t">
                                        <button id="btn_send" class="m-btn m-btn-theme w-100" type="button" name="send" data-hover="@lang('app.btn.send')">@lang('app.btn.send')</button>
                                        <div class="snackbars" id="form-output-global"></div>
                                    </div>
                                </div>
                                <div class="alert alert-dismissible fade show col-lg-12 m-15px-t print-msg" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    <ul></ul>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Section -->
@endsection

@push('script')
    <script>
        
            $('#btn_send').click(function(event){
                event.preventDefault();

                var formData = $('#formContact').serialize();

                $.ajax({
                    type: "POST",
                    url: '{{ $action }}',
                    data: formData,
                    dataType: "json",
                    // encode: true,
                    success:function(data){
                        if($.isEmptyObject(data.error)){
                            $('#formContact')[0].reset();
                            printSuccessMsg(data.success);
                        }else{
                            printErrorMsg(data.error);
                        }
                    },
                    error:function(){
                        alert('Error');
                    }
                });
            });

            function printErrorMsg (msg) {
                $(".print-msg").addClass('alert-danger');
                $(".print-msg").removeClass('alert-success');
                $(".print-msg").find("ul").html('');
                $(".print-msg").css('display','block');
                $.each( msg, function( key, value ) {
                    $(".print-msg").find("ul").append('<li>'+value+'</li>');
                });
            }

            function printSuccessMsg (msg) {
                $(".print-msg").addClass('alert-success');
                $(".print-msg").removeClass('alert-danger');
                $(".print-msg").find("ul").html('');
                $(".print-msg").css('display','block');
                $(".print-msg").find("ul").append('<li>'+msg+'</li>');
            }
        
    </script>    
@endpush
