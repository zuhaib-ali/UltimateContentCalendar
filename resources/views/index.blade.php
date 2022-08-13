@include("layouts.header")

<main class="container mt-5 pt-5">
  <div class="row">
    <div class="col-12">
      <center>
        <h2>Dashboard</h2>
      </center>
      
    </div>
  </div>

  <div class="row">
    <div class="col-12 boxes">
      @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
        @if($per == 1)
          <div class="card bg-danger text-white">
            <div class="card-body">
              <center>
                <h2>Add Role and Permissions</h2>
              </center>
            </div>
            <div class="card-footer">
              <center><a href="{{ route('roles') }}">View</a></center>
            </div>
          </div>
        @endif
      @endforeach

      @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
          @if($per == 1)
            <div class="card bg-success text-white">
              <div class="card-body">
                <center>
                  <h2>Roles</h2>
                  <h3>{{ $roles->count() }}</h3>
                </center>
              </div>
              <div class="card-footer">
                <center><a href="{{ route('manage_roles') }}">View</a></center>
              </div>
            </div>
        @endif
      @endforeach

        <!-- Users -->
        @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
          @if($per == 2)
            <div class="card bg-primary text-white">
              <div class="card-body">
                <center>
                  <h2>Users</h2>
                  <h3>{{ $users->count() }}</h3>
                </center>
              </div>
              <div class="card-footer">
                <center><a href="{{ route('users') }}">View</a></center>
              </div>
            </div>
          @endif
        @endforeach
        
      
        <!-- Clients -->
        @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
          @if($per == 3)
            <div class="card bg-warning text-white">
              <div class="card-body">
                <center>
                  <h2>Clients</h2>
                  <h3>{{ $projects->count() }}</h3>
                </center>
              </div>
              <div class="card-footer">
                <center><a href="{{ route('projects') }}">View</a></center>
              </div>
            </div>
          @endif
        @endforeach

        <!-- Projects -->
        @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
          @if($per == 4)
            <div class="card bg-primary text-white">
              <div class="card-body">
                <center>
                  <h2>Projects</h2>
                  @if(Session::get("user")->role_id == 1)
                    <h3>{{ $tasks->count() }}</h3
                    
                  @else
                    <h3>{{ $tasks->count() }}</h3>
                  @endif
                </center>
              </div>
              <div class="card-footer">
                <center><a href="{{ route('tasks') }}">View</a></center>
              </div>
            </div>
          @endif
        @endforeach
        
        <!-- Calendar-->
        {{-- @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
          @if($per == 6)
          <div class="card bg-danger text-white">
            <div class="card-body">
              <center>
                <h2>Calendar</h2>
                
              </center>
            </div>
            <div class="card-footer">
              <center><a href="{{ url('task_calender_wise') }}">View</a></center>
            </div>
          </div>
          @endif
        @endforeach --}}
        
        <!-- View comments -->
        @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
          @if($per == 10)
          <div class="card bg-success text-white">
            <div class="card-body">
              <center>
                <h2>Comments</h2>
                @if(Session::get("user")->role_id == 1)
                    <h3>{{ $comments->count() }}</h3>
                @endif
              </center>
              
            </div>
            <div class="card-footer">
              <center><a href="{{ url('/comments_view') }}">View</a></center>
            </div>
          </div>
          @endif
        @endforeach
        
        <!-- View comments -->
        @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
          @if($per == 30)
          <div class="card bg-success text-white">
            <div class="card-body">
              <center>
                <h2>Companies</h2>
                @if(Session::get("user")->role_id == 1)
                    <h3>{{ $companies->count() }}</h3>
                @endif
              </center>
              
            </div>
            <div class="card-footer">
              <center><a href="{{ route('companies') }}">View</a></center>
            </div>
          </div>
          @endif
        @endforeach
        
        
        <!-- Dummy Calendar-->
        @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
          @if($per == 12)
          <div class="card bg-danger text-white">
            <div class="card-body">
              <center>
                <h2>UC Calendar</h2>
              </center>
            </div>
            <div class="card-footer">
              <center><a href="{{ route('dummyCal') }}">View</a></center>
            </div>
          </div>
          @endif
        @endforeach

        <!-- Settings -->
        @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
          @if($per == 5)
          <div class="card bg-warning text-white">
            <div class="card-body">
              <center>
                <h2>Settings</h2>
                
              </center>
            </div>
            <div class="card-footer">
              <center><a href="{{ route('settings') }}">View</a></center>
            </div>
          </div>
          @endif
        @endforeach
        
        
        <!-- Settings -->
        @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
          @if($per == 29)
          <div class="card bg-warning text-white">
            <div class="card-body">
              <center>
                <h2>Packages</h2>
              </center>
            </div>
            <div class="card-footer">
              <center><a href="{{ route('packages') }}">View</a></center>
            </div>
          </div>
          @endif
        @endforeach

    </div>
  </div>
</main>

@include("layouts.footer")