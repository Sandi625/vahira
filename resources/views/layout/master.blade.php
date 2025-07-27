<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vahira Project</title>
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
    @include('layout.navbar')
    @include('layout.sidebar')

    <div class="content-wrapper">
        @yield('content')
    </div>
</div>

<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('AdminLTE/dist/js/adminlte.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> {{-- Load Chart.js sekali saja --}}
@yield('scripts') {{-- Ini tempat inject script chart kamu --}}
    @stack('scripts')

</body>
</html>
