@foreach ($collections as $cart)

<tr class="product-row">
    <td><button class="btn btn-xs shadow-lg w3-red cartRemoveItem" data-url="{{ route('cartRemoveItem', $cart) }}" title="Remove Product">×</button></td>
    <td>
        <figure class="product-image-container">
            <a href="{{route('product', ['slug' => $cart->product->slug, 'id' => $cart->product_id])}}" class="product-image">
                <img class="border" src="{{ route('imagecache', [ 'template'=>'ppsm','filename' => $cart->product->fi() ]) }}" alt="product" width="40" height="40">
            </a>
        </figure>
        
        
    </td>
    <td class="product-col">
        <h5 class="product-title">
            <a href="{{route('product', ['slug' => $cart->product->slug, 'id' => $cart->product_id])}}">{{Str::Limit($cart->product->name_en , 15, '...')}}</a>
        </h5>
    </td>
    <td> 
        @if($cart && $cart->product->discount > 0.00)
        <span class="old-price">Tk. {{$cart->product->price}}</span>
        @endif<br>
        tk. {{ $cart->product->final_price }} 
        
    </td>
    <td>
        <div class="d-flex cartItem w3-round" style="width: 130px;">
            <input type="button" class="w3-input w3-border w3-large minus updateCartItem" data-url="{{ route('cartUpdateQty', $cart) }}" data-qty="{{$cart->quantity}}" value="-" style="cursor: pointer;">
            <input type="text" class="w3-input w3-border w3-hover-green text-center updateCartItem" title="Qty" value="{{ $cart->quantity }}" name="product_qty[]" min="1" >
            <input type="button" class="w3-input w3-border w3-large plus updateCartItem" data-url="{{ route('cartUpdateQty', $cart) }}" data-qty="{{$cart->quantity}}" value="+" style="cursor: pointer;">
        </div>
    </td>
    <td class="text-right"><span class="subtotal-price">tk. {{ number_format($cart->quantity * $cart->product->final_price, 2) }}</span></td>
</tr>
@endforeach