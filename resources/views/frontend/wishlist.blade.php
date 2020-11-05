@extends('layouts.frontend-layout')

@section('page_title') Wishlist @endsection

@section('shop') active @endsection

@section('wishlist') active @endsection

@section('content')
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Wishlist</h2>
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><span>Wishlist</span></li>
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
            
		@if (session('wishlist_alert'))
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>{{session('wishlist_alert')}}</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		@endif
		
            <div class="row">
                <div class="col-12">
                    <table class="table-responsive cart-wrap">
                        <thead>
                            <tr>
                                <th class="images">Image</th>
                                <th class="product">Product</th>
                                <th class="ptice">Price</th>
                                <th class="stock">Stock Stutus </th>
                                <th class="addcart">Add to Cart</th>
                                <th class="remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($wishlist_items as $wishlist_item)
                            <tr>
                                <td class="images"><img src="{{asset('uploads/products')}}/{{$wishlist_item->productTable->product_image}}" alt=""></td>
                                <td class="product"><a href="single-product.html">{{$wishlist_item->productTable->product_name}}</a></td>
                                <td class="ptice">Tk.{{$wishlist_item->productTable->product_price}}</td>
                                <td class="stock">Avilable</td>
                                <td class="addcart">
                                    <form action="{{url('wishlist-to-cart')}}" method="post">
                                    @csrf
                                        <input type="number" name="wishlist_id" value="{{$wishlist_item->id}}" hidden>
                                        <input type="text" name="ip_address" value="{{$wishlist_item->ip_address}}" hidden>
                                        <input type="number" name="product_id" value="{{$wishlist_item->product_id}}" hidden>
                                        <input type="number" name="quantity" value="{{$wishlist_item->quantity}}" hidden>
                                        <input type="submit" class="btn btn-sm btn-lg btn-danger rounded-0" value="Add to Cart">
                                    </form>
                                </td>
                                <td class="remove"><a href="{{url('delete-wishlist')}}/{{$wishlist_item->id}}"><i class="fa fa-times"></i></a></td>
                            </tr>
                            @empty
                                <tr><h3><strong class="text-danger">No Items</strong></h3></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end --> 
@endsection