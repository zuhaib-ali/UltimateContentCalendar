<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;
use App\Models\SubTask;
use App\Models\TaskFile;

class SubTaskController extends Controller
{
    public function revineTask(Request $request){
        // Revining the task where revine is false/0
        if($request->sub_task_id != null){
            $sub_task_unrevined = SubTask::find($request->sub_task_id);
            $sub_task_unrevined->revined = true;
            $sub_task_unrevined->status = 5;
            $sub_task_unrevined->update();
        }
        
        // validating subtask fields
        $request->validate([
            "subject" => "required",
            "description" => "required",
            "main_task_id" => "required",
        ]);
        // creating new subtask
        $subtask_created = SubTask::Create([
            "subject" => $request->subject,
            "description" => $request->description,
            "main_task" => $request->main_task_id,
            "status" => 1,
            "pending_date" => now(),
        ]);

        // If any attachment is given with subtask
        if($request->attachments != null){
            if($subtask_created){
                foreach($request->attachments as $attachment){
                    $task_file_created = TaskFile::create([
                        "file_name" => $attachment->getClientOriginalName(),
                        "sub_task_id" => $subtask_created->id
                    ]);    
                    if($task_file_created){
                        $attachment->move(public_path("task_files"), $attachment->getClientOriginalName());
                    }
                }       
            }
        }


        // Changing task status to revined.
        $task = Task::find($request->main_task_id);   
        $task_name = $task->name;
        $task->status = 5;
        $task->revine_date = now();
        
        if($task->update()){
            return back()->with("task_danger", "Task ".$task_name." Revined.");
        }else{
            return back()->with("task_success", "Task failed to revine");
        }
    }


    // Update task status .
    public function updateSubtaskStatus(Request $request){
        $task =  SubTask::find($request->task_id);
        $task_name = $task->subject;
        // Process status
        if($request->status_id == 2){
            $task->status = (int)$request->status_id;
            $task->in_progress_date = now();
            if($task->update()){
                return back()->with("task_info", "From now task ".$task_name." is in process status.");
            }
        
        // Approve status
        }elseif($request->status_id == 3){
            $task->status = (int)$request->status_id;
            $task->approve_date = now();
            if($task->update()){
                return back()->with("task_info", "Task ".$task_name." Approved.");
            }
        
        // Complete status
        }elseif($request->status_id == 4){
            $task->status = (int)$request->status_id;
            $task->complete_date = now();
            if($task->update()){
                return back()->with("task_success", "Task ".$task_name." sent for approval.");
            }
        
        // Pending status
        }elseif($request->status_id == 1){
            $task->status = (int)$request->status_id;
            $task->pending_date = now();
            if($task->update()){
                return back()->with("task_warning", "From now task ".$task_name." is in process status.");
            }
        }
    }
}
