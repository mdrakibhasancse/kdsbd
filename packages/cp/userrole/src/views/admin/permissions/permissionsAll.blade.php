@extends('admin::layouts.adminMaster')
@section('title')
    | Permissions All
@endsection

@push('css')
@endpush

@section('content') 
<section class="content py-3">
    <div class="row">
        <div class="col-md-11 mx-auto">
            <div class="card mb-2 shadow-lg">
                <div class="card-header px-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted"><i
                    class="fas fa-sitemap text-primary"></i> Permissions</h3>
                    <div class="card-tools w3-small">
                    </div>
                </div>
            </div>
            <div class="card w3-round mb-2 shadow-lg">
               
                <div class="card-body px-3 py-1 w3-light-gray">
                    <form method="post" action="{{ route('admin.permissionStore') }}">
                        @csrf
                    <label for="permission">Permission Name</label>
                    <div class="input-group input-group-sm pb-3">
                      <input type="text" class="form-control" placeholder="Permission Name" name="name" value="{{ old('name') }}" aria-label="Permission Name" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button type="submit" class="input-group-text bg-primary" id="basic-addon2">Save</button>
                      </div>
                    </div>
                    </form>


                </div>
            </div>
            <div class="card w3-round shadow-lg">
                <div class="card-header pl-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted"><i class="fas fa-th text-primary pt-1"></i> All Permissions </h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <input type="search" name="q" class="premission-search form-control border-right-0 border py-2" data-url="{{ route('admin.permissionSearch') }}"  placeholder="Search name, id...">
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
                            @include('userrole::admin.permissions.searchData')
                        </div>
                        <div class="w3-small float-right pt-1">
                            {!! $permissions->links() !!}
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
            $(document).on('keyup', ".premission-search", function(e){

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
