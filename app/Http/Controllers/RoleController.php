<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class RoleController extends Controller
{
    public function roleManager(){
        $roles = Role::all();
        $permissions = Permission::all();
        $users = User::where('role',2)->get();
        return view('admin.users.role_manager', compact('roles','permissions','users'));
    }
    public function addPermission(Request $request){
        $request->validate(['permission_name' => 'required']);
        $permission = Permission::create(['name' => $request->permission_name]);
        return back()->with('permission_alert', 'Permission added successfully!');
    }
    public function addRole(Request $request){
        $request->validate(['role_name' => 'required']);
        $request->validate(['permission' => 'required']);
        $role = Role::create(['name' => $request->role_name]);
        $role->givePermissionTo($request->permission);
        return back()->with('role_alert', 'Role added Successfully!');
    }
    public function assignRoleToUser(Request $request){
        if(User::where('email', $request->email)->exists()){
            $user = User::where('email', $request->email)->first();
            $user->assignRole($request->role);
            User::where('id', $user->id)->update(['role' => 2]);
            return back()->with('assign_role_alert', 'Role assigned successfully!');
        } else{
            return back()->with('assign_role_alert', 'The email does not exists!');
        }
    }
    public function editUserRole($user_id){
        $user = User::where('id', $user_id)->first();
        $permissions = Permission::all();
        return view('admin.users.edit_user_role', compact('user', 'permissions'));
    }
    public function updateUsrePermission(Request $request){
        $users = User::find($request->user_id);
        $users->syncPermissions($request->permission);
        return back()->with('update_user_permission_alert', 'Permission update successful!');
    }
}
