<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderList;
use App\Product;
use App\Cart;
use App\Country;
use App\City;
use Auth;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function checkout(Request $request){
        $cart_total = $request->cart_total;
        $countries = Country::all();
        return view('frontend.checkout', compact('cart_total', 'countries'));
    }

    public function getCityList(Request $request){
        $city_list = '';
        $cities = City::where('country_id', $request->country_id)->get();
        foreach($cities as $city){
            $city_list .= '<option value="'.$city->id.'">'.$city->city_name.'</option>';
        }
        echo $city_list;
    }

    public function checkoutPost(Request $request){
        if($request->payment_method==1){
            return view('frontend.stripe', [
                'fname' => $request->fname,
                'email' => $request->email,
                'phone' => $request->phone,
                'country_id' => $request->country_id,
                'city_id' => $request->city_id,
                'address' => $request->address,
                'note' => $request->note,
                'subtotal' => $request->subtotal,
                'total' => $request->total,
                'payment_method' => $request->payment_method,
            ]);
        } else{
            $order_id = Order::insertGetId($request->except('_token') + [
                'user_id' => Auth::id(),
                'created_at' => Carbon::now(),
            ]);
    
            foreach(cartProducts() as $cart_product){
                OrderList::insert([
                    'user_id' => Auth::id(),
                    'order_id' => $order_id,
                    'product_id' => $cart_product->product_id,
                    'quantity' => $cart_product->quantity,
                    'created_at' => Carbon::now()
                ]);
                Product::find($cart_product->product_id)->decrement('product_quantity', $cart_product->quantity);
                Cart::find($cart_product->id)->delete();
            }
                return redirect('shoping_cart');
        }
    }
}
