<div class="w3-green rounded text-center my-3 py-1 d-block font-weight-bold flex-wrap" style="font-size: 14px;">
    <strong>
    <span>&#2547; You are saving &#2547; {{ number_format(totalDiscountCartAmount(), 2) }} in this order.</span>
    </strong>
</div>

<div class="mb-0 w3-large">
    <span class="">Subtotal-</span>
    <span class="cart-total-price float-right ">&#2547; {{number_format(totalCartAmount(), 2)}}</span>
</div>

<div class="mb-0 w3-large">
    <span class="">Discount applied-</span>
    <span class="cart-total-price float-right w3-text-red">-&#2547; {{ number_format(totalDiscountCartAmount(), 2) }}</span>
</div>

<hr class="p-0 my-3">

@if((totalCartAmount()) >= 1000)
<div class="mb-0 w3-large">
    <span class="w3-green rounded text-center w3-small p-2 font-weight-bold"><i class="fa fa-bicycle" style="font-size:16px"></i>&nbsp;Regular Delivery</span>
    <span class="cart-total-price float-right w3-text-green">Free</span>
</div>
@else
<div class="mb-0 w3-large">
    @if(isset($area))
    <span class="w3-green rounded text-center w3-small p-2 font-weight-bold"><i class="fa fa-bicycle" style="font-size:16px"></i>&nbsp;Regular Delivery</span>
    <span class="cart-total-price float-right">&#2547; {{ $area->delivery_charge }}</span>
    @endif
</div>
@endif



<div class="w3-light-gray rounded px-2 py-1 font-weight-bold w3-small flex-wrap my-5">
    <strong>
    <span>১০০০ টাকার বেশি অর্ডার করলে ডেলিভারি চার্জ ফ্রী।</span>
    </strong>
</div>
<hr class="p-0 my-3">

@if((totalCartAmount()) >= 1000)
<div class="mb-0 w3-large">
    <span class="">Amount Payable-</span>
    <span class="cart-total-price float-right ">&#2547; {{ number_format(totalCartAmount(), 2) }}</span>
</div>
@else
<div class="mb-0 w3-large">
    @if(isset($area))
    <span class="">Amount Payable-</span>
    <span class="cart-total-price float-right ">&#2547; {{ number_format((totalCartAmount() + $area->delivery_charge), 2) }}</span>
    @endif
</div>
@endif
