<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Pivot | Login</title>

    @include('layout.includes.css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/authentication.css')}}">

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern 1-column  navbar-floating footer-static bg-full-screen-image  blank-page blank-page"
      data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">

            <section class="row flexbox-container">
                <div class="col-xl-8 col-11 d-flex justify-content-center">

                    <div class="card bg-authentication rounded-8 mb-0">
                        <div class="row m-0">
                            <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                                <img src="https://pixinvent.com/demo/vuesax-html-admin-dashboard-template/app-assets/images/pages/login.png"
                                     alt="branding logo">
                            </div>
                            <div class="col-lg-6 col-12 p-0">
                                <div class="card rounded-8 mb-0 px-2">
                                    <div class="card-header pb-1">
                                        <div class="card-title">
                                            <h4 class="mb-0">Login</h4>
                                        </div>
                                    </div>
                                    @include('layout.includes.alert')
                                    <div class="card-content">
                                        <div class="card-body pt-1">
                                            <form action="" method="post">
                                                @csrf
                                                <fieldset
                                                        class="form-label-group form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control" id="user-name"
                                                           placeholder="Username" name="login" required>
                                                    <div class="form-control-position">
                                                        <i class="feather icon-user"></i>
                                                    </div>
                                                    <label for="user-name">Username</label>
                                                </fieldset>

                                                <fieldset class="form-label-group position-relative has-icon-left">
                                                    <input type="password" class="form-control" id="user-password"
                                                           placeholder="Password" name="password" required>
                                                    <div class="form-control-position">
                                                        <i class="feather icon-lock"></i>
                                                    </div>
                                                    <label for="user-password">Password</label>
                                                </fieldset>
                                                <div class="form-group d-flex justify-content-between align-items-center">
                                                    <div class="text-left">
                                                        <fieldset class="checkbox">
                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                <input type="checkbox" name="remember">
                                                                <span class="vs-checkbox">
                                                  <span class="vs-checkbox--check">
                                                    <i class="vs-icon feather icon-check"></i>
                                                  </span>
                                                </span>
                                                                <span class="">Remember me</span>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="text-right"><a href="auth-forgot-password.html"
                                                                               class="card-link">Forgot Password?</a>
                                                    </div>
                                                </div>
                                                <a href="https://pixinvent.com/demo/vuesax-html-admin-dashboard-template/html/ltr/vertical-menu-template/auth-register.html"
                                                   class="btn btn-outline-primary float-left btn-inline">Register</a>
                                                <button type="submit" class="btn btn-primary float-right btn-inline">
                                                    Login
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="login-footer">
                                        <br>
                                        {{--                                        Todo:: auto for social media--}}
                                        {{--                                        <div class="divider">--}}
                                        {{--                                            <div class="divider-text">OR</div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="footer-btn d-inline">--}}
                                        {{--                                            <a href="auth-login.html#" class="btn btn-facebook"><span class="fa fa-facebook"></span></a>--}}
                                        {{--                                            <a href="auth-login.html#" class="btn btn-twitter white"><span class="fa fa-twitter"></span></a>--}}
                                        {{--                                            <a href="auth-login.html#" class="btn btn-google"><span class="fa fa-google"></span></a>--}}
                                        {{--                                            <a href="auth-login.html#" class="btn btn-github"><span class="fa fa-github-alt"></span></a>--}}
                                        {{--                                        </div>--}}
                                    </div>
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


@include('layout.includes.js')

</body>
<!-- END: Body-->
</html>