@extends('admin::layouts.adminMaster')
@section('title')
    | Roles Edit
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
                      class="fas fa-sitemap text-primary"></i> Role Edit</h3>
                    <div class="card-tools w3-small"></div>
                </div>
            </div>
            <div class="card w3-round mb-2 shadow-lg">
              <div class="card-body px-3 py-1 w3-light-gray">
                  <form method="post" action="{{ route('admin.roleUpdate', $role) }}">
                    @csrf
                    <div class="form-group">
                      <label for="role_name">Role Name</label>
                      <input type="text" class="form-control" id="role_name" name="role_name" value="{{ old('role_name') ?: $role->name }}" placeholder="Role Name ">
                    </div>
                    
                    <div class="row">
                      @foreach($permissions->chunk(ceil($permissions->count() / 2)) as $permission2)

                        <div class="col-6">
                          @foreach($permission2 as $permission)
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input"  name="permissions[]" id="permission_{{ $permission->id }}" value="{{ $permission->id }}"  {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                              <label class="custom-control-label" for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                            </div>

                            @if(str_contains($permission->name, 'delete'))
                            <hr>
                            @endif
                          @endforeach
                        </div>
                      @endforeach
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm mb-3 float-right">Submit</button>
                    
                  </form>
              </div>
            </div>
          
        </div>
    </div>
</section>
@endsection

