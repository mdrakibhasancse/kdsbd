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
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.orderList')}}" method="get">
                    <div class="form-row">
                        <div class="form-group input-group-sm col-md-2">
                            <label for="date_from">Date From</label>
                            <input type="date" name="date_from" class="form-control" id="date_from" value="{{ request()->date_from }}" placeholder="Date From">
                        </div>
                        <div class="form-group input-group-sm col-md-2">
                            <label for="date_to">Date To</label>
                            <input type="date" name="date_to" class="form-control" id="date_to" value="{{ request()->date_to }}" placeholder="Date To">
                        </div>

                        
                        <div class="form-group input-group-sm col-md-2">
                            <label for="mobile">Order Status</label>
                            <select name="status" id="status" class="round-0 form-control">
                                <option value="">order status</option>
                                @foreach (config('parameter.order_status') as $item)
                                    <option value="{{ $item }}" {{ $item == request()->status ? 'selected' : ' '}}>{{ ucfirst($item) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group input-group-sm col-md-2">
                            <label for="mobile">Mobile</label>
                            <input type="text" name="mobile" class="form-control" id="mobile" value="{{ request()->mobile }}" placeholder="Mobile">
                        </div>



                        <div class="form-group input-group-sm col-md-2 ">
                            <br class="d-none d-md-block">
                            <button class="btn btn-warning btn-sm btn-block mt-2"> Search</button>
                        </div>

                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-11 mx-auto">
            <div class="card w3-round shadow-lg">
                 <div class="card-header pl-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted pt-2"><i class="fas fa-th text-primary"></i> All Orders</h3>
                    &nbsp;&nbsp;&nbsp;
                </div>

                <div class="card-body bg-light px-0 pb-0 pt-2">
                    <div class="col-sm-12">
                         @include('product::admin.orders.includes.orderListPart')
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection




