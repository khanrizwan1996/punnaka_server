<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Punnaka">
    <meta name="keywords" content="Punnaka">
    <meta name="author" content="Punnaka">
    <title>Punnaka | User Admin</title>
    <!-- Favicon icon-->
    <link rel="icon" href="{{ asset('frontend/images/new-logo-fav-icon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('frontend/images/new-logo-fav-icon.png') }}" type="image/x-icon">
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <!-- Font awesome icon css -->
    <link rel="stylesheet"
        href="{{ asset('user_admin/assets/css/vendors/%40fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('user_admin/assets/css/vendors/%40fortawesome/fontawesome-free/css/fontawesome.css') }}">
    <link rel="stylesheet"
        href="{{ asset('user_admin/assets/css/vendors/%40fortawesome/fontawesome-free/css/brands.css') }}">
    <link rel="stylesheet"
        href="{{ asset('user_admin/assets/css/vendors/%40fortawesome/fontawesome-free/css/solid.css') }}">
    <link rel="stylesheet"
        href="{{ asset('user_admin/assets/css/vendors/%40fortawesome/fontawesome-free/css/regular.css') }}">
    <!-- Ico Icon css -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('user_admin/assets/css/vendors/%40icon/icofont/icofont.css') }}">
    <!-- Flag Icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('user_admin/assets/css/vendors/flag-icon.css') }}">
    <!-- Themify Icon css -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('user_admin/assets/css/vendors/themify-icons/themify-icons/css/themify.css') }}">
    <!-- Animation css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('user_admin/assets/css/vendors/animate.css/animate.css') }}">
    <!-- Whether Icon css-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('user_admin/assets/css/vendors/weather-icons/css/weather-icons.min.css') }}">
    <!-- App css-->
    <link rel="stylesheet" href="{{ asset('user_admin/assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('user_admin/assets/css/color-1.css') }}" media="screen">
    <style>
        .divider {
            text-align: center;
            margin: 1rem 0;
            font-size: 0.9rem;
            color: #777;
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 0.75rem;
            margin-bottom: 1rem;
            background-color: white;
            font-size: 0.95rem;
            cursor: pointer;
        }

        .social-btn img {
            height: 20px;
            margin-right: 0.5rem;
        }

        .terms {
            font-size: 0.8rem;
            color: #777;
            text-align: center;
        }

        .terms a {
            color: #1a3e8b;
            text-decoration: none;
        }

        .customLine {
        display: flex;
        flex-direction: row;
        }
        .customLine:before, .customLine:after{
        content: "";
        flex: 1 1;
        border-bottom: 1px solid;
        margin: auto;
        }

    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <div class="login-card login-dark" style="display: revert;">
                    <div>
                        <div class="login-main" style="border: 1px solid #22222266;">

                            @if(session('message') == MSG_INVALID_CREDENTIALS)
                          <div id="liveAlertPlaceholder">
                              <div class="alert alert-light-danger mb-3 alert-dismissible" role="alert">
                                  <div class="text-truncate">Invalid Credentials !..</div>
                                  <button class="btn-close" type="button" data-bs-dismiss="alert"
                                      aria-label="Close" fdprocessedid="wsb8o"></button>
                              </div>
                            <div>
                        @endif

                            <div align="center">
                                <img class="img-fluid for-light" src="{{ asset('frontend/images/new-logo.png') }}"
                                    style="height: 50px" alt="looginpage">
                                <br><br>
                            </div>
                            <form class="theme-form" method="POST" action="{{ url('user-admin/login') }}">
                                @csrf
                                <h2 class="text-center">Sign in</h2>
                                <p class="text-center">Enter your email and password to login</p>
                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input class="form-control" type="email" name="user_email" required=""
                                        placeholder="Enter Your Email">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <div class="form-input position-relative">
                                        <input class="form-control" type="password" name="user_password"
                                            required="" placeholder="Enter Your Password">
                                    </div>
                                </div>
                                <div class="text-end mt-3">
                                    <button type="submit" class="btn btn-primary btn-block w-100 text-white">Sign
                                        in</button>
                                </div>
                                <div class="form-group mb-0 checkbox-checked">
                                    <div class="divider customLine"> &emsp13; Or sign up with &emsp13; </div>
                                    <div class="social-btn">
                                        <a href="{{ url('user-admin/googleLogin') }}">
                                            <img src="{{ url('custom-images/icons/google.png') }}" alt="Google" />
                                            Sign up with Google
                                        </a>
                                    </div>

                                    {{-- <div class="social-btn">
                        <a href="{{ url('user-admin/facebookLogin') }}">
                          <img src="{{asset('custom-images/icons/fb.png')}}" alt="Facebook" />
                          Sign up with Facebook
                        </a>
                    </div> --}}

                                    {{--  <div class="text-end mt-3">
                      <a href="{{ url('user-admin/googleLogin') }}">
                      <img src="{{asset('custom-images/google-login.png')}}" style="margin-right: -38px;/* width: 100%; */height: 53px;">
                    </a>
                    </div>

                     <div class="text-end mt-3">
                      <a href="{{ url('user-admin/facebookLogin') }}">
                      <img src="{{asset('custom-images/fb-login.png')}}" style="margin-right: 51px;width: 100%;height: 80px;">
                    </a>
                    </div>
                    <br>
                    --}}
                                </div>
                                <p class="mt-4 mb-0 text-center" style="font-size: 16px; color: black;">By signing in, you agree to <a
                                        href="{{ url('term-conditions') }}" style="color:#3fb4e4;font-weight:500"
                                        target="_blank">Punnaka`s Term of Service</a> and acknowledge <a
                                        href="{{ url('privacy-policy') }}" style="color:#3fb4e4;font-weight:500"
                                        target="_blank">Punnaka`s Privacy Policy</a></p>
                                <p class="mt-2 mb-0 text-center" style="font-weight:bolder; font-size: 16px; color: black;">Don't have account?<a class="ms-2" href="{{ url('user-admin/register') }}" style="font-weight: bolder;">Create Account</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('user_admin/assets/js/vendors/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('user_admin/assets/js/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('user_admin/assets/js/config.js') }}"></script>
        <script src="{{ asset('user_admin/assets/js/password.js') }}"></script>
        <script src="{{ asset('user_admin/assets/js/script.js') }}"></script>
        <script>
	window.setTimeout(function() {
		$(".alert").fadeTo(500, 0).slideUp(500, function() {
			$(this).remove();
		});
	}, 4000);
</script>
    </div>
</body>

</html>
