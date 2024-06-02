@extends('admin::layouts.adminMaster')
@section('title')
    | Branch Area
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
               
                    <a href="{{route('admin.branchArea', $branch)}}" class="btn btn-outline-primary mr-1 my-1 rounded btn-sm {{ str_contains(url()->current(), 'brancharea') ? 'active' : '' }}">
                        <i class="fas fa-plus-square"></i> Area Manage
                    </a>

                    <a href="{{ route('admin.branchWiseProductManage', $branch)}}" class="btn btn-outline-primary mr-1 my-1 rounded btn-sm {{ str_contains(url()->current(), 'product/manage') ? 'active' : '' }}">
                    <i class="fas fa-plus-square"></i> Product Manage</a>
                    
                    <a class="btn btn-outline-primary mr-1 my-1 rounded btn-sm {{ str_contains(url()->current(), 'order/manage') ? 'active' : '' }}" href="{{ route('admin.branchWiseOrderManage', $branch)}}"><i class="fas fa-cart-plus"></i> Order Manage</a>

                    <a class="btn btn-outline-primary mr-1 my-1 rounded btn-sm {{ str_contains(url()->current(), 'branch/edit') ? 'active' : '' }}" href="{{route('admin.branchEdit', $branch)}}"><i class="fas fa-edit"></i>
                        Edit Branch</a>

                    <a class="btn btn-outline-primary mr-1 my-1 rounded btn-sm" href="{{ route('admin.pos', $branch)}}"><i class="fas fa-plus-square"></i> Pos Management</a>

                </div>
            </div>

            <div class="card card-primary card-outline w3-round shadow-lg mb-2">
                <div class="card-body px-3 py-1 w3-light-gray">
                    <form class="" action="{{route('admin.branchAreaStore')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $branch->id }}" name="branch_id">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                <label for="title">Name English</label>
                                <input type="text" name="name_en" value="{{ old('name_en') }}" id="name_en" placeholder="Name English" class="form-control" required>
                                @error('name_en')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="title">Name (বাংলা)</label>
                                    <input type="text" name="name_bn" value="{{ old('name_bn') }}" id="name_bn" placeholder="Name (বাংলা)" class="form-control">
                                </div>


                                <div class="form-group col-md-1 mb-3 justify-content-center">
                                    <div class="text-cnter" style="margin-bottom: 15px;">
                                    <label for="active" role="button"></label>
                                    </div>
                                    <b>Active</b>
                                    <input class="form-check-input" name="active" type="checkbox" id="active" style="margin-left: 5px;" checked>
                                </div>

                                <div class="form-group col-md-2 mb-3">
                                    <label for="">&nbsp;</label>
                                    <div class="">
                                    <button type="submit" class="btn btn-primary px-5">Submit</button>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </form>
                </div>
            </div>
            
            <div class="card w3-round shadow-lg">
                <div class="card-header pl-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted"><i class="fas fa-th text-primary pt-1"></i> Branch Areas</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <input type="search" name="q" class="branchArea form-control border-right-0 border py-2" data-url="{{ route('admin.productSearch' , ['type' => 'branchArea' , 'branch' => $branch->id]) }}"  placeholder="Search name, id...">
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
                        <div class="table-responsive data-container">
                            @include('product::admin.branchAreas.searchData')
                        </div>
                        <div class="w3-small float-right pt-1">
                            {!! $areas->links() !!}
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
    $(document).ready(function () {
      $(document).on('click', ".branchAreaStatus", function(e){
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

      $(document).on('keyup', ".branchArea", function(e){
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
    });
  </script>
@endpush





