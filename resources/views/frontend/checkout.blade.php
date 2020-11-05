@extends('layouts.frontend-layout')

@section('frontend_page_title')  Checkout  @endsection

@section('checkout')  active  @endsection

@section('content')
	<!-- .breadcumb-area start -->
	<div class="breadcumb-area bg-img-4 ptb-100">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="breadcumb-wrap text-center">
						<h2>Checkout</h2>
						<ul>
							<li><a href="{{url('/')}}">Home</a></li>
							<li><span>Checkout</span></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- .breadcumb-area end -->
	<!-- checkout-area start -->
	<div class="checkout-area ptb-100">
		<div class="container">
			@if(session('checkout_allert'))
			<div class="alert alert-warning">
				<strong>{{session('checkout_allert')}}</strong>
			</div>
			@endif
			<form action="{{url('checkout-post')}}" method="post">
				@csrf
				<div class="row">
					<div class="col-lg-8">
						<div class="checkout-form form-style">
							<h3>Billing Details</h3>
							@csrf
							<div class="row">
								<div class="col-sm-6 col-6">
									<p>Full Name *</p>
									<input type="text" name="fname" value="{{Auth::user()->name}}">
								</div>
								<div class="col-sm-6 col-6">
									<p>Email Address *</p>
									<input type="email" name="email" value="{{Auth::user()->email}}">
								</div>
								<div class="col-sm-12 col-12">
									<p>Phone No. *</p>
									<input type="text" name="phone" value="">
								</div>
								<div class="col-6">
									<p>Country *</p>
									<select name="country_id" id="countryList">
										<option value="">-- Select Country --</option>
										@foreach($countries as $country)
										<option value="{{$country->id}}">{{$country->country_name}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-sm-6 col-12">
									<p>Town/City *</p>
									<select name="city_id" id="cityList">
										<option value="">-- Select City --</option>
									</select>
								</div>
								<div class="col-12">
									<p>Your Address *</p>
									<input type="text" name="address" value="">
								</div>

								<div class="col-12">
									<p>Order Notes </p>
									<textarea name="note" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
								</div>
							</div>
						</div>
					</div>


					<!-- order section -->
					<div class="col-lg-4">
						<div class="order-area">
							<h3>Your Order</h3>
							<ul class="total-cost">
								@foreach(cartProducts() as $cart_product)
								<li>{{$cart_product->productTable->product_name}} <span class="pull-right">Tk. {{$cart_product->productTable->product_price * $cart_product->quantity}}</span></li>
								@endforeach
								<li>Subtotal <span class="pull-right"><strong>Tk. {{cartSubtotal()}}</strong></span>
									<input type="hidden" name="subtotal" value="{{cartSubtotal()}}">
								</li>
								<li>Shipping <span class="pull-right">Free</span></li>
								<li>Total<span class="pull-right">{{$cart_total}}</span>
									<input type="hidden" name="total" value="{{$cart_total}}">
								</li>
							</ul>
							<ul class="payment-method">
								<li>
									<input id="card" type="radio" value="1" name="payment_method">
									<label for="card">Credit Card</label>
								</li>
								<li>
									<input id="delivery" type="radio" value="2" name="payment_method">
									<label for="delivery">Cash on Delivery</label>
								</li>
							</ul>
							<button type="submit">Place Order</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- checkout-area end -->
@endsection

@section('body_script')
<script>
	$(document).ready(function(){
		$('#countryList').change(function(){
			var country_id = $(this).val();

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type:'GET',
				url:'get-city-list',
				data:{country_id:country_id},
				success:function(data){
					$('#cityList').html(data);
				}
			});
			
		});
	});
</script>
@endsection