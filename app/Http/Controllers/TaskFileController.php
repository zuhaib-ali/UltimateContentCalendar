<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TaskFile;

class TaskFileController extends Controller
{
    // task calendar wise
    public function task_calender_wise()
    {
        // $tasks = DB::table('tasks')->get();
        $tasks      =   DB::table('tasks')->get();
        $projects   =   DB::table('projects')->get();
        $colors     =   DB::table('colors')->get();
        $users      =   DB::table('users')->where('role_id', '!=', 1)->get();
        return view('calender.calender', compact('tasks','projects','users','colors'));
    }


    // get tasks for calendar
    public function get_tasks_for_calender()
    {
        if(session()->get('user')->role_id == 1){
            return DB::table('tasks')
            ->join('users','tasks.user_id','users.id')
            ->join('projects','tasks.project_id','projects.id')
            ->join('colors', 'tasks.status', 'colors.id')
            ->select(
                'tasks.*',
                'colors.status_color as color',
                'users.first_name as fname',
                'users.last_name as lname',
                'users.id as user_id',
                'projects.name as project_name'
                )
            ->get();
        }else{
            return DB::table('tasks')
            ->join('users','tasks.user_id','users.id')
            ->join('projects','tasks.project_id','projects.id')
            ->join('colors', 'tasks.status', 'colors.id')
            ->select(
                'tasks.*', 
                'colors.status_color as color',
                'users.first_name as fname',
                'users.last_name as lname',
                'projects.name as project_name'
                )
            ->where('user_id',session()->get('user')->id)
            ->get();
        }
    }

    // Get task deatil for calendar
    public function get_task_detail_for_calender($id)
    {
        $task_files = null;
        
        $task   =    DB::table('tasks')
            ->join('users','tasks.user_id', "=",'users.id')
            ->join('colors', 'tasks.status', 'colors.id')
            ->select(
                'tasks.*',
                'colors.status_color as color',
                'colors.id as color_id',
                'colors.status_name as status_name',
                'users.first_name as fname',
                'users.last_name as lname'
            )
            ->where('tasks.id', $id)->distinct()
            ->first();
            
            
            $sub_task = DB::table("sub_tasks")
                ->join("tasks", "sub_tasks.main_task", "=", "tasks.id")
                ->join("colors", "sub_tasks.status", "=", "colors.id")
                ->select(
                    "sub_tasks.*",
                    "colors.id as color_id",
                    "colors.status_name",
                    "colors.status_color"
                )
                ->where([
                    "revined" => false,
                    "main_task" => $id
                ])
                ->first();
            
            if($sub_task != null){
                $task_files = DB::table("task_files")
                    ->where("task_id", $id)
                    ->orWhere("sub_task_id", $sub_task->id)
                    ->get();    
            }else{
                $task_files = DB::table("task_files")
                    ->where("task_id", $id)
                    ->get();    
            }
            
            $colors = DB::table("colors")->get();
            
            return [$task, $task_files, $sub_task, $colors];
            
    }


    // Download file
    public function download_file($var)
    {
        $file = public_path("task_files") . "/" . $var;
        $headers = array(
            "Content-Type : multipart/form-data",
        );
        return response()->download($file, $var, $headers);
    }


    // Change status
    public function change_status($status, $task_id)
    {
        $update = DB::table('tasks')->where('id', $task_id)->update(['status' => 3]);
        if ($update == true) {
            return back();
        } else {
            echo 'error';
        }
    }
    
    public function task_status_to_progress($task_id){
        $update = DB::table('tasks')->where('id', $task_id)->update(['status' => 2]);
        if ($update == true) {
            return back();
        } else {
            echo 'error';
        }
    }
    
    public function task_status_to_complete($task_id){
        $update = DB::table('tasks')->where('id', $task_id)->update(['status' => 4]);
        if ($update == true) {
            return back();
        } else {
            echo 'error';
        }
    }
    
    public function subTaskToPgrgress($sub_task_id){
        $update = DB::table('sub_tasks')->where('id', $sub_task_id)->update(['status' => 2]);
        if ($update == true) {
            return back();
        } else {
            echo 'error';
        }
    }
    
    public function subTaskToComplete($sub_task_id){
        $update = DB::table('sub_tasks')->where('id', $sub_task_id)->update(['status' => 4]);
        if ($update == true) {
            return back();
        } else {
            echo 'error';
        }
    }
    
    public function approveTaskFile(Request $request){
        $task_file = TaskFile::find($request->id);
        $task_file->approved = true;
        if($task_file->update()){
            return true;
            
        }else{
            return false;
        }
    }
    
    
    public function getUnapprovedTaskFiles(){
        return TaskFile::where("approved", false)->get();
    }
}
