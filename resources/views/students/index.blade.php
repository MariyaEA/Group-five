<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Personal Computer Registration and Verification System</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

  <!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.9/css/mdb.min.css" rel="stylesheet">


<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.9/js/mdb.min.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
 
 <style>
   .container{
    padding: 0.5%;
   } 
</style>
</head>
<body>

<ul class="navbar-nav ml-auto" style="float: right; padding-right:10px;" >
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
 <br>
<div class="container"><br><br>
    <h2 style="margin-top: 12px; color:black;text-align: center; " class="alert alert-warning"><b>Personal Computer Registration and Verification System</h2><br>
    <div class="row">
        <div class="col-12">
          <a href="javascript:void(0)" class="btn btn-dark-green  " style="margin-left:85%" id="create-new-user">Register</a> 
          <table class="table table-bordered" id="laravel_crud">
           <thead>
              <tr>
                 <th>Id</th>
                 <th>Image</th>
                 <th>First Name</th>
                 <th>Last Name</th>
                 <th>Gender</th>
                 <th>Laptop Name</th>
                 <th>Serial Number</th>
                 <th >Department</th>
                 <th >Profession</th>
                 <th >Identification Number</th>
                 <td colspan="2">Action</td>
              </tr>
           </thead>
           <tbody id="users-crud">
              @foreach($students as $student)
              <tr id="user_id_{{ $student->id }}">
                 <td>{{ $student->id  }}</td>
                 <td><a href="#"><img src="/photos/{{ $student->img }}" style="width:100px;height:80px; border-radius:5px;"></a></td>
                 <td>{{ $student->firstname }}</td>
                 <td>{{ $student->lastname }}</td>
                 <td>{{ $student->gender }}</td>
                 <td>{{ $student->laptop_name }}</td>
                 <td>{{ $student->serial_number}}</td>
                 <td>{{ $student->department }}</td>
                 <td>{{ $student->profession }}</td>
                 <td>{{ $student->identification }}</td>
                
                 <td> 
                 <a href="{{ url('/students/'.$student->id . '/edit') }}" id="edit-user" data-id="{{ $student->id }}"class="btn btn-info btn-sm" value="Edit">Edit</a>
                  <a href="/delete/{{$student->id}}"  class="btn btn-danger btn-sm" value="Delete">Delete</a></td>
              </tr>
              @endforeach
           </tbody>
          </table>
          {{ $students->links() }}
       </div> 
    </div>
</div>

<!-- ------------------------------------------------USER MODAL AREA------------------------------------------------------ -->

<div class="modal fade" id="ajax-crud-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
<div class="modal-dialog modal-notify modal-success" id="notify" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="userCrudModal"></h4>
        </div>
        <div class="modal-body">
        <span id="message_errors"></span>
            <form method="POST" action="{{ route('students.store') }}" id="userForm" name="userForm" class="form-horizontal" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label">First Name</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control"  name="firstname" placeholder="Enter Name" value="" maxlength="50" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label">Last Name</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control"  name="lastname" placeholder="Enter Name" value="" maxlength="50" >
                    </div>
                </div>
 
                <div class="form-group">
                    <label class="col-sm-2 control-label">Gender</label>
                    <div class="col-sm-12">
                    <select name="gender" class="form-control">
                        <option>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label">Laptop Name</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control"  name="laptop_name" placeholder="Enter Laptop Name" value="" maxlength="50" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label">Serial Number</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control"  name="serial_number" placeholder="Serial Number" value="" maxlength="50" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Department</label>
                    <div class="col-sm-12">
                    <select name="department" class="form-control">
                        <option>Select Department</option>
                        <option value="computer science">Computer Science</option>
                        <option value="software engineering">Software Enginnering</option>
                        <option value="information technology">Information Technology</option>
                        <option value="information system">Information System</option>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Profession</label>
                    <div class="col-sm-12">
                    <select name="profession" class="form-control">
                        <option>Select Profession</option>
                        <option value="student">Student</option>
                        <option value="lecturer">Lecturer</option>
                        <option value="staff">Staff</option>
                        
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">ID</label>
                    <div class="col-sm-12">
                        <textarea type="text" class="form-control"  name="identification" placeholder="Enter Identification Number" value="" maxlength="500" ></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Image</label>
                    <div class="col-sm-12">
                        <input type="file" class="form-control"  name="img" placeholder="Choose Image" >
                       
                    </div>
                </div>
                <span id="previw_image"></span>
           
        </div>
        <div class="modal-footer">
            <input type="hidden" name="action" id="action" />
            <button type="button" class="btn btn-warning " id="btn-cancel" value="cancel">Cancel
            </button>
            <button type="submit" name="btn-save" class="btn btn-info" id="btn-save" >Save Student</button>
           
        </div>
        </form>
    </div>
  </div>
