<!DOCTYPE html>
<html>
    <head>
        <title>Ajax Edit</title>
        <meta name="csrf" content="{{csrf_token()}}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="jquery-3.7.1.min.js"></script>
    </head>
    <body>
        <form id="editForm">
            <input type="text" name="name" placeholder="Enter your name"/>
             <br></br>
            <input type="email" name="email"  placeholder="Enter your email"/>
            <br></br>
            <input type="file" name="image" />
            <br></br>
            <input type="submit" value="edit_button"/>
        </form>
        <span id="messsage_output" ></span>
            <script>

                $(document).ready(function(){

                    $('#editForm').submit(function(event){
                        event.preventDefault();

                        var data = new FormData(this);
                        $.ajaxSetup({
                            headers:{'X-CSFR-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                        }),
                        $.ajax({
                            type:"POST",
                            url:"update/"+id,
                            headers:
                                    {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                            data:data,
                            contentType:false,
                            processdata:false,
                            success:function(data)
                            {
                                console.log(data);
                                $('#messsage_output').text(data.res);
                            },
                            error:function()
                            {
                                console.log(data);
                                $('#messsage_output').text(data.res);
                            }

                        });
                    });
                });
            
            </script>
    </body>
</html>