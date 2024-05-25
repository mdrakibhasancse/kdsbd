@extends('frontend::layouts.pageMaster')

@push('css')

 <style>
    .btn-remove-cart {
    top: 120px;
    left: 69px;
}
 </style>
    
@endpush

@section('content')
<div class="container pt-5">
    <div class="row">
        <div class="col-lg-7">
           <div class="card">
              <div class="card-header py-0 w3-green">
                  <div class="card-title pt-4">
                    <h5 class="text-white"> <i class="fa fa-shopping-cart"></i>&nbsp;
                       Cart Items<span class="totalCartItems">({{totalCartItems()}})</span>
                    </h5>
                  </div>
              </div>
              <div class="card-body">
                <div class="cart-table-container">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="thumbnail-col">Thumbnail</th>
                                <th class="product-col">Product</th>
                                <th class="price-col">Price</th>
                                <th class="qty-col">Quantity</th>
                                <th class="text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="checkoutItems">
                            @include('frontend::welcome.includes.checkoutItems')
                        </tbody>


                        <tfoot>
                            {{-- <tr>
                                <td colspan="5" class="clearfix">
                                    <div class="float-left">
                                        <div class="cart-discount">
                                            <form action="#">
                                                <div class="input-group">
                                                    <input type="text" class="form-control form-control-sm"
                                                        placeholder="Coupon Code" required>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-sm" type="submit">Apply
                                                            Coupon</button>
                                                    </div>
                                                </div><!-- End .input-group -->
                                            </form>
                                        </div>
                                    </div><!-- End .float-left -->

                                    
                                </td>
                            </tr> --}}
                        </tfoot>
                    </table>
                </div><!-- End .cart-table-container -->
              </div>
           </div>

           <div class="card">
              <div class="card-body font-weight-bold">
                  <table class="table table-bordered bg-gray">
                        <tr>
                            <td>Σ (Qty x Price)</td>
                            <td>
                                tk. <span class="totalOriginalCartAmount">
                                    {{ number_format((totalCartAmount() + totalDiscountCartAmount()), 2) }}
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>Discount</td>
                            <td>
                                tk. <span class="totalDiscountCartAmount"> 
                                {{ number_format(totalDiscountCartAmount(), 2) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Total</h4>
                            </td>

                            <td class="price-col">
                                tk. <span class="totalCartAmount w3-large">
                                    {{ number_format(totalCartAmount(), 2) }}
                                </span>
                            </td>
                        </tr>
                </table>
              </div>
           </div>
       
        </div><!-- End .col-lg-8 -->

        <div class="col-lg-5">
            <div class="card">
                <div class="card-header py-0 w3-green">
                    <div class="card-title pt-4">
                        <h5 class="text-white"> <i class="fas fa-shipping-fast"></i>&nbsp;
                        Delivery Location</span>
                        </h5>
                    </div>
                </div>
                <form action="{{ route('orderStore')}}" method="post" class="mb-0 pb-0">
                    @csrf
                    <div class="card-body">
                
                        <div class="form-group form-group-sm">
                            <label class="">Address Title
                                <span class="text-danger">*</span>
                            </label>
                            <div class="select-custom">
                                <select class="form-control form-control-sm"  name="address_title">
                                    <option value="">select address</option>
                                    <option value="home">Home</option>
                                    <option value="office">Office</option>
                                    <option value="other">Other</option>
                                </select>

                            </div><!-- End .select-custom -->
                            @error('address_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div><!-- End .form-group -->

                        <div class="row">
                            <div class="form-group form-group-sm col-md-6">
                                <label class="">Name
                                     <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" class="form-control form-control-sm" value="{{ Auth::user()->name ?? old('name')}}" placeholder="Enter Name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><!-- End .form-group -->

                            
                            <div class="form-group form-group-sm col-md-6">
                                <label class="">Mobile
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="mobile" class="form-control form-control-sm" value="{{ Auth::user()->mobile ?? old('mobile') }}" placeholder="Enter Mobile">
                                @error('mobile')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><!-- End .form-group -->
                            
                        </div>
                        
                        
                        <div class="form-group form-group-sm">
                            <label class="">Email
                            </label>
                            <input type="text" name="email" class="form-control form-control-sm"   value="{{ Auth::user()->email ?? old('email') }}" placeholder="Enter email">
                            @error('email')
                               <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group form-group-sm">
                            <label class="">Area
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="area_name" class="form-control form-control-sm" value="{{ request()->cookie('area_name') ?? old('area_name')}}" placeholder="Enter area name" readonly>
                            @error('area_name')
                               <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group form-group-sm">
                            <label class="">Address Line
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="address_line" class="form-control form-control-sm" value="{{ $order->address_line ??  old('address_line')}}"
                            placeholder="Enter address line">
                            @error('address_line')
                               <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                
                    </div>
                
                    <div class="card-footer text-right">
                        <div class="checkout-methods">
                            <button  class="btn btn-block btn-dark">Order Now
                            <i class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            {{-- <div class="checkout-methods">
                <a href="cart.html" class="btn btn-block btn-dark">Order Now
                <i class="fa fa-arrow-right"></i></a>
            </div> --}}
            
          
        </div>
    </div>
</div>
<br>
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
                    $(".totalDiscountCartAmount").html(result.totalDiscountCartAmount);
                    $(".totalOriginalCartAmount").html(result.totalOriginalCartAmount);
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