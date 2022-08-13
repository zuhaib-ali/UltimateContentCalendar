<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use App\Models\SubTask;
use App\Models\TaskFile;
use App\Models\Color;
use App\Models\Subscription;
use Carbon\Carbon;

class TaskController extends Controller
{
    // Index
    public function index(Request $request){
        if($request->session()->get("user")->role_id == 1){
            return view("tasks", [
                "tasks" => Task::leftJoin("colors", "tasks.status", "=", "colors.id")
                ->leftJoin("users", "tasks.user_id", "=", "users.id")
                ->leftJoin("projects", "tasks.project_id", "=", "projects.id")
                ->select(
                    "tasks.*", 
                    "projects.name as project_name",
                    "projects.id as project_id",
                    "projects.deadline as project_deadline",
                    "users.first_name",
                    "users.last_name",
                    "colors.id as color_id",
                    "colors.status_name",
                    "colors.status_color"
                )
                ->orderBy('tasks.deadline', 'DESC')
                ->get(),

                "sub_tasks" => SubTask::join("colors", "sub_tasks.status", "=", "colors.id")
                ->join("task_files", "sub_tasks.id", "=", "task_files.id")
                ->select(
                    "sub_tasks.*",
                    "colors.id as color_id",
                    "colors.status_name",
                    "colors.status_color"
                )
                ->get(),
                "projects" => Project::all(),
                "users" => User::where("id", "!=", 1)->where('client_id', null)->get(),
                "colors" => Color::all(),
                "task_files" => TaskFile::where("approved", true)->get(),
            ]);

        }else{
            
            // Clients Projects
            if($request->session()->get('user')->client_id != null){
                return view("tasks", [
                    "tasks" => Task::join("projects", "tasks.project_id", "=", "projects.id")
                    ->leftJoin("users", "tasks.user_id", "=", "users.id")
                    ->leftJoin("colors", "tasks.status", "=", "colors.id")
                    ->where("tasks.project_id", $request->session()->get("user")->client_id)
                    ->select(
                        "tasks.*", 
                        "projects.name as project_name",
                        "projects.id as project_id",
                        "projects.deadline as project_deadline",
                        "users.first_name",
                        "users.last_name",
                        "colors.id as color_id",
                        "colors.status_name",
                        "colors.status_color"
                    )
                    ->orderBy('tasks.due_to_date', 'DESC')
                    ->get(),
                    
                    "projects" => Project::all(),
                    "sub_tasks" => SubTask::join("colors", "sub_tasks.status", "=", "colors.id")
                    ->join("task_files", "sub_tasks.id", "=", "task_files.id")
                    ->select(
                        "sub_tasks.*",
                        "colors.id as color_id",
                        "colors.status_name",
                        "colors.status_color"
                    )
                    ->get(),
                    "users" => User::where("id", "!=", 1)->get(),
                    "colors" => Color::all(),
                    "task_files" => TaskFile::where("approved", true)->get(),
                ]);    
                
            // User Projects
            }else{
                return view("tasks", [
                    "tasks" => Task::leftJoin("projects", "tasks.project_id", "=", "projects.id")
                    ->leftJoin("users", "tasks.user_id", "=", "users.id")
                    ->leftJoin("colors", "tasks.status", "=", "colors.id")
                    ->where("tasks.user_id", $request->session()->get("user")->id)
                    ->select(
                        "tasks.*", 
                        "projects.name as project_name",
                        "projects.id as project_id",
                        "projects.deadline as project_deadline",
                        "users.first_name",
                        "users.last_name",
                        "colors.id as color_id",
                        "colors.status_name",
                        "colors.status_color"
                    )
                    ->orderBy('tasks.due_to_date', 'DESC')
                    ->get(),
                    
                    "projects" => Project::all(),
                    "sub_tasks" => SubTask::join("colors", "sub_tasks.status", "=", "colors.id")
                    ->join("task_files", "sub_tasks.id", "=", "task_files.id")
                    ->select(
                        "sub_tasks.*",
                        "colors.id as color_id",
                        "colors.status_name",
                        "colors.status_color"
                    )
                    ->get(),
                    "users" => User::where("id", "!=", 1)->get(),
                    "colors" => Color::all(),
                    "task_files" => TaskFile::where("approved", true)->get(),
                ]);
            }
        }
    }

