@include("layouts.header")
<style>
.fc-agendaWeek-button{
    padding: 0px;
    width: 60px;
    border-radius: 15px;
    background: transparent;
    border: 2px solid #9e5fff;
    /*display:none;*/
}
.fc-month-button{
    padding: 0px !important;
    width: 70px;
    border-radius: 15px !important;
    background: transparent;
    border: 2px solid #9e5fff;
    /*display:none;*/
}
.fc-agendaDay-button {
    padding: 0px !important;
    width: 60px;
    border-radius: 15px !important;
    background: transparent;
    border: 2px solid #9e5fff;
    /*display:none;*/
}
.fc-today-button{
   border-radius: 15px !important;
    background: transparent;
    border: 2px solid #9e5fff; 
    
}
 .narkaathi {
     padding:0px !important;
    width: 1.0em;
    height: 1.0em;
    background-color: white;
    border-radius: 50%;
    vertical-align: middle;
    appearance: none;
    -webkit-appearance: none;
    outline: none;
    cursor: pointer;
}

 
.fc-prev-button{
    border-radius: 50% !important;
    padding: 0px !important;
    width: 40px;
    background:transparent !important;
    border:1px solid silver;
} 
.fc-button-group{
    display:flex;
    gap:15px;
}
.fc-next-button{
    border-radius: 50% !important;
    padding: 0px !important;
    width: 40px;
    background:transparent !important;
    border:1px solid silver;
} 
.fc-icon-left-single-arrow{
    margin:0px !important;
    color: #9e5fff; 
}
.fc-next-button{
    margin:0px !important;
    color: #9e5fff; 
}
</style>

{{-- <link rel="stylesheet" href="{{ asset('calender/fullCal.css') }}"> --}}
<main class="container mt-5 pt-5">
    <!-- Manage role starts -->
    <section id="second-container">
    <input type="hidden" class="user_id" value="{{ Session::get('user')->id }}">
        <input type="hidden" class="role_id" value="{{ Session::get('user')->role_id }}">
        <div class="modal" tabindex="-1" id="view_task_detail">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <span class="task_title"></span>
                            <span class="view_task_label"></span>

                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p class="d-flex justify-content-between">
                            <span><b>User Name:</b></span>
                            <span class="username"></span>
                        </p>
                        
                        <p class="d-flex justify-content-between">
                            <span><b>Deadline:</b></span>
                            <span class="deadline"></span>

                        </p>
                        <p>
                            <span><b>Description:</b></span><br>
                            <span class="desc"></span>
                        </p>

                        <!-- MAIN PROJECT ATTACHEMNTS -->
                        <div style="display:block" class="attData">
                            
                        </div>
                        
                        <!-- PROJECT SUBTASK -->
                        <div class="subtas-container" id="sub_task" style="border:1px solid lightgrey; padding:15px;">
                            <div id="subtask_status" style="display:flex; justify-content:end; font-weight:bold;">
                                
                            </div>
                            
                            <div style="display:flex; justify-content:space-between;">
                                <span><b>Subject: </b></span>
                                <span id="subtask_subject"></span>
                            </div>
                            
                            <div style="display:flex; justify-content:space-between;">
                                <span><b>Description: </b></span>
                                <span id="subtask_description"></span>
                            </div>
                            
                            <!-- Subtask attatchments -->
                            <div id="sub_attachments"></div>
                            
                        </div>
                        
                        
                    </div>

                    <!-- modal footer starts -->
                    <div class="modal-footer">
                        @if (Session::get('user')->role_id == 1)
                            <a href="javascript:void(0)" class="btn btn-danger callRevine revine-btn">Revine</a>
                            <a href="" class="btn btn-light approve approve-btn" style="background-color: var(--approve-color); color:white;">Approve</a>
                            <label class="msg approved-label" style="text-align:center; background-color: var(--approve-color); color:white; padding:5px; width:100%;">Task Has Approved </label>
                            <label class="revinedd revined-tabel" style="text-align:center; background-color: var(--reject-color); color:white; padding:5px; width:100%;"> Task Has Revined </label>
                        @elseif(Session::get('user')->role_id != 1)
                            <label class="msg " style="text-align:center; background-color: var(--approve-color); color:white; padding:5px; width:100%;">Task Approved </label>
                            <a href="" class="btn btn-light progres in-progress-btn" style="background-color:var(--in_progress-color); color:white;">In Progress</a>
                            <a href="" class="btn btn-light complete complete-btn" style="background-color:var(--complete-color); color:white;">Complete</a>
                            <label class="complete_msg" style="text-align:center; background-color: var(--complete-color); color:white; padding:5px; width:100%;">Task Has Competed </label>
                        @endif

                        {{-- {{ route('update-status', ['status_id' => 3, 'task_id' => $task->id]) }} --}}

                        {{-- @elseif(Session::get("user")->role_id != 1) --}}

                        {{-- @if ($task->color_id == 1)
                                <a href="{{ route('update-status', ['status_id' => 2, 'task_id' => $task->id]) }}"
                                    class="btn btn-light"
                                    style="background-color:@if ($colors->count() != 0) {{ $colors->find(2)->status_color }}; @else 'lightblue' @endif color:white;">In
                                    Progress</a>
                            @elseif($task->color_id == 2)
                                <a href="{{ route('update-status', ['status_id' => 4, 'task_id' => $task->id]) }}"
                                    class="btn btn-light"
                                    style="background-color:@if ($colors->count() != 0) {{ $colors->find(4)->status_color }}; @else 'lightblue' @endif color:white;">Complete</a>
                            @elseif($task->color_id == 4)
                                <p style="color: {{ $colors->find(4)->status_color }}">
                                    Waiting for approval, on task rejection status will be
                                    pending again.</p>
                            @elseif($task->color_id == 5)
                                <p class="btn btn-light"
                                    style="background-color:@if ($colors->count() != 0) {{ $colors->find(5)->status_color }}; @else 'lightblue' @endif color:white;">
                                    Task revined {{ $task->parent_id }} times.</p>
                            @elseif($task->color_id == 3)
                                <p
                                    style="background-color:@if ($colors->count() != 0) {{ $colors->find(2)->status_color }}; @else 'lightblue' @endif color:white; width:100%; text-align:center; padding:10px">
                                    TASK APPROVED</p>
                            @endif --}}

                        {{-- @endif --}}
                    </div>

                    </form>
                </div>
            </div>
        </div>
        
        
        
