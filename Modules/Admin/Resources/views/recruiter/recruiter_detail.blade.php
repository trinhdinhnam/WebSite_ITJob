@extends('admin::layouts.master')
@section('content')
<link href="{{asset('theme-admin/css/recruiter_detail.css')}}" rel="stylesheet" />
<h2 class="mt-4">Chi tiết thông tin nhà tuyển dụng</h2>
<ol class="breadcrumb mb-4 ">
    <li class="breadcrumb-item">Trang chủ</li>
    <li class="breadcrumb-item">Nhà tuyển dụng</li>
    <li class="breadcrumb-item active">Chi tiết</li>
</ol>
<div class="row">
    <div class="recruiter-avatar col-4"></div>
    <div class="recruiter-info col-8">
        <h1 class="recruiter-name">
            <i class="fa fa-user-tie"></i>
            <div class="recruiter-name-value">{{$recruiterDetail->RecruiterName}}</div>
        </h1>
        <h6 class="recruiter-gender">
            <i class="fa fa-transgender"></i>
            <div class="recruiter-gender-value">{{$recruiterDetail->getGender($recruiterDetail->Gender)['name']}}</div>
        </h6>

        <h6 class="recruiter-position">
            <i class="fa fa-mail-bulk"></i>
            <div class="recruiter-position-value">{{$recruiterDetail->Position}}</div>
        </h6>
        <h6 class="recruiter-phone">
            <i class="fa fa-phone"></i>
            <div class="recruiter-phone-value">{{$recruiterDetail->Phone}}</div>
        </h6>
        <h6 class="recruiter-dateofbirth">
            <i class="fa fa-birthday-cake"></i>
            <div class="recruiter-dateofbirth-value">{{$recruiterDetail->DateOfBirth}}</div>
        </h6>
        <h6 class="recruiter-email">
            <i class="fa fa-envelope"></i>
            <div class="recruiter-email-value">{{$recruiterDetail->Email}}</div>
        </h6>
        <h6 class="recruiter-address">
            <i class="fa fa-map-marker-alt"></i>
            <div class="recruiter-address-value">{{$recruiterDetail->Address}}</div>
        </h6>

    </div>
</div>
@endsection