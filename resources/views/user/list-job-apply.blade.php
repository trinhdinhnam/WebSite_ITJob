@extends('layouts.master')
@section('main')
    <link href="{{asset('theme-admin/css/client/list-job-apply.css')}}" rel="stylesheet" />
    <div class="job-list">
        <div class="title">
            Danh sách công việc đã ứng tuyển
        </div>
        @if(isset($jobApplies))
            @foreach($jobApplies as $job)
                <div class="job-item">
                    <div class="company-logo">
                        <div class="logo">
                            <img height="100%" width="100%"
                                 src="{{asset( pare_url_file($job->recruiter->CompanyLogo)) }}" class="thumbnail">
                        </div>
                    </div>
                    <div class="job-info">
                        <div class="job-name">
                            <h3><a href="{{route('client.get.detail.job',$job->JobId)}}">{{$job->JobName}}</a></h3>
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
                        <div class="job-created">{{$job->formatDate($job->created_at)}}</div>
                    </div>
                </div>
            @endforeach
        @else
            <h3>Không có việc làm nào!</h3>
        @endif
    </div>

@endsection