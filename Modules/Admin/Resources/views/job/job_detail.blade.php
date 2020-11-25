@extends('admin::layouts.master')
@section('content')

<h2 class="mt-4">Chi tiết thông tin đăng tuyển</h2>
<ol class="breadcrumb mb-4 ">
    <li class="breadcrumb-item">Trang chủ</li>
    <li class="breadcrumb-item">Thông tin đăng tuyển</li>
    <li class="breadcrumb-item active">Chi tiết</li>
</ol>
<div class="row">
    <div class="col-4">
        <div class="company-logo">

        </div>
        <div class="company-detail">
            <h4 class="company-name">{{$jobDetail->company->CompanyName}}</h4>
            <p class="company-introduction">{{$jobDetail->company->Introduction}}</p>
            <div class="company-typebusiness">
                <i class="fa fa-cog" style="color: #aaaaaa;"></i>
                <div class="typbusiness-name">{{$jobDetail->company->TypeBussiness}}</div>
            </div>
            <div class="company-size">
                <i class="fa fa-user-friends" style="color: #aaaaaa;"></i>
                <div class="size-value">{{$jobDetail->company->CompanySize}}</div>
            </div>
            <div class="company-address">
                <i class="fa fa-map-marker-alt" style="color: #aaaaaa;"></i>
                <div class="address-value">{{$jobDetail->company->Address}}</div>
            </div>
            <div class="company-datework">
                <i class="fa fa-calendar-alt" style="color: #aaaaaa;"></i>
                <div class="datework-value">{{$jobDetail->company->StartDateWorking}} -
                    {{$jobDetail->company->EndDateWorking}}</div>

            </div>
        </div>
    </div>
    <div class="col-8">
        <h2>{{$jobDetail->JobName}}</h2>
        <div class="language-name">{{$jobDetail->language->LanguageName}}</div>
        <div class="job-address">
            <i class="fa fa-map-marker-alt"></i>
            <div class="address-value">{{$jobDetail->Address}}</div>
        </div>
        <div class="date-up-job">
            <i class="fa fa-calendar-alt" style="color: #000;"></i>
            <div class="date-up-job-value">{{$jobDetail->created_at}}</div>
        </div>
        <h2 class="description-title">Chi tiết công việc</h2>
        <div>{{$jobDetail->Description}}</div>

        <h2 class="require-title">Yêu cầu</h2>
        <div>{{$jobDetail->Require}}</div>
    </div>
</div>
@endsection