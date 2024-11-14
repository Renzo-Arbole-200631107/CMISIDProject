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
                        <img src="{{asset('img/logo.png')}}" alt="Logo">
                        <img src="{{asset('img/rise-color.png')}}" alt="Logo">
                    </div>
                </div>
                <div class="group mb-5">
                    <div class="mb-4">
                        <h2 class="fw-bold">Please update your password to continue.</h2>
                    </div>
                    <div class="mb-4">
                        <h5>Minimum length of password should be 8 characters.</h5>
                    </div>

                    <form method="POST" action="{{route('change.password')}}">
                        @csrf
                        <div class="mb-4">
                            <input type="password" class="form-control" name="current_password" placeholder="Current password">
                        </div>

                        <div class="mb-4">
                            <input type="password" class="form-control" name="new_password" placeholder="New password">
                        </div>

                        <div class="mb-4">
                            <input type="password" class="form-control" name="new_password_confirmation" placeholder="Confirm password">
                        </div>
                        @if ($errors->any())
                            <div class="mx-4">
                                @foreach ($errors->all() as $error)
                                <h5 class="fw-bold text-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="M12 20a8 8 0 1 0 0-16a8 8 0 0 0 0 16m0 2C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10m-1-6h2v2h-2zm0-10h2v8h-2z"/></svg>{{ $error }}</h5>
                                @endforeach
                            </div>
                        @endif
                        <div>
                            <button type="submit" class="btn btn-dark col fw-bold">Update password</button>
                        </div>
                    </form>
                </div>
                <div class="group">
                    <p class="text-center">© 2024 City Management Information Systems and Innovation Department. All rights reserved.</p>
                </div>
            </div>

            <div class="image-column">
                <div class="">
                    <img src="{{asset('img/login-background.png')}}" alt="" class="image">
                </div>
            </div>

    </div>
</body>

<style>
    body{
        font-family: "Poppins", sans-serif;
        background-color: #f2f2f2;
    }



    .container {
        display: flex;
        min-height: 100vh;
        justify-content: space-between;
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
        align-items: flex-end;
        justify-content: space-between;
        width: 50%;
    }

    .image-column img{
        height: 100vh;
        padding: 24px;
        border-radius: 24px;
    }

    @media only screen and  (max-width:1200px) {
        .image-column {
            display: none;
        }
        .container{
            width: fit-content;
        }

        .login-form{
            width: 100%;
            height: 100vh;
        }
    }
</style>