</div>


<div class="modal fade" id="ajax-crud-edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
<div class="modal-dialog modal-notify modal-info" id="notify" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="userCrud-edit-Modal"></h4>
        </div>
        <div class="modal-body">
        <span id="message_errors"></span>
        <form method="POST" action="{{ route('students.store') }}" id="userForm" name="userForm" class="form-horizontal" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label">First Name</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter Name" value="" maxlength="50" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label">Last Name</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="lastname"  name="lastname" placeholder="Enter Name" value="" maxlength="50" >
                    </div>
                </div>
 
                <div class="form-group">
                    <label class="col-sm-2 control-label">Gender</label>
                    <div class="col-sm-12">
                    <select name="gender" class="form-control" id='gender'>
                        <option>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label">Laptop Name</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control"  name="laptop_name" placeholder="Enter Laptop Name" value="" maxlength="50" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label">Serial Number</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control"  name="firstname" placeholder="Serial Number" value="" maxlength="50" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Department</label>
                    <div class="col-sm-12">
                    <select name="country" class="form-control">
                        <option>Select Department</option>
                        <option value="gambia">Computer Science</option>
                        <option value="senegal">Software Enginnering</option>
                        <option value="indonesia">Information Technology</option>
                        <option value="usa">Information System</option>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Profession</label>
                    <div class="col-sm-12">
                    <select name="city" class="form-control">
                        <option>Select Profession</option>
                        <option value="student">Student</option>
                        <option value="lecturer">Lecturer</option>
                        <option value="staff">Staff</option>
                        
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">ID</label>
                    <div class="col-sm-12">
                        <textarea type="text" class="form-control" id='address'  name="address" placeholder="Enter Identification Number" value="" maxlength="500" ></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Image</label>
                    <div class="col-sm-12">
                        <input type="file" class="form-control" id='img' name="img" placeholder="Choose Image" >
                        @if(!empty($student->image))
                            <input type="hidden" name="current_image" value="{{ $student->image }}"> 
                          @endif
                        </td>
                        <td>
                          @if(!empty($student->image))
                            <img src="/photos/{{ $student->img }}" style="width:100px;height:80px; border-radius:5px;"></a></td>
                            <!-- <img style="width:30px;" src="{{ asset('/images/backend_images/product/small/'.$productDetails->image) }}"> | <a href="{{ url('/admin/delete-product-image/'.$productDetails->id) }}">Delete</a> -->
                          @endif
                    </div>
                </div>
                <span id="previw_image"></span>
           
        </div>
        <div class="modal-footer">
            <input type="hidden" name="action" id="action" />
            <button type="button" class="btn btn-warning " id="btn-cancel" value="cancel">Cancel
            </button>
            <button type="submit" name="btn-save" class="btn btn-info" id="btn-save" >Update Student</button>
           
        </div>
        </form>
    </div>

  </div>
</div>


</body>
<!-- ------------------------------------------------USER JQUERY SCRIPT AREA------------------------------------------------------ -->

<script>

    

    $('#create-new-user').click(function () {
    $('#userCrudModal').text("PCRVS FORM ");
        $('#ajax-crud-modal').modal('show');
    });

    $('#btn-cancel').click(function () {
        $('#ajax-crud-modal').modal('hide');
    });


// --------------------Student-Edit--------Start Here-------------------
     $(document).on('click', '#edit-user', function(){
    $('#ajax-crud-edit-modal').modal('show');
    $('#userCrud-edit-Modal').text("Edit Student Details ");


	$fetch = $(this).closest('tr');
	var data = $fetch.children("td").map(function(){
		return $(this).text();

	}).get();

    console.log(data);
	$('#user_id').val(data[0]);
    $('#img').val(data[1]);
	$('#firstname').val(data[2]);
	$('#lastname').val(data[3]);
	$('#gender').selected.val(data[4]);
	$('#country').val(data[5]);
	$('#city').val(data[6]);
	$('#address').val(data[7]);
	
  });

