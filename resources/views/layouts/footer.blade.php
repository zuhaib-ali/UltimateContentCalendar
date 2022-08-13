<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        const showNavbar = (toggleId, navId, bodyId, headerId) => {
            const toggle = document.getElementById(toggleId),
                nav = document.getElementById(navId),
                bodypd = document.getElementById(bodyId),
                headerpd = document.getElementById(headerId);

            // Validate that all variables exist
            if (toggle && nav && bodypd && headerpd) {
                toggle.addEventListener("click", () => {
                    // show navbar
                    nav.classList.toggle("show");
                    // change icon
                    toggle.classList.toggle("bx-x");
                    // add padding to body
                    bodypd.classList.toggle("body-pd");
                    // add padding to header
                    headerpd.classList.toggle("body-pd");
                });
            }
        };

        showNavbar("header-toggle", "nav-bar", "body-pd", "header");

        /*===== LINK ACTIVE =====*/
        const linkColor = document.querySelectorAll(".nav_link");

        function colorLink() {
            if (linkColor) {
                linkColor.forEach((l) => l.classList.remove("active"));
                this.classList.add("active");
            }
        }
        linkColor.forEach((l) => l.addEventListener("click", colorLink));

        // Your code to run since DOM is loaded and ready
    });
</script>

<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous"></script>
<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script> -->

<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


<script type="text/javascript" src="{{ asset('colorpciker/js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('colorpicker/js/colorpicker.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>

<!-- Datatables SCRIPT-->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>

<!--table jQuery code-->
<script>
    
//   $(document).ready(function() {
//   $('tbody').scroll(function(e) { //detect a scroll event on the tbody
//     $('thead').css("left", -$("tbody").scrollLeft()); //fix the thead relative to the body scrolling
//     $('thead th').css("left", $("tbody").scrollLeft()); //fix the first cell of the header
//     // $('tbody td:first-child').css("left", $("tbody").scrollLeft()); //fix the first column of tdbody
//   });
// });

$(document).ready(function() {
            
        $(".pspsps").scroll(function() {
                $("thead").css({
                    "position": "sticky",
                    "top":"-3px",
                    "z-index":"2"
                });
            
                $(".client-left ,.tb-name-column").css({
                    "position": "sticky",
                    "left":"-12px",
                    "z-index":"1"
                });
            });
            
        });

</script>
<!--table jQuery code-->

<script>
    $(document).on('click','i.notification',function(){
        $(this).removeClass('show');
        $(this).addClass('bbbb');
    });

</script>

<script>
    $(document).on('click','i.bbbb',function(){
        $(document).find('ul.dd_menu').toggle();
    });
</script>

<script>
    $(document).on('click','input.clientName',function(){
        let id = $(this).val();
        if ( $(this).is(':checked') ) {
            $(document).find('a.client_'+id).removeClass("d-none");
            if($(document).find('input.clientName:checked').length == $(document).find('input.clientName').length){
              $(document).find('input.ViewAll').attr('checked',true); 
            }else{
                $(document).find('input.ViewAll').attr('checked',false);
            }
        } else{
            $(document).find('a.client_'+id).addClass("d-none");
            $(document).find('input.ViewAll').attr('checked',false);
        }
    });
    
    $(document).on('click','input.ViewAll',function(){
        if($(this).is(':checked')){
            $(document).find('td.fc-event-container').removeClass("d-none");
            $(document).find('input.clientName').attr('checked',true);
            $(document).find('input.colorCheck').attr('checked',true);
        }else{
            $(document).find('td.fc-event-container').addClass("d-none");
            $(document).find('input.clientName').attr('checked',false);
            $(document).find('input.colorCheck').attr('checked',false);
        }
    });
    
    $(document).on('click','input.colorCheck',function(){
        let status = $(this).attr('data');
        let color = $(this).attr('name');
        if($(this).is(':checked')){
            $(this).css('background-color',color);
            if(status == "pending"){
                $(document).find('a.task_pending').removeClass("d-none");
            }
            else if(status == "in progress"){
                $(document).find('a.task_in_process').removeClass("d-none");
            }
            else if(status == "approved"){
                $(document).find('a.task_approved').removeClass("d-none");
            }
            else if(status == "completed"){
                $(document).find('a.task_completed').removeClass("d-none");
            }
            else if(status == "revined"){
                $(document).find('a.task_revined').removeClass("d-none");
            }
            
           
        }else{
            if(status == "pending"){
                $(document).find('a.task_pending').addClass("d-none");
                $(this).css('background-color','');
            }
            else if(status == "in progress"){
                $(document).find('a.task_in_process').addClass("d-none");
                $(this).css('background-color','');
            }
            else if(status == "approved"){
                $(document).find('a.task_approved').addClass("d-none");
                $(this).css('background-color','');
            }
            else if(status == "completed"){
                $(document).find('a.task_completed').addClass("d-none");
                $(this).css('background-color','');
            }
            else if(status == "revined"){
                $(document).find('a.task_revined').addClass("d-none");
                $(this).css('background-color','');
            }
        }
        
    });
</script>

<script>
    $(document).on('click','a.read_task',function(){
        let row = $(this).parents('li.task_row');
        let task_id = row.attr('data');
        $.ajax({
            type: "GET",
            url: "{{ url('/read_notification') }}"+"/"+task_id,
            success: function (data) {
                $(document).find('span.counttt').text(data.length);
                row.remove();
            }
        });
    });
</script>

<script>
    $(document).on('click','a.read_all_task',function(){
        // alert('Narkathi');
        $.ajax({
            type: "GET",
            url: "{{ url('/read_all_notification') }}",
            success: function (data) {
                $(document).find('li.task_row').remove();
                $(document).find('span.counttt').text(data.length);
                $(this).remove();
            }
        });
    });
</script>

<script>
    $(document).on('click','input.auto_assign',function(){
        if ( $(this).is(':checked') ) {
            $('div.assigned').find('select.users').attr('disabled',true);
            $('div.assigned').find('select.users').attr('required',false);
            $('div.assigned').find('select.users').attr('name','');
        } 
    else {
            $('div.assigned').find('select.users').attr('disabled',false);
            $('div.assigned').find('select.users').attr('required',true);
            $('div.assigned').find('select.users').attr('name','user_id');
        }
    });    
</script>

