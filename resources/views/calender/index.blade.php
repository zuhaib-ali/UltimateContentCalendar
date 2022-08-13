@include("layouts.header")
<link rel="stylesheet" href="{{ asset('assets/style.css') }}">
<main class="container mt-5 pt-5">
    
    <div class="modal" tabindex="-1" id="add_task_dummy_calender">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title">Create Project</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
          <form action="{{ route('add-task') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <!-- Clients -->
                <div class="row">
                    <div class="">
                        <div class="mb-3">
                            
                            <label for="roles">Clients</label>
                            <select name="project_id" id="roles" class="form-control" required>
                            @if($all_clients->count() != 0)
                                <option disabled selected value> -- select a client -- </option>
                                @foreach($all_clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            @else
                                <option value="" style="font-style:italic;">Clients Not Found</option>
                            @endif
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Project Name -->
                <div class="row">
                    <div class="">
                        <div class="mb-3">
                            <label for="first name">Project Name</label>
                            <input type="text" name="task_name" class="form-control" value="" id="first_name" placeholder="Project Name" required>
                        </div>        
                    </div>
                </div>
                
                <!-- Description -->
                <div class="row">
                    <div class="">
                        <div class="mb-3">
                            <label for="description">Notes</label>
                            <textarea name="description" class="form-control" cols="30" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Caption -->
                <div class="row">
                    <div class="">
                        <div class="mb-3">
                            <label for="caption">Post Caption</label>
                            <textarea name="caption" class="form-control" cols="30" rows="3" placeholder="Post Caption"></textarea>
                        </div>
                    </div>
                </div>


                <!-- Caption status -->
                <div class="row">
                    <div class="">
                        <div class="mb-3">
                            <label for="caption_status name">Caption</label>
                            <select class="form-control" name="caption_status">
                                <option disabled selected hidden>-- SELECT CAPTION STATUS --</option>
                                <option value="12">Caption Waiting For Approval</option>
                                <option value="13">Revise Caption</option>
                                <option value="14">Caption Approved</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Project assigned to User -->
                <div class="row assigned">
                    <div class="">
                        <div class="mb-3">
                            
                            <label for="roles">Assigned To</label>
                            
                            <select name="user_id" id="roles" class="form-control users" required>
                            @if($users->count() != 0)
                                <option disabled selected value> -- ASSIGNED TO -- </option>
                                @foreach($users as $project)
                                 <option value="{{ $project->id }}">{{ $project->first_name }} {{ $project->last_name }}</option>
                                @endforeach
                            @else
                                <option value="" style="font-style:italic;">Assinged To Not Found</option>
                            @endif
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Post Date -->
                <div class="row">
                    <div class="">
                        <div class="mb-3">
                            <label for="deadline">Post Date</label>
                            <input type="date" name="deadline" class="form-control" id="create_project_in_dummy_calender_on_date" required readonly>
                        </div>
                    </div>
                </div>
                
                
                <!-- Due Date -->
                <div class="row">
                    <div class="">
                        <div class="mb-3">
                            
                            <label for="due_to_date">Due Date</label>
                            <input type="date" name="due_to_date" class="form-control" required>
                        </div>
                    </div>
                </div>

                <!-- Files -->
                <div class="row">
                    <div class="">
                        <div class="mb-3">
                            
                            <label for="upload files">Upload files</label>
                            <input type="file" name="task_files[]" class="form-control" multiple>
                        </div>
                    </div>
                </div>
                
                <!-- Auto assign -->
                <center>
                    <div class="row">
                        <div class="">
                            <div class="mb-3">
                                
                                <label for="auto assign">AUTO ASSIGN</label>
                                <input type="checkbox" value="1" name="auto_assign" class="auto_assign"/>
                            </div>
                        </div>
                    </div>
                </center>
            </div>

            <!-- modal footer starts -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary" value="Add">
            </div>
          </form>
        </div>
      </div>
    </div>
    
    
    
    <div class="container">
        <div class="row">
            <div class="col-4">
                <!-- Show records by date selection -->
                <form class="form" action="{{ route('record_on_date') }}" method="GET">
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" name="start_date" class="form-control me-5" required>
                    </div>
                    
                    <div class="form-group">
                        <lable for="end_date">End Date</lable>
                        <input type="date" name="end_date" class="form-control me-5" required>    
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="submit" value="Show Record" class="btn btn-primary">
                    </div>
                </form>            
            </div>
            
            @if(Session::get("user")->id == 1)
                <div class="col-8">
                    <ul class="ul-padding-re d-flex justify-content-end incomplete_project_info_filters" style="list-style-type:none;">
                        <!-- Hide All -->
                        <li>
                            <div class="form-check form-switch">
                                <label>All</label>
                                <input type="checkbox" value="" title="Hide All" style="background-color:lightred; border-color:lightred;" class="form-check-input unassigned_info_projects"/> 
                            </div>
                        </li>
                        
                        
                        <!-- Post date -->
                        <li>
                            <div class="form-check form-switch">
                                <label>Post Date</label>
                                <input type="checkbox" value="" title="Post Date" style="background-color:lightgreen; border-color:lightgreen;" class="form-check-input unassignned_deadline_projects_trigger unassigned_projects_details_trigger"/> 
                            </div>
                        </li>
                        
                        <!-- Due Date -->
                        <li>
                            <div class="form-check form-switch">
                                <label>Due Date</label>
                                <input type="checkbox" value="" title="Due Date" style="background-color:red; border-color:red;" class="form-check-input unassignned_due_date_projects_trigger unassigned_projects_details_trigger"/> 
                            </div>
                        </li>
                        
                        <!-- Client -->
                        <li>
                            <div class="form-check form-switch">
                                <label>Client</label>
                                <input type="checkbox" value=""  title="Clients" style="background-color:rgb(174, 189, 248); border-color:rgb(174, 189, 248);" class="form-check-input unassignned_clients_projects_trigger unassigned_projects_details_trigger"/> 
                            </div>
                        </li>
                        
                        <!-- Assigned to -->
                        <li>
                            <div class="form-check form-switch">
                                <label>Assigned To</label>
                                <input type="checkbox" value=""  title="Assigned To" style="background-color:skyblue; border-color:skyblue;" class="form-check-input unassignned_projects_trigger unassigned_projects_details_trigger "/> 
                            </div>
                        </li>
                    </ul>
                    
                    
                    <div class="d-flex justify-content-end">
                        
                        <!-- Post Date -->
                        <div id="unassignned_deadline_projects" class="unassigned_projects_details" hidden>
                            @foreach($unassigned_deadline_projects as $project)
                                <div title="Unassigned Post Date Project" style="padding:3px; margin:5px; lightgrey; text-align:center; background-color:lightgreen; color:white;" project-id="{{ $project->id }}" class="unassigned_project_info">
                                    {{ $project->name }}
                                </div>
                            @endforeach    
                        </div>
                        
                        <!-- Due Date -->
                        <div id="unassignned_due_date_projects" class="unassigned_projects_details" hidden>
                            @foreach($unassigned_due_date_projects as $project)
                                <div title="Unassigned Due Date Project" style="padding:3px; margin:5px; lightgrey; text-align:center; background-color:red; color:white;" project-id="{{ $project->id }}" class="unassigned_project_info">
                                    {{ $project->name }}
                                </div>
                            @endforeach    
                        </div>
                        
                        <div id="unassignned_clients_projects" class="unassigned_projects_details" hidden>
                            @foreach($unassigned_client_projects as $project)
                                <div title="Unassigned Clients Project" style="padding:3px; margin:5px; text-align:center; background-color:rgb(174, 189, 248); border-color:rgb(174, 189, 248);" project-id="{{ $project->id }}" class="unassigned_project_info">
                                    {{ $project->name }}
                                </div>
                            @endforeach    
                        </div>
                        
                        <div id="unassignned_projects" class="unassigned_projects_details" hidden>
                            @foreach($unassigned_projects as $project)
                                <div title="Unassiegned Project" style="padding:3px; margin:5px; text-align:center; background-color:skyblue; color:white;" project-id="{{ $project->id }}" class="unassigned_project_info">
                                    {{ $project->name }}
                                </div>
                            @endforeach    
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    

    
    <!-- Date from and to. -->
    <div class="text-center my-5">
        <h4><i>{{ $from }}</i> to <i>{{ $to }}</i></h4>
    </div>
    
    
    <div class="row">
        <!-- Clients -->
        <div class="col-lg-2 col-md-3 col-sm-12">
            <!--Filter By Clients-->
            <h5>Filter By Clients:</h4>
            @if($clients != null)
                <ul class="ul-padding-re" style="list-style-type:none;">
                    <li>
                        <div class="form-check form-switch">
                            <input type="checkbox" value="" class="form-check-input clientName dummy_calender_clients_all" checked/> 
                            <label class="label-client-name"> All </label> 
                        </div>
                    </li>
                    @foreach($clients as $client)
                        <li>
                            <div class="form-check form-switch">
                                <input type="checkbox" value="{{ $client->id }}" class="form-check-input clientName dummy_calender_client" checked/> 
                                <label class="label-client-name"> {{ $client->name }} </label> 
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
            
            <hr>
            
            <!-- Filter By Project Assigned User -->
            <h5>Filter By Project Assigned To:</h5>
            @if($users)
                <ul class="ul-padding-re" style="list-style-type:none;">
                    @foreach($users as $user)
                        <li>
                            <div class="form-check form-switch">
                                <input type="checkbox" value="{{ $user->id }}" class="form-check-input clientName dummy_calender_user_project" checked/> 
                                <label class="label-client-name"> {{ $user->first_name }} {{ $user->last_name }} </label> 
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
            
        </div>
        
        <!--overflow-x:scroll;-->
        <div class="col-lg-10 col-md-9 col-sm-12 pspsps" style="overflow-x:scroll;">
            <!-- 1 week -->
            <section id="second-container">
                <table class="table">
                    
                    <thead>
                        <tr class="row-2-color" id="dummy_calender_total_days">
                            <th scope="row" class="text-center bg-white client-left" >Clients</th>
                            @foreach($past_seven_days as $day)
                                <th scope="col" class="column1 text-center date-same-equal-class @if(Session::get('user')->id == 1) dummy_calender_project_on_date @endif?>" date-project-date="{{$day}}">{{ $day->format('D, d M') }}</th>
                                <th class="align-bottom text-center purple-type-color">caps</th>
                            @endforeach
                        </tr>
                    </thead>
                
                    <!-- Projects -->
                    <tbody class="clients_projects_table">
                        <!-- if clients and projects exists -->
                        @if($clients->count() != 0 && $projects != null)
                            <?php $client_index = 0;?>
                            @foreach($projects as $project)
                                @if($project->count() == 0)
                                    @continue;
                                @endif
                                <?php $project_index = 0; ?>
                                <tr data-client-row-id="{{ $clients[$client_index]->id }}" class="project_row">
                                    <!-- client -->
                                    <th class="tb-name-column"style="padding:5px !important;">{{ $clients[$client_index]->name }}</th>
                                    
                                    @for($i=0; $i<=$calender_length; $i++)
                                        <!-- Projects -->
                                        <th colspan="2" class="px-0">
                                            @foreach($project as $pro)
                                                @if(Carbon\Carbon::create($pro->deadline)->format('D, d M') == $past_seven_days[$i]->format('D, d M'))
                                                    <div style="display:flex; border:solid 1px grey; width:150px;" data-project-id="{{ $pro->id }}" data-user-id="{{ $pro->user_id }}" class="dummy_calender_project_view_modal_trigger">
                                                        <div style="background-color: {{ $status_colors->find($pro->status)->status_color }}; width:100px; word-break:break-all; border:1px solid #fff; margin:0px 0px;  padding:5px;">{{ $pro->name }} <br><i>({{ $pro->first_name }} {{ $pro->last_name }})</i></div>
                                                        
                                                        @if($pro->caption_status != null)
                                                            <div style="background-color: {{ $status_colors->find($pro->caption_status)->status_color }}; width:50px; word-break:break-all; border-top:1px solid #fff; border-bottom:1px solid #fff; border-right:1px solid #fff; padding:5px; margin:0px 0px;"></div>
                                                        @else
                                                            <div  style="padding:5px; margin:0px 0px; width:50px;"></div>
                                                        @endif
                                                    </div>  
                                                @endif
                                            @endforeach
                                        </th>
                                        
                                        @if($project_index >= $project->count())
                                            <?php break;?>
                                        @endif
                                    @endfor
                                </tr>
                                <?php $client_index++;?>
                            @endforeach
                        @else
                            <td colspan="15">No Proejct Found!</td>
                        @endif
                    </tbody>
              </table>
            </section>        
        </div>
    </div>
</main>


<!-- View Project Modal In Dummy Project -->
<div class="modal" tabindex="-1" id="dummy_calender_project_view_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
        <div id="view_project_in_dummy_calender_modal_body"></div>
        
        <!-- Notes -->
        @if(Session::get('user')->client_id != null)
            <form action="{{ route('add_description_to_client_project') }}" method="POST">
                @csrf
                <div class="form-group">
                    <lable for="">Notes</lable>
                    <textarea name="note" col="10" row="3" class="form-control" id="view_note_in_dummy_calender_modal_body"></textarea>    
                    <input type="hidden" name="project_id" id="project_id_in_dummy_calender_view_modal_note">
                </div>
                <br>
                <div>
                    <input type="submit" class="btn btn-sm btn-primary">
                </div>
            </form>
        @else
        
            <span id="note_in_dummy_calender_modal_body"></span>
        @endif
        
      </div>
      
      <div class="modal-footer">
          <div>
        @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
            @if($per == 17)
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" dummy-project-id="" id="dummy_calender_project_update_modal_trigger">Edit</button>  
            @endif
        @endforeach
        
        @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
            @if($per == 22)
                <a href="" class="btn dummy_calender_status_button" id="dummy_calender_pending_button" style="background-color:{{ $colors[0]->status_color }}">{{ $colors[0]->status_name }}</a>
                <a href="" class="btn dummy_calender_status_button" id="dummy_calender_in_progress_button" style="background-color:{{ $colors[1]->status_color }}">{{ $colors[1]->status_name }}</a>
                <a href="" class="btn dummy_calender_status_button" id="dummy_calender_approved_button" style="background-color:{{ $colors[2]->status_color }}">{{ $colors[2]->status_name }}</a>
                <a href="" class="btn dummy_calender_status_button" id="dummy_calender_completed_button" style="background-color:{{ $colors[3]->status_color }}">{{ $colors[3]->status_name }}</a>
                <button data-bs-dismiss="modal" class="btn dummy_calender_status_button" id="dummy_calender_revised_button" style="background-color:{{ $colors[4]->status_color }}">{{ $colors[4]->status_name }}</button>
            @endif
        @endforeach
        </div>
        <br>
        
        <div style="padding:10px;">
            <form action="{{ route('upload-extra-file') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- File -->
                <div class="row">
                    <div class="">
                        <div class="mb-3">
                            <label for="upload files">Upload files</label>
                            <input type="file" name="task_files[]" class="form-control" multiple>
                        </div>
                    </div>
                </div>

                <!-- Task id -->
                <input type="hidden" name="task_id" value="" id="task_id_for_extra_files_upload">
                
                <input type="submit" value="Upload Files" class="btn btn-sm btn-success">
            </form>
        </div>
        
        @if(Session::get('user')->id == 1)
            <!-- On Hold -->
            <div>
                <input type="checkbox" data-id="" class="view_project_in_dummy_calender_on_hold" value=0 name="on_hold"> On Hold
            </div>
        @endif
        
        
        
      </div>
    </div>
  </div>
</div>


<!-- Update Projct modal -->
<div class="modal" tabindex="-1" id="dummy_calender_project_update_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Update Project</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ route('update-task') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            
            <!-- Task name -->
            <div class="row">
                <div class="">
                    <div class="mb-3">
                        <label for="roles">Project Name</label>
                        <input type="text" name="task_name" class="form-control" value="" id="dummy_calender_update_task_name" placeholder="Task Name" required>
                    </div>        
                </div>
            </div>
            
            <!-- Projects -->
            <div class="row">
                <div class="">
                    <div class="mb-3">
                        <label for="roles">Client</label>
                        <select name="project_id" id="dummy_calender_update_project" class="form-control" required></select>
                    </div>
                </div>
            </div>
            
            <!-- Description -->
            <div class="row">
                <div class="">
                    <div class="mb-3">
                        <textarea name="description" id="dummy_calender_update_description" class="form-control" cols="30" rows="5" placeholder="Editor's Notes"></textarea>
                    </div>
                </div>
            </div>

            <!-- Caption -->
            <div class="row">
                <div class="">
                    <div class="mb-3">
                        <textarea name="caption" id="dummy_calender_update_caption" class="form-control" cols="30" rows="5" placeholder="Post Caption"></textarea>
                    </div>
                </div>
            </div>
            
            <!-- Caption status -->
            <div class="row">
                <div class="">
                    <div class="mb-3">
                        <select class="form-control" name="caption_status" id="dummy_calender_update_caption_status"></select>
                    </div>
                </div>
            </div>

            <!-- Assigend to -->
            <div class="row">
                <div class="">
                    <div class="mb-3">
                        <label for="roles">Assigned To</label>
                        <select name="user_id" id="dummy_calender_update_user" class="form-control" required></select>
                    </div>
                </div>
            </div>

            <!-- Post Date -->
            <div class="row">
                <div class="">
                    <div class="mb-3">
                        <label for="post date">Post Date</label>
                        <input type="date" name="deadline" value="" id="dummy_calender_update_post_date" class="form-control">
                    </div>
                </div>
            </div>
            
            <!-- Due Date -->
            <div class="row">
                <div class="">
                    <div class="mb-3">
                        <label for="post date">Due Date</label>
                        <input type="date" name="due_to_date" value="" id="dummy_calender_update_due_date" class="form-control">
                    </div>
                </div>
            </div>

            <!-- Task id -->
            <input type="hidden" name="task_id" id="dummy_calender_update_task_id" value="">
        </div>

        <!-- modal footer starts -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" value="Update">
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Revine task modal In Dummy Calender -->
<div class="modal" tabindex="-1" id="revine_task_modal_dummy_calender">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Revine Project</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="{{ route('task-revine') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

          <!-- Subject -->
            <div class="row">
                <div class="">
                    <div class="mb-3">
                        <input type="text" name="subject" class="form-control" value="" id="subject" placeholder="Subject" required>
                    </div>        
                </div>
            </div>

            <!-- Description -->
            <div class="row">
                <div class="">
                    <div class="mb-3">
                        <textarea name="description" id="description" class="form-control" cols="30" rows="5" placeholder="Notes"></textarea>
                    </div>
                </div>
            </div>

            <!-- Files -->
            <div class="row">
                <div class="">
                    <div class="mb-3">
                        <label for="deadline">Upload files</label>
                        <input type="file" name="attachments[]" class="form-control" multiple>
                    </div>
                </div>
            </div>

            <!-- Task id -->
            <input type="hidden" name="main_task_id" id="revine_project_task_id_dummy_calender" value="">

            <!-- Subtask id -->
            <input type="hidden" name="sub_task_id" value="{{-- $sub_tasks->where('main_task', $task->id)->where('revined', 0)->pluck('id')->first() --}}">
        </div>


        <!-- modal footer starts -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" value="Send">
        </div>

      </form>
    </div>
</div>
                

@include("layouts.footer")