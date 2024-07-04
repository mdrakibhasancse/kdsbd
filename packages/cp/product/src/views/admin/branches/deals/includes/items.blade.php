@foreach($deal->products as $product)
    <tr>
        <td style="width: 10px">{{$loop->iteration}}</td>
        <td>{{$product->name_en}}</td>
        <td>{{$product->final_price}}</td>
        <td>{{$product->unit}}</td>
        <td>
            <a href="{{ route('admin.dealProductDelete', ['product' => $product, 'deal' => $deal, 'branch'=> $branch])}}" class="btn btn-danger btn-xs text-danger" onclick="return confirm('Are you sure to delete?')"><i class="fa fa-trash text-white"></i></a>
        </td>
    </tr> 
@endforeach 