<script>
    $(document).ready(function() {
    
        // Show Hide password user.
        $(".add_user_password #show_password").on("click", function() {
            if ($(this).prop("checked") == true) {
                $(".add_user_password #password").prop("type", "text");
            } else {
                $(".add_user_password #password").prop("type", "password");
            }
        });
        
        // Show Hide password client.
        $("#show_client_password").on("click", function() {
            if ($(this).prop("checked") == true) {
                $("#client_password").prop("type", "text");
                
            } else {
                $("#client_password").prop("type", "password");
            }
        });
        
        
        if($(document).find('input.colorCheck').attr('checked',true)){
            $(document).find('input.colorCheck').each(function(index,value){
                let color = value.name;
                $(value).css('background-color',color);
            });
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('label.revinedd').hide();
        $('label.msg').hide();
        $('label.complete_msg').hide();
        let user_id = $('input.user_id').val();
        let role_id = $('input.role_id').val();
        let events12 = [];
        $.ajax({
            type: "GET",
            url: "{{ url('get_tasks_for_calender') }}",
            success: function(data) {
                var i = 0;
                data.forEach(function(value) {
                    var obj = new Object();
                    obj.id          =   value['id'];
                    obj.title       =   "\n"+ 'Project: '+value['name'] + "\n" + "User: "+value['fname'] + " "+ value['lname'] + "\n" + 'Client: '+ value['project_name'];
                    obj.start       =   value['created_date'];
                    obj.end         =   value['deadline'];
                    obj.color       =   value['color'];
                    obj.className   =   'reg_selected client_'+value['user_id']+' ';
                    if(value['status'] == 1){
                        obj.className   +=   'task_pending';
                    }
                    else if(value['status'] == 2){
                        obj.className   +=   'task_in_process';
                    }
                    else if(value['status'] == 3){
                        obj.className   +=   'task_approved';
                    }
                    else if(value['status'] == 4){
                        obj.className   +=   'task_completed';
                    }
                    else if(value['status'] == 5){
                        obj.className   +=   'task_revined';
                    }

                    events12[i++] = obj;

                });


                $('#calendar').fullCalendar({
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay'
                        },
                        defaultDate: '2021-11-01',
                        defaultView: 'month',
                        editable: true,
                        events: events12,
                        eventRender: function(event, element){
                            element.attr("data", event.id);
                            element.attr("color", event.color);
                        }
                    });
            }
        });

    });
</script>


<script>
    // Get role by id.
    $(document).on('click', '.delete-role-trigger', function(){
        let role_id = $(this).attr('data');
        $.ajax({
            url:'get-role-by-id'+'/'+role_id,
            type:'GET',
            success:function(data){
                $('#id_in_confirm_delete_role_modal').val(data.id);
                $('#message_in_confirm_delete_role_modal').html("Are you sure want to delete "+data.role);
                $('#confirm-delete-role-modal').modal('show');
            }
        });
    });
    
    
    // Get user by id.
    $(document).on('click', '.delete-user-trigger', function(){
        let user_id = $(this).attr('data');
        $.ajax({
            url:'get-user-by-id'+'/'+user_id,
            type:'GET',
            success:function(data){
                $('#id_in_confirm_delete_user_modal').val(data.id);
                $('#message_in_confirm_delete_user_modal').html("Are you sure want to delete "+data.first_name+" "+data.last_name);
                $('#confirm-delete-user-modal').modal('show');
            }
        });
    });
    
    
    
    // Get client by id.
    $(document).on('click', '.delete-client-trigger', function(){
        let clinet_id = $(this).attr('data');
        $.ajax({
            url:'get-client-by-id'+'/'+clinet_id,
            type:'GET',
            success:function(data){
                $('#id_in_confirm_delete_client_modal').val(data.id);
                $('#message_in_confirm_delete_client_modal').html("Are you sure want to delete "+data.name);
                $('#confirm-delete-client-modal').modal('show');
            }
        });
    });
    
    
    // Get client by id.
    $(document).on('click', '.delete-project-trigger', function(){
        let project_id = $(this).attr('data');
        $.ajax({
            url:'get-porject-by-id'+'/'+project_id,
            type:'GET',
            success:function(data){
                $('#id_in_confirm_delete_project_modal').val(data.id);
                $('#message_in_confirm_delete_project_modal').html("Are you sure want to delete "+data.name);
                $('#confirm-delete-project-modal').modal('show');
            }
        });
    });
</script>




