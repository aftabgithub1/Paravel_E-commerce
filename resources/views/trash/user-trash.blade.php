@extends('layouts.dashboard')

@section('page_title')
User Trash
@endsection

@section('trash')
active
@endsection

@section('breadcrumb')
<a class="breadcrumb-item" href="{{url('users')}}">Users</a>
<a class="breadcrumb-item" href="{{url('usertrash')}}">Trash</a>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header bg-info" style="text-shadow:0px 0px 3px #000;"><h5 class="text-white">User Trash</h5></div>

				<div class="card-body">
					@if (session('user_trash_alert'))
						<div class="alert alert-warning" role="alert">
							<strong>{{ session('user_trash_alert') }}</strong>
						</div>
					@endif

					<table class="table">
						<thead class="thead-light">
							<tr>
								<!-- <th>PSL</th> -->
								<th>SL</th>
								<th>Name</th>
								<th>Email</th>
								<th>Created at</th>
								<th><span class="float-right">Action</span></th>
							</tr>
						</thead>
						<tbody>
						@forelse($users_trash as $index => $user_trash)
							<tr>
								<!-- <td>{{$loop->index+1}}</td> -->
								<td>{{$users_trash->firstitem() + $index}}</td>
								<td>{{$user_trash->name}}</td>
								<td>{{$user_trash->email}}</td>
								<td>{{$user_trash->created_at->format('d-M-Y h:i:s A')}}</td>
								<td>
									<div class="btn-group float-right">
										<button type="button" class="btn btn-sm btn-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="icon ion-more"></i>
										</button>
										<div class="dropdown-menu dropdown-menu-right">
											<a href="{{url('user.view-user')}}/{{$user_trash->id}}" class="dropdown-item" type="button">View</a>
											<a href="{{url('userrestore')}}/{{$user_trash->id}}" class="dropdown-item" type="button">Restore</a>
											<a href="{{url('userforcedelete')}}/{{$user_trash->id}}" class="dropdown-item" type="button">Delete</a>
										</div>
									</div>
                </td>
							</tr>
						@empty
							<tr>
								<td colspan=5 class="text-center text-danger">
									<h4>{{__('No Data Available')}}</h4>
								</td>
							</tr>
						@endforelse
						</tbody>
					</table>
					<div class="row">
						<div class="col-md-12">{{$users_trash->links()}}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
