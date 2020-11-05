@extends('layouts.dashboard')

@section('page_title')
Caqtegory
@endsection

@section('category')
active
@endsection

@section('breadcrumb')
<a class="breadcrumb-item" href="{{route('category.index')}}">Category</a>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">

      <!-- Start TABLE -->
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header bg-info" style="text-shadow:0px 0px 3px #000;">
            <h5 class="text-white">Categories</h5>
          </div>
          <div class="card-body">    <!-- overflow-auto -->
          @if (session('category_table_alert'))
          <div class="alert alert-warning">
            <strong>{{session('category_table_alert')}}</strong>
          </div>
          @endif
            <table class="table">    <!-- text-nowrap -->
              <thead class="thead-light">
                <tr>
                  <th>Category Name</th>
                  <th>Added By</th>
                  <th>Category Photo</th>
                  <th>Created at</th>
                  <th>Date modified</th>
                  <th><span class="float-right">Action</span></th>
                </tr>
              </thead>
              <tbody>
              @forelse($categories as $category)
                <tr>
                  <td>{{$category->category_name}}</td>
                  <td>{{$category->UserTable->name}}</td>  <!-- Foreign Key -->
                  <td><img src="{{asset('uploads/category/')}}/{{$category->category_image}}" alt="" height="50"></td>
                  <td>
                    @if (isset($category->created_at))
                      {{$category->created_at->format('d/m/y h:i A')}}
                    @else
                      -
                    @endif
                  </td>
                  <td>
                    @if (isset($category->updated_at))
                      {{$category->updated_at->diffForHumans()}}
                    @else
                    -
                    @endif
                  </td>
                  <td>
                    <div class="btn-group float-right">
                      <button type="button" class="btn btn-sm btn-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon ion-more"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{url('category.view-category')}}/{{$category->id}}" class="dropdown-item" type="button">View</a>
                        <a href="{{route('category.edit', $category->id)}}" class="dropdown-item" type="button">Edit</a>
                        <a href="{{url('categorydelete')}}/{{$category->id}}" class="dropdown-item" type="button">Delete</a>
                      </div>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan=5 class="text-center text-danger"><h3>No data available</h3></td>
                </tr>
              @endforelse
              </tbody>
            </table>
            <div class="row">
              <div class="col-md-12">{{$categories->links()}}</div>
            </div>
            <a href="{{ url('categorytrash') }}">See Trash</a>
          </div>
        </div>
      </div>
      <!-- End TABLE -->

      
      <!-- Start FORM -->
      <div class="col-lg-4">
        <div class="card">
          <div class="card-header bg-info" style="text-shadow:0px 0px 3px #000;">
            <h5 class="text-white">Add Category</h5>
          </div>
          <div class="card-body">
          @if (session('alert'))
          <div class="alert alert-warning">
            <strong>{{session('alert')}}</strong>
          </div>
          @endif

            <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
              @csrf

              <div class="form-group">
                <label for="ctgName">Category Name</label>
                <input type="text" name="category_name" id="ctgName" value="{{old('category_name')}}" class="form-control @error('category_name') is-invalid @enderror">
                @error('category_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="ctgImage">Category Image</label>
                <input type="file" name="category_image" id="ctgImage" value="{{old('category_image')}}" class="form-control @error('category_image') is-invalid @enderror">
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