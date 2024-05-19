@extends('admin::layouts.adminMaster')
@section('title')
    | Pages All
@endsection

@push('css')
@endpush

@section('content') 


<section class="content py-3">
  <div class="row">
    <div class="col-md-11 w3-animate-zoom mx-auto">
        <div class="card mb-2 shadow-lg">
            <div class="card-header px-2 py-2">
                <h3 class="card-title w3-small text-bold text-muted" style="padding-top: 3px;"> <i class="fas fa-file-alt text-info"></i> Pages</h3>
                <div class="card-tools w3-small">
                    <a href="" class="btn-create-from btn btn-outline-primary btn-xs pull-right mr-2 py-1"><i class="fas fa-plus-square"></i> Create New</a>
                    <a href="{{ route('admin.menusAll')}}"
                        class="btn btn-outline-secondary btn-xs pull-right mr-2 py-1"><i class="fas fa-plus-square"></i> Menus</a>
                </div>
            </div>
        </div>
        <div class="card w3-round mb-2 shadow-lg card-create-form-toggle" style="display: none;">
            <div class="card-body px-3 pb-0 pt-1 w3-light-gray">
                <form action="{{ route('admin.pageStore')}}" method="POST">
                    @csrf
                    <div class="form-row">
                        
                      @foreach (Cp\Language\Models\Language::where('active', 1)->get() as $key => $language)
                      <div class="form-group input-group-sm w3-small col-md-6">
                        <label for="">Page Name {{$language->title}}</label>
                          <input type="text" name="name[{{$language->language_code}}]" value="" class="form-control" placeholder="Enter Page Name {{$language->name}}">
                            @error('name')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group input-group-sm w3-small col-md-6">
                          <label for="">Excerpt {{$language->title}}</label>
                          <textarea name="excerpt[{{$language->language_code}}]" id="excerpt" class="form-control" rows="1" placeholder="Enter Excerpt {{$language->title}}">{{old('excerpt')}}</textarea>
                        </div>

                      @endforeach

                        <div class="form-group input-group-sm w3-small col-md-12">
                            <label for="link" class="text-muted">Link (URL) </label>
                            <input type="text" step="1" class="form-control"
                            id="link" name="link" placeholder="https://example.com/go">
                        </div>
                    </div>

                    <div class="from-row">
                        <div class="card bg-transparent">
                            <div class="card-header px-2 py-2">
                                <h3 class="card-title w3-small text-muted text-bold"> Select Menu</h3>
                            </div>
                            <div class="card-body px-3 pb-0 pt-1">
                                <div class="form-group m-0 p-0">

                                    <div class="row">
                                        @foreach ($menus as $menu)
                                            <div class="checkbox mr-2">
                                              <label class="w3-small">
                                              <input type="checkbox" name="menus[]"
                                                value="{{ $menu->id }}">
                                                {{ $menu->name }} <span
                                                class="w3-tiny">({{ $menu->type }})</span></label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row mt-n2 mb-n3">
                        <div class="col-md-9"></div>
                        <div class="form-group input-group-sm col-md-1 w3-small pt-3">
                            <input class="form-check-input" name="active" type="checkbox" id="active">
                            <label for="active" role="button">Active</label>
                        </div>
                    
                        <div class="form-group input-group-xs col-md-2 w3-small">
                            <label for=""> &nbsp; </label>
                            <button type="submit" class="btn btn-primary btn-sm btn-block mt-n3">Submit</button>
                        </div>
                    </div>
                    <br>
                </form>
            </div>
        </div>
        
        <div class="card w3-round shadow-lg">
            <div class="card-header pl-2 py-2">
                <h3 class="card-title w3-small text-bold text-muted"><i class="fas fa-th text-info"></i> All Pages</h3>
                <div class="card-tools">
                    {{-- <div class="input-group input-group-sm">
                        <input class="form-control border-right-0 border text-muted menupage-search" type="search" data-url="{{ route('admin.menupageSearch', ['type' => 'page']) }}" placeholder="Search name, id..." >
                        <span class="input-group-append">
                            <div class="input-group-text bg-transparent"><i class="fa fa-search w3-text-orange"></i></div>
                        </span>
                    </div> --}}
                </div>
            </div>
            <div class="card-body bg-light px-0 pb-0 pt-1">
                <div class="showEvent col-sm-12 connectedSortable data-container" id="sortablePanel"
                    data-url="{{ route('admin.pageSort') }}">
                      @include('menupage::admin.pages.searchData')
                    <div class="w3-small float-right mt-1">
                        {!! $pages->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.copyboard', function(e) {
                e.preventDefault();
                $(".copyboard").text('Copy url');
                $(this).text('Coppied!');
                var copyText = $(this).attr('data-text');


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
                    type: 'post',
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


    </script>

@endpush

