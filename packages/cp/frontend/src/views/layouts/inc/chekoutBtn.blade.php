
@php
    $name = request()->cookie('area_name');
    $area = \Cp\Product\Models\BranchArea::where('name_en',  $name)->first();
@endphp

@if((totalCartAmount()) >= 1000)
<div class="dropdown-cart-total m-0 p-0">
    <span class="text-uppercase">Regular Delivery</span>
    <span class="cart-total-price float-right w3-text-green">Free</span>
</div>
@else
<div class="dropdown-cart-total m-0 p-0">
    @if(isset($area))
    <span class="text-uppercase">Regular Delivery</span>
    <span class="cart-total-price float-right">{{ $area->delivery_charge ?? 0.00 }} tk</span>
    @endif
</div>
@endif

<hr class="m-0 p-0">
@if((totalCartAmount()) >= 1000)
<div class="dropdown-cart-total">
    <span>GRAND TOTAL:</span>
    <span class="cart-total-price float-right">{{number_format(totalCartAmount(), 2) }} tk</span>
</div>
@else
<div class="dropdown-cart-total">
    @if(isset($area))
    <span>GRAND TOTAL:</span>
    <span class="cart-total-price float-right grandTotalAmount">{{number_format((totalCartAmount() +  $area->delivery_charge), 2) }} tk</span>
    @endif
</div>
@endif

<div class="w3-red rounded text-center my-3 py-1 d-block font-weight-bold flex-wrap" style="font-size: 14px;">
    <strong>
    <span>১০০০ টাকার বেশি অর্ডার করলে ডেলিভারি চার্জ ফ্রী।</span>
    </strong>
</div>


@if(Auth::check())           
    {{-- @if((totalCartAmount()) >= 1000)
    <div class="dropdown-cart-action">
        <a href="{{route('checkout')}}" class="btn w3-indigo btn-block">Checkout</a>
    </div>
    @else

    <div class="dropdown-cart-action-">
        <div class="card text-center mb-1">
         <div class="card-body">
            <p class="w3-large font-weight-bold pb-2">Orders below 1000tk are not accepted</p>
            <a href="{{url('/')}}" class="btn w3-indigo py-3 px-5 text-white" style=" text-decoration:none">Go Shop</a>
        </div> 
         </div>
       
    </div>
    @endif --}}

    <div class="dropdown-cart-action">
        <a href="{{route('checkout')}}" class="btn w3-indigo btn-block">Checkout</a>
    </div>

@else
    <div class="dropdown-cart-action-">
        <a  class="btn w3-indigo btn-block" data-target="#modal_register" data-toggle="modal">
            Checkout
        </a>
    </div>
@endif