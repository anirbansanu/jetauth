
<div class="p-5"></div>
<section class="h-100 gradient-custom">
    <div class="container py-5">
      <div class="row d-flex justify-content-center my-4">
        <div class="col-md-8">
          @php
              $ttlprice = 0;
              $deliveryCharges = 40;
              $item = 0;
          @endphp
          @foreach ($orders as $order)
          @php
              $item++;
          @endphp     
          <div class="card mb-4">
            <div class="card-header">
                <h4 class="card-title">{{ $order["title"] }}</h4>
            </div>
            <div class="card-body">
              <!-- Single item -->
              <div class="row">
                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                  <!-- Image -->
                  <div class="bg-image hover-overlay hover-zoom ripple rounded mb-2" data-mdb-ripple-color="light">
                    <img src="{{ asset('storage/product_imgs/'.$order["image"]) }}" class="w-100" alt="{{ $order["image"] }}" />
                    <a href="#!">
                      <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                    </a>
                  </div>
                  

                  <!-- Image -->
                </div>
  
                <div class="col-lg-7 col-md-6 mb-4 mb-lg-0">
                  <!-- Data -->
                  <p><strong><b>Description</b></strong></p>
                  <p>{{ $order['description'] }}</p>
                  <div class="form-outline d-flex justify-content-between pt-2 pb-2 text-info">
                    <h3 class="h4 font-weight-bold ">Order Quantity</h3>
                    <h3 class="h4 font-weight-bold ">{{ $order['order_quantity'] }}</h3>
                  </div>
                    
                  
                  <!-- Data -->
                </div>

              </div>
              <!-- Single item -->
  
              <hr class="my-1" />
  
              <!-- Single item -->
              <div class="d-flex justify-content-between" >
                <div class="d-flex">
                  

                  <h1 class="h3 font-weight-bold ">Price</h1>
                  
                </div>
                <p class="h3 font-weight-bold price">${{ $order['order_price'] }}</p>
                @php
                    $ttlprice = $ttlprice+$order['order_price'];
                @endphp
              </div>
              <hr class="mt-1 mb-2" />
              <!-- Single item -->
            </div>
          </div>
          @endforeach
          <div class="card mb-4">
            <div class="card-body">
              <p><strong>Expected shipping delivery</strong></p>
              <p class="mb-0">12.10.2020 - 14.10.2020</p>
            </div>
          </div>
          <div class="card mb-4 mb-lg-0">
            <div class="card-body">
              <p><strong>We accept</strong></p>
              <img class="me-2" width="45px"
                src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg"
                alt="Visa" />
              <img class="me-2" width="45px"
                src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg"
                alt="American Express" />
              <img class="me-2" width="45px"
                src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg"
                alt="Mastercard" />
              
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-4">
            <div class="card-header py-3">
              <h5 class="mb-0">Summary</h5>
            </div>
            <div class="card-body">
              <ul class="list-group list-group-flush">
                <li
                  class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                  Products
                  @php
                      echo ' ( Items '.$item.' )'
                  @endphp
                  <span id="prodttlprice">{{ '$'.$ttlprice }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                  Shipping
                  <span id="deliverycharges">{{ '$'.$deliveryCharges }}</span>
                </li>
                <li
                  class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                  <div>
                    <strong>Total amount</strong>
                    <strong>
                      <p class="mb-0">(including VAT)</p>
                    </strong>
                  </div>
                  <span>
                    <strong id="ttlprice">{{ '$'.($ttlprice+$deliveryCharges) }}</strong>
                  </span>
                </li>
              </ul>
  
              <button type="button" disabled class="btn btn-outline-danger btn-lg btn-block">
                Order Confrimed
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  