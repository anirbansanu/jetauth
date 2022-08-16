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
              <a class="nav-link">Home
                <span class="sr-only">(current)</span>
              </a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="{{ route("user.allproducts") }}">Our Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.html">About Us</a>
            </li>
            @if (Route::has('login'))
            @auth
            <li class="nav-item">
              
              <a class="nav-link" href="{{ route('user.cart') }}">
                <div class="d-flex">
                  <i class="fa fa-shopping-cart pt-1 px-2" aria-hidden="true" ></i>
                  Cart
                </div>
                
              </a>
            </li>
            @endauth
            @endif
            <li class="nav-item">
                  @if (Route::has('login'))
                          @auth
                          <div class="dropdown">
                            <a class="nav-link btn dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <img class="img-xs rounded-circle" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                                <p class="">{{ Auth::user()->name }}</p>
                                <i class="mdi mdi-menu-down "></i>
                                @else
                                {{ Auth::user()->name }}
                                <i class="mdi mdi-menu-down"></i>
                                @endif
                              
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <h6 class="p-3 mb-0"> {{ __('Manage') }}</h6>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item btn-danger" href="{{ route('profile.show') }}">
                                
                                
                                  {{ __('Profile') }}
                               
                              </a>
                              @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                                    {{ __('API Tokens') }}
                                                </x-jet-dropdown-link>
                              @endif
                              <div class="dropdown-divider"></div>
                                
                              <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                              
                                <button type="submit" class="dropdown-item btn-danger"
                                @click.prevent="$root.submit();">
                                  
                                  
                                    {{ __('Log Out') }}
                                  
                                </button>
                              </form>
                              
                            </div>
                            </div>
                          </div>
                              
                          
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