<!-- Getting project information, on project click. -->
<script>
    $(document).on('click', '.reg_selected', function() {
        let id = $(this).attr('data');
        let role_id = $('input.role_id').val();
        let text = "File Not Found";
        let sub = '';
        let i = 0;
        let filess = [];
        let dataaa = '';
        let main_task_files = "";
        let sub_task_files = "";
        
        
        
        $.ajax({
            type: "GET",
            url: "{{ url('/get_task_detail_for_calender') }}" + "/" + id,
            success: function(data) {
                
                // Project information.
                $('span.task_title').text('View: ' + data[0].name);
                if(data[0].color_id == 3 &&  data[2].color_id == 4 ){
                    $('span.view_task_label').css('color', data[3][4].status_color);
                    $('span.view_task_label').text("REVINED");
                }else{
                    $('span.view_task_label').css('color', data[0].color);
                    $('span.view_task_label').text(data[0].status_name);    
                }
                $('span.username').text(data[0].fname+' '+ data[0].lname);
                $('span.deadline').text(data[0].deadline);
                $('span.desc').text(data[0].description);
                
                // Task files.
                if(data[1] == null){
                    $(".attData").hide();
                    
                }else{
                    for(z=0; z<data[1].length; z++){
                        if(data[1][z].task_id == data[0].id){
                            main_task_files += "<div style='border:1px solid lightgrey; padding:10px; display:flex; justify-content:space-between; margin:10px 0px;'>"+
                                    "<span>" +data[1][z].file_name+ "</span>"+
                                    "<a href='https://ultimatecontentcalendar.com/public/task_files/"+data[1][z].file_name+"' class='btn btn-success donwload_link'>DOWNLOAD</a>"+
                                "</div>";
                        }
                    }    
                    $(".attData").html("<h5>ATTACHMENTS</h5></br>"+main_task_files);
                    $(".attData").show();    
                }
                
                // Subtasks
                if(data[2] == null){
                    $("#sub_task").hide();
                }else{
                    // Sub task inforation
                    if(data[0].color_id == 3 &&  data[2].color_id == 4 ){
                        $('#subtask_status').html("<span style='color:"+data[3][2].status_color+";'>APPROVED</span></br>");
                    }else{
                        $('#subtask_status').html("<span style='color:"+data[2].status_color+";'>"+data[2].status_name+"</span></br>");
                    }
                    
                    $('#subtask_subject').text(data[2].subject);    
                    $('#subtask_description').text(data[2].description);
                    for(z=0; z<data[1].length; z++){
                        if(data[1][z].sub_task_id == data[2].id){
                            sub_task_files += "<div style='border:1px solid lightgrey; padding:10px; display:flex; justify-content:space-between; margin:10px 0px;'>"+
                                "<span>" +data[1][z].file_name+ "</span>"+
                                    "<a href='https://ultimatecontentcalendar.com/public/task_files/"+data[1][z].file_name+"' class='btn btn-success donwload_link'>DOWNLOAD</a>"+
                                "</div>";
                        }    
                        
                    }   
                    $("#sub_attachments").html(sub_task_files);
                    $("#sub_task").show();
                }
                
                $('input.main_id').val(data[0].id);
                
                // Pending
                if(data[0].color_id == 1){
                        if(role_id == 1){
                            $("a.revine-btn").hide();
                            $("a.approve-btn").hide();
                            $("a.in-progress-btn").hide();
                            $("a.complete-btn").hide();
                        }else{
                            $("a.revine-btn").hide();
                            $("a.approve-btn").hide();
                            $("a.in-progress-btn").show();
                            $('a.in-progress-btn').attr('href','{{ url("/in_progres_task") }}' + "/" + data[0].id);        
                            $("a.complete-btn").hide();
                        }
                    
                // In progress
                }else if(data[0].color_id == 2){
                        if(role_id == 1){
                            $("a.revine-btn").hide();
                            $("a.approve-btn").hide();
                            $("a.in-progress-btn").hide();
                            $("a.complete-btn").hide();
                        }else{
                            $("a.revine-btn").hide();
                            $("a.approve-btn").hide();
                            $("a.in-progress-btn").hide();
                            $("a.complete-btn").show();
                            $('a.complete-btn').attr('href','{{ url("/complete_task_status") }}' + "/" + data[0].id);
                        }
                    
                // Approve
                }else if(data[0].color_id == 3){
                    if(role_id == 1){
                        $("a.revine-btn").hide();
                        $("a.approve-btn").hide();
                        $("a.in-progress-btn").hide();
                        $("a.complete-btn").hide();
                        
                    }else{
                        $("a.revine-btn").hide();
                        $("a.approve-btn").hide();
                        $("a.in-progress-btn").hide();
                        $("a.complete-btn").hide();
                        $(".complete_msg").hide();
                    }
                    $("label.approved-label").show();
                // Completed
                }else if(data[0].color_id == 4){
                        if(role_id == 1){
                            $("a.revine-btn").show();
                            $("a.approve-btn").show();
                            $('a.approve-btn').attr('href', '{{ url("/approve_task_in_calender") }}' + "/" + data[0].color_id + "/" + data[0].id );
                            $("a.in-progress-btn").hide();
                            $("a.complete-btn").hide();
                        }else{
                            $("a.revine-btn").hide();
                            $("a.approve-btn").hide();
                            $("a.in-progress-btn").hide();
                            $("a.complete-btn").hide();
                            $(".complete_msg").show();
                        }
                    
                // Revined
                }else if(data[0].color_id == 5){
                    
                    // Pending
                    if(data[2].color_id == 1){
                        if(data[2] != null){
                            if(role_id == 1){
                                $("a.revine-btn").hide();
                                $("a.approve-btn").hide();
                                $("a.in-progress-btn").hide();
                                $("a.complete-btn").hide();
                            }else{
                                $("a.revine-btn").hide();
                                $("a.approve-btn").hide();
                                $("a.in-progress-btn").show();
                                $('a.in-progress-btn').attr('href','{{ url("/in_progres_sub_task") }}' + "/" +data[2].id+"/sub_task");
                                $("a.complete-btn").hide();
                                $(".complete_msg").hide();
                            }
                        }    
                        
                    // In Progress
                    }else if(data[2].color_id == 2){
                        if(data[2] != null){
                            if(role_id == 1){
                                $("a.revine-btn").hide();
                                $("a.approve-btn").hide();
                                $("a.in-progress-btn").hide();
                                $("a.complete-btn").hide();
                            }else{
                                $("a.revine-btn").hide();
                                $("a.approve-btn").hide();
                                $("a.in-progress-btn").hide();
                                $("a.complete-btn").show();
                                $("a.complete-btn").attr('href','{{ url("/complete_sub_task") }}' + "/" +data[2].id+"/sub_task");
                                $(".complete_msg").hide();
                            }
                        }    
                        
                    // Complete
                    }else if(data[2].color_id == 4){
                        if(data[2] != null){
                            if(role_id == 1){
                                $("#sub_task_id_in_modal").val(data[2].id);
                                $("a.revine-btn").show();
                                $("a.approve-btn").show();
                                $('a.approve-btn').attr('href', '{{ url("/approve_task_in_calender") }}' + "/" + data[0].color_id + "/" + data[0].id );
                                $("a.in-progress-btn").hide();
                                $("a.complete-btn").hide();
                            }else{
                                $("a.revine-btn").hide();
                                $("a.approve-btn").hide();
                                $("a.in-progress-btn").hide();
                                $("a.complete-btn").hide();
                            }
                        }    
                    
                        
                    // Revined
                    }else if(data[2].color_id == 5){
                        if(data[2] != null){
                            if(role_id == 1){
                                $("a.revine-btn").hide();
                                $("a.approve-btn").hide();
                                $("a.in-progress-btn").hide();
                                $("a.complete-btn").hide();
                            }else{
                                $("a.revine-btn").hide();
                                $("a.approve-btn").hide();
                                $("a.in-progress-btn").hide();
                                $("a.complete-btn").hide();
                                $(".complete_msg").hide();
                            }
                        }       
                    }
                }
                
                $('#view_task_detail').modal('show');
            }
        });
    });

    $(document).on('click', '.callRevine', function() {
        $('#view_task_detail').modal('hide');

        $('#revine_task_modal').modal('show');
    });

    $(document).on('click','td.fc-day-number, td.fc-day',function(){
        let date = $(this).attr('data-date');
        $('input.created_date').val(date);
        let role_id = $('input.role_id').val();
        if(role_id == 1){
        $('#add_task_modal_date_wise').modal('show');
        }
    });
    
    
    
    
    // ***********************  DUMMY CALENDER *****************************
    
    // Show and Hide all clients' project in Dummy Calender.
    $('.dummy_calender_clients_all').on('click', function(){
        if($(this).is(':checked')){
            $('.clients_projects_table tr').show();
            $('.dummy_calender_client').prop('checked', true);
        }else{
            $('.clients_projects_table tr').hide();
            $('.dummy_calender_client').prop('checked', false);
        }
    });
    
    
    // Show hide client projects in Dummy Calender 
    $('.dummy_calender_client').on('click', function(){
        var id = $(this).val();
        var hide_all = false;
        if($(this).is(':checked')){
            $("[data-client-row-id='"+id+"']").show();
        }else{
            $("[data-client-row-id='"+id+"']").hide();
        }
        
        if($('.dummy_calender_client:checked').length < 1){
            $('.dummy_calender_clients_all').prop('checked', false);
            
        }else{
            $('.dummy_calender_clients_all').prop('checked', true);
        }
    });
    
    // View Project in Dummy calender.
    $('.dummy_calender_project_view_modal_trigger').on('click', function(){
        var id = $(this).attr('data-project-id');
        
        $.ajax({
            type:'GET',
            url: '/getProjectInDummyCalender'+'/'+id,
            success:function(data){
                var task = data['task'];
                var status = data['colors'][task.status-1];
                var main_task_files = '';
                var role_id = data['role_id'];
                
                var sub_task = '';
                var sub_attachments = '';
                
                // Task files 
                if(data['task_files'] != null){
                    var task_files = data['task_files'];
                    task_files.map(function(task_file){
                        main_task_files += "<div style='display:flex; flex-wrap:wrap; justify-content:space-between'>"+
                            "<span>"+task_file.file_name+"</span>"+
                            "<a href='https://ultimatecontentcalendar.com/public/task_files/"+task_file.file_name+"' class='btn btn-success btn-sm'>Download</a>"+
                        "</div>"
                    });
                        
                }else{
                    main_task_files = "<p>No Attachment Found!</p>";
                }
                
                
                // Sub Task files 
                if(data['sub_task_files'] != null){
                    var sub_task_files = data['sub_task_files'];
                    sub_task_files.map(function(sub_task_files){
                        sub_attachments += "<div style='display:flex; flex-wrap:wrap; justify-content:space-between'>"+
                            "<span>"+sub_task_files.file_name+"</span>"+
                            "<a href='https://ultimatecontentcalendar.com/public/task_files/"+sub_task_files.file_name+"' class='btn btn-success btn-sm'>Download</a>"+
                        "</div>"
                    });
                        
                }else{
                    sub_attachments = "<p>No Attachment Found!</p>";
                }
                
                // Sub Task
                if(data['sub_tasks'] != null){
                    var sub_task_data = data['sub_tasks'];
                    var sub_status = data['colors'][sub_task_data.status-1];
                    sub_task = "<div>"+
                            "<span style='color:"+sub_status.status_color+";'>"+sub_status.status_name+"</span>"+
                        "</div>"+
                        
                        "<div style='display:flex; flex-wrap:wrap; justify-content:space-between;'>"+
                            "<span><b>Subject</b></span>"+
                            "<span>"+sub_task_data.subject+"</span>"+
                        "</div>"+
                        
                        "<div>"+
                            "<span><b>Description</b>:<br></span>"+
                            "<span>"+sub_task_data.description+"</span>"+
                        "</div>"+
                        
                        "<div>"+
                            "<span><b>Attachments</b>:<br></span>"+
                            "<span>"+sub_attachments+"</span>"+
                        "</div>"
                }else{
                    sub_task = "<p>No Sub Task Found!</p>";
                }
                
                var show_project_date = null;
                
                if(role_id == 1){
                    show_project_date = "<span><b>POST DATE</b></span>"+"<span>"+task.deadline+"</span>";
                }else{
                    show_project_date = "<span><b>DUE DATE</b></span>"+"<span>"+task.due_to_date+"</span>";
                }
                
                $('#dummy_calender_project_view_modal .modal-title').html(task.name+"<br>"+"<span style='color:"+status.status_color+"'>"+status.status_name+"</span>"); 
                $('#view_project_in_dummy_calender_modal_body').html(
                    "<div style='display:flex; flex-wrap:wrap; justify-content:space-between'>"+
                        show_project_date+
                    "</div><br>"+
                    
                    "<div>"+
                        "<span><b>Description:</b></span><br>"+
                        "<span>"+task.description+"</span>"+
                    "</div><br>"+
                    
                    
                    "<div>"+
                        "<span><b>Attachments:</b></span><br>"+
                        "<span>"+main_task_files+"</span>"+
                    "</div><br>"+
                    
                    "<div><hr>"+
                        "<span><b>Sub Task:</b></span><br>"+
                        "<span>"+sub_task+"</span>"+
                    "</div><br>"
                ); 
                
                // Project Status in Dummy Calender
                $('.dummy_calender_status_button').hide();
                if(task.status == 1){
                    if(role_id != 1){
                        $("#dummy_calender_in_progress_button").css('background-color', 'red');
                        $("#dummy_calender_in_progress_button").show();
                        $('#dummy_calender_in_progress_button').attr('href','{{ url("/in_progres_task") }}' + "/" + task.id);      
                    }
                    

                }else if(task.status == 2){
                    if(role_id != 1){
                        $("#dummy_calender_completed_button").show();
                        $('#dummy_calender_completed_button').attr('href','{{ url("/complete_task_status") }}' + "/" + task.id);
                    }
                    
                }else if(task.status == 3){
                    if(role_id == 1){
                        
                    }else{
                        
                    }
                    
                }else if(task.status == 4){
                    if(role_id == 1){
                        $('#revine_project_task_id_dummy_calender').val(task.id);
                        $("#dummy_calender_revised_button").show();
                        $("#dummy_calender_approved_button").show();
                        $('#dummy_calender_approved_button').attr('href', '{{ url("/approve_task_in_calender") }}' + "/" + task.status+ "/" +task.id );
                    }else{
                        
                    }
                    
                }else if(task.status == 5){
                    var sub_task = data['sub_tasks'];
                    if(sub_task != null){
                        if(sub_task.status == 1){
                            if(role_id != 1){
                                $("#dummy_calender_in_progress_button").show();
                                $('#dummy_calender_in_progress_button').attr('href','{{ url("/in_progres_task") }}' + "/" + task.id);      
                            }
                            
                        }else if(sub_task.status == 2){
                            if(role_id != 1){
                                $("#dummy_calender_completed_button").show();
                                $('#dummy_calender_completed_button').attr('href','{{ url("/complete_task_status") }}' + "/" + task.id);
                            }
                            
                        }else if(sub_task.status == 4){
                            if(role_id == 1){
                                $('#revine_project_sub_task_id_dummy_calender').val(sub_task.id);
                                $("#dummy_calender_revised_button").show();
                                $("#dummy_calender_approved_button").show();
                                $('#dummy_calender_approved_button').attr('href', '{{ url("/approve_task_in_calender") }}' + "/" + task.status+ "/" +task.id );
                            }else{
                                
                            }
                        }
                    }
                    
                }
                $('#dummy_calender_project_update_modal_trigger').attr('dummy-project-id', task.id);
                if(task.note != null){
                    $('#note_in_dummy_calender_modal_body').html("<hr><b>Note</b><br>"+task.note);    
                }
                
                $("#view_note_in_dummy_calender_modal_body").text(task.note);
                $('#project_id_in_dummy_calender_view_modal_note').val(task.id);
                $('#task_id_for_extra_files_upload').val(task.id);
                
                $('.view_project_in_dummy_calender_on_hold').attr("data-id", task.id);
                if(task.on_hold == true){
                    $('#dummy_calender_project_view_modal .modal-content').css("border", "5px solid orange");     
                    $('.view_project_in_dummy_calender_on_hold').prop("checked", true);
                    
                }else{
                    $('#dummy_calender_project_view_modal .modal-content').css("border", "none");     
                }
                
                $('#dummy_calender_project_view_modal').modal('show'); 
            }
        });
    });
    
    // Revise project in dummy calender
    $('#dummy_calender_revised_button').on('click', function(){
        
        $('#revine_task_modal_dummy_calender').modal('show');
    });
    
    // Update Project in Dummy Calender
    $('#dummy_calender_project_update_modal_trigger').on('click', function(){
        var id = $(this).attr('dummy-project-id');
        $.ajax({
            type:'GET',
            url:'dummyCalenderGetTask'+'/'+id,
            success:function(data){
                var projects = data['projects'];
                var task = data['task'];
                var users = data['users'];
                
                var clients_box = '';
                var project_options = '';
                var user_options = '';
                var caption_status_options = '';
                
                // Projects
                if(projects != null){
                    projects.map(function(project){
                        if(task.project_id == project.id){
                            project_options += '<option value="'+project.id+'" selected>'+ project.name +'</option>';        
                        }else{
                            project_options += '<option value="'+project.id+'">'+ project.name +'</option>';    
                        }
                        
                    });
                    
                }else{
                    project_options = '<option selected hidden disabled>No Project Found!</option>';
                }
                
                
                // Caption status
                if(task.caption_status == 12){
                    caption_status_options += '<option value="12" selected>Caption Waiting For Approval</option>';    
                    
                }else{
                    caption_status_options += '<option value="12" >Caption Waiting For Approval</option>';
                }
                
                if(task.caption_status == 13){
                    caption_status_options += '<option value="13" selected>Revise Caption</option>';
                    
                }else{
                    caption_status_options += '<option value="13">Revise Caption</option>';
                }
                
                if(task.caption_status == 14){
                    caption_status_options += '<option value="14" selected>Caption Approved</option>';
                    
                }else{
                    caption_status_options += '<option value="14">Caption Approved</option>';
                }
                
                if(task.caption_status == null){
                    caption_status_options += '<option disabled hidden selected>Select Caption Status</option>';
                    
                }
                
                // Assigned To
                if(users != null){
                    users.map(function(user){
                        if(task.user_id == user.id){
                            user_options += '<option value="'+user.id+'" selected>'+ user.first_name +' '+ user.last_name +'</option>';        
                        }else{
                            user_options += '<option value="'+user.id+'">'+ user.first_name +' '+ user.last_name +'</option>';    
                        }
                        
                    });
                    
                }else{
                    user_options = '<option selected hidden disabled>No User Found!</option>';
                }
                
                var date =  moment(task.deadline).format('YYYY-MM-DD');
                var due_date =  moment(task.due_to_date).format('YYYY-MM-DD');
                
                $('#dummy_calender_project_update_modal .modal-title').text('Update '+task.name);
                $('#dummy_calender_update_task_name').val(task.name);
                $('#dummy_calender_update_project').html(project_options);
                $('#dummy_calender_update_description').val(task.description);
                $('#dummy_calender_update_caption').val(task.caption);
                $('#dummy_calender_update_caption_status').html(caption_status_options);
                $('#dummy_calender_update_user').html(user_options);
                $('#dummy_calender_update_post_date').val(date);
                $('#dummy_calender_update_due_date').val(due_date);
                $('#dummy_calender_update_task_id').val(task.id);
                $('#dummy_calender_project_update_modal').modal('show');       
            }
        });
    });
    
    
    
    // Update Project in Dummy Calender
    $('.unassigned_project_info').on('click', function(){
        var id = $(this).attr('project-id');
        $.ajax({
            type:'GET',
            url:'dummyCalenderGetTask'+'/'+id,
            success:function(data){
                var projects = data['projects'];
                var task = data['task'];
                var users = data['users'];
                
                var clients_box = '';
                var project_options = '';
                var user_options = '';
                var caption_status_options = '';
                
                // Projects
                if(projects != null){
                    project_options += '<option hidden disabled selected>-- Clients --</option>';        
                    projects.map(function(project){
                        if(task.project_id == project.id){
                            project_options += '<option value="'+project.id+'" selected>'+ project.name +'</option>';        
                        }else{
                            project_options += '<option value="'+project.id+'">'+ project.name +'</option>';    
                        }
                        
                    });
                    
                }else{
                    project_options = '<option selected hidden disabled>No Project Found!</option>';
                }
                
                
                // Caption status
                if(task.caption_status == 12){
                    caption_status_options += '<option value="12" selected>Caption Waiting For Approval</option>';    
                    
                }else{
                    caption_status_options += '<option value="12" >Caption Waiting For Approval</option>';
                }
                
                if(task.caption_status == 13){
                    caption_status_options += '<option value="13" selected>Revise Caption</option>';
                    
                }else{
                    caption_status_options += '<option value="13">Revise Caption</option>';
                }
                
                if(task.caption_status == 14){
                    caption_status_options += '<option value="14" selected>Caption Approved</option>';
                    
                }else{
                    caption_status_options += '<option value="14">Caption Approved</option>';
                }
                
                if(task.caption_status == null){
                    caption_status_options += '<option disabled hidden selected>-- Select Caption Status --</option>';
                    
                }
                
                // Assigned To
                if(users != null){
                    user_options += '<option hidden disabled selected>-- Assigned To --</option>';        
                    users.map(function(user){
                        if(task.user_id == user.id){
                            user_options += '<option value="'+user.id+'" selected>'+ user.first_name +' '+ user.last_name +'</option>';        
                        }else{
                            user_options += '<option value="'+user.id+'">'+ user.first_name +' '+ user.last_name +'</option>';    
                        }
                        
                    });
                    
                }else{
                    user_options = '<option selected hidden disabled>No User Found!</option>';
                }
                
                var date =  moment(task.deadline).format('YYYY-MM-DD');
                var due_date =  moment(task.due_to_date).format('YYYY-MM-DD');
                
                $('#dummy_calender_project_update_modal .modal-title').text('Update '+task.name);
                $('#dummy_calender_update_task_name').val(task.name);
                $('#dummy_calender_update_project').html(project_options);
                $('#dummy_calender_update_description').val(task.description);
                $('#dummy_calender_update_caption').val(task.caption);
                $('#dummy_calender_update_caption_status').html(caption_status_options);
                $('#dummy_calender_update_user').html(user_options);
                $('#dummy_calender_update_post_date').val(date);
                $('#dummy_calender_update_due_date').val(due_date);
                $('#dummy_calender_update_task_id').val(task.id);
                $('#dummy_calender_project_update_modal').modal('show');       
            }
        });
    });
    
    
    $('.dummy_calender_user_project').on('click', function(){
        var id = $(this).val();
        if($(this).is(':checked')){
            $("[data-user-id='"+id+"']").show();
            
        }else{
            $("[data-user-id='"+id+"']").hide();
        }
        
    });
    
    $('.dummy_calender_project_on_date').on('click', function(){
        var date =  moment($(this).attr('date-project-date')).format('YYYY-MM-DD');
        $("#create_project_in_dummy_calender_on_date").val(date);
        $("#add_task_dummy_calender").modal("show");
    });
    
    
    
    // hide all remained date projects.
    $(".unassigned_info_projects").on("click", function(){
        if($(this).is(":checked")){
            $("#unassignned_deadline_projects").prop('hidden', false);
            $("#unassignned_due_date_projects").prop('hidden', false);
            $("#unassignned_clients_projects").prop('hidden', false);
            $("#unassignned_projects").prop('hidden', false);
            $('.unassigned_projects_details_trigger').prop('checked', true);
            
        }else{
            $("#unassignned_deadline_projects").prop('hidden', true);
            $("#unassignned_due_date_projects").prop('hidden', true);
            $("#unassignned_clients_projects").prop('hidden', true);
            $("#unassignned_projects").prop('hidden', true);
            $('.unassigned_projects_details_trigger').prop('checked', false);
        }
    });
    
    
    
    // if all checked or not.
    $('.unassigned_projects_details_trigger').on("click", function(){
        if($('.unassigned_projects_details_trigger:checked').length < 1){
            $(".unassigned_info_projects").prop("checked", false);
            
        }else{
            $(".unassigned_info_projects").prop("checked", true);
        }
    });
    
    
    
    // show and hide unassigned deadlien projects
    $(".unassignned_deadline_projects_trigger").on("click", function(){
        if($(this).is(":checked")){
            $("#unassignned_deadline_projects").attr('hidden', false);
            
            
        }else{
            $("#unassignned_deadline_projects").attr('hidden', true);
        }
    });
    
    
    
    // show and hide unassigned due date projects
    $(".unassignned_due_date_projects_trigger").on("click", function(){
        if($(this).is(":checked")){
            $("#unassignned_due_date_projects").attr('hidden', false);
            
            
        }else{
            $("#unassignned_due_date_projects").attr('hidden', true);
        }
    });
    
    
    
    // Show and hide unassigned clients projects
    $(".unassignned_clients_projects_trigger").on("click", function(){
        if($(this).is(":checked")){
            $("#unassignned_clients_projects").attr('hidden', false);
            
            
        }else{
            $("#unassignned_clients_projects").attr('hidden', true);
        }
    });
    
    
    // Show hide unassigned projects.
    $(".unassignned_projects_trigger").on("click", function(){
        if($(this).is(":checked")){
            $("#unassignned_projects").attr('hidden', false);
            
            
        }else{
            $("#unassignned_projects").attr('hidden', true);
        }
    });
    
    
    // Unapproved Task files notification count
    @if(Session::get("user")->id == 1)
        setInterval(function(){
            $.ajax({
                type:"GET",
                url:"{{ route('get_unapproved_task_files') }}",
                success:function(data){
                    console.log(data.length);
                    $(".unapproved_task_files_count").text(data.length);
                }
            });
        }, 10000);
    @endif
    
    
    // Unapproved task files
    $(".approve_task_file").on("click", function(){
        var id = $(this).attr("data-id");
        $.ajax({
            type:"POST",
            url:"{{ route('approve_task_file') }}",
            data:{
                "_token": "{{ csrf_token() }}",
                "id":id
            },
            success:function(data){
                if(data){
                    $("a[data-id='"+id+"']").closest("tr").remove();
                }
            }
        });
    });
    
    
    $(".view_project_in_dummy_calender_on_hold").on("click", function(){
        var id = $(this).attr("data-id");
        $.ajax({
            type:"POST",
            url:"{{ route('project_on_hold') }}",
            data:{"_token":"{{ csrf_token() }}", "id":id, "on_hold":$(this).is(":checked")},
            success:function(data){
                return console.log(data);
            }
        });
    });
    
    
    $(".project_approval").on("click", function(){
        var id = $(this).attr("data-id");
        $.ajax({
            type:"POST",
            url:"{{ route('task_approval') }}",
            data:{"_token":"{{ csrf_token() }}", "id":id},
            success:function(data){
                if($("a[data-id='"+id+"']").text() == "Approval"){
                    $("a[data-id='"+id+"']").attr("class", "btn btn-sm btn-warning project_approval");
                    $("a[data-id='"+id+"']").text("On Hold");
                    
                }else{
                    $("a[data-id='"+id+"']").attr("class", "btn btn-sm btn-success project_approval");
                    $("a[data-id='"+id+"']").text("Approval");
                }
            }
        });
    });
    
    
    $(".update_package").on("click", function(){
        var id = $(this).attr("data-id");
        $.ajax({
            type: "POST",
            url: "{{ route('get_package_by_id') }}",
            data: {"_token":"{{ csrf_token() }}", "id":id},
            success:function(package){
                $("#edit_package_modal .modal-title").text("Edit "+package.name);
                $("#edit_package_name").val(package.name);
                $("#edit_package_amount").val(package.amount);
                $("#edit_package_description").val(package.description);
                $("#edit_package_id").val(package.id);
                $("#edit_package_modal").modal("show");
            }
        });
    });
    
    $(".delete_package").on("click", function(){
        var id = $(this).attr("data-id");
        $.ajax({
            type: "POST",
            url: "{{ route('get_package_by_id') }}",
            data: {"_token":"{{ csrf_token() }}", "id":id},
            success:function(package){
                $("#delete_package_modal .modal-title").text(package.name);
                $("#message_in_confirm_delete_package_modal").text("Are you sure want to delete");
                $("#delete_package_id").val(package.id);
                $("#delete_package_modal").modal("show");
            }
        });
    });
    
    
    // *****************  COMPANIES *******************
    $(".edit-company-trigger").on("click", function(){
        var id = $(this).attr("data-id");
        $.ajax({
            type: "POST",
            url: "{{ route('get_company_by_id') }}",
            data: {"_token":"{{ csrf_token() }}", "id":id},
            success:function(data){
                var company = data["company"];
                var roles = data["roles"];
                var roles_list = "<option hidden selected disabled>-- Select Role --</option>";
                
                roles.map(function(role){
                    if(company.role_id == role.id){
                        roles_list += "<option value='"+role.id+"' selected>"+role.role+"</option>";
                        
                    }else{
                        roles_list += "<option value='"+role.id+"'>"+role.role+"</option>";
                    }
                    
                });
                
                $("#edit_company_modal .modal-title").text("Edit - "+company.first_name);
                $("#edit_company_first_name").val(company.first_name);
                $("#edit_company_role").html(roles_list);
                $("#edit_company_id").val(company.id_of_company);
                $("#edit_company_modal").modal("show");
                
            }
        });
    });
    
    $(".delete-company-trigger").on("click", function(){
        var id = $(this).attr("data-id");
        $.ajax({
            type: "POST",
            url: "{{ route('get_company_by_id') }}",
            data: {"_token":"{{ csrf_token() }}", "id":id},
            success:function(data){
                var company = data["company"];
                var roles = data["roles"];

                $("#message_in_confirm_delete_company_modal").text("Are you sure want to delete "+company.first_name);
                $("#delete_company_id").val(company.id_of_company);
                $("#confirm_delete_company_modal").modal("show");
                
            }
        });
    });
    
    
    
    $(".share_post").on("click", function(){
        var platform = $("select[name='platform']").val();
        var url = $("input[name='url']").val();
        $(this).attr("href", platform+""+url);
    });
    
    
    // Permissions Data table
    $(document).ready( function () {
        $('#permissions_datatable').DataTable();
    });
    
    
    // Roles Data table
    $(document).ready( function () {
        $('#roles_datatable').DataTable();
    });
    
    // Users Data table
    $(document).ready( function () {
        $('#users_datatable').DataTable();
    });
    
    
    // Clients Data table
    $(document).ready( function () {
        $('#clients_datatable').DataTable();
    });
    
    // Projects Data table
    $(document).ready( function () {
        $('#prjects_datatable').DataTable();
    });
    
    // Comments Data table
    $(document).ready( function () {
        $('#comments_datatable').DataTable();
    });
