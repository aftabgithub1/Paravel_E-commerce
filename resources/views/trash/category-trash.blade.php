@extends('layouts.dashboard')

@section('page_title')
Categoty Trash
@endsection

@section('category')
active
@endsection

@section('breadcrumb')
<a class="breadcrumb-item" href="{{route('category.index')}}">Category</a>
<a class="breadcrumb-item" href="{{url('categorytrash')}}">Trash</a>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">

      <!-- Start TABLE -->
      <div class="col-lg-10 m-auto">
        <div class="card">
          <div class="card-header bg-info" style="text-shadow:0px 0px 3px #000;">
            <h5 class="text-white">Category Trash</h5>
          </div>
          <div class="card-body">    <!-- overflow-auto -->
          @if (session('category_trash_alert'))
          <div class="alert alert-warning">
            <strong>{{session('category_trash_alert')}}</strong>
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
                    <!-- action -->
                    <div class="btn-group float-right">
                      <button type="button" class="btn btn-sm btn-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon ion-more"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a href="" class="dropdown-item" type="button">View</a>
                        <a href="{{url('categoryrestore')}}/{{$category->id}}" class="dropdown-item" type="button">Restore</a>
                        <a href="{{url('categoryforcedelete')}}/{{$category->id}}" class="dropdown-item" type="button">Delete</a>
                      </div>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan=6 class="text-center text-danger"><h3>No data available</h3></td>
                </tr>
              @endforelse
              </tbody>
            </table>
            <div class="row">
              <div class="col-md-12">{{$categories->links()}}</div>
            </div>
          </div>
        </div>
      </div>
      <!-- End TABLE -->

    </div>
</div>
@endsection