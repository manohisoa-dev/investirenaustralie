@extends('layouts.backend')

@section('subcontent')
<div class="col-lg-8 col-xl-9">
    @include('includes.alerts')

    {!! Auth::user()->use_default_password != 0 ? '<div class="alert alert-info alert-dismissible fade show col-lg-12 m-40px-t" role="alert">
        <strong>'.trans('app.txt.changepasswordobligatoire').'</strong> 
    </div>' : '' !!}

    <div class="profile-content-area m-40px-tb card card-body">
        <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
            <h5>@lang('app.txt.editpassword')</h5>
            <div class="row border-top-1 border-color-dark-gray p-25px-t">
                <form class="form-horizontal col-lg-12" role="form" method="post" action="{{route('password.update')}}">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-12 control-label" for="old_password">@lang('app.txt.oldpassword') *</label>
                            <div class="col-sm-12">
                                <input name="old_password" type="password" class="form-control" id="old_password" placeholder="@lang('app.txt.oldpassword')" value="{{ old('old_password')?old('old_password'):'' }}" required>
                                <span class="text-danger">{{ $errors->has('old_password') ? $errors->first('old_password') : '' }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 control-label" for="password">@lang('app.txt.newpassword') *</label>
                            <div class="col-sm-12">
                                <input name="password" type="password" class="form-control" id="password" placeholder="@lang('app.txt.newpassword')" value="{{ old('password')?old('password'):'' }}" required>
                                <span class="text-danger">{{ $errors->has('password') ? $errors->first('password') : '' }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 control-label" for="password_confirmation">@lang('app.txt.confirmpassword') *</label>
                            <div class="col-sm-12">
                                <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="@lang('app.txt.confirmpassword')" value="{{ old('password_confirmation')?old('password_confirmation'):'' }}" required>
                                <span class="text-danger">{{ $errors->has('password_confirmation') ? $errors->first('password_confirmation') : '' }}</span>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group p-15px-t">
                        <div class="col-sm-offset-12 col-sm-12 text-right">
                            <button type="submit" class="m-btn m-btn-theme">@lang('app.btn.save')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

