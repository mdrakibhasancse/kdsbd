@extends('admin::layouts.adminMaster')
@section('title')
    | Roles All
@endsection

@push('css')
@endpush


@section('content') 
<section class="content py-3">
    <div class="row">
        <div class="col-md-11 mx-auto">
            <div class="card mb-2 shadow-lg">
                <div class="card-header px-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted pt-1"><i
                    class="fas fa-sitemap text-primary"></i> Roles</h3>
                    <div class="card-tools w3-small">
                    </div>
                </div>
            </div>
            <div class="card w3-round mb-2 shadow-lg">
                <div class="card-body px-3 py-1 w3-light-gray">
                    <form class="" action="{{ route('admin.roleStore') }}" method="POST">
                        @csrf
                            <div class="form-group input-group-sm w3-small">
                                <label for="role_name">Role Name</label>
                                <input type="text" class="form-control" id="role_name" name="role_name" value="{{ old('role_name') }}" placeholder="Role Name" required>
                                @error('role_name')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="row">
                              @foreach($permissions->chunk(ceil($permissions->count() / 2)) as $permission2)

                              <div class="col-6">

                                  @foreach($permission2 as $permission)

                                  <div class="custom-control custom-checkbox">

                              <input type="checkbox" class="custom-control-input" name="permissions[]" id="permission_{{ $permission->id }}" value="{{ $permission->id }}">
                              <label class="custom-control-label" for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                            </div>

                             @endforeach
                                
                            </div>


                          
                            @endforeach
                            </div>

                            <div class="form-group w3-small col-md-2">
                                <label for=""> </label>
                                <button type="submit" class="btn btn-primary btn-xs btn-block py-2">Submit</button>
                            </div>

                       
          
                    </form>
                </div>
            </div>
            <div class="card w3-round shadow-lg">
                <div class="card-header pl-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted"><i class="fas fa-th text-primary pt-1"></i> All Roles </h3>
                    <div class="card-tools">
                       

                        <div class="input-group input-group-sm">
                            <input type="search" name="q" class="slider-search form-control border-right-0 border py-2" data-url="{{ route('admin.sliderSearch') }}"  placeholder="Search name, id...">
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
                            @include('userrole::admin.roles.searchData')
                        </div>
                        <div class="w3-small float-right pt-1">
                            {!! $roles->links() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection



