@extends('frontend::layouts.pageMaster')

@push('css')

    
@endpush

@section('content')
 	  <div class="container py-5">
        <div class="row">
            @foreach ($categories as $category)
            <div class="col-6 col-lg-3 mb-1">
                <a href="{{route("category",$category->slug)}}">
                <div class="info-box w3-white w3-border w3-border-indigo w3-hover-border-green w3-round-large py-1 px-2 py-3">
                    <img class="w3-round" src="{{ route('imagecache', ['template' => 'ppsm', 'filename' => $category->fi()]) }}" alt="">
                    <div class="info-box-content px-3">
                        <h4 class="font1 line-height-1 ls-10">{{$category->name_en}} </h4>
                    </div>
                    <!-- End .info-box-content -->
                </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
@endsection

@push('js')
@endpush