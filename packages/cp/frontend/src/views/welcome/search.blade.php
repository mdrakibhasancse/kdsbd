@extends('frontend::layouts.pageMaster')

@push('css')

@endpush
@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-12 main-content">
                <div class="row searchResults">
                    @include('frontend::welcome.includes.productItems')
                </div>
            </div>
        </div>
        <br>
    </div>
@endsection

@push('js')
<script>
    $(document).ready(function () {
        $(document).on('keyup', ".search", function(e){
            e.preventDefault();
            var that = $(this);
            var url = that.attr('data-url');
            var q = that.val();
            $.ajax({ 
                url: url,
                method: 'get',
                data: {
                    _token: '{{ csrf_token() }}',
                    q : q
                },
                cache: false,
            }).done(function(response) {
                that.closest('.container').find('.product-container').empty().append(response.view);
                var newRoute = '{{ route("search") }}';
                history.pushState({ path: newRoute }, '', newRoute + '?q=' + encodeURIComponent(q));
            });
        });
    });
</script>

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