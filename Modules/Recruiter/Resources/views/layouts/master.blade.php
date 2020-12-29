<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Recruiter</title>
        <link href="{{asset('theme-admin/css/styles.css')}}" rel="stylesheet" />
        <link href="{{asset('theme-recruiter/css/master.css')}}" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('/js/vendor/jquery-1.11.3.min.js')}}"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="{{route('recruiter.home')}}">Recruiter</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <div class="job-by-message-menu dropdown">
                <a href="" class="message-apply" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i style="color: white; font-size: 25px" class="fa fa-globe-americas "></i>
                    @if(isset($messageNumber))
                        <div class="message-number">{{$messageNumber}}</div>
                    @endif
                </a>
                <div class="dropdown-content-message dropdown-menu">
                    <div style="font-weight: bold; margin: 0 0 5px 5px">Thông báo</div>
                    @if(isset($messageApply))
                        @foreach($messageApply as $message)
                            <a class="dropdown-item dropdown-item-message @if($message->MessageApplyStatus==1) seen @endif @if($message->MessageApplyStatus==0) notseen @endif"
                               href="{{route('recruiter.get.seeker.by.message',[$message->JobId,$message->SeekerId])}}">
                                <div class="message-company-logo">
                                    <img height="40px" width="40px"
                                         src="{{asset( pare_url_file($message->Avatar)) }}"
                                         style="border-radius: 50%;" class="thumbnail">
                                </div>
                                <div class="message-info">
                                    <div
                                            class="message-job-content @if($message->MessageApplyStatus==1) text-grey @endif @if($message->MessageApplyStatus==0) text-black @endif">
                                        <div class="name" style="word-wrap: break-word;">{{$message->SeekerName}}</div> đã ứng tuyển công việc
                                        <br>
                                        <div style="font-weight: bold;">{{$message->JobName}}</div>
                                    </div>
                                    <div
                                            class="message-date @if($message->MessageApplyStatus==1) text-grey @endif @if($message->MessageApplyStatus==0) text-blue @endif" @if($message->MessageApplyStatus==1) style="font-weight: 400" @endif>
                                        {{$message->ApplyDate}}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endif

                </div>
            </div>

            <form  class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group" style="display: none;">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i>@if(\Illuminate\Support\Facades\Auth::guard('recruiters')->check()){{\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->RecruiterName}}@endif</a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{route('recruiter.get.change.password',\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->id)}}">Thay đổi mật khẩu</a>
                        <a class="dropdown-item" href="{{route('recruiter.get.change.info',\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->id)}}">Cập nhật thông tin cá nhân</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('get.logout.recruiter')}}" style="color: red">Đăng xuất</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="{{route('recruiter.home')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Trang chủ
                            </a>

                            <a class="nav-link" href="{{route('recruiter.get.list.job')}}">
                                <div class="sb-nav-link-icon"><i class="fa fa-chart-area"></i></div>
                                Quản lý thông tin đăng tuyển
                            </a>
                            <a class="nav-link" href="{{route('recruiter.get.transaction')}}">
                                <div class="sb-nav-link-icon"><i class="fa fa-chart-area"></i></div>
                                Quản lý giao dịch
                            </a>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Quản lý thống kê
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('recruiter.get.transaction')}}">Thống kê giao dịch</a>
                                    <a class="nav-link" href="{{route('recruiter.get.statistical.seeker',\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->id)}}">Thống kê số đơn ứng tuyển</a>
                                    <a class="nav-link" href="{{route('recruiter.get.statistical.review',\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->id)}}">Thống kê số đánh giá</a>
                                    <a class="nav-link" href="{{route('recruiter.get.statistical.job',\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->id)}}">Thống kê số việc làm</a>

                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">                 
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content" style="background-color: #eee;">
                <main >

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
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('theme-admin/js/scripts.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('theme-admin/assets/demo/chart-area-demo.js')}}"></script>
        <script src="{{asset('theme-admin/assets/demo/chart-bar-demo.js')}}"></script>
        <!-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script> -->
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
        <script type="text/javascript">
            $(".message-flash").ready(function(){
                setTimeout(function(){
                    $(".message-flash").remove();
                }, 5000 ); // 5 secs

            });
        </script>
    </body>
</html>
