@extends('frontend::layouts.pageMaster')
@section('title', 'page')


@section('content')
<div class="bg-white">
    <div class="container">
        <div class="countdown-container">
            <div class="countdown countdown-type2 is-countdown py-2 timer"><span class="countdown-row countdown-show4"><span class="countdown-section w3-xlarge font-weight-bold">Ends In:&nbsp;<span class="countdown-amount" id="days">00</span><span class="countdown-period">Days</span></span><span class="countdown-section"><span class="countdown-amount" id="hours">00</span><span class="countdown-period">Hours</span></span><span class="countdown-section"><span class="countdown-amount" id="minutes">00</span><span class="countdown-period">Mins</span></span><span class="countdown-section"><span class="countdown-amount" id="seconds">00</span><span class="countdown-period">Secs</span></span></span></div>
        </div>
    </div>
</div>
<br>


<section class="simple-section bg-white">
    <div class="tabs tabs-simple">
        
        <ul class="nav nav-tabs justify-content-center" role="tablist">
            @foreach($deals as $index => $item)

            <li class="nav-item">
                <a class="nav-link @if($deal->id == $item->id) active @endif" id="tab-customer-{{$item->id}}" data-toggle="tab" href="#customer-content-{{$item->id}}"
                    role="tab" aria-controls="customer-content-{{$item->id}}" aria-selected="@if($index == 0) true @else false @endif">{{$item->title}}</a>
            </li>
            @endforeach
        </ul>
        <div class="tab-content">
            @foreach($deals as $index => $item)
            <div class="tab-pane fade @if($deal->id == $item->id) show active @endif text-center" id="customer-content-{{$item->id}}" role="tabpanel"
                aria-labelledby="tab-customer-{{$item->id}}">
                @php
                $products = $item->products()->get();
                @endphp
                <div class="container">
                    <div class="card">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                @foreach($products as $product)
                                <div class="col-6 col-sm-2">
                                    <div class="product-default bg-white w3-border w3-hover-border-indigo">
                                        <figure>
                                            <a href="{{route('product', ['slug' => $product->slug, 'id' => $product->id])}}">
                                                <img src="{{ route('imagecache', ['template' => 'pfimd', 'filename' => $product->fi()]) }}" alt="product">
                                            </a>
                            
                                            <div class="label-group">
                                                @if($product->discount > 0.00)
                                                <div class="product-label label-hot w3-deep-orange">Tk. {{$product->discount}} off</div>
                                                @endif
                                            </div>
                                        </figure>
                            
                                        <div class="product-details">
                                            <h3 class="product-title"> <a href="{{route('product', ['slug' => $product->slug, 'id' => $product->id])}}">{{Str::Limit($product->name_en , 20 , '...')}}</a> </h3>
                                            <span class="font-weight-bold w3-text-gray pb-1">
                                            {{$product->unit}}
                                            </span>
                                            <div class="price-box">
                                                @if($product->discount > 0.00)
                                                <span class="old-price w3-small">Tk. {{$product->price}}</span>
                                                @endif
                                                <span class="product-price w3-small font-weight-bold">Tk. {{ $product->final_price }}</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                </div><!-- End .col-sm-4 -->
                                @endforeach
                            </div>

                            @if(request()->cookie('area_name') != null)

                            <a class="btn-icon px-5 py-3 w3-button w3-round w3-deep-orange w3-hover-indigo font-weight-bold w3-small addToCartDealProduct" data-url="{{ route('addToCartDealProduct', $deal)}}">
                                <i class="icon-shopping-cart"></i>&nbsp;<span>ADD TO CART ALL PRODUCT</span></a>
                            </a>

                            @else

                            <a class="btn-icon px-5 py-2 w3-button w3-round w3-deep-orange w3-hover-indigo font-weight-bold w3-small" data-target="#myModalLg"  data-toggle="modal" style="line-height: 30px">
                                <i class="icon-shopping-cart"></i>&nbsp;<span>ADD TO CART ALL PRODUCT</span></a>
                            </a>
                            @endif

                        </div>

                       
                    </div>
                </div>
                
            </div>
            @endforeach
        </div>
    </div>
</section>
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
        $(document).on("click",".addToCartDealProduct",function() {
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

<script>
    // Set the date we're counting down to
    var countDownDate = new Date("{{ $deal->expired_date }}").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="timer"
        document.getElementById("days").innerHTML = days;
        document.getElementById("hours").innerHTML = hours;
        document.getElementById("minutes").innerHTML = minutes;
        document.getElementById("seconds").innerHTML = seconds;

        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("timer").innerHTML = "EXPIRED";
        }
    }, 1000);
</script>



@endpush









