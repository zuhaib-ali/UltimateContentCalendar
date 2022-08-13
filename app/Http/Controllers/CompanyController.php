<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
use App\Models\User;
use App\Models\Role;

class CompanyController extends Controller
{
    public function index(){
        return view("company.companies", [
            "companies" => User::join("companies", "users.company_id", "companies.id")
                ->select("users.*", "companies.id as id_of_company")
                ->where("users.company_id", "!=", null)
                ->get(),
            "roles" => Role::all()
        ]);
    }
    
    public function create(Request $request){
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required",
            "role" => "required"
        ]);

        $profile = null;

        $company = Company::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role_id" => $request->role
        ]);
        
        if(!empty($company)){
            if(!empty($request->profile)){
                $profile = $company->id."_".$request->profile->getClientOriginalName();    
                
            }
            
            $user = User::create([
                "img" => $profile,
                "first_name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password),
                "role_id" => $request->role,
                "company_id" => $company->id,
                "created_by" => $request->session()->get('user')->id
            ]);
            
            if(!empty($request->profile)){
                $request->profile->move(public_path("profile_images"), $profile);
            }
            
            return back()->with("success", "Company ".$request->name." created");
            
        }else{
            return back()->with("failed", "Failed to create company".$request->name);
        }
    }
    
    
    // Update company
    public function update(Request $request){
        $company = Company::find($request->id);
        $company->name = $request->name;
        $company->role_id = $request->role;
        
        if($company->update()){
            $user = User::where("company_id", $request->id)->first();
            $user->first_name = $request->name;
            $user->role_id = $request->role;
            if(!empty($request->password)){
                $user->password = Hash::make($request->password);
            }
            $user->update();
            
            return back()->with("success", $request->name." updated");
            
        }else{
            return back()->with("failed", "Failed to update.");
        }
    }
    
    public function delete(Request $request){
        if(Company::find($request->id)->delete()){
            $user = User::where("company_id", $request->id)->first();
            $company_name = $user->first_name;
            if($user->delete()){
                return back()->with("info", $company_name." deleted");    
            }
            
        }else{
            return back()->with("failed", "Failed to delete company");    
        }
    }
    
    // Get company by id
    public function getCompanyById(Request $request){
        return [
            "company" => User::join("companies", "users.company_id", "companies.id")
                ->select("users.*", "companies.id as id_of_company")
                ->where("users.company_id", $request->id)
                ->first(),
                
            "roles" => Role::all()
        ];
    }
}
