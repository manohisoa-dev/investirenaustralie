@extends('V2.admin.layouts.app')

@section('title', 'Configuration site')

@section('breadcrumb')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Basic Form</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('V2/admin')}}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Forms</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Basic Form</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
@endsection

@section('content')
    <div class="row">
    <div class="col-lg-7">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Basic form <small>Simple login form example</small></h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#" class="dropdown-item">Config option 1</a>
                        </li>
                        <li><a href="#" class="dropdown-item">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">Sign in</h3>
                        <p>Sign in today for more expirience.</p>
                        <form role="form">
                            <div class="form-group"><label>Email</label> <input type="email" placeholder="Enter email" class="form-control"></div>
                            <div class="form-group"><label>Password</label> <input type="password" placeholder="Password" class="form-control"></div>
                            <div>
                                <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"><strong>Log in</strong></button>
                                <label> <input type="checkbox" class="i-checks"> Remember me </label>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6"><h4>Not a member?</h4>
                        <p>You can create an account:</p>
                        <p class="text-center">
                            <a href=""><i class="fa fa-sign-in big-icon"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Horizontal form</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#" class="dropdown-item">Config option 1</a>
                        </li>
                        <li><a href="#" class="dropdown-item">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <form>
                    <p>Sign in today for more expirience.</p>
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Email</label>

                        <div class="col-lg-10"><input type="email" placeholder="Email" class="form-control"> <span class="form-text m-b-none">Example block-level help text here.</span>
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Password</label>

                        <div class="col-lg-10"><input type="password" placeholder="Password" class="form-control"></div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-offset-2 col-lg-10">
                            <div class="i-checks"><label> <input type="checkbox"> Remember me </label></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-sm btn-white" type="submit">Sign in</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection