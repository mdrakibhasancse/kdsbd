@extends('admin::layouts.adminMaster')
@section('title')
    | Product Category Create
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
                    class="fas fa-plus-circle text-primary"></i> Add New Category</h3>
                    <div class="card-tools w3-small">
                      <a href="{{ route('admin.productCategoriesAll')}}" class="btn btn-outline-primary btn-xs pull-right mr-2"> <i class="fa fa-arrow-left"></i>&nbsp;Back</a>
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline w3-round mb-2 shadow-lg">
                <div class="card-body px-3 py-1 w3-light-gray">
                    <form class="" action="{{route('admin.productCategoryStore')}}" method="POST" enctype="multipart/form-data">
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
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group row">
                                <label for="excerpt" class="col-sm-3 col-form-label text-left">Excerpt</label>
                                <div class="col-sm-9">
                                <textarea  name="excerpt" id="excerpt"
                                    class="form-control" rows="1" placeholder="excerpt...">{{ old('excerpt') }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                            <label for="image" class="col-sm-3 col-form-label text-left">Featured Image</label>
                            <div class="col-sm-9">
                                <input type="file" name="image" id="image" class="form-control"> 
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

@endpush
