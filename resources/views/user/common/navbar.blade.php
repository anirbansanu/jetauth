<!-- Header -->
<header class="">
    <nav class="navbar navbar-expand-lg">
      <div class="container px-lg-2 px-sm-1 px-xl-0">
        <a class="navbar-brand" href="index.html"><h2>LOUT <em>Shopping</em></h2></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.html">Home
                <span class="sr-only">(current)</span>
              </a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="{{ route("user.allproducts") }}">Our Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.html">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact Us</a>
            </li>
            <li class="nav-item">
                  @if (Route::has('login'))
                          @auth
                          
                              <x-app-layout></x-app-layout>
                          
                          @else
                          <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Log in</a></li>

                              @if (Route::has('register'))
                              <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                              @endif
                          @endauth
                  @endif
            </li>
          </ul>
        </div>
      </div>
    </nav>
</header>