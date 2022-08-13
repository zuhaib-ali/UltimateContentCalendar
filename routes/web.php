<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\TaskFile;

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SubTaskController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\TaskFileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\CompanyController;

use App\Models\Comment;
use App\Models\Company;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\Color;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(["AuthenticateAccess"])->group(function(){

        // Index
        Route::get('/', function (Request $request) {
            
            if(session()->get('user')->role_id == 1){
                return view("index", [
                    "comments" => Comment::all(),
                    "roles" => Role::where("id", "!=", 1)->get(),
                    "users" => User::where("role_id", "!=", 1)->where('client_id', null)->get(),
                    "projects" => Project::all(),
                    "tasks" => Task::all(),
                    "companies" => Company::all(),
                ]);    
                
            }else{
                if(session()->get('user')->client_id != null){
                    return view("index", [
                        "comments" => Comment::all(),
                        "roles" => Role::where("id", "!=", 1)->get(),
                        "users" => User::where("role_id", "!=", 1)->where('created_by', session()->get('user')->id)->get(),
                        "projects" => Project::where("created_by", session()->get('user')->id)->get(),
                        "tasks" => Task::leftJoin("projects", "tasks.project_id", "=", "projects.id")
                            ->join("users", "tasks.user_id", "=", "users.id")
                            ->join("colors", "tasks.status", "=", "colors.id")
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
                            ->get()
                    ]); 
                    
                }elseif(session()->get('user')->company_id != null){
                    return view("index", [
                        "comments" => Comment::all(),
                        "roles" => Role::where("id", "!=", 1)->get(),
                        "users" => User::where("role_id", "!=", 1)->where('created_by', session()->get('user')->id)->get(),
                        "projects" => Project::where("created_by", session()->get('user')->id)->get(),
                        "tasks" => Task::join("projects", "tasks.project_id", "=", "projects.id")
                            ->join("users", "tasks.user_id", "=", "users.id")
                            ->join("colors", "tasks.status", "=", "colors.id")
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
                            ->get()
                    ]); 
                    
                }else{
                    return view("index", [
                        "comments" => Comment::all(),
                        "roles" => Role::where("id", "!=", 1)->get(),
                        "users" => User::where("role_id", "!=", 1)->where('created_by', session()->get('user')->id)->get(),
                        "projects" => Project::where("created_by", session()->get('user')->id)->get(),
                        "tasks" => Task::join("projects", "tasks.project_id", "=", "projects.id")
                            ->join("users", "tasks.user_id", "=", "users.id")
                            ->join("colors", "tasks.status", "=", "colors.id")
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
                            ->get()
                    ]); 
                }
            }
        })->name("index");
    
        // Roles
        Route::get("/roles", [RoleController::class, "index"])->name("roles");
        Route::get("/manage_roles", [RoleController::class, "manageRolesView"])->name("manage_roles");
        Route::post("/add_role_permissions", [RoleController::class, "create"])->name("add_role_permissions");
        Route::post("/update_role", [RoleController::class, "update"])->name("update_role");
        Route::post("/delete_role", [RoleController::class, "delete"])->name("delete_role");

        // Users
        Route::get("/users", [UserController::class, "index"])->name("users");
        Route::post("/users/add", [UserController::class, "create"])->name("add_user");
        Route::post("/users/update", [UserController::class, "update"])->name("update_user");
        Route::post("/users/delete", [UserController::class, "delete"])->name("delete_user");

        // Clients
        Route::get("/clients", [ProjectController::class, "index"])->name("projects");
        Route::post("/clients/add", [ProjectController::class, "create"])->name("add-project");
        Route::post("/clients/update", [ProjectController::class, "update"])->name("update-project");
        Route::post("/clients/delete", [ProjectController::class, "delete"])->name("delete-project");
        Route::get("/get-client", [ProjectController::class, "getProject"])->name("get-project");
        
        // Companies
        Route::get("companies", [CompanyController::class, "index"])->name("companies");
        Route::post("company-create", [CompanyController::class, "create"])->name("create-company");
        Route::post("company-update", [CompanyController::class, "update"])->name("update-company");
        Route::post("company-delete", [CompanyController::class, "delete"])->name("delete-company");
        
        
        // Projects
        Route::get("/projects", [TaskController::class, "index"])->name("tasks");
        Route::post("/projects/add", [TaskController::class, "create"])->name("add-task");
        Route::post("/projects/delete", [TaskController::class, "delete"])->name("delete-task");
        Route::post("/projects/update", [TaskController::class, "update"])->name("update-task");
        Route::get("/projects/update/status", [TaskController::class, "updateStatus"])->name("update-status");
        Route::get("/get-task", [TaskController::class, "getTask"])->name("get-task");
        Route::post("/create-editor-comment", [TaskController::class, "createEditorComment"])->name("create_editor_comment");
        
        // Upload Extra Files
        Route::post("/upload-extra-files", [TaskController::class, "uploadExtraFiles"])->name("upload-extra-file");

        // Sub tasks
        Route::post("task/revine", [SubTaskController::class, "revineTask"])->name("task-revine");
        Route::get("/tasks/sub_task/update/status", [SubTaskController::class, "updateSubtaskStatus"])->name("update-subtask-status");

        // Set colors
        Route::post("/settings/set-colors", [ColorController::class, "setColors"])->name("set-colors");

        // Settings
        Route::get("/settings", function(){
            return view("settings",[
                "settings_colors" => Color::all(),
            ]);
        })->name("settings");


        // (CALENDAR)  - TaskFileController 
        // Route::get('/task_calender_wise',[TaskFileController::class,'task_calender_wise']);
        // Route::get('/get_tasks_for_calender',[TaskFileController::class,'get_tasks_for_calender']);
        // Route::get('/get_task_detail_for_calender/{id}',[TaskFileController::class,'get_task_detail_for_calender']);
        // Route::get('/download_file_in_calender/{file}',[TaskFileController::class,'download_file'])->name("download-file");
        
        
        // DummyCalender
        Route::get("/dummyCal", [TaskController::class, 'dummyCalendar'])->name('dummyCal');
        Route::get('record_on_date', [TaskController::class, 'recordOnDate'])->name('record_on_date');
        Route::get('/dummy_calender_data', [TaskController::class, 'dummyCalenderData'])->name('dummy_calender_data');
        Route::post('/add_description_to_client_project', [TaskController::class, 'addDescriptionToClientProject'])->name('add_description_to_client_project');

        // Packages
        Route::get('/packages', [PackageController::class, "index"])->name("packages");
        Route::post('/create-packages', [PackageController::class, "create"])->name("create_package");
        Route::post('/update-packages', [PackageController::class, "update"])->name("update_package");
        Route::post('/delete-packages', [PackageController::class, "delete"])->name("delete_package");
        Route::post('/get-package-by-id', [PackageController::class, "getPackageById"])->name("get_package_by_id");
        
});

