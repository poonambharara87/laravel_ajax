<!DOCTYPE html>
<html>
    <head>
        <title>User List</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <meta name="csrf-token" content="{{csrf_token()}}">
    </head>
    <body >
        <div class="container">
            <table class="row justify-content-center" >
                <tr>
                    <th>name<th>
                    <th>email<th>
                    <th>image<th>
                </tr>

                @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}<td>
                        <td>{{$user->email}}<td>
                        <td><button  class="editButton" data-bs-toggle="modal" data-userid="{{$user->id}}" data-bs-target="#editModal_" >Edit</button></td>      
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="modal fade" id="editModal_" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
            
                <div class="modal-body">
                
            
            
                    <form id="editForm_" >
                        <label>Name</label>
                        <input type="text" name="name" id="user_name" placeholder="Enter Name"/>
                        <br></br>
                        <label>Email</label>
                        <input type="email" name="email" id="user_email" placeholder="Enter Email"/>
                        <br></br>
                        <input type="submit" value="update" class="update_user"/>
                    </form>
                    <span id="messsage_output" ></span>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function(){

                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('content')
                    }
                });

                $(document).on('click', '.editButton', function(event) {
                    event.preventDefault();
                    var id = $(this).data('userid');
                    
                    $.ajax({
                       
                        type:'GET',
                        url:"getUserData/"+id,
                        processData:false,
                        success:function(data){
                            $('#user_name').val(data.name);
                            $('#user_email').val(data.email);
                        },
                        error:function(data)
                        {
                            alert('fail'); 
                        }
                        
                    });
                });
                
                

                
                
            });

        
        //    ==========

        // submit the form
        $('#editForm_').on('submit', function (event) {
            var userid = $('.editButton').data('userid');
           
            event.preventDefault();
           $.ajaxSetup({
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
           })
            var userName = $('#user_name').val();
          
            var userEmail = $('#user_email').val();
            
            $.ajax({
                type: 'POST',
                url: 'updateUser/' + userid,
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    name: userName,
                    email: userEmail
                },
                success: function (res) {
                    ('#editModal_').modal('toggle');
                    $('#user_name').val(res.name);
                      $('#user_email').val(res.email);
                     
                },
                error: function () {
                
                    $('#message_output').html('<div class="alert alert-danger">Failed to update user.</div>');
                }
            });
        });
        //    ==========
        </script>
    </body>
</html>