<div class="modal" tabindex="-1" id="add_task_modal_date_wise">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <div class="modal-header">
                                <h5 class="modal-title">Add Project</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              
                              <form action="{{ route('add-task') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="">
                                            <div class="mb-3">
                                                <input type="text" name="task_name" class="form-control" value="" id="first_name" placeholder="Project Name" required>
                                            </div>        
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="">
                                            <div class="mb-3">
                                                <textarea name="description" id="description" class="form-control" cols="30" rows="5" placeholder="Project Description"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Projects -->
                                    <div class="row">
                                        <div class="">
                                            <div class="mb-3">
                                                <label for="roles">Projects</label>
                                                <select name="project_id" id="roles" class="form-control" required>
                                                @if($projects->count() != 0)
                                                    @foreach($projects as $project)
                                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="" style="font-style:italic;">Projects Not Found</option>
                                                @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Users -->
                                    <div class="row">
                                        <div class="">
                                            <div class="mb-3">
                                                <label for="roles">Assigned To</label>
                                                <select name="user_id" id="roles" class="form-control" required>
                                                @if($users->count() != 0)
                                                    @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="" style="font-style:italic;">Users Not Found</option>
                                                @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Deadline -->
                                    <div class="row">
                                        <div class="">
                                            <div class="mb-3">
                                                <label for="deadline">Deadline</label>
                                                <input type="date" name="deadline" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="created_date" class="created_date" value="">
                                    <!-- Files -->
                                    <div class="row">
                                        <div class="">
                                            <div class="mb-3">
                                                <label for="deadline">Upload files</label>
                                                <input type="file" name="task_files[]" class="form-control" multiple>
                                            </div>
                                        </div>
                                    </div>


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
        
        <!-- Revine task modal -->
        <div class="modal" tabindex="-1" id="revine_task_modal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Add Sub Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
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
                                        <textarea name="description" id="description" class="form-control" cols="30" rows="5" placeholder="Description"></textarea>
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
                            <input type="hidden" class="main_id" name="main_task_id" value="">

                            <!-- Subtask id -->
                            <input type="hidden" class="sub_task_id" id="sub_task_id_in_modal" name="sub_task_id" value="">
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
        <div class="row mt-4">
            <div>
                <h1 class="text-center">Projects Calender</h1>
            </div>

            @if(Session::get('user')->role_id == 1)
                <h4>Filter Project By Status</h4> 
            <div class="d-flex flex-wrap"> 
                    <!--<div class="form-check form-switch">-->
                    <!--    <input type="checkbox" value="" class="form-check-input ViewAll" checked/> -->
                    <!--    <label> View All </label> -->
                    <!--</div> &nbsp; &nbsp;-->
                    @foreach($colors as $color)
                <div class="form-check form-switch ">
                        <input type="checkbox" name="{{ $color->status_color }}" data="{{ $color->status_name }}" class="narkaathi colorCheck" value="{{ $color->id }}" style="border:2px solid {{ $color->status_color }}" checked/> 
                        <label> {{ $color->status_name }} </label>&nbsp; &nbsp; &nbsp;
                </div>
                    @endforeach
            </div>
            <div class="col-md-2 mt-4 d-flex flex-column"> 
                    
                    
                    
            <h4 class="mb-5"> Filter Projects By Clients </h4> 
                <div class="form-check form-switch">
                        <input type="checkbox" value="" class="form-check-input ViewAll" checked/> 
                        <label> View All </label> 
                    </div> &nbsp; &nbsp;
                @foreach($users as $user)
                    <div class="form-check form-switch">
                        <input type="checkbox" value="{{ $user->id }}" class="form-check-input clientName" checked/> 
                        <label> {{ $user->first_name }} {{ $user->last_name }} </label> 
                    </div>
                @endforeach
            </div>
            @endif
            <div class="col-md-10 mt-4">
                <div class="container">
                    <div id='calendar'></div>
                </div>
            </div>

        </div>
    </section>
    
</main>



@include("layouts.footer")
