 <table class="table table-striped table-bordered table-hover table-md">
    <thead class="w3-small">
        <tr>
            <th scope="col" width="30">SL</th>
            <th scope="col">Product Id</th>
            <th scope="col">Status</th>
            <th scope="col">Name English</th>
            <th scope="col">Name (বাংলা)</th>
            <th scope="col">Price</th>
            <th scope="col">Stock</th>
        </tr>
    </thead>
    <tbody class="">
        <?php $i = (($products->currentPage() - 1) * $products->perPage() + 1); ?>
        @forelse ($products as $key => $product)

            @php
                $stock = \Cp\Product\Models\BranchProduct::where('branch_id', $branch->id)->where('product_id', $product->id)->first();
            @endphp
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $product->id }}</td>
                <td>
                     
                    @if($stock->active == 1)
                    <button class="badge border-0 badge-primary branchProductStatus" data-url="{{route("admin.branchProductStatus",['product' => $product, 'branch' => $branch ])}}" >
                        Active
                    </button>
                    @else
                    <button class="badge border-0 badge-danger branchProductStatus" data-url="{{route("admin.branchProductStatus",['product' => $product, 'branch' => $branch ])}}" >
                        Inactive
                    </button>
                    @endif
               
                </td>
                <td>{{ Str::limit($product->name_en, 30) }}</td>
                <td>{{ Str::limit($product->name_bn, 30) }}</td>
                    <td>{{ $product->price }}</td>
                <td>
                    <input type="number" name="stock_qty" class="productAddStock" data-url="{{ route('admin.productAddStock', ['product' => $product, 'branch' => $branch ])}}"  value="{{ $stock->stock_qty ? $stock->stock_qty : 0}}">
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-danger h5 text-center">No Product Found</td>
            </tr>
        @endforelse
    </tbody>
</table>