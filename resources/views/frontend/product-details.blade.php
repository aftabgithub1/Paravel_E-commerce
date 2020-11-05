@extends('layouts.frontend-layout')

@section('frontend_page_title')
Product Details
@endsection

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
	<!-- single-product-area start-->
	<div class="single-product-area ptb-100">
		<div class="container">
			<div class="row">
				
				@if (session('product_details_allert'))
				<div class="col-lg-12 alert alert-warning alert-dismissible fade show" role="alert">
					<strong>{{session('product_details_allert')}}</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				@endif

				@if (session('review_alert'))
				<div class="col-lg-12 alert alert-warning alert-dismissible fade show" role="alert">
					<strong>{{ session('review_alert') }}</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				@endif
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="product-single-img">
						<div class="product-active owl-carousel">
							<div class="item">
								<img src="{{asset('uploads/products')}}/{{$product_details->product_image}}" alt="">
							</div>
							@foreach($product_details->multiplePhotosTable as $multiple_photo)
							<div class="item">
								<img src="{{asset('uploads/products/product_details')}}/{{$multiple_photo->product_multiple_photo_name}}" alt="">
							</div>
							@endforeach
						</div>
						<div class="product-thumbnil-active  owl-carousel">
							<div class="item">
								<img src="{{asset('uploads/products')}}/{{$product_details->product_image}}" alt="">
							</div>
							@foreach($product_details->multiplePhotosTable as $multiple_photo)
							<div class="item">
								<img src="{{asset('uploads/products/product_details')}}/{{$multiple_photo->product_multiple_photo_name}}" alt="">
							</div>
							@endforeach
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="product-single-content">
						<h3>{{$product_details->product_name}}</h3>
						<div class="rating-wrap fix">
							<span class="pull-left">Tk. {{$product_details->product_price}}</span>
							<span class="rating pull-right">
								@component('frontend.frontend-includes.review_stars', ['product_id' => $product_details->id])
								@endcomponent
								<span>({{App\OrderList::where('product_id',$product_details->id)->whereNotNull('review')->count()}} Customar Review)
								</span>
							</span>
						</div>
						<p>{{$product_details->product_short_desp}}</p>
						<ul class="input-style">
							<form action="{{url('add-to-cart')}}" method="post">
								@csrf
								<input type="hidden" name="product_id" value="{{$product_details->id}}">
								<li class="quantity cart-plus-minus mr-1">
									<input type="text" value="1" name="quantity" />
								</li>
								<li><input type="submit" class="btn btn-danger rounded-0" value="Add to Cart"></li>
							</form>
						</ul>
						<ul class="cetagory">
							<li>Categories:</li>
							<li><a href="#"> {{$product_details->categoryTable->category_name}}</a></li>
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
			<div class="row mt-60">
				<div class="col-12">
					<div class="single-product-menu">
						<ul class="nav">
							<li><a class="active" data-toggle="tab" href="#description">Description</a> </li>
							<li><a data-toggle="tab" href="#tag">Faq</a></li>
							<li><a data-toggle="tab" href="#review">Review</a></li>
						</ul>
					</div>
				</div>
				<div class="col-12">
					<div class="tab-content">
						<div class="tab-pane active" id="description">
							<div class="description-wrap">
								<p>{{$product_details->product_long_desp}}</p>
							</div>
						</div>
						<div class="tab-pane" id="tag">
							<div class="faq-wrap" id="accordion">
								<div class="card">
									<div class="card-header" id="headingOne">
										<h5><button data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">General Inquiries ?</button> </h5>
									</div>
									<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="headingTwo">
										<h5><button class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">How To Use ?</button></h5>
									</div>
									<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="headingThree">
										<h5><button class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Shipping & Delivery ?</button></h5>
									</div>
									<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="headingfour">
										<h5><button class="collapsed" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">Additional Information ?</button></h5>
									</div>
									<div id="collapsefour" class="collapse" aria-labelledby="headingfour" data-parent="#accordion">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="headingfive">
										<h5><button class="collapsed" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">Return Policy ?</button></h5>
									</div>
									<div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordion">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="review">
							<div class="review-wrap">
								<ul>
									@foreach(App\OrderList::where('product_id',$product_details->id)->whereNotNull('review')->get() as $review)
									<li class="review-items">
										<div class="review-img">
											<img src="assets/images/comment/1.png" alt="">
										</div>
										<div class="review-content">
											<h3><a href="#">{{App\User::find($review->user_id)->name}}</a></h3>
											<span>{{$review->updated_at->format('d M Y h:i:sa')}}</span>
											<p>{{$review->review}}</p>
											<ul class="rating d-flex">
												@if($review->star == 0)
												<li class="text-danger">Not reviewed</li>
												@elseif($review->star == 1)
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star-o"></i></li>
												<li><i class="fa fa-star-o"></i></li>
												<li><i class="fa fa-star-o"></i></li>
												<li><i class="fa fa-star-o"></i></li>
												@elseif($review->star == 2)
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star-o"></i></li>
												<li><i class="fa fa-star-o"></i></li>
												<li><i class="fa fa-star-o"></i></li>
												@elseif($review->star == 3)
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star-o"></i></li>
												<li><i class="fa fa-star-o"></i></li>
												@elseif($review->star == 4)
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star-o"></i></li>
												@else($review->star == 5)
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												@endif
											</ul>
										</div>
									</li>
									@endforeach
								</ul>
							</div>
							<div class="add-review">
								<h4>Add A Review</h4>


								@auth
								@if(App\OrderList::where('user_id',Auth::id())->where('product_id',$product_details->id)->whereNull('review')->exists())
								<form action="{{url('add-review')}}" method="post">
									<div class="ratting-wrap">
										<table>
											<thead>
												<tr>
													<th>task</th>
													<th>1 Star</th>
													<th>2 Star</th>
													<th>3 Star</th>
													<th>4 Star</th>
													<th>5 Star</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>How Many Stars?</td>
													<td>
														<input type="radio" name="star" value='1' />
													</td>
													<td>
														<input type="radio" name="star" value='2' />
													</td>
													<td>
														<input type="radio" name="star" value='3' />
													</td>
													<td>
														<input type="radio" name="star" value='4' />
													</td>
													<td>
														<input type="radio" name="star" value='5' />
													</td>
												</tr>
											</tbody>
										</table>

									</div>
									<div class="row">
										@csrf
										<div class="col-12">
											<h4>Your Review:</h4>
											<input type="hidden" name="product_id" value="{{$product_details->id}}">
											<textarea name="review" id="massage" cols="30" rows="10" placeholder="Your review here..."></textarea>
										</div>
										<div class="col-12">
											<button class="btn-style">Submit</button>
										</div>
									</div>
								</form>
								@else
								<p class="text-danger">This product have allready been reviewed or not been purchased!</p>
								@endif
								@else
								<p class="text-danger">Please ligin first to add a review!</p>
								<a href="{{route('login')}}" class="btn btn-small btn-info">Login</a>
								@endauth
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- single-product-area end-->
	<!-- featured-product-area start -->
	<div class="featured-product-area">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-title text-left">
						<h2>Related Product</h2>
					</div>
				</div>
			</div>
			<div class="row">
				@foreach($related_products as $related_product)
				<div class="col-lg-3 col-sm-6 col-12">
					<div class="featured-product-wrap">
						<div class="featured-product-img">
							<img src="{{asset('uploads/products')}}/{{$related_product->product_image}}" alt="">
						</div>
						<div class="featured-product-content">
							<div class="row">
								<div class="col-7">
									<h3><a href="{{route('product.show',$related_product->product_slug)}}">{{$related_product->product_name}}</a></h3>
									<p>Tk. {{$related_product->product_price}}</p>
								</div>
								<div class="col-5 text-right">
									<ul>
										<li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
										<li><a href="cart.html"><i class="fa fa-heart"></i></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
	<!-- featured-product-area end -->
@endsection