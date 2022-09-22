<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from coderthemes.com/adminto/layouts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 25 Aug 2022 15:33:31 GMT -->
<head>
    <meta charset="utf-8" />
    <title>Log In | Adminto - Responsive Admin Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('/dashboard/assets/images/favicon.ico') }}">

    <!-- App css -->

    <link href="{{ asset('/dashboard/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- icons -->
    <link href="{{ asset('/dashboard/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body class="loading authentication-bg authentication-bg-pattern">

    <div class="account-pages my-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="text-center">   
                        <a href="index.html">
                            <img src="{{ asset('/dashboard/assets/images/logo-dark.png') }}" alt="" height="22" class="mx-auto">
                        </a>
                        <p class="text-muted mt-2 mb-4">Responsive Admin Dashboard</p>

                    </div>
                    <div class="card">
                        <div class="card-body p-4">
                            
                            <div class="text-center mb-4">
                                <h4 class="text-uppercase mt-0">Sign In</h4>
                            </div>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">Email address</label>
                                    <input class="form-control" type="email" id="email" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter your email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input class="form-control" type="password" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" id="password" placeholder="Enter your password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                    </div>
                                </div>

                                <div class="mb-3 d-grid text-center">
                                    <button class="btn btn-primary" type="submit"> Log In </button>
                                </div>
                            </form>

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            @if (Route::has('password.request'))
                            <p> <a style="color:#fff;" href="{{ route('password.request') }}" class="ms-1"><i class="fa fa-lock me-1"></i>Forgot your password?</a></p>
                            @endif
                            <p style="color:#fff;" >Don't have an account? <a href="{{ route('register') }}" class="text-dark ms-1"><b>Sign Up</b></a></p>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- Vendor -->
    <script src="{{ asset('/dashboard/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/dashboard/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/dashboard/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('/dashboard/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('/dashboard/assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('/dashboard/assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('/dashboard/assets/libs/feather-icons/feather.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('/dashboard/assets/js/app.min.js') }}"></script>
    
</body>

<!-- Mirrored from coderthemes.com/adminto/layouts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 25 Aug 2022 15:33:32 GMT -->
</html>