    // Create
    public function create(Request $request){
        $task_created_date = '';
        $task = '';
        $create_task = '';
        
        $request->validate([
            "task_name" => "required",
            'task_files.*' => 'file|mimes:ppt,pptx,doc,docx,pdf,xls,xlsx,png,jpg,jpeg|max:204800',
        ]);

        // Deadline validation
        if($request->deadline != null){
            if(Carbon::create($request->deadline)->format("y-m-d") < Carbon::create(now())->format("y-m-d")){
                return back()->with("task_danger", "Post date must be equal or after current date");
            }            
        }

        // If auto assinged
        if ($request->auto_assign == 1) {
            $users = DB::table('users')->where('id', '!=', 1)->get();
            // dd($users);
            $auto_tasks = array();
            $user_ids = [];
            foreach ($users as $key => $user) {
                $task = DB::table('tasks')
                    ->where('user_id', $user->id)
                    ->where('status', 1)
                    ->orWhere('status', 2)
                    ->orderBy('deadline', 'DESC')
                    ->first();

                array_push($auto_tasks, $task);
            }
            
            
            $deadline1 = '';
            $users = '';
            
            for ($i = 0; $i < count($auto_tasks); $i++) {
                
                // if null skip step
                if($auto_tasks[$i] == null){
                    continue;
                }
                
                for ($j = $i; $j < count($auto_tasks); $j++) {
                    
                    // if null skip step
                    if($auto_tasks[$j] == null){
                        continue;
                    }
                    
                    if ($auto_tasks[$i]->deadline < $auto_tasks[$j]->deadline) {
                        $deadline1 = $auto_tasks[$i]->deadline;
                        $user = DB::table('users')->where('id', $auto_tasks[$i]->user_id)->first();
                    }
                }
            }
        }
        
        $deadline = null;
        $due_date = null;
        
        // if($request->deadline != null){
        //     $deadline = $request->deadline;
        //     if($request->due_to_date != null){
        //         $due_date = $request->due_to_date;
                
        //         // Due date must be after or equal to post date.
        //         if(Carbon::create($request->due_to_date)->format('y-m-d') < Carbon::create($request->deadline)->format('y-m-d')){
        //             return back()->with('task_danger', 'Post date must be after or equal to due date');
        //         }            
                
        //     }else{
        //         $due_date = Carbon::create($request->deadline)->addWeeks(2);
        //     }
        // }
        
        
        
        // Deadline not null
        if($request->deadline != null){
            $deadline = $request->deadline;
            
        }
        
        
        // Due date not null
        if($request->due_to_date != null){
            $due_date = $request->due_to_date;
        }
        

        // creating task
        if ($request->created_date != NULL) {
            $task = [
                "name" => $request->task_name,
                "description" => $request->description,
                "caption" => $request->caption,
                "caption_status" => $request->caption_status,
                "project_id" => $request->project_id,
                "user_id" => $request->user_id,
                "pending_date" => now(),
                "deadline" => $deadline,
                "due_to_date" => $due_date,
                "created_date" => $request->created_date . ' ' . date("h:i:s"),
                "created_by" => $request->session()->get('user')->id
            ];
            $create_task = DB::table('tasks')->insertGetId($task);
        } else {

            $task = [
                "name" => $request->task_name,
                "description" => $request->description,
                "caption" => $request->caption,
                "caption_status" => $request->caption_status,
                "project_id" => $request->project_id,
                "user_id" => $request->user_id,
                "pending_date" => now(),
                "deadline" => $deadline,
                "due_to_date" => $due_date,
                "created_date" => now(),
                "created_by" => $request->session()->get('user')->id
            ];
            $create_task = DB::table('tasks')->insertGetId($task);
        }

        // if files exists, store files.
        if ($request->task_files != null) {
            foreach ($request->task_files as $file_name) {
                TaskFile::Create([
                    "file_name" => $file_name->getClientOriginalName(),
                    "task_id" => $create_task,
                ]);

                $file_name->move(public_path("task_files"), $file_name->getClientOriginalName());
            }
        }
        
        if ($create_task == true) {
            return back()->with("task_success", "Task " . $request->task_name . " created.");
            
        } else {
            return back()->with("task_danger", "Task failed to created.");
        }
    }
    