$(document).on('click', '#edit-user', function(event){
    event.preventDefault();
     var id = $('#user_id').val();
    //  $('#message_errors').html('');
  $.ajax({
     type: "PUT",
     url:"/student-update/"+id,
     data:('#userCrud-edit-Modal'),
     contentType: false,
     catch: false,
     processData: false,
                // dataType: "json",
       success:function(response){
      console.log(response);
    $('#ajax-crud-edit-modal').modal('hide');
    alert("Student Updated Successfully");
   },
   error: function(error)
   {
    console.log(error);

   }
  });
 });

 $(document).on('click','#delete-user', function(event){
    event.preventDefault();
    var id = $('#user_id').val();
    $('#ajax-crud-delete-modal').modal('show');
    //alert("Student Updated Successfully");
    $('#userCrud-delete-Modal').text("Delete Student Details ");


 });


//  $(document).on('click', '#edit-user', function(){
//      var id = $(this).attr('id');
//      $('#message_errors').html('');
//   $.ajax({
//    url:"/ajax-crud/"+id+"/edit",
//    dataType:"json",
//    success:function(html){
//     $('#name').val(html.data.name);
//     $('#email').val(html.data.email);
//     $('#preview_image').html("<img src={{ URL::to('/') }}/photos/" + html.data.img + " width='70' class='img-thumbnail' />");
//     $('#preview_image').append("<input type='hidden' name='hidden_image' value='"+html.data.img+"' />");
//     $('#user_id').val(html.data.id);
//     $('#userCrudModal').text("Edit User Details");
//     $('#user_id').val("Edit");
//     $('#btn-save').val("Edit");
//     $('#ajax-crud-modal').modal('show');
//    }
//   })
//  });

   
                    // {
                        
                    //     {
                    //         html += '<p>' + data.errors[count] + '</p>'
                           
                    //     }
                       
                    // }
 
   /* When click edit user */
//     $('body').on('click', '#edit-user', function () {
//       var user_id = $(this).data('id');
//       $.get('ajax-crud/' + user_id +'/edit', function (data) {
//          $('#userCrudModal').html("Edit User");
//           $('#btn-save').val("edit-user");
//           $('#ajax-crud-modal').modal('show');
//           $('#user_id').val(data.id);
//           $('#name').val(data.name);
//           $('#email').val(data.email);
//           $('#password').val(data.password);
//       })
//    });
   //delete user login
//     $('body').on('click', '.delete-user', function () {
//         var user_id = $(this).data("id");
//         confirm("Are You sure want to delete !");
 
//         $.ajax({
//             type: "DELETE",
//             url: "{{ url('ajax-crud')}}"+'/'+user_id,
//             success: function (data) {
//                 $("#user_id_" + user_id).remove();
//             },
//             error: function (data) {
//                 console.log('Error:', data);
//             }
//         });
//     });   
//   });
 
//  if ($("#userForm").length > 0) {
//       $("#userForm").validate({
 
//      submitHandler: function(form) {
 
    //   var actionType = $('#btn-save').val();
    //   $('#btn-save').html('Sending..');
      
    //   $.ajax({
    //       data: $('#userForm').serialize(),
    //       type: "POST",
    //       dataType: 'json',
    //       success: function (data) {

    //           console.log(data);
    //           var user = '<tr id="user_id_' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.email + '</td><td>' + data.password + '</td>';
    //           user += '<td><a href="javascript:void(0)" id="edit-user" data-id="' + data.id + '" class="btn btn-info">Edit</a></td>';
             // user += '<td><a href="javascript:void(0)" id="delete-user" data-id="' + data.id + '" class="btn btn-danger delete-user">Delete</a></td></tr>';
               
              
    //           if (actionType == "create-user") {
    //               $('#users-crud').prepend(user);
    //           } else {
    //               $("#user_id_" + data.id).replaceWith(user);
    //           }
 
    //           $('#userForm').trigger("reset");
    //           $('#ajax-crud-modal').modal('hide');
    //           $('#btn-save').html('Save User');
              
//           },
//           error: function (data) {
//               console.log('Error:', data);
//               $('#btn-save').html('Save User');
//           }
//       });
//     }
//   })
// }
   
  
</script>

</html>