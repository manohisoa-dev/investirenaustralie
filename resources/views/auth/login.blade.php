@extends('layouts.app')


@section('content')
    <!-- Main -->
    <main class="m-55px-t">
        <section style="background-image: url({{ asset('images/slider/1.jpg') }});">
            <div class="container">
                <div class="row align-items-center justify-content-center min-vh-100">
                    <div class="col-md-6 col-xl-5 p-40px-tb">
                        <div class="p-40px white-bg box-shadow border-radius-10" style="margin-top: 20%;">
                            
                            @include('includes.alerts')

                            <div class="p-20px-b text-center">
                                <h3 class="font-w-600 dark-color m-10px-b">@lang('app.login')</h3>
                                <p>@lang('app.txt.login.libelle')</p>
                            </div>
                            <form action="{{route('login')}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="form-control-label">@lang('app.txt.email')</label>
                                    <input type="email" name="email" class="form-control" placeholder="@lang('app.txt.your.email') *" required="required" value="{{ old('email') }}" autofocus>
                                    <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">@lang('app.txt.password')</label>
                                    <input name="password"  type="password" placeholder="@lang('app.txt.your.password') *" class="form-control" placeholder="***********" required="required">
                                    <span class="text-danger">{{ $errors->has('password') ? $errors->first('password') : '' }}</span>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('app.form.login.remember')
                                </div>
                                <div class="p-10px-t">
                                    <button type="submit" class="m-btn m-btn-theme w-100">@lang('app.btn.login')</button>
                                </div>
                                <div class="m-20px-t text-center">
                                    <a href="{{ route('password.request')}}" class="small font-weight-bold">@lang('app.form.login.forgot')</a> 
                                    <div class="dropdown pull-right">
                                      <a href="#" class="small font-weight-bold dropdown-toggle" type="button" data-toggle="dropdown">
                                          @lang('app.form.login.not_registered')</a>
                                          <ul class="dropdown-menu form-control-label">
                                            <li><a href="{{route('register', ['member'])}}">@lang('app.member')</a></li>
                                            <li><a href="{{route('register', ['seller'])}}">@lang('app.seller')</a></li>
                                            <li><a href="{{route('register', ['afa'])}}">@lang('app.afa')</a></li>
                                            <li><a href="{{route('register', ['apl'])}}">@lang('app.apl')</a></li>
                                          </ul>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- main end -->

@endsection

@section('script')


@endsection

