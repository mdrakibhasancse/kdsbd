@extends('admin::layouts.adminMaster')
@section('title')
    | PageItem Create
@endsection

@push('css')
@endpush

@section('content') 
<section class="content py-3">

    <div class="col-md-11 w3-animate-zoom mx-auto">

            <div class="card mb-2 shadow-lg">
                <div class="card-header px-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted pt-1"> <i
                            class="fas fa-file text-info"></i> Page-ID#{{ $page->id }} <i
                            class="w3-tiny">({{ $page->localeNameShow() }})</i></h3>
                    <div class="card-tools w3-small">

                        @if ($page->link)
                            <button class="copyboard btn btn-xs badge badge-primary text-white"
                                data-id="{{ $page->id }}" data-text="{{ $page->link }}">
                                Copy url
                            </button>
                            <a target="_blank" href="{{ $page->link }}" class="badge badge-primary">View</a>
                        @else
                            <button class="copyboard btn btn-xs badge badge-primary text-white"
                                data-id="{{ $page->id }}"
                                data-text="{{ route('page', ['id' => $page->id])}}">
                                Copy url
                            </button>
                            <a target="_blank"
                                href="{{ route('page', ['id' => $page->id])}}"
                                class="badge badge-primary ">View</a>
                        @endif

                        <a class="btn-outline-primary btn btn-xs py-1"
                            href="{{ route('admin.pageEdit',$page)}}">Edit Page</a>

                        <a href="" class="btn-create-from btn btn-primary btn-xs pull-right mr-1 py-1"><i
                                class="fas fa-plus-square"></i> Create New Part</a>

                        <a href="{{route('admin.pagesAll')}}"
                            class="btn btn-outline-secondary btn-xs pull-right mr-1 py-1">Pages</a>

                        <a href="{{ route('admin.menusAll')}}"
                            class="btn btn-outline-secondary btn-xs pull-right mr-2 py-1">Menus</a>
                    </div>
                </div>
            </div>


            <div class="card w3-round shadow-lg">
                <div class="card-header">
                    <h3 class="card-title w3-small text-bold text-muted"><i class="fas fa-th text-primary"></i> All Page
                        Items
                    </h3>
                    <div class="card-tools">
                    </div>
                </div>
                <div class="card-body bg-light px-0 pb-0 pt-1 w3-light-gray">
                    <div class="showMenu col-sm-12 connectedSortable" id="sortablePanel">
                        @foreach ($page->pageItems as $item)
                            <div class="card mb-1 shadow" id="{{ $item->id }}">
                                <div class="card-header w3-small px-2 py-1">
                                    <i class="fas fa-arrows-alt-v text-muted" style="cursor: move;"></i>

                                    @if ($item->active)
                                        <i class="fas fa-check-square text-success" style="cursor: move;"></i>
                                    @else
                                        <i class="far fa-square w3-light-gray" style="cursor: move;"></i>
                                    @endif
                                    <span class="text-muted w3-small">{{ $item->name ?? '' }}
                                    </span>
                                    <a title="Delete" class="btn btn-default btn-xs float-right ml-1" onclick="return confirm('Do you really want to delete?')" href="{{ route('admin.pageItemDelete',$item)}}"><i class="fas fa-times-circle text-danger"></i></a>
                                    <a title="Edit" class="btn btn-default btn-xs float-right" href="{{ route('admin.pageItemEdit',$item)}}"> <i class="fas fa-edit text-muted"></i></a>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="w3-animate-zoom card-create-form-toggle mx-auto">
                <div class="card mb-2 shadow-lg">
                    <div class="card-header px-2 py-2">
                        <h3 class="card-title w3-small text-bold text-muted pt-1"> <i
                                class="fas fa-file-alt text-info"></i> Create Page Item</h3>
                    </div>
                </div>
                <div class="card w3-round mb-2 shadow-lg">
                    <div class="card-body px-2 py-2 w3-light-gray">
                      <div class="row">
                          <div class="col-sm-7">
                              <div class="card card-default">
                                <div class="card-body">

                                  <form method="post" action="{{route('admin.pageItemStore')}}">
                                   @csrf
                                    <input type="hidden" name="page_id" value="{{ $page->id }}">
                                    @foreach (Cp\Language\Models\Language::where('active', 1)->get() as $key => $language)
                                    <div class="form-group">
                                        <label for="title">Title {{$language->title}}</label>
                                        <input type="text" name="name[{{$language->language_code}}]" value="" class="form-control" placeholder="Enter Name {{$language->title}}" onkeyup="makeSlug(this.value)">
                                        @error('name')
                                        <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="">Excerpt {{$language->title}}</label>
                                        <textarea name="excerpt[{{$language->language_code}}]" id="excerpt" class="form-control" rows="3" placeholder="Enter Excerpt {{$language->title}}">{{old('excerpt')}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Description {{$language->title}}</label>
                                        <textarea name="description[{{$language->language_code}}]" class="summernote form-control"  rows="5" placeholder="Enter Description {{$language->title}}">{{old('description')}}</textarea>
                                    </div>

                                    @endforeach

                                    <div class="form-row mt-n2 mb-n3">
                                        <div class="col-md-6"></div>
                                            <div class="form-group input-group-sm col-md-2 w3-small pt-3">
                                                <input class="form-check-input"  type="checkbox" name="active" {{  old('active') == 1 ? 'checked' : '' }}>
                                                <label for="active" role="button">Active</label>
                                            </div>

                                            <div class="form-group input-group-sm col-md-2 w3-small pt-3">
                                                <input class="form-check-input" type="checkbox" name="editor" {{  old('editor') == 1 ? 'checked' : '' }}>
                                                <label for="editor" role="button">Editor</label>
                                               
                                            </div>
                                        
                                            <div class="form-group input-group-xs col-md-2 w3-small">
                                                <label for=""> &nbsp; </label>
                                                <button type="submit" class="btn btn-primary btn-sm btn-block mt-n3">Submit</button>
                                            </div>
                                    </div>

                                  </div>
                                </div>
                          </div>
                          <div class="col-sm-5">
                             @includeIf('media::admin.medias.mediaContainer')
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
           
         });
    </script>
@endpush
