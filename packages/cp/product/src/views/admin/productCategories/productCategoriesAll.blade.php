@extends('admin::layouts.adminMaster')
@section('title')
    | Product Categories All
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
                            class="fas fa-sitemap text-primary"></i> Categories</h3>
                    <div class="card-tools w3-small">

                        <a href="{{ route('admin.productCategoryCreate')}}" class="btn btn-outline-primary btn-xs pull-right mr-2 py-1"><i class="fas fa-plus-square"></i>&nbsp;Add New Category</a>
                    </div>
                </div>
            </div>
            
            <div class="card w3-round shadow-lg">
                <div class="card-header pl-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted"><i class="fas fa-th text-primary pt-1"></i> All Categories </h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <input type="search" name="q" class="category-search form-control border-right-0 border py-2" data-url="{{ route('admin.productSearch' , ['type' => 'category']) }}"  placeholder="Search name, id...">
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
                        <div class="table-responsive data-container">
                            @include('product::admin.productCategories.searchData')
                        </div>
                        <div class="w3-small float-right pt-1">
                            {!! $categories->links() !!}
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
      $(document).on('click', ".categoryStatus", function(e){
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

      $(document).on('keyup', ".category-search", function(e){
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
    });


   function makeSlug(val) {
        let str = val;
        let output = str.replace(/\s+/g, '-').toLowerCase();
        $('#slug').val(output);
    }

  </script>
@endpush

