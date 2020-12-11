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
            @if(!\Illuminate\Support\Facades\Auth::check())
            <a href="{{route('seeker.get.login')}}" type="button" class="btn-login btn btn-dark">Đăng nhập</a>
            <a href="{{route('client.confirm.recruiter')}}" type="button" class="btn-recruiter btn btn-dark">Nhà tuyển dụng</a>
                @else
            @endif
        </div>
    </div>
    <div class="main">
        @yield('main')
    </div>
    <div class="footer">
    </div>
    <div class="modal fade" id="myModalLogin" role="dialog" style="width: auto; height: auto;">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" id="md_content" style="border-radius: 15px;">
            </div>
        </div>
    </div>
    <!-- <div class="modal fade" id="myModalSignup" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content modal-lg" id="md_content_signup" style="border-radius: 15px; ">
            </div>
        </div>
    </div> -->
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

        $('#myModalLogin').on('hidden.bs.modal', function (e) {
            location.reload();
        });
        /* Modal Signup */
        // $(".btn-signup").on('click', function(e) {
        //     e.preventDefault();
        //     $("#myModalLogin").modal('hide');
        //     let $this = $(this);
        //     let url = $this.attr('href');
        //     $.ajax({
        //         url: url,
        //     }).done(function(result) {
        //         if (result) {
        //             $("#md_content_signup").append(result);
        //         }
        //     });

        //     $("#myModalSignup").modal('show');
        // });
        // $('#myModalSignup').on('hidden.bs.modal', function(e) {
        //     location.reload();
        // });
    })
    </script>
</body>

</html>