@extends('layouts.master')
@section('main')
<link href="{{asset('theme-admin/css/client/recruiter-confirm.css')}}" rel="stylesheet" />
<div class="content">
    <div class="content-container">
        <div class="confirm-detail-content">
            <div style="display: flex;">
                <div class="title">Bạn muốn có những ứng viên IT tuyện vời?</div>
                <div style="margin-left: 220px; font-size: 14px; margin-top: 10px;"> <a href="{{route('recruiter.get.login')}}" style="color: red;"><i class="fa fa-caret-right"></i> Đăng nhập</a> </div>
            </div>
            <div class="title2">Cung cấp cho chúng tôi thông tin chi tiết của bạn và nhân viên của chúng tôi sẽ liên hệ
                với bạn về dịch vụ của chúng tôi!
            </div>
            <a href="{{route('recruiter.signup')}}" class="btn btn-danger">Có, tôi muốn trở thành nhà tuyển dụng</a>
            <div class="title-contact">Liên hệ với chúng tôi</div>
            <div style="display: flex; margin-top: 20px; font-weight: 400;">Hotline HCM <p style="margin-left: 43px">
                    0395699933</p>
            </div>
            <div style="display: flex; margin-top: -10px; font-weight: 400;"> Hotline Hà Nội <p
                    style="margin-left: 30px; ">0941870894</p>
            </div>
            <div class="title-company">Các công ty lớn đã chọn Phương Nam Recruiment</div>
            <div class="company">
                @if(isset($companies))
                    @foreach($companies as $company)
                <div class="company-item">
                    <div class="company-logo">
                        <img height="100%" width="100%" src="{{asset( pare_url_file($company->CompanyLogo)) }}"
                             class="thumbnail">
                    </div>
                </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
</div>
@endsection