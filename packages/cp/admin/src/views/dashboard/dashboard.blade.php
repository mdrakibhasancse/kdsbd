@extends('admin::layouts.adminMaster')
@section('title')
    | Admin Dashboard | Media
@endsection

@push('css')
@endpush

@section('content')


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
   
      <div class="card">
       
  
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

@endsection

{{-- {{ $inst->theme == $theme ? 'btn-primary' : 'btn-outline-primary' }} --}}

@push('js')
    <script>

    </script>
@endpush
