@extends('layouts.frontend-layout')

@section('frontend_page_title')
Blog Details
@endsection

@section('blog')  active  @endsection

@section('internal_style')

@endsection

@section('content')
	<!-- .breadcumb-area start -->
	<div class="breadcumb-area bg-img-4 ptb-100">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="breadcumb-wrap text-center">
						<h2>Blog Details</h2>
						<ul>
							<li><a href="{{url('blog-page')}}">Blog</a></li>
							<li><span>Blog Details</span></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- .breadcumb-area end -->
	<!-- blog-details-area start-->
	<div class="blog-details-area ptb-100">
		<div class="container">
			<div class="row">
				<!-- blog details area starts -->
				<div class="col-lg-9 col-12">
					<div class="blog-details-wrap">
						<img src="{{asset('uploads/blogs')}}/{{$blog->image}}" alt="">
						<h3>{{$blog->title}}</h3>
						<ul class="meta">
							<li>{{$blog->created_at->format('d M Y')}}</li>
							<li>{{App\User::find($blog->user_id)->name}}</li>
						</ul>
						<p>{{$blog->description}}</p>

						<div class="share-wrap">
							<div class="row">
								<div class="col-sm-7 ">
									<ul class="socil-icon d-flex">
										<li>share it on :</li>
										<li><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
										<li><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
										<li><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
										<li><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
										<li><a href="javascript:void(0);"><i class="fa fa-instagram"></i></a></li>
									</ul>
								</div>
								<div class="col-sm-5 text-right">
									<a href="javascript:void(0);">Next Post <i class="fa fa-long-arrow-right"></i></a>
								</div>
							</div>
						</div>
					</div>
					<div class="comment-form-area">
						<div class="comment-main">
							<h3 class="blog-title"><span>({{$blog_comment_count}})</span>Comments:</h3>
							<ol class="comments">
								<li class="comment even thread-even depth-1">
									@foreach($blog_comments as $blog_comment)
									<div class="comment-wrap">
										<div class="comment-theme">
											<div class="comment-image rounded-circle" style="width:40px;height:40px; overflow:hidden;">
												<img src="{{asset('uploads/users')}}/{{App\User::find($blog_comment->user_id)->image}}" alt="Aftab" width="40">
											</div>
										</div>
										<div class="comment-main-area">
											<div class="comment-wrapper">
												<div class="sewl-comments-meta">
													<h4>{{App\User::find($blog_comment->user_id)->name}}</h4>
													<span>{{$blog_comment->created_at->format('d M Y h:ia')}}</span>
												</div>
												<div class="comment-area">
													<p>{{$blog_comment->comment}}</p>
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</li>
							</ol>
						</div>
						<div id="respond" class="sewl-comment-form comment-respond form-style">
							<h3 id="reply-title" class="blog-title">Leave a <span>comment</span></h3>
							<form novalidate="" method="post" id="commentform" class="comment-form" action="{{url('blog-comment-post')}}">
								@csrf
								<div class="row">
									<div class="col-12">
										<input type="text" name="blog_id" value="{{$blog->id}}" hidden>
										<div class="sewl-form-textarea no-padding-right">
											<textarea id="comment" name="comment" tabindex="4" rows="3" cols="30" placeholder="Write Your Comments..."></textarea>
										</div>
									</div>
									<div class="col-12">
										<div class="form-submit">
											<input name="submit" id="submit" value="Send" type="submit">
											<input name="comment_post_ID" value="1" id="comment_post_ID" type="hidden">
											<input name="comment_parent" id="comment_parent" value="0" type="hidden">
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- blog details area ends -->
				<!-- sidebar area starts -->
				<div class="col-lg-3 col-12">
					<aside class="sidebar-area">
						<div class="widget widget_recent_entries recent_post">
							<h4 class="widget-title">Recent Post</h4>
							<ul>
								@foreach($recent_blogs->slice(0, 6) as $recent_blog)
								@if($recent_blog->id != $blog->id)
								<li>
									<div class="mb-1">
										<a href="{{url('blog-details/'.$recent_blog->id.'/'.Str::slug($recent_blog->title))}}"><img src="{{asset('uploads/blogs')}}/{{$recent_blog->image}}"></a>
									</div>
									<div class="post-content">
										<a href="{{url('blog-details')}}/{{$recent_blog->id}}">{{$recent_blog->title}}</a>
										<p>{{$recent_blog->created_at->format('d M Y')}}</p>
									</div>
								</li>
								@endif
								@endforeach
							</ul>
						</div>
					</aside>
				</div>
				<!-- sidebar area ends -->
			</div>
		</div>
	</div>
	<!-- blog-details-area end -->
@endsection