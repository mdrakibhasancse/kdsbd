@extends('admin::layouts.adminMaster')
@section('title')
    | Branch Show
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
        </div>
    </div>

    <div class="row">
        <div class="col-md-11 mx-auto">
           <div class="card mb-2">
                <div class="card-body p-2">
               
                    <a href="{{route('admin.branchArea', $branch)}}" class="btn btn-outline-primary mr-1 my-1 rounded btn-sm {{ str_contains(url()->current(), 'brancharea') ? 'active' : '' }}">
                        <i class="fas fa-plus-square"></i> Area Manage
                    </a>

                     <a href="{{ route('admin.branchWiseProductManage', $branch)}}" class="btn btn-outline-primary mr-1 my-1 rounded btn-sm {{ str_contains(url()->current(), 'product/manage') ? 'active' : '' }}">
                    <i class="fas fa-plus-square"></i> Product Manage</a>
                    
                    {{-- <a class="btn btn-outline-primary mr-1 my-1 rounded btn-sm " href="http://cp.test/my/blog-details/2/type/edit"><i class="fas fa-cart-plus"></i>
                        Order Manage</a> --}}

                    <a class="btn btn-outline-primary mr-1 my-1 rounded btn-sm {{ str_contains(url()->current(), 'branch/edit') ? 'active' : '' }}" href="{{route('admin.branchEdit', $branch)}}"><i class="fas fa-edit"></i>
                        Edit Branch</a>
                </div>
            </div>
        </div>
    </div>
  </section>

@endsection






