@extends('layouts.backend')

@section('subcontent')

    @include('includes.alerts')

    {!! Auth::user()->use_default_password != 0 ? '<div class="alert alert-info alert-dismissible fade show col-lg-12 m-40px-t" role="alert">
        <strong>'.trans('app.txt.changepasswordobligatoire').'</strong> 
    </div>' : '' !!}
    
    <div class="profile-content-area m-40px-tb card card-body">
        <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
            <h5>@lang('app.txt.editpassword')</h5>
            <div class="row border-top-1 border-color-dark-gray p-25px-t">
                <form id="updatePasswordForm" class="form-horizontal col-lg-12" method="post" action="{{route('password.update')}}">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <input type="hidden" id="use_default_password" name="use_default_password" value="{{ Auth::user()->useDefaultPassword() }}">
                    <fieldset>
                        <div class="form-group form-group-old_password">
                            <label class="col-sm-12 control-label" for="old_password">@lang('app.txt.oldpassword') *</label>
                            <div class="col-sm-12">
                                <input name="old_password" type="password" data-toggle="password" class="form-control" id="old_password" placeholder="@lang('app.txt.oldpassword')" value="{{ old('old_password')?old('old_password'):(session()->get('default_password')?session()->get('default_password'):'') }}" {{ Auth::user()->useDefaultPassword()?'readonly':'' }} required>
                                <span class="text-danger">{{ $errors->has('old_password') ? $errors->first('old_password') : '' }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 control-label" for="password">@lang('app.txt.newpassword') *</label>
                            <div class="col-sm-12">
                                <input name="password" type="password" class="form-control" data-toggle="password" id="password" placeholder="@lang('app.txt.newpassword')" value="{{ old('password')?old('password'):'' }}" required>
                                <span class="text-danger">{{ $errors->has('password') ? $errors->first('password') : '' }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 control-label" for="password_confirmation">@lang('app.txt.confirmpassword') *</label>
                            <div class="col-sm-12">
                                <input name="password_confirmation" type="password" class="form-control" data-toggle="password" id="password_confirmation" placeholder="@lang('app.txt.confirmpassword')" value="{{ old('password_confirmation')?old('password_confirmation'):'' }}" required>
                                <span class="text-danger">{{ $errors->has('password_confirmation') ? $errors->first('password_confirmation') : '' }}</span>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group p-15px-t">
                        <div class="col-sm-offset-12 col-sm-12 text-right">
                            <button type="submit" class="m-btn m-btn-theme" id="btn_save">@lang('app.btn.save')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <!-- Jquery Validate -->
    <script src="{{ asset('administrator/js/plugins/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-show-password.min.js') }}"></script>
    <script>
        $(window).on('load',function(){
            $('#use_default_password').val()?$('#old_password').rules("remove"):'';
        });

        $.validator.addMethod('ge', function (value, element, param) {
            return this.optional(element) || value === $(param).val();
        }, '@lang("app.txt.password_do_not_match")');
        
        $.validator.addMethod('regex', function (value, element) {
            // 8 caractères min : 1 letter maj, 1 letter min, 1 number 1 car spéciaux
            return this.optional(element) || value.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d](?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/);
        }, '@lang("app.txt.regex_mdp")');

        $('#updatePasswordForm').validate({
            ignore: [],
            rules: {
                old_password: {
                    required: true,
                    minlength:8,
                    remote: {
                        url: "{{ route('ajaxCheckPassword') }}",
                        type: "get",
                        data: {
                            pwd: function () {
                                return $("input[name='old_password']").val();
                            },
                            user_id: function () {
                                return $("input[name='user_id']").val();
                            }
                        },
                    },
                },
                password: {
                    required: true,
                    minlength:8,
                    regex: true,
                },
                password_confirmation: {
                    required: true,
                    minlength:8,
                    ge:'#password',
                    regex: true,
                },
            },
            messages: {
                old_password: {
                    required: "@lang('app.txt.champobligatoire')",
                    minlength: "@lang('app.txt.password_min_validation')",
                    remote: jQuery.validator.format("@lang('app.txt.password_error')")
                },
                password: {
                    required: "@lang('app.txt.champobligatoire')",
                    minlength: "@lang('app.txt.password_min_validation')",
                },
                password_confirmation: {
                    required: "@lang('app.txt.champobligatoire')",
                    minlength: "@lang('app.txt.password_min_validation')",
                    ge: '@lang("app.txt.password_do_not_match")',
                },
            },
            errorPlacement: function ( error, element ) {
                if(element.parent().hasClass('input-group')){
                    error.insertAfter( element.parent() );
                }else{
                    error.insertBefore( element );
                }
            },
        });

        $('#updatePasswordForm').submit(function() { // fires on every keyup & blur
            if ($('#updatePasswordForm').valid()) {                   // checks form for validity
                // set btn submit to loading btn
                $('#btn_save').attr('disabled','disabled');
                $('#btn_save').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>@lang("app.txt.loading")');
            } else {
                $('btn_save').prop('disabled', false);   // enable button
                $('#btn_save').html('@lang("app.btn.save")');
            }
        });
    </script>
    <style>
        .error {
            color: #F00;
            background-color: #FFF;
        }
    </style>
    <!-- End Jquery Validate -->
@endpush
