<header class="header">
    <div class="header-middle sticky-header py-2" data-sticky-options="{'mobile': true}" style="background: #0438A8 !important">
        <div class="container">
            <div class="header-left">
                <a href="{{url('/')}}" class="logo">
                   <img class="p-0 m-0" src="{{ route('imagecache', ['template' => 'lh', 'filename' => $ws->logo()]) }}" alt="kdsbd">
                </a>
                <div class="header-col">
                    <div class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mt-0">
                        <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
                        <form action="#" method="get">
                            <div class="header-search-wrapper">
                                <input type="search" class="form-control" name="q" id="q" placeholder="I'm searching for..." required>
                                <!-- End .select-custom -->
                                <button class="btn icon-magnifier" title="search" type="submit"></button>
                            </div>
                            <!-- End .header-search-wrapper -->
                        </form>
                    </div>
                   
                </div>
            </div>

            <div class="header-right ml-0 ml-lg-auto">
               
                <div class="header-user">
                  <i class="icon-user-2 d-md-block d-none"></i>
                    @if(Auth::check())
                        <div class="header-dropdown">
                        <a class="header-icon d-md-block d-none mr-0 w3-medium text-white">My Account
                        <div class="header-menu px-1">
                            <ul>
                                <li><a href="{{route('user.dashboard')}}" class="w3-small">My Dashboard</a></li>

                                @if(Auth::user()->hasRole('admin'))
                                <li><a href="{{ route('admin.dashboard')}}" class="w3-small">Admin Dashboard</a></li>
                                @endif

                                <li><a href="javascript:void" class="w3-small"  onclick="$('#logout-form').submit();">Logout</a></li>

                            
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            
                            </ul>
                        </div>
                        
                        </a>
                    
                        </div>

                         @else

                         <a  class="header-icon d-md-block d-none mr-0 w3-large text-white" data-target="#modal_register"  data-toggle="modal" >
                            Sign in
                        </a>

                    @endif
                </div>

                {{-- <a href="wishlist.html" class="header-icon">
                    <i class="icon-wishlist-2"></i>
                </a> --}}

                <div class="dropdown cart-dropdown">
                    <a href="#" title="Cart" class="dropdown-toggle cart-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <i class="minicart-icon"></i>
                         <span class="cart-count w3-deep-orange badge-circle totalCartItems">{{totalCartItems()}}</span>
                    </a>

                    <div class="cart-overlay"></div>

                    <div class="dropdown-menu mobile-cart">
                        <a href="#" title="Close (Esc)" class="btn-close">×</a>

                        <div class="dropdownmenu-wrapper custom-scrollbar">
                            <div class="dropdown-cart-header">Shopping Cart</div>
                            <!-- End .dropdown-cart-header -->

                            <div class="dropdown-cart-products headerCart">
                                @include('frontend::layouts.inc.headerCart')
                            </div>
                            <!-- End .cart-product -->

                            <div class="dropdown-cart-total">
                                <span>SUBTOTAL:</span>

                                 <span class="cart-total-price float-right totalCartAmount">{{number_format(totalCartAmount(), 2)}} tk</span>
                            </div>
                            <!-- End .dropdown-cart-total -->

                            @if(Auth::check())
                            <div class="dropdown-cart-action">
                                <a href="{{route('checkout')}}" class="btn w3-indigo btn-block">Checkout</a>
                            </div>
                            @else
                               <div class="dropdown-cart-action">
                                <a href="{{ route('registerModal', ['register-modal-open']) }}" class="btn w3-indigo btn-block register-modal-lg">Checkout</a>
                               </div>
                            @endif
                            <!-- End .dropdown-cart-total -->
                        </div>
                        <!-- End .dropdownmenu-wrapper -->
                    </div>
                    <!-- End .dropdown-menu -->
                </div>
                <!-- End .dropdown -->
            </div>
        </div>
    </div>

    <div class="header-bottom sticky-header" data-sticky-options="{'mobile': false, 'offset': 684}">
        {{-- <div class="container">
            <div class="header-center">
                <button class="mobile-menu-toggler" type="button">
                    <i class="fas fa-bars"></i>
                </button>

                <nav class="main-nav d-none d-lg-flex flex-wrap">
                    <div class="menu-depart">
                        <a href="#" class="toggle"><i class="fas fa-bars"></i>Shop by Category
                        </a>

                        <div class="submenu">
                            <a href="demo22-shop.html" class="active"><i class="icon-category-home"></i>Home</a>

                            @foreach ($categories as $category)
                                <a href="{{route("category",$category->slug)}}" class="d-flex">
                                    <img class="w3-round" src="{{ route('imagecache', ['template' => 'ppxxs', 'filename' => $category->fi()]) }}" alt="">
                                    &nbsp;&nbsp;&nbsp;
                                    <span>{{$category->name_en}}</span>
                                </a>
                            @endforeach
                           
                        </div>
                    </div>
                </nav>

                <ul class="menu">
                    <li class="">
                      <a href="demo22.html" class="font-weight-bold">Offer</a>
                    </li>
                        
                     <li><a href="blog.html"  class="font-weight-bold">Track Order</a></li>
                </ul>
                
                <div class="header-dropdowns ml-auto">
                   
                </div>
            </div>
        </div> --}}

        <div class="container">
            <div class="header-center">
                <button class="mobile-menu-toggler" type="button">
                    <i class="fas fa-bars"></i>
                </button>

                <nav class="main-nav d-none d-lg-flex flex-wrap">
                    <div class="menu-depart">
                        <a href="#" class="toggle" style="background-color:#FF5722;"><i class="fas fa-bars"></i>Shop by Category</a>
                        <div class="submenu">
                            <a href="{{url('/')}}" class=""><i class="icon-category-home"></i>Home</a>
                            @foreach ($cats as $cat)
                                <a href="{{route("category",$cat->slug)}}" class="d-flex" style="color:inherit">
                                    <img class="w3-round" src="{{ route('imagecache', ['template' => 'ppxxs', 'filename' => $cat->fi()]) }}" alt="">
                                    &nbsp;&nbsp;&nbsp;
                                    <span class="text-dark">{{$cat->name_en}}</span>
                                </a>
                            @endforeach
                            <a href="{{ route('categoriesAll')}}">VIEW ALL <i class="icon-angle-right"></i></a>
                        
                        </div>
                    </div>
                
                </nav>

                <ul class="menu">
                    @if(request()->cookie('area_name'))
                    <li class="">
                        <a href="{{route('offerProducts')}}" class="font-weight-bold">Offers 
                            &nbsp;<span class="w3-deep-orange w3-round px-3 py-1">{{branchWiseOfferProducts()}}</span>
                        </a>
                    </li>
                    @endif
                        
                    <li><a href="javascript:void(0)"  class="font-weight-bold">Track Order</a></li>
                </ul>
            </div>

          
     

            <div class="header-right w-lg-max ml-0 ml-lg-auto">
                
                <!-- End .header-contact -->

                @if(Auth::check())
                <a href="{{route('user.dashboard')}}" title="My Account" class="header-icon login-link- pl-1">
                    <i class="icon-user-2"></i>
                </a>

                @else
                <a href="{{route('login')}}" class="header-icon login-link pl-1">
                    <i class="icon-user-2"></i>
                </a>
                @endif

                {{-- <a href="#" class="header-icon btn-wishlist pl-1 pr-1">
                    <i class="icon-wishlist-2"></i>
                </a> --}}

                <div class="dropdown cart-dropdown">
                    <a href="javascript:void(0)" title="Cart" class="dropdown-toggle cart-toggle w3-dark" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <i class="minicart-icon" style="border-color: black"></i>
                        <span class="cart-count w3-deep-orange badge-circle totalCartItems">{{totalCartItems()}}</span>
                    </a>

                    <div class="cart-overlay"></div>

                    <div class="dropdown-menu mobile-cart">
                        <a href="#" title="Close (Esc)" class="btn-close">×</a>

                        <div class="dropdownmenu-wrapper custom-scrollbar">
                            <div class="dropdown-cart-header">Shopping Cart</div>
                            <!-- End .dropdown-cart-header -->

                            <div class="dropdown-cart-products headerCart">
								@include('frontend::layouts.inc.headerCart')
							</div>
                            <!-- End .cart-product -->

                            <div class="dropdown-cart-total">
                                <span>SUBTOTAL:</span>

                                <span class="cart-total-price float-right totalCartAmount">{{number_format(totalCartAmount(), 2)}} tk</span>
                            </div>
                            <!-- End .dropdown-cart-total -->
                            @if(Auth::check())
                            <div class="dropdown-cart-action">
                               	<a href="{{route('checkout')}}" class="btn btn-dark btn-block">Checkout</a>
                            </div>
                             @else
                               <div class="dropdown-cart-action">
                                {{-- <a href="{{ route('registerModal', ['register-modal-open']) }}" class="btn btn-dark btn-block register-modal-lg">Checkout</a> --}}
                                <a  class="btn w3-indigo btn-block" data-target="#modal_register"  data-toggle="modal" >
                                    Checkout
                                </a>
                               </div>
                            @endif
                            <!-- End .dropdown-cart-total -->
                        </div>
                        <!-- End .dropdownmenu-wrapper -->
                    </div>
                    <!-- End .dropdown-menu -->
                </div>
                <!-- End .dropdown -->
            </div>
					<!-- End .header-right -->
		</div>
    </div>
</header>
<!-- End .header -->