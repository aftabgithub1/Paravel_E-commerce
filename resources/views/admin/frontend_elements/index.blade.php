@extends('layouts.dashboard')

@section('page_title')
Frontend Elements
@endsection

@section('frontend_elements')
active
@endsection

@section('breadcrumb')
<a class="breadcrumb-item" href="{{url('admin-dashboard')}}">Home</a>
<a class="breadcrumb-item" href="#">Frontend Elements</a>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
      <!-- form starts -->
		<div class="col-lg-10">
			<div class="card mb-4">
            <div class="card-header"><h5>Add Banner Elements</h5></div>
            <div class="card-body">
               <form action="{{route('frontend-elements.store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-row">
                     <div class="col-6 mb-2">
                        <input type="text" name="banner_title" placeholder="Title" tabindex="1" class="form-control @error('banner_title') is-invalid @enderror">
                        @error('banner_title') <span class="text-danger">{{$message}}</span> @enderror
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="col-6">
                        <textarea name="banner_desp" placeholder="Description" id="" rows="4" tabindex="2" class="form-control mb-2 @error('banner_desp') is-invalid @enderror"></textarea>
                        @error('banner_desp') <span class="text-danger">{{$message}}</span> @enderror
                     </div>
                     <div class="col-6">
                        <input class="mt-1 mb-2 ml-2" type="file" name="banner_image" tabindex="3">
                        <input class="form-control w-25 mt-2 ml-2 bg-info text-light" type="submit" value="Submit" tabindex="4">
                     </div>
                  </div>
               </form>
            </div>
         </div>
		</div>
   </div>
      <!-- form ends -->

   <div class="row justify-content-center">
      <!-- table ends -->
		<div class="col-lg-10">
			<div class="card mb-4">
            <div class="card-header"><h5>Banner Elements</h5></div>
            <div class="card-body">
               <table class="table">
                  <thead>
                     <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Button Caption</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($banner_elements as $banner_element)
                     <tr>
                        <td><img src="{{asset('uploads/banners')}}/{{$banner_element->banner_image}}" width="80" alt="Banner_imege"></td>
                        <td>{{$banner_element->banner_title}}</td>
                        <td>{{substr($banner_element->banner_desp, 0, 30)}}...</td>
                        <td>{{$banner_element->banner_btn}}</td>
                        <td>
                           <div class="button-group float-right">
                              <button class="btn btn-sm btn-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon ion-gear-a"></i></button>
                              <div class="dropdown-menu dropdown-menu-right">
                                 <a href="" class="dropdown-item">Edit</a>
                                 <a href="" class="dropdown-item">Delete</a>
                              </div>
                           </div>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
		</div>
      <!-- table ends -->
	</div>
</div>

<!-- Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odio tempora asperiores animi soluta modi ex illum mollitia labore molestias libero! -->

@endsection
