<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('/js/vendor/jquery-1.11.3.min.js')}}"></script>
    <link href="{{asset('theme-admin/css/client/client_layout.css')}}" rel="stylesheet" />
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
                            @if(isset($skills))
                                @foreach($skills as $skill)
                                    <a class="dropdown-item dropdown-item-skill col-md-3" href="{{route('client.get.job.by.skill',$skill->SkillName)}}">{{$skill->SkillName}}</a>
                                @endforeach
                            @endif
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
                        <div class="dropdown-content-company">
                            @if(isset($companyList))
                            @foreach($companyList as $company)
                            <a class="dropdown-item dropdown-item-company"
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
                    @if(isset($messageNumber))
                    <div class="message-number">{{$messageNumber}}</div>
                    @endif
                </a>
                <div class="dropdown-content-message dropdown-menu">
                    @if(isset($messageInfos))
                    @foreach($messageInfos as $messageInfo)
                    <a class="dropdown-item dropdown-item-message @if($messageInfo->MessageStatus==0) seen @endif @if($messageInfo->MessageStatus==1) notseen @endif" href="{{route('client.get.job.by.message',$messageInfo->JobId)}}">
                        <div class="message-company-logo">
                            <img height="40px" width="40px" src="{{asset( pare_url_file($messageInfo->CompanyLogo)) }}"
                                style="border-radius: 50%; background-color: red;" class="thumbnail">
                        </div>
                        <div class="message-info">
                            <div class="message-job-name @if($messageInfo->MessageStatus==0) text-grey @endif @if($messageInfo->MessageStatus==1) text-black @endif">
                                <div style="font-weight: 700; margin-right: 5px;">{{$messageInfo->CompanyName}} </div> đã duyệt hồ sơ của bạn.
                            </div>
                            <div class="message-date @if($messageInfo->MessageStatus==0) text-grey @endif @if($messageInfo->MessageStatus==1) text-blue @endif">
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
                    <a class="dropdown-item" href="{{route('client.get.job.apply',\Illuminate\Support\Facades\Auth::guard('seekers')->user()->id)}}"><i class="fa fa-eye" style="margin-right: 5px;"></i> Xem đơn ứng tuyển</a>
                    <a class="dropdown-item" href="{{route('client.get.change.info',\Illuminate\Support\Facades\Auth::guard('seekers')->user()->id)}}"><i class="fa fa-edit" style="margin-right: 8px;"></i>Thay đổi thông tin cá nhân</a>
                    <a class="dropdown-item" href="{{route('client.get.change.password',\Illuminate\Support\Facades\Auth::guard('seekers')->user()->id)}}"><i class="fa fa-unlock-alt" style="margin-right: 13px;"></i>Cập nhật mật khẩu</a>
                    <a class="dropdown-item" href="{{route('seeker.get.logout')}}"><i class="fa fa-sign-in-alt" style="margin-right: 8px;"></i> Đăng xuất</a>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="main">
        <div class="pull-right message-flash" style=" z-index: 1; position: absolute; right: 420px; margin-top: -15px;">
            @if(\Illuminate\Support\Facades\Session::has('flash-message'))
                <div class="alert alert-{!! \Illuminate\Support\Facades\Session::get('flash-level') !!}">
                    {!! \Illuminate\Support\Facades\Session::get('flash-message') !!}
                </div>
            @endif
        </div>
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
                    <a href="{{route('client.get.home.page')}}">Trang chủ</a>
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
    @yield('script')
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
        $(".message-flash").ready(function(){
            setTimeout(function(){
                $(".message-flash").remove();
            }, 5000 ); // 5 secs

        });

    })
    </script>
</body>

</html>