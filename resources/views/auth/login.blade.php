

    

<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
-->

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" 
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

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
                        <h2 class="fw-bold">Log in to your account.</h2>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" class="form-control" placeholder="Username" required />
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" class="form-control" placeholder="Password" required />
                    </div>
                    <div>
                        <button type="button" class="btn btn-dark col fw-bold">Log In</button>
                    </div>
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

    
    
    .container{
        display: flex;
        height: fit-content;

    }

    .login-form{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 48px;
        padding: 36px;
        width: 50%;
    }

    .image-column{
        display: flex;
        justify-content: right;
        width: 50%;
    }

    .image-column img{
        height: 100vh;
        padding: 24px;
        border-radius: 24px;
    }

    @media only screen and  (max-width:1024px) {
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

</html>

