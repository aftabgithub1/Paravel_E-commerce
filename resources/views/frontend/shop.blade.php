@extends('layouts.frontend-layout')

@section('frontend_page_title')  Shop  @endsection

@section('shop')  active  @endsection

@section('shop_here')  active  @endsection

@section('content')
	<!-- .breadcumb-area start -->
	<div class="breadcumb-area bg-img-4 ptb-100">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="breadcumb-wrap text-center">
						<h2>Shop Page</h2>
						<ul>
							<li><a href="{{url('/')}}">Home</a></li>
							<li><span>Shop</span></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- .breadcumb-area end -->

	<!-- product-area start -->
	<div class="product-area pt-100">
		<div class="container">

			<!-- tab start -->
			<div class="row">
				<div class="col-sm-12 col-lg-12">
					<div class="product-menu">
						<ul class="nav justify-content-center">
							<li>
								<a class="active" data-toggle="tab" href="#all">All product</a>
							</li>
							@foreach($categories as $category)
							<li>
								<a data-toggle="tab" href="#categoryId{{$category->id}}">{{$category->category_name}}</a>
							</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
			<!-- tab end -->


			<div class="tab-content">
				
				<!-- all products start -->
				<div class="tab-pane active" id="all">
					<ul class="row">
						@php $count = 1 @endphp
						@foreach($products as $product)
						<li class="col-xl-3 col-lg-4 col-sm-6 col-12  {{($count<5)?'':'moreload'}}">
							<div class="product-wrap">
								<div class="product-img">
									<span>Sale</span>
									<img src="{{asset('uploads/products')}}/{{$product->product_image}}" alt="">
									<div class="product-icon flex-style">
										<ul>
											<li><a data-toggle="modal" data-target="#{{$product->id}}" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
											<li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
											<li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a></li>
										</ul>
									</div>
								</div>
								<div class="product-content">
									<h3><a href="{{url('product-slug/'.$product->id.'/'.Str::slug($product->product_name))}}">{{$product->product_name}}</a></h3>
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
						<li class="col-12 text-center">
							<a class="loadmore-btn" href="javascript:void(0);">Load More</a>
						</li>
					</ul>
				</div>
				<!-- all products end -->

				<!-- caregory products start -->
				@foreach($categories as $category)
				<div class="tab-pane" id="categoryId{{$category->id}}">
					<ul class="row">
						@php $count = 1 @endphp
						@foreach($category->productTable as $category_wise_product)
						<li class="col-xl-3 col-lg-4 col-sm-6 col-12  {{($count < 5)?'':'moreload'}}">
							<div class="product-wrap">
								<div class="product-img">
									<span>Sale</span>
									<img src="{{asset('uploads/products')}}/{{$category_wise_product->product_image}}" alt="">
									<div class="product-icon flex-style">
										<ul>
											<li><a data-toggle="modal" data-target="#{{$category_wise_product->id}}" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
											<li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
											<li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a></li>
										</ul>
									</div>
								</div>
								<div class="product-content">
									<h3><a href="{{url('product-slug/'.$category_wise_product->id.'/'.Str::slug($category_wise_product->product_name))}}">{{$category_wise_product->product_name}}</a></h3>
									<p class="pull-left">Tk. {{$category_wise_product->product_price}}

									</p> 
									<div class="pull-right">
									@component('frontend.frontend-includes.review_stars', ['product_id' => $category_wise_product->id])
									@endcomponent
									</div>
								</div>
							</div>
						</li>
						<!-- Modal area start -->
						<div class="modal fade" id="{{$category_wise_product->id}}" tabindex="-1">
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<div class="modal-body d-flex">
										<div class="product-single-img w-50">
											<img src="{{asset('uploads/products')}}/{{$category_wise_product->product_image}}" alt="">
										</div>
										<div class="product-single-content w-50">
											<h3>{{$category_wise_product->product_name}}</h3>
											<div class="rating-wrap fix">
												<span class="pull-left">{{$category_wise_product->price}}</span>
												@component('frontend.frontend-includes.review_stars', ['product_id' => $category_wise_product->id])
												@endcomponent
												<span>({{App\OrderList::where('product_id',$category_wise_product->id)->whereNotNull('review')->count()}} Customar Review)
												</span>  
											</div>
											<p>{{$category_wise_product->product_short_desp}}</p>
											<form action="{{url('add-to-cart')}}" method="post">
												<ul class="input-style">
													@csrf
													<div class="form-group"></div>
													<input type="hidden" name="product_id" value="{{$category_wise_product->id}}">
													<li class="quantity cart-plus-minus mr-1">
														<input type="text" value="1" name="quantity" />
													</li>
													<li><input type="submit" class="btn btn-danger rounded-0" value="Add to Cart"></li>
												</ul>
											</form>
											<ul class="cetagory">
												<li>Categories:</li>
												<li><a href="#">{{$category->category_name}}</a></li>
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
					</ul>
				</div>
				
				@endforeach
				<!-- caregory products end -->

			</div>
		</div>
	</div>
	<!-- product-area end -->
@endsection