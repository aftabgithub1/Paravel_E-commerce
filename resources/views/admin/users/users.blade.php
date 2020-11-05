@extends('layouts.dashboard')

@section('page_title')
User List
@endsection

@section('users')
active
@endsection

@section('users_list')
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
			<div class="card">
				<div class="card-header bg-info" style="text-shadow:0px 0px 3px #000;"><h5 class="text-white">User List<span class="float-right small">Total User: {{$total_user}}</span></h5></div>

				<div class="card-body">
					
					@if (session('user_table_alert'))
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>{{session('user_table_alert')}}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					@endif

					<table class="table">
						<thead class="thead-light">
							<tr>
								<!-- <th>PSL</th> -->
								<th>SL</th>
								<th>Name</th>
								<th>Role</th>
								<th>Email</th>
								<th>Created at</th>
								<th><span class="float-right">Action</span></th>
							</tr>
						</thead>
						<tbody>
						@foreach($users as $index => $user)
							<tr>
								<!-- <td>{{$loop->index+1}}</td> -->
								<td>{{$users->firstitem() + $index}}</td>
								<td>{{$user->name}}</td>
								<td>
									@if ($user->role == 1)
									Admin
									@elseif ($user->role == 2)
									Modarator
									@else
									Customer
									@endif
								</td>
								<td>{{$user->email}}</td>
								<td>{{$user->created_at->format('d-M-Y h:i:s A')}}</td>
								<td>
									<div class="btn-group float-right">
										<button type="button" class="btn btn-sm btn-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon ion-gear-a"></i></button>
										<div class="dropdown-menu dropdown-menu-right">
											<a href="{{url('user.view-user')}}/{{$user->id}}" class="dropdown-item" type="button">View</a>
											<a href="{{url('useredit')}}/{{$user->id}}" class="dropdown-item" type="button">Edit</a>
											<a href="{{url('userdelete')}}/{{$user->id}}" class="dropdown-item" type="button">Delete</a>
										</div>
									</div>
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
					<div class="row">
						<div class="col-md-12">{{$users->links()}}</div>
					</div>
					<div class="row">
						<div class="col-md-12"><a href="{{ url('usertrash') }}">See Trash</a></div> 
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
