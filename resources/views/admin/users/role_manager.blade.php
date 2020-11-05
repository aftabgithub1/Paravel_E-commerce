@extends('layouts.dashboard')

@section('page_title')
Role Manager
@endsection

@section('users')
active
@endsection

@section('users_role')
active
@endsection

@section('breadcrumb')
<a class="breadcrumb-item" href="{{url('users')}}">Role Manager</a>
<a class="breadcrumb-item" href="{{url('role')}}">Role Manager</a>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">

        <!-- All forms start -->
        <div class="col-lg-4">

            <!-- FORM Add Permission in database -->
            <div class="card mb-4">
                <div class="card-header bg-info" style="text-shadow:0px 0px 3px #000;">
                <h5 class="text-white">Add Permission</h5>
                </div>
                <div class="card-body">
                @if (session('permission_alert'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>{{session('permission_alert')}}</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
                <!-- Multiple error at the same time:
                    @if ($errors->all())
                    <div class="alert alert-success">
                        <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif 
                -->
                <form action="{{ url('add-permission') }}" method="post">
                    @csrf
                    <div class="form-group">
                    <label for="permissionName">Permission</label>
                    <input type="text" name="permission_name" id="permissionName" value="" class="form-control @error('permission_name') is-invalid @enderror">
                    @error('permission_name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>                    
                    <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-info btn-sm">Add</button>
                    </div>
                </form>
                </div>
            </div>

            <!-- FORM assign permission to role -->
            <div class="card mb-4">
                <div class="card-header bg-info" style="text-shadow:0px 0px 3px #000;">
                <h5 class="text-white">Add Role</h5>
                </div>
                <div class="card-body">
                @if (session('role_alert'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>{{session('role_alert')}}</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
                <form action="{{ url('add-role') }}" method="post">
                    @csrf
                    <div class="form-group">
                    <label for="roleName">Role Name</label>
                    <input type="text" name="role_name" id="roleName" value="{{old('role_name')}}" class="form-control @error('role_name') is-invalid @enderror">
                    @error('role_name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>                    
                    <div class="form-group">
                    <p class="mb-2">Permissions</p>
                    <div style="height:200px;overflow-y:auto">
                      <table class="table table-bordered">
                        @foreach($permissions as $permission)
                        <tr>
                          <td>{{$permission->name}}</td>
                          <td class="text-center"><input type="checkbox" name="permission[]" value="{{$permission->name}}"></td>
                        </tr>
                        @endforeach
                      </table>
                    </div>
                    @error('permission')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>                  
                    <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-info btn-sm">Add</button>
                    </div>
                </form>
                </div>
            </div> 

            <!-- Assigne role to user -->
            <div class="card mb-4">
                <div class="card-header bg-info" style="text-shadow:0px 0px 3px #000;">
                <h5 class="text-white">Assign Role</h5>
                </div>
                <div class="card-body">
                @if (session('assign_role_alert'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>{{session('assign_role_alert')}}</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
                <form action="{{ url('assign-role') }}" method="post">
                    @csrf
                    <div class="form-group">
                      <label for="email">User's Email</label>
                      <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror">
                      @error('email')
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>                    
                    <div class="form-group">
                      <label for="role">Role</label>
                      <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                        <option value="" selected hidden>-- Select a role --</option>
                        @foreach($roles as $role)
                        <option value="{{$role->name}}">{{$role->name}}</option>
                        @endforeach
                      </select>
                      @error('permission')
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>                              
                    <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-info btn-sm">Add</button>
                    </div>
                </form>
                </div>
            </div>
        
        </div>
        <!-- All forms end -->


      <!-- All tables -->
      <div class="col-lg-8">
      <!-- TABLE-1 STARTS -->
        <div class="card mb-4">
          <div class="card-header bg-info" style="text-shadow:0px 0px 3px #000;">
            <h5 class="text-white">Roles</h5>
          </div>
          <div class="card-body">    <!-- overflow-auto -->
          @if (session('coupon_table_allert'))
          <div class="alert alert-warning">
            <storng>{{session('coupon_table_allert')}}</storng>
          </div>
          @endif
            <table class="table table-bordered">    <!-- text-nowrap -->
              <thead class="thead-light">
                <tr>
                  <th>SL.No.</th>
                  <th>Role name</th>
                  <th>Permissions</th>
                  <th><span class="float-right">Action</span></th>
                </tr>
              </thead>
              <tbody>
                @foreach($roles as $role)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$role->name}}</td>
                    <td class="border">
                      @foreach($role->getPermissionNames() as $permission)
                      <span class="bg-light my-4 px-1">{{$permission}}</span>
                      @endforeach
                    </td>
                    <td>
                      <div class="btn-group float-right">
                      <button type="button" class="btn btn-sm btn-light px-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon ion-gear-a"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a href="" class="dropdown-item" type="button">View</a>
                        <a href="" class="dropdown-item" type="button">Edit</a>
                        <a href="" class="dropdown-item" type="button">Delete</a>
                      </div>
                      </div>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      
      
      <!-- TABLE-2 STARTS -->
        <div class="card mb-4">
          <div class="card-header bg-info" style="text-shadow:0px 0px 3px #000;">
            <h5 class="text-white">User's Roles</h5>
          </div>
          <div class="card-body">    <!-- overflow-auto -->
          @if (session('coupon_table_allert'))
          <div class="alert alert-warning">
            <storng>{{session('coupon_table_allert')}}</storng>
          </div>
          @endif
            <table class="table table-bordered">    <!-- text-nowrap -->
              <thead class="thead-light">
                <tr>
                  <th>SL.No.</th>
                  <th>Users</th>
                  <th>Role name</th>
                  <th>Permissions</th>
                  <th><span class="float-right">Action</span></th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td><span class="font-weight-bold">{{$user->name}}</span> ({{$user->email}})</td>
                    <td>
                      @foreach($user->getRoleNames() as $role)
                      <span>{{$role}}</span>
                      @endforeach
                    </td>
                    <td>
                      @foreach($user->getAllPermissions() as $permission)
                      <span class="bg-light my-4 px-1">{{$permission->name}}</span>
                      @endforeach
                    </td>
                    <td>
                      <div class="btn-group float-right">
                      <button type="button" class="btn btn-sm btn-light px-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon ion-gear-a"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a href="" class="dropdown-item" type="button">View</a>
                        <a href="{{url('edit-user-role')}}/{{$user->id}}" class="dropdown-item" type="button">Edit</a>
                        <a href="" class="dropdown-item" type="button">Delete</a>
                      </div>
                      </div>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>




    </div>
</div>
@endsection