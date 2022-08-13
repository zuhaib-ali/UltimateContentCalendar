<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    public function index(){
        return view("packages.index", ["packages" => Package::all()]);
    }
    
    public function create(Request $request){
        $packages = Package::all();
        if(!empty($packages)){
            if($packages->count() >= 3){
                return back()->with("failed", "Only 3 subscriptions are allowed to created.");
            }
        }
        
        $request->validate([
            "name" => "required",
            "amount" => "required|numeric",
            "description" => "required"
        ]);
        
        $package = Package::create([
            "name" => $request->name,
            "amount" => $request->amount,
            "description" => $request->description
        ]);
        
        if($package){
            return back()->with("message", "Package created");
            
        }else{
            return back()->with("message", "Failed to creaet package");
        }
    }
    
    // Update 
    public function update(Request $request){
        $request->validate([
            "name" => "required",
            "amount" => "required|numeric",
            "description" => "required"
        ]);
        
        $package = Package::find($request->id);
        $package->name = $request->name;
        $package->amount = $request->amount;
        $package->description = $request->description;
        if($package->update()){
            return back()->with("message", "Package updated");
            
        }else{
            return back()->with("message", "Failed to update.");
        }
    }
    
    // Delete
    public function delete(Request $request){
        if(Package::find($request->id)->delete()){
            return back()->with("message", "Package delete");
            
        }else{
            return back()->with("message", "Package failed to delete");
        }
    }
    
    public function getPackageById(Request $request){
        return Package::find($request->id);
    }
}
