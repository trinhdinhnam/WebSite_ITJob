<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="{{asset('admin/login/css/styles.css')}}" rel="stylesheet" />
<div class="container">
    <div class="card card-container">
        <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
        <p id="profile-name" class="profile-name-card"></p>
        <form action="" class="form-signin" enctype="multipart/form-data" method="POST">
            @csrf
            <span id="reauth-email" class="reauth-email"></span>
            <input type="email" id="inputEmail" class="form-control" placeholder="Nhập vào email" required autofocus name="email">
            <input type="password" id="inputPassword" class="form-control" placeholder="Nhập vào password" required name="password">
            <div id="remember" class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" >Đăng nhập</button>
        </form><!-- /form -->
        <a href="#" class="forgot-password">
            Quên mật khẩu?
        </a>
    </div>
</div>
<script src="{{asset('admin/login/js/login.js')}}"></script>
