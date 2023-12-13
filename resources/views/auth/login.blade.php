@extends('layouts.auth', ['title' => 'Login'])
@section('auth')
    <div class="row g-0 min-vh-100"> 
        <div class="col-md-6 d-flex flex-column align-items-center order-2 order-md-1">
            {{-- <div class="container pt-5">
                <div class="row gx-0">
                    <div class="col-11 col-md-10 mx-auto">
                        <p class="text-end text-2 text-muted fw-300">Not a member? <a class="fw-300" href="{{ route('register') }}">Sign up now</a></p>
                    </div>
                </div>
            </div> --}}
            <div class="container my-auto py-5">
                <div class="row gx-0">
                    <div class="col-11 col-md-10 col-lg-9 col-xl-8 mx-auto">
                        <h3 class="fw-300 text-9 mb-5">Sign in</h3>
                        <form action="{{ route('login') }}" id="login" method="POST">
                            <div class="mb-2">
                                <label for="emailAddress" class="form-label fw-300">Email Address</label>
                                <input type="email" name="email" class="form-control bg-light border-light" id="emailAddress" required="" placeholder="Enter Your Email">
                            </div>
                            <div class="mb-3">
                                <label for="loginPassword" class="form-label fw-300">Password</label>
                                <input type="password" class="form-control bg-light border-light" id="loginPassword" required="" name="password" placeholder="Enter Password">
                            </div>
                            {{-- <div class="row mt-4">
                                <div class="col">
                                    <div class="form-check">
                                        <input id="remember-me" name="remember" class="form-check-input" type="checkbox">
                                        <label class="form-check-label text-2 fw-300" for="remember-me">Remember Me</label>
                                    </div>
                                </div>
                                <div class="col text-end">
                                    <a class="text-2 fw-300" href="forgot-password.html">Forgot Password ?</a>
                                </div>
                            </div> --}}
                            <div class="d-grid my-4">
                                <button class="btn btn-dark shadow-none fw-400" type="submit">Sign in</button>
                            </div>
                        </form>
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
                                <img src="{{ asset("backend/img/logo.png") }}" alt="Login Template">
                            </a> 
                        </div>
                    </div>
                </div>
                <div class="row g-0 my-auto">
                    <div class="col-11 col-md-10 mx-auto">
                        <h1 class="text-13 fw-300 mb-4">Securely Connect, Conveniently Manage.</h1>
                        <p>Welcome to our secure and user-friendly banking app login page. We understand the importance of keeping your financial information safe, and that's why we've implemented state-of-the-art security measures to protect your account. You can trust that your transactions and personal data are safeguarded every time you log in. Enjoy the convenience of managing your finances with ease and peace of mind. Let's get started on your seamless banking experience
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/auth/login.js') }}"></script>
@endpush