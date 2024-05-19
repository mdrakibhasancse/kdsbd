@extends('admin::layouts.adminMaster')
@section('title')
    | Roles Show
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
                    class="fas fa-sitemap text-primary"></i> Show Roles</h3>
                    <div class="card-tools w3-small"></div>
                </div>
            </div>
            <div class="card w3-round mb-2 shadow-lg">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Role:</strong>
                                {{ $role->name }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Permissions:</strong> <br>
                                
                            </div>



                            <div class="row">
                                @php
                                $i = 1;
                                @endphp
                                @foreach($rolePermissions->chunk(ceil($rolePermissions->count() / 2)) as $permission2)

                                    <div class="col-6">

                                        @foreach($permission2 as $permission)

                                        
                                            ({{ $i++ }}) {{ $permission->name }} <br>
                                    

                                            @if(str_contains($permission->name, 'delete'))
                                            <hr>
                                            @endif


                                        @endforeach
                                        
                                    </div>


                            
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
@endsection
