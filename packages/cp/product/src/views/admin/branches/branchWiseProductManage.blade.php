@extends('admin::layouts.adminMaster')
@section('title')
    | Branch Wise Product Manage
@endsection

@push('css')
@endpush

@section('content') 
  <section class="content py-3">
    <div class="row">
        <div class="col-md-11 mx-auto">
            <div class="card mb-2 shadow-lg">
                <div class="card-header px-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted pt-1 w3-medium">
                        <i class="fas fa-code-branch text-primary"></i> &nbsp;Branch Name : <strong>({{$branch->name_en}})</strong></h3>
                    <div class="card-tools w3-small">
                        <a href="{{ route('admin.branchesAll')}}" class="btn btn-outline-primary btn-xs pull-right mr-2 py-1"><i class="fas fa-arrow-left"></i>&nbsp;Back</a>
                    </div>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-body p-2">

                    @include('product::admin.branchAreas.branchBtn')
               
                    {{-- <a href="{{route('admin.branchArea', $branch)}}" class="btn btn-outline-primary mr-1 my-1 rounded btn-sm {{ str_contains(url()->current(), 'brancharea') ? 'active' : '' }}">
                        <i class="fas fa-plus-square"></i> Area Manage
                    </a>

                     <a href="{{ route('admin.branchWiseProductManage', $branch)}}" class="btn btn-outline-primary mr-1 my-1 rounded btn-sm {{ str_contains(url()->current(), 'product/manage') ? 'active' : '' }}">
                    <i class="fas fa-plus-square"></i> Product Manage</a>
                    
                    <a class="btn btn-outline-primary mr-1 my-1 rounded btn-sm {{ str_contains(url()->current(), 'order/manage') ? 'active' : '' }}" href="{{ route('admin.branchWiseOrderManage', $branch)}}"><i class="fas fa-cart-plus"></i> Order Manage</a>

                    <a class="btn btn-outline-primary mr-1 my-1 rounded btn-sm {{ str_contains(url()->current(), 'branch/edit') ? 'active' : '' }}" href="{{route('admin.branchEdit', $branch)}}"><i class="fas fa-edit"></i>
                        Edit Branch</a>

                    <a class="btn btn-outline-primary mr-1 my-1 rounded btn-sm" href="{{ route('admin.dealsAll', $branch)}}"><i class="fas fa-plus-square"></i> Deals</a>

                    <a class="btn btn-outline-primary mr-1 my-1 rounded btn-sm" href="{{ route('admin.pos', $branch)}}"><i class="fas fa-plus-square"></i> Pos Management</a> --}}

                  
                </div>
            </div>

            <div class="card w3-round shadow-lg">
                <div class="card-header pl-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted"><i class="fas fa-th text-primary pt-1"></i> All Products </h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <input type="search" name="q" class="brandwiseproduct form-control border-right-0 border py-2"  data-url="{{ route('admin.productSearch' , ['type' => 'brandwiseproduct' , 'branch' => $branch]) }}" placeholder="Search name, id...">
                            <div class="input-group-append ">
                                <button type="submit" class="input-group-text bg-transparent">
                                <i class="fa fa-search w3-text-orange"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-light px-0 pb-0 pt-2">
                    <div class="col-sm-12">
                        <div class="table-responsive table-responsive-sm data-container">
                            @include('product::admin.branches.searchData')
                        </div>
                        <div class="w3-small float-right pt-1">
                            {!! $products->links() !!}
                        </div>
                    </div>
                </div>

            </div>

           
           
        </div>
    </div>
  </section>

@endsection

@push('js')
    <script>
          $( document ).ready(function() {
            $(document).on('change keyup', '.productAddStock', function(e) {
                e.preventDefault();
                var that = $(this),
                url = that.attr('data-url'),
                data = that.val();
                $.ajax({
                    url: url,
                    type: 'get',
                    data: {qty:data},
                    success: function(response) {
                    //    that.closest('tr').find('.current_stock').text(response.current_stock);
                    }
                });
            }); 

            $(document).on('keyup', ".brandwiseproduct", function(e){
                e.preventDefault();
                var that = $( this );
                var url = that.attr('data-url');
                var q = that.val();
                $.ajax({
                    url: url,
                    data : {q:q},
                    method: "get",
                    success: function(res)
                    {
                        if(res.success)
                        {
                            $(".data-container").empty().append(res.page);
                        }
                    }
                });
            });


            $(document).on('click', ".branchProductStatus", function(e){
                e.preventDefault();
                var that = $( this );
                var url = that.attr('data-url');
                $.ajax({
                    url: url,
                    method: "get",
                    success: function(res)
                    {
                    if(res.active == true)
                    {
                        that.removeClass('badge-danger').addClass('badge-primary');
                        that.text('Active');
                    }
                    else
                    {
                        that.removeClass('badge-primary').addClass('badge-danger');
                        that.text('Inactive');
                    }
                    }
                });
            });


            $(document).on('click', ".branchProductQuickPos", function(e){
                e.preventDefault();
                var that = $( this );
                var url = that.attr('data-url');
                $.ajax({
                    url: url,
                    method: "get",
                    success: function(res)
                    {
                    if(res.active == true)
                    {
                        that.removeClass('badge-danger').addClass('badge-primary');
                        that.text('True');
                    }
                    else
                    {
                        that.removeClass('badge-primary').addClass('badge-danger');
                        that.text('False');
                    }
                    }
                });
            });
        });
    </script>
@endpush





