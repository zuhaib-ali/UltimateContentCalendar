@include("layouts.header")

<main class="container mt-5 pt-5">
    <section id="second-container3">
        <center><h2 style="font-weight:400;">Companies</h2></center>
        <div class="main-container-two">
            <div class="welcome-note-two"></div>
            
            <div>
                <!-- Button trigger modal -->
                <button class="btn btn-outline-success" data-bs-toggle="modal"  data-bs-target="#create_company" type="button">Create Company</button>
                
                <!-- Modal -->
                <div class="modal fade" id="create_company" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('create-company') }}" method="POST" class='form' enctype="multipart/form-data">
                            @csrf
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create New Company</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                                <!-- Bussiness Name -->
                                <div class="row">
                                    <div class="">
                                        <div class="mb-3">
                                            <label for="">Name</label>
                                            <input type="text" name="name" class="form-control" value="" required>
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
                                            <input type="password" name="password" id="company_password" class="form-control" value="" placeholder="" required>
                                            <span style="color:lightgrey; font-size:12px;"><input type="checkbox" id="show_client_password" style="color:lightgrey;"> Show Password</span>
                                        </div>        
                                    </div>
                                </div>
                                
                                <!-- Permission Role -->
                                <div class="row">
                                    <div class="">
                                        <div class="mb-3">
                                            <label for="">Permission Role</label>
                                            <select class="form-control" name="role">
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

                                <!-- Profile -->
                                <div class="row">
                                    <div class="">
                                        <div class="mb-3">
                                            <label for="">Profile</label>
                                            <input type="file" name="profile" class="form-control">
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
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col" style="width:130px;">Actions</th>    
                </tr>
            </thead>
            
            <tbody>
                @if(empty($companies))
                    <tr><td colspan="6">NO COMPANY FOUND!</td></tr>
                @else
                    <?php $no =1; ?>
                    @foreach($companies as $company)
                        <tr>
                            <td>{{ $no++ }}</td>
                            
                            @if($company->img != null)
                                <td><img src="{{ asset('profile_images') }}/{{ $company->img }}" style="width:80px; height:80px; border-radius:50px;"></td>
                            @else
                                <td><img src="https://th.bing.com/th/id/OIP.GVNf0T8FuiJsPlWu4rOIUQHaHw?pid=ImgDet&rs=1" style="width:80px; height:80px; border-radius:50px;"></td>
                            @endif
                            
                            <td>{{ $company->first_name }}</td>
                            <td>{{ $company->email }}</td>
                            <td>{{ $roles->find($company->role_id)->role }}</td>
                            <td>
                                @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
                                    @if($per == 32)
                                        <a class="edit-company-trigger" data-id="{{ $company->id_of_company }}" data-bs-toggle="modal"><i class="far fa-edit open" ></i></a>|
                                    @endif
                                @endforeach
                                
                                @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
                                    @if($per == 33)
                                        <a class="delete-company-trigger" data-id='{{ $company->id_of_company }}'><i class="far fa-trash-alt"  style="color:red;"></i></a> 
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

<!-- Edit company modal -->
<div class="modal" tabindex="-1" id="edit_company_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

        <form action="{{ route('update-company') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                
              <!-- Name -->
              <div class="form-group mb-3">
                <label for="">Bussiness Name</label>
                <input type="text" id="edit_company_first_name" name="name" value="" class="form-control">
              </div>
              
              <!-- Roles -->
              <div class="form-group mb-3">
                <label for="">Role</label>
                <select id="edit_company_role" class="form-control" name="role"></select>
              </div>
              
              <!-- Password -->
              <div class="form-group mb-3">
                <label for="">Password</label>
                <input type="password" name="password" value="" placeholder="************" class="form-control">
              </div>

                <!-- company id -->
                <input type="hidden" name="id" id="edit_company_id" value="">
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


<!-- Delete company confirm modal -->
<div class="modal" tabindex="-1" id="confirm_delete_company_modal">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action="{{ route('delete-company') }}" method='POST' class='form'>
            @csrf
            <div class="modal-body">
                <p id='message_in_confirm_delete_company_modal'></p>
                <input type='hidden' name='id' id='delete_company_id' value=''>
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