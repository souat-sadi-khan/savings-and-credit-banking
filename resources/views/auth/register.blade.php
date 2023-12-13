@extends('layouts.auth', ['title' => 'Register'])

@section('auth')
<div class="row g-0 min-vh-100"> 
    <div class="col-md-6 d-flex flex-column align-items-center order-2 order-md-1">
        <div class="container pt-5">
            <div class="row gx-0">
                <div class="col-11 col-md-10 mx-auto">
                    <p class="text-end text-2 text-muted fw-300">Already a member? <a class="fw-300" href="login.html">Sign in now</a></p>
                </div>
            </div>
        </div>

        <div class="container my-auto py-5">
            <div class="row gx-0">
                <div class="col-11 col-md-10 col-lg-9 col-xl-8 mx-auto">
                    <h3 class="fw-300 text-9 mb-5">Sign up</h3>
                    <form id="registerForm" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label fw-300">Full Name</label>
                            <input type="text" class="form-control bg-light border-light" name="name" id="name" required="" placeholder="Enter Your Name" maxlength="20" value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-300">Email Address</label>
                            <input type="email" class="form-control bg-light border-light" name="email" id="email" required="" placeholder="Enter Your Email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-300">Password</label>
                            <input type="password" class="form-control bg-light border-light" id="password" name="password" required="" placeholder="Enter Password">
                        </div>
                        <!-- <div class="form-check my-4">
                            <input id="agree" name="agree" class="form-check-input" type="checkbox">
                            <label class="form-check-label text-2 fw-300" for="agree">I agree to the <a href="#">Terms</a> and <a href="javascript:;">Privacy Policy</a>.</label>
                        </div> -->
                        <div class="d-grid my-4">
                            <button class="btn btn-dark shadow-none fw-400" type="submit">Sign Up</button>
                        </div>
                    </form>
                    <!-- <div class="d-flex align-items-center my-4">
                        <hr class="flex-grow-1">
                            <span class="mx-2 text-2 text-muted fw-300">Or continue with</span>
                        <hr class="flex-grow-1">
                    </div>
                    <div class="row gx-3">
                        <div class="col-6 d-grid">
                            <button type="button" class="btn btn-light btn-sm fw-400 shadow-none border"><span class="me-2"><i class="fab fa-google"></i></span>Google</button>
                        </div>
                        <div class="col-6 d-grid">
                            <button type="button" class="btn btn-light btn-sm fw-400 shadow-none border"><span class="me-2"><i class="fab fa-facebook-f"></i></span>Facebook</button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <!-- Welcome Text--> 
    <div class="col-md-6 bg-light  order-1 order-md-2">
        <div class="container h-100 d-flex flex-column">
            <div class="row g-0">
                <div class="col-11 col-md-10 mx-auto">
                    <div class="logo mt-5 mb-5 mb-md-0"> 
                        <a class="d-flex" href="login.html" title="Login Template">
                            <img src="assets/images/logo.png" alt="Login Template">
                        </a> 
                    </div>
                </div>
            </div>
            <div class="row g-0 my-auto">
                <div class="col-11 col-md-10 mx-auto">
                    <h1 class="text-13 fw-300 mb-4">Join us and take control of your finances with confidence.</h1>
                    <p>Welcome to our banking software registration page! We are thrilled that you have chosen to be a part of our financial family. By creating an account, you will gain access to a wide range of features and services that will simplify and enhance your banking experience. Whether you're looking to manage your accounts, make seamless transactions, or monitor your investments, our user-friendly platform is designed with your needs in mind. Rest assured that our software prioritizes security, ensuring the safety and privacy of your personal information. Our dedicated team is here to assist you every step of the way, ready to answer any questions and provide the support you need. Join us today and embark on a journey towards a more efficient and convenient banking experience.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection