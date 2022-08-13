@include("layouts.header")

<main class="container mt-5 pt-5">
    <!-- Manage role starts -->
    <section id="second-container">
        <div class="row mt-4">
          <div>
            <h3 class="text-center">Manage Role</h3>
          </div>
          <div class="m-auto mt-4">
                <table id="roles_datatable" class="display">
                    <thead>
                        <tr>
                            <th scope="col" width="10%">#</th>
                            <th scope="col" width="30%">Role name</th>
                            <th scope="col" width="30%">Notes</th>
                            <th scope="col" width="20%">Permissions</th>
                            @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
                                @if($per == 24)
                                    <th scope="col" width="5%">Edit</th>        
                                @endif
                            @endforeach
                            
                            @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
                                @if($per == 25)
                                    <th scope="col" width="5%">Delete</th>        
                                @endif
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @if($roles->count() == 0)
                  <tr><td colspan="6">NO ROLE FOUND!</td></tr>
                @else
                  <?php $SNo = 1;?>
                  @foreach($roles as $role)

                    <tr>
                      <td>{{ $SNo++ }}</td>
                      <td>{{ $role->role }}</td>
                      <td>{{ $role->description }}</td>
                      
                      <td>
                        @if($role->permissions_id == 'NA')
                          NA
                        @else
                          <ol>
                            @foreach($role->permissions_id as $permission)
                              <li>{{ $permissions->find($permission)->name }}</li>
                            @endforeach
                          </ol>
                        @endif
                      </td>

                      
                          
                        @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
                            @if($per == 24)
                            <td>
                                <!-- Edit modal -->
                                <i class="far fa-edit open" data-bs-toggle="modal" data-bs-target="#edit_modal_{{ $role->id }}"></i>
                                
                                  <div class="modal" tabindex="-1" id="edit_modal_{{ $role->id }}">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
        
                                        <div class="modal-header">
                                          <h5 class="modal-title">Edit {{ $role->role }}</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        
                                        <form action="{{ route('update_role') }}" method="POST">
                                          @csrf
                                          <div class="modal-body">
                                            <div class="row">
                                              <div class="col-6">
                                                <p>Role Name</p>
                  
                                              </div>
                                              <div class="col-6">
                                                <div class="mb-3">
                                                  <input type="text" name="role" class="form-control" value="{{ $role->role }}" id="exampleFormControlInput1" placeholder="Role Name">
                                                </div>
                  
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-6">
                                                <p>Discription</p>
                  
                                              </div>
                                              <div class="col-6">
                                                <div class="mb-3">
                                                  <textarea class="form-control" name="description" value="" id="exampleFormControlTextarea1" rows="3">{{ $role->description }}</textarea>
                                                </div>
                  
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-12">
                                                <table class="table">
                                                  <thead>
                                                    <tr>
                                                      <th scope="col" width="20%">#</th>
                                                      <th scope="col" width="60%">Permission</th>
                                                      <th scope="col" width="20%">Action</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    @if($permissions->count() != 0)
                                                      <?php $no =1; ?>
                                                      @foreach($permissions as $permission)
                                                        @if($permission->id == 6 || $permission->id == 23)
                                                            @continue;
                                                        @endif
                                                      <tr>
                                                        <th scope="row">{{ $no++ }}</th>
                                                        <td>{{ $permission->name }}</td>
                                                        <td>
                                                          <div class="form-check">
                                                            
                                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" @if($role->permissions_id != "NA") @foreach($role->permissions_id as $per) @if($per == $permission->id) checked @endif @endforeach @endif>
                                                            
                                                          </div>
                                                        </td>
                                                      </tr>
        
                                                      @endforeach
                                                    @endif
                                                  </tbody>
        
                                                </table>
                                                <!-- tables ends -->
                                              </div>
                                            </div>
                                          </div>
                                          <!-- Modal body ends -->
        
                                          <!-- Role id -->
                                          <input type="hidden" name="id" value="{{ $role->id }}">
        
                                          <!-- modal footer starts -->
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-primary" value="Update">
                                            <!-- <button type="submit" class="btn btn-primary">Save changes</button> -->
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>    
                                </td>
                            @endif
                        @endforeach
                      
                      
                        
                        @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
                            @if($per == 25)
                                <td>
                                    <!-- Delete Role -->
                                    <a class="delete-role-trigger" data='{{ $role->id }}'><i class="far fa-trash-alt"  style="color:red;"></i></a>
                                </td> 
                            @endif
                        @endforeach
                        
                    </tr>
                  @endforeach
                @endif
                    </tbody>
                </table>              
              
          </div>

        </div>
      </section>
</main>

<div class="modal" tabindex="-1" id="confirm-delete-role-modal">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action="{{ route('delete_role') }}" method='POST' class='form'>
            @csrf
          <div class="modal-body">
            <p id='message_in_confirm_delete_role_modal'></p>
            <input type='hidden' name='id' id='id_in_confirm_delete_role_modal' value=''>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
          </div>
      </form>
    </div>
  </div>
</div>

@include("layouts.footer")