    // Update
    public function update(Request $request){
        $request->validate([
            "task_name" => "required",
            'task_files.*' => 'file|mimes:ppt,pptx,doc,docx,pdf,xls,xlsx,png,jpg,jpeg|max:204800'
        ]);
        
        // Deadline validation
        if($request->deadline != null){
            if(Carbon::create($request->deadline)->format("y-m-d") < Carbon::create(now())->format("y-m-d")){
                return back()->with("task_danger", "Post date must be equal or after current date");
            }            
        }
        
        $deadline = null;
        $due_date = null;
        
        
        // if($request->deadline != null){
        //     $deadline = $request->deadline;
        //     if($request->due_to_date != null){
        //         $due_date = $request->due_to_date;
                
        //         // Due date must be after or equal to post date.
        //         if(Carbon::create($request->due_to_date)->format('y-m-d') < Carbon::create($request->deadline)->format('y-m-d')){
        //             return back()->with('task_danger', 'Post date must be after or equal to due date');
        //         }            
                
        //     }else{
        //         $due_date = Carbon::create($request->deadline)->addWeeks(2);
        //     }
        // }
        
        // Deadline not null
        if($request->deadline != null){
            $deadline = $request->deadline;
        }
        
        
        // Due date not null
        if($request->due_to_date != null){
            $due_date = $request->due_to_date;
        }
        
        $task = Task::find($request->task_id);
        
        $task_name = $task->name;

        $task->name = $request->task_name;
        $task->description = $request->description;
        $task->caption = $request->caption;
        $task->caption_status = $request->caption_status;
        $task->project_id = $request->project_id;
        $task->user_id = $request->user_id;
        $task->deadline = $deadline;
        $task->due_to_date = $due_date;
        
        if($task->update()){
            // if files exists, store files.
            if ($request->task_files != null) {
                foreach ($request->task_files as $file_name) {
                    TaskFile::Create([
                        "file_name" => $file_name->getClientOriginalName(),
                        "task_id" => $request->task_id,
                    ]);
                    $file_name->move(public_path("task_files"), $file_name->getClientOriginalName());
                }
            }
            return back()->with("task_info", $request->task_name." updated.");
        }else{
            return back()->with("task_danger", "Task failed to updated.");
        }
    }
    
    
    
    public function uploadExtraFiles(Request $request){
        $request->validate([
            'task_files.*' => 'file|mimes:ppt,pptx,doc,docx,pdf,xls,xlsx,png,jpg,jpeg|max:204800'
        ]);
        
        if($request->session()->get("user")->id == 1){
            if ($request->task_files != null) {
                foreach ($request->task_files as $file_name) {
                    TaskFile::Create([
                        "file_name" => $file_name->getClientOriginalName(),
                        "task_id" => $request->task_id,
                        "approved" => true
                    ]);
                    $file_name->move(public_path("task_files"), $file_name->getClientOriginalName());
                }
            }    
            
        }else{
            if ($request->task_files != null) {
                foreach ($request->task_files as $file_name) {
                    TaskFile::Create([
                        "file_name" => $file_name->getClientOriginalName(),
                        "task_id" => $request->task_id,
                        "approved" => false
                    ]);
                    $file_name->move(public_path("task_files"), $file_name->getClientOriginalName());
                }
            }    
        }
        
        return back()->with("task_info", "Files Uploaded");
    }
    
    
    
    public function getTaskById($id){
        return Task::find($id);
    }
    
    
    
    

    // Delete
    public function delete(Request $request){
        $task = Task::find($request->id);
        $task_name = $task->name;
        if($task->delete()){
            return back()->with("task_info", $task_name." deleted.");
        }else{
            return back()->with("task_danger", "Task failed to delete.");
        }
    }