</script>




<!-- View Client modal -->
@if(Request::is("clients"))
  <script>
    $(".view_project_trigger").on("click", function(){

      let project_id = $(this).attr("data");
      $.ajax({
        url:"{{ route('get-project') }}",
        type:"GET",
        data:{"project_id":project_id},
        success:function(data){
            var project = data['project'];
            var client = data['client'];
            var permissions = data['permissions'];
            var permissions_list = '';
            
            if(permissions != null){
                permissions.map(function(permission){
                    permissions_list += "<li>"+permission.name+"</li>";
                });
            }else{
                permissions_list = "<li>No Permissions Assigned!</li>";
            }
            
            
            $("#view_project_modal .modal-title").text(project.name);
            $("#client_view_descritpion").text(project.description);
            $("#client_view_email").text(client.email);
            $("#client_view_role").text(client.role_name);
            $("#client_view_permissions").html(permissions_list);
            $("#view_project_modal").modal("show");
        }
      });
    });


    // Edit client modal
    @if(Session::get("user")->role_id == 1)
        $(".edit_project_trigger").on("click", function(){
            let project_id = $(this).attr("data");
            $.ajax({
                url:"{{ route('get-project') }}",
                type:"GET",
                data:{"project_id":project_id},
                success:function(data){
                    
                    var project = data['project'];
                    var client = data['client'];
                    var users = data['users'];
                    var roles = data['roles'];
                    
                    var roles_list = '<option value="" selected disabled hidden>-- Select Client Role --</option>';
                    var users_list = '';
                    
                    if(roles != null){
                        roles.map(function(role){
                            if(data['role_id'] == role.id){
                                roles_list += '<option value="'+role.id+'" selected>'+role.role+'</option>';    
                            }else{
                                roles_list += '<option value="'+role.id+'">'+role.role+'</option>';    
                            }
                            
                        });
                    }else{
                        roles_list = '<option value="" selected disabled hidden>-- No Role Found! --</option>';
                    }
                    
                    // Concatinating user's options.
                    if(users != null){
                        users_list += '<option value="" disabled hidden selected>-- Select User --</option>';
                        users.map(function(user){
                            if(user.id == project.user_id){
                                users_list += '<option value="'+user.id+'" selected>'+user.first_name+' '+user.last_name+'</option>';        
                            }else{
                                users_list += '<option value="'+user.id+'">'+user.first_name+' '+user.last_name+'</option>';    
                            }
                            
                        });
                    }else{
                        users_list = '<option value="" disabled hidden selected>-- No User Found! --</option>';
                    }
                    
                    $("#edit_project_modal .modal-title").text(project.name);
                    $("#edit_project_first_name").val(client.first_name);
                    $("#edit_project_description").text(project.description);
                    $("#edit_project_role").html(roles_list);
                    // $("#edit_project_user").html(users_list);
                    $("#update_client_profile").attr("value", "https://ultimatecontentcalendar.com/public/profile_images/"+client.img);
                    $("#client_old_profile").val(client.img);
                    $("#edit_project_id").val(project.id);
                    $("#edit_project_modal").modal("show");
                }
            });
        });
    @endif
    
  </script>
