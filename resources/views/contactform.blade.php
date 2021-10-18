<!DOCTYPE html>
<html>
<head>
    <title>Google reCAPTCHA v2</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    {!! NoCaptcha::renderJs() !!}
</head>
<body>
<div class="container" style="margin-top: 50px; width: 750px;">
    <div class="card card-primary">
        <div class="card-body">
            <h4 class="card-title text-center">Google reCAPTCHA v2</h4>
            <form class="form-horizontal" role="form" method="POST" action="{{ route('contact-request') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Name</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">E-Mail Address</label>
                    <div class="col-md-12">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Message</label>
                    <div class="col-md-12">
                        <textarea class="form-control" name="message" rows="3">{{ old('message') }}</textarea>
                        @if ($errors->has('message'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('message') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Captcha</label>
                    <div class="col-md-12">
                        {!! app('captcha')->display() !!}
                        @if ($errors->has('g-recaptcha-response'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{bcrypt("Membre123#")}}

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <br/>
                        <button type="submit" class="btn btn-primary">
                            Contact
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>