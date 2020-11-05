@extends('layouts.dashboard')

@section('page_title')
Edit Profile
@endsection

@section('internal_style')
<style>
	.particulars{width:30%;font-weight:bold}
	input[type=file]{display:none;}
	.custom_file_upload{cursor:pointer; font-size: 2em;}
</style>
@endsection

@section('users')
active
@endsection

@section('breadcrumb')
<a class="breadcrumb-item" href="{{url('users')}}">Users</a>
<a class="breadcrumb-item" href="{{url('edit-profile')}}">Edit Profile</a>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-info" style="text-shadow:0px 0px 3px #000;"><h5 class="text-white">Edit Profile</h5></div>

				<div class="card-body">
					
					@if (session('edit_profile_alert'))
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>{{session('edit_profile_alert')}}</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					</div>
					@endif

					<table class="table table-bordered table-responsive">
						<tbody>
							<tr>
								<td>User ID</td>
								<td>{{Auth::id()}}</td></tr>
							<tr>
								<td class="particulars">Name</td>
								<td>
									<div class="mb-2">{{Auth::user()->name}}
										<span class="pull-right"><button onclick="showForm0()" class="edit btn btn-light btn-sm">Edit</button></span>
									</div>
									<div class="form" style="display:none;">
										<form class="form-inline" action="{{url('edit-name')}}" method="post">
											@csrf
											<div class="form-group">
												<p class="mr-2">Change Name: </p>
												<input class="form-control form-control-sm" type="text" name="name" value="">
											</div>
											<input class="form-control-sm bg-info text-light ml-2" type="submit" value="Save" class="btn btn-light btn-sm">
										</form>
									</div>
								</td></tr>
							<tr>
								<td class="particulars">Email</td>
								<td>
									<div class="mb-2">{{Auth::user()->email}}
										<span class="pull-right"><button onclick="showForm1()" class="edit btn btn-light btn-sm">Edit</button></span>
									</div>
									<div class="form" style="display:none;">
									<form class="form-inline" action="{{url('edit-email')}}" method="post">
											@csrf
											<div class="form-group">
												<p class="mr-2">Change Email: </p>
												<input class="form-control form-control-sm" type="email" name="email" value="">
											</div>
											<input class="form-control-sm bg-info text-light ml-2" type="submit" value="Save" class="btn btn-light btn-sm">
										</form>
									</div>
								</td></tr>
							<tr>
								<td class="particulars">Chanege Password</td>
								<td>
									<div class="mb-2">Password
										<span class="pull-right"><button onclick="showForm2()" class="edit btn btn-light btn-sm">Edit</button></span>
									</div>
									<div class="row">
										<div class="col-lg-5">
											@if (session('passChangeAlert'))
											<div class="alert alert-warning alert-dismissible fade show" role="alert">
											<strong>{{session('passChangeAlert')}}</strong>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											</div>
											@endif
											
											<div class="form" style="display:none;">
												<form action="{{ url('edit-password') }}" method="post">
												@csrf
												<div class="form-group">
													<input type="password" name="old_password" placeholder="Old password" class="form-control form-control-sm @error('old_password') is-invalid @enderror">
													@error('old_password')
														<span class="invalid-feedback" role="alert">
															<strong>{{ $message }}</strong>
														</span>
													@enderror
												</div>

												<div class="form-group">
													<input type="password" name="password" placeholder="New password" class="form-control form-control-sm @error('password') is-invalid @enderror">
													@error('password')
														<span class="invalid-feedback" role="alert">
															<strong>{{ $message }}</strong>
														</span>
													@enderror
												</div>

												<div class="form-group">
													<input type="password" name="password_confirmation" placeholder="Confirm new password" class="form-control form-control-sm @error('password_confirmation') is-invalid @enderror">
													@error('password_confirmation')
														<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
														</span>
													@enderror
												</div>

												<input type="submit" class="form-control-sm bg-info text-light" value="Change Password">
												</form>
											</div>
										</div>
									</div>
								</td></tr>
							<tr>
								<td class="particulars">Profile Picture</td>
								<td>
									<div class="mb-2">
										<img src="{{asset('uploads/users')}}/{{Auth::user()->image}}" alt="Image_User" width="200" id="img">
										<span class="pull-right"><button onclick="showForm3()" class="edit btn btn-light btn-sm">Edit</button></span>
									</div>
									<div class="form" style="display:none;width:200px;">
										<form class="form-inline" action="{{url('edit-image')}}" method="post" enctype="multipart/form-data">
											@csrf
											<label for="file_upload"><i class="fa fa-camera text-info custom_file_upload"></i></label>
											<input class="" type="file" name="image" id="file_upload" onchange="document.getElementById('img').src=window.URL.createObjectURL(this.files[0])">
											<input type="submit" value="Save" class="form-control-sm bg-info text-light ml-auto">
										</form>
									</div>
								</td></tr>
							<tr>
								<td>Created at</td>
								<td>{{Auth::user()->created_at->format('d M Y h:i:sa')}}</td></tr>
							<tr>
								<td>Updatad at</td>
								<td>{{Auth::user()->updated_at->format('d M Y h:i:sa')}}</td></tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('footer_script')
<script>
	var form = document.getElementsByClassName('form');
	var edit = document.getElementsByClassName('edit');
	function showForm0(){
		form[0].style.display = "block";
		edit[0].style.display = "none";
	}
	function showForm1(){
		form[1].style.display = "block";
		edit[1].style.display = "none";
	}
	function showForm2(){
		form[2].style.display = "block";
		edit[2].style.display = "none";
	}
	function showForm3(){
		form[3].style.display = "block";
		edit[3].style.display = "none";
	}
</script>
@endsection

