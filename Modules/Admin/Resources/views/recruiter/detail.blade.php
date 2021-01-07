@extends('admin::layouts.master')
@section('content')
<link href="{{asset('theme-admin/css/recruiter_detail.css')}}" rel="stylesheet" />
<h2 class="mt-4">Chi tiết thông tin nhà tuyển dụng</h2>
<ol class="breadcrumb mb-4 ">
    <li class="breadcrumb-item">Trang chủ</li>
    <li class="breadcrumb-item">Nhà tuyển dụng</li>
    <li class="breadcrumb-item active">Chi tiết hồ sơ</li>
</ol>

<div class='row'>
    @if (isset($imageCompanies))
        @foreach($imageCompanies as $image)
            <div class="col-4">
                <div class="company-image">
                    <img height="100%" width="100%" src="{{asset( pare_url_file($image->Image)) }}" class="thumbnail">
                </div>
            </div>
        @endforeach
    @endif
</div>
<div class="row">
    <div class="col-4">
        <div class="company-logo">
            <img height="100%" width="100%"
                 src="{{asset( pare_url_file($recruiterDetail->CompanyLogo)) }}" class="thumbnail">
        </div>
        <div class="company-detail">
            <h4 class="company-name">{{$recruiterDetail->CompanyName}}</h4>
            <p class="company-introduction">{{$recruiterDetail->Introduction}}</p>
            <div class="company-typebusiness">
                <i class="fa fa-cog" style="color: #aaaaaa;"></i>
                <div class="typbusiness-name">{{$recruiterDetail->TypeBusiness}}</div>
            </div>
            <div class="company-size">
                <i class="fa fa-user-friends" style="color: #aaaaaa;"></i>
                <div class="size-value">{{$recruiterDetail->CompanySize}}</div>
            </div>
            <div class="company-address">
                <i class="fa fa-map-marker-alt" style="color: #aaaaaa;"></i>
                <div class="address-value">{{$recruiterDetail->Address}}</div>
            </div>
            <div class="company-workday">
                <i class="fa fa-calendar-alt" style="color: #aaaaaa;"></i>
                <div class="workday-value">{{$recruiterDetail->WorkDay}}</div>
            </div>
            <div class="company-worktime">
                <i class="fa fa-clock" style="color: #aaaaaa;"></i>
                <div class="worktime-value">{{$recruiterDetail->TimeWork}}</div>
            </div>
        </div>
    </div>
    <div class="col-8">
        <h2 style="margin-bottom: 40px;">Hồ sơ người tuyển dụng</h2>
        <div class="recruiter-profile">
            <div class="recruiter-avatar">
                <img height="100%" width="100%" src="{{asset( pare_url_file($recruiterDetail->Avatar)) }}" class="thumbnail">
            </div>
            <div class="recruiter-info ">
                <h1 class="recruiter-name">
                    <div class="recruiter-name-value">{{$recruiterDetail->RecruiterName}}</div>
                </h1>
                <div class="person-info">
                    <h6 class="recruiter-position">
                        <i class="fa fa-user-check"></i>
                        <div class="recruiter-position-value">{{$recruiterDetail->Position}}</div>
                    </h6>
                    <h6 class="recruiter-phone">
                        <i class="fa fa-phone"></i>
                        <div class="recruiter-phone-value">{{$recruiterDetail->Phone}}</div>
                    </h6>

                    <h6 class="recruiter-email">
                        <i class="fa fa-envelope"></i>
                        <div class="recruiter-email-value">{{$recruiterDetail->email}}</div>
                    </h6>

                </div>


            </div>
        </div>

    </div>
</div>

@endsection