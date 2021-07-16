@extends('layouts.app')


@section('content')
    <!-- Main -->
    <main>
		<section style="background-image: url({{ asset('images/slider/1.jpg') }});">
            <div class="container">
				<div class="row align-items-center justify-content-center min-vh-100">
                    <div class="col-md-6 col-xl-5 p-40px-tb">
                        <div class="p-40px white-bg box-shadow border-radius-10" style="margin-top: 20%;">
							
							
									<div class="col-sm-12">
										<div class="panel panel-default">
											@if ($message = Session::get('success'))
											<div class="custom-alerts alert alert-success fade in">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
												{!! $message !!}
											</div>
											<?php Session::forget('success');?>
											@endif
											@if ($message = Session::get('error'))
											<div class="custom-alerts alert alert-danger fade in">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
												{!! $message !!}
											</div>
											<?php Session::forget('error');?>
											@endif
											<div class="panel-heading">Paypal integration in Laravel</div>
										 <!-- Devloped by Pakainfo.com -->
											<div class="panel-body">
												<form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('paypal.paypal') !!}" >
													{{ csrf_field() }}
													<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
														<label for="name" class="control-label">Item Name</label>
														<div class="">
															<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>
															@if ($errors->has('name'))
																<span class="help-block">
																	<strong>{{ $errors->first('name') }}</strong>
																</span>
															@endif
														</div>
													</div>
											   <!-- Devloped by Pakainfo.com -->
													<div class="form-group{{ $errors->has('item_qty') ? ' has-error' : '' }}">
														<label for="item_qty" class="control-label">Total Item Quantity</label>
														<div class="">
															<input id="item_qty" type="number" class="form-control" name="item_qty" value="{{ old('item_qty') }}" autofocus>
															@if ($errors->has('item_qty'))
																<span class="help-block">
																	<strong>{{ $errors->first('item_qty') }}</strong>
																</span>
															@endif
														</div>
													</div>
											   <!-- Devloped by Pakainfo.com -->
													<div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
														<label for="amount" class="control-label">Item Amount</label>
														<div class="">
															<input id="amount" type="text" class="form-control" name="amount" value="{{ old('amount') }}" autofocus>
															@if ($errors->has('amount'))
																<span class="help-block">
																	<strong>{{ $errors->first('amount') }}</strong>
																</span>
															@endif
														</div>
													</div>
												 <!-- Devloped by Pakainfo.com -->
													<div class="form-group">
														<div class="col-sm-6 col-sm-offset-4">
															<button type="submit" class="btn btn-primary">
																Payment with Paypal
															</button>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>

							
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
@endsection