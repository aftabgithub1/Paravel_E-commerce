@extends('layouts.dashboard')

@section('page_title')
Create Blog
@endsection

@section('createblog')
active
@endsection

@section('breadcrumb')
<a class="breadcrumb-item" href="{{url('admin-dashboard')}}">Home</a>
<a class="breadcrumb-item" href="{{url('create-blog')}}">Create Blog</a>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Form part -->
    <div class="row mb-4">
        <div class="col-lg-12">
            @if (session('create_blog_alert'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{session('create_blog_alert')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="card">
                <div class="card-header">Create a blog</div>
                <div class="card-body">
                    <form action="{{route('blog.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        
                        <label for="blogTitle">Title</label>
                        <input type="text" name="title" id="blogTitle" class="form-control mb-3 @error('title') is-invalid @enderror">
                        @error('title')
                        <div class="alert"><strong>{{message}}</strong></div>
                        @enderror

                        <label for="blogDesp">Description</label>
                        <textarea name="desp" id="blogDesp" cols="30" rows="6" class="form-control mb-3 @error('desp') is-invalid @enderror"></textarea>
                        @error('desp')
                        <div class="alert"><strong>{{message}}</strong></div>
                        @enderror

                        <label for="blogImage">Upload an image for your blog</label><br>
                        <input type="file" name="image" id="blogImage" class="mb-3">

                        <div class="form-group">
                            <input type="submit" value="submit" class="btn btn-primary">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Table part -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">All Blogs</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Image</td>
                                <td>Creator</td>
                                <td>Title</td>
                                <td>Description</td>
                                <td><span class="float-right">Action</span></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blogs as $blog)
                            <tr>
                                <td>{{$blog->id}}</td>
                                <td><img src="{{asset('uploads/blogs')}}/{{$blog->image}}" alt="" height="50"></td>
                                <td>{{App\User::find($blog->user_id)->name}}</td>
                                <td>{{$blog->title}}</td>
                                <td>{{substr($blog->description, 0, 80)}}...</td>
                                <td>
                                    <div class="btn-group float-right">
                                        <button type="button" class="btn btn-sm btn-light px-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon ion-gear-a"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="{{url('view-blog')}}/{{$blog->id}}" class="dropdown-item" type="button">View</a>
                                            <a href="{{url('edit-blog')}}/{{$blog->id}}" class="dropdown-item" type="button">Edit</a>
                                            <a href="{{url('delete-blog')}}/{{$blog->id}}" class="dropdown-item" type="button">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center">{{$blogs->links()}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
