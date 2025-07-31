<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Page v2</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">
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
      background: white;
      width: 900px;
      max-width: 100%;
      display: flex;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .signin {
      flex: 3;
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .signin h2 {
      margin-bottom: 20px;
    }

    .social-icons {
      display: flex;
      gap: 10px;
      margin-bottom: 15px;
    }

    .social-icons a {
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 8px 12px;
      text-decoration: none;
      color: #333;
      font-weight: bold;
      font-size: 16px;
    }

    input[type="email"], input[type="password"] {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border-radius: 8px;
      border: 1px solid #ddd;
      background: #f2f2f2;
    }

    .btn-signin {
      width: 100%;
      padding: 12px;
      border: none;
      background: #00BFFF;
      color: white;
      font-weight: bold;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .btn-signin:hover {
      background: #00BFFF;
    }

    .signup {
      flex: 2; /* lebih kecil daripada .signin */
      background: linear-gradient(to right, #00BFFF, #00BFFF);
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 20px;
    }

    .signup h2 {
      margin-bottom: 10px;
      font-size: 20px;
    }

    .signup p {
      margin-bottom: 20px;
      font-size: 14px;
      padding: 0 10px;
    }

    .signup .btn-signup {
      background: transparent;
      border: 2px solid white;
      color: white;
      padding: 8px 18px;
      border-radius: 25px;
      font-weight: bold;
      font-size: 14px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .signup .btn-signup:hover {
      background: white;
      color: #00BFFF;
    }

    .forgot {
      text-align: right;
      margin-bottom: 15px;
    }

    .forgot a {
      font-size: 14px;
      color: #555;
      text-decoration: none;
    }

    @media screen and (max-width: 768px) {
      .container {
        flex-direction: column;
      }

      .login, . {
        flex: 1 1 100%;
        width: 100%;
      }
    }
  </style>
</head>
<body>

<div class="container">
  <div class="signin">
    <h2 style="text-align: center;">Login</h2>
    {{-- <p>or use your email password</p> --}}

    <form action="{{ route('login') }}" method="POST">
      @csrf
      <label for="email" style="display: block; font-weight: 600; margin-bottom: 6px;">Email:</label>
      <input type="email" name="email" placeholder="Email" required />
      <label for="email" style="display: block; font-weight: 600; margin-bottom: 6px;">Password:</label>
      <input type="password" name="password" placeholder="Password" required />

      <div class="forgot">
        {{-- <a href="#">Forget Your Password?</a> --}}
      </div>

      <button type="submit" class="btn-signin">Login</button>
    </form>
  </div>

  <div class="signup">
    <h2>Welcome, Bintoro Travel!</h2>
    <p>Silahkan Register untuk melanjutkan ke sistem Reservasi Bintoro Travel</p>

    <a href="{{ route('register') }}">
      <button class="btn-signup">Register</button>
    </a>
  </div>
</div>


</body>
</html>
