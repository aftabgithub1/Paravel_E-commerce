@extends('layouts.dashboard')

@section('page_title')
Edit User Role
@endsection

@section('users')
active
@endsection

@section('users_role')
active
@endsection

@section('breadcrumb')
<a class="breadcrumb-item" href="{{url('users')}}">Users</a>
<a class="breadcrumb-item" href="{{url('role')}}">Role Manager</a>
<a class="breadcrumb-item" href="{{url('role')}}">Edit User role</a>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">

        <!-- All forms start -->
        <div class="col-lg-6 m-auto">

            <!-- FORM assign permission to role -->
            <div class="card mb-4">
                <div class="card-header bg-info" style="text-shadow:0px 0px 3px #000;">
                <h5 class="text-white">Add Role to {{$user->name}}</h5>
                </div>
                <div class="card-body">
                @if (session('update_user_permission_alert'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>{{session('update_user_permission_alert')}}</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
                <form action="{{ url('update-user-permission') }}" method="post">
                    @csrf
                    <div class="form-group">
                    <p class="mb-2">Permissions</p> 
                    <table class="table table-bordered">
                      @foreach($permissions as $permission)
                      <tr>
                        <td>{{$permission->name}}</td>
                        <td class="text-center">
                          <input type="text" name="user_id" value="{{$user->id}}" hidden>
                          <input type="checkbox" name="permission[]" value="{{$permission->name}}" {{$user->hasPermissionTo($permission->name)?'checked':''}}>
                        </td>
                      </tr>
                      @endforeach
                    </table>
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






    </div>
</div>
@endsection