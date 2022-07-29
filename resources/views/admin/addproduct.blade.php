<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
                <h3 class="page-title"> ADD PRODUCT </h3>
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
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">addproduct</li>
                  </ol>
                </nav>
            </div>
            {{-- ADD PRODUCT --}}
            <div class="card">
                <form class="forms-sample" action="{{ route('admin.setproduct') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                        
                            <div class="card-body">
                                <h4 class="card-title">Fill Product Details</h4>
                                <p class="card-description"> Basic form </p>
                                    
                                    <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Product Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" class="form-control" id="price" name="price" placeholder="Product Price">
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Product Quantity">
                                    </div>
                                    <div class="form-group">
                                        <label for="Category">Category</label>
                                        <select class="form-control" name="category_id" id="Category">
                                          <option default>Set Category</option>
                                          @foreach ($data as $item)
                                            <option value="{{ $item['id'] }}">{{ $item['cat_title'] }}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                    
 
                            </div>
                        
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                        
                            <div class="card-body">
                                <h4 class="card-title p-2"></h4>
                                <p class="card-description p-2"></p>
                                <div class="forms-sample">
                                    <div class="form-group">
                                        <label for="description">Product Description</label>
                                        <textarea class="form-control" id="description" name="description" placeholder="Product Description" rows="5" style="min-height: 15vh;"></textarea>
                                    </div>
                                    {{-- File Upload --}}
                                    <div class="card-body px-0">
                                        <input type="file" name="file" class="dropify form-control" style="background: #2f363d" />
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary me-2">Add Product</button>
                                    <button class="btn btn-dark" type="reset">Cancel</button>
                                </div>
                            </div>
                        
                        </div>
                    
                    </div>
                </form>
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