@extends('layouts.master')
@section('main')

<link href="{{asset('theme-admin/css/client/job-by-company.css')}}" rel="stylesheet" />

@if(isset($company))
<div class="page-header">
    <div class="company-logo">
        <div class="logo">
            <img height="100%" width="100%" src="{{asset( pare_url_file($company->CompanyLogo)) }}" class="thumbnail">
        </div>
    </div>
    <div class="company-info">
        <div class="company-name">{{$company->CompanyName}}</div>
        <div class="company-address">
            <i class="fa fa-map-marker-alt"></i>
            <div class="address-value">{{$company->City}}</div>
        </div>
        <div class="company-type">
            <i class="fa fa-cog" style="color: #aaaaaa; margin-top: 5px; font-size: 18px;"></i>
            <div class="type-business">{{$company->TypeBusiness}}</div>
            <i class="fa fa-users"></i>
            <div class="company-size">
            {{$company->CompanySize}} nhân sự
            </div>
            <i class="fa fa-globe"></i>
            <div class="country">{{$company->Country}}</div>
        </div>
        <div class="company-date-work">
            <i class="fa fa-calendar-alt"></i>
            <div class="work-day">{{$company->WorkDay}}</div>
        </div>

        <div class="company-over-time">
            <i class="fa fa-clock"></i>
            <div class="over-time">Không OT</div>
        </div>
    </div>
    <div class="company-event">
        <a href="" class="btn btn-danger btn-review">Viết review</a>
        <a href="" class="btn-follow btn btn-light">Theo dõi</a>
    </div>
</div>
<div class="page-content row">
    <div class="col-md-8 item-list">
        <div class="navigation-item">
            <a href="" class="btn btn-light btn-job-item">Tuyển dụng</a>
            <a href="" class="btn btn-light btn-review-item">14 review</a>
        </div>
        <div class="job-list">
            <div class="company-name-title"> {{$company->CompanyName}} tuyển dụng</div>
            @if(isset($company))
                @foreach($jobByCompanys as $job)

            <div class="job-item">
                <div class="company-logo">
                    <div class="logo">
                        <img height="100%" width="100%" src="{{asset( pare_url_file($job->recruiter->CompanyLogo)) }}" class="thumbnail">

                    </div>
                </div>
                <div class="job-info">
                    <div class="job-name">
                        <h3><a href="">{{$job->JobName}}</a></h3>
                    </div>
                    <div class="job-salary">
                        <h6>{{$job->Salary}}</h6>
                    </div>

                    <div class="job-description">{{$job->Description}}</div>
                    <div class="job-skill">
                        @if(isset($job->Skill))
                            @foreach(explode(", ",$job->Skill) as $skill)
                                <div class="skill-item">{{$skill}}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="job-status">
                    <div class="hot-title ">Hot job</div>
                    <div class="job-city ">{{$job->City}}</div>
                    <div class="job-created ">5 giờ trước</div>
                </div>
            </div>
                @endforeach
            @endif

        </div>


    </div>

    <div class="col-md-4 review-hot">

    </div>

</div>
@endif

@endsection