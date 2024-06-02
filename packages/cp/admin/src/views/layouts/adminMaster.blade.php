<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>
    Admin @yield('title')
  </title>


  	<!-- Favicon -->
	<link rel="shortcut icon" href="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->favicon()]) }}" type="image/x-icon" />
	<link rel="apple-touch-icon" href="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->favicon()]) }}">
  <link rel="icon" href="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->favicon()]) }}" type="image/x-icon">

  <!-- w3 css -->
  <link rel="stylesheet" href="{{ asset('https://www.w3schools.com/w3css/4/w3.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/') }}alt/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/') }}alt/dist/css/adminlte.min.css">
  {{--Summernote--}}
  <link rel="stylesheet" href="{{ asset('/') }}alt/plugins/summernote/summernote-bs4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('/')}}alt/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{asset('/')}}alt/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  {{--switch button--}}
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('/') }}css/custom.css">

  @stack('css')

</head>
{{-- <body class="hold-transition sidebar-mini"> --}}


  
<body class="sidebar-mini hold-transition layout-fixed layout-navbar-fixed text-sm
{{ str_contains(url()->current(), 'admin/pos') ? 'sidebar-collapse' : '' }} ">
<!-- Site wrapper -->
<div class="wrapper">
  @include('admin::layouts.adminHeader')
  @include('admin::layouts.adminLeftSidebar')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    @include('sweetalert::alert')

    @yield('content')

  </div>
  <!-- /.content-wrapper -->

  @include('admin::layouts.adminFooter')


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('/') }}alt/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('/') }}alt/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/') }}alt/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/') }}alt/dist/js/adminlte.min.js"></script>

{{--summernote--}}
<script src="{{ asset('/') }}alt/plugins/summernote/summernote-bs4.min.js"></script>

{{--switch--}}
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<!-- Select2 -->
<script src="{{asset('/')}}alt/plugins/select2/js/select2.full.min.js"></script>
<script>
    $(function () {
        // Summernote
        $('.summernote').summernote({
            height: 200,
            tabsize: 2,
            codemirror: {
            mode: 'text/html',
            htmlMode: true,
            lineNumbers: true,
            theme: 'monokai'
            }
        });
    })
</script>

<script src="{{ asset('/') }}js/custom.js"></script>

@stack('js')

</body>
</html>
