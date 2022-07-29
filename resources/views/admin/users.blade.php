<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
                        <th style="max-width: 10rem;"> User Name </th>
                        <th> Phone</th>
                        <th> Email</th>
                        <th> Address </th>
                        <th> Change Type </th>
                        <th class="text-center"> Actions</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($usersdata as $item)
                      <tr>
                        <td class="text-truncate" style="max-width: 10rem;">
                          {{-- <img src="{{ asset('storage/product_imgs/'.$item["image"]) }}" alt="image" style="border-radius: 0;width:50px;height:50px;"> --}}
                          <span class="ps-2"> {{  substr($item["name"], 0, 20)  }}</span>
                        </td>
                        <td> {{ $item["phone"] }}</td>
                        <td> {{ $item["email"] }} </td>
                        <td> {{ $item["address"] }}</td>
                        
                        <td class="text-center">
                            <select class="form-control" data-userid="{{ $item["id"] }}" id="changetype" style="width: 8rem;">
                                @if ($item["usertype"])
                                <option value="{{ $item["usertype"] }}" default>Admin</option>
                                <option value="0">User</option>
                                @else
                                <option value="{{ $item["usertype"] }}">User</option>
                                <option value="1">Admin</option>
                                @endif
                                
                            </select>
                        </td>
                        <td class="text-center">
                            
                          <button type="button" class="btn btn-danger btn-icon-text">
                            Delete <i class="mdi mdi-delete btn-icon-append"></i> 
                          </button>
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
            $("#changetype").on('change', function postinput(){
                var usertype = $(this).val(); 
                var userid = $(this).data("userid");
                var token = $("meta[name='csrf-token']").attr("content");
                $.ajax({ 
                    url: "{{ route("admin.usertype") }}",
                    data: { 
                        "userid": userid,
                        "usertype": usertype,
                        "_token": token
                    },
                    type: 'POST'
                }).done(function(responseData) {
                    console.log('Done: ', responseData.usertype);
                    console.log('Done: ', responseData.data);
                }).fail(function() {
                    console.log('Failed');
                    console.log(usertype);
                });
            });
        }); 
    </script>
  </body>
</html>