@endif

<!-- Comments -->
@if(Request::is("comments_view"))
    <script>
    
        // View comment
        $(document).on("click",".comment_view_trigger", function(){
            let $comment_id = $(this).attr("data")
            $.ajax({
                url: "{{ url('get-comment') }}",
                type: "GET",
                data:{"comment_id": $comment_id},
                success:function(data){
                    
                    if(data.color_id == 5){
                        $("#comment_view_modal .modal-title").html("<b>View:</b> "+
                            data.comment_type+" <br><span style='color:"+data.status_color+"; font-weight:bold;'> Rejected </span>");    
                    }else{
                        $("#comment_view_modal .modal-title").html("<b>View:</b> "+
                            data.comment_type+" <br><span style='color:"+data.status_color+"; font-weight:bold;'>"+data.status_name+"</span>");
                    }
                    
                    $("#comment_view_platform").text(data.platform);
                    $("#comment_view_url").text(data.url);
                    $("#comment_view_actual_comment").text(data.actual_comment);
                    $("#comment_view_feedback").val(data.feedback);
                    if(data.first_name == null){
                        $("#comment_view_sender").text("UNKNOWN");    
                    }else{
                        $("#comment_view_sender").text(data.first_name+" "+data.last_name);    
                    }
                    
                    $("#id_in_view_comment_modal").val(data.id);
                    
                    if(data.status == 1){
                        $("a.reject").show();
                        $("input.approve").show();
                        $('a.reject').attr('href',"{{ url('/comment_reject') }}"+"/"+data.id);
                    }else{
                        $("a.reject").hide();
                        $("input.approve").hide();
                        $("#comment_view_feedback").prop("disabled", true);
                    }
                    $("#comment_view_modal").modal("show");
                }
            });
        });


        // edit comment
        $(document).on("click", ".comment_edit_trigger", function(){
            
            let $comment_id = $(this).attr("data")
            $.ajax({
                url: "{{ url('get-comment') }}",
                type: "GET",
                data:{"comment_id": $comment_id},
                success:function(data){
                    $("#comment_id_in_edit_modal").val(data.id);
                    $("#comment_edit_modal .modal-title").html("<b>View:</b> "+
                    data.comment_type+" <span style='color:"+data.status_color+"; font-weight:bold;'>"+data.status_name+"</span>");
                    $("#edit_comment_platform").val(data.platform);
                    $("#edit_comment_url").val(data.url);
                    $("#edit_actual_comment").val(data.actual_comment);
                    $("#edit_comment_feedback").val(data.feedback);
                    $("#edit_comment_type").val(data.first_name);
                    $("#comment_edit_modal").modal("show");
                }
            });
        });
    </script>
