@extends('layouts.frontend-layout')

@section('page_title')
Movies
@endsection

@section('entertainment')
active
@endsection

@section('movies')
active
@endsection

@section('breadcrumb')
<a class="breadcrumb-item" href="{{url('api-movies')}}">Movies</a>
@endsection

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-12">
			<div class="">
				<div class="mx-4">
					<h2 class="text-info text-center m-3">Search Movies Here</h2>
					<form action="" method="get">
						<div class="form-group row">
							<div class="col-10">
								<input class="form-control" type="text" name="search_keyword" value="">
							</div>
							<div class="col-2">
								<button class="form-control btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
							</div>
						</div>
					</form>
				</div>
				<h4 class="text-info text-center mt-4">Search Results</h4>
				<div class="row card-body">
					@foreach($searched_movies as $key => $value)
						@if($key=='Search')
							@foreach($value as $movies)
							<div class="col-lg-3 mb-3">
								<a href="https://www.imdb.com/title/{{$movies['imdbID']}}" target="_blank">
									<div class="card">
										<img src="{{$movies['Poster']}}" class="card-img-top" alt="...">
										<div class="card-body">
											<h5 class="card-title">{{$movies['Title']}}</h5>
											<h6 class="card-title">{{$movies['Year']}}</h6>
											<p class="card-text"></p>
										</div>
									</div>
								</a>
							</div>
							@endforeach
						@endif
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
