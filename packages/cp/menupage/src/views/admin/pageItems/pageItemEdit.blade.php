@extends('admin::layouts.adminMaster')
@section('title')
    | Pages Edit
@endsection

@push('css')
@endpush

@section('content') 
  
 <section class="content py-3">
    <div class="col-md-11 mx-auto">
        <div class="card mb-2 shadow-lg">
            <div class="card-header px-2 py-2">
                <h3 class="card-title w3-small text-bold text-muted pt-1"> <i
                        class="fas fa-file text-info"></i> Page-ID#{{  $pageItem->page->id }} 

                        <i class="w3-tiny">({{  $pageItem->page->name_en }})</i>

                        @if( $pageItem->page->name_bn) | <i class="w3-tiny">({{ $pageItem->page->name_en }})</i>@endif
                    
                    </h3>
                    <div class="card-tools w3-small">

                        @if ($pageItem->page->link)
                            <button class="copyboard btn btn-xs badge badge-primary text-white"
                                data-id="{{ $pageItem->page->id }}" data-text="{{ $pageItem->page->link }}">
                                Copy url
                            </button>
                            <a target="_blank" href="{{ $pageItem->page->link }}" class="badge badge-primary">View</a>
                        @else
                            <button class="copyboard btn btn-xs badge badge-primary text-white"
                                data-id="{{  $pageItem->page->id }}"
                                data-text="">
                                Copy url
                            </button>
                            <a target="_blank" href="" class="badge badge-primary ">View</a>
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

        <div class="mx-auto">
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
                              
                                    <div class="form-group">
                                        <label for="name_en">Title English</label>
                                        <input type="text" name="name_en" value="{{ $pageItem->name_en }}" class="form-control" placeholder="Name English">
                                        @error('name_en')
                                        <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="name_bn">Title (বাংলা)</label>
                                        <input type="text" name="name_bn" value="{{ $pageItem->name_en }}" class="form-control" placeholder="Name English">
                                    </div>
        
                                    <div class="form-group">
                                        <label for="">Description English</label>
                                        <textarea name="description_en"
                                        @if($pageItem->editor)
                                            class="summernote form-control"
                                        @else
                                            class="summernote- form-control"
                                        @endif
                                        rows="5">{{ $pageItem->description_en  }}</textarea>
                                        @error('description_en')
                                        <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description_bn">Description (বাংলা)</label>
                                        <textarea name="description_bn"
                                        @if($pageItem->editor)
                                            class="summernote form-control"
                                        @else
                                            class="summernote- form-control"
                                        @endif
                                        rows="5">{{ $pageItem->description_bn  }}</textarea>
                                    </div>
        
                                   
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
