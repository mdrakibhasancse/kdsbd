@if($module->moduleItems->count())
<?php $i = 1; ?>
@forelse($module->moduleItems as $item)
<tr class="">
    <td>{{ $i }}</td>
    <td title="Tarmeric Powder 200gm">{{Str::Limit($item->product_name , 12 , '...')}}</td>
    <td>{{$item->product_code ?? ''}}</td>
    <td>

        <div class="d-flex cartItem w3-round" style="width: 100px; height:30px" >
            <input type="button" class="w3-input pt-0 w3-border w3-large border-0 w3-red minus moduleUpdateItem" data-url="{{ route('admin.moduleUpdateItemQty', ['module' => $module , 'item' => $item]) }}" data-qty="{{$item->quantity}}" value="-" style="cursor: pointer;font-size: 16px;">

            <input type="text" class="w3-input w3-border w3-hover-green border-0 text-center moduleUpdateItem" title="Qty" value="{{$item->quantity}}" name="qty[]" min="1" style="font-size: 16px;">


            <input type="button" class="w3-input pt-0 w3-border bg-primary border-0 w3-large plus moduleUpdateItem" data-url="{{ route('admin.moduleUpdateItemQty', ['module' => $module , 'item' => $item]) }}" data-qty="{{$item->quantity}}" value="+" style="cursor: pointer;font-size: 16px;">
        </div>

    </td>
    <td>{{$item->unit_price}}</td>
    <td>{{$item->total_price}}</td>
    <td class="text-right" width="150">
        <div class="btn-group btn-group-xs w3-hover-shadow">

        <button type="button" title="Delete" class="btn btn-default w3-white dropdown-toggle w3-border w3-border-blue" data-toggle="dropdown"> <i class="fa fa-trash"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-right" role="menu">
            <li class="w3-padding"><a class="w3-btn w3-red w3-small w3-round w3-hover-red moduleRemoveItem" href="{{ route('admin.moduleItemDelete', ['module' => $module , 'item' => $item]) }}">Confirm</a></li>
        </ul>
        </div>
    </td>
</tr>
<?php $i++; ?>
@empty

@endforelse
@endif
   





