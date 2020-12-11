<link rel="icon" type="image/png" href="{{asset('form-login/images/icons/favicon.ico')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('form-login/vendor/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('form-login/fonts/iconic/css/material-design-iconic-font.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('form-login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('form-login/vendor/animate/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('form-login/vendor/css-hamburgers/hamburgers.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('form-login/vendor/animsition/css/animsition.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('form-login/vendor/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('form-login/vendor/daterangepicker/daterangepicker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('form-login/css/util.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('form-login/css/main.css')}}">

<div class="wrap-login100" id="modalLogin">
    <form class="login100-form validate-form">
        <span class="login100-form-logo">
            <i class="zmdi zmdi-landscape"></i>
        </span>

        <span class="login100-form-title p-b-34 p-t-27" style="font-family: Arial, Helvetica, sans-serif;">Đăng nhập</span>

        <div class="wrap-input100 validate-input" data-validate="Enter username">
            <input class="input100" type="email" name="username" placeholder="Email">
            <span class="focus-input100" data-placeholder="&#xf207;"></span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Enter password">
            <input class="input100" type="password" name="pass" placeholder="Password">
            <span class="focus-input100" data-placeholder="&#xf191;"></span>
        </div>

        <div class="contact100-form-checkbox">
            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
            <label class="label-checkbox100" for="ckb1">
                Remember me
            </label>
        </div>

        <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit" style="font-family: Arial, Helvetica, sans-serif;">
                Đăng nhập
            </button>
        </div>

        <div class="text-center p-t-90">
            <a class="txt1 btn-signup" href="{{route('recruiter.signup')}}">
                Đăng ký
            </a>
        </div>
    </form>
</div>
<!--===============================================================================================-->
<script src="{{asset('form-login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('form-login/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('form-login/vendor/bootstrap/js/popper.js')}}"></script>
<script src="{{asset('form-login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('form-login/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('form-login/vendor/daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('form-login/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('form-login/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('form-login/js/main.js')}}"></script>
