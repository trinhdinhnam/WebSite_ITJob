@extends('layouts.master')
@section('main')
<link href="{{asset('theme-admin/css/client/job-detail.css')}}" rel="stylesheet" />
<div class='row'>
    @if (isset($imageCompanies))
        @foreach($imageCompanies as $image)
    <div class="col-4">
        <div class="job-image">
            <img height="100%" width="100%" src="{{asset( pare_url_file($image->Image)) }}" class="thumbnail">
        </div>
    </div>
        @endforeach
    @endif

</div>
<div class="row">
    <div class="col-4">
        <div class="company-logo">
            <img height="100%" width="100%" src="{{asset( pare_url_file($jobDetail->recruiter->CompanyLogo)) }}" class="thumbnail">
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
        <div class="date-up-job">
            <i class="fa fa-calendar-alt" style="color: #000;"></i>
            <div class="date-up-job-value">{{$jobDetail->created_at}}</div>
        </div>
        <a href="" class="btn-apply btn btn-danger">Ứng tuyển</a>
        <h2 class="description-title">Chi tiết công việc</h2>
        <div>{{$jobDetail->Description}}</div>

        <h2 class="require-title">Yêu cầu</h2>
        <div>{{$jobDetail->Require}}</div>
    </div>
</div>
@endsection