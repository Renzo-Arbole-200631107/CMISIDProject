<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CMISID Project Management System') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="login" class="container">
        <div class="login-form">
            <div class="group">
                <div>
                    <img src="{{ asset('img/logo.png') }}" alt="Logo">
                    <img src="{{ asset('img/rise-color.png') }}" alt="Logo">
                </div>
            </div>
            <div class="group mb-5">
                <div class="mb-4">
                    <h2 class="fw-bold">Log in to your account.</h2>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-outline mb-4">
                        <input type="text" class="form-control" placeholder="Username" name="username" required />
                    </div>
                    <div class="form-outline mb-4 position-relative">
                        <input type="password" class="form-control" placeholder="Password" name="password"
                            id="password" required />
                            <button type="button" onclick="togglePasswordVisibility()" class="toggle-password-btn position-absolute">
                                <i id="togglePasswordIcon" class="fa fa-eye"></i>
                            </button>
                    </div>
                    
                    @if ($errors->any())
                        <div>
                            <h6 class="text-danger text-center fw-bold mb-4">
                                @foreach ($errors->all() as $error)
                                    Invalid username or password.
                                @endforeach
                            </h6>
                        </div>
                    @endif
                    <div>
                        <button type="submit" class="btn btn-dark col fw-bold">Log In</button>
                    </div>
                </form>
            </div>
            <div class="group">
                <p class="text-center">© 2024 City Management Information Systems and Innovation Department. All rights
                    reserved.</p>
            </div>
        </div>

        <div class="image-column">
            <div class="">
                <img src="{{ asset('img/login-background.png') }}" alt="" class="image">
            </div>
        </div>

    </div>
</body>

<script>
    function togglePasswordVisibility() {
        console.log("Toggle button clicked"); // Debug message
        const passwordField = document.getElementById('password');
        const toggleIcon = document.getElementById('togglePasswordIcon');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>

<style>
    body {
        font-family: "Poppins", sans-serif;
        background-color: #f2f2f2;
    }

    .position-relative {
        position: relative;
    }

    .toggle-password-btn {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
        color: #6c757d;
        z-index: 10;
        width: 30px;
        height: 30px
    }

    .toggle-password-btn:focus {
        outline: none;
    }

    .container {
        display: flex;
        height: fit-content;
    }

    .login-form {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 48px;
        padding: 36px;
        width: 50%;
    }

    .image-column {
        display: flex;
        justify-content: right;
        width: 50%;
    }

    .image-column img {
        height: 100vh;
        padding: 24px;
        border-radius: 24px;
    }

    @media only screen and  (max-width:1200px) {

        .image-column {
            display: none;
        }

        .container {
            width: fit-content;
        }

        .login-form {
            width: 100%;
            height: 100vh;
        }
    }
</style>
