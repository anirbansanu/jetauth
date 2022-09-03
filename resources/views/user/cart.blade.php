<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>LOUT </title>

    @include('user.common.css')

    <style>
      
    </style>
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
    
    <!-- Cart Grid Starts Here -->
    @include('user.common.cartcard')
    <!-- Cart Grid Ends Here -->
    

   

    
    @include('user.common.footer')

    @include('user.common.javascript')
    <script>
      $(document).ready(function(){
        
          $(".plus").on('click', function deleteProduct(){
              let row = $(this).parent();
              let input = row.find('input[type=number]');
              let value = parseInt(input.val());
              value = value+1;
              input.val(value);
              let price = row.parent().find('.price').text();
              price = parseInt(price.substring(1, price.length));
              let newprice = price + (price / (value-1));

              row.parent().find('.price').text('$'+newprice);
              let prodttlprice = $('#prodttlprice').text();
              prodttlprice = parseInt(prodttlprice.substring(1, prodttlprice.length));
              $('#prodttlprice').text('$'+(prodttlprice + newprice - price));

              let ttlpricespan = $('#ttlprice').text();
              ttlpricespan = parseInt(ttlpricespan.substring(1, ttlpricespan.length));
              $('#ttlprice').text('$'+(ttlpricespan + newprice - price));
              var quantity = value; 
              var cart_id = input.data('cart_id');
              var token = $("meta[name='csrf-token']").attr("content");
              
              $.ajax({ 
                  url: "{{ route("user.updatecart") }}",
                  data: { 
                      "cart_id": cart_id,
                      "order_quantity": quantity,
                      "_token": token
                  },
                  type: 'POST'
              }).done(function(responseData) {
                  console.log('Done Quantity : ', responseData.quantity);
              }).fail(function(responseData) {
                  console.log('Failed');
                  console.log(responseData.order_quantity);
                  console.log(responseData.cart_id);
              });

          });
          $(".minus").on('click', function deleteProduct(){
              let row = $(this).parent();
              let input = row.find('input[type=number]');
              let value = parseInt(input.val());
              
              value = value-1;
              if(value >= 1){
                input.val(value);
                let price = row.parent().find('.price').text();
                price = parseInt(price.substring(1, price.length));
                let newprice = price - (price / (value+1));
                row.parent().find('.price').text('$'+newprice);
                let prodttlprice = $('#prodttlprice').text();
                prodttlprice = parseInt(prodttlprice.substring(1, prodttlprice.length));
                $('#prodttlprice').text('$'+(prodttlprice - (price - newprice)));
                
                let ttlpricespan = $('#ttlprice').text();
                ttlpricespan = parseInt(ttlpricespan.substring(1, ttlpricespan.length));
                $('#ttlprice').text('$'+(ttlpricespan - (price - newprice)));

                var quantity = value; 
                var cart_id = input.data('cart_id');
                var token = $("meta[name='csrf-token']").attr("content");
                $.ajax({ 
                    url: "{{ route("user.updatecart") }}",
                    data: { 
                        "cart_id": cart_id,
                        "order_quantity": quantity,
                        "_token": token
                    },
                    type: 'POST'
                }).done(function(responseData) {
                    console.log('Done Quantity : ', responseData.quantity);
                }).fail(function(responseData) {
                    console.log('Failed');
                    console.log(responseData.order_quantity);
                    console.log(responseData.cart_id);
                });
              }

          });
      }); 
      
    </script>

    
  </body>

</html>
