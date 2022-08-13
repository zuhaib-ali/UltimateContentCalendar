@include("layouts.header")

<main class="container mt-5 pt-5">
<section id="second-container3">
    <center><h2 style="font-weight:400;">USERS</h2></center>
    <div class="main-container-two">
      <div class="welcome-note-two"></div>
      
      <div>
          {{-- @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
            @if($per == 23) --}}
              <button class="btn btn-outline-success" data-bs-toggle="modal"  data-bs-target="#add_user" type="button">Add User</button>
            {{-- @endif
          @endforeach --}}
          
          
        
        <!-- Add user modal -->
            <div class="modal" tabindex="-1" id="add_user">
              <div class="modal-dialog">
                <div class="modal-content">
    
                  <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  
                  <form action="{{ route('add_user') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-6">
                          <div class="mb-3">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" class="form-control" value="" id="first_name" required>
                          </div>        
                        </div>
    
                        <div class="col-6">
                          <div class="mb-3">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="" id="last_name" required>
                          </div>
    
                        </div>
                      </div>
    
                      <div class="row">
                        <div class="col-7">
                          <div class="mb-3">
                          <label for="email">E-Mail</label>
                            <input type="email" name="email" class="form-control" value="" id="email" placeholder="E-Mail" required>
                          </div>
                        </div>
    
                        <div class="col-5">
                          <div class="mb-3">
                            <label for="roles">Roles</label>
                            <select name="role_id" id="roles" class="form-control">
                              @if($roles->count() != 0)
                                @foreach($roles as $role)
                                  <option value="{{ $role->id }}">{{ $role->role }}</option>
                                @endforeach
                              @else
                                <option value="" style="font-style:italic;">Roles Not Found</option>
                              @endif
                            </select>
                          </div>
                        </div>
                      </div>
    
                      <!-- Address -->
                      <div class="row">
                        <div class="col-12">
                          <div class="mb-3">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" cols="30" rows="3" class="form-control"></textarea>
                          </div>
                        </div>
                      </div>
    
                      <!-- Password -->
                      <div class="row add_user_password">
                        <div class="col-12">
                          <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" value="" id="password" placeholder="Password" required>
                            <input type="checkbox" id="show_password"> <span style="color:grey;"> Show password</span>
                          </div>
                        </div>
                      </div>
    
                      <!-- Image -->
                      <div class="row">
                        <div class="col-12">
                          <div class="mb-3">
                            <label for="profile_image">Profile image</label>
                            <input type="file" name="profile_image" class="form-control" id="profile_image">
                          </div>
                        </div>
                      </div>
    
                    </div>
                    <!-- Modal body ends -->
    
                    <!-- modal footer starts -->
                    <div class="modal-footer">
                      <!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
                      <input type="submit" class="btn btn-sm btn-outline-primary" value="Add">
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- add user modal ends -->
      </div>
    
    </div>
        
        <br><br>
        <table id="users_datatable" class="display">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Profile</th>
                    <th scope="col">Name</th>
                    <th scope="col">E-Mail</th>
                    <th scope="col">Address</th>
                    <th scope="col">Role</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            
            <tbody>
                @if($users->count() != 0)
            <?php $no =1; ?>
              @foreach($users as $user)
                <tr>
                  <td>{{ $no++ }}</td>
                  @if($user->img != null)
                    <td><img src="{{ asset('profile_images') }}/{{ $user->img }}" style="width:80px; height:80px; border-radius:50px;"></td>
                  @else
                    <td><img src="https://th.bing.com/th/id/OIP.iYpFSu2O2kVP1OptEdJ-uwHaHx?w=180&h=189&c=7&r=0&o=5&pid=1.7" style="width:80px; height:80px; border-radius:50px;"></td>
                  @endif
                  
                  <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->address }}</td>
                  @if($user->role_id == null)
                    <td>NA</td>
                  @else
                    <td><span style="background-color:skyblue; color:white; border-radius:50px; padding:5px 10px;">{{ $user->role }}</span></td>
                  @endif                  
                  <td>
                      
                    <!-- Edit User -->
                    @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
                        @if($per == 20)
                            <a href="#" class="me-2"><i class="far fa-edit open" data-bs-toggle="modal" data-bs-target="#edit_modal_{{ $user->id }}"></i></a>
                            <!-- Edit modal -->
                            <div class="modal" tabindex="-1" id="edit_modal_{{ $user->id }}">
                              <div class="modal-dialog">
                                <div class="modal-content">
    
                                  <div class="modal-header">
                                    <h5 class="modal-title">Edit - {{ $user->first_name }} {{ $user->last_name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  
                                  <form action="{{ route('update_user') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                      <div class="row">
                                        <div class="col-4">
                                          <p>Firsn Name</p>
            
                                        </div>
                                        <div class="col-8">
                                          <div class="mb-3">
                                            <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" id="exampleFormControlInput1" placeholder="First Name">
                                          </div>
            
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-4">
                                          <p>Last Name</p>
            
                                        </div>
                                        <div class="col-8">
                                          <div class="mb-3">
                                            <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" id="exampleFormControlInput1" placeholder="Last Name">
                                          </div>
            
                                        </div>
                                      </div>
    
                                      <div class="row">
                                        <div class="col-4">
                                          <p>E-Mail</p>
            
                                        </div>
                                        <div class="col-8">
                                          <div class="mb-3">
                                            <input type="text" name="email" class="form-control" value="{{ $user->email }}" id="exampleFormControlInput1" placeholder="Last Name">
                                          </div>
            
                                        </div>
                                      </div>
    
                                        <!-- ADDRESS -->
                                      <div class="row">
                                        <div class="col-4">
                                          <p>Address</p>
                                        </div>
                                        <div class="col-8">
                                          <div class="mb-3">
                                            <textarea name="address" id="" cols="30" rows="4" class="form-control">{{ $user->address }}</textarea>
                                          </div>
                                        </div>
                                      </div>
    
                                      <div class="row">
                                        <div class="col-4">
                                          <p>Roles</p>
                                        </div>
    
                                        <div class="col-8">
                                          <div class="mb-3">
                                            <select name="role" id="" class="form-control">
                                              <option value="" style="font-style:italic;">None</option>
                                              @if($roles->count() != 0)
                                                @foreach($roles as $role)
                                                  <option value="{{ $role->id }}" @if($user->role_id == $role->id) selected @endif>{{ $role->role}}</option>
                                                @endforeach
                                              @else
                                                <option value="" style="font-style:italic;">Roles Not Found</option>
                                              @endif
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                      
                                      <!-- Password -->
                                      <div class="row">
                                        <div class="col-4">
                                          <p>Password</p>
                                        </div>
                                        <div class="col-8">
                                          <div class="mb-3">
                                            <input type="password" name="password" placeholder="User Password" class="form-control">
                                            
                                          </div>
                                        </div>
                                      </div>
                                      
                                      <div class="row">
                                        <div class="col-4">
                                          <p>Image</p>
                                        </div>
                                        <div class="col-8">
                                          <div class="mb-3">
                                            <input type="file" value="" name="profile_image" class="form-control">
                                            <input type="hidden" name="user_old_profile" value="{{ $user->img }}">
                                          </div>
                                        </div>
                                      </div>
    
                                    </div>
                                    <!-- Modal body ends -->
                                    
    
                                    <!-- Role id -->
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
    
                                    <!-- modal footer starts -->
                                    <div class="modal-footer">
                                      <!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
                                      <input type="submit" class="btn btn-primary" value="Update">
                                    </div>
                                    
                                  </form>
                                </div>
                              </div>
                            </div>
                            |
                            <!-- edit modal ends -->
                        @endif
                    @endforeach
                    
                    <!-- Delete User -->
                    @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
                        @if($per == 21)
                            <!-- Delete user -->
                            <a class="delete-user-trigger" data='{{ $user->id }}'><i class="far fa-trash-alt"  style="color:red;"></i></a> 
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

<!-- Confirm Delete User -->
<div class="modal" tabindex="-1" id="confirm-delete-user-modal">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action="{{ route('delete_user') }}" method='POST' class='form'>
            @csrf
          <div class="modal-body">
            <p id='message_in_confirm_delete_user_modal'></p>
            <input type='hidden' name='id' id='id_in_confirm_delete_user_modal' value=''>
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