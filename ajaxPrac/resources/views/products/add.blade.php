<!DOCTYPE html>
<html>
    <head>
        <title>Add Product</title>
        <meta name="csrf-token" content="csrf_token()">
    </head>
    <body>

        <form method="post" action="{{route('product-store')}}" enctype="multipart/formdata">
            @csrf
            <label>Product Name</label>
            <input type="text" name="name" placeholder="Product Name"/>
            <br></br>
            <label>Detail</label>
            <input type="text" name="detail" placeholder="Product Detail">
            <br></br>
            <input type="submit" value="add_product"/>
        </form>
        <script>

        </script>
    </body>
</html>