// Comments
Route::get("/comments_view", [CommentController::class, "index"]);
Route::get("/comment", [CommentController::class, "commentView"]);
Route::post("/create_comment", [CommentController::class, "create"]);
Route::get("/get-comment", [CommentController::class, "getComment"]);
Route::post("/comment_approve", [CommentController::class, "approve"]);
Route::post("/update-comment", [CommentController::class, "update"]);
Route::get("/delete-comment", [CommentController::class, "delete"])->name("delete-comment");



Route::post("authenticate", [UserController::class, "authenticate"])->name("authenticate");

Route::get('/get-role-by-id/{id}', [RoleController::class, 'getRoleById']);
Route::get("/comment_reject/{id}", [CommentController::class, "reject"]);
Route::get('/dummyCalenderGetTask/{id}', [TaskController::class, 'getTaskForUpdate']);
Route::get('/getProjectInDummyCalender/{id}', [TaskController::class, "getProjectInDummyCalender"]);
Route::get("/get-porject-by-id/{id}", [TaskController::class, "getTaskById"]);
Route::get("/get-client-by-id/{id}", [ProjectController::class, "getProjectById"]);
Route::get('/get-user-by-id/{id}', [UserController::class, "getUserById"]);
Route::get('/approve_task_in_calender/{color_id}/{task_id}',[TaskFileController::class,'change_status']);
Route::get('/in_progres_task/{task_id}',[TaskFileController::class,'task_status_to_progress']);
Route::get('/in_progres_sub_task/{task_id}/sub_task',[TaskFileController::class,'subTaskToPgrgress']);
Route::get('/complete_task_status/{task_id}',[TaskFileController::class,'task_status_to_complete']);
Route::get('/complete_sub_task/{task_id}/sub_task',[TaskFileController::class,'subTaskToComplete']);
Route::get('/read_notification/{task_id}',[TaskController::class,'read_notification']);

// Notifications
Route::get('/tasks_notification_wise',[TaskController::class,'get_notified_tasks']);
Route::get('/read_all_notification',[TaskController::class,'read_all_notification']);

// Logout
Route::get("/sign_out", function(){
    Session::forget("user");
    return redirect()->route("login")->with("logout", "You are successfully logged out.");
})->name("sign_out");

// Login
Route::get("/login", function(){
    if(Session::has("user")){
        return back();
    }
    return view("login");
})->name("login");


// Companies
Route::post("get_company_by_id", [CompanyController::class, "getCompanyById"])->name("get_company_by_id");



//Forgot Password Routes
Route::get('/forgot-password',[ForgotPasswordController::class,"index"]);
Route::post('/submit-email',[ForgotPasswordController::class,"submitEmail"]);
Route::get('/reset-password/{id}',[ForgotPasswordController::class,'resetPass']);
Route::post('/change-password',[ForgotPasswordController::class,'changePass']);

// Task Files
Route::view("/unapproved-task-files", "TaskFiles.unapproved", ["unapproved_task_files" => TaskFile::leftJoin("tasks", "task_files.task_id", "tasks.id")->select("task_files.*", "tasks.name")->where("task_files.approved", false)->get()])->name("unapproved_task_files");
Route::post("/approve-task-file", [TaskFileController::class, "approveTaskFile"])->name("approve_task_file");
Route::get("/get-unapproved-task-files", [TaskFileController::class, "getUnapprovedTaskFiles"])->name("get_unapproved_task_files");

// On hold
Route::post("/project-on-hold", [TaskController::class, "onHold"])->name("project_on_hold");
Route::post("/project-approval", [TaskController::class, "taskApproval"])->name("task_approval");

// Subscription
Route::post("/create_gold_subscription", [SubscriptionController::class, "createGoldSubscription"])->name("create_gold_subscription");
