@include("layouts.header")

<main class="container mt-5 pt-5">
<section id="second-container3">
        <center><h2 style="font-weight:400;">CLIENTS</h2></center>
        <div class="main-container-two">
            <div class="welcome-note-two"></div>
            
            <div>
                <!-- Button trigger modal -->
                @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
                  @if($per == 7)
                    <button class="btn btn-outline-success" data-bs-toggle="modal"  data-bs-target="#add_project" type="button">Add Client</button>
                  @endif
                @endforeach
                
                <!-- Modal -->
                <div class="modal fade" id="add_project" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('add-project') }}" method="POST" class='form' enctype="multipart/form-data">
                            @csrf
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create New Client</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                                <!-- Bussiness Name -->
                                <div class="row">
                                    <div class="">
                                        <div class="mb-3">
                                            <label for="">Bussiness Name</label>
                                            <input type="text" name="bussiness_name" class="form-control" value="" required>
                                        </div>        
                                    </div>
                                </div>
                                
                                <!-- E-Mail -->
                                <div class="row">
                                    <div class="">
                                        <div class="mb-3">
                                            <label for="">E-Mail</label>
                                            <input type="email" name="email" class="form-control" value="" placeholder="" required>
                                        </div>        
                                    </div>
                                </div>
                                
                                <!-- Password -->
                                <div class="row">
                                    <div class="">
                                        <div class="mb-3">
                                            <label for="">Password</label>
                                            <input type="password" name="password" id="client_password" class="form-control" value="" placeholder="" required>
                                            <span style="color:lightgrey; font-size:12px;"><input type="checkbox" id="show_client_password" style="color:lightgrey;"> Show Password</span>
                                        </div>        
                                    </div>
                                </div>
                                
                                <!-- Client Description-->
                                <div class="row">
                                    <div class="">
                                        <div class="mb-3">
                                            <label for="">Notes</label>
                                            <textarea name="description" id="description" class="form-control" cols="30" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Permission Role -->
                                <div class="row">
                                    <div class="">
                                        <div class="mb-3">
                                            <label for="">Permission Role</label>
                                            <select class="form-control" name="client_role">
                                                @if($roles->count() != 0)
                                                    <option value="" disabled selected hidden> -- Select Role -- </option>
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->role }}</option>
                                                    @endforeach
                                                    
                                                @else
                                                    <option value="" disabled selected hidden> -- No Role Found! -- </option>
                                                @endif
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Users -->
                                {{-- <div class="row">
                                    <div class="">
                                        <div class="mb-3">
                                            <label for="">Users</label>
                                            <select name="user" class="form-control">
                                                @if($users->count() != 0)
                                                    <option value="" disabled selected hidden>-- Select User --</option>
                                                    @foreach($users as $user)
                                                        @if($user->id == 1)
                                                            @continue
                                                        @endif
                                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>    
                                                    @endforeach
                                                @else
                                                    <option value="" disabled selected hidden>-- No User Found! --</option>
                                                @endif
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}
                                
                                <!-- Profile -->
                                <div class="row">
                                    <div class="">
                                        <div class="mb-3">
                                            <label for="">Client Profile</label>
                                            <input type="file" name="client_profile" class="form-control">
                                        </div>
                                    </div>
                                </div>
                          </div>
                          
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm">Create</button>
                          </div>
                          
                      </form>
                    </div>
                  </div>
                </div>
          </div>
        </div>
        
        <br><br>
        
        <table id="clients_datatable" class="display">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Profile</th>
                    <th scope="col">Bussiness Name</th>
                    <th scope="col">E-Mail</th>
                    <th scope="col" style="width:130px;">Actions</th>
                </tr>
            </thead>
            <tbody>
            @if($client_users->count() == 0)
            <tr >
                <td colspan="6">NO CLIENT FOUND!</td>
            </tr>
                
            @else
                <?php $no =1; ?>
                @foreach($client_users as $client)
                <tr>
                    <td>{{ $no++ }}</td>
                    
                    @if($client->img != null)
                        <td><img src="{{ asset('profile_images') }}/{{ $client->img }}" style="width:80px; height:80px; border-radius:50px;"></td>
                    @else
                        <td><img src="https://th.bing.com/th/id/OIP.iYpFSu2O2kVP1OptEdJ-uwHaHx?w=180&h=189&c=7&r=0&o=5&pid=1.7" style="width:80px; height:80px; border-radius:50px;"></td>
                    @endif
                    
                    <td>{{ $client->client_name }}</td>
                    <td>{{ $client->email }}</td>
                    <td>
                        @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
                            @if($per == 13)
                                <!-- View Project -->
                                <a class="view_project_trigger" data="{{ $client->client_id }}"><i class="far fa-eye" ></i></a>|    
                            @endif
                        @endforeach
                        
                        <!-- Edit modal -->
                        @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
                            @if($per == 14)
                                <a class="edit_project_trigger" data="{{ $client->client_id }}" data-bs-toggle="modal"><i class="far fa-edit open" ></i></a>|
                            @endif
                        @endforeach
                        
                        <!-- Delete Client -->
                        @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
                            @if($per == 15)
                                <a class="delete-client-trigger" data='{{ $client->client_id }}'><i class="far fa-trash-alt"  style="color:red;"></i></a> 
                            @endif
                        @endforeach
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
                        <p style="font-weight:600; margin:0; text-transform: uppercase;">Notes: </p>
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
            <label for="">Bussiness Name</label>
            <input type="text" id="edit_project_first_name" name="bussiness_name" value="" class="form-control">
          </div>

          <!-- Description -->
          <div class="form-group mb-3">
            <label for="">Notes</label>
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