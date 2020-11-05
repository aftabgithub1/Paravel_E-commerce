<?php

namespace App\Http\Controllers;

use App\Product;
use App\Product_multiple_photo;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use Carbon\Carbon;


class ProductController extends Controller
{
		/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth')->except(['show']);
		$this->middleware('verified')->except(['show']);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$products = Product::paginate(10);
		$categories = Category::all();
		return view('admin.product.index', compact('products', 'categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$request->validate([
			'category_id' => 'required',
			'product_name' => 'required',
			'product_price' => 'required',
			'product_short_desp' => 'required',
		]);

		$product_slug = Str::slug($request->product_name.'-'.Carbon::now()->timestamp);
		$product_id = Product::insertGetId([
			'category_id' => $request->category_id,
			'product_name' => $request->product_name,
			'product_price' => $request->product_price,
			'product_short_desp' => $request->product_short_desp,
			'product_long_desp' => $request->product_long_desp,
			'product_slug' => $product_slug,
			'product_quantity' => $request->product_quantity,
			'created_at' => Carbon::now()
		]);

		/*
			# Image upload functions
			$request->hasFile('field_name');
			$request->file('field_name');
			base_path("url"); [from root folder]
			public_path("url"); [from puvlic folder]

		*/

		if ($request->hasFile('product_image')){
			$product_image_file = $request->file('product_image');
			$product_image_name = $product_id.'.'.$product_image_file->extension();
			$product_image_location = base_path('public/uploads/products/'.$product_image_name);
			Image::make($product_image_file)->resize(540, 540)->save($product_image_location);
			Product::find($product_id)->update([
				'product_image' => $product_image_name
			]);
		}
		if ($request->hasFile('product_multiple_image')){
			$product_multiple_image_file = $request->file('product_multiple_image');
			$flag = 1;
			foreach($product_multiple_image_file as $product_single_image_file){
				$product_single_image_name = $product_id.'-'.$flag.'.'.$product_single_image_file->extension();
				$product_multiple_image_location = base_path('public/uploads/products/product_details/'.$product_single_image_name);
				Image::make($product_single_image_file)->resize(540, 540)->save($product_multiple_image_location);

				Product_multiple_photo::insert([
					'product_id' => $product_id,
					'product_multiple_photo_name' => $product_single_image_name,
					'created_at' => Carbon::now()
				]);
				$flag++;
			}
		}

		return back()->with('add_product_form_alert', 'Product Added Successfully!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function show($slug)
	{
		$product_details = Product::where('product_slug', $slug)->first();
		$related_products = Product::where('category_id', $product_details->category_id)->get();
		return view('frontend.product-details', compact('product_details', 'related_products'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Product $product)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Product $product)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Product $product)
	{
		//
	}
}
