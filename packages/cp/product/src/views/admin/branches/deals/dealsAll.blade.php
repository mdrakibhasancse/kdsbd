@extends('admin::layouts.adminMaster')
@section('title')
    | Deals All
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
                    class="fas fa-sitemap text-primary"></i> Deals</h3>
                    <div class="card-tools w3-small">
                       
                    </div>
                </div>
            </div>
            <div class="card w3-round mb-2 shadow-lg">
                <div class="card-body px-3 py-1 w3-light-gray">
                    <form class="" action="{{route('admin.dealStore', ['branch' => $branch])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group input-group-sm w3-small col-md-4">
                                <label class="text-muted" for="title">Title</label>
                                <input type="text" name="title" value="{{ old('title')}}" id="title" placeholder="Title"  class="form-control" required>
                                @error('title')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                           

                           <div class="form-group input-group-sm w3-small col-md-4">
                                <label class="text-muted" for="excerpt">Excerpt</label>
                                <textarea  name="excerpt" id="excerpt"
                                class="form-control" rows="1" placeholder="excerpt...">{{ old('excerpt') }}</textarea>
                            </div>

                            <div class="form-group input-group-sm w3-small col-md-4">
                                <label for="image" class="text-muted">Image Name</label>
                                <input type="file" name="image" id="image" class="form-control" required> 
                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                       
                            <div class="form-group input-group-sm w3-small col-md-4">
                                <label class="text-muted" for="expired_date">Expired Date</label>
                                <input type="date" name="expired_date" value="{{ old('expired_date')}}" id="expired_date" class="form-control"
                                    placeholder="expired date">
                                @error('expired_date')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        
                            <div class="form-group input-group-sm w3-small col-md-2 mt-1">
                                <label for=""> &nbsp; </label>
                                <button type="submit" class="btn btn-primary btn-xs btn-block py-2">Submit</button>
                            </div>
                        </div>
          
                    </form>
                </div>
            </div>
            <div class="card shadow-lg w3-round">
            <div class="card-header pl-2 py-2">
                <h3 class="card-title w3-small text-bold text-muted pt-1"><i class="fas fa-th text-primary"></i> All Deals</h3>
                <div class="card-tools">
                </div>
            </div>
            <div class=" card-body bg-light px-0 pt-1 pb-0">
                <div class="showMenu col-sm-12 data-container" id="">
                    @include('product::admin.branches.deals.searchData')
                    <div class="w3-small">
                        {!! $deals->links() !!}
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
         $( document ).ready(function() {
            $(document).on('click', ".dealStatus", function(e){
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