@endif


@if(Session::has('success'))
    <script>
        toastr.success("{{ Session::get('success') }}");
    </script>
@endif

@if(Session::has('info'))
    <script>
        toastr.info("{{ Session::get('info') }}");
    </script>
@endif

@if(Session::has('failed'))
    <script>
        toastr.error("{{ Session::get('failed') }}");
    </script>
@endif

@if (Session::has('message'))
    <script>
        toastr.success("{{ Session::get('message') }}");
    </script>
@endif

<!-- Roles -->
@if (Session::has('role_success'))
    <script>
        toastr.success("{{ Session::get('role_success') }}");
    </script>
@endif

@if (Session::has('role_danger'))
    <script>
        toastr.error("{{ Session::get('role_danger') }}");
    </script>
@endif

@if (Session::has('role_info'))
    <script>
        toastr.info("{{ Session::get('role_info') }}");
    </script>
@endif

<!-- Users -->
@if (Session::has('user_success'))
    <script>
        toastr.success("{{ Session::get('user_success') }}");
    </script>
@endif

@if (Session::has('user_info'))
    <script>
        toastr.info("{{ Session::get('user_info') }}");
    </script>
@endif

@if (Session::has('user_danger'))
    <script>
        toastr.error("{{ Session::get('user_danger') }}");
    </script>
