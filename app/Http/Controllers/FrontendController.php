<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use App\Mail\MailtrapExample;
use Illuminate\Support\Facades\Mail;
use Auth;
use App\User;
use App\Category;
use App\Product;
use App\Faq;
use App\OrderList;
use App\Blog;
use App\Blog_comment;
use Carbon\Carbon;

class FrontendController extends Controller
{


    public function Home(){
        $categories = Category::all();
        $products = Product::all();
        $product_count = Product::count();
        $best_sellers = OrderList::groupBy('product_id')
            ->selectRaw('sum(quantity) as sum')
            ->selectRaw('product_id')
            ->orderBy('sum', 'desc')
            ->get();
        return view('frontend.index', compact('categories', 'products', 'product_count','best_sellers'));
    }

    public function contact(){
        return view('frontend.contact');
    }
    public function about(){
        return view('frontend.about');
    }
    public function faq(){
        $faqs = Faq::paginate(3);
        return view('frontend.faq', compact('faqs'));
    }
    public function shop(){
        $products = Product::all();
        $categories = Category::all();
        return view('frontend.shop', compact('products', 'categories'));
    }

    public function addReview(Request $request){
        OrderList::where('user_id', Auth::id())->where('product_id', $request->product_id)->whereNull('review')->first()->update([
            'review' => $request->review,
            'star' => $request->star,
        ]);
        return back()->with('review_alert','Product review Successful!');
    }

    public function blogPage(){
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(6);
        return view('frontend.blog', compact('blogs'));
    }

    public function blogDetails($blog_id){
        $blog = Blog::find($blog_id);
        $blog_comment_count = Blog_comment::where('blog_id',$blog->id)->count();
        $blog_comments = Blog_comment::where('blog_id', $blog->id)->get();
        $recent_blogs = Blog::orderBy('created_at', 'desc')->get();
        return view('frontend.blog_details', compact('blog', 'blog_comments','blog_comment_count', 'recent_blogs'));
    }
    
    public function blogCommentPost(Request $request){
        if(Auth::user()->id == true){
            Blog_comment::insert([
                'blog_id' => $request->blog_id,
                'user_id' => Auth::user()->id,
                'email' => Auth::user()->email,
                'comment' => $request->comment,
                'created_at' => Carbon::now()
            ]);
            return back();
        } 
    }
    

    public function search(){
        $search_products = QueryBuilder::for(Product::class)->allowedFilters('category_id','product_name')->get();
        if($_GET['sort_price'] == 1){
            $searched = $search_products->sortBy('product_price');
        } else{
            $searched = $search_products->sortByDesc('product_price');
        }
        return view('frontend.search', compact('searched'));
        
    }

    public function sendEmail(){
        Mail::to('aftab2060@gmail.com')->send(new MailtrapExample());
        return back()->with('email_alert', 'A message has been sent to Mailtrap');
    }

}
