<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$request->session()->has("user")){
            return redirect()->route("login");
            
        }
        // elseif($request->is("tasks_notification_wise") || 
        //         url()->current("/read_notification/{task_id}") ||
        //         $request->is("read_all_notification")){
        //         // return $next($request);        
        // }
        else{

            // Index
            if(Route::currentRouteName() == "index"){
                return $next($request);        
            }

            // Roles
            elseif(Route::currentRouteName() == "roles" || 
                Route::currentRouteName() == "add_role_permissions"
                ){
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 1){
                        return $next($request);        
                    }
                }
                return back();
            }
            
            // Roles List
            elseif(Route::currentRouteName() == "manage_roles"){
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 26){
                        return $next($request);        
                    }
                }
                return back();
            }
            
            
            // Edit-Update Role
            elseif(Route::currentRouteName() == "update_role"){
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 24){
                        return $next($request);        
                    }
                }
                return back();
            
            // Delete Role
            }elseif(Route::currentRouteName() == "delete_role"){
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 25){
                        return $next($request);        
                    }
                }
                return back();
            }
            
            // Users
            elseif(
                Route::currentRouteName() == "users"
                // url()->current('/get-user-by-id/{id}')
                ){
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 2){
                        return $next($request);        
                    }
                }
                return back();
                
            }
            
            // Create User
            elseif(Route::currentRouteName() == "add_user"){
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 23){
                        return $next($request);        
                    }
                }
                return back();
            }
            
            // Edit/Update User 
            elseif(Route::currentRouteName() == "update_user"){
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 20){
                        return $next($request);        
                    }
                }
                return back();
            
            // Delete User
            }elseif(Route::currentRouteName() == "delete_user"){
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 21){
                        return $next($request);        
                    }
                }
                return back();
            }
            
            // Clients
            elseif(Route::currentRouteName() == "projects" ||
                // url()->current('/get-client-by-id/{id}') ||
                $request->is("get-client")){
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 3){
                        return $next($request);        
                    }
                }
                return back();
            
            // Edit-Update Client
            }elseif(Route::currentRouteName() == "update-project"){
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 14){
                        return $next($request);        
                    }
                }
                return back();
            
            // Delete Client
            }elseif(Route::currentRouteName() == "delete-project"){
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 15){
                        return $next($request);        
                    }
                }
                return back();
            }
            
            // Add Client
            elseif(Route::currentRouteName() == "add-project"){
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 7){
                        return $next($request);        
                    }
                }
                return back();
            }
            
            // Projects
            elseif(Route::currentRouteName() == "tasks" ||
                Route::currentRouteName() == "get-task" ||
                // url()->current('/get-project-by-id/{id}')
                Route::currentRouteName() == "upload-extra-file"
                ){
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 4){
                        return $next($request);        
                    }
                }
                return back();
                
            // Edit-Update Project
            }elseif(Route::currentRouteName() == "update-task"){
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 17){
                        return $next($request);        
                    }
                }
                return back();
            
            // Delete Project
            }elseif(Route::currentRouteName() == "delete-task"){
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 18){
                        return $next($request);        
                    }
                }
                return back();
            
            // Project Status
            }elseif(Route::currentRouteName() == "task-revine" ||
                Route::currentRouteName() == "update-subtask-status"||
                Route::currentRouteName() == "update-status"
                // url()->current("/approve_task_in_calender/{color_id}/{task_id}") ||
                // url()->current("/in_progres_task/{task_id}") ||
                // url()->current("/complete_task_status/{task_id}")||
                // url()->current("/in_progres_task/{task_id}/sub_task") || 
                // url()->current("/complete_sub_task/{task_id}/sub_task")
                ){
                    
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 22){
                        return $next($request);        
                    }
                }
                return back();
            }
            
            // Add Project
            elseif(Route::currentRouteName() == "add-task"){
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 8){
                        return $next($request);        
                    }
                }
                return back();
            }
            
            
            
            // Calender
            elseif(
                $request->is("task_calender_wise") ||
                $request->is("get_tasks_for_calender")
                // url()->current("/get_task_detail_for_calender/{id}") || 
                // url()->current("/download_file_in_calender/{file}")
                ){
            
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 6){
                        return $next($request);        
                    }
                }
                return back();
            }
            
            elseif($request->is("update-comment") ||
                $request->is("delete-comment")){
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 9){
                        return $next($request);        
                    }
                }
                return back();
            }
            
            elseif($request->is("comments") ||
                $request->is("comments_view") ||
                $request->is("get-comment") ||
                // $request->is("/comment_reject/{id}") ||
                $request->is("/comment_approve")){
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 10){
                        return $next($request);        
                    }
                }
                return back();
            }
            
            elseif($request->is("comment") ||
                $request->is("create_comment")){
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 11){
                        return $next($request);        
                    }
                }
                return back();
            }
            
            elseif(Route::currentRouteName() == "settings" ||
                Route::currentRouteName() == "set-colors"){
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 5){
                        return $next($request);        
                    }
                }
                return back();
            }
            
            elseif($request->is('dummyCal') ||
                Route::currentRouteName() == "add_description_to_client_project" ||
                $request->is('record_on_date')
                // url()->current('/getProjectInDummyCalender/{id}') ||
                // url()->current('/dummyCalenderGetTask/{id}')
                ){
                
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 12){
                        return $next($request);        
                    }
                }
                return back();
                
            }
            
            elseif(Route::currentRouteName() == "create_editor_comment"){
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 28){
                        return $next($request);        
                    }
                }
                return back();
                
            }
            
            // Packages permissions
            elseif(
                Route::currentRouteName() == "packages" ||
                Route::currentRouteName() == "create_package" ||
                Route::currentRouteName() == "update_package" ||
                Route::currentRouteName() == "delete_package" ||
                Route::currentRouteName() == "get_package_by_id"
            ){
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 29){
                        return $next($request);        
                    }
                }
                return back();
                
            }
            
            
            // Companies
            elseif(Route::currentRouteName() == "companies"){
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 30){
                        return $next($request);        
                    }
                }
                return back();
            }
            
            // Create Company
            elseif(Route::currentRouteName() == "create-company"){
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 31){
                        return $next($request);        
                    }
                }
                return back();
            }
            
            // Update Company
            elseif(Route::currentRouteName() == "update-company"){
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 32){
                        return $next($request);        
                    }
                }
                return back();
            }
            
            // Delete Company
            elseif(Route::currentRouteName() == "delete-company"){
                foreach(json_decode($request->session()->get("user")->permissions_id, TRUE) as $per){
                    if($per == 33){
                        return $next($request);        
                    }
                }
                return back();
            }
            
        } 

        // return $next($request);   
    }
    
}
