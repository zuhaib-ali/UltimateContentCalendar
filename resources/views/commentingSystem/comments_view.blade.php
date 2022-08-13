@include("layouts.header")
    <main class="container mt-5 pt-5">
        <div class="row">
            <div class="col-12">
              <div class="d-flex justify-content-between">
                <h3>Comments</h3>
                @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
                  @if($per == 11)
                    <a href="{{ url('comment') }}" class="btn btn-success" style="box-shadow:0px 0px 3px lightgrey;">CREATE COMMENT</a>
                  @endif
                @endforeach
                
              </div>
            </div>
        </div>
        
        <br><br>
        
        <div class="row">
            <div class="col-12">
                
                <table id="comments_datatable" class="display">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Platform</th>
                            <th>POST</th>
                            <th>Type</th>
                            <th>Sender</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($comments->count() != 0)
                            <?php $comment_no = 1; ?>
                            @foreach($comments as $comment)
                                <tr>
                                    <td>{{$comment_no++}}</td>
                                    
                                    <!-- Platform -->
                                    @if(str_contains($comment->platform, "instagram"))
                                        <td>Instagram</td>
                                        
                                    @elseif(str_contains($comment->platform, "facebook"))
                                        <td>Facebook</td>
                                        
                                    @elseif(str_contains($comment->platform, "twitter"))
                                        <td>Twitter</td>
                                    
                                    @elseif(str_contains($comment->platform, "youtube"))
                                        <td>Youtube</td>
                                        
                                    @elseif(str_contains($comment->platform, "google"))
                                        <td>Google</td>
                                        
                                    @elseif(str_contains($comment->platform, "linkedin"))
                                        <td>LinkedIn</td>
                                        
                                    @elseif(str_contains($comment->platform, "pinterest"))
                                        <td>Pintrest</td>
                                        
                                    @endif
                                    
                                    
                                    
                                    <td><iframe src="{{$comment->url}}" height="100" width="300"></iframe></td>
                                    <td>{{$comment->comment_type}}</td>
                                    @if($comment->first_name == "")
                                        <td>UNKNOWN</td>
                                    @else
                                        <td>{{$comment->first_name}} {{$comment->last_name}}</td>
                                    @endif
                                    @if($comment->color_id == 5)
                                        <td style="color:{{ $comment->status_color }}; font-weight:bold; text-transform:uppercase">Rejected</td>
                                    @else
                                        <td style="color:{{ $comment->status_color }}; font-weight:bold; text-transform:uppercase">{{ $comment->status_name }}</td>
                                    @endif
                                    
                                    
                                    <td>
                                      <!-- View comment -->
                                      <a class="me-2 comment_view_trigger" data="{{ $comment->id }}"><i class="fas fa-eye" style="color:black;"></i></a>
                                        @foreach(json_decode(Session::get("user")->permissions_id, TRUE) as $per)
                                            @if($per == 9) 
                                                <!-- Edit comment -->
                                                @if($comment->color_id == 1)
                                                    <a class="me-2 comment_edit_trigger" data="{{ $comment->id }}"><i class="fas fa-edit"></i></a>  
                                                @endif
                                              
                                              <!-- Delete commment -->
                                              <a href="{{ route('delete-comment', ['id'=> $comment->id]) }}" class="me-2"><i class="fas fa-trash" style="color:red;"></i></a>
                                            @endif
                                        @endforeach
                                        
                                        <!-- Share button -->
                                        @if(Session::get("user")->id != 1)
                                            @if($comment->status == 3)
                                                <a href="{{ $comment->platform }}{{ $comment->url }}&description={{ $comment->actual_comment }}" class="btn btn-sm btn-outline-success">Share</a>
                                            @endif
                                            
                                        @else
                                            <a href="{{ $comment->platform }}{{ $comment->url }}&description={{ $comment->actual_comment }}" class="btn btn-sm btn-outline-success">Share</a>
                                        @endif
                                        
                                    </td>
                                </tr>
                            @endforeach

                        @else
                            <tr>
                                <td style="font-weight:bold; font-style:italic;">No comments found!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </main>



<!-- View comment modal -->
<div class="modal" tabindex="-1" id="comment_view_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ url('comment_approve') }}" method="POST" class="form comment_view_form">
        @csrf

        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <!-- Platform -->
          <div class="comment_view_data"><span class="label">Plateform:</span><span id="comment_view_platform"></span></div>
          <hr>
          <!-- URL -->
          <div class="comment_view_data"><span class="label">URL:</span><span id="comment_view_url"></span></div>
          <hr>
          <!-- Actual comment -->
          <div class="comment_view_data">
            <span class="label">Comment:</span>
            <p id="comment_view_actual_comment"></p>
          </div>
          <hr>
          <!-- Sedner -->
          <div class="comment_view_data"><span class="label">Sender:</span><span id="comment_view_sender"></span></div>
          <hr>
          <!-- Feedback -->
          <div class="">
            <span class="label">Feedback:</span>
            @if(Session::get("user")->role_id == 1)
              <textarea name="feedback" id="comment_view_feedback" cols="30" rows="5" class="form-control"></textarea>
            @else
              <textarea name="feedback" id="comment_view_feedback" cols="30" rows="5" class="form-control" disabled></textarea>
            @endif
            
          </div>

          <input type="hidden" value="" id="id_in_view_comment_modal" name="comment_id">

        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            @if(Session::get("user")->role_id == 1)
              <a href="" class="btn btn-light reject" style="background-color:var(--revined-color); color:white;">Reject</a>   
              <input type="submit" class="btn btn-light approve" style="background-color:var(--approve-color); color:white;" value="Approve">
            @endif
        </div>

      </form>
    </div>
  </div>
</div>


<!-- Edit comment modal -->
<div class="modal" tabindex="-1" id="comment_edit_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ url('update-comment') }}" method="POST" class="form comment_update_form">
        @csrf
        <div class="modal-body">

          <!-- Platform -->
          <div class="form-group mb-3">
            <input type="text" placeholder="Platform" id="edit_comment_platform" name="comment_platform" value="" class="form-control" disabled>
          </div>

          <!-- Url -->
          <div class="form-group mb-3">
            <input type="text" placeholder="URL" id="edit_comment_url" name="comment_url" value="" class="form-control" disabled>
          </div>

          <!-- Actual comment -->
          <div class="form-group mb-3">
            <textarea name="actual_comment" placeholder="Comment" id="edit_actual_comment" class="form-control" cols="30" rows="5" required></textarea>
          </div>

          <!-- Feedback -->
          <div class="form-group mb-3">
            <textarea name="feedback" placeholder="Feedback" id="edit_comment_feedback" class="form-control" cols="30" rows="5" required></textarea>
          </div>

          <!-- Comment type -->
          <div class="form-group mb-3">
            <input type="text" placeholder="Comment Type" id="edit_comment_type" name="comment_type" value="" class="form-control">
          </div>

          <!-- comment id -->
          <input type="hidden" name="id" id="comment_id_in_edit_modal" value="">
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" value="Update">
        </div>

      </form>
    </div>
  </div>
</div>
<!-- edit modal ends -->
@include("layouts.footer")