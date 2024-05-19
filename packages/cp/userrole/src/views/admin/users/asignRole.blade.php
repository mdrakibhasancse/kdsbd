@extends('admin::layouts.adminMaster')
@section('title')
    | Asign Role
@endsection

@push('css')
<style>
    .select2-container--default .select2-selection--single {
    
      height: 33px !important;
      }
  </style>
@endpush



@section('content') 
<section class="content py-3">
    <div class="row">
        <div class="col-md-11 mx-auto">
            <div class="card mb-2 shadow-lg">
                <div class="card-header px-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted pt-1"><i
                        class="fas fa-sitemap text-primary"></i> Asign Role</h3>
                    <div class="card-tools w3-small">
                       
                    </div>
                </div>
            </div>
            <div class="card w3-round mb-2 shadow-lg">
               
              <form action="{{ route('admin.assignRoleStore')}}" method="post">
                 @csrf
                <div class="card-body px-3 py-1 w3-light-gray">
                    <div class="row">
                        <div class="form-group input-group-sm w3-small col-md-4">
                          <label for="user_id">User Name
                          </label>
                          <select id="user_id"
                          name="user_id"
                          class="form-control ajaxUserSearch"
                          data-placeholder="Choose User"
                          data-ajax-url="{{ route('admin.ajaxUserSearch')}}"
                          data-ajax-cache="true"
                          data-ajax-dataType="json"
                          data-ajax-delay="200"
                          style="">
                          </select>
                          @error('user_id')
                          <span style="color: red">{{ $message }}</span>
                          @enderror
                        </div>
                    
                      <div class="form-group input-group-sm w3-small col-md-4">
                          <label for="role_ids">Role Name
                          </label>
                          <select  name="role_ids[]" id="role_ids" class="form-control select2 w3-small py-0" data-placeholder="Choose Role" multiple>
                              @foreach ($roles as $role)
                                  <option value="{{ $role->name }}" 

                                  @if ((old('role_ids') and (in_array($role->name, old('role_ids')))))  
                                      selected
                                  @endif
                                                  
                                  > {{ $role->name }}</option>
                              @endforeach

                          </select>
                          @error('role')
                          <span style="color: red">{{ $message }}</span>
                          @enderror
                      </div>

                      <div class="form-group input-group-sm w3-small col-md-2">
                          <label for=""> &nbsp; </label>
                          <button type="submit" class="btn btn-primary btn-xs btn-block py-2">Submit</button>
                      </div>
                
                    </div>
                </div>
             

              </form>

            </div>
            <div class="card w3-round shadow-lg">
                <div class="card-header pl-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted"><i class="fas fa-th text-primary pt-1"></i> Roles User </h3>
                </div>
                <div class="card-body bg-light px-0 pb-0 pt-2">
                    <div class="col-sm-12">
                        <div class="table-responsive table-responsive-sm data-container">
                           <table class="table table-striped table-bordered table-hover table-md">
                              <thead class="w3-small text-muted thead-light">
                                <tr>
                                  <th scope="col" style="width: 10px">#SL</th>
                                  <th scope="col">Action</th>
                                  <th scope="col">user Name</th>
                                  <th scope="col">Email</th>
                                  <th scope="col">Role Name</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $i = (($roleUsers->currentPage() - 1) * $roleUsers->perPage() + 1); ?>
                                @foreach($roleUsers as $user)
                                <tr>
                                  <td style="width: 10px">{{$i++}}</td>
                                  <td style="width: 80px">
                                      <div class="dropdown show">
                                        <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Action
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                          
                                            <form action="{{ route('admin.roleDetach',$user->id)}}" method="post" onclick="return confirm('Are you sure to delete?')">
                                              @csrf
                                              <button type="submit" class="dropdown-item"><i class="fa fa-trash"></i> Delete</button>
                                            </form>
                                        </div>
                                  </td>
                                  <td>{{$user->name}}</td>
                                  <td>{{$user->email}}</td>
                                  <td>
                                      @foreach($user->roles as $role)
                                        {{ $role->name }},
                                      @endforeach
                                  </td>
                                </tr>  
                                @endforeach
                              </tbody>
                            </table>
                        </div>
                        <div class="w3-small float-right pt-1">
                            {!! $roleUsers->links() !!}
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
    $('.select2').select2()
    $(document).ready(function(){
         $('.ajaxUserSearch').select2({ 
            ajax: {
                data: function (params) {
                    return {
                      q: params.term, // search term
                      page: params.page
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    // alert(data[0].s);
                    var data = $.map(data, function (obj) {
                      obj.id = obj.id || obj.id;
                      return obj;
                    });
                    var data = $.map(data, function (obj) {
                    obj.text = obj.name +" (" + obj.email +")" ;
                    return obj;
                    });
                    return {
                      results: data,
                      pagination: {
                          more: (params.page * 30) < data.total_count
                      }
                    };
                }
            },
        });

    });

</script>
@endpush
