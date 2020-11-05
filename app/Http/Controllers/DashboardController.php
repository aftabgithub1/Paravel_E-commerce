<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FaqFormPost;
use App\Http\Requests\EditProfilePost;
use App\Http\Requests\UserEditPost;
use App\Mail\PassChangeConfirm;
use App\Faq;
use App\User;
use App\Category;
use App\Product;
use App\Cart;
use App\Coupon;
use App\Order;
use Carbon\Carbon;
use Auth;
use Hash;
use Mail;


class DashboardController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('verified');
		$this->middleware('auth');
		$this->middleware('role');
	}

	
	public function adminDashboard(){
		$total_user = User::count();
		$total_category = Category::count();
		$total_product = Product::count();
		$total_cart = Cart::count();
		$todays_sale = Order::whereDate('created_at', Carbon::now())->sum('total');
		$yesterday_sale = Order::whereDate('created_at', Carbon::yesterday())->sum('total');
		$day_before_yesterday = Order::whereDate('created_at', Carbon::now()->subDays(2))->sum('total');
		$last_week = Order::whereDate('created_at', '>=', Carbon::today()->subDays(7))->sum('total');
		return view('/admin.admin_dashboard', compact('total_user', 'total_category', 'total_product', 'total_cart','todays_sale','yesterday_sale','day_before_yesterday','last_week'));
	}
	


	// All USERS Method
	
	// admin pannel
	public function users(){
		$logged_user = Auth::user();
		$users = User::where('id', '!=', $logged_user->id)->orderBy('id', 'asc')->paginate(10);
		$total_user = User::count();
		return view('/admin.users.users', compact('logged_user', 'users', 'total_user'));
	}
	public function userEdit($user_id){
		$user_edit = User::find($user_id);
		return view('/admin.users.user-edit', compact('user_edit'));
	}
	public function userEditPost(UserEditPost $request){
		User::where('id', $request->user_id)->update([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password)
		]);
		return back()->with('user_edit_alert', 'User Updated Successfully!');
	}
	public function userDelete($user_id){
		User::find($user_id)->delete();
		return back()->with('user_table_alert', 'User Deleted Successfully!');
	}

	public function editprofile(){
		return view('/admin.users.editprofile'); 
	}
	public function editprofilepost(EditProfilePost $request){
		$old_password = $request->old_password;
		$db_password = Auth::user()->password;
		if (Hash::check($old_password, $db_password)){
			User::find(Auth::id())->update([
				'password'=> Hash::make($request->password)
			]);
			Mail::to(Auth::user()->email)->send(new PassChangeConfirm());
			return back()->with('passChangeAlert', 'Password Changed Successfully!');
		} else {
			return back()->with('passChangeAlert', "Old Password didn't match!");
		}
	}


	// All FAQ Method

	public function addfaqpost(FaqFormPost $request){
		// Faq::insert([
		// 	'faq_question'=>$request->faq_question,
		// 	'faq_answer'=>$request->faq_answer,
		// 	'created_at'=>Carbon::now()
		// ]);
		// print_r($request->except('_token'));
		Faq::insert($request->except('_token') + ['created_at'=>Carbon::now()]);
		return back()->with('alert', 'FAQ added successfully!');
	}
	public function addfaq(){
		$faqs = Faq::paginate(10);
		return view('admin.faqs.addfaq', compact('faqs'));
	}
	public function faqdelete($faqs_id){
		Faq::find($faqs_id)->delete();
		return back()->with('faqdelete', 'FAQ Trashed Successfully!');
	}
	public function faqedit($faqs_id){
		$edit_faq = Faq::find($faqs_id);
		return view('admin.faqs.editfaq', compact('edit_faq'));
	}
	public function editFaqPost(FaqFormPost $request){
		Faq::find($request->faq_id)->update([
			'faq_question'=>$request->faq_question,
			'faq_answer'=>$request->faq_answer
		]);
	return back()->with('editFaqAlert', 'FAQ Updated Successfully!');
	}
} 
