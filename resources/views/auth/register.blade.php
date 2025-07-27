<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Registration Page (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- AdminLTE Theme Style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition register-page">

    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ route('login') }}" class="h1"><b>Admin</b>LTE</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register a new membership</p>

                <!-- Registration Form -->
                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <!-- Name Input -->
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Full name"
                            value="{{ old('name') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <!-- Email Input -->
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email"
                            value="{{ old('email') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <!-- Nomor HP Input -->
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="no_hp" placeholder="Nomor HP"
                            value="{{ old('no_hp') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                    </div>
                    @error('no_hp')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <!-- Password Input -->
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <!-- Password Confirmation Input -->
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password_confirmation"
                            placeholder="Retype password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Terms Checkbox -->
                    <div class="row">
                        <div class="col-8 d-flex align-items-center">
                            <a href="{{ route('login') }}" class="btn btn-link">Sudah punya akun? Login</a>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>


                </form>
            </div>
        </div>
    </div>


    <!-- jQuery -->
    <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
</body>

<!-- Tambahkan SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
@endif

</html>
