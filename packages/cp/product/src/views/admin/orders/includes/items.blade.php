@foreach($order->orderItems as $item)
    <tr>
        <td style="width: 10px">{{$loop->iteration}}</td>

        <td>{{$item->product_name}}</td>
        <td>{{$item->product_price}}</td>
        <td>

        {{-- {{$item->quantity}} --}}

        @if($order->due() > 0)
        <div class="d-flex cartItem w3-round" style="width: 110px; height:35px" >
        <input type="button" class="w3-input pt-1 w3-border w3-large border-0 w3-red minus updateItem" data-url="{{ route('updateQty', $item) }}" data-qty="{{$item->quantity}}" value="-" style="cursor: pointer;font-size: 16px;">

        <input type="text" class="w3-input w3-border w3-hover-green border-0 text-center updateItem" title="Qty" value="{{ $item->quantity }}" name="product_qty[]" min="1" style="font-size: 16px;">


        <input type="button" class="w3-input pt-1 w3-border bg-primary border-0 w3-large plus updateItem" data-url="{{ route('updateQty', $item) }}" data-qty="{{$item->quantity}}" value="+" style="cursor: pointer;font-size: 16px;">
        </div>
        @else

        {{$item->quantity}}
         

        @endif

       

        </td>

        <td>{{number_format($item->quantity * $item->product_price, 2)}}</td>

        @if($order->due() > 0)
        <td style="width:20px;">
        <form action="{{ route('admin.orderItemDelete',$item->id)}}" method="post"
        onclick="return confirm('Are you sure to delete?')">
        @csrf
        <input type="hidden" name="order_id" value="{{ $order->id }}">
        <button type="submit" class="btn btn-danger btn-sm">
        <i class="fas fa-times"></i>
        </button>
        </form>
        </td>
        @endif

    </tr>  
@endforeach

<tr>
    <td colspan="4" class="text-right font-weight-bold">Sub Total</td>
    <td class="font-weight-bold">
    {{number_format($order->total_amount, 2)}}
    </td>
    <td></td>
</tr>

<tr>
    <td colspan="4" class="text-right font-weight-bold">Paid Amount</td>
    <td class="font-weight-bold">
    {{ $order->paid() }}
    </td>
    <td></td>
</tr>

<tr>
    <td colspan="4" class="text-right font-weight-bold">Due Amount</td>
    <td class="font-weight-bold">
    {{ $order->due() }}.00
    </td>
    <td></td>
</tr>