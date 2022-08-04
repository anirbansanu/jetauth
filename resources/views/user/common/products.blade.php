<style>
  .latest-products{
      margin-top: 0px !important;
  }
  .page-item.active .page-link {
    color: #fff !important;
    background: rgb(236, 83, 83) !important;
    border: 1px solid #f00;
  }
  .page-item .page-link{
    color: rgb(255, 145, 0);
    border: 1px solid rgb(238, 128, 26);
  }
  .page-item.disabled .page-link{
    color: rgb(255, 145, 0, 0.4);
    border: 1px solid rgb(238, 128, 26, 0.6);
  }
</style>
<div class="latest-products">
    <div class="p-5"></div>
    <div class="container">
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
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Latest Products</h2>
            <a href="{{ route("user.allproducts") }}">view all products <i class="fa fa-angle-right"></i></a>
          </div>
        </div>
        <div class="col-md-12 pb-5">
          <div class="d-flex justify-content-center">
            {!! $products->links() !!}
          </div>
        </div>
        @foreach ($products as $item)
          <div class="col-md-4">
            <div class="product-item">
              <a href="{{ route("user.product").'/'.$item["id"] }}">
                <img src="{{ asset('storage/product_imgs/'.$item["image"]) }}" alt="" style="height:250px;object-fit: scale-down;">
              </a>
              
              <div class="down-content">
                <div class="d-flex justify-content-between">
                  <p class="h4 text-turncate">${{ $item['price'] }}</p>
                  <p class=""><s>$1200</s> 20% off</p>
                </div>
                  <a href="#" class="h4">
                    <div class="row">
                      <div class="col-12 h4 text-truncate">
                        <p class="h4 text-truncate">{{ $item['title'] }}</p>
                      </div>
                    </div>
                  </a>
                <div class="row">
                  <div class="col-12 line-clamp" >
                    <p class="line-clamp" style="overflow: hidden;">{{ $item['description'] }}</p>
                  </div>
                </div>
                
                <ul class="stars">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
                <span>Reviews (24)</span>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
    
    <div class="d-flex justify-content-center">
        {!! $products->links() !!}
    </div>
</div>