<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Paravel - @yield('frontend_page_title')</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" type="image/png" href="{{asset('programming.png')}}">
	<!-- Place favicon.ico in the root directory -->
	<!-- all css here -->
	<!-- bootstrap v4.0.0-beta.2 css -->
	<link rel="stylesheet" href="{{asset('frontend_assets')}}/css/bootstrap.min.css">
	<!-- owl.carousel.2.0.0-beta.2.4 css -->
	<link rel="stylesheet" href="{{asset('frontend_assets')}}/css/owl.carousel.min.css">
	<!-- font-awesome v4.6.3 css -->
	<link rel="stylesheet" href="{{asset('frontend_assets')}}/css/font-awesome.min.css">
	<!-- flaticon.css -->
	<link rel="stylesheet" href="{{asset('frontend_assets')}}/css/flaticon.css">
	<!-- jquery-ui.css -->
	<link rel="stylesheet" href="{{asset('frontend_assets')}}/css/jquery-ui.css">
	<!-- metisMenu.min.css -->
	<link rel="stylesheet" href="{{asset('frontend_assets')}}/css/metisMenu.min.css">
	<!-- swiper.min.css -->
	<link rel="stylesheet" href="{{asset('frontend_assets')}}/css/swiper.min.css">
	<!-- style css -->
	<link rel="stylesheet" href="{{asset('frontend_assets')}}/css/styles.css">
	<!-- preloader css -->
	<link rel="stylesheet" href="{{asset('frontend_assets')}}/css/preloader.css">
	<!-- responsive css -->
	<link rel="stylesheet" href="{{asset('frontend_assets')}}/css/responsive.css">

	<style>
		.search-select{border: 1px solid #999 !important;color: #999 !important;}
		.search-select option{background: #bbb;color: #111 !important;font-size: 20px;}
		.navbar-profile-image{width:30px; height:30px; overflow:hidden; border-radius: 50%;}
		.profile-image{width:100%;}
	</style>

	@yield('style_link')
	@yield('internal_style')
	<!-- modernizr css -->
	<script src="{{asset('frontend_assets')}}/js/vendor/modernizr-2.8.3.min.js"></script>
	
	@yield('script')
	@yield('internal_style_tag')
</head>

<body>
	<!--Start Preloader-->
		<!-- <div class="preloader-wrap">
			<div class="spinner"></div>
		</div> -->

		<!-- <div class="preloader preloader-wrap">
				<svg class="loader" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340 340">
				<circle cx="170" cy="170" r="160" stroke="#9f79ee"/>
				<circle cx="170" cy="170" r="135" stroke="#ffd700"/>
				<circle cx="170" cy="170" r="110" stroke="#dc143c"/>
				<circle cx="170" cy="170" r="85" stroke="#daa520"/>
			</svg>
		</div> -->
	<!--End Preloader-->
	
	<!-- search-form here -->
	<div class="search-area flex-style">
		<span class="closebar">Close</span>
		<div class="container">
			<div class="row">
				<div class="col-md-8 offset-lg-3 col-12">
					<div class="search-form">
						<form action="{{url('search')}}">
							<div class="form-row">
								<div class="col-lg-4 d-flex mb-4">
									<select name="filter[category_id]" class="form-control bg-transparent rounded-0 search-select">
										<option selected hidden>-- Search Category --</option>
										@foreach(App\Category::all() as $category)
										<option value="{{$category->id}}">{{$category->category_name}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-lg-4 d-flex">
									<select name="sort_price" id="" class="form-control bg-transparent rounded-0 search-select">
										<option selected hidden>-- Sort Price --</option>
										<option value="1">Low to high price</option>
										<option value="2">High to low price</option>
									</select>
								</div>
							</div>
							<div class="form-row">
								<div class="col-lg-8">
									<input type="text" name="filter[product_name]" placeholder="Search Here...">
									<button><i class="fa fa-search"></i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- search-form here -->

	<!-- header-area start -->
	<header class="header-area">
		<div class="header-top bg-2">
			<div class="fluid-container">
				<div class="row">
					<div class="col-md-6 col-12">
						<ul class="d-flex header-contact">
							<li><i class="fa fa-phone"></i> +881 720 390 878</li>
							<li><i class="fa fa-envelope"></i>aftab2060@gmail.com</li>
						</ul>
					</div>
					<div class="col-md-6 col-12">
						<ul class="d-flex account_login-area">
							@auth
							<li>
								
								<a href="javascript:void(0);">
								<div class="row align-items-center">
								<div class="navbar-profile-image mr-2">
									<img src="{{asset('uploads/users')}}/{{Auth::user()->image}}" alt="" width="30" class="profile-image">
								</div>
								{{Auth::user()->name}}<i class="fa fa-angle-down"></i></div></a>
								<ul class="dropdown_style">
									<li><a href="{{url('admin-dashboard')}}">My Account</a></li>
									<li><a href="cart.html">Cart</a></li>
									<li><a href="checkout.html">Checkout</a></li>
									<li><a href="wishlist.html">wishlist</a></li>
									<li>
										<a href="{{ route('logout') }}"
										onclick="event.preventDefault();
										document.getElementById('logout-form').submit();"><i class="icon ion-power"></i>Logout</a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
                					</li>
								</ul>
							</li>
							@endauth
							@if(Auth::user()==false)
							<li><a href="{{route('login')}}">Login</a></li>
							<li><a href="{{route('register')}}">Register</a></li>
							@endif
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="header-bottom">
			<div class="fluid-container">
				<div class="row">
					<div class="col-lg-3 col-md-7 col-sm-6 col-6">
						<div class="logo">
							<a href="{{url('/')}}"><h3 class="text-primary"><strong><em><span class="text-danger">P</span>aravel</em></strong></h3></a>
						</div>
					</div>
					<div class="col-lg-7 d-none d-lg-block">
						<nav class="mainmenu">
							<ul class="d-flex">
								<li class="@yield('home')"><a href="{{url('/')}}">Home</a></li>
								<li class="@yield('about')"><a href="{{url('/about')}}">About</a></li>
								<li class="@yield('shop')">
									<a href="javascript:void(0);">Shop <i class="fa fa-angle-down"></i></a>
									<ul class="dropdown_style">
										<li class="@yield('shop_here')"><a href="{{url('shop')}}">Shop Here</a></li>
										<li class="@yield('cart')"><a href="{{url('shoping_cart')}}">Shopping cart</a></li>
										<li class="@yield('checkout')"><a href="{{url('checkout')}}">Checkout</a></li>
										<li class="@yield('wishlist')"><a href="{{url('wishlist')}}">Wishlist</a></li>
									</ul>
								</li>
								<li class="@yield('faq')"><a href="{{url('/faq')}}">FAQ</a></li>
								<li class="@yield('blog')"><a href="{{url('blog-page')}}">Blog</a></li>
								<li class="@yield('contact')"><a href="{{url('/contact')}}">Contact</a></li>
								<!-- <li class="@yield('entertainment')">
									<a href="javascript:void(0);">Entertainment <i class="fa fa-angle-down"></i></a>
									<ul class="dropdown_style">
										<li class="@yield('movies')"><a href="{{url('api-movies')}}">Movies</a></li>
										<li class="@yield('checkout')"><a href="#">###</a></li>
									</ul>
								</li> -->
							</ul>
						</nav>
					</div>
					<div class="col-md-4 col-lg-2 col-sm-5 col-4">
						<ul class="search-cart-wrapper d-flex">
							<li class="search-tigger"><a href="javascript:void(0);"><i class="flaticon-search"></i></a></li>
							<li>
								<a href="javascript:void(0);"><i class="flaticon-like"></i>
								@if(wishlistCount()!=0)
								<span>
									{{wishlistCount()}}
								</span>
								@endif
								</a>
								<ul class="cart-wrap dropdown_style">
									@php $subtotal_1 = 0; @endphp
									@foreach(wishlistProducts() as $wishlist)
									<li class="cart-items">
										<div class="cart-img">
											<img src="{{asset('uploads/products')}}/{{$wishlist->productTable->product_image}}" alt=""  width="50">
										</div>
										<div class="cart-content">
											<a href="cart.html">{{$wishlist->productTable->product_name}}</a>
											<span>QTY : {{$wishlist->quantity}}</span>
											<p>Price Tk.{{$wishlist->productTable->product_price}}</p>
											<a href="{{url('delete-wishlist')}}/{{$wishlist->id}}"><i class="fa fa-times"></i></a>
										</div>
									</li>
									@php 
									$subtotal_1 += $wishlist->productTable->product_price * $wishlist->quantity;
									@endphp
									@endforeach
									<li>Subtotol: <span class="pull-right">Tk.{{$subtotal_1}}</span></li>
									<li>
										
										<a href="{{url('wishlist')}}" class="p-0"><button>Check Out</button></a>
									</li>
								</ul>
							</li>
							<li>
								<a href="javascript:void(0);"><i class="flaticon-shop"></i>
								@if(cartCount()!=0)
								<span>
									{{cartCount()}}
								</span>
								@endif
								</a>
								<ul class="cart-wrap dropdown_style">
									@php $subtotal = 0; @endphp
									@foreach(cartProducts() as $cart)
									<li class="cart-items">
										<div class="cart-img">
											<img src="{{asset('uploads/products')}}/{{$cart->productTable->product_image}}" alt="" width="50">
										</div>
										<div class="cart-content">
											<a href="cart.html">{{$cart->productTable->product_name}}</a>
											<span>QTY : {{$cart->quantity}}</span>
											<p>Price Tk.{{$cart->productTable->product_price}}</p>
											<a href="{{url('delete-cart')}}/{{$cart->id}}"><i class="fa fa-times"></i></a>
										</div>
									</li>
									@php
									$subtotal += $cart->productTable->product_price * $cart->quantity;
									@endphp
									@endforeach
									<li>Subtotol: <span class="pull-right">Tk. {{$subtotal}}</span></li>
									<li>
										<a href="{{url('shoping_cart')}}" class="p-0"><button>Check Out</button></a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="col-md-1 col-sm-1 col-2 d-block d-lg-none">
						<div class="responsive-menu-tigger">
							<a href="javascript:void(0);">
						<span class="first"></span>
						<span class="second"></span>
						<span class="third"></span>
						</a>
						</div>
					</div>
				</div>
			</div>
			<!-- responsive-menu area start -->
			<div class="responsive-menu-area">
				<div class="container">
					<div class="row">
						<div class="col-12 d-block d-lg-none">
							<ul class="metismenu">
								<li><a href="{{url('/')}}">Home</a></li>
								<li><a href="{{url('/about')}}">About</a></li>
								<li class="sidemenu-items">
									<a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Shop </a>
									<ul aria-expanded="false">
										<li><a href="{{url('shop')}}">Shop Page</a></li>
										<li><a href="single-product.html">Product Details</a></li>
										<li><a href="cart.html">Shopping cart</a></li>
										<li><a href="checkout.html">Checkout</a></li>
										<li><a href="wishlist.html">Wishlist</a></li>
									</ul>
								</li>
								<li class="sidemenu-items">
									<a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Pages </a>
									<ul aria-expanded="false">
									  <li><a href="about.html">About Page</a></li>
									  <li><a href="single-product.html">Product Details</a></li>
									  <li><a href="cart.html">Shopping cart</a></li>
									  <li><a href="checkout.html">Checkout</a></li>
									  <li><a href="wishlist.html">Wishlist</a></li>
									  <li><a href="faq.html">FAQ</a></li>
									</ul>
								</li>
								<li class="sidemenu-items">
									<a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Blog</a>
									<ul aria-expanded="false">
										<li><a href="blog.html">Blog</a></li>
										<li><a href="blog-details.html">Blog Details</a></li>
									</ul>
								</li>
								<li><a href="{{url('/contact')}}">Contact</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- responsive-menu area start -->
		</div>
	</header>
	<!-- header-area end -->

	<!-- content-area start -->
	@yield('content')
	<!-- content-area end -->

	<!-- start social-newsletter-section -->
	<section class="social-newsletter-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="newsletter text-center">
						<h3>Subscribe  Newsletter</h3>
						<div class="newsletter-form">
							<form>
								<input type="text" class="form-control" placeholder="Enter Your Email Address...">
								<button type="submit"><i class="fa fa-send"></i></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end container -->
	</section>
	<!-- end social-newsletter-section -->

	<!-- .footer-area start -->
	<div class="footer-area">
		<div class="footer-top">
			<div class="container">
				<div class="footer-top-item">
					<div class="row">
						<div class="col-lg-12 col-12">
							<div class="footer-top-text text-center">
								<ul>
									<li><a href="{{url('/')}}">home</a></li>
									<li><a href="{{url('/about')}}">About</a></li>
									<li><a href="{{url('/shop')}}">Shop</a></li>
									<li><a href="{{url('/blog-page')}}">Blog</a></li>
									<li><a href="{{url('/contact')}}">Contact</a></li>
									<li><a href="{{url('/api-movies')}}">Entertainment</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 col-md-3 col-sm-12">
						<div class="footer-icon">
							<ul class="d-flex">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-4 col-md-8 col-sm-12">
						<div class="footer-content">
							<p>Please, contact us for more detailes about Web Development, our services and ordering a dinamic website </p>
						</div>
					</div>
					<div class="col-lg-3 col-md-8 col-sm-12">
						<div class="footer-adress">
							<ul>
								<li><a href="#"><span>Email:</span> aftab2060@gmail.com</a></li>
								<li><a href="#"><span>Tel:</span> +8801720390878</a></li>
								<li><a href="#"><span>Adress:</span> Dhaka, Bangladesh</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-4 col-sm-12">
						<div class="footer-reserved">
							<ul>
								<li>Copyright © 2019 Paravel All rights reserved.</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- .footer-area end -->

	<!-- jquery latest version -->
		<script src="{{asset('frontend_assets')}}/js/vendor/jquery-2.2.4.min.js"></script>
		<!-- bootstrap js -->
		<script src="{{asset('frontend_assets')}}/js/bootstrap.min.js"></script>
		<!-- owl.carousel.2.0.0-beta.2.4 css -->
		<script src="{{asset('frontend_assets')}}/js/owl.carousel.min.js"></script>
		<!-- scrollup.js -->
		<script src="{{asset('frontend_assets')}}/js/scrollup.js"></script>
		<!-- isotope.pkgd.min.js -->
		<script src="{{asset('frontend_assets')}}/js/isotope.pkgd.min.js"></script>
		<!-- imagesloaded.pkgd.min.js -->
		<script src="{{asset('frontend_assets')}}/js/imagesloaded.pkgd.min.js"></script>
		<!-- jquery.zoom.min.js -->
		<script src="{{asset('frontend_assets')}}/js/jquery.zoom.min.js"></script>
		<!-- countdown.js -->
		<script src="{{asset('frontend_assets')}}/js/countdown.js"></script>
		<!-- swiper.min.js -->
		<script src="{{asset('frontend_assets')}}/js/swiper.min.js"></script>
		<!-- metisMenu.min.js -->
		<script src="{{asset('frontend_assets')}}/js/metisMenu.min.js"></script>
		<!-- mailchimp.js -->
		<script src="{{asset('frontend_assets')}}/js/mailchimp.js"></script>
		<!-- jquery-ui.min.js -->
		<script src="{{asset('frontend_assets')}}/js/jquery-ui.min.js"></script>
		<!-- main js -->
		<script src="{{asset('frontend_assets')}}/js/scripts.js"></script>
		<!-- my code js -->
		@yield('body_script')

</body>

</html>
