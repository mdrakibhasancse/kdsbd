@extends('admin::layouts.adminMaster')
@section('title')
    | Order List
@endsection

@push('css')
@endpush
@section('content') 
<section class="content py-3">
    <div class="row">
        <div class="col-md-11 mx-auto">
    
            <div class="card w3-round shadow-lg">
                <div class="card-header pl-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted"><i class="fas fa-th text-primary pt-1"></i> All Orders </h3>
                    <div class="card-tools">
                    </div>
                </div>
                <div class="card-body bg-light px-0 pb-0 pt-2">
                    <div class="col-sm-12">
                        <div class="table-responsive table-responsive-sm">
                          <table class="table-striped table-bordered table-hover table-sm mb-1 table">
                            <thead class="text-muted thead-light">
                              <tr>
                                <th style="width: 10px">#SL</th>
                                <th>Action</th>
                                <th>Id</th>
                                <th>Date</th>
                                <th>Order Status</th>
                                <th>Amount</th>
                                <th>Payment Status</th>
                                <th>Product Items</th>
                              </tr>
                            </thead>
                            <tbody class="">
                              <?php $i = (($orders->currentPage() - 1) * $orders->perPage() + 1); ?>
                              @foreach($orders as $order)
                              <tr>
                                <td style="width: 10px">{{$i++}}</td>
                                <td style="width: 80px">
                                    <div class="dropdown show">
                                      <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                      </a>

                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                          <a href="{{ route('admin.orderDeatils',$order->id)}}" class="dropdown-item"><i class="fa fa-eye"></i> Details</a>

                                          <form action="{{ route('admin.orderDelete',$order->id)}}" method="post" onclick="return confirm('Are you sure to delete?')">
                                            @csrf
                                            <button type="submit" class="dropdown-item"><i class="fa fa-trash"></i> Delete</button>
                                          </form>
                                      </div>
                                </td>
                                <td>{{$order->id}}</td>
                                <td>{{$order->created_at->format('d/m/Y')}}</td>
                                <td>{{$order->order_status}}</td>
                                <td>{{$order->total_amount}}</td>
                                <td>{{$order->payment_status}}</td>
                                <td>{{$order->orderItems()->count()}}</td>
                              </tr>  
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                        <div class="w3-small float-right pt-1">
                            {!! $orders->links() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection




