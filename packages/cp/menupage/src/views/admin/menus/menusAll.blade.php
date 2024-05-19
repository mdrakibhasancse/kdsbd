@extends('admin::layouts.adminMaster')
@section('title')
    | Menus All
@endsection

@push('css')
@endpush

@section('content')
<section class="content py-3">
    <div class="row w3-animate-zoom">
        <div class="col-md-11 mx-auto">
            <div class="card mb-2 shadow-lg">
                <div class="card-header px-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted pt-1"><i
                    class="fas fa-sitemap text-primary"></i> Menus</h3>
                    <div class="card-tools w3-small">
                     
                    </div>
                </div>
            </div>
            <div class="card w3-round mb-2 shadow-lg">
                <div class="card-body px-3 py-1 w3-light-gray">
                    <form class="" action="{{route('admin.menuStore')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row ">
                            <div class="form-group input-group-sm w3-small col-md-3">
                                <label class="text-muted" for="name">Name </label>
                                <input type="text" name="name" value="{{ old('name')}}" id="name" placeholder="Name..."  class="form-control" required>
                                @error('name')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                         
                            <div class="form-group input-group-sm col-md-3 w3-small">
                              <label for="">Menu Type</label>
                              <select name="type" id="type" class="form-control">
                                  <option value="">select menu type</option>
                                  @foreach (config('parameter.menu_type') as $item)
                                      <option value="{{ $item }}" {{ old('menu_type') == $item  ? 'selected' : ' '}}>{{ $item }}</option>
                                    @endforeach
                              </select>
                              @error('type')
                              <span style="color:red">{{ $message }}</span>
                              @enderror
                            </div>

                           <div class="form-group input-group-sm w3-small col-md-3">
                                <label class="text-muted" for="link">Link</label>
                                <input type="text" name="link" value="{{ old('link')}}" id="link" class="form-control"
                                    placeholder="https://example.com/go"> <br>
                            </div>
                            
                            <div class="form-group input-group-sm col-md-1 w3-small mt-4 active_checkbox">
                                <input class="form-check-input" name="active" type="checkbox" id="active">
                                <label for="active" role="button">Active</label>
                            </div>

                            <div class="form-group input-group-sm w3-small col-md-2 mt-1">
                                <label for=""> &nbsp; </label>
                                <button type="submit" class="btn btn-primary btn-xs btn-block py-2">Submit</button>
                            </div>

                        </div>
          
                    </form>
                </div>
            </div>
            <div class="card  shadow-lg w3-round">
            <div class="card-header pl-2 py-2">
                <h3 class="card-title w3-small text-bold text-muted pt-1"><i class="fas fa-th text-primary"></i> All Menus</h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm">
                        <input class="form-control border-right-0 border text-muted menupage-search" type="search" data-url="{{ route('admin.menupageSearch', ['type' => 'menu']) }}" placeholder="Search name, id..." >
                        <span class="input-group-append">
                            <div class="input-group-text bg-transparent"><i class="fa fa-search w3-text-orange"></i></div>
                        </span>
                    </div>
                </div>
            </div>
            <div class=" card-body bg-light px-0 pt-1 pb-0">
                <div class="showMenu col-sm-12 connectedSortable data-container" id="sortablePanel" data-url="{{ route('admin.menuSort') }}">
                    @include('menupage::admin.menus.searchData')
                    <div class="w3-small">
                        {!! $menus->links() !!}
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
            $("#sortablePanel").sortable({

              connectWith: ".connectedSortable",
              distance: 5,
              delay: 300,
              opacity: 0.6,
              cursor: 'move',

              update: function() {
                  var order = $('#sortablePanel').sortable('toArray'),
                      url = $("#sortablePanel").attr('data-url');
                  $.ajax({
                      url: url,
                      type: 'get',
                      cache: false,
                      dataType: 'json',
                      data: {
                          sorted_data: order
                      },
                      success: function(response) {
                          if (response.success == true) {} else {
                              alert('fail');
                          }
                      },
                      error: function() {}
                  }); //ajax
              }
            }).disableSelection();



            $(document).on('click', '.copyboard', function(e) {
                e.preventDefault();
                $(".copyboard").text('Copy url');
                $(this).text('Coppied!');
                var copyText = $(this).attr('data-text');
                alert(copyText);

                var textarea = document.createElement("textarea");
                textarea.textContent = copyText;
                textarea.style.position = "fixed";
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand("copy");

                document.body.removeChild(textarea);
            });

            $(document).on('keyup', ".menupage-search", function(e){
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
    </script>
@endpush
