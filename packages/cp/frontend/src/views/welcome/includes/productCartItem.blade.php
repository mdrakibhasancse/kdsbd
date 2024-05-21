@php
    $authCart = \Cp\Product\Models\Cart::where('user_id', Auth::id())->where('product_id', $product->id)->first();
    $session_id = \Illuminate\Support\Facades\Session::get('session_id');
    $sessionCart = \Cp\Product\Models\Cart::where('session_id', $session_id)->where('product_id', $product->id)->first();
@endphp

@if($authCart)
<div class="d-flex cartItem w3-round" style="width: 160px; height:27px;">
    <input type="button" class="w3-input w3-indigo w3-border w3-large text-white minus updateCartItem" data-url="{{ route('cartUpdateQty', $authCart) }}" data-qty="{{$authCart->quantity}}" value="-" style="padding: 0px; cursor: pointer;">
    <input type="text" class="w3-input w3-indigo w3-border w3-hover-green text-white text-center updateCartItem" title="Qty" value="{{ $authCart->quantity }}" name="product_qty[]" min="1">
    <input type="button" class="w3-input w3-indigo w3-border w3-large text-white plus updateCartItem" data-url="{{ route('cartUpdateQty', $authCart) }}" data-qty="{{$authCart->quantity}}" value="+" style="padding: 0px; cursor: pointer;">
</div>

@elseif($sessionCart)

<div class="d-flex cartItem w3-round" style="width: 160px; height:27px;">
    <input type="button" class="w3-input w3-indigo w3-border w3-large text-white minus updateCartItem" data-url="{{ route('cartUpdateQty', $sessionCart) }}" data-qty="{{$sessionCart->quantity}}" value="-" style="padding: 0px; cursor: pointer;">
    <input type="text" class="w3-input w3-indigo w3-border w3-hover-green text-white text-center updateCartItem" title="Qty" value="{{ $sessionCart->quantity }}" name="product_qty[]" min="1">
    <input type="button" class="w3-input w3-indigo w3-border w3-large text-white plus updateCartItem" data-url="{{ route('cartUpdateQty', $sessionCart) }}" data-qty="{{$sessionCart->quantity}}" value="+" style="padding: 0px; cursor: pointer;">
</div>

@else

<input class="product_qty" type="hidden" name="product_qty" value="1">
<a title="Add To Cart" class="btn-icon px-5 py-2 w3-button w3-deep-orange w3-round w3-hover-indigo font-weight-bold w3-small addToCatdesignBtn addToCart" data-url="{{ route('addToCart', $product)}}"><i class="icon-shopping-cart"></i>&nbsp;<span>ADD TO CART</span></a>

@endif
