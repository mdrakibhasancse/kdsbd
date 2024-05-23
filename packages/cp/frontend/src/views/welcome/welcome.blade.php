@extends('frontend::layouts.frontendMaster')

@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <style>
        .owl-carousel.nav-image-center .owl-nav button {
            top: 50% !important;
        }

        .count-down .product-name {
            top: 0.9rem !important;
        }
    </style>
@endpush
@section('content')
    <section class="intro-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mb-2">
                    <div class="home-slider slide-animate owl-carousel owl-theme custom-nav" data-owl-options="{
                        'loop': true
                    }">
                        @foreach ($sliders as $slider)
                        <div class="home-slide home-slide-1 banner">
                            <img class="slide-bg" src="{{ route('imagecache', ['template' => 'cplg', 'filename' => $slider->fi()]) }}" alt="slider image" width="772" height="434">
                            <div class="banner-layer banner-layer-middle banner-layer-right">
                                <div class="appear-animate" data-animation-name="rotateInUpLeft">

                                    <h2 class="font1 ls-10 text-uppercase text-right w3-text-deep-orange m-b-4">{{$slider->title}}
                                    </h2>
                                    {{-- <div class="coupon-sale-text">
                                        <h4 class="m-b-2 font1 d-block text-white bg-dark skew-box">Exclusive COUPON
                                        </h4>
                                        <h5 class="mb-0 font1 d-inline-block bg-dark skew-box"><i class="text-dark ls-0">UP
                                                TO</i><b class="text-white">$100</b><sub class="text-dark">OFF</sub>
                                        </h5>
                                    </div> --}}

                                    <a href="" class="btn btn-light btn-lg ls-10 w3-text-deep-orange">View All
                                        Now</a>
                                </div>
                            </div>
                            {{-- <div class="banner-layer banner-layer-bottom banner-layer-right">
                                <p class="ls-0 mb-0">* Only 200 Available</p>
                            </div> --}}
                        </div>
                        @endforeach
                        {{-- <div class="home-slide home-slide-2 banner">
                            <img class="slide-bg" src="{{asset("/frontend/assets/images/demoes/demo22/slider/home_slide2.jpg")}}" alt="slider image" width="772" height="434">
                            <div class="banner-layer banner-layer-middle banner-layer-left">
                                <div class="appear-animate" data-animation-name="rotateInUpLeft">
                                    <h2 class="font1 ls-10 text-uppercase m-b-4">Top Brands
                                        <br>Smartphones</h2>
                                    <div class="coupon-sale-text d-flex flex-column align-items-start">
                                        <h4 class="m-b-2 font1 d-block text-uppercase text-white bg-dark skew-box">
                                            Starting From
                                        </h4>
                                        <h5 class="mb-0 font1 d-inline-block bg-dark skew-box"><b class="text-white">$199</b>
                                        </h5>
                                    </div>

                                    <a href="demo22-shop.html" class="btn btn-light btn-lg ls-10">View All
                                        Now</a>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>

                <div class="col-lg-3 mb-2">
                    <div class="featured-products-slider owl-carousel owl-theme dot-inside dots-small" data-owl-options="{
                        'loop': true
                    }" style="border: 2px solid #FF5722">
                        <div class="product-default count-down">
                            <h3 class="product-name text-white">Deals of the week!</h3>
                            
                            <figure class="w3-deep-orange">
                                <a href="demo22-product.html">
                                    <img src="{{asset("/frontend/assets/images/demoes/demo22/products/featured-sale.jpg")}}" width="217" height="217" alt="product">
                                </a>
                                {{-- <div class="label-group">
                                    <span class="product-label label-sale">- 34%</span>
                                </div> --}}
                                <div class="product-countdown-container">
                                    <span class="product-countdown-title">offer ends in:</span>
                                    <div class="product-countdown countdown-compact" data-until="2021, 10, 5" data-compact="true">
                                    </div>
                                    <!-- End .product-countdown -->
                                </div>
                                <!-- End .product-countdown-container -->
                            </figure>
                            <div class="product-details">
                                <h3 class="product-title">
                                    <a href="demo22-product.html">1080p Wifi IP Camera</a>
                                </h3>

                                <div class="price-box">
                                    <span class="old-price">$596.00</span>
                                    <span class="product-price">$299.00</span>
                                </div>
                                <!-- End .price-box -->
                            </div>
                            <!-- End .product-details -->
                        </div>
                        <div class="product-default count-down">
                            <h3 class="product-name text-white">
                                Deals of the week!
                            </h3>
                            <figure class="w3-deep-orange">
                                <a href="demo22-product.html">
                                    <img src="{{asset("/frontend/assets/images/demoes/demo22/products/featured-sale-2.jpg")}}" width="217" height="217" alt="product">
                                </a>
                                
                                <div class="product-countdown-container">
                                    <span class="product-countdown-title">offer ends in: </span>
                                    <div class="product-countdown countdown-compact" data-until="2021, 10, 5" data-compact="true">
                                    </div>
                                    <!-- End .product-countdown -->
                                </div>
                                <!-- End .product-countdown-container -->
                            </figure>
                            <div class="product-details">
                                <h3 class="product-title">
                                    <a href="demo22-product.html">HD Camera</a>
                                </h3>


                                <div class="price-box">
                                    <span class="old-price">$299.00</span>
                                    <span class="product-price">$199.00</span>
                                </div>
                                <!-- End .price-box -->
                            </div>
                            <!-- End .product-details -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   

    {{-- <div class="container py-4">
        <div class="row">
            <div class="col-6 col-lg-2 mb-1">
              <div class="info-box w3-white w3-border w3-border-indigo w3-hover-border-green w3-round-large py-1 px-1">
                <i class="icon-shipping text-primary"></i>
                <div class="info-box-content">
                    <h4 class="font1 line-height-1 ls-10">FREE SHIPPING </h4>
                </div>
                <!-- End .info-box-content -->
               </div>
            </div>
            <!-- End .info-box -->
            <div class="col-6 col-lg-2 mb-1">
                <div class="info-box w3-white w3-border w3-border-indigo w3-hover-border-green w3-round-large py-1 px-1">
                    <i class="icon-money text-primary"></i>
                    <div class="info-box-content">
                        <h4 class="font1 line-height-1 ls-10">MONEY BACK GUARANTEE</h4>
                    </div>
                    <!-- End .info-box-content -->
                </div>
            </div>

            <div class="col-6 col-lg-2 mb-1">
                <div class="info-box w3-white w3-border w3-border-indigo w3-hover-border-green w3-round-large py-1 px-1">
                    <i class="icon-support text-primary"></i>

                    <div class="info-box-content">
                        <h4 class="font1 line-height-1 ls-10">ONLINE SUPPORT</h4>
                    </div>
                    <!-- End .info-box-content -->
                </div>
            </div>
            <!-- End .info-box -->
            <div class="col-6 col-lg-2 mb-1">
                <div class="info-box w3-white w3-border w3-border-indigo w3-hover-border-green w3-round-large py-1 px-1">
                    <i class="icon-secure-payment text-primary"></i>

                    <div class="info-box-content">
                        <h4 class="font1 line-height-1 ls-10">SECURE PAYMENT</h4>
                    </div>
                    <!-- End .info-box-content -->
                </div>
            </div>
            <!-- End .info-box -->

            <div class="col-6 col-lg-2 mb-1">
                <div class="info-box w3-white w3-border w3-border-indigo w3-hover-border-green w3-round-large py-1 px-1">
                    <i class="icon-secure-payment text-primary"></i>

                    <div class="info-box-content">
                        <h4 class="font1 line-height-1 ls-10">SECURE PAYMENT</h4>
                    </div>
                    <!-- End .info-box-content -->
                </div>
            </div>
            <!-- End .info-box -->

            <div class="col-6 col-lg-2 mb-1">
                <div class="info-box w3-white w3-border w3-border-indigo w3-hover-border-green w3-round-large py-1 px-1">
                    <i class="icon-secure-payment text-primary"></i>

                    <div class="info-box-content">
                        <h4 class="font1 line-height-1 ls-10">SECURE PAYMENT</h4>
                    </div>
                    <!-- End .info-box-content -->
                </div>
            </div>
            <!-- End .info-box -->

            
        </div>
    </div> --}}

    

    @foreach ($categories as $category)
        <section class="most-viewed-products appear-animate py-4" data-animation-name="fadeInUpShorter" data-animation-delay="200">
            <div class="container">
                <h2 class="section-title ls-n-10 pb-3 m-b-4 w3-xlarge">{{$category->name_en}}
                <a href="{{ route('category',$category->slug)}}" class="float-right w3-large w3-text-indigo">See All</a>
                </h2>
       
                <div class="row">
                    <div class="products-slider 5col owl-carousel owl-theme owl-nav-outisde show-nav-hover nav-image-center custom-nav" data-owl-options="{
                        'margin': 0,
                        'nav': true
                        {{-- 'loop': true --}}
                    }">

                    {{-- @dd($category->activeProducts()); --}}
                    @foreach($category->activeBranchProducts()  as $product)
                        {{-- @dd($product); --}}
                        @include('frontend::welcome.includes.productPart')
                    @endforeach
                        
                    {{--                  
                        <div class="product-default bg-white w3-border w3-hover-border-green mx-2 py-4">
                            <figure>
                                <a href="product.html">
                                    <img src="img/rocket.png" width="180" height="180" alt="product">
                                    <img src="img/rocket.png" width="180" height="180" alt="product">
                                </a>

                                <div class="label-group">
                                    <div class="product-label label-hot">HOT</div>
                                </div>
                            </figure>

                            <div class="product-details">
                            

                                <h3 class="product-title"> <a href="product.html">Casual Spring Blue Shoes</a> </h3>
                                <span class="" >
                                2pc
                                </span>
                            
                                <div class="price-box">
                                    <span class="old-price">$90.00</span>
                                    <span class="product-price">$70.00</span>
                                </div><!-- End .price-box -->

                                <div class="product-action">
                                    
                                    <a href="#" class="btn-icon btn-add-cart product-type-simple"><i class="icon-shopping-cart"></i><span>ADD TO CART</span></a>
                                
                                </div>
                            </div><!-- End .product-details -->
                        </div>
                    
                        <div class="product-default bg-white w3-border w3-hover-border-green mx-2 py-4">
                            <figure>
                                <a href="product.html">
                                    <img src="img/rocket.png" width="180" height="180" alt="product">
                                    <img src="img/rocket.png" width="180" height="180" alt="product">
                                </a>

                                <div class="label-group">
                                    <div class="product-label label-hot">HOT</div>
                                </div>
                            </figure>

                            <div class="product-details">

                                <h3 class="product-title"> <a href="product.html">Casual Spring Blue Shoes</a> </h3>
                                <span class="" >
                                2pc
                                </span>
                                <div class="price-box">
                                    <span class="old-price">$90.00</span>
                                    <span class="product-price">$70.00</span>
                                </div><!-- End .price-box -->

                                <div class="product-action">
                                    <a href="wishlist.html" class="btn-icon-wish" title="wishlist"><i class="icon-heart"></i></a>
                                    <a href="#" class="btn-icon btn-add-cart product-type-simple"><i class="icon-shopping-cart"></i><span>ADD TO CART</span></a>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                                </div>
                            </div><!-- End .product-details -->
                        </div>
                        
                        <div class="product-default bg-white w3-border w3-hover-border-green mx-2 py-4">
                            <figure>
                                <a href="product.html">
                                    <img src="img/rocket.png" width="180" height="180" alt="product">
                                    <img src="img/rocket.png" width="180" height="180" alt="product">
                                </a>

                                <div class="label-group">
                                    <div class="product-label label-hot">HOT</div>
                                </div>
                            </figure>

                            <div class="product-details">

                                <h3 class="product-title"> <a href="product.html">Casual Spring Blue Shoes</a> </h3>
                                <span class="" >
                                2pc
                                </span>

                                <div class="price-box">
                                    <span class="old-price">$90.00</span>
                                    <span class="product-price">$70.00</span>
                                </div><!-- End .price-box -->

                                <div class="product-action">
                                    <a href="wishlist.html" class="btn-icon-wish" title="wishlist"><i class="icon-heart"></i></a>
                                    <a href="#" class="btn-icon btn-add-cart product-type-simple"><i class="icon-shopping-cart"></i><span>ADD TO CART</span></a>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                                </div>
                            </div><!-- End .product-details -->
                        </div>

                        <div class="product-default bg-white w3-border w3-hover-border-green mx-2 py-4">
                            <figure>
                                <a href="product.html">
                                    <img src="img/rocket.png" width="180" height="180" alt="product">
                                    <img src="img/rocket.png" width="180" height="180" alt="product">
                                </a>

                                <div class="label-group">
                                    <div class="product-label label-hot">HOT</div>
                                </div>
                            </figure>

                            <div class="product-details">

                                <h3 class="product-title"> <a href="product.html">Casual Spring Blue Shoes</a> </h3>
                                <span class="" >
                                2pc
                                </span>
                                <div class="price-box">
                                    <span class="old-price">$90.00</span>
                                    <span class="product-price">$70.00</span>
                                </div><!-- End .price-box -->

                                <div class="product-action">
                                    <a href="wishlist.html" class="btn-icon-wish" title="wishlist"><i class="icon-heart"></i></a>
                                    <a href="#" class="btn-icon btn-add-cart product-type-simple"><i class="icon-shopping-cart"></i><span>ADD TO CART</span></a>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                                </div>
                            </div><!-- End .product-details -->
                        </div>

                        <div class="product-default bg-white w3-border w3-hover-border-green mx-2 py-4">
                            <figure>
                                <a href="product.html">
                                    <img src="img/rocket.png" width="180" height="180" alt="product">
                                    <img src="img/rocket.png" width="180" height="180" alt="product">
                                </a>

                                <div class="label-group">
                                    <div class="product-label label-hot">HOT</div>
                                </div>
                            </figure>

                            <div class="product-details">

                                <h3 class="product-title"> <a href="product.html">Casual Spring Blue Shoes</a> </h3>
                                <span class="" >
                                2pc
                                </span>
                                <div class="price-box">
                                    <span class="old-price">$90.00</span>
                                    <span class="product-price">$70.00</span>
                                </div><!-- End .price-box -->

                                <div class="product-action">
                                    <a href="wishlist.html" class="btn-icon-wish" title="wishlist"><i class="icon-heart"></i></a>
                                    <a href="#" class="btn-icon btn-add-cart product-type-simple"><i class="icon-shopping-cart"></i><span>ADD TO CART</span></a>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                                </div>
                            </div><!-- End .product-details -->
                        </div>

                    --}}
                    
                    </div>
                </div>
            </div>
        </section>

    @endforeach
    <br>


    


    {{-- <section class="brands-section pt-5">
        <div class="container pb-3">
            <h2 class="section-title line-height-1 ls-10 pb-4 mb-5 appear-animate" data-animation-name="fadeInUpShorter" data-animation-delay="200" data-animation-duration="400">
                Top Brands
            </h2>
            <div class="brands-slider owl-carousel owl-theme images-center appear-animate" data-animation-name="fadeIn" data-animation-delay="400" data-owl-options="{
                'margin': 30,
                'responsive': {
                    '991': {
                        'items': 4
                    },
                    '1200': {
                        'items': 5
                    }
                }
            }">
                <img src="{{asset("/frontend/assets/images/demoes/demo22/brands/brand1.png")}}" width="200" height="50" alt="brand">
                <img src="{{asset("/frontend/assets/images/demoes/demo22/brands/brand2.png")}}" width="200" height="50" alt="brand">
                <img src="{{asset("/frontend/assets/images/demoes/demo22/brands/brand3.png")}}" width="200" height="50" alt="brand">
                <img src="{{asset("/frontend/assets/images/demoes/demo22/brands/brand4.png")}}" width="200" height="50" alt="brand">
                <img src="{{asset("/frontend/assets/images/demoes/demo22/brands/brand5.png")}}" width="200" height="50" alt="brand">
            </div>
            <!-- End .brands-slider -->
        </div>
    </section> --}}



