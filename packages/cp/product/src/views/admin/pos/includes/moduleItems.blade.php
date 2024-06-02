<table class="table table-no-pm table-condensed table-striped table-bordered">
    <thead>
    <tr>
        <th>SL</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Sale Price</th>
        <th>Total Amount</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody class="">
        @if($module->moduleItems->count())
        <?php $i = 1; ?>
        @forelse($module->moduleItems as $item)
        <tr class="">
            <td>{{ $i }}</td>
            <td title="Tarmeric Powder 200gm">{{Str::Limit($item->product_name , 12 , '...')}}</td>
            <td>

                <div class="d-flex cartItem w3-round" style="width: 100px; height:30px" >
                    <input type="button" class="w3-input pt-0 w3-border w3-large border-0 w3-red minus moduleUpdateItem" data-url="{{ route('admin.moduleUpdateItemQty', ['module' => $module , 'item' => $item]) }}" data-qty="{{$item->quantity}}" value="-" style="cursor: pointer;font-size: 16px;">

                    <input type="text" class="w3-input w3-border w3-hover-green border-0 text-center moduleUpdateItem" title="Qty" value="{{$item->quantity}}" name="qty[]" min="1" style="font-size: 16px;">


                    <input type="button" class="w3-input pt-0 w3-border bg-primary border-0 w3-large plus moduleUpdateItem" data-url="{{ route('admin.moduleUpdateItemQty', ['module' => $module , 'item' => $item]) }}" data-qty="{{$item->quantity}}" value="+" style="cursor: pointer;font-size: 16px;">
                </div>

            </td>
            <td>{{$item->unit_price}}</td>
            <td>{{$item->total_price}}</td>
            <td class="text-right" width="100">
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
    </tbody>

    <tfoot>


        <tr>
        <th colspan="5" class="text-right">Sub Total (TK)</th>
        <th colspan="3" class="w3-light-gray p-0">
        <div class="form-group form-group-sm mb-0">
        <input type="number" name="sub_total" placeholder="Sub Total" step="any" value="{{ $module->moduleItemSubTotal() }}" class="form-control sub_total" id="sub_total" readonly="">
        </div>
        </th>
        </tr>
        
        <tr>
        <th colspan="5" class="text-right">Discount (TK)</th>
        <th colspan="3" class="w3-light-gray p-0">
        <div class="form-group form-group-sm mb-0 module">
        <input type="number" name="discount" placeholder="Final Discount" class="form-control moduleDiscountAmount" value="0.00" id="discount">
        </div>
        </th>
        </tr>

        <tr>
        <th colspan="5" class="text-right">Grand Total (TK)</th>
        <th colspan="3" class="w3-light-gray p-0">
        <div class="form-group form-group-sm mb-0">
        <input type="number" name="grand_total" placeholder="Grand Total" step="any" value="{{ $module->moduleItemSubTotal()}}" class="form-control grand_total" id="grand_total" readonly="">
        </div>
        </th>
        </tr>

        <tr>
        <th colspan="5" class="text-right">Paid (TK)</th>
        <th colspan="3" class="w3-light-gray p-0">
        <div class="form-group form-group-sm mb-0">
        <input type="number" name="paid_amount" placeholder="Paid Amount" min="0" step="any" value="0.00" {{ route('admin.modulePaidAmount', ['module' => $module])}} class="form-control modulePaidAmount" required="" id="paid_amount">
        </div>
        </th>
        </tr>

        <tr>
        <th colspan="5" class="text-right">Return (TK)</th>
        <th colspan="3" class="w3-light-gray p-0">
        <div class="form-group form-group-sm mb-0">
        <input type="number" name="return_amount" placeholder="Return to member" step="any" value="0.00" class="form-control return_amount" id="return_amount" readonly="">
        </div>
        </th>
        </tr>



        <tr>
        <th colspan="5" class="text-right"></th>
        <th colspan="3" class="w3-light-gray p-0 text-center">
        <button type="submit" class="btn btn-sm final-save-btn only-save-btn btn-primary px-4"> &nbsp;Save</button>

    
        </th>
        </tr>



    </tfoot>

</table>




