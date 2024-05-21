@extends('frontend::layouts.pageMaster')
@section('title', 'page')


@section('content')
    <div class="container py-5">
        <div class="row py-4">
            <div class="col-lg-12">
                @foreach ($page->activePageItems() as $item)
                <p class="lead mb-0 text-4 text-justify-center">{!!  $item->description_en !!}</p>
                @endforeach			
							
            </div>

        </div>
    </div>
@endsection









