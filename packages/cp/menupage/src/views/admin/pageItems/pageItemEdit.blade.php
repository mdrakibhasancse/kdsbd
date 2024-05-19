@extends('admin::layouts.adminMaster')
@section('title')
    | Pages Edit
@endsection

@push('css')
@endpush

@section('content') 
  
 <section class="content py-3">
    <div class="col-md-11 w3-animate-zoom mx-auto">
        <div class="card mb-2 shadow-lg">
            <div class="card-header px-2 py-2">
                <h3 class="card-title w3-small text-bold text-muted pt-1"> <i
                        class="fas fa-file text-info"></i> Page-ID#{{  $pageItem->page->id }} <i
                        class="w3-tiny">({{  $pageItem->page->name }})</i></h3>
                <div class="card-tools w3-small">

                    @if ( $pageItem->page->link)
                        <button class="copyboard btn btn-xs badge badge-primary text-white"
                            data-id="{{ $pageItem->page->id }}" data-text="{{ $pageItem->page->link }}">
                            Copy url
                        </button>
                        <a target="_blank" href="{{ $pageItem->page->link }}" class="badge badge-primary">View</a>
                    @else
                        <button class="copyboard btn btn-xs badge badge-primary text-white"
                            data-id="{{  $pageItem->page->id }}"
                            data-text="{{ route('page', ['id' =>  $pageItem->page->id, 'slug' => page_slug( $pageItem->page->name)])}}">
                            Copy url
                        </button>
                        <a target="_blank"
                            href="{{ route('page', ['id' =>  $pageItem->page->id, 'slug' => page_slug( $pageItem->page->name)])}}"
                            class="badge badge-primary ">View</a>
                    @endif

                    <a class="btn-outline-primary btn btn-xs py-1"
                        href="{{ route('admin.pageEdit', $pageItem->page->id)}}">Edit Page<a>

                    <a href="{{route('admin.pagesAll')}}"
                        class="btn btn-outline-secondary btn-xs pull-right mr-0 py-1">Pages</a>

                    <a href="{{ route('admin.menusAll')}}"
                        class="btn btn-outline-secondary btn-xs pull-right mr-2 py-1">Menus</a>
                </div>
            </div>
        </div>

        <div class="w3-animate-zoom mx-auto">
            <div class="card mb-2 shadow-lg">
                <div class="card-header px-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted pt-1"> <i
                            class="fas fa-edit text-info"></i> Edit Page Item</h3>
                </div>
            </div>
            <div class="card w3-round mb-2 shadow-lg">
                <div class="card-body px-2 py-2 w3-light-gray">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="card card-default">
                            <div class="card-body">

                                <form method="post" action="{{route('admin.pageItemUpdate',$pageItem->id)}}">
                                @csrf
                                <input type="hidden" name="page_id" value="{{ $pageItem->page->id }}">
                                @foreach (Cp\Language\Models\Language::where('active', 1)->get() as $key => $language)
                                    <div class="form-group">
                                        <label for="name">Item Title {{$language->title}}</label>
                                        <input type="text" name="name[{{$language->language_code}}]" value="{{ $pageItem->localeName($language->language_code) }}" class="form-control" placeholder="Enter name {{$language->title}}">
                                        @error('name')
                                        <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
        
                                    <div class="form-group">
                                        <label for="">Description {{$language->title}}</label>
                                        <textarea name="description[{{$language->language_code}}]"
                                        @if($pageItem->editor)
                                            class="summernote form-control"
                                            @else
                                            class="summernote- form-control"
                                            @endif
                                            rows="5">{{ $pageItem->localeDescription($language->language_code)  }}</textarea>
                                    </div>
        
                                    @endforeach

                                
                                <div class="form-row mt-n2 mb-n3">
                                    <div class="col-md-6"></div>
                                        <div class="form-group input-group-sm col-md-2 w3-small pt-3">
                                            <input class="form-check-input"  type="checkbox" name="active" {{ $pageItem->active == 1 ? 'checked' : '' }}>
                                            <label for="active" role="button">Active</label>
                                        </div>

                                        <div class="form-group input-group-sm col-md-2 w3-small pt-3">
                                            <input class="form-check-input" type="checkbox" name="editor" {{  $pageItem->editor == 1 ? 'checked' : '' }}>
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
