@extends('layouts.dashboard')

@section('page_title')
Add New Users
@endsection

@section('users')
active
@endsection

@section('add_new_users')
active
@endsection

@section('breadcrumb')
<a class="breadcrumb-item" href="{{url('admin-dashboard')}}">Home</a>
<a class="breadcrumb-item" href="{{url('users')}}">Users</a>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-10">
      <div class="row">
        <div class="col-lg-6 m-auto">
          
					@if (session('add_user_alert'))
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>{{session('add_user_alert')}}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					@endif

          <div class="card">
            <div class="card-header bg-info" style="text-shadow:0px 0px 3px #000;">
              <h5 class="text-white">Add User</h5>
            </div>
            <div class="card-body">
              <form action="{{route('register')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter your username">
                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                  
                </div><!-- form-group -->

                <div class="form-group">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email">
                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div><!-- form-group -->

                <div class="form-group">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter your password">
                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div><!-- form-group -->

                <div class="form-group">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
                </div><!-- form-group -->
                
                <div class="form-group tx-12">By clicking the Sign Up button below, you agreed to our privacy policy and terms of use of our website.</div>
                <button type="submit" class="btn btn-info btn-block">Sign Up</button>
              </form>
            </div>
          </div>
        </div>
      </div>
		</div>
	</div>
</div>
@endsection