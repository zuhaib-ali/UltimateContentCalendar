@include("layouts.header")

<!--Container Main start-->
<div class="container main-container">
    <div class="row">
        <div class="col-12">
            <center><h2>Settings</h2></center>
        </div>
    </div>

	<div class="row">
		<div class="col-4">
			<form class="form" action="{{ route('set-colors') }}" method="POST">
				@csrf
					
					<!-- Pneding -->
					<div class="form-group">
						<div class="d-flex justify-content-between" id="pending_column">
							<span> Pending:  </span>
							<div id="pending" class="colorSelector">
								<div ></div>
							</div>
						</div>
						<input type="hidden" name="pending_color" id="pending_color" value="@if($settings_colors->count() != 0) {{ $settings_colors->find(1)->status_color}} @else #FFBF00 @endif">
					</div>

					<!-- In process -->
					<div class="form-group">
						<div class="d-flex justify-content-between" id="in_progress_column">
							<span > In Progress: </span>
							<div id="in_progress" class="colorSelector">
								<div class="in_progress-color"></div>
							</div>
						</div>

						<input type="hidden" name="in_progress_color" id="in_progress_color" value="@if($settings_colors->count() != 0) {{$settings_colors->find(2)->status_color}} @else #4682B4 @endif">
					</div>

					<!-- Approved -->
					<div class="form-group">
						<div class="d-flex justify-content-between" id="approve_column">
							<span > Approve: </span>
							<div id="approve" class="colorSelector">
								<div class="approve-color"></div>
							</div>
						</div>

						<input type="hidden" name="approve_color" id="approve_color" value="@if($settings_colors->count() != 0) {{$settings_colors->find(3)->status_color}} @else #01796F @endif">
					</div>

					<!-- Complete -->
					<div class="form-group">
						<div class="d-flex justify-content-between" id="complete_column">
							<span> Complete: </span>
							<div id="complete" class="colorSelector">
								<div class="complete-color"></div>
							</div>
						</div>

						<input type="hidden" name="complete_color" id="complete_color" value="@if($settings_colors->count() != 0) {{$settings_colors->find(4)->status_color}} @else #4CBB17 @endif">
					</div>

					<!-- Reject -->
					<div class="form-group">
						<div class="d-flex justify-content-between" id="reject_column">
							<span> Revise: </span>
							<div id="reject" class="colorSelector">
								<div class="reject-color"></div>
							</div>
						</div>

						<input type="hidden" name="reject_color" id="reject_color" value="@if($settings_colors->count() != 0) {{$settings_colors->find(5)->status_color}} @else #C21807 @endif">
					</div>
					
					
					<!-- Assigned -->
					<div class="form-group">
						<div class="d-flex justify-content-between" id="assigned_column">
							<span> Assigned: </span>
							<div id="assigned" class="colorSelector">
								<div class="assigned-color"></div>
							</div>
						</div>

						<input type="hidden" name="assigned_color" id="assigned_color" value="@if($settings_colors->count() != 0) {{$settings_colors->find(6)->status_color}} @else #000000 @endif">
					</div>
					
					<!-- Waiting for Edit Approval -->
					<div class="form-group">
						<div class="d-flex justify-content-between" id="waiting_for_edit_approval_column">
							<span> Waiting for Edit Approval: </span>
							<div id="waiting_for_edit_approval" class="colorSelector">
								<div class="waiting-for-edit-approval-color"></div>
							</div>
						</div>

						<input type="hidden" name="waiting_for_edit_approval_color" id="waiting_for_edit_approval_color" value="@if($settings_colors->count() != 0) {{$settings_colors->find(7)->status_color}} @else #C21807 @endif">
					</div>
					
					
					<!-- Waiting for Client's Approval -->
					<div class="form-group">
						<div class="d-flex justify-content-between" id="waiting_for_client_approval_column">
							<span> Waiting for Client's Approval: </span>
							<div id="waiting_for_client_approval" class="colorSelector">
								<div class="waiting-for-client-approval-color"></div>
							</div>
						</div>

						<input type="hidden" name="waiting_for_client_approval_color" id="waiting_for_client_approval_color" value="@if($settings_colors->count() != 0) {{$settings_colors->find(8)->status_color}} @else #C21807 @endif">
					</div>
					
					<!-- Can't Use -->
					<div class="form-group">
						<div class="d-flex justify-content-between" id="cant_use_column">
							<span> Can't Use: </span>
							<div id="cant_use" class="colorSelector">
								<div class="cant-use-color"></div>
							</div>
						</div>

						<input type="hidden" name="cant_use_color" id="cant_use_color" value="@if($settings_colors->count() != 0) {{$settings_colors->find(9)->status_color}} @else #C21807 @endif">
					</div>
					
					<!-- Posted -->
					<div class="form-group">
						<div class="d-flex justify-content-between" id="posted_column">
							<span> Posted: </span>
							<div id="posted" class="colorSelector">
								<div class="posted-color"></div>
							</div>
						</div>

						<input type="hidden" name="posted_color" id="posted_color" value="@if($settings_colors->count() != 0) {{$settings_colors->find(10)->status_color}} @else #C21807 @endif">
					</div>
					
					<!-- Sent to Client to Post -->
					<div class="form-group">
						<div class="d-flex justify-content-between" id="sent_to_client_column">
							<span> Sent to Client to Post: </span>
							<div id="sent_to_client" class="colorSelector">
								<div class="sent-to-client-color"></div>
							</div>
						</div>

						<input type="hidden" name="sent_to_client_color" id="sent_to_client_color" value="@if($settings_colors->count() != 0) {{$settings_colors->find(11)->status_color}} @else #C21807 @endif">
					</div>
					
					
					<!-- Caption waiting for Approval -->
					<div class="form-group">
						<div class="d-flex justify-content-between" id="caption_waiting_for_approval_column">
							<span> Caption waiting for Approval: </span>
							<div id="caption_waiting_for_approval" class="colorSelector">
								<div class=""></div>
							</div>
						</div>

						<input type="hidden" name="caption_waiting_for_approval_color" id="caption_waiting_for_approval_color" value="@if($settings_colors->count() != 0) {{$settings_colors->find(12)->status_color}} @else #008080 @endif">
					</div>
					
					
					<!-- Revise Caption -->
					<div class="form-group">
						<div class="d-flex justify-content-between" id="revise_caption_column">
							<span> Revise Caption: </span>
							<div id="revise_caption" class="colorSelector">
								<div class=""></div>
							</div>
						</div>

						<input type="hidden" name="revise_caption_color" id="revise_caption_color" value="@if($settings_colors->count() != 0) {{$settings_colors->find(13)->status_color}} @else #ff0000 @endif">
					</div>
					
					
					<!-- Caption Approved -->
					<div class="form-group">
						<div class="d-flex justify-content-between" id="caption_approved_column">
							<span> Caption Approved: </span>
							<div id="caption_approved" class="colorSelector">
								<div class=""></div>
							</div>
						</div>

						<input type="hidden" name="caption_approved_color" id="caption_approved_color" value="@if($settings_colors->count() != 0) {{$settings_colors->find(14)->status_color}} @else #ffff00 @endif">
					</div>
					
				<br>
				<hr>
				
				<div class="form-group">
					<input type="submit" value="Set Colors" class="btn btn-secondary form-control">
				</div>
			</form>
		</div>
	</div>
