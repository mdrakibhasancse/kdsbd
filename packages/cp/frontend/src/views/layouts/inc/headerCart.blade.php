@foreach($collections as $cart)
<div class="product">
    <div class="product-details">
        <h4 class="product-title">
            <a href="{{route('product', ['slug' => $cart->product->slug, 'id' => $cart->product_id])}}">{{Str::Limit($cart->product->name_en , 15, '...')}}</a>
        </h4>

        <span class="cart-product-info">
            <span class="cart-product-qty">{{ $cart->quantity}}</span> × {{$cart->product->final_price }} tk = {{ number_format($cart->quantity * $cart->product->final_price, 2) }} tk
        </span>
    </div>
  
    <figure class="product-image-container">
        <a href="{{route('product', ['slug' => $cart->product->slug, 'id' => $cart->product_id])}}" class="product-image">
            <img src="{{ route('imagecache', [ 'template'=>'ppsm','filename' => $cart->product->fi() ]) }}" alt="product" width="40" height="40">
        </a>

        <a data-url="{{ route('cartRemoveItem', $cart) }}" class="btn-remove cartRemoveItem" title="Remove Product" style="cursor: pointer"><span>×</span></a>
    </figure>
</div>
@endforeach