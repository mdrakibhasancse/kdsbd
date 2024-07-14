@extends('admin::layouts.adminMaster')
@section('title')
    | Order Report
@endsection

@push('css')
@endpush
@section('content') 
<section class="content py-3">
    <div class="row">
        <div class="col-md-11 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.branchOrderReport', $branch) }}" method="get">
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
                            <label for="mobile">User</label>
                            <input type="text" name="mobile" class="form-control" id="mobile" value="{{ request()->mobile }}" placeholder="+880..........">
                        </div>



                        <div class="form-group input-group-sm col-md-2">
                            <br class="d-none d-md-block">
                            <button class="btn btn-warning btn-sm btn-block mt-2"> Search</button>
                        </div>

                      
                        <div class="form-group input-group-sm col-md-2">
                            <br class="d-none d-md-block">
                            <button type='submit' name="submit" value="print"  id="print" class="btn btn-primary btn-sm text-right mt-2 px-5"> <i class="fas fa-print"></i>  Print
                            </button> 
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
                    <h3 class="card-title w3-medium text-bold text-muted pt-2"><i class="fas fa-th text-primary"></i> Order Reports</h3>
                    <div class="card-tools">
                        <div class="card-tools w3-small">
                
                        </div>
                    </div>
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




