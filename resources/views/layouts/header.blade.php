<?php
use App\Models\Task;
use App\Models\TaskFile;
use App\Models\Color;
use Illuminate\Support\Facades\DB;

$cs = Color::all();

$pending_tasks = Task::join('colors', 'tasks.status', '=', 'colors.id')
    ->where('user_id', Session::get('user')->id)
    ->where('status', 1)
    ->select('tasks.*', 'colors.status_name', 'colors.status_color')
    ->get();

$notifications = DB::table('tasks')
    ->where([
        'user_id' => session()->get('user')->id,
        'status' => 1,
        'view'  =>  0
    ])
    ->get();
    
    $unapproved_task_files = TaskFile::where("approved", false)->get();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
  <link rel="icon" href="{{ asset('logo.png') }}" type="image/png" />

  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

  <!-- Boxicon css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />

  <!-- Bootstrap css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

  <!-- Font awesome -->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

  <!-- Toastr -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

  <!-- color picker css -->
  <link rel="stylesheet" href="{{ asset('colorpicker/css/colorpicker.css') }}" type="text/css" />

  <link rel="stylesheet" href="{{ asset('calender/fullCal.css') }}">
  
    <!-- Moment -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

    <!-- Datatable CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">

    <!-- Paypal -->
    <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>


  <!-- CSS only -->
  <title>Ultimate Content Calendar</title>

  <!-- Custom css -->
  <style >
    <?php if($cs->count() !=0){ ?>
      :root{
        --pending-color: <?php echo $cs->find(1)->status_color; ?>;
        --in_progress-color: <?php echo $cs->find(2)->status_color; ?>;
        --approve-color: <?php echo $cs->find(3)->status_color; ?>;
        --complete-color: <?php echo $cs->find(4)->status_color; ?>;
        --revined-color: <?php echo $cs->find(5)->status_color; ?>;
        --assigned-color: <?php echo $cs->find(6)->status_color; ?>;
        --waiting-for-edit-approval-color: <?php echo $cs->find(7)->status_color; ?>;
        --waiting-for-client-approval-color: <?php echo $cs->find(8)->status_color; ?>;
        --cant-use-color: <?php echo $cs->find(9)->status_color; ?>;
        --posted-color: <?php echo $cs->find(10)->status_color; ?>;
        --sent-to-client-color: <?php echo $cs->find(11)->status_color; ?>;
        --caption-waiting-for-approval-color: <?php echo $cs->find(12)->status_color; ?>;
        --revise-caption-color: <?php echo $cs->find(13)->status_color; ?>;
        --caption-approved-color: <?php echo $cs->find(14)->status_color; ?>;
      }
    <?php }?>

    .view_task_label{
      font-weight:bold;
      display:block;
      text-transform:uppercase;
    }
    
    /* Pendind */
    #pending_column{
      border-bottom:5px solid var( --pending-color);
    }
    #pending_column #pending div{
      background-color:var( --pending-color);
    }
    #pending_column span{
      color:var( --pending-color);
    }

    /* In progress */
    #in_progress_column{
      border-bottom:5px solid var( --in_progress-color);
    }
    #in_progress_column #in_progress div{
      background-color:var( --in_progress-color);
    }
    #in_progress_column span{ 
      color:var( --in_progress-color);
    }

    /* Approve */
    #approve_column{
      border-bottom:5px solid var( --approve-color);
    }
    #approve_column #approve div{
      background-color:var( --approve-color);
    }
    #approve_column span{
      color:var( --approve-color);
    }

    /* Complete */
    #complete_column{
      border-bottom:5px solid var( --complete-color);
    }
    #complete_column #complete div{
      background-color: var( --complete-color);
    }
    #complete_column span{
      color: var( --complete-color);
    }

    /* Reject */
    #reject_column{
      border-bottom:5px solid var( --revined-color);
    }
    #reject_column #reject div{
      background-color:var( --revined-color);
    }
    #reject_column span{
      color:var( --revined-color);
    }
    
    
    /* Assigned */
    #assigned_column{
      border-bottom:5px solid var( --assigned-color);
    }
    #assigned_column #assigned div{
      background-color:var( --assigned-color);
    }
    #assigned_column span{
      color:var( --assigned-color);
    }
    
    
    /* Waiting for Edit Approval */
    #waiting_for_edit_approval_column{
      border-bottom:5px solid var( --waiting-for-edit-approval-color);
    }
    #waiting_for_edit_approval_column #waiting_for_edit_approval div{
      background-color:var( --waiting-for-edit-approval-color);
    }
    #waiting_for_edit_approval_column span{
      color:var( --waiting-for-edit-approval-color);
    }
    
    /* Waiting for Client's Approval */
    #waiting_for_client_approval_column{
      border-bottom:5px solid var( --waiting-for-client-approval-color);
    }
    #waiting_for_client_approval_column #waiting_for_client_approval div{
      background-color:var( --waiting-for-client-approval-color);
    }
    #waiting_for_client_approval_column span{
      color:var( --waiting-for-client-approval-color);
    }
    
    /* Can't Use */
    #cant_use_column{
      border-bottom:5px solid var( --cant-use-color);
    }
    #cant_use_column #cant_use div{
      background-color:var( --cant-use-color);
    }
    #cant_use_column span{
      color:var( --cant-use-color);
    }
    
    /* Posted */
    #posted_column{
      border-bottom:5px solid var( --posted-color);
    }
    #posted_column #posted div{
      background-color:var( --posted-color);
    }
    #posted_column span{
      color:var( --posted-color);
    }
    
    /* Sent to Client to Post */
    #sent_to_client_column{
      border-bottom:5px solid var( --sent-to-client-color);
    }
    #sent_to_client_column #sent_to_client div{
      background-color:var( --sent-to-client-color);
    }
    #sent_to_client_column span{
      color:var( --sent-to-client-color);
    }
    
    /* Caption waiting for approval */
    #caption_waiting_for_approval_column{
      border-bottom:5px solid var( --caption-waiting-for-approval-color);
    }
    #caption_waiting_for_approval_column #caption_waiting_for_approval div{
      background-color:var( --caption-waiting-for-approval-color);
    }
    #caption_waiting_for_approval_column span{
      color:var( --caption-waiting-for-approval-color);
    }
    
    /* Revise Caption */
    #revise_caption_column{
      border-bottom:5px solid var( --revise-caption-color);
    }
    #revise_caption_column #revise_caption div{
      background-color:var( --revise-caption-color);
    }
    #revise_caption_column span{
      color:var( --revise-caption-color);
    }
    
    /* Caption approved */
    #caption_approved_column{
      border-bottom:5px solid var( --caption-approved-color);
    }
    #caption_approved_column #caption_approved div{
      background-color:var( --caption-approved-color);
    }
    #caption_approved_column span{
      color:var( --caption-approved-color);
    }

    .colorSelector {
      position: relative;
      width: 36px;
      height: 36px;
      background: url(../images/select.png);
    }
    
    .colorSelector div {
      position: absolute;
      top: 3px;
      left: 3px;
      width: 30px;
      height: 30px;
      background: url(../images/select.png) center;
    }

    .boxes{
      display:flex;
      flex-wrap:wrap;
      justify-content:space-between;
    }
    
    .card{
      width:300px;
      height:200px;
      margin:10px;
    }

    .card:hover{
      box-shadow:0px 0px 2px black;
    }

    .card-footer a{
      text-decoration:none;
      color:white;
    }

    #comment-form-container div{
      margin-top:10px;
    }    
    
    .active{
        color:white !important;
        background-color:#485897;
    }
    
    .counttt {
        font-size: 10px;
        position: absolute;
        top: -3px;
        right: -4px;
    }
    
    .comment_view_data{
      display: flex;
      justify-content: space-between;
      font-size: 18px;
    }
    
    .label{
        font-weight:bold;
    }
    
    .counttt {
        font-size: 10px;
        position: absolute;
        top: -3px;
        right: -4px;
    }
    
    .read_task i:hover{
        background-color:#212529;
        color:lightblue;
        border-radius:6px;
        padding:0px 4px;
    }
    .incomplete_project_info_filters li{
        margin: 0px 10px;
    }
    

  </style>

