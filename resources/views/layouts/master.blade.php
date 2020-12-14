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
            <div class="nav-item dropdown dropdown-job">
                <a href="{{route('client.get.list.job')}}" type="button" id="navbarDropdown"
                    class="nav-link btn-alljob btn btn-dark">Việc làm IT</a>
                <div class="dropdown-content">
                    <div class="job-by-skill-menu">
                        <a class="dropdown-item nav-link" id="jobBySkill" href="#">Việc làm IT theo kỹ năng<i
                                class="fa fa-chevron-right"></i></a>
                        <div class="dropdown-content-skill row">
                            <a class="dropdown-item dropdown-item-skill col-md-3" href="#">CSS</a>
                            <a class="dropdown-item dropdown-item-skill col-md-3" href="#">Java Script</a>
                            <a class="dropdown-item dropdown-item-skill col-md-3" href="#">Python</a>
                            <a class="dropdown-item dropdown-item-skill col-md-3" href="#">C#</a>
                            <a class="dropdown-item dropdown-item-skill col-md-3" href="#">HTML</a>
                            <a class="dropdown-item dropdown-item-skill col-md-3" href="#">CSS</a>
                            <a class="dropdown-item dropdown-item-skill col-md-3" href="#">Java Script</a>
                            <a class="dropdown-item dropdown-item-skill col-md-3" href="#">Python</a>
                            <a class="dropdown-item dropdown-item-skill col-md-3" href="#">C#</a>
                            <a class="dropdown-item dropdown-item-skill col-md-3" href="#">HTML</a>
                            <a class="dropdown-item dropdown-item-skill col-md-3" href="#">CSS</a>
                            <a class="dropdown-item dropdown-item-skill col-md-3" href="#">Java Script</a>
                            <a class="dropdown-item dropdown-item-skill col-md-3" href="#">Python</a>
                            <a class="dropdown-item dropdown-item-skill col-md-3" href="#">C#</a>
                            <a class="dropdown-item dropdown-item-skill col-md-3" href="#">HTML</a>
                        </div>
                    </div>
                    <div class="job-by-position-menu">
                        <a class="dropdown-item nav-link" id="jobByPosition" href="#">Việc làm IT theo vị trí<i
                                class="fa fa-chevron-right"></i></a>
                        <div class="dropdown-content-position row">
                            @if(isset($positions))
                            @foreach($positions as $position)
                            <a class="dropdown-item dropdown-item-position col-md-3"
                                href="{{route('client.get.job.by.position',$position->PositionId)}}">{{$position->PositionName}}</a>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="job-by-city-menu">
                        <a class="dropdown-item nav-link" id="jobByCity" href="">Việc làm IT theo thành phố<i
                                class="fa fa-chevron-right"></i></a>
                        <div class="dropdown-content-city row">
                            @if(isset($cities))
                            @foreach($cities as $city)
                            <a class="dropdown-item dropdown-item-city col-md-3"
                                href="{{route('client.get.job.by.city',$city->CityId)}}">{{$city->CityName}}</a>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="job-by-company-menu">
                        <a class="dropdown-item nav-link" id="jobByCompany" href="">Việc làm IT theo công ty<i
                                class="fa fa-chevron-right"></i></a>
                        <div class="dropdown-content-company row">
                            @if(isset($companyList))
                            @foreach($companyList as $company)
                            <a class="dropdown-item dropdown-item-company col-md-3"
                                href="{{route('client.get.job.by.company',$company->id)}}">{{$company->CompanyName}}</a>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <a href="" type="button" class="btn-company btn btn-dark">Công ty IT</a>
            @if(!\Illuminate\Support\Facades\Auth::guard('seekers')->check())
            <a href="{{route('seeker.get.login')}}" type="button" class="btn-login btn btn-dark">Đăng nhập</a>
            <a href="{{route('client.confirm.recruiter')}}" type="button" class="btn-recruiter btn btn-dark">Nhà tuyển
                dụng</a>
            @else
            <div class="job-by-message-menu dropdown">
                <a href="" class="message-apply" data-toggle="dropdown"><i style="color: white;"
                        class="fa fa-globe-americas"></i>
                    <div class="message-number">{{$messageNumber->jobNumber}}</div>
                </a>
                <div class="dropdown-content-message dropdown-menu">
                    @if(isset($messageInfos))
                    @foreach($messageInfos as $messageInfo)
                    <a class="dropdown-item dropdown-item-message @if($messageInfo->MessageStatus==1) active @else notactive @endif" href="{{route('client.get.detail.job',$messageInfo->JobId)}}">
                        <div class="message-company-logo">
                            <img height="40px" width="40px" src="{{asset( pare_url_file($messageInfo->CompanyLogo)) }}"
                                style="border-radius: 50%; background-color: red;" class="thumbnail">
                        </div>
                        <div class="message-info">
                            <div class="message-job-name">
                                <div style="font-weight: 700;">{{$messageInfo->CompanyName}} </div> đã duyệt hồ sơ của bạn.
                            </div>
                            <div class="message-date">
                                {{$messageInfo->MessageDate}}
                            </div>
                        </div>
                    </a>
                    @endforeach
                    @endif

                </div>
            </div>
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
        var click = 1;
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

        // $('.message-apply').click( function (event) {
        //     event.preventDefault();
        //     //$('.dropdown-content-message').addClass('show');
        //     if(click==1){
        //         $('.dropdown-content-message').addClass('show');
        //         click = 0;
        //     }else if(click==0){
        //         $('.dropdown-content-message').addClass('hide');
        //         click = 1;
        //     }
        // })

    })
    </script>
</body>

</html>