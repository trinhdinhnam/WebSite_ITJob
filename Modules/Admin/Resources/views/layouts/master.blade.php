<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin</title>
    <link href="{{asset('theme-admin/css/styles.css')}}" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('/js/lumino.glyphs.js')}}"></script>
    <script src="{{asset('/js/vendor/jquery-1.11.3.min.js')}}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body class="sb-nav-fixed">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="{{route('admin.dashboard')}}">Admin</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search"
                    aria-describedby="basic-addon2" />
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i>@if(\Illuminate\Support\Facades\Auth::guard('admins')->check()){{\Illuminate\Support\Facades\Auth::guard('admins')->user()->AdminName}}@endif</a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">Thay đổi mật khẩu</a>
                    <a class="dropdown-item" href="#">Cập nhật thông tin cá nhân</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" style="color: red" href="{{route('get.logout.admin')}}">Đăng xuất</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="{{route('admin.dashboard')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Trang chủ
                        </a>
                        <a class="nav-link" href="{{route('admin.get.list.recruiter')}}">
                            <div class="sb-nav-link-icon"><i class="fa fa-users"></i></div>
                            Quản lý nhà tuyển dụng
                        </a>
                        <a class="nav-link" href="{{route('admin.get.list.job')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-invoice"></i></div>
                            Quản lý thông tin đăng tuyển
                        </a>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa fa-file-chart-line"></i></div>
                            Quản lý báo cáo thống kê
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="">Thống kê doanh thu</a>
                                <a class="nav-link" href="">Thống kê thành viên</a>
                                <a class="nav-link" href="">Thống kê việc làm</a>
                                <a class="nav-link" href="">Thống kê đánh giá</a>

                            </nav>
                        </div>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main style="background-color: #eee;">
                <div class="container-fluid">
                    <div class="pull-right message-flash" style="position: absolute; right: 30px; margin-top: -15px;">
                        @if(\Illuminate\Support\Facades\Session::has('flash-message'))
                            <div class="alert alert-{!! \Illuminate\Support\Facades\Session::get('flash-level') !!}">
                                {!! \Illuminate\Support\Facades\Session::get('flash-message') !!}
                            </div>
                        @endif
                    </div>
                    @yield('content')
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2020</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('theme-admin/js/scripts.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('theme-admin/assets/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('theme-admin/assets/demo/chart-bar-demo.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(".message-flash").ready(function(){
            setTimeout(function(){
                $(".message-flash").remove();
            }, 5000 ); // 5 secs

        });
    </script>
</body>

</html>