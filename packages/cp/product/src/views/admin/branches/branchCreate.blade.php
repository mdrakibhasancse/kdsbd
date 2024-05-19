@extends('admin::layouts.adminMaster')
@section('title')
    | Branch Create
@endsection

@push('css')
@endpush

@section('content') 
  <section class="content py-3">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card mb-2 shadow-lg">
                <div class="card-header px-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted pt-1"><i
                    class="fas fa-plus-circle text-primary"></i> Add New Branch</h3>
                    <div class="card-tools w3-small">
                      <a href="{{ route('admin.branchesAll')}}" class="btn btn-outline-primary btn-xs pull-right mr-2"> <i class="fa fa-arrow-left"></i>&nbsp;Back</a>
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline w3-round mb-2 shadow-lg">
                <div class="card-body px-3 py-1 w3-light-gray">
                    <form class="" action="{{route('admin.branchStore')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                              <label for="title" class="col-sm-3 col-form-label text-left">Name English</label>
                              <div class="col-sm-9">
                                  <input type="text" name="name_en" value="{{ old('name_en') }}" id="name_en" placeholder="Name English" class="form-control" required>
                              </div>
                              @error('name_en')
                              <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label text-left">Name (বাংলা)</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name_bn" value="{{ old('name_bn') }}" id="name_bn" placeholder="Name (বাংলা)" class="form-control">
                                </div>
                               
                            </div>


                            <div class="form-group row">
                                <label for="division" class="col-sm-3 col-form-label text-left">{{ __('Division') }}
                                    <span class="text-danger"></span>
                                </label>

                                <div class="col-sm-9">
                                <select name="division_id" id="division_id"
                                        class="form-control div-select @error('division_id') is-invalid @enderror ">
                                    <option value="">Select Division</option>
                                    @foreach ($divisions as $division)
                                        <option {{old('division_id') == $division->id ? 'selected':''}} value="{{ $division->id }}">{{ $division->name }}</option>
                                    @endforeach
                                </select>

                                @error('division_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                                
                            </div>

                            <div class="form-group row">
                                <label for="district" class="col-sm-3 col-form-label text-left">{{ __('District') }}
                                    <span class="text-danger"></span>
                                </label>

                                <div class="col-sm-9">
                                <select name="district_id" id="district_id"
                                    class="form-control  dist-select @error('district_id') is-invalid @enderror ">
                                    <option value="">Select District</option>
                                </select>

                                @error('district_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label text-left">{{ __('Thana') }}
                                    <span class="text-danger"></span>
                                </label>
                                <div class="col-sm-9">
                                <select name="thana_id" id="thana_id"
                                    class="form-control thana-select @error('thana_id') is-invalid @enderror ">
                                    <option value="">Select Thana</option>
                                </select>

                                @error('thana_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                                
                            </div>
                            

                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label text-left">
                                <label for="active" role="button">Active</label>
                                </div>
                                <div class="col-sm-9">
                                <input class="form-check-input" name="active" type="checkbox" id="active" style="margin-left: 1px;" checked>
                                </div>
                            </div>

                            <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9 text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
           
        </div>
    </div>
  </section>

@endsection



@push('js')
    <script>
        $(document).ready(function () {
            var dists = <?php echo json_encode($districts); ?>;
            var thanas = <?php echo json_encode($thanas); ?>

            $(document).on("change", ".div-select", function (e) {
                // e.preventDefault();

                var that = $(this);
                var q = that.val();

                 that.closest('form').find(".dist-select").empty().append($('<option>', {
                    value: '',
                    text: 'District'
                }));

                that.closest('form').find(".thana-select").empty().append($('<option>', {
                    value: '',
                    text: 'Thana'
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
