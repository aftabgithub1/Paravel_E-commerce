@extends('layouts.dashboard')

@section('page_title')
User Edit
@endsection

@section('users')
active
@endsection

@section('breadcrumb')
<a class="breadcrumb-item" href="{{url('users')}}">Users</a>
<a class="breadcrumb-item" href="{{url('useredit')}}">User Edit</a>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header bg-info" style="text-shadow:0px 0px 3px #000;"><h5 class="text-white">User Edit</h5></div>

				<div class="card-body">
					@if (session('user_edit_alert'))
						<div class="alert alert-warning" role="alert">
							<storng>{{ session('user_edit_alert') }}</storng>
						</div>
					@endif

          <form action="{{url('usereditpost')}}" method="post">

            @csrf
            <input type="hidden" name="user_id" id="name" value="{{$user_edit->id}}" class="form-control">

            <div class="form-group">
              <label for="name">{{__('Name')}}</label>
              <input type="text" name="name" id="name" value="{{$user_edit->name}}" class="form-control @error('name') is-invalid @enderror" required autocomplete="name" autofucus>
              @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{$message}}</strong>
                </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="email">{{__('Email')}}</label>
              <input type="email" name="email" id="email" value="{{$user_edit->email}}" class="form-control @error('email') is-invalid @enderror" required autocomplete="email">
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{$message}}</strong>
                </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="password">{{__('New Password')}}</label>
              <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">
              @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{$message}}</strong>
                </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="passwordConfirm">{{__('Confirm New Password')}}</label>
              <input type="password" name="password_confirmation" id="passwordConfirm" class="form-control">
            </div>
                          
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-info w-25">Submit</button>
            </div>

          </form>


				</div>
			</div>
		</div>
	</div>
</div>
@endsection
