@extends('layouts.master')
@section('main')
<link href="{{asset('theme-admin/css/client/job-list.css')}}" rel="stylesheet" />
<div class="main">
    <div class="content-job">
        <div class="job-list">
            <div class="job-title">Danh sách việc làm</div>
            @if(isset($jobs))
            @foreach($jobs as $job)
            <div class="job-item">
                <div class="company-logo">
                    <div class="logo">
                        <img height="100%" width="100%" src="{{asset( pare_url_file($job->recruiter->CompanyLogo)) }}"
                            class="thumbnail">
                    </div>
                </div>
                <div class="job-info">
                    <div class="job-name">
                        <h3><a href="">{{$job->JobName}}</a></h3>
                    </div>
                    <div class="job-salary">
                        <h6> Up to {{number_format($job->Salary,0,',','.')}} VNĐ</h6>
                    </div>
                    @if($job->Benifit!='')
                    @foreach(explode(". ",$job->Benifit) as $benifit)
                    <div class="job-benifit">* {{$benifit}}</div>
                    @endforeach
                    @endif
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
                    <div class="hot-title">Hot job</div>
                    <div class="job-city">{{$job->City}}</div>
                    <div class="job-created">5 giờ trước</div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
        <div class="company-hot">
            <div class="company-hot-title">Nhà tuyển dụng nổi bật</div>
            <div class="company-image" style="background-image: url({{asset( pare_url_file($imageCompany->Image))}})">
                <div class="company-logo">
                    <img height="100%" width="100%" src="{{asset( pare_url_file($companyHot->CompanyLogo))}}"
                        class="thumbnail">
                </div>
            </div>

            <div class="company-name">
                <h5>{{$companyHot->CompanyName}}</h5>
            </div>
            <div class="company-city">
                <p>{{$companyHot->City}}</p>
            </div>
            <div class="company-introduction">{{$companyHot->Introduction}}
            </div>
            @if(isset($jobsByCompanyHot))
            @foreach($jobsByCompanyHot as $job)
            <div class="job-item">
                <a href="" class="job-name">{{$job->JobName}}</a>
            </div>
            @endforeach
            @endif
            <div class="job-number">
                <a href="">{{$jobnumberByCompanyHot->jobNumber}} công việc <i class="fa fa-caret-right"></i></a>
            </div>
        </div>
    </div>
</div>

@endsection