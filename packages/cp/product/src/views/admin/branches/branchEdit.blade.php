@extends('admin::layouts.adminMaster')
@section('title')
    | Branch Edit
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
                </div>
            </div>

            <div class="card card-primary card-outline">
              <div class="card-body w3-light-gray">
                <form action="{{ route('admin.branchUpdate', $branch) }}" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="card-body">
                    <div class="form-group row">
                      <label for="title" class="col-sm-2 col-form-label text-left">Name English</label>
                      <div class="col-sm-9">
                          <input type="text" name="name_en" value="{{ $branch->name_en ?? old('name_en') }}" id="name_en" placeholder="Name English" class="form-control" required>
                      </div>
                      @error('name')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="form-group row">
                      <label for="title" class="col-sm-2 col-form-label text-left">Name (বাংলা)</label>
                      <div class="col-sm-9">
                          <input type="text" name="name_bn" value="{{ $branch->name_bn ?? old('name_bn') }}" id="name_bn" placeholder="Name (বাংলা)" class="form-control">
                      </div>
                      @error('name_en')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    
                  

                      <div class="form-group row">
                        <label for="division" class="col-sm-2 col-form-label text-left">{{ __('Division') }}
                            <span class="text-danger"></span>
                        </label>

                        <div class="col-sm-9">
                        <select name="division_id" id="division_id" disabled
                                class="form-control div-select @error('division_id') is-invalid @enderror ">
                            <option value="">Select Division</option>
                            @foreach ($divisions as $division)
                                <option {{$branch->division_id == $division->id ? 'selected':''}} value="{{ $division->id }}">{{ $division->name }}</option>
                            @endforeach
                        </select>
                        @error('division_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        
                    </div>

                    <div class="form-group row">
                        <label for="district" class="col-sm-2 col-form-label text-left">{{ __('District') }}
                            <span class="text-danger"></span>
                        </label>
                          
                        
                        <div class="col-sm-9">
                        <select name="district_id" id="district_id" disabled
                            class="form-control  dist-select @error('district_id') is-invalid @enderror ">
                            <option value="">Select District</option>
                            <option selected value="{{ $branch->district_id }}">{{ $branch->district->name }}</option>


                        </select>
                        @error('district_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label text-left">{{ __('Thana') }}
                            <span class="text-danger"></span>
                        </label>
                        <div class="col-sm-9">
                        <select name="thana_id" id="thana_id" disabled
                            class="form-control thana-select @error('thana_id') is-invalid @enderror ">
                            <option value="">Select Thana</option>
                            <option selected value="{{ $branch->thana_id }}">{{ $branch->thana->name }}</option>
                        </select>
                        @error('thana_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        
                    </div>


                    <div class="form-group row">
                        <div class="col-sm-2 col-form-label text-left">
                        <label for="active">Active</label>
                        </div>
                        <div class="col-sm-9">
                        <input class="form-check-input" name="active" type="checkbox" id="active" style="margin-left: 1px;"  {{ $branch->active ? 'checked' : '' }}>
                        </div>
                    </div>

                    <div class="form-group row">
                      <label for="" class="col-sm-2 col-form-label"></label>
                      <div class="col-sm-9 text-right">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>
           
        </div>
    </div>
  </section>

@endsection

@push('js')
    
    <script type="text/javascript">
        $(document).ready(function () {
            var dists = <?php echo json_encode($districts); ?>;
            var thanas = <?php echo json_encode($thanas); ?>

            $(document).on("change", ".div-select", function (e) {
                // e.preventDefault();

                var that = $(this);
                var q = that.val();

                that.closest('form').find(".thana-select").empty().append($('<option>', {
                    value: '',
                    text: 'Thana'
                }));

                that.closest('form').find(".dist-select").empty().append($('<option>', {
                    value: '',
                    text: 'District'
                }));

                $.each(dists, function (i, item) {
                    if (item.division_id == q) {
                        that.closest('form').find(".dist-select").append(
                            "<option value='" + item.id + "'>" + item.name +
                            "</option>");
                    }
                });

                $.each(thanas, function (i, item) {
                    if (item.division_id == q) {
                        that.closest('form').find(".thana-select").append(
                            "<option value='" + item.id + "'>" + item.name +
                            "</option>");
                    }
                });

            });


            $(document).on("change", ".dist-select", function (e) {
                // e.preventDefault();

                var that = $(this);
                var q = that.val();

                that.closest('form').find(".thana-select").empty().append($('<option>', {
                    value: '',
                    text: 'Thana'
                }));

                $.each(thanas, function (i, item) {
                    if (item.district_id == q) {
                        that.closest('form').find(".thana-select").append(
                            "<option value='" + item.id + "'>" + item.name +
                            "</option>");
                    }
                });

            });


        });
    </script>
@endpush




