<div class="container-fluid p-1">
    <div class="mt-5 p-5"></div>
    <div class="row m-0">
        <div class="col-md-6 d-flex justify-content-center">
            <img class="img-fluid" src="{{ asset('storage/product_imgs/'.$product["image"]) }}" alt="..."/>
        </div>
        <div class="col-md-6 d-flex justify-content-center">
            <div class="card-body">
                <div class="card-body border-bottom">
                    <b><h1 class="h1 font-weight-bold"> ${{ $product['price'] }}</h1></b>
                    <h3 ><b>{{ $product['title'] }}</b></h3>
                    <div class="row m-0 d-flex justify-content-between py-3">
                        <ul class="stars d-flex text-warning">
                            <li><i class="fa fa-star "></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                        </ul>
                        <span class="text-danger">Reviews (24)</span>
                    </div>
                </div>
                <div class="card-body ">
                    <p class="font-weight-bold h5 py-1">Description</p>
                    <p class="border-bottom py-3">{{ $product['description']  }}</p>
                    <div class="card-body d-flex justify-content-between px-0">
                        <a href="" class="btn btn-lg btn-danger">Add To Cart</a>
                        <a href="" class="btn btn-lg btn-outline-danger">Buy Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>