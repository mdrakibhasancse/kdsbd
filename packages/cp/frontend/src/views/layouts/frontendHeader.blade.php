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
                                <input type="search" class="form-control search" data-url="{{ route('search') }}" name="q" id="q" value="{{ request()->q }}" placeholder="I'm searching for..." required>
                                <!-- End .select-custom -->
                                <button class="btn icon-magnifier" title="search" type="submit"></button>
                            </div>
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
                        <div class="header-menu">
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

                {{-- <a href="wishlist.html" class="header-icon d-md-block d-none">
                    <i class="icon-wishlist-2"></i>
                </a> --}}


               	<div class="dropdown cart-dropdown">
                    <a href="javascript:void(0)" title="Cart" class="dropdown-toggle cart-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
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

                            <div class="dropdown-cart-total mb-0">
                                <span class="">SUBTOTAL:</span>
                                <span class="cart-total-price float-right totalCartAmount">{{number_format(totalCartAmount(), 2)}} tk</span>
                            </div>
                            <!-- End .dropdown-cart-total -->


                            

                            <div class="chekoutBtn">
                                @include('frontend::layouts.inc.chekoutBtn')
                            </div>

                             <div class="">
                               <a class="btn w3-light-gray rounded my-3 py-1 text-center d-block w3-small">
                                    <strong>
                                    <span>Delivery in 100 min</span>
                                    </strong>
                                </a>

                                <a class="btn w3-light-gray rounded my-3 py-1 text-center d-block w3-small">
                                    <strong>
                                    <span>Delivery time 9am to 6pm</span>
                                    </strong>
                                </a>

                                <a href="tel:{{ $ws->contact_mobile }}" class="btn rounded my-1 py-1 text-center d-block text-white w3-deep-orange w3-small">
                                Call For Order
                                <i class="icon-phone-2"></i>&nbsp;{{ $ws->contact_mobile }}</a>
                            </div>
                            <!-- End .dropdown-cart-total -->
                        </div>
                        <!-- End .dropdownmenu-wrapper -->
                    </div>
                    <!-- End .dropdown-menu -->
                </div>

            </div>
        </div>
    </div>

    <div class="header-bottom sticky-header" data-sticky-options="{'mobile': false, 'offset': 684}">

        <div class="container">
            <div class="header-center">
                <button class="mobile-menu-toggler" type="button">
                    <i class="fas fa-bars"></i>
                </button>

                <nav class="main-nav d-none d-lg-flex flex-wrap navCategories">
                    @include('frontend::layouts.inc.navCategories')
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

            {{-- <div class="header-dropdowns ml-auto">
                     
                <div class="header-dropdown">
                    <a href="#"></i>ENG</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#">ENG</a></li>
                            <li><a href="#">FRA</a></li>
                        </ul>
                    </div>
                    <!-- End .header-menu -->
                </div>
            </div> --}}
     

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

                            <div class="dropdown-cart-total mb-0">
                                <span>SUBTOTAL:</span>
                                <span class="cart-total-price float-right totalCartAmount">{{number_format(totalCartAmount(), 2)}} tk</span>
                            </div>

                            

                          
                            <!-- End .dropdown-cart-total -->

                            <div class="chekoutBtn">
                                @include('frontend::layouts.inc.chekoutBtn')
                            </div>

                            <div class="">
                               <a class="btn w3-light-gray rounded my-3 py-1 text-center d-block w3-small">
                                    <strong>
                                    <span>Delivery in 100 min</span>
                                    </strong>
                                </a>

                                <a class="btn w3-light-gray rounded my-3 py-1 text-center d-block w3-small">
                                    <strong>
                                    <span>Delivery time 9am to 6pm</span>
                                    </strong>
                                </a>

                                <a href="tel:{{ $ws->contact_mobile }}" class="btn rounded my-1 py-1 text-center d-block text-white w3-deep-orange w3-small">
                                Call For Order
                                <i class="icon-phone-2"></i>&nbsp;{{ $ws->contact_mobile }}</a>
                            </div>
                            
                           
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

