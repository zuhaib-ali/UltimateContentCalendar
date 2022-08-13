@include("layouts.header")

<main class="container mt-5 pt-5">
<section id="second-container3">
        <center><h2 style="font-weight:400;">Unapproved Task Files</h2></center>
        <div class="main-container-two">
            <div class="welcome-note-two"></div>
        </div>
        
        <br><br>
        
        <table id="clients_datatable" class="display">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Task File Name</th>
                    <th scope="col">Project Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($unapproved_task_files->count() != 0)
                    <?php $index = 1; ?>
                    @foreach($unapproved_task_files as $files)
                        <tr>
                            <td>{{ $index++ }}</td>
                            <td>{{ $files->file_name }}</td>
                            <td>{{ $files->name }}</td>
                            <td>
                                <a href="{{ asset('task_files') }}/{{ $files->file_name }}" class="btn btn-sm btn-outline-success">Open</a>
                                <a href="#" data-id="{{ $files->id }}" class="btn btn-sm btn-outline-primary approve_task_file">Approve</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
      </section>
</main>


<!-- View project modal -->
<div class="modal" tabindex="-1" id="view_project_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" style="text-transform:uppercase;"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-8 col-8">
                    
                    <div class="d-flex gap-2">
                        <p style="font-weight:600; margin:0; text-transform: uppercase;">E-Mail: </p>
                        <em id="client_view_email"></em>
                    </div>
                </div>
                <div class="col-md-4 col-4">    
                    <div class="d-flex gap-2">
                        <p style="font-weight:600; margin:0; text-transform: uppercase;">Role: </p>
                        <em id="client_view_role"></em>
                    </div>
                </div>
                
                
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    
            
                    <div>
                        <p style="font-weight:600; margin:0; text-transform: uppercase;">Description: </p>
                        <em id="client_view_descritpion"></em>
                    </div>
                </div>
                
            </div>
            <div class="row">
            <div class="col-md-12">
                <div>
                    <p style="font-weight:600; margin:0; text-transform: uppercase;">Permissions: </p>
                    <ul id="client_view_permissions" style="font-style: italic;"></ul>
                </div>
            </div>
            
            </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Edit project modal -->
<div class="modal" tabindex="-1" id="edit_project_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ route('update-project') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

          <!-- Bussiness Name -->
          <div class="form-group mb-3">
            <label for="">First Name</label>
            <input type="text" id="edit_project_first_name" name="bussiness_name" value="" class="form-control">
          </div>

          <!-- Description -->
          <div class="form-group mb-3">
            <label for="">Description</label>
            <textarea name="description" cols="30" rows="3" class="form-control" value="" id="edit_project_description"></textarea>
          </div>
          
          <!-- Roles -->
          <div class="form-group mb-3">
            <label for="">Role</label>
            <select id="edit_project_role" class="form-control" name="role"></select>
          </div>
          
          <!-- Users -->
          <!--<div class="form-group mb-3">-->
          <!--  <label for="">Users</label>-->
          <!--  <select id="edit_project_user" class="form-control" name="user"></select>-->
          <!--</div>-->
          
          <!-- Password -->
          <div class="form-group mb-3">
            <label for="">Password</label>
            <input type="password" name="password" value="" placeholder="************" class="form-control">
          </div>
          
          <!-- Client Profile -->
          <div class="form-group mb-3">
            <label for="">Profile</label>
            <input type="file" name="client_profile" id="update_client_profile" value="" class="form-control">
            <input type="hidden" name="client_old_profile" id="client_old_profile" value="">
          </div>

          <!-- Project id -->
          <input type="hidden" name="edit_project_id" id="edit_project_id" value="">
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
          <input type="submit" class="btn btn-sm btn-outline-primary" value="Update">
        </div>
        
      </form>
    </div>
  </div>
</div>
<!-- edit modal ends -->


<!-- Delete client confirm modal -->
<div class="modal" tabindex="-1" id="confirm-delete-client-modal">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action="{{ route('delete-project') }}" method='POST' class='form'>
            @csrf
          <div class="modal-body">
            <p id='message_in_confirm_delete_client_modal'></p>
            <input type='hidden' name='id' id='id_in_confirm_delete_client_modal' value=''>
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