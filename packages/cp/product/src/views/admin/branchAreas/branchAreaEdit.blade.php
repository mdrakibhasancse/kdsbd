@extends('admin::layouts.adminMaster')
@section('title')
    | Branch Edit
@endsection

@push('css')
@endpush

@section('content') 
  <section class="content py-3">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card mb-2 shadow-lg">
                <div class="card-header px-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted pt-1"><i
                    class="fas fa-edit text-primary"></i> Edit Branch Area</h3>
                    <div class="card-tools w3-small">
                      <a href="{{ route('admin.branchArea', request()->branch)}}" class="btn btn-outline-primary btn-xs pull-right mr-2"> <i class="fa fa-arrow-left"></i>&nbsp;Back</a>
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline">
              <div class="card-body w3-light-gray">
                 <form class="" action="{{route('admin.branchAreaUpdate',$brancharea)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                            <label for="title">Name English</label>
                            <input type="text" name="name_en" value="{{ $brancharea->name_en ?? old('name_en') }}" id="name_en" placeholder="Name English" class="form-control" required>
                            @error('name_en')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="title">Name (বাংলা)</label>
                                <input type="text" name="name_bn" value="{{ $brancharea->name_bn ?? old('name_bn') }}" id="name_bn" placeholder="Name (বাংলা)" class="form-control">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="title">Delivery Charge</label>
                                <input type="number" name="delivery_charge" value="{{ $brancharea->delivery_charge ?? old('delivery_charge') }}" id="delivery_charge" placeholder="Delivery charge" class="form-control">
                            </div>


                            <div class="form-group col-md-1 mb-3 justify-content-center">
                                <div class="text-cnter" style="margin-bottom: 15px;">
                                <label for="active" role="button"></label>
                                </div>
                                <b>Active</b>
                                <input class="form-check-input" name="active" type="checkbox" id="active" {{ $brancharea->active == 1 ? 'checked' : ''}} style="margin-left: 5px;" checked>
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
              <!-- /.card -->
            </div>
           
        </div>
    </div>
  </section>

@endsection