@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $( document ).ready(function() {


        $(document).on('change', '.areaChange', function(e) {
            e.preventDefault();
            var that = $( this );
            var url  = that.attr('data-url');
            var id   = that.val()

            $.ajax({
                url : url,
                method : "get",
                data   : {id : id},
                success: function(result){
                    $('.areaLocation').empty().append(result.view);
                    location.reload();

                },error:function(){
                
                }
            });

        });

        $(document).on("click",".addToCart",function() {
            var that = $( this );
            var url  = that.attr('data-url');
            var val = $('.product_qty').val();
            $.ajax({
                url    : url,
                method : "post",
                data   : { qty: val },
                success: function(result){
                    $(".headerCart").empty().append(result.view);
                    that.closest('.product-details').find(".productCartItem").empty().append(result.productCartItem);
                    $(".totalCartAmount").html(result.totalCartAmount);
                    $(".totalCartItems").html(result.totalCartItems);

                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "success",
                        title: result.message
                    });

                },error:function(){
                    alert("Error");
                }
            });
        });


        $(document).on("click",".updateCartItem",function() {
            var that = $( this );
            var url  = that.attr('data-url');
            if(that.hasClass('plus')){
                var cart_qty  = that.attr('data-qty');
                new_qty = parseInt(cart_qty) + 1;
            }
            if(that.hasClass('minus')){
                var cart_qty  = that.attr('data-qty');
                // if(cart_qty <=1 ){
                //     return false;
                // }
                new_qty = parseInt(cart_qty) - 1;
            }
            
            $.ajax({
                url    : url,
                method : "post",
                data   : { new_qty : new_qty},
                success: function(result){
                    $(".headerCart").empty().append(result.view);
                    $(".checkoutItems").empty().append(result.checkoutItems);
                    that.closest('.product-details').find(".productCartItem").empty().append(result.productCartItem);
                    $(".totalCartAmount").html(result.totalCartAmount);
                    $(".totalCartItems").html(result.totalCartItems);

                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "success",
                        title: result.message
                    });
                },error:function(){
                    alert("Error");
                }
            });
        });

    });
</script>
@endpush