@extends('frontend.layouts.master')

@section('title', 'Login')

@section('content')

  <!-- SIGNIN -->
<div class="wrapper">


<!----------------------------- Form box ----------------------------------->    
    <div class="form-box">
        
        <!------------------- login form -------------------------->

        <div class="login-container" id="login">
            <form action="{{ route('login.post') }}" method="post" id="login-form">
                @csrf
            <div class="top">
                <span>Don't have an account? <a href="#" onclick="register()">Sign Up</a></span>
                <header class="header-s">Login</header>
            </div>
            <div class="input-box">
                <input type="text" class="input-field @error('email') is-invalid @enderror" placeholder="Email" name="email">
                <i class="bx bx-user"></i>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-box">
                <input type="password" class="input-field @error('password') is-invalid @enderror" placeholder="Password" name="password">
                <i class="bx bx-lock-alt"></i>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-box">
                <input type="submit" class="submit" value="Sign In">
            </div>
            <div class="two-col">
                <div class="one">
                    <input type="checkbox" id="login-check">
                    <label for="login-check"> Remember Me</label>
                </div>
                <div class="two">
                    <label><a href="#">Forgot password?</a></label>
                </div>
            </div>
        </form>
        </div>

        <!------------------- registration form -------------------------->
        
        <div class="register-container" id="register">
            <form action="{{ route('register') }}" method="post" id="register-form">
                @csrf
            <div class="top">
                <span>Have an account? <a href="#" onclick="login()">Login</a></span>
                <header class="header-s">Sign Up</header>
            </div>
            <div class="two-forms">
                <div class="input-box">
                    <input type="text" class="input-field @error('first_name') is-invalid @enderror" placeholder="Firstname" name="first_name">
                    <i class="bx bx-user"></i>
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-box">
                    <input type="text" class="input-field @error('last_name') is-invalid @enderror" placeholder="Lastname" name="last_name">
                    <i class="bx bx-user"></i>
                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="input-box">
                <input type="text" class="input-field @error('email') is-invalid @enderror" placeholder="Email" name="email">
                <i class="bx bx-envelope"></i>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-box">
                <input type="password" class="input-field @error('password') is-invalid @enderror" placeholder="Password" name="password">
                <i class="bx bx-lock-alt"></i>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-box">
                <input type="submit" class="submit" value="Register">
            </div>
            <div class="two-col">
                <div class="one">
                    <input type="checkbox" id="register-check">
                    <label for="register-check"> Remember Me</label>
                </div>
                <div class="two">
                    <label><a href="#">Terms&conditions</a></label>
                </div>
            </div>
          </form>
        </div>
    </div>
</div> 


@endSection

@push('scripts')

<script src="{{ asset('frontend/login.js') }}"></script>  
    
@endpush