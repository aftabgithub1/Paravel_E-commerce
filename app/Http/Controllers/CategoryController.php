<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Auth;
use Image;

class CategoryController extends Controller
{

		/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('verified');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$categories = Category::paginate(10);
		return view('/admin.category.index', compact('categories'));
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
			'category_name'=>'required|unique:categories',
			'category_image'=>'file|mimes:jpg,jpeg,bmp,png|max:200',
		]);
		
		/* $new_category = Category::insert([
				'category_name' => $request->category_name,
				'added_by' => Auth::id(),
				'created_at' => now(),
			]);
			print_r($category_row);
			die();
			return back()->with('alert', 'Category added successfully!');
		*/

		$new_category = Category::create([
			'category_name' => $request->category_name,
			'added_by' => Auth::id(),
			'created_at' => now(),
		]);

		// Start Image Upload
			// Check if image file is is uploaded
			if ($request->hasFile('category_image')){
				$image_file = $request->file('category_image');
				$new_image_name = $new_category->id.'.'.$image_file->extension();
				$file_location = base_path('public/uploads/category/'.$new_image_name);
				// Save in public/uploads folder
				Image::make($image_file)->resize(300, null, function($constraint){$constraint->aspectRatio();})->save($file_location);
				// Save name in database in Database
				Category::find($new_category->id)->update([
					'category_image' => $new_image_name,
					]);
			}
		// Start Image Upload

			return back()->with('alert' , 'Category added successfully!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function show(Category $category)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Category $category)
	{
		return view('/admin.category.edit', compact('category'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Category $category)
	{
		$request->all();
		$category->category_name = $request->category_name;
		$category->save();

		// Start Image Update
			if ($request->hasFile('category_image')){

				// Delete old image file without deleting default file
				if ($category->category_image != 'category_default_image.jpg'){
					$file_location = base_path('public/uploads/category/'.$category->category_image);
					unlink($file_location);
				}
					
				// Upload new Image
				$image_file = $request->file('category_image');
				$new_image_name = $category->id.'.'.$image_file->extension();
				$file_location = base_path('public/uploads/category/'.$new_image_name);
				Image::make($image_file)->save($file_location);
				Category::find($category->id)->update([
					'category_image' => $new_image_name,
				]);
			}
		// End Image Update

		return back()->with('edit_category_alert', "Category Updated Successfully!");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Category  $category
	 * @return \Illuminate\Http\Response
	 */

	public function categoryDelete($ctg_id)	{
		Category::find($ctg_id)->delete();
		return back()->with('category_table_alert', "Send to Trash Successfully!");
	}


	public function destroy(Category $category)
	{
		//
	}

}
