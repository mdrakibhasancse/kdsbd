@extends('frontend::layouts.pageMaster')

@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <style>
      .cat-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
            overflow-y: auto; 
            max-height: 296px;
        }

        .cat-list li {
            padding: 2px 0;
        }

        .vertical-menu .form-check-label {
            cursor: pointer;
        }
    </style>

    
@endpush

@section('content')
 	<div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb w3-large">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('category',$category->slug)}}">{{$category->name_en}}</a></li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-9 main-content">
                <div class="row product-container">
                    @include('frontend::welcome.includes.productItems')
                </div><!-- End .row -->
                {{-- {{ $products->render() }} --}}
                @if ($nextPageUrl)
                    <div class="d-flex justify-content-center">
                        <p data-next-page="{{ $nextPageUrl }}"
                            class="w3-center tap-to-see-more">
                            <span class="spinner-border w3-text-red spinner-border-sm load-more-loader"
                                style="display:none;">
                            </span>
                        </p>
                    </div>
                @endif
            </div><!-- End .col-lg-9 -->

           


            <div class="sidebar-overlay"></div>
            <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
                <div class="sidebar-wrapper">
                    <div class="card">
                        <h3 class="card-title w3-large pl-4 pt-3">
                            <a href="" class="w3-text-indigo font-weight-bold">
                                SubCategory
                            </a>
                        </h3>
                        <div class="card-body py-0">
                            <ul class="cat-list">
                                @foreach($subcategories as $subcategory)
                                <li class="">
                                    <div class="form-group form-check vertical-menu">
                                       
                                        <input class="form-check-input subcategory-checkbox" type="checkbox" value="{{ $subcategory->id }}" data-url="{{ route('subcategory')}}" id="subcategory_{{ $subcategory->id }}" data-id="{{$category->id}}">&nbsp;&nbsp;
                                        <label class="form-check-label" for="subcategory_{{ $subcategory->id }}">
                                                {{ $subcategory->name_en }}
                                        </label>


                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div><!-- End .widget-body -->
                       
                    </div><!-- End .widget -->


                    {{-- <div class="card">
                        <h3 class="card-title w3-large pl-4 pt-3">
                            <a href="" class="w3-text-green font-weight-bold">
                                Brand
                            </a>
                        </h3>
                        <div class="card-body py-0  overflow-auto">
                            <ul class="cat-list">
                                <li>
                                    <div class="form-group form-check vertical-menu">
                                        <input type="checkbox" class="form-check-input" id="">
                                        &nbsp;&nbsp;
                                        <label class="form-check-label" for="">No Brand</label>
                                    </div>
                                </li>
                            </ul>
                        </div><!-- End .widget-body -->
                       
                    </div> --}}
                    
                </div><!-- End .sidebar-wrapper -->
            </aside><!-- End .col-lg-3 -->
        </div><!-- End .row -->
        <br>
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

    $(document).ready(function(){ 
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

        $(document).on('click','.tap-to-see-more', function(e){
            e.preventDefault();
            var that = $( this );
            $('.load-more-loader').show();
            var urlNext = that.attr('data-next-page'); 
            $.ajax({ 
            url: urlNext,
            type:"get",
            cache:false,
            }).done(function(response) {
                that.closest('.container').find('.product-container').append(response.view);
                $('.load-more-loader').hide();
                $('.tap-to-see-more').attr('data-next-page', response.nextPageUrl);

                if(response.nextPageUrl == null)
                {
                    that.remove();
                    $(".reached-at-end").show();
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


 <script>
        $(document).ready(function() {
            $(document).on('change','.subcategory-checkbox', function() {
                var selectedSubcategories = [];
                $('.subcategory-checkbox:checked').each(function() {
                    selectedSubcategories.push($(this).val());
                });

                var that = $(this);
                var url  = that.attr('data-url');
                var cat_id  = that.attr('data-id');

                $.ajax({ 
                url: url,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    subcategory_ids: selectedSubcategories,
                    cat_id : cat_id
                },
                cache:false,
                }).done(function(response) {
                    that.closest('.container').find('.product-container').empty().append(response.view);
                    $('.load-more-loader').hide();
                    $('.tap-to-see-more').attr('data-next-page', response.nextPageUrl);

                    if(response.nextPageUrl == null)
                    {
                        // that.remove();
                        $(".reached-at-end").show();
                    }
                });
                });
        });
    </script>

<script>
    var currentscrollHeight = 0;
    $(window).scroll(function() {
        const scrollHeight = $(document).height();
        const scrollPos = Math.floor($(window).height() + $(window).scrollTop());
        const isBottom = (scrollHeight - 1000) < scrollPos;
        if (isBottom && currentscrollHeight < scrollHeight) {
            $('.tap-to-see-more').click();  
            currentscrollHeight = scrollHeight;
        }
    });
</script>

 
@endpush