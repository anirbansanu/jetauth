<div class="latest-products">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Latest Products</h2>
            <a href="products.html">view all products <i class="fa fa-angle-right"></i></a>
          </div>
        </div>
        @foreach ($products as $item)
          <div class="col-md-4">
            <div class="product-item">
              <a href="#">
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
  </div>