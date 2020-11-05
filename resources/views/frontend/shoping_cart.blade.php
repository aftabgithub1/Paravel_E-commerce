@extends('layouts.frontend-layout')

@section('frontend_page_title')  Shoping Cart  @endsection

@section('cart')  active  @endsection

@section('content')
	<!-- .breadcumb-area start -->
	<div class="breadcumb-area bg-img-4 ptb-100">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="breadcumb-wrap text-center">
						<h2>Shopping Cart</h2>
						<ul>
							<li><a href="{{url('/')}}">Home</a></li>
							<li><span>Shopping Cart</span></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- .breadcumb-area end -->
	<!-- cart-area start -->
	<div class="cart-area ptb-100">
		<div class="container">
		    
			@if (session('shopping_cart_allert'))
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<strong>{{session('shopping_cart_allert')}}</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			@endif
		
			<div class="row">
				<div class="col-12">


						<form action="{{url('update-cart')}}" method="post">
							@csrf
						<table class="table-responsive cart-wrap">
							<thead>
								<tr>
									<th class="images">Image</th>
									<th class="product">Product</th>
									<th class="ptice">Price</th>
									<th class="quantity">Quantity</th>
									<th class="total">Total</th>
									<th class="remove">Remove</th>
								</tr>
								</thead>
								
							  <tbody>
									@php $cart_subtotal = 0; @endphp
									@forelse(cartProducts() as $cart)
									<tr>
										<td class="images"><img src="{{asset('uploads/products')}}/{{$cart->productTable->product_image}}" alt=""></td>
										<td class="product"><a href="single-product.html">{{$cart->productTable->product_name}}</a></td>
										<td class="ptice">Tk. {{$cart->productTable->product_price}}</td>
										<input type="number" name="cart_id[]" value="{{$cart->id}}" hidden>
										<td class="quantity cart-plus-minus">
											<input type="text" name="cart_quantity[]" value="{{$cart->quantity}}">
										</td>
										<td class="total">{{$cart->productTable->product_price * $cart->quantity}}</td>
										<td class="remove"><a href="{{url('delete-cart')}}/{{$cart->id}}"><i class="fa fa-times"></i></a></td>
									</tr>
									@php 
									$cart_subtotal += $cart->productTable->product_price * $cart->quantity; 
									@endphp
									@empty
									<tr><h3><strong class="text-danger">No Items</strong></h3></tr>
									@endforelse
							  </tbody>
							</table>
							<div class="mt-4">
								<ul class="d-flex">
									<li class="mr-2">
										<button type="submit" class="btn btn-secondary btn-lg rounded-0">Update Cart</button>
									</li>
									<li class="mr-2">
										<a href="shop.html" class="btn btn-secondary btn-lg rounded-0">Continue Shopping</a>
									</li>
								</ul>
							</div>
							</form>

							<div class="row mt-60">
							  <div class="col-xl-4 col-lg-5 col-md-6 ">
								<div class="cartcupon-wrap">
									<h3>Cupon</h3>
									<p>Enter Your Cupon Code if You Have One</p>
									<div class="cupon-wrap">
										<form action="" method="">
											@csrf
											<input type="text" id="couponCode" placeholder="Cupon Code">
											<button type="button" id="applyBtn">Apply Cupon</button>
										</form>
									</div>
								</div>
							</div>
							<div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
								<div class="cart-total text-right">
									<h3>Cart Totals</h3>
									<ul>
										
										<li><span class="pull-left">Subtotal </span>Tk. {{$cart_subtotal}}</li>
										@if(isset($coupon_discounts))
										<li><span class="pull-left">Discount</span>{{$coupon_discounts}}%</li>
										@endif
										@if(isset($coupon_discounts))
										<li><span class="pull-left">Total</span>
											<span id="cartTotal">Tk. {{$cart_total = $cart_subtotal * (1 - $coupon_discounts/100)}}</span>
										</li>
										@else
										<li><span class="pull-left">Total</span>
											Tk. {{$cart_total = $cart_subtotal}}
										</li>
										@endif
									</ul>
									<form action="{{url('checkout')}}" method="post">
										@csrf
										<input type="hidden" name="cart_total" value="{{$cart_total}}">
										<input type="submit" class="btn btn-lg btn-danger rounded-0 mt-3" value="Proceed to Checkout">
									</form>
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
	<!-- cart-area end -->
@endsection

@section('body_script')
<script>
	$(document).ready(function(){
		$('#applyBtn').click(function(){
			var coupon_code = $('#couponCode').val();
			window.location.href = "{{url('shoping_cart')}}/" + coupon_code;
		});
	});
</script>
@endsection