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
                 <div class="card-header pl-2 py-1 d-flex">
                    <h3 class="card-title w3-small text-bold text-muted pt-2"><i class="fas fa-th text-primary pt-1"></i> All Orders</h3>
                    &nbsp;&nbsp;&nbsp;
                    <form action="{{ route('admin.typeOfOrder')}}" method="get">
                      <div class="btn-group">
                        <select name="status" id="status" class="round-0">
                            <option value="">order status</option>
                            @foreach (config('parameter.order_status') as $item)
                                <option value="{{ $item }}" {{ $item == request()->status ? 'selected' : ' '}}>{{ ucfirst($item) }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn text-white w3-indigo"><i class="fa fa-search"></i></button>
                      </div> 
                    </form>
                  
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




