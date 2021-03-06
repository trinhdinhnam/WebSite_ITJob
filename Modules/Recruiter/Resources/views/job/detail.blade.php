@extends('recruiter::layouts.master')
@section('content')
    <link href="{{asset('/css/common.css')}}" rel="stylesheet" />
    <link href="{{asset('theme-admin/css/job_detail.css')}}" rel="stylesheet" />
    <h2 class="mt-4">Chi tiết thông tin đăng tuyển</h2>
    <ol class="breadcrumb mb-4 ">
        <li class="breadcrumb-item">Trang chủ</li>
        <li class="breadcrumb-item">Thông tin đăng tuyển</li>
        <li class="breadcrumb-item active">Chi tiết</li>
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
                     src="{{asset( pare_url_file($jobDetail->recruiter->CompanyLogo)) }}" class="thumbnail">
            </div>
            <div class="company-detail">
                <h4 class="company-name">{{$jobDetail->recruiter->CompanyName}}</h4>
                <p class="company-introduction">{{$jobDetail->recruiter->Introduction}}</p>
                <div class="company-typebusiness">
                    <i class="fa fa-cog" style="color: #aaaaaa;"></i>
                    <div class="typbusiness-name">{{$jobDetail->recruiter->TypeBusiness}}</div>
                </div>
                <div class="company-size">
                    <i class="fa fa-user-friends" style="color: #aaaaaa;"></i>
                    <div class="size-value">{{$jobDetail->recruiter->CompanySize}}</div>
                </div>
                <div class="company-address">
                    <i class="fa fa-map-marker-alt" style="color: #aaaaaa;"></i>
                    <div class="address-value">{{$jobDetail->recruiter->Address}}</div>
                </div>
                <div class="company-workday">
                    <i class="fa fa-calendar-alt" style="color: #aaaaaa;"></i>
                    <div class="workday-value">{{$jobDetail->recruiter->WorkDay}}</div>
                </div>
                <div class="company-worktime">
                    <i class="fa fa-clock" style="color: #aaaaaa;"></i>
                    <div class="worktime-value">{{$jobDetail->recruiter->TimeWork}}</div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <h2>{{$jobDetail->JobName}}</h2>
            <div class="skill">
                @foreach(explode(", ",$jobDetail->Skill) as $skill)
                    <div class="language-name">{{$skill}}</div>
                @endforeach
            </div>
            <div class="job-address">
                <i class="fa fa-map-marker-alt"></i>
                <div class="address-value">{{$jobDetail->Address}}</div>
            </div>
            <div class="date-up-job" style="color: #22f;">
                <i class="fa fa-calendar-alt" ></i>
                <div class="date-up-job-value">{{$jobDetail->formatDate($jobDetail->created_at)}}</div>
            </div>
            <h3 class="description-title">Chi tiết công việc</h3>
            <div>{{$jobDetail->Description}}</div>

            <h3 class="require-title">Yêu cầu</h3>
            <div>{{$jobDetail->Require}}</div>

            @if(isset($jobDetail->Benifit))
                <h3 class="benifit-title">Lợi ích</h3>
                @foreach(explode(". ",$jobDetail->Benifit) as $benifit)
                    <div>* {{$benifit}}</div>
                @endforeach
            @endif
        </div>
    </div>
@endsection