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
                                <i id="togglePasswordIcon" class="fa fa-eye "></i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"><path d="M12 8.25a3.75 3.75 0 1 0 0 7.5a3.75 3.75 0 0 0 0-7.5M9.75 12a2.25 2.25 0 1 1 4.5 0a2.25 2.25 0 0 1-4.5 0"/><path d="M12 3.25c-4.514 0-7.555 2.704-9.32 4.997l-.031.041c-.4.519-.767.996-1.016 1.56c-.267.605-.383 1.264-.383 2.152s.116 1.547.383 2.152c.25.564.617 1.042 1.016 1.56l.032.041C4.445 18.046 7.486 20.75 12 20.75s7.555-2.704 9.32-4.997l.031-.041c.4-.518.767-.996 1.016-1.56c.267-.605.383-1.264.383-2.152s-.116-1.547-.383-2.152c-.25-.564-.617-1.041-1.016-1.56l-.032-.041C19.555 5.954 16.514 3.25 12 3.25M3.87 9.162C5.498 7.045 8.15 4.75 12 4.75s6.501 2.295 8.13 4.412c.44.57.696.91.865 1.292c.158.358.255.795.255 1.546s-.097 1.188-.255 1.546c-.169.382-.426.722-.864 1.292C18.5 16.955 15.85 19.25 12 19.25s-6.501-2.295-8.13-4.412c-.44-.57-.696-.91-.865-1.292c-.158-.358-.255-.795-.255-1.546s.097-1.188.255-1.546c.169-.382.426-.722.864-1.292"/></g></svg>
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
