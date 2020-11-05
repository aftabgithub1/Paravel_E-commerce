@extends('layouts.dashboard')

@section('page_title')
Edit Caqtegory
@endsection

@section('category')
active
@endsection

@section('breadcrumb')
<a class="breadcrumb-item" href="{{route('category.index')}}">Category</a>
<a class="breadcrumb-item" href="{{route('category.edit', $category->id)}}">Edit</a>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
      
      <!-- Start FORM -->
      <div class="col-lg-6 m-auto">
        <div class="card">
          <div class="card-header bg-info" style="text-shadow:0px 0px 3px #000;">
            <h5 class="text-white">Edit Category</h5>
          </div>
          <div class="card-body">
          @if (session('edit_category_alert'))
          <div class="alert alert-warning">
            <strong>{{session('edit_category_alert')}}</strong>
          </div>
          @endif

            <form action="{{route('category.update', $category->id)}}" method="post" enctype="multipart/form-data">

              {{method_field('PUT')}}

              @csrf

              <div class="form-group">
                <label for="ctgName">Category Name</label>
                <input type="text" name="category_name" id="ctgName" value="{{$category->category_name}}" class="form-control @error('category_name') is-invalid @enderror">
                @error('category_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="ctgImage">Category Image</label>
                <input type="file" name="category_image" id="ctgImage" class="form-control @error('category_image') is-invalid @enderror">
                @error('category_image')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              
              <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-info w-25">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- End FORM -->

    </div>
</div>
@endsection