@include("layouts.header")

<main class="container mt-5 pt-5">
<section id="second-container3">
        <div class="main-container-two">
            <div class="welcome-note-two">
              <h4>Projects, {{ $tasks->count() }}</h4>
            </div>
          <div>
          </div>
        </div>
        <!-- TABLES START -->
        <table class="table table-striped table-hover table-bordered mt-5">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Project</th>
              <th scope="col">Client</th>
              <th scope="col">Status</th>
              <th scope="col">Created At</th>
              <th scope="col" style="width:130px;">Actions</th>
            </tr>
          </thead>

          <tbody>
            <?php $no =1; ?>
              @foreach($tasks as $task)
                <tr class="notify_tr" data="{{ $task->id }}" style="background-color:#ebfaff;">
                  <th scope="row">{{ $no++ }}</th>
                  <td>{{ $task->name }}</td>
                  <td>{{ $task->project_name }}</td>
                  <td><span style="color:{{ $task->status_color }}; font-weight:bold; text-transform:uppercase">{{ $task->status_name }}</span></td>
                  <td>{{ substr($task->created_date,0,11) }}</td>
                  <td> <a href='javascript:void(0)' class="read_task" style='color:black;'><i class='bx bx-check-double' style='font-size:28px;'></i></a></td>
                </tr>
              @endforeach
          </tbody>
        </table>
        <!-- TABLES END -->
      </section>
</main>

@include("layouts.footer")
