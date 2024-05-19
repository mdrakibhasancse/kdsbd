@extends('admin::layouts.adminMaster')
@section('title')
    | Product SubCategory Edit
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
                    class="fas fa-edit text-primary"></i> Edit SubCategory</h3>
                    <div class="card-tools w3-small">
                      <a href="{{ route('admin.productSubCategoriesAll')}}" class="btn btn-outline-primary btn-xs pull-right mr-2"> <i class="fa fa-arrow-left"></i>&nbsp;Back</a>
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline w3-round mb-2 shadow-lg">
                <div class="card-body px-3 py-1 w3-light-gray">
                    <form class="" action="{{route('admin.productSubCategoryUpdate',$subCategory)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label text-left">Name English</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name_en" value="{{ $subCategory->name_en ?? old('name_en') }}" id="name_en" placeholder="Name English" class="form-control" required>
                                </div>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label text-left">Name (বাংলা)</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name_bn" value="{{ $subCategory->name_bn ?? old('name_bn') }}" id="name_bn" placeholder="Name (বাংলা)" class="form-control">
                                </div>
                                @error('name_en')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label text-left" for="product_category_id">Category Select</label>
                            <div class="col-sm-9">
                              <select name="product_category_id" id="product_category_id" class="form-control">
                                <option value="">Category Select</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $subCategory->product_category_id == $category->id ? "selected" : '' }}>
                                      {{$category->name_en ?? $category->name_bn}}</option>
                                @endforeach
                              </select>
                              @error('product_category_id')
                                <span style="color:red">{{ $message }}</span>
                              @enderror
                            </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-sm-3 col-form-label text-left">Slug</label>
                                <div class="col-sm-9">
                                <input type="slug" name="slug" value="{{ $subCategory->slug ?? old('slug') }}" id="slug" placeholder="slug" class="form-control" required>
                                </div>
                                @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="excerpt" class="col-sm-3 col-form-label text-left">Excerpt</label>
                                <div class="col-sm-9">
                                <textarea  name="excerpt" id="excerpt"
                                    class="form-control" rows="1" placeholder="excerpt...">{{ $subCategory->excerpt ?? old('excerpt') }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                            <label for="image" class="col-sm-3 col-form-label text-left">Featured Image</label>
                            <div class="col-sm-9">
                                <input type="file" name="image" id="image" class="form-control"> 
                            </div>
                            </div>

                            <div class="form-group row">
                              <label for="image" class="col-sm-3 col-form-label "></label>
                              <div class="col-sm-9">
                              <img  src="{{ route('imagecache', ['template' => 'ppxs', 'filename' => $subCategory->fi()]) }}" alt="">
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
      function makeSlug(val) {
        let str = val;
        let output = str.replace(/\s+/g, '-').toLowerCase();
        $('#slug').val(output);
      }
    </script>
@endpush
