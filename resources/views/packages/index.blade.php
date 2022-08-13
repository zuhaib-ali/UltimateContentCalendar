@include("layouts.header")

<main class="container mt-5 pt-5">
<section id="second-container3">
        <center><h2 style="font-weight:400;">PACKAGES</h2></center>
        <div class="main-container-two">
            <div class="welcome-note-two"></div>
            
            <div>
                <!-- Button trigger modal -->
                @if(!empty($packages))
                  @if($packages->count() <=2)
                    <button class="btn btn-outline-success" data-bs-toggle="modal"  data-bs-target="#add_package" type="button">Create packages</button>
                  @endif
                @endif
                
                <!-- Modal -->
                <div class="modal fade" id="add_package" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('create_package') }}" method="POST" class='form' enctype="multipart/form-data">
                            @csrf
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create New packages</h5>
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
                                
                                <!-- Bussiness amount -->
                                <div class="row">
                                    <div class="">
                                        <div class="mb-3">
                                            <label for="">Amount</label>
                                            <input type="text" name="amount" class="form-control" value="" required>
                                        </div>        
                                    </div>
                                </div>
                                
                                <!-- packages Description-->
                                <div class="row">
                                    <div class="">
                                        <div class="mb-3">
                                            <label for="">Description</label>
                                            <textarea name="description" id="description" class="form-control" cols="30" rows="5"></textarea>
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
                    <th scope="col">Name</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Description</th>
                    <th scope="col" style="width:130px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $row_index = 1; ?>
                @if(!empty($packages))
                    @foreach($packages as $package)
                        <tr>
                            <td>{{ $row_index++ }}</td>
                            <td>{{ $package->name }}</td>
                            <td>${{ $package->amount }}</td>
                            <td>{{ $package->description }}</td>
                            <td>
                                <a class="update_package me-5" data-id="{{ $package->id }}"><i class="far fa-edit open" style="color:green;"></i></a>
                                <a class="delete_package" data-id="{{ $package->id }}"><i class="far fa-trash-alt"  style="color:red;"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                
            </tbody>
        </table>
      </section>
</main>


<!-- Edit Package modal -->
<div class="modal" tabindex="-1" id="edit_package_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ route('update_package') }}" method="POST">
        @csrf
        <div class="modal-body">

          <!-- Name -->
          <div class="form-group mb-3">
            <label for="">Name</label>
            <input type="text" id="edit_package_name" name="name" value="" class="form-control">
          </div>
          
          <!-- Name -->
          <div class="form-group mb-3">
            <label for="">Amount</label>
            <input type="text" id="edit_package_amount" name="amount" value="" class="form-control">
          </div>

          <!-- Description -->
          <div class="form-group mb-3">
            <label for="">Description</label>
            <textarea name="description" cols="30" rows="3" class="form-control" value="" id="edit_package_description"></textarea>
          </div>
          
          <!-- Package id -->
          <input type="hidden" name="id" id="edit_package_id" value="">
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <input type="submit" class="btn btn-sm btn-outline-primary" value="Update">
        </div>
        
      </form>
    </div>
  </div>
</div>
<!-- edit modal ends -->


<!-- Delete client confirm modal -->
<div class="modal" tabindex="-1" id="delete_package_modal">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action="{{ route('delete_package') }}" method='POST' class='form'>
            @csrf
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id='message_in_confirm_delete_package_modal'></p>
                <!-- Package id -->
                <input type="hidden" name="id" id="delete_package_id" value="">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
            </div>
      </form>
    </div>
  </div>
</div>

@include("layouts.footer")