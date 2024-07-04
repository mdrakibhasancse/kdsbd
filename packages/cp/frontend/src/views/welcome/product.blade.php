@extends('frontend::layouts.pageMaster')

@push('css')
  
<style>
   .addToCatdesignBtn{
      height: 42px !important;
      line-height: 35px;
   }

   .updateCartItem{
         height: 42px !important;
         line-height: 35px;
   }
</style>
@endpush

@section('content')

 	 <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item w3-large"><a href="{{url('/')}}"><i class="icon-home"></i></a></li>
                <li  class="breadcrumb-item w3-large" aria-current="page">{{$product->name_en}}</li>
            </ol>
        </div>
    </nav>

    <div class="container">
        <div class="product-single-container product-single-default">
            <div class="cart-message d-none">
                <strong class="single-cart-notice">“A white Chiar”</strong>
                <span>has been added to your cart.</span>
            </div>

            <div class="row">
                <div class="col-lg-5 col-md-6 product-single-gallery">
                    <div class="product-slider-container">
                        <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                            <div class="product-item">
                                <img class="product-single-image"
                                    src="{{ route('imagecache', [ 'template'=>'original','filename' => $product->fi() ]) }}"
                                    data-zoom-image="{{ route('imagecache', [ 'template'=>'original','filename' => $product->fi() ]) }}"
                                    width="468" height="468" alt="product" />
                            </div>
                            {{-- <div class="product-item">
                                <img class="product-single-image"
                                    src="{{ route('imagecache', [ 'template'=>'original','filename' => $product->fi() ]) }}"
                                    data-zoom-image="{{ route('imagecache', [ 'template'=>'original','filename' => $product->fi() ]) }}"
                                    width="468" height="468" alt="product" />
                            </div>
                            <div class="product-item">
                                <img class="product-single-image"
                                    src="{{ route('imagecache', [ 'template'=>'original','filename' => $product->fi() ]) }}"
                                    data-zoom-image="{{ route('imagecache', [ 'template'=>'original','filename' => $product->fi() ]) }}"
                                    width="468" height="468" alt="product" />
                            </div> --}}
                        </div>
                        <!-- End .product-single-carousel -->
                        <span class="prod-full-screen">
                            <i class="icon-plus"></i>
                        </span>
                    </div>

                    {{-- <div class="prod-thumbnail owl-dots">
                        <div class="owl-dot">
                            <img src="{{ route('imagecache', [ 'template'=>'original','filename' => $product->fi() ]) }}" width="110"
                                height="110" alt="product-thumbnail" />
                        </div>
                        <div class="owl-dot">
                            <img src="{{ route('imagecache', [ 'template'=>'original','filename' => $product->fi() ]) }}" width="110"
                                height="110" alt="product-thumbnail" />
                        </div>
                        <div class="owl-dot">
                            <img src="{{ route('imagecache', [ 'template'=>'original','filename' => $product->fi() ]) }}" width="110"
                                height="110" alt="product-thumbnail" />
                        </div>
                    </div> --}}
                </div><!-- End .product-single-gallery -->

                <div class="col-lg-7 col-md-6 product-details">
                    <h1 class="product-title w3-xlarge">{{$product->name_en}}</h1>

                    <div class="price-box">
                        <span class="product-price">Tk. {{ $product->final_price }}</span>
                    </div><!-- End .price-box -->

                    {{-- <div class="product-desc">
                        <p>
                            {!! $product->description_en !!}
                        </p>
                    </div><!-- End .product-desc --> --}}

                    <ul class="single-info-list">

                        <li>
                            Unit: <strong>{{$product->unit}}</strong>
                        </li>
                    </ul>


                    <div class="product-action">
                        <div class="price-box">
                        @if($product->discount > 0.00)
                        <span class="old-price">Tk. {{$product->price}}</span>
                        @endif
                        <span class="product-price">Tk. {{ $product->final_price }}</span>
                    </div><!-- End .price-box -->

                       
                    <div class="productCartItem" style="height:50px;">
                        @include('frontend::welcome.includes.productCartItem')
                    </div>

                       
                    </div><!-- End .product-action -->


                    {{-- <div class="product-single-share mb-3">
                        <label class="sr-only">Share:</label>

                        <div class="social-icons mr-2">
                            <a href="#" class="social-icon social-facebook icon-facebook" target="_blank"
                                title="Facebook"></a>
                            <a href="#" class="social-icon social-twitter icon-twitter" target="_blank"
                                title="Twitter"></a>
                            <a href="#" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank"
                                title="Linkedin"></a>
                            <a href="#" class="social-icon social-gplus fab fa-google-plus-g" target="_blank"
                                title="Google +"></a>
                            <a href="#" class="social-icon social-mail icon-mail-alt" target="_blank"
                                title="Mail"></a>
                        </div><!-- End .social-icons -->

                        <a href="wishlist.html" class="btn-icon-wish add-wishlist" title="Add to Wishlist"><i
                                class="icon-wishlist-2"></i><span>Add to
                                Wishlist</span></a>
                    </div> --}}
                    <!-- End .product single-share -->
                </div><!-- End .product-single-details -->
            </div><!-- End .row -->
        </div><!-- End .product-single-container -->

        <div class="product-single-tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="product-tab-desc" data-toggle="tab"
                        href="#product-desc-content" role="tab" aria-controls="product-desc-content"
                        aria-selected="true">Description</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel"
                    aria-labelledby="product-tab-desc">
                    <div class="product-desc-content">
                        <p>
                            {!! $product->description_en !!}
                        <p>
                       
                    </div><!-- End .product-desc-content -->
                </div><!-- End .tab-pane -->
            </div><!-- End .tab-content -->
        </div><!-- End .product-single-tabs -->

        {{-- <div class="products-section pt-0 pb-5">
            <h2 class="section-title font1 m-b-4">Related products</h2>

            <div class="row">
                <div class="products-slider 5col owl-carousel owl-theme dots-top dots-small" data-owl-options="{
                    'margin': 0,
                    'dots': true
                }">
                    <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="demo22-product.html">
                                <img src="assets/images/demoes/demo22/products/product-5.jpg" width="217"
                                    height="217" alt="product">
                            </a>
                            <div class="label-group">
                                <div class="product-label label-hot">HOT</div>
                            </div>
                            <div class="btn-icon-group">
                                <a href="#" title="Add To Cart"
                                    class="btn-icon btn-add-cart product-type-simple"><i
                                        class="icon-shopping-cart"></i></a>
                            </div>
                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                title="Quick View">Quick
                                View</a>
                        </figure>
                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a href="demo22-shop.html" class="product-category">category</a>
                                </div>
                                <a href="wishlist.html" title="Add to Wishlist" class="btn-icon-wish"><i
                                        class="icon-heart"></i></a>
                            </div>
                            <h3 class="product-title">
                                <a href="demo22-product.html">Battery Charger</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:0%"></span><!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div><!-- End .product-ratings -->
                            </div><!-- End .product-container -->
                            <div class="price-box">
                                <span class="product-price">$299.00</span>
                            </div><!-- End .price-box -->
                        </div><!-- End .product-details -->
                    </div>
                    <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="demo22-product.html">
                                <img src="assets/images/demoes/demo22/products/product-3.jpg" width="217"
                                    height="217" alt="product">
                            </a>
                            <div class="label-group">
                                <div class="product-label label-hot">HOT</div>
                            </div>
                            <div class="btn-icon-group">
                                <a href="demo22-product.html" class="btn-icon btn-add-cart"><i
                                        class="fa fa-arrow-right"></i></a>
                            </div>
                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                title="Quick View">Quick
                                View</a>
                        </figure>
                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a href="demo22-shop.html" class="product-category">category</a>
                                </div>
                                <a href="wishlist.html" title="Add to Wishlist" class="btn-icon-wish"><i
                                        class="icon-heart"></i></a>
                            </div>
                            <h3 class="product-title">
                                <a href="demo22-product.html">Porto Extended Camera</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:0%"></span><!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div><!-- End .product-ratings -->
                            </div><!-- End .product-container -->
                            <div class="price-box">
                                <span class="product-price">$599.00</span>
                            </div><!-- End .price-box -->
                        </div><!-- End .product-details -->
                    </div>
                    <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="demo22-product.html">
                                <img src="assets/images/demoes/demo22/products/product-9.jpg" width="217"
                                    height="217" alt="product">
                            </a>
                            <div class="label-group">
                                <div class="product-label label-sale">-17%</div>
                            </div>
                            <div class="btn-icon-group">
                                <a href="#" title="Add To Cart"
                                    class="btn-icon btn-add-cart product-type-simple"><i
                                        class="icon-shopping-cart"></i></a>
                            </div>
                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                title="Quick View">Quick
                                View</a>
                        </figure>
                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a href="demo22-shop.html" class="product-category">category</a>
                                </div>
                                <a href="wishlist.html" title="Add to Wishlist" class="btn-icon-wish"><i
                                        class="icon-heart"></i></a>
                            </div>
                            <h3 class="product-title">
                                <a href="demo22-product.html">Laptop Case Bag</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:90%"></span><!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div><!-- End .product-ratings -->
                            </div><!-- End .product-container -->
                            <div class="price-box">
                                <span class="old-price">$1,999.00</span>
                                <span class="product-price">$1,699.00</span>
                            </div><!-- End .price-box -->
                        </div><!-- End .product-details -->
                    </div>
                    <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="demo22-product.html">
                                <img src="assets/images/demoes/demo22/products/product-2.jpg" width="217"
                                    height="217" alt="product">
                            </a>
                            <div class="label-group">
                                <div class="product-label label-hot">HOT</div>
                            </div>
                            <div class="btn-icon-group">
                                <a href="demo22-product.html" class="btn-icon btn-add-cart"><i
                                        class="fa fa-arrow-right"></i></a>
                            </div>
                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                title="Quick View">Quick
                                View</a>
                        </figure>
                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a href="demo22-shop.html" class="product-category">category</a>
                                </div>
                                <a href="wishlist.html" title="Add to Wishlist" class="btn-icon-wish"><i
                                        class="icon-heart"></i></a>
                            </div>
                            <h3 class="product-title">
                                <a href="demo22-product.html">Digital Camera 16x</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span><!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div><!-- End .product-ratings -->
                            </div><!-- End .product-container -->
                            <div class="price-box">
                                <span class="product-price">$101.00 &ndash; $111.00</span>
                            </div><!-- End .price-box -->
                        </div><!-- End .product-details -->
                    </div>
                    <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="demo22-product.html">
                                <img src="assets/images/demoes/demo22/products/product-8.jpg" width="217"
                                    height="217" alt="product">
                                <img src="assets/images/demoes/demo22/products/product-8-2.jpg" width="217"
                                    height="217" alt="product">
                            </a>
                            <div class="btn-icon-group">
                                <a href="#" title="Add To Cart"
                                    class="btn-icon btn-add-cart product-type-simple"><i
                                        class="icon-shopping-cart"></i></a>
                            </div>
                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                title="Quick View">Quick
                                View</a>
                        </figure>
                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a href="demo22-shop.html" class="product-category">category</a>
                                </div>
                                <a href="wishlist.html" title="Add to Wishlist" class="btn-icon-wish"><i
                                        class="icon-heart"></i></a>
                            </div>
                            <h3 class="product-title">
                                <a href="demo22-product.html">Black Shoes</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span><!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div><!-- End .product-ratings -->
                            </div><!-- End .product-container -->
                            <div class="price-box">
                                <span class="product-price">$101.00 &ndash; $111.00</span>
                            </div><!-- End .price-box -->
                        </div><!-- End .product-details -->
                    </div>
                    <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="demo22-product.html">
                                <img src="assets/images/demoes/demo22/products/product-22.jpg" width="217"
                                    height="217" alt="product">
                            </a>
                            <div class="label-group">
                                <div class="product-label label-sale">-33%</div>
                            </div>
                            <div class="btn-icon-group">
                                <a href="#" title="Add To Cart"
                                    class="btn-icon btn-add-cart product-type-simple"><i
                                        class="icon-shopping-cart"></i></a>
                            </div>
                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                title="Quick View">Quick
                                View</a>
                            <div class="product-countdown-container">
                                <span class="product-countdown-title">offer ends in: </span>
                                <div class="product-countdown countdown-compact" data-until="2021, 10, 5"
                                    data-compact="true">
                                </div><!-- End .product-countdown -->
                            </div><!-- End .product-countdown-container -->
                        </figure>
                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a href="demo22-shop.html" class="product-category">category</a>
                                </div>
                                <a href="wishlist.html" title="Add to Wishlist" class="btn-icon-wish"><i
                                        class="icon-heart"></i></a>
                            </div>
                            <h3 class="product-title">
                                <a href="demo22-product.html">HD Camera</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span><!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div><!-- End .product-ratings -->
                            </div><!-- End .product-container -->
                            <div class="price-box">
                                <span class="old-price">$299.00</span>
                                <span class="product-price">$199.00</span>
                            </div><!-- End .price-box -->
                        </div><!-- End .product-details -->
                    </div>
                </div><!-- End .products-slider -->
            </div>
        </div><!-- End .products-section --> --}}

    

    </div><!-- End .container -->
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
                    that.closest('.product-details').find(".productCartItem").empty().append(result.productCartItem);
                    $(".totalCartAmount").html(result.totalCartAmount);
                    $(".totalCartItems").html(result.totalCartItems);
                    $(".grandTotalAmount").html(result.grandTotalAmount);

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
                    $(".checkoutItems").empty().append(result.checkoutItems);
                    that.closest('.product-details').find(".productCartItem").empty().append(result.productCartItem);
                    $(".totalCartAmount").html(result.totalCartAmount);
                    $(".totalCartItems").html(result.totalCartItems);
                    $(".grandTotalAmount").html(result.grandTotalAmount);

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