</div>

@include("layouts.footer")

<script>

	
	// Pending
	$('#pending').ColorPicker({
			color: '#FFBF00',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$("#pending_column").css({"border-color":"#"+hex, "border-bottom": "5px solid #"+hex});
				$("#pending_column #pending div").css("background-color", "#"+hex);
				$("#pending_column span").css("color", "#"+hex);
				$("#pending_color").val("#"+hex);
			}
		});

		// In Process
		$('#in_progress').ColorPicker({
			color: '#4682B4',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$("#in_progress_column").css({"color":"#"+hex, "border-bottom": "5px solid #"+hex});
				$('#in_progress_column #in_progress div').css('backgroundColor', '#' + hex);
				$("#in_progress_column span").css({"color":"#"+hex });
				$("#in_progress_color").val("#"+hex);
			}
		});

		
		// Approve
		$('#approve').ColorPicker({
			color: '#01796F',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$("#approve_column").css({"border-color":"#"+hex, "border-bottom": "5px solid #"+hex});
				$("#approve_column #approve div").css('backgroundColor', '#' + hex);
				$("#approve_column span").css({"color":"#"+hex});
				$("#approve_color").val("#"+hex);
			}
		});

		// Compelete
		$('#complete').ColorPicker({
			color: '#4CBB17',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$("#complete_column").css({"border-color":"#"+hex, "border-bottom": "5px solid #"+hex});
				$('#complete_column #complete div').css('backgroundColor', '#' + hex);
				$("#complete_column span").css({"color":"#"+hex});
				$("#complete_color").val("#"+hex);
			}
		});

		// Reject
		$('#reject').ColorPicker({
			color: '#C21807',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$("#reject_column").css({"border-color": "#"+hex, "border-bottom": "5px solid #"+hex});
				$('#reject_column #reject div').css('backgroundColor', '#' + hex);
				$("#reject_column span").css("color", "#"+hex);
				$("#reject_color").val("#"+hex);
			}
		});
		
		
		// Assigned
		$('#assigned').ColorPicker({
			color: '#C21807',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$("#assigned_column").css({"border-color": "#"+hex, "border-bottom": "5px solid #"+hex});
				$('#assigned_column #assigned div').css('backgroundColor', '#' + hex);
				$("#assigned_column span").css("color", "#"+hex);
				$("#assigned_color").val("#"+hex);
			}
		});
		
		// Waiting for edit approval
		$('#waiting_for_edit_approval').ColorPicker({
			color: '#C21807',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$("#waiting_for_edit_approval_column").css({"border-color": "#"+hex, "border-bottom": "5px solid #"+hex});
				$('#waiting_for_edit_approval_column #waiting_for_edit_approval div').css('backgroundColor', '#' + hex);
				$("#waiting_for_edit_approval_column span").css("color", "#"+hex);
				$("#waiting_for_edit_approval_color").val("#"+hex);
			}
		});
		
		// Waiting for client's approval
		$('#waiting_for_client_approval').ColorPicker({
			color: '#C21807',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$("#waiting_for_client_approval_column").css({"border-color": "#"+hex, "border-bottom": "5px solid #"+hex});
				$('#waiting_for_client_approval_column #waiting_for_client_approval div').css('backgroundColor', '#' + hex);
				$("#waiting_for_client_approval_column span").css("color", "#"+hex);
				$("#waiting_for_client_approval_color").val("#"+hex);
			}
		});
		
		// Can't Use
		$('#cant_use').ColorPicker({
			color: '#C21807',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$("#cant_use_column").css({"border-color": "#"+hex, "border-bottom": "5px solid #"+hex});
				$('#cant_use_column #cant_use div').css('backgroundColor', '#' + hex);
				$("#cant_use_column span").css("color", "#"+hex);
				$("#cant_use_color").val("#"+hex);
			}
		});
		
		// Posted
		$('#posted').ColorPicker({
			color: '#C21807',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$("#posted_column").css({"border-color": "#"+hex, "border-bottom": "5px solid #"+hex});
				$('#posted_column #posted div').css('backgroundColor', '#' + hex);
				$("#posted_column span").css("color", "#"+hex);
				$("#posted_color").val("#"+hex);
			}
		});
		
		// Sent to Client to Post
		$('#sent_to_client').ColorPicker({
			color: '#C21807',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$("#sent_to_client_column").css({"border-color": "#"+hex, "border-bottom": "5px solid #"+hex});
				$('#sent_to_client_column #sent_to_client div').css('backgroundColor', '#' + hex);
				$("#sent_to_client_column span").css("color", "#"+hex);
				$("#sent_to_client_color").val("#"+hex);
			}
		});
		
		
		// Caption waiting for Approval
		$('#caption_waiting_for_approval').ColorPicker({
			color: '#C21807',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$("#caption_waiting_for_approval_column").css({"border-color": "#"+hex, "border-bottom": "5px solid #"+hex});
				$('#caption_waiting_for_approval_column #caption_waiting_for_approval div').css('backgroundColor', '#' + hex);
				$("#caption_waiting_for_approval_column span").css("color", "#"+hex);
				$("#caption_waiting_for_approval_color").val("#"+hex);
			}
		});
		
		
		// Revise Caption
		$('#revise_caption').ColorPicker({
			color: '#C21807',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$("#revise_caption_column").css({"border-color": "#"+hex, "border-bottom": "5px solid #"+hex});
				$('#revise_caption_column #revise_caption div').css('backgroundColor', '#' + hex);
				$("#revise_caption_column span").css("color", "#"+hex);
				$("#revise_caption_color").val("#"+hex);
			}
		});
		
		// Caption Approved
		$('#caption_approved').ColorPicker({
			color: '#C21807',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$("#caption_approved_column").css({"border-color": "#"+hex, "border-bottom": "5px solid #"+hex});
				$('#caption_approved_column #caption_approved div').css('backgroundColor', '#' + hex);
				$("#caption_approved_column span").css("color", "#"+hex);
				$("#caption_approved_color").val("#"+hex);
			}
		});
</script>
