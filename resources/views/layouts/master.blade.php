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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{asset('/js/vendor/jquery-1.11.3.min.js')}}"></script>

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
            @if(!\Illuminate\Support\Facades\Auth::guard('seekers')->check())
            <a href="{{route('seeker.get.login')}}" type="button" class="btn-login btn btn-dark">Đăng nhập</a>
            <a href="{{route('client.confirm.recruiter')}}" type="button" class="btn-recruiter btn btn-dark">Nhà tuyển
                dụng</a>
            @else
            <a href="" class="message-apply"><i style="color: white;" class="fa fa-globe-americas"></i>
                <div class="message-number">6</div>
            </a>
            <div class="seeker-avatar">
                <img height="100%" width="100%"
                    src="{{asset( pare_url_file(\Illuminate\Support\Facades\Auth::guard('seekers')->user()->Avatar)) }}"
                    class="thumbnail">
            </div>
            <div class="seeker-name">
                @if(\Illuminate\Support\Facades\Auth::guard('seekers')->check()){{\Illuminate\Support\Facades\Auth::guard('seekers')->user()->SeekerName}}@endif
            </div>
            <div class="nav-item dropdown dropdown-user">
                <a class="nav-link" href="#" id="navbarDropdown"><i class="fa fa-chevron-circle-down"></i></a>
                <div class="dropdown-content">
                    <a class="dropdown-item" href="#">Xem đơn ứng tuyển</a>
                    <a class="dropdown-item" href="#">Thay đổi thông tin cá nhân</a>
                    <a class="dropdown-item" href="#">Cập nhật mật khẩu</a>
                    <a class="dropdown-item" href="{{route('seeker.get.logout')}}">Đăng xuất</a>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="main">
        @yield('main')
    </div>
    <div class="footer">
        <div class="footer-container">
            <div class='contact-title'>Liên hệ để đăng tin tuyển dụng tại: </div>
            <ul>
                <li>Hồ Chí Minh: (+84)0395699933 - Hà Nội: (+84)0395699933 - Email: nam162661@nuce.edu.vn</li>
            </ul>
            <div class="row">
                <div class="col-md-4">
                    <div>Về PhuongNam Recruiment</div>
                    <a href="">Trang chủ</a>
                    </br>
                    <a href="">Việc làm it</a>
                    </br>
                    <a href="">Liên hệ</a>
                    </br>
                    <a href="">Câu hỏi thường gặp</a>
                </div>
                <div class="col-md-4">
                <div>Điều khoản chung</div>
                    <a href="">Quy định bảo mật</a>
                    </br>
                    <a href="">Quy chế hoạt động</a>
                    </br>
                    <a href="">Giải quyết khiếu nại</a>
                    </br>
                    <a href="">Thỏa thuẩn sử dụng</a>
                    </br>
                    <a href="">Thông cáo báo chí</a>
                </div>
                <div class="col-md-4">
                <a href="">MST: 093884888553</a>
                    </br>
                    <a href="">Điện thoại: 0941870894</a>
                    </br>
                    <a href="">Địa chỉ: Tòa nhà Handico 6, Khu tập thể Trung Hòa Nhân Chính,Hà Nội</a>
                    </br>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="myModalLogin" role="dialog" style="width: auto; height: auto;">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" id="md_content" style="border-radius: 15px;">
            </div>
        </div>
    </div>
    <!-- Thư viện jquery đã nén phục vụ cho bootstrap.min.js  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Thư viện popper đã nén phục vụ cho bootstrap.min.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
    <!-- Bản js đã nén của bootstrap 4, đặt dưới cùng trước thẻ đóng body-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>


    <script type="text/javascript">
    $(function() {
        $(".btn-login").click(function(event) {
            event.preventDefault();
            let $this = $(this);
            let url = $this.attr('href');
            $.ajax({
                url: url,
            }).done(function(result) {
                if (result) {
                    $("#md_content").append(result);
                }
            });
            $("#myModalLogin").modal('show');
        });

        $('#myModalLogin').on('hidden.bs.modal', function(e) {
            location.reload();
        });
    })
    </script>
</body>

</html>