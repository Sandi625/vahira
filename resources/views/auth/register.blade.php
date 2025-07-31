<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #e0eafc, #cfdef3);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: #ffffff;
            width: 400px;
            padding: 30px 25px;
            border-radius: 15px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
            background-color: #f9f9f9;
        }

        input:focus {
            border-color: #00BFFF;
            outline: none;
        }

        .text-danger {
            font-size: 12px;
            color: #e53935;
            margin-top: -5px;
            margin-bottom: 5px;
        }

        .btn-register {
            width: 100%;
            padding: 10px;
            background: #00BFFF;
            color: white;
            font-weight: 500;
            font-size: 14px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 10px;
            transition: background 0.3s;
        }

        .btn-register:hover {
            background: #007bbf;
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
            font-size: 13px;
        }

        .login-link a {
            color: #00BFFF;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media screen and (max-width: 480px) {
            .container {
                width: 90%;
                padding: 25px 20px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Create Account</h2>
        <form action="{{ route('register') }}" method="POST">
            @csrf

            <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror

            <input type="text" name="alamat" placeholder="Alamat Lengkap" value="{{ old('alamat') }}" required>
            @error('alamat') <div class="text-danger">{{ $message }}</div> @enderror

            <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror

            <div class="input-group mb-3">
                <input type="text" class="form-control" name="no_hp" placeholder="Nomor HP" value="{{ old('no_hp') }}" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-phone"></span>
                    </div>
                </div>
            </div>
            @error('no_hp') <div class="text-danger">{{ $message }}</div> @enderror

            <input type="password" name="password" placeholder="Password" required>
            @error('password') <div class="text-danger">{{ $message }}</div> @enderror

            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

            <button type="submit" class="btn-register">Register</button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Login</a>
        </div>
    </div>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
    @endif

    <!-- jQuery -->
    <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
