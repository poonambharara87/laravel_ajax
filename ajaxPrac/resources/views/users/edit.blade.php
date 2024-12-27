<!DOCTYPE html>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <meta name="csrf-token" content="{{ csrf_token()}}">
    </head>
    <body>
        <form id="updateForm" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Enter Name"/>
            <br></br>
            <input type="email" name="email" placeholder="Enter Email">
            <br></br>
            <input type="file" name="image" >
            <br></br>
            <input type="submit"  id="btnSubmit_" name="AddUser_"/>
        </form>
        <span id="output_"></span>
    </body>

    <script>

        $(document).ready(function(){

            $('#updateForm').submit(function(event){
                event.preventDefault();
                $.ajaxSetup({
                  headers: {'X-CSFR-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                });

                var data = new FormData(this);
                $('#btnSubmit_').prop('disabled', true);
                    $.ajax({
                        type:"POST",
                        url:"{{route('addUser', ['id' => id])}}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data:data,
                        processData:false,
                        contentType:false,
                        success:function(data){
                            $('#output_').text(data.res);
                            $('#btnSubmit_').prop('disabled', false);
                        },
                        error:function(data){
                            $('#output_').text(data.res);
                            $('#btnSubmit_').prop('disabled', false);
                        }
                    });
            });
            });
          
    </script>
</html> 