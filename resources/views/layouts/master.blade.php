<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="{{asset('theme-admin/css/client/client_layout.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous">
    </script>
</head>
<body>
    <div class="toolbar">
        <div class="toolbar-content">
            <a href="{{route('client.get.home.page')}}">
                <div class="logo" style="background-image: url({{asset('/images/logowebsite.png')}})">
                </div>
            </a>
            <a href="{{route('client.get.list.job')}}" type="button" class="btn-alljob btn btn-dark">Việc làm IT</a>
            <a href="" type="button" class="btn-company btn btn-dark">Công ty IT</a>
            <a href="" type="button" class="btn-login btn btn-dark">Đăng nhập</a>
            <a href="{{route('recruiter.login')}}" type="button" class="btn-recruiter btn btn-dark">Nhà tuyển dụng</a>
        </div>
    </div>
    <div class="main">
        @yield('main')
    </div>
    <div class="footer">
    </div>
    <!-- Thư viện jquery đã nén phục vụ cho bootstrap.min.js  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Thư viện popper đã nén phục vụ cho bootstrap.min.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
    <!-- Bản js đã nén của bootstrap 4, đặt dưới cùng trước thẻ đóng body-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
</body>

</html>