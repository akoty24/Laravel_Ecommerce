<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/auth/css/style.css')}}">
    <link rel="stylesheet" href="{{url('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/auth/css/bootstrap.css')}}">
    <title>Document</title>
</head>
<body>
<div class="Container">
    <div class="signin-signup ">

        <form action="{{route('login')}}" method="POST"  class="sign-in-form ">
            @if(Session::has('success'))

                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            @endif


            @if(Session::has('fail'))
                <div class="alert alert-danger">
                    {{Session::get('fail')}}
                </div>
            @endif
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
            @csrf
            <h2 class="title">LOGIN IN</h2>
            <div class="input-field">
                <i class="bi bi-person-fill"></i>
                <input type="text" placeholder="Email" name="email" id="field">
            </div>
            <div class="input-field">
                <i class="bi bi-lock-fill"></i>
                <input type="password" placeholder="Password"  name="password" id="field">
            </div>
            <input type="submit" value="Login" class="Btn">
            <p class="social-text">Or Sign in with social platform</p>
            <div class="social-media">
                <a href="#" class="social-icon">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="#" class="social-icon">
                    <i class="bi bi-twitter"></i>
                </a>
                <a href="#" class="social-icon">
                    <i class="bi bi-google"></i>
                </a>
                <a href="#" class="social-icon">
                    <i class="bi bi-linkedin"></i>
                </a>
            </div>
            <p class="account-text">Dont have an account? <a href="#" id="sign-up-btn2">SIGN UP</a></p>
        </form>

        <form action="{{route('register')}}" method="POST" class="sign-up-form">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
            @csrf
            <h2 class="title">SIGN UP</h2>

            <div class="input-field">
                <i class="bi bi-person-fill"></i>
                <input type="text" placeholder="First Name" id="field" name="name">
            </div>
                <div class="input-field">
                    <i class="bi bi-person-fill"></i>
                    <input type="text" placeholder="Last Name" id="field" name="lname">
                </div>

            <div class="input-field">
                <i class="bi bi-envelope-fill"></i>
                <input type="text" placeholder="Email" id="field" name="email">
            </div>

            <div class="input-field">
                <i class="bi bi-envelope-fill"></i>
                <input type="number" placeholder="Phone Number" id="field" name="phone">
            </div>

            <div class="input-field">
                <i class="bi bi-lock-fill"></i>
                <input type="password" placeholder="Password" id="field" name="password">
            </div>
            <div class="input-field">
                <i class="bi bi-lock-fill"></i>
                <input type="password" placeholder="confirm Password" id="field" name="password_confirmation">
            </div>
            <input type="submit" value="Sign up" class="Btn">
            <p class="social-text">Or Sign in with social platform</p>
            <div class="social-media">
                <a href="#" class="social-icon">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="#" class="social-icon">
                    <i class="bi bi-twitter"></i>
                </a>
                <a href="#" class="social-icon">
                    <i class="bi bi-google"></i>
                </a>
                <a href="#" class="social-icon">
                    <i class="bi bi-linkedin"></i>
                </a>
            </div>
            <p class="account-text">Already have an account? <a href="#" id="sign-in-btn2">Sign in</a></p>
        </form>
    </div>
    <div class="panels-container">

        <div class="panel left-panel">
            <div class="content">
                <h3>Member of Akelny</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione adipisci mollitia quis necstatibus.</p>
                <button class="Btn" id="sign-in-btn"> Sign in </button>
            </div>
        </div>

        <div class="panel right-panel">
            <div class="content">
                <h3>Akelny</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione adipisci mollitia quis necstatibus.</p>
                <button class="Btn" id="sign-up-btn"> Sign up </button>
            </div>
        </div>

    </div>
</div>

<script src="{{asset('assets/auth/js/app.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if(Session::has('message'))
    <script>
        swal("Message!","{{Session::get('message')}}",{button:"OK"})
    </script>
@endif
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(Session::has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '{{Session::get('success')}}',
            showConfirmButton: false,
            timer: 1500});
    </script>
@endif
</body>
</html>
