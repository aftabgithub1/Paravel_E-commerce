<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<meta name="description" content="Paravel demo">
			<meta name="author" content="Aftab Ahmed">
		
		<title>Starlight Responsive Bootstrap 4 Admin Template</title>

		<!-- Dashboard assets -->
			<link href="{{asset('dashboard_assets/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
			<link href="{{asset('dashboard_assets/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">

		<!-- Starlight CSS -->
		<link rel="stylesheet" href="{{asset('dashboard_assets/css/starlight.css')}}">
	</head>

	<body>

		<div class="d-flex align-items-center justify-content-center ht-100v"
		style="background: linear-gradient(45deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.5)), url({{asset('frontend_assets/images/bg/bg_login_ragister.jpg')}}) center/cover no-repeat">

			<a href="{{url('/')}}" 
			style="position: absolute; top:0; right:0; font-size:3em; margin-right:15px;">
			&times;</a>

			<div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
				<div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Paravel <span class="tx-info tx-normal">admin</span></div>
				<div class="tx-center mg-b-20">Login form</div>

				<form method="POST" action="{{ route('login') }}">
					@csrf
					<div class="form-group">
						<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your username">
						
						@error('email')
							<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div><!-- form-group -->

					<div class="form-group">
						<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">

						@error('password')
							<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
							</span>
						@enderror

					</div><!-- form-group -->
					
					<div class="form-group">
						<div class="col">
							<div class="form-check ml-2">
								<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
								
								<label class="form-check-label" for="remember">
									{{ __('Remember Me') }}
								</label>
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-info btn-block mb-1">{{ __('Sign In') }}</button>
					<a href="{{url('login/github')}}" class="btn btn-info form-control">Login With Github</a>
					
					@if (Route::has('password.request'))
							<a class="tx-info tx-12 d-block mg-t-10" href="{{ route('password.request') }}">
									{{ __('Forgot Your Password?') }}
							</a>
						@endif
				</form>

				<div class="mg-t-60 tx-center">Not yet a member? <a href="{{ route('register') }}" class="tx-info">Sign Up</a></div>
			</div><!-- login-wrapper -->
		</div><!-- d-flex -->

		<script src="{{asset('dashboard_assets/lib/jquery/jquery.js')}}"></script>
		<script src="{{asset('dashboard_assets/lib/popper.js/popper.js')}}"></script>
		<script src="{{asset('dashboard_assets/lib/bootstrap/bootstrap.js')}}"></script>

	</body>
</html>
