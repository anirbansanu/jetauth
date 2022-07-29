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
    <style>
        .dropify-preview{
            background-color: #292f36 !important;
        }
    </style>
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
            <div class="page-header">
                <h3 class="page-title"> ADD CATEGORIES </h3>
                
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">categories</li>
                  </ol>
                </nav>
            </div>
            {{-- CATEGORIES LIST AND ADD --}}
            <div class="card">
                <div class="card">
                    @if (\Session::has('success'))
                    <div class="alert alert-success">
                        
                            {!! \Session::get('success') !!}
                        
                    </div>
                    @endif
                    @if (\Session::has('error'))
                        <div class="alert alert-danger">
                            
                                {!! \Session::get('error') !!}
                            
                        </div>
                    @endif
                    <div class="card-body">
                      <h4 class="card-title">Categories</h4>
                      {{-- {{ Add Category }} --}}
                      <div class="add-items d-flex">
                        <form class="d-flex w-100" method="POST" action="{{ route("admin.addcategory") }}">
                            @csrf
                            <input type="text" class="form-control" id="todo-list-input" name="cat_title" placeholder="Enter Category">
                            <button type="submit" class="btn btn-primary todo-list-add-btn">Add</button>
                        </form>
                      </div> 
                      <div class="list-wrapper">
                        {{-- {{ Category List }} --}}
                        <ul class="d-flex flex-column-reverse text-white todo-list todo-list-custom">
                        @foreach ($data as $item)
                          <li>
                                <div class="form-check form-check-primary">
                                    
                                    <label class="form-check-label">
                                        <input class="checkbox" name="cat_title_checkbox" type="checkbox"/> {{ $item["cat_title"] }}
                                        <i class="input-helper"></i>
                                    </label>
                                </div>
                                <i class="remove mdi mdi-close-box" data-id="{{ $item["id"] }}" ></i>
                            
                          </li>
                          @endforeach
                        </ul>
                      </div>
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
  </body>
</html>