<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Starlight">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/starlight/img/starlight-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/starlight">
    <meta property="og:title" content="Starlight">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>Starlight Responsive Bootstrap 4 Admin Template</title>

    <!-- vendor css -->
    <link href="{{asset('dashboard_assetslib/font-awesome/css/font-awesome.css')}}/" rel="stylesheet">
    <link href="{{asset('dashboard_assets/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard_assets/lib/select2/css/select2.min.css')}}" rel="stylesheet">


    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{asset('dashboard_assets/css/starlight.css')}}"> 
  </head>

  <body>

    <div class="d-flex align-items-center justify-content-center ht-md-100v"
      style="background: linear-gradient(45deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.5)), url({{asset('frontend_assets/images/bg/bg_login_ragister.jpg')}}) center/cover no-repeat">
      
      <a href="{{url('/')}}" 
      style="position: absolute; top:0; right:0; font-size:3em; margin-right:15px;">
      &times;</a>

      <div class="login-wrapper wd-300 wd-xs-400 pd-25 pd-xs-40 bg-white">
        <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Paravel <span class="tx-info tx-normal">admin</span></div>
        <div class="tx-center mg-b-20">Registration form</div>

        <form action="{{route('register')}}" method="post">
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

          <!-- <div class="form-group">
            <label class="d-block tx-11 tx-uppercase tx-medium tx-spacing-1">Birthday</label>
            <div class="row row-xs">
              <div class="col-sm-4">
                <select class="form-control select2" data-placeholder="Month">
                  <option label="Month"></option>
                  <option value="1">January</option>
                  <option value="2">February</option>
                  <option value="3">March</option>
                  <option value="4">April</option>
                  <option value="5">May</option>
                </select> -->
              <!--</div> col-4 -->
              <!-- <div class="col-sm-4 mg-t-20 mg-sm-t-0">
                <select class="form-control select2" data-placeholder="Day">
                  <option label="Day"></option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select> -->
              <!--</div> col-4 -->
              <!-- <div class="col-sm-4 mg-t-20 mg-sm-t-0">
                <select class="form-control select2" data-placeholder="Year">
                  <option label="Year"></option>
                  <option value="1">2010</option>
                  <option value="2">2011</option>
                  <option value="3">2012</option>
                  <option value="4">2013</option>
                  <option value="5">2014</option>
                </select> -->
              <!--</div> col-4 -->
            <!--</div> row -->
          <!--</div> form-group -->
          
          <div class="form-group tx-12">By clicking the Sign Up button below, you agreed to our privacy policy and terms of use of our website.</div>
          <button type="submit" class="btn btn-info btn-block">Sign Up</button>
        </form>

        <div class="mg-t-40 tx-center">Already have an account? <a href="{{route('login')}}" class="tx-info">Sign In</a></div>
      </div><!-- login-wrapper -->
    </div><!-- d-flex -->

    <script src="{{asset('dashboard_assets/lib/jquery/jquery.js')}}"></script>
    <script src="{{asset('dashboard_assets/lib/popper.js/popper.js')}}"></script>
    <script src="{{asset('dashboard_assets/lib/bootstrap/bootstrap.js')}}"></script>
    <script src="{{asset('dashboard_assets/lib/select2/js/select2.min.js')}}"></script>
    <script>
      $(function(){
        'use strict';

        $('.select2').select2({
          minimumResultsForSearch: Infinity
        });
      });
    </script>

  </body>
</html>
