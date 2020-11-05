@extends('layouts.dashboard')

@section('page_title')
Movies
@endsection

@section('api')
active
@endsection

@section('movies')
active
@endsection

@section('breadcrumb')
<a class="breadcrumb-item" href="{{url('api-movies')}}">Movies</a>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h5 class="mb-3">Search Movies Here</h5>
					<form action="" method="get">
						@csrf
						<div class="form-group row">
							<div class="col-10">
								<input class="form-control" type="text" name="search_movies">
							</div>
							<div class="col-2">
								<input class="form-control btn btn-primary" type="submit" value="Search">
							</div>
						</div>
					</form>
				</div>
				<div class="row card-body">
					@foreach($searched_movies as $key => $value)
						@if($key=='Search')
							@foreach($value as $movies)
							<div class="col-lg-3">
								<div class="card">
								<img src="{{$movies['Poster']}}" class="card-img-top" alt="...">
								<div class="card-body">
									<h5 class="card-title">{{$movies['Title']}}</h5>
									<h6 class="card-title">{{$movies['Year']}}</h6>
									<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
									<a href="#" class="btn btn-primary">Go somewhere</a>
								</div>
								</div>
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
