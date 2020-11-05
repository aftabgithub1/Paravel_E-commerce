<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderList;
use Carbon\Carbon;
use Auth;
use PDF;

class CustomerController extends Controller
{
    // Customer dashboard
	public function customerDashboard(){
		return view('customers.customer_dashboard');
	}

	// Customer Order list
	public function customerOrder(){
		$customer_orders = Order::where('user_id', Auth::id())->paginate();
		return view('customers.customer_order', compact('customer_orders'));
	}

	// Downloading order PDF file
	public function downloadPdf($order_id){
		$customer_orders = Order::findOrFail($order_id);
		$order_lists = OrderList::where('order_id', $customer_orders->id)->get();


		// 'dompdf' package codes
		$order_pdf = PDF::loadView('customers.downloads.order_pdf', compact('customer_orders', 'order_lists'));
		$file_name = 'ORDER-'.Carbon::now()->format('Ymdhis').'.pdf';
		return $order_pdf->download($file_name); 
	}

	// Sending SMS
	public function sendSms($order_id){
		$customer_orders = Order::findOrFail($order_id);

		// Send sms with 'bulksmsbd.com' site API
		$url = "http://66.45.237.70/api.php";
		$number="$customer_orders->phone";
		$text="Order Id: ".$customer_orders->id.", "."Name: ".$customer_orders->fname.", "."Total Price: Tk.".$customer_orders->total.", (Please, don't call back. It's a random number from bulksmsbd.com for testing purpose)";
		$data= array(
			'username'=>"aftab",
			'password'=>"",
			'number'=>"$number",
			'message'=>"$text"
		);

		$ch = curl_init(); // Initialize cURL
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$smsresult = curl_exec($ch);
		$p = explode("|",$smsresult);
		$sendstatus = $p[0];
		if($sendstatus == 1101){
			return back()->with('order_alert', 'SMS sent successfully!');
		}
	}
}
