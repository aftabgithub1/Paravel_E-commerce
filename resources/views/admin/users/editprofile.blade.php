@extends('layouts.dashboard')

@section('page_title')
Edit Profile
@endsection

@section('breadcrumb')
<a class="breadcrumb-item" href="{{url('users')}}">Users</a>
<a class="breadcrumb-item" href="{{url('editprofile')}}">Edit Profile</a>
@endsection

@section('content')
<div class="container">
    <div class="row">
      


      <div class="col-lg-6 m-auto">


        <div class="card">
          <div class="card-header bg-info" style="text-shadow:0px 0px 3px #000;"><h5 class="text-white">Change Password</h5></div>
          <div class="card-body">
            @if (session('passChangeAlert'))
            <div class="alert alert-warning">
              <storng>{{session('passChangeAlert')}}</storng>
            </div>
            @endif

            <!-- @if ($errors->all())
            <div class="alert alert-success">
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
              </ul>
            </div>
            @endif -->

            <form action="{{ url('editprofilepost') }}" method="post">
              @csrf
              
              <div class="form-group">
                <label for="oldPassword">Old Password</label>
                <input type="password" name="old_password" id="oldPassword" class="form-control @error('old_password') is-invalid @enderror">
                @error('old_password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
              </div>

              <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                @error('password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
              </div>

              <div class="form-group">
                <label for="passwordConfirmation">Comfirm New Password</label>
                <input type="password" name="password_confirmation" id="passwordConfirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                @error('password_confirmation')
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
    </div>
</div>
@endsection