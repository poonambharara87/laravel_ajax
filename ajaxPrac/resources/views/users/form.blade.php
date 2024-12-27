<!DOCTYPE html>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>    
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
    <body>
    <form id="myform" enctype="multipart/form-data">

        <input type="text" name="name" placeholder="Enter product name" required>
        <br></br>
        <input type="email" name="email" placeholder="Enter product name" required>
        
        <br></br>
        <input type="file" name="image" required>
        <br></br>
        <input type="submit" value="Add Student" id="btnSubmit" required>
    </form>
        <span id="outPut"></span>
    </body>
    <script>

    $(document).ready(function(){
        $('#myform').submit(function(event){
            event.preventDefault();

            var data = new FormData(this);
          
            $('#btnSubmit').prop('disabled', true);

            $.ajaxSetup({
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:"POST",
                url: "{{route('addUser')}}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:data,
                processData:false,
                contentType:false,
                success:function(data){
                    $('#outPut').text(data.res);
                    $('#btnSubmit').prop('disabled', false);
                },
                error:function(){
                    $('#outPut').text(data.res);
                    $('#btnSubmit').prop('disabled', false);
                }
            });
        });
    });

    getUserData(id);
    
    function getUserData()
    {
        var id = $(this).data('id');
        
        $.ajax({
            type:"GET",
            url:"user"+id,
            proccessData:false,
            contentType:false,
            success: function(data){
                alert(data);
            },
            error:function(data){
                alert(data);
            }
        })
    }
    </script>   
</html>