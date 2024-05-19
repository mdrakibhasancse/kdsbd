@extends('admin::layouts.adminMaster')
@section('title')
    | Branches All
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
                            class="fas fa-code-branch text-primary"></i> Branches</h3>
                    <div class="card-tools w3-small">

                        <a href="{{ route('admin.branchCreate')}}" class="btn btn-outline-primary btn-xs pull-right mr-2 py-1"><i class="fas fa-plus-square"></i>&nbsp;Add New Branch</a>
                    </div>
                </div>
            </div>
            
            @foreach ($branches->chunk(4) as $branch4)
                <div class="row">
                    @foreach ($branch4 as $branch)
                        <div class="col-md-3 col-sm-6 col-12">
                            {{-- {{ route('admin.branchShow', $branch)}} --}}
                            <a href="{{route('admin.branchArea', $branch)}}">
                                <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fas fa-code-branch text-white"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text w3-medium font-weight-bold">{{$branch->name_en}}
                                    </span>
                                </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach

            {{ $branches->links() }}
        </div>
    </div>
</section>
@endsection





