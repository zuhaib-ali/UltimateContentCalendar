<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Role;
use App\Models\Subscription;
use App\Models\Package;

class UserController extends Controller
{
    

    // Users
    public function index(){
        if(session()->get('user')->id == 1){
            return view("users", [
                "users" => User::join("roles", "users.role_id", "=", "roles.id")
                ->where("roles.id", "!=", 1)
                ->where("client_id", null)
                ->select(
                    "users.*",
                    "roles.role",
                    "roles.id as role_id",
                    "roles.permissions_id"
                )
                ->get(),
                // "users" => User::all(),
                "roles" => Role::where("id", "!=", 1)->get(),
            ]);    
            
        }else{
            return view("users", [
                "users" => User::join("roles", "users.role_id", "=", "roles.id")
                ->where("roles.id", "!=", 1)
                ->where("client_id", null)
                ->where("created_by", session()->get('user')->id)
                ->select(
                    "users.*",
                    "roles.role",
                    "roles.id as role_id",
                    "roles.permissions_id"
                )
                ->get(),
                // "users" => User::all(),
                "roles" => Role::where("id", "!=", 1)->get(),
            ]);    
        }
        
    }


    
    // Create users
    public function create(Request $request){
        if(User::where(['created_by' => $request->session()->get('user')->id])->get()->count() >= 1){
            $subscription = Subscription::where(["user_id" => session()->get('user')->id, "plan" => 2])->first();
            
            if(empty($subscription) && $request->session()->get('user')->id != 1){
                return view("subscription.index", ["packages" => Package::all()]);
            }    
        }
        
        $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required",
            'profile_image' => 'file|mimes:png,jpg,jpeg|max:204800'
        ]);
        
        $image_name = null;
        if($request->profile_image != null){
            $image_name = time()."_".$request->profile_image->getClientOriginalName();
        }

        $user_create = User::create([
            "img" => $image_name,
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "role_id" => $request->role_id,
            "address" => $request->address,
            "password" => Hash::make($request->password),
            "created_by" => $request->session()->get('user')->id
        ]);

        if($user_create){
            if($request->profile_image != null){
                $request->profile_image->move(public_path("profile_images"), $image_name);
            }
            return redirect()->route("users")->with("user_success", "User ".$request->first_name." ".$request->last_name." created");
        }else{
            return back()->route("users")->with("user_danger", "Failed to create user.");
        }
    }
    
    
    
    // Update
    public function update(Request $request){
        $profile = null;
        $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "role" => "required",
        ]);
        
        if($request->profile_image != null){
            $profile = now()."_".$request->profile_image->getClientOriginalName();
            
        }elseif($request->user_old_profile != null){
            $profile = $request->user_old_profile;
        }
        
        
        $user = User::find($request->user_id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->role_id = $request->role;
        $user->address = $request->address;
        if($user->password != null){
            $user->password = Hash::make($request->password);    
        }
        $user->img = $profile;

        if($user->update()){
            if($request->profile_image != null){
                $profile = now()."_".$request->profile_image->getClientOriginalName();
                $request->profile_image->move(public_path('profile_images'), $profile);
            }
            return redirect()->route("users")->with("user_info", "User ".$user->first_name." ".$user->last_name." updated.");
        }else{
            return redirect()->route("users")->with("user_danger", "User failed to update");
        }
    }



    // Authenticate 
    public function authenticate(Request $request){
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);
        
        
        $user = User::join("roles", "users.role_id", "=", "roles.id")
            ->where("email", $request->email)
            ->select("roles.permissions_id", "users.*")
            ->first();
        
        if(!$user || !Hash::check($request->password, $user->password)){
            return back()->with("auth", "email or password does not exists");
        }
        $request->session()->put("user", $user);
        return redirect()->route("index");
    }
    
    
    public function getUserById($id){
        return User::find($id);
    }
    

    // Delete
    public function delete(Request $request){
        $user = User::find($request->id);
        $user_name = $user->first_name." ".$user->last_name;
        if($user->delete()){
            return redirect()->route("users")->with("user_info", "User ".$user_name." deleted.");
        }else{
            return redirect()->route("users")->with("user_danger", "User failed to deleted.");
        }
    }
}