@endif

<!-- Projects -->
@if (Session::has('project_success'))
    <script>
        toastr.success("{{ Session::get('project_success') }}");
    </script>
@endif

@if (Session::has('project_info'))
    <script>
        toastr.info("{{ Session::get('project_info') }}");
    </script>
@endif

@if (Session::has('proejct_danger'))
    <script>
        toastr.error("{{ Session::get('proejct_danger') }}");
    </script>
@endif

<!-- Tasks -->
@if (Session::has('task_success'))
    <script>
        toastr.success("{{ Session::get('task_success') }}");
    </script>
@endif

@if (Session::has('task_info'))
    <script>
        toastr.info("{{ Session::get('task_info') }}");
    </script>
@endif

@if (Session::has('task_warning'))
    <script>
        toastr.error("{{ Session::get('task_warning') }}");
    </script>
@endif

@if (Session::has('task_danger'))
    <script>
        toastr.error("{{ Session::get('task_danger') }}");
    </script>
@endif

@if (Session::has('colors'))
    <script>
        alert("{{ Session::get('colors') }}");
    </script>
@endif

@if (Session::has('task_process'))
    <script>
        alert("{{ Session::get('task_process') }}");
    </script>
@endif


<!-- Comments -->
@if (Session::has('comment_success'))
    <script>
        toastr.info("{{ Session::get('comment_success') }}");
    </script>
@endif

@if (Session::has('comment_info'))
    <script>
        toastr.info("{{ Session::get('comment_info') }}");
    </script>
@endif

@if (Session::has('comment_error'))
    <script>
        toastr.error("{{ Session::get('comment_error') }}");
    </script>
@endif

<!-- All authentication errors -->
@if ($errors->any())
    <script>
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    </script>
@endif

</body>

</html>
