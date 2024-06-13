<div class="table-responsive table-responsive-sm">
    <table class="table-striped table-bordered table-hover table-sm mb-1 table">
    <thead class="text-muted thead-light">
        <tr>
        <th style="width: 10px">#SL</th>
        <th>Action</th>
        <th>Id</th>
        <th>UserId</th>
        <th>Branch Name</th>
        <th>Date</th>
        <th>Order Status</th>
        <th>Total Amount</th>
        <th>Total Discount</th>
        <th>Final Amount</th>
        <th>Payment Status</th>
        <th>Product Items</th>
        <th>Total Orders</th>
        </tr>
    </thead>
    <tbody class="">
        <?php $i = (($orders->currentPage() - 1) * $orders->perPage() + 1); ?>
        @foreach($orders as $order)
        {{-- @dd($order->user) --}}
        <tr>
        <td style="width: 10px">{{$i++}}</td>
        <td style="width: 80px">
            <div class="dropdown show">
                <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a href="{{route('admin.posOrderDetails',$order)}}" class="dropdown-item"><i class="fa fa-eye"></i> Details</a>
                </div>
        </td>
        <td>{{$order->id}}</td>
        <td>
            <a href="{{ route('admin.usersAll',['id' => $order->user_id ?? '' ])}}">
            {{$order->user_id ?? ''}}
            </a>
        </td>
        <td>
            <a href="{{ route('admin.pos',['branch'=> $order->branch])}}">
            {{$order->branch->name_en ?? ''}} ({{$order->branch_id}})
            </a>
        </td>

        <td>{{$order->created_at->format('d/m/Y')}}</td>
        <td>{{$order->order_status}}</td>
        <td>{{$order->total_price}}</td>
        <td>{{$order->total_discount}}</td>
        <td>{{$order->final_price}}</td>
        <td>{{$order->payment_status}}</td>
        <td>{{$order->orderItems()->count()}}</td>
        <td>
           
            @if ($order->user)
             <a href="{{ route('admin.posOrdersReport', ['mobile' => $order->user->mobile] )}}">
                {{$order->user->posOrders->count()}}
             </a>
            @else
               0
            @endif
           
            
        </td>
        </tr>  
        @endforeach
    </tbody>
    </table>
</div>
<div class="w3-small float-right pt-1">
    {!! $orders->links() !!}
</div>