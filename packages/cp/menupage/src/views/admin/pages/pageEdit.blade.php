@extends('admin::layouts.adminMaster')
@section('title')
    | Page Edit
@endsection

@push('css')
@endpush
@section('content')
<section class="content py-3">
  <div class="row">
    <div class="col-md-11 w3-animate-zoom mx-auto">
        <div class="card mb-2 shadow-lg">
            <div class="card-header px-2 py-2">
                 <h3 class="card-title w3-small text-bold text-muted" style="padding-top: 3px;"> <i class="fas fa-file text-info"></i> Page Edit: Page_id#{{ $page->id }} <i
                class="w3-tiny">({{ $page->localeNameShow() }})</i></h3>
                <div class="card-tools w3-small">
                    <a href="{{ route('admin.menusAll')}}"
                    class="btn btn-outline-primary btn-xs pull-right mr-2 py-1"><i class="fas fa-plus-square"></i> Menus</a>
                </div>
            </div>
        </div>
        <div class="card w3-round mb-2 shadow-lg">
            <div class="card-body px-3 pb-0 pt-1 w3-light-gray">
                  <form action="{{ route('admin.pageUpdate',$page->id)}}" method="POST">
                    @csrf
                    <div class="form-row">
                        
                    @foreach (Cp\Language\Models\Language::where('active', 1)->get() as $key => $language)
                        <div class="form-group input-group-sm w3-small col-md-6">
                          <label class="text-muted" for="name">Page Name {{$language->title}}</label>
                          <input type="text" name="name[{{$language->language_code}}]" value="{{ $page->localeName($language->language_code) }}" class="form-control" placeholder="Enter name {{$language->title}}">
                            @error('name')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group input-group-sm w3-small col-md-6">
                          <label class="text-muted" for="">Excerpt {{$language->title}}</label>
                          <textarea name="excerpt[{{$language->language_code}}]" id="excerpt" class="form-control" rows="1" placeholder="Enter Excerpt {{$language->excerpt}}">{{ $page->localeExcerpt($language->language_code)  }}</textarea>
                        </div>

                     @endforeach

                        <div class="form-group input-group-sm w3-small col-md-12">
                            <label for="link" class="text-muted">Link (URL) </label>
                            <input type="text" step="1" class="form-control"
                            id="link" name="link" value="{{ $page->link}}" placeholder="https://example.com/go">
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
                                                value="{{ $menu->id }}" {{ in_array($menu->id,$page->menus()->pluck('menu_id')->toArray()) ? 'checked': " "}}>
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
                            <input class="form-check-input" name="active" type="checkbox" id="active" @if($page->active == 1) checked @endif>
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
