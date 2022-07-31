<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>LOUT </title>

    @include('user.common.css')

    
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



  </body>

</html>
