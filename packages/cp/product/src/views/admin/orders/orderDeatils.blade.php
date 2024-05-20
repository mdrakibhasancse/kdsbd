@extends('admin::layouts.adminMaster')
@section('title')
    | Order List
@endsection

@push('css')
@endpush

@section('content') 
<section class="content py-3">
    <div class="row w3-animate-zoom">
        <div class="col-md-11 mx-auto">
            <div class="card mb-2 shadow-lg">
                <div class="card-header py-2">
                    <h3 class="card-title w3-small text-bold text-muted pt-1"><i
                    class="fas fa-sitemap text-primary"></i> Order Details (OrderId: &nbsp;  {{$order->id }})</h3>
                    <div class="card-tools w3-small">
                        <a class="btn btn-primary btn-xs" target="_blank" href="{{ route('admin.orderPrint', $order->id) }}"><i class="fas fa-print w3-small"></i> Print</a>
                    </div>
                </div>
            </div>

            <div class="card w3-round mb-2 shadow-lg">
                <div class="card-body px-2 py-2 w3-light-gray">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow">
                                <div class="card-body">
                                    <address>
                                    {{$ws->website_title}}<br>
                                    {{$ws->contact_address}}<br>
                                    Phone: {{$ws->contact_mobile}}<br>
                                    Email: {{$ws->contact_email}}
                                    </address>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow">
                                <div class="card-body">
                                <address>
                                    Order Info<br>
                                    Order Id: {{$order->id}}<br>
                                    Order Date: {{$order->created_at->format('d/m/Y')}}<br>
                                    Order By: {{$order->user->name ?? ''}}
                                </address>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    @if($order->orderItems()->count() > 0)
                    <div class="card shadow">
                        <div class="card-header">
                            <h3 class="card-title">
                            Order Status
                            </h3>
                        </div>
                        <form action="{{ route('admin.orderStatus',$order->id)}}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select name="order_status" id="order_status" class="form-control">
                                                <option value="">order status</option>
                                                @foreach (config('parameter.order_status') as $item)
                                                    <option value="{{ $item }}" {{ $item == $order->order_status ? 'selected' : ' '}}>{{ ucfirst($item) }}</option>
                                                @endforeach
                                            </select>
                                            @error('order_status')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                    <button type="submit" class="form-control btn btn-primary btn-block">Submit</button>
                                    </div>
                                
                                </div>
                            </div>
                        </form>
                    </div>


                    <div class="card shadow">
                        <div class="card-header">
                            <h3 class="card-title">
                            Order Items
                            </h3>
                            
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#SL</th>
                                        <th>Product Name</th>
                                        <th>Product Price</th>
                                        <th>Quantity</th>
                                        <th>Total Cost</th>
                                        <td style="width:20px;">Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                            
                                    @foreach($order->orderItems as $item)
                                    <tr>
                                        <td style="width: 10px">{{$loop->iteration}}</td>
                                    
                                        <td>{{$item->product_name}}</td>
                                        <td>{{$item->product_price}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{$item->total_cost}}</td>
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
                                        
                                    </tr>  
                                    @endforeach

                                
                                    <tr>
                
                                    <td colspan="4" class="text-right font-weight-bold">Sub Total</td>
                                    <td class="font-weight-bold">
                                        {{$order->total_amount }}
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
                                    <td>
                                    
                                    </td>
                                    
                                    </tr>
                                
                                </tbody>
                                
                            </table>
                        </div>
                    </div>

                    @if($order->due() > 0)

                        <form action="{{ route('admin.orderPayment',$order) }}" method="post">
                        
                        @csrf

                        <div class="card shadow">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-credit-card"></i> Add Payment
                                
                                </h3>
                            </div>
                            <div class="card-body">
                                    <div class="row">
                                    <div class="col-md-6">
                                    <div class="card shadow" style="margin-bottom: 5px;">
                                    <div class="card-body ">
                                        
                                        <div class="form-group input-group-sm w3-light-gray row mb-1">
                                            <label for="payment_date" class="col-sm-5 col-form-label">Payment Date</label>
                                            <div class="col-sm-7">
                                            <input type="date" class="form-control mt-1 form-control-sm " id="payment_date" value="{{ old('payment_date') ? : date('Y-m-d') }}" name="payment_date" required>
                                            </div>
                                            @error('payment_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group input-group-sm mb-1 row w3-light-gray">
                                            <label for="payement_method" class="col-sm-5 col-form-label">Payment Method</label>
                                            <div class="col-sm-7">

                                                <input type="text" class="form-control mt-1 form-control-sm " id="payment_method" value="" placeholder="payment method" list="payment_methods" name="payment_method">

                                                <datalist id="payment_methods">
                                                    @foreach (config('parameter.payment_method') as $item)
                                                        <option value="{{ $item }}" {{ old('payment_method') == $item  ? 'selected' : ' '}}>{{ $item }}</option>
                                                    @endforeach
                                                </datalist>
                                            </div>
                                            @error('payment_method')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group input-group-sm row w3-light-gray mb-1">
                                            <label for="transaction_id" class="col-sm-5 col-form-label">Trans ID</label>
                                            <div class="col-sm-7">
                                            <input type="text" class="form-control bg-light mt-1 form-control-sm" id="transaction_id" name="transaction_id"
                                            value="{{ old('transaction_id')}}" placeholder="Transaction Id">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow" style="margin-bottom: 5px;">
                                <div class="card-body">

                                    <div class="form-group input-group-sm mb-1 row w3-light-gray">
                                        <label for="paid_amount" class="col-sm-5 col-form-label">Paid Amount</label>
                                        <div class="col-sm-7">
                                            <input type="number" class="form-control mt-1 form-control-sm " id="paid_amount" value="{{old('paid_amount') ?: $order->due()}}"  name="paid_amount" min="1" step="any" max="{{$order->due()}}" placeholder="Paid Amount" required>
                                            @error('paid_amount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        </div>
                                        <div class="form-group input-group-sm row w3-light-gray mb-1">
                                            <label for="remarks" class="col-sm-5 col-form-label">Note</label>
                                            <div class="col-sm-7">
                                            <input type="text" class="form-control bg-light mt-1 form-control-sm " placeholder="Note" id="note" value="" name="note">
                                            </div>
                                        </div>


                                        <div class="form-group input-group-sm row w3-light-gray mb-1">

                                            <div class="col-sm-5"></div>

                                            <div class="col-sm-7">

                                            <button type="submit" class="btn btn-primary btn-block btn-sm">Save</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                
                        
                            </div>
                            </div>
                        </div>
                        </form>
                                
                    @endif

                    <div class="card shadow">
                        <div class="card-header">
                                <h3 class="card-title">
                                Transaction History
                            </h3>
                        </div>
                        <div class="card-body">
                        <div class="row">
                        <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-sm table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Payment Status</th>
                                    <th>Payment Date</th>
                                    <th>Transaction Id</th>
                                    <th>Paid Amount</th>
                                </tr>
                                </thead>
                            <tbody>
                                
                                @foreach($order->payments as $payment)  
                                <tr>
                                    <td>{{$payment->id}}</td>
                                    <td>{{ Str::ucfirst($payment->payment_status) }}</td>
                                    <td>{{$payment->payment_date}}</td>
                                    <td>{{$payment->transaction_id}}</td>
                                    <td>{{$payment->paid_amount}}</td>
                                </tr>
                                @endforeach                   
                            <tbody>
                            </table>
                        </div>
                        </div>
                        </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
           
        </div>
    </div>
</section>
@endsection




