@extends('admin::layouts.adminMaster')
@section('title')
    | Permission Edit
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
                    class="fas fa-sitemap text-primary"></i> Permission Edit</h3>
                    <div class="card-tools w3-small"></div>
                </div>
            </div>
            <div class="card w3-round mb-2 shadow-lg">
                <div class="card-body px-3 py-1 w3-light-gray">
                    <form method="post" action="{{ route('admin.permissionUpdate', $permission) }}">
                        @csrf
                        <label for="permission">Permission Name</label>
                        <div class="input-group input-group-sm pb-3">
                        <input type="text" class="form-control" placeholder="Permission Name" name="name" value="{{ old('name') ?: $permission->name }}" aria-label="Permission Name" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button type="submit" class="input-group-text bg-primary" id="basic-addon2">Update</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</section>
@endsection
