<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\Coupon; 
use Carbon\Carbon;

class CartController extends Controller
{
    public function addToCart(Request $request){
        $product = Product::find($request->product_id);
        if($product->product_quantity > 0){
            if (Cart::where('ip_address', $request->ip())->where('product_id', $request->product_id)->exists()){
                Cart::where('ip_address', $request->ip())->where('product_id', $request->product_id)
                ->increment('quantity', $request->quantity);
            } else {
                Cart::insert([
                    'ip_address'=>$request->ip(),
                    'product_id'=>$request->product_id,
                    'quantity'=>$request->quantity,
                    'created_at'=>Carbon::now(),
                ]);
            }
            return back();
        } else {
            return back()->with('product_details_allert', 'This product is out of stock!');
        }
    }

    public function addToCartSingle(Request $request){
        $product = Product::find($request->product_id);
        if($product->product_quantity > 0){
            if(Cart::where('product_id', $request->product_id)->exists() == false){
                Cart::insert([
                    'ip_address'=>$request->ip(),
                    'product_id'=>$request->product_id,
                    'quantity'=>$request->quantity,
                    'created_at'=>Carbon::now(),
                    ]);
                return back();
            } else {
                return back()->with('product_alert', $product->product_name.' already added to cart!');
            }
        } else {
            return back()->with('product_alert', $product->product_name.' are out of stock!');
        }
    }

    public function deleteCart($cart_id){
        Cart::find($cart_id)->delete();
        return back();
    }

    public function shopingCart($coupon_name = ''){

        if($coupon_name){
            if(Coupon::where('coupon_name', $coupon_name)->first()){
                if(Coupon::where('coupon_name', $coupon_name)->first()->validity_date >= Carbon::now()->format('Y-m-d')){
                    $coupon_discounts = Coupon::where('coupon_name', $coupon_name)->first()->coupon_discount;
                    return view('frontend.shoping_cart', compact('coupon_discounts'));
                } else{
                    return back()->with('shopping_cart_allert', 'The coupon has expired!');
                };
    
            } else{
                return back()->with('shopping_cart_allert', 'Invalid coupon code!');
            };
        } else{
            return view('frontend.shoping_cart');
        }
    }

    public function updateCart(Request $request){

        foreach($request->cart_id as $key => $cart_id){
            Cart::find($cart_id)->update([
                'quantity' => $request->cart_quantity[$key]
            ]);
        }
        return back()->with('shopping_cart_allert', 'Shopping Cart Updated Successfully!');
    }
}
