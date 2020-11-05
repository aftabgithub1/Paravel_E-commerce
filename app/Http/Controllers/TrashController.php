<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Faq;
use App\Category;

class TrashController extends Controller
{
    // user

    public function userTrash(){
		$users_trash = User::onlyTrashed()->paginate(10);
		return view('trash.user-trash', compact('users_trash'));
	}
	public function userRestore($user_id){
		User::withTrashed()->where('id', $user_id)->restore();
		return back()->with('user_trash_alert', 'User Restored Successfully!');
	}
	public function userForceDelete($user_id){
		User::withTrashed()->where('id', $user_id)->forceDelete();
		return back()->with('user_trash_alert', 'User Deleted Permanently!');
	}


    // faq

	public function faqTrash(){
		$faqs_trash = Faq::onlyTrashed()->paginate(10);
		return view('/trash.faq-trash', compact('faqs_trash'));
	}
	public function faqRestore($faqs_id){
		Faq::withTrashed()->where('id', $faqs_id)->restore();
		return back()->with('faqRestoreAlert', 'FAQ Restored Successfully!');
	}
	public function faqForceDelete($faqs_id){
		Faq::withTrashed()->where('id', $faqs_id)->forceDelete();
		return back()->with('faqRestoreAlert', 'FAQ Deleted Permanently!');
    }
    

    // categoy

	public function categoryTrash()	{
		$categories = Category::onlyTrashed()->paginate(10);
		return view('trash.category-trash', compact('categories'));
	}

	public function categoryRestore($ctg_id){
		Category::withTrashed()->where('id', $ctg_id)->restore();
		return back()->with('category_trash_alert', 'Category Restored Successfully!');
	}

	public function categoryForceDelete($ctg_id){
		Category::withTrashed()->where('id', $ctg_id)->forceDelete();
		return back()->with('category_trash_alert', 'Category Deleted Permanently!');
	}
}
