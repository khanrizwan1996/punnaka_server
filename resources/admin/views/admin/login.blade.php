<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no" />
    <link rel="icon" type="image/png" href="{{ asset('admin/assets/img/favicon-16x16.png') }}" sizes="16x16">
    <link rel="icon" type="image/png" href="{{ asset('admin/assets/img/favicon-32x32.png') }}" sizes="32x32">
    <title>Punnaka | Admin Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('admin/bower_components/uikit/css/uikit.almost-flat.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/login_page.min.css') }}" />
</head>

<body class="login_page">
    <div class="login_page_wrapper">
        <div class="md-card" id="login_card">
            <div class="md-card-content large-padding" id="login_form">
                <div class="login_heading">
                    <div class="user_avatar"></div>
                </div>

                @if (session('error'))
                    <div class="alert alert-warning">
                        <h4> <span style="color:red">{{ session('error') }}</h4>
                    </div>
                @endif

                <form method="POST" action="{{ url('admin/adminLogin') }}">
                    @csrf
                    <div class="uk-form-row">
                        <label for="login_username">Username</label>
                        <input class="md-input" type="email" id="admin_email" name="admin_email" required />
                    </div>
                    <div class="uk-form-row">
                        <label for="login_password">Password</label>
                        <input class="md-input" type="password" id="admin_password" name="admin_password" required/>
                    </div>
                    <div class="uk-margin-medium-top">
                        <button type="submit" class="md-btn md-btn-primary md-btn-block md-btn-large">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/assets/js/common.min.js')}}"></script>
    <script src="{{ asset('admin/assets/js/uikit_custom.min.js')}}"></script>
    <script src="{{ asset('admin/assets/js/altair_admin_common.min.js')}}"></script>
    <script src="{{ asset('admin/assets/js/pages/login.min.js')}}"></script>
</body>
</html>
