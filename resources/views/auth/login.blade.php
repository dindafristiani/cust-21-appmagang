<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>MagangKu</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset ('assets/img/favicon.png')}}" rel="icon">
  <link href="{{asset ('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset ('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{asset ('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{asset ('assets/vendor/aos/aos.css" rel="stylesheet') }}">
  <link href="{{asset ('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{asset ('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{asset('assets/css/main.css')}}" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
    /* General body styling */
    body {
        background: linear-gradient(to right, #388da8, #70498E);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        font-family: 'Roboto', sans-serif;
    }

    /* Center the container */
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        max-width: 400px;
    }

    /* Card styling */
    .login-card {
        background-color: #fff;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        text-align: center;
        width: 100%;
    }

    /* Title styling */
    .login-title {
        font-size: 1.75rem;
        margin-bottom: 1.5rem;
        color: #333;
    }

    /* Input group styling */
    .input-group {
        position: relative;
        margin-bottom: 1rem;
    }

    .form-input {
        width: 100%;
        padding: 0.75rem 2.5rem 0.75rem 1rem;
        border: 1px solid #ced4da;
        border-radius: 25px;
        font-size: 1rem;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-input:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    /* Invalid feedback styling */
    .invalid-feedback {
        font-size: 0.875rem;
        color: #dc3545;
        display: block;
        margin-top: 0.5rem;
        text-align: left;
    }

    /* Options styling */
    .options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .remember-me {
        display: flex;
        align-items: center;
    }

    .remember-me input {
        margin-right: 0.5rem;
    }

    .forgot-password {
        color: #007bff;
        text-decoration: none;
        font-size: 0.875rem;
    }

    .forgot-password:hover {
        text-decoration: underline;
    }

    /* Button styling */
    .login-button {
        background-color: #388da8;
        color: #fff;
        border: none;
        border-radius: 30px;
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        width: 100%;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-top: 1rem;
    }

    .login-button:hover {
        background-color: #2575fc;
    }

    .login-button i {
        margin-left: 0.5rem;
    }

    /* Sign up link styling */
    .sign-up {
        margin-top: 1rem;
        font-size: 0.875rem;
    }

    .sign-up a {
        color: #6a11cb;
        text-decoration: none;
    }

    .sign-up a:hover {
        text-decoration: underline;
    }

  </style>
</head>

<body class="index-page">
    <!-- <section id="hero" class="hero section">
      <div class="hero-bg">
        <img src="assets/img/hero-bg-light.webp" alt="">
      </div> -->
      <div class="login-container">
        <div class="login-card">
            <h2 class="login-title">Login</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group">
                    <input type="email" id="email" class="form-input @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group">
                    <input type="password" id="password" class="form-input @error('password') is-invalid @enderror" name="password" placeholder="Password" required>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="options">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">Remember me</label>
                    </div>
                    <a class="forgot-password" href="{{ route('password.request') }}">Forgot Password?</a>
                </div>
                <button type="submit" class="login-button">Login <i class="fas fa-arrow-right"></i></button>
            </form>
            <div class="sign-up">
                Don't have an account yet? <a href="{{ route('register') }}">Sign up</a>
            </div>
        </div>
    <!-- </div>
    </section>/Hero Section -->

  <!-- Vendor JS Files -->
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="{{asset ('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset ('assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset ('assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset ('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset ('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>

  <!-- Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>

</body>

</html>
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
        </div>
    </div>
</div> -->
