<?php

function cartCount(){
  return App\Cart::where('ip_address', request()->ip())->count();
}

function cartProducts(){
  return App\Cart::where('ip_address', request()->ip())->get();
}

function wishlistCount(){
  return App\Wishlist::where('ip_address', request()->ip())->count();
}

function wishlistProducts(){
  return App\Wishlist::where('ip_address', request()->ip())->get();
}


function reviewAverage($product_id){
  $review_star = App\OrderList::where('product_id',$product_id)->whereNotNull('star')->sum('star');
  $review_count = App\OrderList::where('product_id',$product_id)->whereNotNull('review')->count();
  if($review_count == 0){
    return 0;
  } else{
    return $review_star / $review_count;
  }
}


?>
