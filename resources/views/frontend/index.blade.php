@extends('layouts.frontend-layout')

@section('frontend_page_title')
Home
@endsection

@section('home') active @endsection

@section('content')
<!-- slider-area start -->
<div class="slider-area">
	<div class="swiper-container">
		<div class="swiper-wrapper">
			@foreach(App\FrontendElement::all() as $frontend_element)
			<div class="swiper-slide overlay">
				<div class="single-slider slide-inner slide-inner1" style="background: url({{asset('uploads/banners')}}/{{$frontend_element->banner_image}}) center/cover no-repeat;">
					<div class="container">
						<div class="row">
							<div class="col-lg-12 col-lg-9 col-12">
								<div class="slider-content">
									<div class="slider-shape">
										<h2 data-swiper-parallax="-500">{{$frontend_element->banner_title}}</h2>
										<p data-swiper-parallax="-400">{{$frontend_element->banner_desp}}</p>
										<a href="shop.html" data-swiper-parallax="-300">Shop Now</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
			<!-- <div class="swiper-slide">
				<div class="slide-inner slide-inner7">
					<div class="container">
						<div class="row">
							<div class="col-lg-12 col-lg-9 col-12">
								<div class="slider-content">
									<div class="slider-shape">
										<h2 data-swiper-parallax="-500">Amazing Pure Nature Coconut Oil</h2>
										<p data-swiper-parallax="-400">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</p>
										<a href="shop.html" data-swiper-parallax="-300">Shop Now</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="swiper-slide">
				<div class="slide-inner slide-inner8">
					<div class="container">
						<div class="row">
							<div class="col-lg-12 col-lg-9 col-12">
								<div class="slider-content">
									<div class="slider-shape">
										<h2 data-swiper-parallax="-500">Amazing Pure Nut Oil</h2>
										<p data-swiper-parallax="-400">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</p>
										<a href="shop.html" data-swiper-parallax="-300">Shop Now</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> -->
		</div>
		<div class="swiper-pagination"></div>
	</div>
</div>
<!-- slider-area end -->
<!-- featured-area start -->
@component('frontend.frontend-includes.category', ['categories'=>$categories])
@endcomponent
<!-- featured-area end -->
<!-- start count-down-section -->
<div class="count-down-area count-down-area-sub">
	<section class="count-down-section section-padding parallax" data-speed="7">
		<div class="container">
			<div class="row">
				<div class="col-12 col-lg-12 text-center">
					<h2 class="big">Deal Of the Day <span>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</span></h2>
				</div>
				<div class="col-12 col-lg-12 text-center">
					<div class="count-down-clock text-center">
						<div id="clock">
						</div>
					</div>
				</div>
			</div>
			<!-- end row -->
		</div>
		<!-- end container -->
	</section>
</div>
<!-- end count-down-section -->
<!-- product-area start -->
<div class="product-area product-area-2">

	<div class="fluid-container">
		
		@if (session('product_alert'))
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>{{session('product_alert')}}</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		@endif
		
		<div class="row">
			<div class="col-12">
				<div class="section-title">
					<h2>Best Seller</h2>
					<img src="assets/images/section-title.png" alt="">
				</div>
			</div>
		</div>
		<ul class="row">
			@foreach($best_sellers->slice(0, 4) as $best_seller)
			<li class="col-xl-3 col-lg-4 col-sm-6 col-12">
				<div class="product-wrap">
					<div class="product-img">
						<img src="{{asset('uploads/products')}}/{{$best_seller->productTable->product_image}}" alt="">
						<div class="product-icon flex-style">
							<ul>
								<li><a data-toggle="modal" data-target="#{{$best_seller->productTable->id}}" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
								<li>
									<form action="{{url('add-to-wishlist')}}" method="post">
									@csrf
									<input type="text" name="product_id" value="{{$best_seller->productTable->id}}" hidden>
									<a href=""><button type="submit" class="bg-transparent border-0"><i class="fa fa-heart"></i></button></a>
									</form>
								</li>
								<li>
									<form action="{{url('add-to-cart-single')}}" method="post">
									@csrf
									<input type="text" name="product_id" value="{{$best_seller->productTable->id}}" hidden>
									<input type="number" name="quantity" value="1" hidden>
									<a href=""><button type="submit" class="bg-transparent border-0"><i class="fa fa-shopping-bag"></i></button></a>
									</form>
								</li>
							</ul>
						</div>
					</div>
					<div class="product-content">
						<h3><a href="{{route('product.show', $best_seller->productTable->product_slug)}}">{{$best_seller->productTable->product_name}}</a></h3>
						<p class="pull-left">Tk.{{$best_seller->productTable->product_price}}</p>
						<div class="pull-right">
						@component('frontend.frontend-includes.review_stars', ['product_id' => $best_seller->productTable->id])@endcomponent
						</div>
					</div>
				</div>
			</li>
			<!-- Modal area start -->
			<div class="modal fade" id="{{$best_seller->productTable->id}}" tabindex="-1">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<div class="modal-body d-flex">
							<div class="product-single-img w-50">
								<img src="{{asset('uploads/products')}}/{{$best_seller->productTable->product_image}}" alt="">
							</div>
							<div class="product-single-content w-50">
								<h3>{{$best_seller->productTable->product_name}}</h3>
								<div class="rating-wrap fix">
									<span class="pull-left">{{$best_seller->productTable->price}}</span>
									@component('frontend.frontend-includes.review_stars', ['product_id' => $best_seller->productTable->id])
									@endcomponent
									<span>({{App\OrderList::where('product_id',$best_seller->productTable->id)->whereNotNull('review')->count()}} Customar Review)
									</span>  
								</div>
								<p>{{$best_seller->productTable->product_short_desp}}</p>
								<form action="{{url('add-to-cart')}}" method="post">
									<ul class="input-style">
										@csrf
										<div class="form-group"></div>
										<input type="hidden" name="product_id" value="{{$best_seller->productTable->id}}">
										<li class="quantity cart-plus-minus mr-1">
											<input type="text" value="1" name="quantity" />
										</li>
										<li><input type="submit" class="btn btn-danger rounded-0" value="Add to Cart"></li>
									</ul>
								</form>
								<ul class="cetagory">
									<li>Categories:</li>
									<li><a href="#">{{$best_seller->productTable->categoryTable->category_name}}</a></li>
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
			@endforeach
		</ul>
	</div>
