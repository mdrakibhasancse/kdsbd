<div class="table-responsive">
    <div>
        <table id="-shopTable" class="table table-bordered -table-head-fixed text-nowrap"
               style="white-space: nowrap;">
            <thead>
            <tr>
               <th>Select</th>
                <th>ID</th>
                <th>Name</th>
                <th>Unit</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody class="">
            @foreach ($products as $key=> $product)

               {{-- @dd($product->items) --}}
                <tr>
                    <td>
                        <input type="checkbox" class="input-select-item" id="id{{ $product->id }}"
                        data-select-url="{{route('admin.selectbranchProduct',['branch'=>$branch, 'product'=>$product, 'order' => $order])}}" 
                        data-unselect-url="{{route('admin.unSelectbranchProduct',['branch'=>$branch, 'product'=>$product, 'order' => $order])}}"
                        name="ids" value="{{$product->id}}"
                        data-id="{{$product->id}}"
                        {{$product->hasItem($branch->id, $order->id) ? 'checked' : ''}}>

                    </td>
                    <td>{{$product->id}}</td>
                    <td>{{Str::limit($product->name_en,20,"..")}}</td>
                    <td>{{$product->unit}}</td>
                    <td>{{$product->final_price}}</td>

                </tr>

            @endforeach


            </tbody>
            <tfoot>
            <tr>
                <th>Select</th>
                <th>ID</th>
                <th>Name</th>
                <th>Unit</th>
                <th>Price</th>
            </tr>
            </tfoot>
        </table>
      
        <div class="pagination">{{$products->appends(['q'=> $q ?? request()->q])->links()}}</div>

        {{-- <div class="{{request()->ajax() ? 'myLink' : ''}}">
            {{ $products->links() }}
        </div> --}}
    </div>
</div>


