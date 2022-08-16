<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin</title>
    @include('admin.common.css')
    <link rel="shortcut icon" href="admin/assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      
      <!-- partial:partials/_sidebar.html -->
      @include('admin.common.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.common.navbar')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Product List</h4>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th style="max-width: 10rem;"> Product Name </th>
                        <th> Category</th>
                        <th> Quantity</th>
                        <th> Price </th>
                        <th style="max-width: 10rem;">Description </th>
                        <th class="text-center"> Actions</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $item)
                      <tr>
                        <td class="text-truncate" style="max-width: 10rem;">
                          <img src="{{ asset('storage/product_imgs/'.$item["image"]) }}" alt="image" style="border-radius: 0;width:50px;height:50px;">
                          <span class="ps-2"> {{  substr($item["title"], 0, 20)  }}</span>
                        </td>
                        <td> {{ $item->category->cat_title }}</td>
                        <td> {{ $item["quantity"] }} </td>
                        <td> {{ $item["price"] }}</td>
                        <td class="text-truncate" style="max-width: 10rem;"> 
                          {{-- {{ substr($item["description"], 0, 20) }}{{ "..." }}  --}}
                          {{ $item["description"] }}
                        </td>
                        
                        <td class="text-center">
                          <a href="{{ route("admin.updateproduct") }}/{{ $item["id"] }}" class="btn btn-info btn-icon-text"> 
                            Edit <i class="mdi mdi-file-check btn-icon-append"></i>
                          </a>
                          <a data-productid="{{ $item["id"] }}" class="deleteProductBtn btn btn-danger btn-icon-text">
                            Delete <i class="mdi mdi-delete btn-icon-append"></i> 
                          </a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            
          </div>
          <!-- content-wrapper ends -->
          @include('admin.common.footer')
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.common.js')
    <script>
      $(document).ready(function(){
          $(".deleteProductBtn").on('click', function deleteProduct(){
              let productid = $(this).data("productid");
              let row = $(this).parent().parent();
              console.log(productid);
              $.ajax({ 
                  url: "deleteproduct/"+productid,
                  data: { 
                      "productid": productid,
                  },
                  type: 'GET'
              }).done(function(responseData) {
                  console.log(responseData.success);
                  console.log(responseData.title);
                  row.remove();
              }).fail(function() {
                  console.log(responseData.error);
              });
          });
      }); 
  </script>
  </body>
</html>