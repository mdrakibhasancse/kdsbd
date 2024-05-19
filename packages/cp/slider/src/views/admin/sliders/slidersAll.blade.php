@extends('admin::layouts.adminMaster')
@section('title')
    | Sliders All
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
                            class="fas fa-sitemap text-primary"></i> Sliders</h3>
                    <div class="card-tools w3-small">

                        <a href="" class="btn-create-from btn btn-outline-primary btn-xs pull-right mr-2 py-1"><i class="fas fa-plus-square"></i> Create New</a>
                        {{-- <a href="" class="btn btn-outline-secondary btn-xs pull-right mr-2 py-1"><i class="fas fa-plus-square"></i> Gallery</a> --}}
                    </div>
                </div>
            </div>
            <div class="card w3-round mb-2 shadow-lg card-create-form-toggle">
                <div class="card-body px-3 py-1 w3-light-gray">
                    <form class="" action="{{route('admin.sliderStore')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row ">
                            <div class="form-group input-group-sm w3-small col-md-4">
                                <label class="text-muted" for="title">Title </label>
                                <input type="text" name="title" value="{{ old('title')}}" id="title" placeholder="Title..."  class="form-control" required>
                                @error('title')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                         
                            <div class="form-group input-group-sm w3-small col-md-4 mb-0">
                                <label class="text-muted"  for="featured_image">Featured Image </label>
                                <input type="file" name="featured_image" id="featured_image" class="form-control w3-tiny"
                                    required> 
                                {{-- <i class="w3-tiny text-muted">(width:960px and height
                                320px)</i> --}}
                                @error('featured_image')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group input-group-sm w3-small col-md-4 mb-0">
                                <label class="text-muted" for="link">Link</label>
                                <input type="text" name="link" value="{{ old('link')}}" id="link" class="form-control"
                                    placeholder="https://example.com/go"> <br>
                            </div>

                            <div class="form-group input-group-sm w3-small col-md-7">
                                <label class="text-muted" for="description">Description</label>
                                <textarea  name="description" id="description"
                                class="form-control" rows="1" placeholder="Description..." required>{{ old('description')}}</textarea>
                            </div>
                            
                            <div class="form-group input-group-sm col-md-2 w3-small mt-4 active_checkbox  ml-4">
                                <input class="form-check-input" name="active" type="checkbox" id="active">
                                <label for="active" role="button" class="">Active</label>
                            </div>

                            <div class="form-group input-group-sm w3-small col-md-2 ">
                                <label for=""> &nbsp; </label>
                                <button type="submit" class="btn btn-primary btn-xs btn-block py-2">Submit</button>
                            </div>

                        </div>
          
                    </form>
                </div>
            </div>
            <div class="card w3-round shadow-lg">
                <div class="card-header pl-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted"><i class="fas fa-th text-primary pt-1"></i> All Sliders </h3>
                    <div class="card-tools">
                       

                        <div class="input-group input-group-sm">
                            <input type="search" name="q" class="slider-search form-control border-right-0 border py-2" data-url="{{ route('admin.sliderSearch') }}"  placeholder="Search title, id...">
                            <div class="input-group-append ">
                                <button type="submit" class="input-group-text bg-transparent">
                                <i class="fa fa-search w3-text-orange"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-light px-0 pb-0 pt-2">
                    <div class="col-sm-12">
                        <div class="table-responsive table-responsive-sm data-container">
                            @include('slider::admin.sliders.searchData')
                        </div>
                        <div class="w3-small float-right pt-1">
                            {!! $sliders->links() !!}
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
  $(document).ready(function () {
    $(document).on('keyup', ".slider-search", function(e){

        e.preventDefault();
        var that = $( this );
        var url = that.attr('data-url');
        var q = that.val();

        $.ajax({
              url: url,
              data : {q:q},
              method: "get",
              success: function(res)
              {
                if(res.success)
                {
                    $(".data-container").empty().append(res.page);
                }
              }
        });
    });


    $(document).on('click', ".sliderStatus", function(e){
        e.preventDefault();
        var that = $( this );
        var url = that.attr('data-url');
        $.ajax({
            url: url,
            method: "get",
            success: function(res)
            {
               if(res.active == true)
               {
                  that.removeClass('badge-danger').addClass('badge-primary');
                  that.text('Active');
               }
               else
               {
                  that.removeClass('badge-primary').addClass('badge-danger');
                  that.text('Inactive');
               }
            }
        });
    });

  });
</script>
@endpush
