@extends('admin::layouts.adminMaster')
@section('title')
    | Deal Edit
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
                    class="fas fa-edit text-primary"></i> Edit Deal</h3>
                    <div class="card-tools w3-small">
                      <a href="{{ route('admin.dealsAll', $deal->branch_id)}}" class="btn btn-outline-primary btn-xs pull-right mr-2"> <i class="fa fa-arrow-left"></i>&nbsp;Back</a>
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline">
              
              <div class="card-body w3-light-gray">
                <form action="{{ route('admin.dealUpdate', $deal) }}" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="card-body">
                    <div class="form-group row">
                        <label for="title" class="col-sm-3 col-form-label text-left">Title</label>
                        <div class="col-sm-9">
                            <input type="text" name="title" value="{{ $deal->title ?? old('title') }}" id="title" placeholder="Title" class="form-control" required>
                        </div>
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group row">
                        <label for="excerpt" class="col-sm-3 col-form-label text-left">Excerpt</label>
                        <div class="col-sm-9">
                        <textarea  name="excerpt" id="excerpt"
                            class="form-control" rows="1" placeholder="excerpt...">{{ $deal->excerpt }}</textarea>
                        </div>
                    </div>


                    <div class="form-group row">
                      <label for="image" class="col-sm-3 col-form-label text-left">Image</label>
                      <div class="col-sm-9">
                          <input type="file" name="image" id="image" class="form-control"> 
                      </div>
                    </div>
  
                    <div class="form-group row">
                      <label for="image" class="col-sm-3 col-form-label "></label>
                      <div class="col-sm-9">
                      <img  src="{{ route('imagecache', ['template' => 'ppxs', 'filename' => $deal->fi()]) }}" alt="">
                      </div>
                    </div>

                   

                    <div class="form-group row">
                      <label for="expired_date" class="col-sm-3 col-form-label text-left">Expired Date</label>
                      <div class="col-sm-9">
                        <input type="date" name="expired_date" 
                          value="{{ $deal->expired_date ? \Carbon\Carbon::parse($deal->expired_date)->format('Y-m-d') : '' }}" 
                          id="expired_date" class="form-control" placeholder="Expired Date">
                      </div>
                      @error('expired_date')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>


                    <div class="form-group row">
                        <div class="col-sm-3 col-form-label text-left">
                        <label for="active">Active</label>
                        </div>
                        <div class="col-sm-9">
                        <input class="form-check-input" name="active" type="checkbox" id="active" style="margin-left: 1px;"  {{ $deal->active ? 'checked' : '' }}>
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




