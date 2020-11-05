@extends('layouts.frontend-layout')

@section('frontend_page_title')
Blog Page
@endsection

@section('blog')  active  @endsection

@section('content')
<div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Blog Page</h2>
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><span>Blog Page</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- blog-area start -->
    <div class="blog-area">
        <div class="container">
            <div class="col-lg-12">
                <div class="section-title  text-center">
                    <h2>Latest News</h2>
                    <img src="assets/images/section-title.png" alt="">
                </div>
            </div>
            <div class="row">
                @foreach($blogs as $blog)
                <div class="col-lg-4  col-md-6 col-12">
                    <div class="blog-wrap">
                        <div class="blog-image">
                            <img src="{{asset('uploads/blogs')}}/{{$blog->image}}" alt="">
                            <ul>
                                <li>{{$blog->created_at->format('d')}}</li>
                                <li>{{$blog->created_at->format('M')}}</li>
                            </ul>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <ul>
                                    <li><div class="row align-items-center">
                                    <div class="rounded-circle mx-2" style="width:30px;height:30px; overflow:hidden;">
                                        <img src="{{asset('uploads/users')}}/{{App\User::find($blog->user_id)->profile_pic}}" alt="Aftab" width="30">
                                    </div>    
                                    {{App\User::find($blog->user_id)->name}}
                                    </div></li>
                                    <li class="pull-right"><a href="#"><i class="fa fa-clock-o"></i> {{$blog->created_at->format('d/m/Y')}}</a></li>
                                </ul>
                            </div>
                            <h3><a href="{{url('blog-details')}}/{{$blog->id}}">{{$blog->title}}</a></h3>
                            <p>{{substr($blog->description, 0, 150)}}</p>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        {{$blogs->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- blog-area end -->
@endsection