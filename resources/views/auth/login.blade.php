@extends('layouts.app')

@section('content')
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
                    <form method="POST" action="{{route('login')}}">
                        @csrf
                        <div class="form-outline mb-4">
                            <input type="text" class="form-control" placeholder="Username" name="username" required />
                        </div>
                        <div class="form-outline mb-4">
                            <input type="password" class="form-control" placeholder="Password" name="password" required />
                        </div>
                        <div>
                            <button type="submit" class="btn btn-dark col fw-bold">Log In</button>
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
@endsection

