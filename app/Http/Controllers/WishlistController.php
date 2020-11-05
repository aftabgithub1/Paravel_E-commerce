<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wishlist;
use App\Cart;
use App\Product;
use Carbon\Carbon;

class WishlistController extends Controller
{
    public function wishlist(Request $request){
        $wishlist_items = Wishlist::where('ip_address', $request->ip())->get();
        return view('frontend.wishlist', compact('wishlist_items'));
    }
    public function addToWishlist(Request $request){
        $product = Product::find($request->product_id);
        if($product->product_quantity > 0){
            if(Wishlist::where('product_id', $request->product_id)->exists() == false){
                Wishlist::insert([
                    'ip_address'=>$request->ip(),
                    'product_id'=>$request->product_id,
                    'created_at'=>Carbon::now(),
                    ]);
                return back();
            } else {
                return back()->with('product_alert', $product->product_name.' already added to wishlist!');
            }
        } else {
            return back()->with('product_alert', $product->product_name.' are out of stock!');
        }
    }
    public function wishlistToCart(Request $request){
        
        if(Cart::where('product_id', $request->product_id)->exists() == false){
            Cart::insert([
                'ip_address'=>$request->ip(),
                'product_id'=>$request->product_id,
                'quantity'=>$request->quantity,
                'created_at'=>Carbon::now(),
            ]);
            Wishlist::where('product_id', $request->product_id)->delete();
            return back();
        } else {
            $product = Product::find($request->product_id);
            return back()->with('wishlist_alert', $product->product_name.' already added to Cart!');
        }
    }
    public function deleteWishlist($wishlist_id){
        Wishlist::find($wishlist_id)->delete();
        return back();
    }
}
