@extends('frontend::layouts.frontendMaster')

@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <style>
        .owl-carousel.nav-image-center .owl-nav button {
            top: 50% !important;
            color: #FF5722;
        }

        .count-down .product-name {
            top: 0.9rem !important;
        }

        .owl-theme .owl-nav {
            color: #0438A8 !important;
        }
    </style>
@endpush
@section('content')
 
    <section class="intro-section">
        <div class="container">
            <div class="row">
                @if(Agent::isDesktop())
                <div class="col-lg-9 mb-2">
                    <div class="home-slider slide-animate owl-carousel owl-theme custom-nav" data-owl-options="{'items': 1, 'loop': true, 'dots': false, 'autoplay': true}">
                        @foreach ($sliders as $slider)
                        <div class="home-slide home-slide-1 banner">
                            <img class="slide-bg" src="{{ route('imagecache', ['template' => 'cplg', 'filename' => $slider->fi_desktop()]) }}" alt="slider image">
                            <div class="banner-layer banner-layer-middle banner-layer-right">
                                <div class="appear-animate" data-animation-name="rotateInUpLeft">
                                </div>
                            </div>
                        </div>
                        @endforeach
                       
                    </div>
                </div>
                @else
                <div class="col-lg-9 mb-2">
                   <div class="owl-carousel owl-theme nav-inside nav-inside-edge nav-squared nav-with-transparency nav-dark"
                       data-owl-options="{'items': 1, 'loop': true, 'nav': true, 'dots': false, 'autoplay': true}">
                         @foreach ($sliders as $slider)
                        <div>
                            <div class="img-thumbnail border-0 p-0 d-block">
                                <img
                                class="img-fluid border-radius-0"
                                src="{{ route('imagecache', ['template' => 'cpsm', 'filename' => $slider->fi_mobile()]) }}"
                                alt=""
                                />
                            </div>
                        </div>
                         @endforeach
                    </div>
                </div>
                @endif

                <div class="col-lg-3 mb-2">
                    <div class="featured-products-slider owl-carousel owl-theme dot-inside dots-small" data-owl-options="{
                        'loop': true
                    }" style="border: 2px solid #FF5722">
                        <div class="product-default count-down">
                            <h3 class="product-name text-white">Deals of the week!</h3>
                            
                            <figure class="w3-deep-orange">
                                <a href="javascript:void(0)">
                                    <img src="{{asset("/frontend/assets/images/demoes/demo22/products/featured-sale.jpg")}}" width="217" height="217" alt="product">
                                </a>
                               
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
                                    <a href="">1080p Wifi IP Camera</a>
                                </h3>

                                <div class="price-box">
                                    {{-- <span class="old-price">tk. 15296.00</span> --}}
                                    <span class="product-price">tk. 15299.00</span>
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
                                <a href="javascript:void(0)">
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
                                    <a href="">HD Camera</a>
                                </h3>


                                <div class="price-box">
                                    {{-- <span class="old-price">tk. 15299.00</span> --}}
                                    <span class="product-price">tk. 15299.00</span>
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
                    }">

                 
                        @foreach($category->activeBranchProducts()  as $product)
                            @include('frontend::welcome.includes.productPart')
                        @endforeach
                        
                    
                    </div>
                </div>
            </div>
        </section>

    @endforeach 
    <br>
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
                    $(".chekoutBtn").empty().append(result.chekoutBtn);
                    console.log(result.chekoutBtn);
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
                    $(".chekoutBtn").empty().append(result.chekoutBtn);
                    console.log(result.chekoutBtn);
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