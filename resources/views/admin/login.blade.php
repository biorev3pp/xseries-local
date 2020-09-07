<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
    <!-- BEGIN: Head-->

    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="BIOREV" />
        <title>::Biorev::</title>
        <link rel="icon" type="image/png" href="{{ asset('images/favicon-16x16.png') }}" />

        <!--font awesome-->

        <link rel="stylesheet" href="{{ asset('admin/fontawesome/css/fontawesome.css') }}" />

        <!-- start: main CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/material.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/components.css') }}" />

        <!-- END: main CSS-->

        <!-- start custom css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/cust.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/scss/variable.css') }}" />

        <!-- end custom css-->
    </head>
    <!-- END: Head-->

    <!-- BEGIN: Body-->

    <body class="bg-full-screen-image blank-page">
        <!-- BEGIN: Content-->
        <div class="app-content content">
            <div class="content-header row"></div>
            <div class="content-wrapper">
                <div class="content-body">
                    <section class="flexbox-container">
                        <div class="col-12 d-flex align-items-center justify-content-center">
                            <div class="col-lg-4 col-md-8 col-12 box-shadow-2 p-0">
                                <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                                    <div class="card-header border-0">
                                        <div class="card-title text-center"> 
                                            <img src="{{ asset('images/logo2.png') }}" alt="Biorev" class="logo" />
                                        </div>
                                    </div>
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <div class="card-content">
                                        <div class="card-body">
                                            <form class="form-horizontal" method="post" action="{{ route('admin-login-check') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <div class="floating-label position-relative">
                                                        <label for="username">Username / Email</label>
                                                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" />

                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="floating-label">
                                                        <label for="password">Password</label>
                                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="off" />

                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-12 text-sm-left mob-right" style="margin-left: 18px; padding-right: 28px;">
                                                        <fieldset>
                                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="remember">
                                                                {{ __('Remember Me') }}
                                                            </label>
                                                        </fieldset>

                                                        <div class="float-sm-right text-sm-right"><a href="/verify/mail" class="card-link">Forgot Password?</a></div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn-block btn-border outerborder color"><i class="fas fa-sign-in-alt"></i> Login</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!-- END: Content-->
        <script src="{{ asset('admin/vendors/js/material-vendors.min.js') }}"></script>
    </body>
    <!-- END: Body-->
</html>