</div>
<!-- product-area end -->

<!-- product-area start -->
<div class="product-area">
	<div class="fluid-container">
		<div class="row">
			<div class="col-12">
				<div class="section-title">
					<h2>Our Latest Product</h2>
					<img src="assets/images/section-title.png" alt="">
				</div>
			</div>
		</div>
			
		<ul class="row">

			@php $count = 1 @endphp
			@foreach($products as $product)
			<li class="col-xl-3 col-lg-4 col-sm-6 col-12 {{($count<5)?'':'moreload'}}">
				<div class="product-wrap">
					<div class="product-img">
						<span>Sale</span>
						<img src="{{asset('uploads/products')}}/{{$product->product_image}}" alt="Product Image">
						<div class="product-icon flex-style">
							<ul>
								<li><a data-toggle="modal" data-target="#{{$product->id}}" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
								<li>
									<form action="{{url('add-to-wishlist')}}" method="post">
									@csrf
									<input type="text" name="product_id" value="{{$product->id}}" hidden>
									<a href=""><button type="submit" class="bg-transparent border-0"><i class="fa fa-heart"></i></button></a>
									</form>
								</li>
								<li>
									<form action="{{url('add-to-cart-single')}}" method="post">
									@csrf
									<input type="text" name="product_id" value="{{$product->id}}" hidden>
									<input type="number" name="quantity" value="1" hidden>
									<a href=""><button type="submit" class="bg-transparent border-0"><i class="fa fa-shopping-bag"></i></button></a>
									</form>
								</li>
							</ul>
						</div>
					</div>
					<div class="product-content">
						<h3><a href="{{route('product.show', $product->product_slug)}}">{{$product->product_name}}</a></h3>
						<p class="pull-left">Tk. {{$product->product_price}}</p>
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
<!-- testmonial-area start -->
<div class="testmonial-area testmonial-area2 bg-img-2 black-opacity">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="test-title text-center">
					<h2>What Our client Says</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 offset-md-1 col-12">
				<div class="testmonial-active owl-carousel">
					<div class="test-items test-items2">
						<div class="test-content">
							<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical LatinContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</p>
							<h2>Elizabeth Ayna</h2>
							<p>CEO of Woman Fedaration</p>
						</div>
						<div class="test-img2">
							<img src="assets/images/test/1.png" alt="">
						</div>
					</div>
					<div class="test-items test-items2">
						<div class="test-content">
							<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical LatinContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</p>
							<h2>Elizabeth Ayna</h2>
							<p>CEO of Woman Fedaration</p>
						</div>
						<div class="test-img2">
							<img src="assets/images/test/1.png" alt="">
						</div>
					</div>
					<div class="test-items test-items2">
						<div class="test-content">
							<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical LatinContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</p>
							<h2>Elizabeth Ayna</h2>
							<p>CEO of Woman Fedaration</p>
						</div>
						<div class="test-img2">
							<img src="assets/images/test/1.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- testmonial-area end -->
@endsection