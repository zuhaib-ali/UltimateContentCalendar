<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Subscription;

class ProjectController extends Controller
{
    // Index
    public function index(){
        $subscription = Subscription::where(["user_id" => session()->get('user')->id, "plan" => 1])->first();
        
        if(empty($subscription) && session()->get('user')->id != 1){
            return view("subscription.index");
        }
        
        return view("projects", [
            "projects" => Project::all(),
            "users" => User::all(),
            "client_users" => User::join('projects', 'users.client_id', 'projects.id')
                ->where('users.client_id', "!=", null)
                ->select('users.*', 'projects.description', "projects.name as client_name")
                ->get(),
            "roles" => Role::where('id', '!=', 1)->get(),
            "permissions" => Permission::all()
        ]);
    }

    // Create
    public function create(Request $request){
        $request->validate([
            "bussiness_name" => "required",
            "email" => "required",
            "password" => "required",
            "client_role" => "required",
            'client_profile' => 'file|mimes:png,jpg,jpeg|max:204800'
            // "user" => "required"
        ]);
        
        
        $client_profile_name = null;
        
        if($request->client_profile != null){
            $client_profile_name = time().'_'.$request->client_profile->getClientOriginalName();
        }
        
        $create_project = Project::create([
            "name" => $request->bussiness_name,
            "description" => $request->description,
            "created_by" => $request->session()->get('user')->id
            // "user_id" => $request->user
        ]);
        
        if($create_project){
            $user = User::create([
                "first_name" => $request->bussiness_name,
                "email" => $request->email,
                "password" => Hash::make($request->password), 
                "role_id" => $request->client_role,
                "role_name" => "client",
                "client_id" => $create_project->id,
                "img" => $client_profile_name,
                "created_by" => $request->session()->get('user')->id
            ]);
            
            if($user){
                if($request->client_profile != null){
                    $request->client_profile->move(public_path('profile_images'), $client_profile_name);    
                }
                return redirect()->route("projects")->with("project_success", "Client ".$request->project_name." created.");    
            }{
                return redirect()->route("projects")->with("project_danger", "Project failed to created.");
            }
            
        }else{
            return redirect()->route("projects")->with("project_danger", "Client failed to created.");
        }
    }

    // Update
    public function update(Request $request){
        $profile = null;
        $request->validate([
            "bussiness_name" => "required",
            "edit_project_id" => "required",
            "role" => "required",
        ]);
        
        if($request->client_profile != null){
            $profile = time()."_".$request->client_profile->getClientOriginalName();
            
        }elseif($request->client_old_profile != null){
            $profile = $request->client_old_profile;
        }

        $project = Project::find($request->edit_project_id);
        $project->name = $request->bussiness_name;
        $project->description = $request->description;
        // $project->user_id = $request->user;

        if($project->update()){
            $user = User::where('client_id', $request->edit_project_id)->first();
            $user->first_name = $request->bussiness_name;
            $user->role_id = $request->role;
            if($request->password != null){
                $user->password = Hash::make($request->password);    
            }
            $user->img = $profile;
            if($user->update()){
                if($request->client_profile != null){
                    $request->client_profile->move(public_path('profile_images'), $profile);
                }    
            }else{
                
                return redirect()->route("projects")->with("error", "Failed to update client");    
            }
            
            return redirect()->route("projects")->with("project_info", "Project ".$request->project_name." updated.");
            
        }else{
            return redirect()->route("projects")->with("project_danger", "Project failed to updated.");
        }
    }
    
    public function getProjectById($id){
        return Project::find($id);
    }

    // Delete
    public function delete(Request $request){
        $project = Project::find($request->id);
        $project_name = $project->name;
        
        if($project->delete()){
            $user = User::where('client_id', $request->id)->first();
            $user->delete();
            return redirect()->route("projects")->with("project_info", "Project ".$project_name." deleted.");
            
        }else{
            return redirect()->route("projects")->with("project_danger", "Project failed to delete.");
        }
    }
    
    
    // Get project
    public function getProject(Request $request){
        $project = Project::find($request->project_id);
        $client = User::where('client_id', $request->project_id)->first();
        $users = User::where('client_id', null)->where('id', '!=', 1)->get();
        $role = Role::find($client->role_id);
        $permissions = Permission::whereIn('id', $role->permissions_id)->get();
        return [
            'project' => $project,
            'client' => $client,
            'users' => $users,
            'roles' => Role::all(),
            "role_id" => User::where('client_id', $project->id)->first()->role_id,
            "permissions" => $permissions
        ];
    }
}
