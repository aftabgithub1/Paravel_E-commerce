<?php

namespace App\Http\Controllers;

use App\FrontendElement;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Image;

class FrontendElementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner_elements = FrontendElement::paginate(10);
        return view('admin.frontend_elements.index', compact('banner_elements'));
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
            'banner_title'=>'required',
            'banner_desp'=>'required',
        ]);
        
        $Banner_id = FrontendElement::insertGetId([
            'banner_title'=>$request->banner_title,
            'banner_desp'=>$request->banner_desp,
            'created_at'=>Carbon::now(),
        ]);

        if($request->hasFile('banner_image')){
            $image_file = $request->file('banner_image');
            $file_name = $Banner_id.'.'.$image_file->extension();
            $location = public_path("uploads/banners/$file_name");
            Image::make($image_file)
                ->resize(1920, 1000, function($constraint){$constraint->aspectRatio();})
                ->save($location);
            FrontendElement::find($Banner_id)->update(['banner_image'=>$file_name]);
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FrontendElement  $frontendElement
     * @return \Illuminate\Http\Response
     */
    public function show(FrontendElement $frontendElement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FrontendElement  $frontendElement
     * @return \Illuminate\Http\Response
     */
    public function edit(FrontendElement $frontendElement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FrontendElement  $frontendElement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FrontendElement $frontendElement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FrontendElement  $frontendElement
     * @return \Illuminate\Http\Response
     */
    public function destroy(FrontendElement $frontendElement)
    {
        //
    }
}
