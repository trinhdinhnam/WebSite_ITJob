@extends('layouts.master')
@section('main')
    <link href="{{asset('theme-seeker/css/list-job-apply.css')}}" rel="stylesheet" />
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
                                     src="{{asset( pare_url_file($job->CompanyLogo)) }}" class="thumbnail">
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
                            @if($job->seekerNumber>=3)
                                <div >
                                    <div class="hot-title">Hot job</div>
                                </div>
                                <div >
                                    <div class="job-city ">{{$job->City}}</div>
                                </div>
                                <div >
                                    <div class="job-created ">{{$job->formatDate($job->CreatedDate)}}</div>

                                </div>
                            @else
                                <div >
                                    <div class="hot-title" style="display: none">Hot job</div>
                                </div>
                                <div style="margin-top: 125px">
                                    <div class="job-city ">{{$job->City}}</div>

                                </div>
                                <div style="margin-top: 120px">
                                    <div class="job-created ">{{$job->formatDate($job->CreatedDate)}}</div>

                                </div>
                            @endif
                        </div>

                        <div class="seeker-info">
                            <label class="badge {{$job->getStatus($job->Status)['class']}} status-apply" >{{$job->getStatus($job->Status)['name']}}</label>
                            <embed class="cv" src="{{asset( pare_url_file($job->CVLink)) }}" width="130" height="158" type="application/pdf">
                            <br>
                            <a href="" class="btn btn-success btn-seen-cv">Xem</a>
                            <br>
                            <p class="date-apply">Ngày ứng tuyển: {{date("d/m/Y", strtotime($job->ApplyDate))}}</p>
                        </div>

                </div>
            @endforeach
        @else
            <h3>Không có việc làm nào!</h3>
        @endif
    </div>

@endsection