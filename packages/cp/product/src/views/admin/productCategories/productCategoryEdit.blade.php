@extends('admin::layouts.adminMaster')
@section('title')
    | Product Category Edit
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
                    class="fas fa-edit text-primary"></i> Edit Category</h3>
                    <div class="card-tools w3-small">
                      <a href="{{ route('admin.productCategoriesAll')}}" class="btn btn-outline-primary btn-xs pull-right mr-2"> <i class="fa fa-arrow-left"></i>&nbsp;Back</a>
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline">
              
              <div class="card-body w3-light-gray">
                <form action="{{ route('admin.productCategoryUpdate', $category) }}" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="card-body">
                    <div class="form-group row">
                        <label for="title" class="col-sm-3 col-form-label text-left">Name English</label>
                        <div class="col-sm-9">
                            <input type="text" name="name_en" value="{{ $category->name_en ?? old('name_en') }}" id="name_en" placeholder="Name English" class="form-control" required>
                        </div>
                        @error('name_en')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="title" class="col-sm-3 col-form-label text-left">Name (বাংলা)</label>
                        <div class="col-sm-9">
                            <input type="text" name="name_bn" value="{{ $category->name_bn ?? old('name_bn') }}" id="name_bn" placeholder="Name (বাংলা)" class="form-control">
                        </div>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label text-left">Slug</label>
                        <div class="col-sm-9">
                        <input type="slug" name="slug" value="{{ $category->slug }}" id="slug" placeholder="slug" class="form-control" required>
                        </div>
                        @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="excerpt" class="col-sm-3 col-form-label text-left">Excerpt</label>
                        <div class="col-sm-9">
                        <textarea  name="excerpt" id="excerpt"
                            class="form-control" rows="1" placeholder="excerpt...">{{ $category->excerpt }}</textarea>
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
                      <img  src="{{ route('imagecache', ['template' => 'ppxs', 'filename' => $category->fi()]) }}" alt="">
                      </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-3 col-form-label text-left">
                        <label for="active">Active</label>
                        </div>
                        <div class="col-sm-9">
                        <input class="form-check-input" name="active" type="checkbox" id="active" style="margin-left: 1px;"  {{ $category->active ? 'checked' : '' }}>
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
              <!-- /.card -->
            </div>
           
        </div>
    </div>
  </section>

@endsection




