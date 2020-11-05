@extends('layouts.frontend-layout')

@section('frontend_page_title')
Search Product
@endsection

@section('content')
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="breadcumb-wrap text-center">
					<h2>Search Product</h2>
					<ul>
						<li><a href="{{url('/')}}">Home</a></li>
						<li><span>Search</span></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- .breadcumb-area end -->
<!-- product-area start -->
<div class="product-area">
	<div class="fluid-container">
		<div class="row">
			<div class="col-12">
				<div class="section-title">
					<h2>Search Product</h2>
					<img src="assets/images/section-title.png" alt="">
				</div>
			</div>
		</div>
		<ul class="row">
			@php $count = 1 @endphp
			@foreach($searched as $product)
			<li class="col-xl-3 col-lg-4 col-sm-6 col-12 {{($count<5)?'':'moreload'}}">
				<div class="product-wrap">
					<div class="product-img">
						<span>Sale</span>
						<img src="{{asset('uploads/products')}}/{{$product->product_image}}" alt="Product Image">
						<div class="product-icon flex-style">
							<ul>
								<li><a data-toggle="modal" data-target="#{{$product->id}}" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
								<li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
								<li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="product-content">
						<h3><a href="{{route('product.show', $product->product_slug)}}">{{$product->product_name}} | {{App\Category::find($product->category_id)->category_name}}</a></h3>
						<p class="pull-left">Tk. {{$product->product_price}}

						</p>
						<div class="pull-right">
						@component('frontend.frontend-includes.review_stars', ['product_id' => $product->id])
						@endcomponent
						</div>

					</div>
				</div>
			</li>
			<!-- Modal area start -->
			<div class="modal fade" id="{{$product->id}}" tabindex="-1">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<div class="modal-body d-flex">
							<div class="product-single-img w-50">
								<img src="{{asset('uploads/products')}}/{{$product->product_image}}" alt="">
							</div>
							<div class="product-single-content w-50">
								<h3>{{$product->product_name}}</h3>
								<div class="rating-wrap fix">
									<span class="pull-left">{{$product->price}}</span>
									@component('frontend.frontend-includes.review_stars', ['product_id' => $product->id])
									@endcomponent
									<span>({{App\OrderList::where('product_id',$product->id)->whereNotNull('review')->count()}} Customar Review)
									</span>  
								</div>
								<p>{{$product->product_short_desp}}</p>
								<form action="{{url('add-to-cart')}}" method="post">
									<ul class="input-style">
										@csrf
										<div class="form-group"></div>
										<input type="hidden" name="product_id" value="{{$product->id}}">
										<li class="quantity cart-plus-minus mr-1">
											<input type="text" value="1" name="quantity" />
										</li>
										<li><input type="submit" class="btn btn-danger rounded-0" value="Add to Cart"></li>
									</ul>
								</form>
								<ul class="cetagory">
									<li>Categories:</li>
									<li><a href="#">{{$product->categoryTable->category_name}}</a></li>
								</ul>
								<ul class="socil-icon">
									<li>Share :</li>
									<li><a href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
									<li><a href="#"><i class="fa fa-instagram"></i></a></li>
									<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal area end -->
			@php $count++ @endphp
			@endforeach
			<!-- 
			<li class="col-xl-3 col-lg-4 col-sm-6 col-12  moreload">
				<div class="product-wrap">
					<div class="product-img">
						<span>Sale</span>
						<img src="assets/images/product/10.jpg" alt="">
						<div class="product-icon flex-style">
							<ul>
								<li><a data-toggle="modal" data-target="#exampleModalCenter" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
								<li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
								<li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="product-content">
						<h3><a href="single-product.html">Pure Nature Product</a></h3>
						<p class="pull-left">$125

						</p>
						<ul class="pull-right d-flex">
							<li><i class="fa fa-star"></i></li>
							<li><i class="fa fa-star"></i></li>
							<li><i class="fa fa-star"></i></li>
							<li><i class="fa fa-star"></i></li>
							<li><i class="fa fa-star-half-o"></i></li>
						</ul>
					</div>
				</div>
			</li> 
			-->

			<li class="col-12 text-center">
				<a class="loadmore-btn" href="javascript:void(0);">Load More</a>
			</li>
		</ul>
	</div>
</div>
<!-- product-area end -->
@endsection