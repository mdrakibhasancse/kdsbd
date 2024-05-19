@extends('admin::layouts.adminMaster')
@section('title')
    | Language Create
@endsection

@push('css')
@endpush

@section('content')

    <br>

    <section>
        <div class="container">
            <div class="card">
            <div class="card-header bg-card">
                <div class="card-title">Create Language</div>
            </div>
            <div class="card-body w3-light-gray">
                <form action="{{ route('admin.languageStore') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row py-2">
                        <div class="col-md-6 m-auto card p-5">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control @error('title') is_invalid @enderror" id="title" placeholder="Title.." name="title" value="{{ old('title') }}">
                                @error('title')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Language Code</label>
                                <input type="text" class="form-control @error('code') is_invalid @enderror" id="code" placeholder="Language code" name="code" value="{{ old('code') }}">
                                @error('code')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                           <div class="form-group">
                            <input type="submit" class="btn btn-primary float-right" value="Save">
                           </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        </div>
    </section>

@endsection



@push('js')
    <script>

    </script>
@endpush
