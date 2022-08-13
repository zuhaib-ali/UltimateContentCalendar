@include("layouts.header")

<main class="container mt-5 pt-5">
<section id="second-container3">
        <center><h2 style="font-weight:400;">PROJECTS</h2></center>
        <div class="main-container-two">
            <div class="welcome-note-two"></div>
          <div>

              <!-- ADD task modal -->
              @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
                @if($per == 8)
                  <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal"  data-bs-target="#add_task" type="button">Add Project</button>
                @endif
              @endforeach
          
            <div class="modal" tabindex="-1" id="add_task">
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
                                    <select name="project_id" id="roles" class="form-control">
                                    @if($projects->count() != 0)
                                        <option disabled selected value> -- select a client -- </option>
                                        @foreach($projects as $client)
                                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                                        @endforeach
                                    @else
                                        <option value="" style="font-style:italic;">Clients Not Found</option>
                                    @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        
                        
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
                                    
                                    <select name="user_id" id="roles" class="form-control users">
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
                                    <input type="date" name="deadline" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                        
                        <!-- Post Date -->
                        <div class="row">
                            <div class="">
                                <div class="mb-3">
                                    
                                    <label for="due_to_date">Due Date</label>
                                    <input type="date" name="due_to_date" class="form-control">
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
                      <!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
                      <input type="submit" class="btn btn-sm btn-outline-primary" value="ADD">
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- add user modal ends -->
          </div>
        </div>
        
        <br><br>
        
        <table id="prjects_datatable" class="display">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Project</th>
                    <th scope="col">Client</th>
                    <!--<th scope="col">Assigned to</th>-->
                    <th scope="col">Status</th>
                    @if(session()->get('user')->role_id == 1)
                        <th scope="col">Post Date</th>
                        
                    @else
                        <th scope="col">Due Date</th>
                    @endif
                    <th scope="col" style="width:130px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($tasks->count() == 0)
                <tr >
                    <td colspan="7">NO TASK FOUND!</td>
                </tr>
            @else($tasks->count() != 0)
            <?php $no = 1; ?>
            
                @foreach($tasks as $task)
                    <tr>
                      <th scope="row">{{ $no++ }}</th>
                      <td><b>{{ $task->name }}</b> <i>{{ $task->first_name }} {{ $task->last_name }}</i></td>
                      <td>{{ $task->project_name }}</td>
                      <td><span style="color:{{ $task->status_color }}; font-weight:bold; text-transform:uppercase">{{ $task->status_name }}</span></td>
                        @if(session()->get('user')->role_id == 1)
                            <td>{{ $task->deadline != null ? Carbon\Carbon::create($task->deadline)->format('d M, y') : '' }}</td>
                            @else
                            <td>{{ $task->due_to_date != null ? Carbon\Carbon::create($task->due_to_date)->format('d M, y') : '' }}</td>
                        @endif
                        
                      <td>
                          
                          <!-- Approval and On Hold -->
                            @if(Session::get('user')->client_id != null)
                                @if($task->has_approval)
                                    <a class="btn btn-sm btn-warning project_approval" data-id="{{ $task->id }}">On Hold</a>
                                    
                                @else
                                    <a class="btn btn-sm btn-success project_approval" data-id="{{ $task->id }}">Approval</a>
                                @endif
                            
                            @else
                                @if($task->has_approval != null)
                                    <!-- On Hold -->
                                    @if($task->has_approval == true)
                                        <p style="color:green">Approved</p>
                                        
                                    @elseif($task->has_approval == false)
                                        <p style="color:orange">On Hold</p>
                                    @endif
                                @endif
                            @endif
                          
                          
                          
                          
                          
                          @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
                            @if($per == 16)
                              <!-- View Modal -->
                              <a href="#" class="me-2  view_task_trigger" data="{{ $task->id }}"><i class="far fa-eye" data-viewId="{{ $task->id }}" data-bs-toggle="modal" data-bs-target="#view_modal_{{ $task->id }}"></i></a>
                              <div class="modal" tabindex="-1" id="view_modal_{{ $task->id }}">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                      
                                      <!-- Modal Header -->
                                      <div class="modal-header">
                                        <h5 class="modal-title">
                                          <span style="text-transform:uppercase;">{{ $task->name }}</span>
                                            @if($task->status == 1)
                                              <span class="view_task_label" style="color:var( --pending-color);">{{ $colors->find(1)->status_name }}</span>
                                              
                                            @elseif($task->status == 2)
                                              <span class="view_task_label" style="color:var( --in_progress-color);">{{ $colors->find(2)->status_name }}</span>
        
                                            @elseif($task->status == 3)
                                              
                                              @if($task->revine_date == "")
                                                <span class="view_task_label" style="color:var( --approve-color);">{{ $colors->find(3)->status_name }}</span>
                                              @else
                                                <span class="view_task_label" style="color:var( --revined-color);">{{ $colors->find(5)->status_name }}</span>
                                              @endif
        
                                            @elseif($task->status == 4)
                                              <span class="view_task_label" style="color:var( --complete-color);">{{ $colors->find(4)->status_name }}</span>
                                            @elseif($task->status == 5)
                                              <span class="view_task_label" style="color:var( --revined-color);">{{ $colors->find(5)->status_name }}</span>
                                            @endif
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                                 
                                      <!-- Modal Body -->
                                      <div class="modal-body">
                                            @if(Session::get('user')->role_id == 1)
                                                <p class="d-flex justify-content-between">
                                                  <span><b style="font-weight:600;">Post Date:</b></span> 
                                                  <span style="font-style:italic;">{{ date('d-m-Y', strtotime($task->deadline)) }}</span>
                                                </p>  
                                            @else
                                                @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
                                                    @if($per == 27)
                                                        <p class="d-flex justify-content-between">
                                                          <span><b  style="font-weight:600;">Due Date:</b></span> 
                                                          <span style="font-style:italic;">{{ date('d-m-Y', strtotime($task->due_to_date)) }}</span>
                                                        </p>        
                                                    @endif
                                                @endforeach
                                            @endif
                                        <p>
                                          <span><b style="font-weight:600;">Notes:</b></span><br>
                                          <span style="font-style:italic;">{{ $task->description }}</span>
                                        </p>
                                        
                                        
                                        <p>
                                          <span><b style="font-weight:600;">Editor's Comment:</b></span><br>
                                          <span style="font-style:italic;">{{ $task->editor_comment }}</span>
                                        </p>
        
                                        @if( $task_files->count() != 0)
                                            <div style="text-align:center;">
                                                <b style="font-weight:600; text-transform:uppercase;">Attachments:</b>
                                            </div>
                                            <div style="display:block">
                                                @foreach($task_files->where("task_id", $task->id) as $task_file)
                                                    <div style="border:1px solid lightgrey; padding:10px; display:flex; justify-content:space-between">
                                                      <!-- Attachment -->
                                                      {{ $task_file->file_name }}
                                                      
                                                      <!-- donwload button -->
                                                      <a href="https://ultimatecontentcalendar.com/public/task_files/{{ $task_file->file_name}}" class="btn btn-sm btn-success">Download</a>
                                                    </div>
                                                
                                                @endforeach
                                            </div>
                                        @endif
        
                                        <!-- Subtasks -->
                                         @if($sub_tasks->count() != 0)
                                          <?php $sub_task_no = 1;?>
                                          @foreach($sub_tasks->where("main_task", $task->id)->where("revined", false) as $sub_task)
                                            <div class="sub-task-container" style="border:1px solid lightgrey; padding:15px; margin:10px 0px;">
                                              <div class="sub-task">
                                                <div>
                                                    @if($task->status == 3)
                                                        <div><p class="view_task_label" style="color:{{$colors->find(3)->status_color}}; float:right;">{{ $colors->find(3)->status_name }}</p></div>
                                                    @else
                                                        <div><p class="view_task_label" style="color:{{$colors->find($sub_task->status)->status_color}}; float:right;">{{ $colors->find($sub_task->status)->status_name }}</p></div>
                                                    @endif
                                                    <br>
                                                    <p class="d-flex justify-content-between w-100"><b>Subject:</b> <span>{{$sub_task->subject}} </span></p>
                                                    <p>
                                                        <b>Notes:</b>
                                                        <br> &nbsp;&nbsp;<span>{{$sub_task->description}} </span>
                                                    </p>
                                                </div>
                                              </div>
        
                                              <b>Attachments</b>
        
                                              <!-- attachements -->
        
                                              @if( $task_files->count() != 0)
                                                <div style="display:block;">
                                                  @foreach($task_files->where("sub_task_id", $sub_task->id) as $task_file)
                                                      
                                                    <div style="border:1px solid lightgrey; padding:10px; margin:10px; display:flex; justify-content:space-between">
                                                      <!-- Attachment -->
                                                      {{ $task_file->file_name }}
                                                      <!-- donwload button -->
                                                      <a href="https://ultimatecontentcalendar.com/public/task_files/{{ $task_file->file_name}}" class="btn btn-sm btn-success">Download</a>
                                                    </div>
        
                                                  @endforeach
                                                </div>
                                              @endif
        
                                            <div class="d-flex justify-content-end">
                                                <!-- Subtask status buttons -->
                                                  @if($sub_task->color_id == 1 && Session::get("user")->role_id != 1)
                                                    <a href="{{ route('update-subtask-status', ['status_id' => 2, 'task_id' => $sub_task->id]) }}" class="btn btn-light" style="background-color:@if ($colors->count() != 0) {{ $colors->find(2)->status_color }}; @else lightblue @endif color:white;">In Progress</a>
                                                  @elseif($sub_task->color_id == 2 && Session::get("user")->role_id != 1)
                                                    <a href="{{ route('update-subtask-status', ['status_id' => 4, 'task_id' => $sub_task->id]) }}" class="btn btn-light" style="background-color:@if ($colors->count() != 0) {{ $colors->find(4)->status_color }}; @else lightblue @endif color:white;">Complete</a>
                                                  @elseif($sub_task->color_id == 5)
                                                    <p class="btn btn-light" style="background-color:@if ($colors->count() != 0) {{ $colors->find(5)->status_color }}; @else 'lightblue' @endif color:white;">Task rejectd, wait for admin to if he pedning the rejected task again.</p>
                                                  @elseif($sub_task->color_id == 4 && Session::get("user")->role_id != 1 && $task->color_id == 5)
                                                    <p style="color: {{ $colors->find(4)->status_color }}">Waiting for approval, on task rejection status will be pending again.</p>
                                                  @elseif($sub_task->color_id == 3)
                                                    <p style="background-color:@if ($colors->count() != 0) {{ $colors->find(2)->status_color }}; @else 'lightblue' @endif color:white; width:100%; text-align:center; padding:10px">TASK APPROVED</p>
                                                  @endif
                                            </div>
                                          @endforeach 
                                        @endif
                                      </div>
                                      
                                      <!-- modal footer starts -->
                                      <div class="modal-footer">
                                          
                                        @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
                                            @if($per == 22)
                                                @if(Session::get("user")->role_id == 1)
                                                  <!-- On completion of task, show reject and approve button -->
                                                  @if($sub_tasks->where("main_task", $task->id)->where("revined", false)->pluck("status")->first() == 4 || $task->status == 4)
                                                    @if($task->color_id == 4)
                                                      <a type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#revine_task_modal_{{ $task->id }}" style="background-color:@if ($colors->count() != 0) {{ $colors->find(5)->status_color }}; @else 'lightblue' @endif color:white;">Revine</a>
                                                      <a href="{{ route('update-status', ['status_id' => 3, 'task_id' => $task->id]) }}" class="btn btn-light" style="background-color:@if ($colors->count() != 0) {{ $colors->find(3)->status_color }}; @else 'lightblue' @endif color:white;">Approve</a>
                                                    @elseif($task->color_id == 5)
                                                      <a type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#revine_task_modal_{{ $task->id }}" style="background-color:@if ($colors->count() != 0) {{ $colors->find(5)->status_color }}; @else 'lightblue' @endif color:white;">Revine</a>
                                                      <a href="{{ route('update-status', ['status_id' => 3, 'task_id' => $task->id]) }}" class="btn btn-light" style="background-color:@if ($colors->count() != 0) {{ $colors->find(3)->status_color }}; @else 'lightblue' @endif color:white;">Approve</a>
                                                    @endif
                                                  @endif
                
                                                @elseif(Session::get("user")->client_id == null)
                                                  @if($task->color_id == 1)
                                                    <a href="{{ route('update-status', ['status_id' => 2, 'task_id' => $task->id]) }}" class="btn btn-light" style="background-color:@if ($colors->count() != 0) {{ $colors->find(2)->status_color }}; @else 'lightblue' @endif color:white;">In Progress</a>
                                                  @elseif($task->color_id == 2)
                                                    <a href="{{ route('update-status', ['status_id' => 4, 'task_id' => $task->id]) }}" class="btn btn-light" style="background-color:@if ($colors->count() != 0) {{ $colors->find(4)->status_color }}; @else 'lightblue' @endif color:white;">Complete</a>
                                                  @elseif($task->color_id == 4)
                                                    <p style="color: {{ $colors->find(4)->status_color }}">Waiting for approval, on task rejection status will be pending again.</p>
                                                  @elseif($task->color_id == 3)
                                                    <p style="background-color:@if ($colors->count() != 0) {{ $colors->find(2)->status_color }}; @else 'lightblue' @endif color:white; width:100%; text-align:center; padding:10px">TASK APPROVED</p>
                                                  @endif
                
                                                @endif      
                                            @endif
                                        @endforeach
                                        
                                      </div>
                                    </form>
                                    
                                    
                                    @if($task->editor_comment == null)
                                        @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
                                            @if($per == 28)
                                                <div style="padding:10px; margin:10px 0px;">
                                                    <center><h5>Editor's Comment</h5></center>
                                                    <form action="{{ route('create_editor_comment') }}" method="POST" >
                                                        @csrf
                                                        <div class="form-group">
                                                            <textarea name="editor_comment" class="form-control"></textarea>    
                                                            
                                                            <!-- Task id -->
                                                            <input type="hidden" name="id" value="{{ $task->id }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="submit" value="Add Comment" class="btn btn-sm btn-outline-success">
                                                        </div>
                                                    </form>
                                                </div>        
                                            @endif
                                        @endforeach
                                    @endif
                                    
                                    
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
                                            <input type="hidden" name="task_id" value="{{ $task->id }}">
                                            
                                            <input type="submit" value="Upload Files" class="btn btn-sm btn-success">
                                        </form>
                                    </div>
                                    
                                  </div>
                                </div>
                              </div>
                             </div>
                            @endif
                          @endforeach
                          
                          
                          <!-- Edit Task -->
                          @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
                            @if($per == 17)
                              <!-- Edit modal -->
                                @if($task->status == 1)
                                  <a href="#" class="me-2"><i class="far fa-edit open" data-bs-toggle="modal" data-bs-target="#edit_modal_{{ $task->id }}" style="color:green;"></i></a>
                                @endif
                                <div class="modal" tabindex="-1" id="edit_modal_{{ $task->id }}">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
        
                                      <div class="modal-header">
                                        <h5 class="modal-title">Edit - {{ $task->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
        
                                      <form action="{{ route('update-task') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            
                                            <!-- Task name -->
                                            <div class="row">
                                                <div class="">
                                                    <div class="mb-3">
                                                        <label for="upload files">Project Name</label>
                                                        <input type="text" name="task_name" class="form-control" value="{{ $task->name }}" id="first_name" placeholder="Task Name" required>
                                                    </div>        
                                                </div>
                                            </div>
                                            
                                            <!-- Projects -->
                                            <div class="row">
                                                <div class="">
                                                    <div class="mb-3">
                                                        <label for="roles">Clients</label>
                                                        <select name="project_id" id="project_id" class="form-control" required>
                                                            <option selected disabled hidden>-- SELECT CLIENT --</option>
                                                            @if($projects->count() != 0)
                                                                @foreach($projects as $project)
                                                                    <option value="{{ $project->id }}" @if($task->project_id == $project->id) selected @endif>{{ $project->name }}</option>
                                                                @endforeach
                                                            @else
                                                                <option value="" style="font-style:italic;">Projects Not Found</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Description -->
                                            <div class="row">
                                                <div class="">
                                                    <div class="mb-3">
                                                        <label for="roles">Editor's Notes</label>
                                                        <textarea name="description" id="description" class="form-control" cols="30" rows="5">{{ $task->description }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
        
                                            <!-- Caption -->
                                            <div class="row">
                                                <div class="">
                                                    <div class="mb-3">
                                                        <label for="roles">Post Caption</label>
                                                        <textarea name="caption" id="caption" class="form-control" cols="30" rows="5" placeholder="Post Caption">{{ $task->caption }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Caption status -->
                                            <div class="row">
                                                <div class="">
                                                    <div class="mb-3">
                                                        <label for="roles">Caption Status</label>
                                                        <select class="form-control" name="caption_status">
                                                            
                                                            <option disabled selected hidden>-- SELECT CAPTION STATUS --</option>
                                                            <option value="12" @if($task->caption_status == 12) selected @endif>Caption Waiting For Approval</option>
                                                            <option value="13" @if($task->caption_status == 13) selected @endif>Revise Caption</option>
                                                            <option value="14" @if($task->caption_status == 14) selected @endif>Caption Approved</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
        
                                            <!-- Assigend to -->
                                            <div class="row">
                                                <div class="">
                                                    <div class="mb-3">
                                                        <label for="roles">Assigned To</label>
                                                        <select name="user_id" id="user_id" class="form-control">
                                                            <option selected disabled hidden>-- PROJECT ASSIGNED TO USER --</option>
                                                            @if($users->count() != 0)
                                                                @foreach($users as $user)
                                                                  <option value="{{ $user->id }}" @if($task->user_id == $user->id) selected @endif>{{ $user->first_name }} {{ $user->last_name }}</option>
                                                                @endforeach
                                                            @else
                                                                <option value="" style="font-style:italic;">Users Not Found</option>
                                                            @endif
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
        
                                            <!-- Post Date -->
                                            <div class="row">
                                                <div class="">
                                                    <div class="mb-3">
                                                        @if($task->deadline != null)
                                                            <?php $post_date_deadline = Carbon\Carbon::create($task->deadline);?>
                                                            <label for="post date">Post Date </label>
                                                            <input type="date" name="deadline" value="{{$post_date_deadline->year}}-{{ $post_date_deadline->format('m-d') }}" class="form-control" >
                                                        @else
                                                            <label for="post date">Post Date </label>
                                                            <input type="date" name="deadline" value="" class="form-control" >
                                                        @endif
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Due Date -->
                                            <div class="row">
                                                <div class="">
                                                    <div class="mb-3">
                                                        @if($task->due_to_date)
                                                            <?php $due_date_deadline = Carbon\Carbon::create($task->due_to_date);?>
                                                            <label for="post date">Due Date </label>
                                                            <input type="date" name="due_to_date" value="{{$due_date_deadline->year}}-{{ $due_date_deadline->format('m-d') }}" class="form-control" >
                                                        
                                                        @else
                                                            <label for="post date">Due Date </label>
                                                            <input type="date" name="due_to_date" value="" class="form-control" >
                                                        @endif
                                                        
                                                    </div>
                                                </div>
                                            </div>
        
                                            <!-- Task id -->
                                            <input type="hidden" name="task_id" value="{{ $task->id }}">
                                        </div>
        
                                        <!-- modal footer starts -->
                                        <div class="modal-footer">
                                          <!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
                                          <input type="submit" class="btn btn-sm btn-outline-primary" value="Update">
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                            @endif
                          @endforeach
                          
                          <!-- Delete Project -->
                          @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
                            @if($per == 18)
                                <!-- Delete -->
                                @if($task->status == 1)
                                    <a class="delete-project-trigger" data='{{ $task->id }}'><i class="far fa-trash-alt"  style="color:red;"></i></a> 
                                @endif
                            @endif
                          @endforeach
    
                      </td>
    
                    </tr>
    
                    <!-- Revine task modal -->
                    <div class="modal" tabindex="-1" id="revine_task_modal_{{ $task->id }}">
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
                                <input type="hidden" name="main_task_id" value="{{ $task->id }}">
    
                                <!-- Subtask id -->
                                <input type="hidden" name="sub_task_id" value="{{ $sub_tasks->where('main_task', $task->id)->where('revined', 0)->pluck('id')->first() }}">
                            </div>
    
    
                            <!-- modal footer starts -->
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <input type="submit" class="btn btn-primary" value="Send">
                            </div>
    
                          </form>
                        </div>
                      </div>
                    </div>
              @endforeach
            @endif
            </tbody>
        </table>
      </section>
</main>


<!-- Delete client confirm modal -->
<div class="modal" tabindex="-1" id="confirm-delete-project-modal">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action="{{ route('delete-task') }}" method='POST' class='form'>
            @csrf
          <div class="modal-body">
            <p id='message_in_confirm_delete_project_modal'></p>
            <input type='hidden' name='id' id='id_in_confirm_delete_project_modal' value=''>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
          </div>
      </form>
    </div>
  </div>
</div>

@include("layouts.footer")