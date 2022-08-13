<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{

    public function index(){
        return view("roles.roles_view", [
            "permissions" => Permission::all(),
            "roles" => Role::all(),
        ]);
    }


    public function create(Request $request){
        $permissions = "NA";

        $request->validate([
            "role" => "required",
            "description" => "required",
            "permissions" => "required",
        ]);

        if($request->permissions != null){
            $permissions = $request->permissions;
        }

        $role = Role::create([
            "role" => $request->role,
            "description" => $request->description,
            "permissions_id" => $permissions
        ]);
        
        if($role){
            return back()->with("role_success", "Role ".$request->role." created successfully.");
        }else{
            return back()->with("role_danger", "Failed to create role ".$request->role);
        }
    }

    // Update 
    public function update(Request $request){
        $permissions = "NA";

        $request->validate([
            "role" => "required",
            "description" => "required",
        ]);

        if($request->permissions != null){
            $permissions = $request->permissions;
        }

        $role = Role::find($request->id);

        // Role name.
        $role_name = $role->role;

        $role->role = $request->role;
        $role->description = $request->description;
        $role->permissions_id = $permissions;



        if($role->update()){
            return back()->with(["role_info"=>"Role ".$role_name." updated.", 'roles'=>Role::all()]);
        }else{
            return back()->with("role_danger", "Role ".$role_name." did not update.");
        }
    }
    
    // Get role by id
    public function getRoleById($id){
        return Role::find($id);
    }


    // Delete
    public function delete(Request $request){
        $role = Role::find($request->id);
        $role_name = $role->role;
        if($role->delete()){
            return back()->with("role_info", "Role ".$role_name." deleted.");
        }else{
            return back()->with("role_danger", $role_name." did not delete.");
        }
    }

    public function manageRolesView(){
        // $data = DB::table('permissions')
        // ->join('roles','roles.permissions',DB::Raw("json_contains(permissions.id,roles.permissions)"))
        // ->get();
        return view("roles.manage_roles", [
            "permissions" => Permission::all(),
            "roles" => Role::where('role', '!=', 'admin')->get(),
        ]);
    }
}