</head>

<body id="body-pd">
  <div class="header-main">

    <header class="header" id="header">
        
        
      <div class="header_toggle">
        <i class="bx bx-menu" id="header-toggle"></i>
      </div>
          
          
        <!-- Unapproved Task Files -->
        @if(session()->get('user')->role_id == 1)
            <a href="{{ route('unapproved_task_files') }}" title="Unapproved Task Files">
                <i class='bx bx-file unapproved_task_files_modal_trigger' style="font-size:30px; position: relative;">
                        <span class="badge alert-danger navbar-badge counttt unapproved_task_files_count">{{ count($unapproved_task_files) }}</span>
                </i>
            </a>
        @endif
          
          
          
      <div class="header-right dropdown d-flex justify-content-between">
            @if (session()->get('user')->role_id != 1)
                <div>
                    @if (count($notifications) != null)
                        <i class='bx bxs-bell notification' style="font-size:30px; position: relative;"
                            id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="badge alert-danger navbar-badge counttt"> {{ count($notifications) }}
                            </span>
                        </i>

                        <ul class="dropdown-menu dd_menu" aria-labelledby="dropdownMenuButton2">
                            <li>
                                <a class="dropdown-item read_all_task"> Mark All As Read </a>
                            </li>
                            
                            @foreach ($notifications as $task)
                                <li class="d-flex justify-content-between task_row" data="{{ $task->id }}" style="position:relative;">
                                    <a class="dropdown-item read_task">Project {{ $task->name }}
                                        <a href='javascript:void(0)' class="" style='color:black;' >
                                            <i class='bx bx-check-double' style='font-size:28px; position: absolute; right: 12px;'></i>
                                        </a>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                    
                        <i class='bx bxs-bell notification' style="font-size:30px; position: relative;"></i>
                    @endif
                </div>
            @endif
            
            
            @if(Session::get("user")->img != null)    
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                     <img src="{{ asset('profile_images') }}/{{ Session::get('user')->img }}" alt="" style="border-radius:50%;"> {{ Session::get("user")->first_name }} {{ Session::get("user")->last_name }}
                </button>
            @else
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                     <img src="{{ asset('images/profile.jpg') }}" alt="" style="border-radius:50%;">{{ Session::get("user")->first_name }} {{ Session::get("user")->last_name }}
                </button>
            @endif
        
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        
          <!-- Settings -->
          @if(Session::get('user')->role_id == 1)
            <li><a class="dropdown-item" href="{{ route('settings') }}">Settings</a></li>
          @endif
          
          <!-- Logout -->
          <li><a class="dropdown-item" href="{{ route('sign_out') }}">Logout</a></li>
        </ul>
        
        
      </div>
        
    </header>


    <div class="l-navbar" id="nav-bar">
      <nav class="nav sideBar22">
        <div>
            
          <a href="#" class="nav_logo">
            {{-- <img src="{{asset('assets/logo_square1.png')}}" alt="" class="tms_logo"/> --}}
            <img src="{{ asset('logo.png') }}" alt="" class="tms_logo"/> 
            <!-- <i class="bx bx-layer nav_logo-icon"></i> -->
            <!--<span class="nav_logo-name tms_name">TMS</span>-->
          </a>

          
          <div class="nav_list">
              
            <!-- Index -->
            <a href="{{ route('index') }}" class="nav_link d1 @if(Request::is('/')) active @endif">
              <i class='bx bx-home nav_icon'></i>
              <span class="nav_name">Home</span>
            </a>
            
            @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
              @if($per == 1)
                <!-- Roles -->
                <a href="{{ route('roles') }}" class="nav_link d1 @if(Request::is('roles')) active @endif">
                  <i class='bx bx-user-pin nav_icon'></i>
                  <span class="nav_name">Role</span>
                </a>
              @endif
            @endforeach
            

            <!-- Manage Roles -->
            @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
              @if($per == 26)
                <!-- Manage Roles -->
                <a href="{{ route('manage_roles') }}" class="nav_link d2 @if(Request::is('manage_roles')) active @endif">
                  <i class="bx bx-message-square-detail nav_icon"></i>
                  <span class="nav_name">Manage Role</span>
                </a>
              @endif
            @endforeach

            @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
              @if($per == 2)
                <!-- Users -->
                <a href="{{ route('users') }}" class="nav_link d3 @if(Request::is('users')) active @endif">
                  <i class="bx bx-user nav_icon"></i>
                  <span class="nav_name">Users</span>
                </a>
              @endif
            @endforeach

            @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
              @if($per == 3)
                <!-- Clients -->
                <a href="{{ route('projects') }}" class="nav_link d4 @if(Request::is('clients')) active @endif">
                  <i class='bx bx-news nav_icon'></i>
                  <span class="nav_name">Clients</span>
                </a>
              @endif
            @endforeach

            @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
              @if($per == 4)
                <!-- Projects -->
                <a href="{{ route('tasks') }}" class="nav_link @if(Request::is('projects')) active @endif">
                  <i class='bx bx-task nav_icon'></i>
                  <span>Projects @if($pending_tasks->count() != 0)<span class="badge alert-success" style="padding:5px;color:black; background-color:var(--pending-color);">Pending {{ $pending_tasks->count() }}</span>@endif
                </a>
              @endif
            @endforeach
            
            @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
              @if($per == 30)
                <!-- Clients -->
                <a href="{{ route('companies') }}" class="nav_link d4 @if(Request::is('companies')) active @endif">
                  <i class='bx bx-building-house nav_icon'></i>
                  <span class="nav_name">Companies</span>
                </a>
              @endif
            @endforeach
            
            <!-- Comments -->
            @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
              @if($per == 10)
                
                <a href="{{ url('/comments_view') }}" class="nav_link @if(Request::is('comments_view') || Request::is('comment')) active @endif">
                  <i class='bx bx-comment-detail'></i>
                  <span class="nav_name">Comments</span>
                </a>
              @endif
            @endforeach


            <!-- Calendar -->
            {{-- @foreach (json_decode(Session::get('user')->permissions_id, true) as $per)
                @if ($per == 6)
                    <a href="{{ url('task_calender_wise') }}" class="nav_link d1 @if(Request::is('task_calender_wise')) active @endif">
                        <i class='bx bx-calendar'></i>
                        <span>Calendar</span>
                    </a>
                @endif
            @endforeach --}}
            
            
            <!-- Settings -->
            @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
              @if($per == 5)
                <!-- Settings -->
                <a href="{{ route('settings') }}" class="nav_link @if(Request::is('settings')) active @endif">
                  <i class='bx bx-layer nav_icon'></i>
                  <span class="nav_name">Settings</span>
                </a>
              @endif
            @endforeach
            
            @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
              @if($per == 29)
                <!-- Roles -->
                <a href="{{ route('packages') }}" class="nav_link d1 @if(Request::is('packages')) active @endif">
                  <i class='bx bx-calendar nav_icon'></i>
                  <span class="nav_name">Packages</span>
                </a>
              @endif
            @endforeach
            
            <hr>
            
            <!-- Logout -->
            <a href="{{ route('sign_out') }}" class="nav_link">
              <i class="bx bx-log-out nav_icon"></i>
              <span class="nav_name">SignOut</span>
            </a>
            
          </div>
        </div>

        
        
        
      </nav>
    </div>