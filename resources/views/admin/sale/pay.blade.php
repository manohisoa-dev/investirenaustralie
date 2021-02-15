@extends('admin.layouts.app')

@section('title', 'Vente - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Ventes</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.sale.index') }}">Ventes</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>{{$title}}</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12"></div>
</div>

@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{$title}}</h5>
			</div>
			<div class="ibox-content">
			{!! Form::open(['url' => route('home'), 'data-parsley-validate']) !!}
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>First Name</label> 
							<input class="form-control" required="required" name="first_name" type="text" value="">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Last Name</label> 
							<input class="form-control" required="required" name="last_name" type="text" value="">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Email address</label> 
							<input class="form-control" required="required" name="email" type="email" value="{{$user->email}}">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label>Credit card number</label> 
							<input class="form-control" required="required" data-parsley-type="number" maxlength="16" data-parsley-trigger="change focusout" data-parsley-class-handler="#cc-group" type="text" value="" data-parsley-id="11">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Card Validation Code (3 or 4 digit number)</label> 
							<input class="form-control" required="required" data-parsley-type="number" data-parsley-trigger="change focusout" maxlength="4" data-parsley-class-handler="#ccv-group" type="text" value="">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Ex. Month</label> 
							{!! Form::selectMonth(null, null, [
                              'class'                 => 'form-control',
                              'required'              => 'required'
                          ], '%m') !!}
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Ex. Year</label> 
							{!! Form::selectYear(null, date('Y'), date('Y') + 10, null, [
                              'class'             => 'form-control',
                              'required'          => 'required'
                              ]) !!}
						</div>
					</div>
				</div>
				<div class="hr-line-dashed"></div>
				<button type="submit" class="btn btn-primary pull-right" id="submitBtn">Place order!</button>
				<div style="clear:both"></div>
			{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@endsection