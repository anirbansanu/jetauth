<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>LOUT </title>

    @include('user.common.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>

    
  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    @include('user.common.navbar')

    <!-- Page Content -->
    
    <!-- Products Grid Starts Here -->
    @include('user.common.product')
    <!-- Products Grid Ends Here -->
    

   

    
    @include('user.common.footer')

    @include('user.common.javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script>
      $(document).ready(function(){
          $("#addToCart").on('click', function postinput(){
              var btn = $(this);
              btn.text("Adding...");
              var product = $(this).data("product");
              var token = $("meta[name='csrf-token']").attr("content");
              $.ajax({ 
                  url: "{{ route("user.cart") }}",
                  data: { 
                      "product_id": product,
                      "_token": token
                  },
                  type: 'POST'
              }).done(function(response) {
                  console.log('Done: ', response.data);
                  btn.text("Add to Cart");
                  toastr.success(response.data);
              }).fail(function(response) {
                  console.log('Failed : ', response.data);
                  console.log(product);
                  toastr.error(response.data);
              });
              
          });
      }); 
  </script>

  </body>

</html>
