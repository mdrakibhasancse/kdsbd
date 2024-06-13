@extends('admin::layouts.adminMaster')
@section('title')
    | Pos Orders All
@endsection

@push('css')

@endpush

@section('content') 
    <!-- Main content -->
    <section class="content p-2">
  
        <div class="row">
            <div class="col-md-11 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <form method="get" action="{{ route('admin.posOrdersReport')}}">
                            <div class="form-row">
                                <div class="form-group input-group-sm col-md-3">
                                    <label for="date_from">Date From</label>
                                    <input type="date" name="date_from" class="form-control" id="date_from" value="{{ request()->date_from }}" placeholder="Date From">
                                </div>
                                <div class="form-group input-group-sm col-md-3">
                                    <label for="date_to">Date To</label>
                                    <input type="date" name="date_to" class="form-control" id="date_to" value="{{ request()->date_to }}" placeholder="Date To">
                                </div>

                                @if(!request()->id)
                                <div class="form-group input-group-sm col-md-3">
                                    <label for="mobile">Customer Mobile</label>
                                    <input type="text" name="cus_mobile" class="form-control" id="cus_mobile" value="{{ request()->cus_mobile }}" placeholder="Customer mobile">
                                </div>
                                @endif


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
                    <h3 class="card-title w3-small text-bold text-muted pt-2"><i class="fas fa-th text-primary"></i> Pos Order Reports</h3>
                </div>

                <div class="card-body bg-light px-0 pb-0 pt-2">
                    <div class="col-sm-12">
                         @include('product::admin.pos.includes.posOrderListPart')
                    </div>
                </div>

            </div>
        </div>
     </div>
    </section>
@endsection

@push('js')

@endpush


