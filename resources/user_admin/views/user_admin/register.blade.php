<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Punnaka.">
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
     <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card login-dark">
                    <div>

                        <div class="login-main" style="border: 1px solid #22222266;">
                            @if(session('message') && session('message') == MSG_ALREADY_REGISTER)
                                <p class="text-center" style="color: red; font-weight: 500;">User Already Register With Us!..</p>
                                <br>
                            @endif
                            <div align="center">
                                <img class="img-fluid for-light" src="{{url('frontend/images/new-logo.png')}}" style="height: 50px" alt="looginpage">
                                <br><br>
                                </div>
                            <form class="theme-form" method="POST" action="{{url('user-admin/register')}}" onsubmit="return checkPasswordMatch()">
                                @csrf
                                <h2 class="text-center">Create your account</h2>
                                <p class="text-center">Enter your personal details to create account</p>
                                <div class="form-group">
                                    <div class="row g-2">
                                        <div class="col-12">
                                            <label class="col-form-label pt-0">Full Name <span style="color: red">*</span></label>
                                            <input class="form-control" type="text" name="user_name" required=""
                                                placeholder="Enter Your Full Name">
                                        </div>
                                        {{-- <div class="col-12">
                                            <label class="col-form-label pt-0">Business Name</label>
                                            <input class="form-control" type="text" name="business_name" placeholder="Enter Business Name">
                                        </div> --}}
                                        {{-- <div class="col-6">
                                            <label class="col-form-label pt-0">Contact No</label>
                                            <input class="form-control" type="text" name="user_contact_no"
                                                required="" placeholder="Enter Contact No">
                                        </div> --}}
                                    </div>
                                </div>

                                <div class="row g-2">
                                    <div class="col-12">
                                        <label class="col-form-label">Email <span style="color: red">*</span></label>
                                        <div class="form-input position-relative">
                                            <input class="form-control" type="email" name="user_email" required=""
                                                placeholder="Enter Your Email">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="col-form-label">Password <span style="color: red">*</span></label>
                                        <div class="form-input position-relative">
                                            <input class="form-control" type="password" id="password" name="user_password" required="" placeholder="*********">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="col-form-label">Confirm Password <span style="color: red">*</span></label>
                                        <div class="form-input position-relative">
                                            <input class="form-control" type="password" id="confirmPassword" required="" placeholder="*********">
                                        </div>
                                    </div>
                                     <span id="message" style="color:red;"></span>
                                </div>

                                <div class="form-group mb-0 checkbox-checked">
                                    <button class="btn btn-primary btn-block w-100 mt-3" type="submit">Create Account</button>
                                </div>
                            </form>
                                <div class="form-group mb-0 checkbox-checked">
                                     <div class="divider customLine"> &emsp13; Or sign up with &emsp13; </div>
                                    <div class="social-btn">
                                        <a href="{{ url('user-admin/googleLogin') }}">
                                        <img src="{{asset('custom-images/icons/google.png')}}" alt="Google" /> Sign up with Google
                                        </a>
                                    </div>
                                    {{-- <div class="social-btn">
                                        <a href="{{ url('user-admin/facebookLogin') }}">
                                        <img src="{{asset('custom-images/icons/fb.png')}}" alt="Facebook" />
                                        Sign up with Facebook
                                        </a>
                                    </div> --}}
                                </div>

                                {{-- <br>
                                <div class="row g-2">

                                    <div class="col-4">
                                        <label class="col-form-label pt-0">Country</label>
                                        <input class="form-control" type="text" name="user_country"
                                            required="" placeholder="Enter Your Conutry">
                                    </div>

                                    <div class="col-4">
                                        <label class="col-form-label pt-0">City</label>
                                        <input class="form-control" type="text" name="user_city" required=""
                                            placeholder="Enter Your City">
                                    </div>
                                    <div class="col-4">
                                        <label class="col-form-label pt-0">Zip Code</label>
                                        <input class="form-control" type="text" name="user_pincode" placeholder="Enter Your Zip Code">
                                    </div>
                                </div> --}}
                                {{-- <br>
                                <div class="form-group">
                                    <label class="col-form-label">Address</label>
                                    <textarea class="form-control" required="" name="user_address" placeholder="Enter Your Address"></textarea>
                                </div> --}}

                             <p class="mt-4 mb-0 text-center" style="font-size: 16px; color: black;">By signing up, you agree to  <a href="{{url('term-conditions')}}" style="color:#3fb4e4;font-weight:500" target="_blank">Punnaka`s Term of Service</a> and acknowledge <a href="{{url('privacy-policy')}}" style="color:#3fb4e4;font-weight:500" target="_blank">Punnaka`s Privacy Policy</a></p>
                                 <p class="mt-1 mb-0 text-center" style="font-weight:bolder; font-size: 16px; color: black;">Already have an account?
                                    <a class="ms-2" style="color:#3fb4e4;font-weight:bolder" href="{{ url('user-admin/login') }}">Sign in
                                    </a>
                                </p>
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
    function checkPasswordMatch() {
      const password = document.getElementById("password").value;
      const confirmPassword = document.getElementById("confirmPassword").value;
      const message = document.getElementById("message");

      if (password !== confirmPassword) {
        message.textContent = "Passwords do not match!";
        return false; // prevent form submission
      }

      message.textContent = ""; // clear message
      return true; // allow form submission
    }
  </script>

    </div>
</body>

</html>
