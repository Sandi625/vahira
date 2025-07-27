<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vahira Project</title>
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- WhatsApp Floating Icon -->
<a href="https://wa.me/6281234567890" class="wa-float" target="_blank">
    <img src="https://img.icons8.com/color/48/000000/whatsapp--v1.png" alt="WhatsApp">
</a>



</head>
<style>
    .wa-float {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 999;
        background-color: #25D366;
        padding: 10px;
        border-radius: 50%;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
    }

    .wa-float img {
        width: 40px;
        height: 40px;
    }
</style>


<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">
        <!-- Include Navbar -->
        @include('layout.navbar2')

        <!-- Include Sidebar -->
        @include('layout.sidebar2')

        <div class="content-wrapper">
            <!-- Main content section -->
            @yield('content')
        </div>
    </div>

  <!-- Script bawaan -->
<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@yield('scripts') {{-- PENTING --}}
</body>




</html>
