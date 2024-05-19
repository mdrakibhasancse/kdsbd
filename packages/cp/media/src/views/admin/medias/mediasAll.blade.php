@extends('admin::layouts.adminMaster')
@section('title')
    | Medias All
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
                        class="fas fa-images text-primary"></i> Media Images
                    </h3>
                </div>
            </div>
            <div class="card w3-round mb-2 shadow-lg">
                <div class="card-body px-3 py-1 w3-light-gray">
                    <form action="{{ route('admin.mediaStore') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-row mt-3">
                            <div class="form-group input-group-sm w3-small col-md-10 row">
                                <div class="col-6">
                                    <label for="menu_title_en" class="text-muted mt-2">Upload One or Multiple Image:<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-6 input-group-sm w3-small">
                                    <input type="file" name="files[]" placeholder="File" class="form-control" id="files" multiple="" required>
                                    @if ($errors->has('files'))
                                        <span class="error-message-color">
                                        <strong>{{ $errors->first('files') }}</strong>
                                        </span>
                                    @endif
                                  
                                </div>
                            </div>
                            <div class="form-group input-group-sm col-md-2 w3-small">
                                <button type="submit" class="btn btn-primary btn-sm float-right mt-1">Add Image</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-lg">
            <div class="card-header pl-2 py-2">
                <h3 class="card-title w3-small text-bold"><i class="fas fa-images text-primary"></i> All Media Images</h3>
            </div>
            <div class="card-body px-2 py-2 w3-light-gray">
                @if ($medias->count())
                    @foreach ($medias->chunk(2) as $media2)
                        <div class="row">
                            @foreach ($media2 as $media)
                                <div class="col-sm-6 mt-2">
                                    <div class="card card-default mb-0 shadow-lg">
                                        <div class="card-body p-1">
                                            <div class="media">
                                                <img src="{{ route('imagecache', ['template' => 'ppsm', 'filename' => $media->fi()]) }}" alt="">
                                                <div class="media-body  w3-display-container ml-2">
                                                    <p class="w3-small mb-1">
                                                        {{ Str::limit($media->file_name,50) }} <br>
                                                        <i class="w3-tiny">Size: {{ human_filesize($media->file_size) }},
                                                        Width: {{ $media->width }}px,
                                                        Height: {{ $media->height }}px, <i class="far fa-clock"></i> {{ $media->created_at }}</i> <br>
                                                        <small>{{ route('imagecache', [ 'template'=>'original','filename' => $media->fi() ]) }} </small> <br>
                                                        
                                                        <button class="copyboard btn btn-outline-primary btn-xs"
                                                        data-text="{{ asset('/storage/media_images/'.$media->file_name) }}">Copy to Clipboard</button>
                                                    </p>

                                                    <div class="w3-display-topright">
                                                        <a onclick="return confirm('Do you really want to delete this media image?');" class="w3-btn w3-text-red px-1 btn-xs mr-2 mt-1" title="Delete" href="{{ route('admin.mediaDelete',$media->id)}}"><i class="fa fa-times"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                    <div class="float-right pt-2">
                        {!! $medias->links() !!}
                    </div>
                @endif
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

            $(".copyboard").text('Copy to Clipboard');
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