    // Update task status .
    public function updateStatus(Request $request){
        $task =  Task::find($request->task_id);
        $task_name = $task->name;

        // In progress status
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
        
        // Revine status
        }elseif($request->status_id == 5){
            $task->status = (int)$request->status_id;
            $task->revine = now();
            $task->parent_id += 1;
            if($task->update()){
                return back()->with("task_danger", "Task ".$task_name." rejected.");
            }
        }
    }

    // Add task attachments
    public function addTaskAttachments(Request $request){
        $task_attachments = false;
        foreach($request->task_attachments as $attachment){
            $file_created = TaskFile::create([
                "file_name" => $attachment->getClientOriginalName(),
                "task_id" => $request->task_id,
            ]);

            if($file_created){
                $task_attachments = true;

                $file_stored = $attachment->move(public_path("task_files"), $attachment->getClientOriginalName());
                if($file_stored){
                    $task_attachments = true;
                }else{
                    $task_attachments = false;
                }

            }else{
                $task_attachments = false;
            }
            
        }
        if($task_attachments){
            return back()->with("task_success", "Attachments added");
        }else{
            return back()->with("task_danger", "Failed to add task attachments.");
        }
    }


    public function getTask(Request $request){
        return $request->data;
    }
    
    public function get_notified_tasks(){
        // echo session()->get('user')->id;
        $notifications = DB::table('tasks')
        ->join("projects", "tasks.project_id", "=", "projects.id")
        ->join("users", "tasks.user_id", "=", "users.id")
        ->join("colors", "tasks.status", "=", "colors.id")
        ->select(
            "tasks.*", 
            "projects.name as project_name",
            "projects.id as project_id",
            "projects.deadline as project_deadline",
            "users.first_name",
            "users.last_name",
            "colors.id as color_id",
            "colors.status_name",
            "colors.status_color"
        )
        ->where(
            [
                'tasks.user_id' => session()->get('user')->id,
                'tasks.status' => 1,
                'tasks.view'    =>  0
            ]
        )->get();
        // dd($notifications);
        return view('notified_tasks')->with(
            [
                'tasks' =>  $notifications  
            ]
        );
    
    }
    
    
    public function read_notification($task_id){
        // return $task_id;
        $update = DB::table('tasks')->where('id',$task_id)->update(['view'=>1]);
        if($update == true){
            return DB::table('tasks')->where(['user_id' => session()->get('user')->id,'status' => 1, 'view'=>0])->get();
        }
    }
    
    public function read_all_notification(){
        
        $update =  DB::table('tasks')->update(['view'=>1]);
        if($update == true){
            return DB::table('tasks')->where(['user_id' => session()->get('user')->id,'status' => 1, 'view'=>0])->get();
        }
    }
    
    
    
    // Dummy calender
    public function dummyCalendar(Request $request){
        if($request->session()->get('user')->role_id == 1){
            $past_seven_days = [];
            $client_projects = [];
            $users = [];
            
            for($i=0; $i<7; $i++){
                array_push($past_seven_days, Carbon::now()->addDays($i));
            }
            
            // Clients 
            $clients_id = collect(Task::whereBetween("tasks.deadline", [Carbon::now()->subDays(1), Carbon::now()->addDays(6)])->get());
            $clients = Project::whereIn('id', $clients_id->unique('project_id')->pluck('project_id'))->get();
            
            foreach($clients_id->unique('project_id')->pluck('project_id') as $client_id){
                array_push($client_projects, 
                    Task::leftJoin('projects', 'tasks.project_id', 'projects.id')
                    ->leftJoin('users', 'tasks.user_id', 'users.id')
                    ->select(
                        'tasks.*',
                        'projects.name as client_name',
                        'users.first_name',
                        'users.last_name'
                    )->where('tasks.project_id', $client_id)
                    ->whereBetween("tasks.deadline", [Carbon::now()->subDays(1), Carbon::now()->addDays(6)])
                    ->get()
                );
            }
            
            
            // Unassigned deadline projects
            $unassigned_deadline_projects = Task::where("deadline", null)->get();
                
                
            // Unassigned deadline projects
            $unassigned_client_projects = Task::where('project_id', null)->get();
                
            // Unassigned deadline projects
            $unassigned_projects = Task::where("user_id", null)->get();
            
            // Unassigned due date projects
            $unassigned_due_date_projects = Task::where("due_to_date", null)->get();
                
            
            foreach($client_projects as $project){
                foreach($project->unique('user_id')->pluck('user_id') as $id){
                    array_push($users, $id);
                }
            }
            
            // Returing calender index view.
            return view('calender.index', [
                'clients' => $clients,
                'projects' => $client_projects,
                "all_clients" => Project::all(),
                'past_seven_days' => $past_seven_days,
                'status_colors' => Color::all(),
                'from' => Carbon::now()->format('d M, y'),
                'to' => Carbon::now()->addDays(6)->format('d M, y'),
                'calender_length' => 6,
                'colors' => Color::all(),
                'users' => User::whereIn('id', $users)->get(),
                'unassigned_deadline_projects' => $unassigned_deadline_projects,
                'unassigned_client_projects' => $unassigned_client_projects,
                'unassigned_projects' => $unassigned_projects,
                'unassigned_due_date_projects' => $unassigned_due_date_projects
            ]);    
            
        }else{
            
            $past_seven_days = [];
            $client_projects = [];
            $users = [];
            $clients_id = null;
            $clients = null;
            
            for($i=0; $i<7; $i++){
                array_push($past_seven_days, Carbon::now()->addDays($i));
            }
            
            if($request->session()->get('user')->client_id != null){
                // Clients 
                $clients_id = collect(Task::whereBetween("tasks.deadline", [Carbon::now()->subDays(1), Carbon::now()->addDays(6)])->where('project_id', $request->session()->get('user')->client_id)->get());
                $clients = Project::whereIn('id', $clients_id->unique('project_id')->pluck('project_id'))->get();  
                
            }else{
                $clients_id = collect(Task::whereBetween("tasks.deadline", [Carbon::now()->subDays(1), Carbon::now()->addDays(6)])->where('user_id', $request->session()->get('user')->id)->get());
                $clients = Project::whereIn('id', $clients_id->unique('project_id')->pluck('project_id'))->get();
            }
            
            foreach($clients_id->unique('project_id')->pluck('project_id') as $client_id){
                array_push($client_projects, 
                    Task::leftJoin('projects', 'tasks.project_id', 'projects.id')->leftJoin('users', 'tasks.user_id', 'users.id')
                    ->select(
                        'tasks.*',
                        'projects.name as client_name',
                        'users.first_name',
                        'users.last_name'
                    )->where('tasks.project_id', $client_id)
                    ->whereBetween("tasks.deadline", [Carbon::now()->subDays(1), Carbon::now()->addDays(6)])
                    ->get()
                );
            }
            
            foreach($client_projects as $project){
                foreach($project->unique('user_id')->pluck('user_id') as $id){
                    array_push($users, $id);
                }
            }
            
            // Returing calender index view.
            return view('calender.index', [
                'clients' => $clients,
                'projects' => $client_projects,
                "all_clients" => Project::all(),
                'past_seven_days' => $past_seven_days,
                'status_colors' => Color::all(),
                'from' => Carbon::now()->format('d M, y'),
                'to' => Carbon::now()->addDays(6)->format('d M, y'),
                'calender_length' => 6,
                'colors' => Color::all(),
                'users' => User::whereIn('id', $users)->get()
            ]);
        }
    }
    
    
    // Calender record by date.
    public function recordOnDate(Request $request){
        $days_for_loop_initial = 6;
        $past_days = [];
        $client_projects = [];
        $users = [];
        $clients = null;
        
        $start_date = new Carbon($request->start_date);
        $end_date = new Carbon($request->end_date);
        // $end_date = Carbon::create($request->start_date)->addDays(13);
        $calender_length = $start_date->diffInDays($end_date);
        
        for($i=0; $i<=$calender_length; $i++){
            array_push($past_days, Carbon::create($start_date)->addDays($i));
        }

        $clients_id = collect(Task::whereBetween("tasks.deadline", [$start_date, $end_date])->get());
        $clients = Project::whereIn('id', $clients_id->unique('project_id')->pluck('project_id'))->get();
        
        foreach($clients_id->unique('project_id')->pluck('project_id') as $client_id){
            array_push($client_projects, 
                Task::join('projects', 'tasks.project_id', 'projects.id')
                ->leftJoin('users', 'tasks.user_id', 'users.id')
                ->select(
                    'tasks.*',
                    'projects.name as client_name',
                    'users.first_name',
                    'users.last_name'
                )->whereBetween("tasks.deadline", [$start_date, $end_date])
                ->where('tasks.project_id', $client_id)
                ->get()
            );
        }
        
        // Unassigned deadline projects
        $unassigned_deadline_projects = Task::where("deadline", null)->get();
                
        // Unassigned deadline projects
        $unassigned_client_projects = Task::where('project_id', null)->get();
            
        // Unassigned deadline projects
        $unassigned_projects = Task::where("user_id", null)->get();
        
        // Unassigned due date projects
        $unassigned_due_date_projects = Task::where("due_to_date", null)->get();
        
        foreach($client_projects as $project){
            foreach($project->unique('user_id')->pluck('user_id') as $id){
                array_push($users, $id);
            }
        }
        
        
        // Unassigned deadline projects
        $unassigned_deadline_projects = Task::leftJoin('users', 'tasks.user_id', 'users.id')
            ->join("projects", "tasks.project_id", "projects.id")
            ->select(
                'tasks.*',
                'users.first_name',
                'users.last_name',
                'projects.name as client'
                
            )->whereIn("tasks.project_id", $clients->pluck("id"))
            ->where("tasks.deadline", null)
            ->get();
        
        return view('calender.index', [
            'clients' => $clients,
            'projects' => $client_projects,
            "all_clients" => Project::all(),
            'past_seven_days' => $past_days,
            'status_colors' => Color::all(),
            'from' => $start_date->format('d M, y'),
            'to' => $end_date->format('d M, y'),
            'calender_length' => $calender_length,
            'colors' => Color::all(),
            'users' => User::whereIn('id', $users)->get(),
            'unassigned_deadline_projects' => $unassigned_deadline_projects,
            'unassigned_client_projects' => $unassigned_client_projects,
            'unassigned_projects' => $unassigned_projects,
            'unassigned_due_date_projects' => $unassigned_due_date_projects
        ]);
    }
    
    
    
    //  Get projects for 
    public function getProjectInDummyCalender(Request $request, $id){
        $sub_task_files = null;
        
        $sub_task = SubTask::join("colors", "sub_tasks.status", "=", "colors.id")
            ->select(
                "sub_tasks.*",
                "colors.id as color_id",
                "colors.status_name",
                "colors.status_color"
            )
            ->where('sub_tasks.main_task', $id)
            ->first();
        
        if($sub_task != null){
            $sub_task_files = TaskFile::where('sub_task_id', $sub_task->id)->get();
        }
        
        return [
            "task" => Task::leftJoin("projects", "tasks.project_id", "=", "projects.id")
            ->leftJoin("users", "tasks.user_id", "=", "users.id")
            ->join("colors", "tasks.status", "=", "colors.id")
            ->select(
                "tasks.*", 
                "projects.name as project_name",
                "projects.id as project_id",
                "projects.deadline as project_deadline",
                "users.first_name",
                "users.last_name",
                "colors.id as color_id",
                "colors.status_name",
                "colors.status_color"
            )
            ->orderBy('tasks.id', 'DESC')
            ->where('tasks.id', $id)
            ->first(),

            "sub_tasks" => $sub_task,
            "colors" => Color::all(),
            "task_files" => TaskFile::where('task_id', $id)->where("approved", true)->get(),
            "sub_task_files" => $sub_task_files,
            'role_id' => $request->session()->get('user')->role_id,
        ];
    }
    
    
    public function getTaskForUpdate($id){
        return [
            'projects' =>  Project::all(),
            'task' => Task::find($id),
            "users" => User::where("id", "!=", 1)->where("client_id", null)->get()
        ];
    }
    
    public function addDescriptionToClientProject(Request $request){
        $task = Task::find($request->project_id);
        $task->note = $request->note;
        $task->update();
        return back()->with('success', "notes created!");
    }
    
    
    public function createEditorComment(Request $request){
        $task = Task::find($request->id);
        $task->editor_comment = $request->editor_comment;
        if($task->update()){
            return back()->with('task_info', "Comment Created");    
        }else{
            return back()->with('task_info', "Failed to create comment!");
        }
    }
    
    
    // On Hold
    public function onHold(Request $request){
        $task = Task::find($request->id);
        if($request->on_hold == "true"){
            $task->on_hold = true;
            
        }else if($request->on_hold == "false"){
            $task->on_hold = false;
        }
        
        $task->update();
        return $task->on_hold;
    }
    
    
    public function taskApproval(Request $request){
        $task = Task::find($request->id);
        if($task->has_approval == true){
            $task->has_approval = false;   
            
        }else{
            $task->has_approval = true;
        }
        $task->update();
        return $task->has_approval;
    }
}
