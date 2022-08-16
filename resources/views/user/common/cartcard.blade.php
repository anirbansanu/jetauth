<style>
    .btn-primary{
      color: rgb(61, 237, 243);
    }
    .btn-primary:hover{
      color: rgb(0, 0, 0);
    }
</style>
<div class="p-5"></div>
@if (count($carts)<1)
<div class="p-5 d-flex justify-content-center" style="height: 55vh">
  <div class="text-center">
    <p class="h2 mt-5">Cart Is Empty</p>
    
    <i class="fa fa-shopping-cart p-2 " aria-hidden="true" style="font-size: 18rem;"></i>

  </div>
</div>


@else
<section class="h-100 gradient-custom">
    <div class="container py-5">
      <div class="row d-flex justify-content-center my-4">
        <div class="col-md-8">
          @php
              $ttlprice = 0;
              $deliveryCharges = 40;
              $item = 0;
          @endphp
          @foreach ($carts as $cart)
          @php
              $item++;
          @endphp     
          <div class="card mb-4">
            <div class="card-header">
              <h4 class="card-title text-truncate font-weight-bold m-0">{{ $cart["title"] }}</h4>
            </div>
            <div class="card-body">
              <!-- Single item -->
              <div class="row">
                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                  <!-- Image -->
                  <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                    <img src="{{ asset('storage/product_imgs/'.$cart["image"]) }}" class="w-100" alt="{{ $cart["image"] }}" />
                    <a href="#!">
                      <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                    </a>
                  </div>
                  <!-- Image -->
                </div>
  
                <div class="col-lg-7 col-md-6 mb-4 mb-lg-0">
                  <!-- Data -->
                  <p><strong><b>Description</b></strong></p>
                  <p>{{ $cart['description'] }}</p>
                    
                    <a href="{{ route('user.cart.destroy', $cart['id'] ) }}" class="my-3 btn btn-outline-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip"
                      title="Remove item">
                      <i class="fa fa-trash"></i>
                    </a>
                    <button type="button" class="my-3 btn btn-outline-danger btn-sm mb-2" data-mdb-toggle="tooltip"
                      title="Move to the wish list">
                      <i class="fa-solid fa-heart"></i>

                    </button>
                  
                  <!-- Data -->
                </div>

              </div>
              <!-- Single item -->
  
              <hr class="my-1" />
  
              <!-- Single item -->
              <div class="d-flex justify-content-between" >
                <div class="d-flex">
                  <button class="btn btn-outline-primary px-3 me-2 minus">
                    <i class="fa fa-minus" aria-hidden="true"></i>
                  </button>

                  <div class="form-outline">
                    <input id="form1" disabled min="0" data-cart_id="{{ $cart['id'] }}" name="quantity" value={{ $cart['order_quantity'] }} type="number" class="btn btn-lg btn-outline-primary font-weight-bold quantity" style="max-width: 100px;"/>
                  </div>

                  <button class="btn btn-outline-primary px-3 py-0 ms-2 plus" style="margin-left: -2px;">
                    <i class="fa fa-plus"></i>
                  </button>
                </div>
                <p class="h3 font-weight-bold price">${{ $cart['order_price'] }}</p>
                @php
                    $ttlprice = $ttlprice+$cart['order_price'];
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
              <form action="{{ route('user.order') }}" method="POST">
                @csrf
                <input type="hidden" class="hidden" name="user" value="{{ $carts[0]['user_id'] }}"/>
                <button type="submit" name="submit" class="btn btn-outline-danger btn-lg btn-block">
                  Place The Order
                </button>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endif