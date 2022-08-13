    @include("layouts.header")
    <!--Container Main start-->
    <div class="container main-container">
      <div id="Second-container2">
        <div class="row mt-4">
          <form action="{{ route('add_role_permissions')  }}" method="POST" class="form">
            @csrf
            <div>
              <h1 class="text-center">Role</h1>

            </div>
            <div class="mt-3 m-auto">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Add Role</label>
                <input type="text" name="role" class="form-control" id="exampleFormControlInput1" placeholder="Role">
              </div>
              <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Notes</label>
                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
              </div>
            </div>

            <div class="m-auto mt-4">
                
                <table id="permissions_datatable" class="display">
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
                                        <input class="form-check-input" name="permissions[]" type="checkbox" value="{{ $permission->id }}" id="flexCheckChecked">
                                      </div>
                                    </td>
                                </tr>
                            @endforeach
                          @endif  
                    </tbody>
                </table>
            </div>

            <div class="text-center my-4">
              <button type="submit" class="btn btn-info">Create</button>
            </div>
          </form>

        </div>
      </div>
      <!-- Create role and permsion ends -->
    </div>
  </div>

  <!-- JavaScript Bundle with Popper -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script> -->

@include("layouts.footer")
