@extends('recruiter::layouts.master')

@section('content')
    <link href="{{asset('/css/common.css')}}" rel="stylesheet" />

    <link href="{{asset('theme-recruiter/css/seeker_list.css')}}" rel="stylesheet" />
<h2 class="mt-4">Danh sách ứng viên</h2>
<ol class="breadcrumb mb-4 ">
    <li class="breadcrumb-item"><a href="{{route('recruiter.home')}}">Trang chủ</a></li>
    <li class="breadcrumb-item"><a href="{{route('recruiter.get.list.job')}}">Thông tin đăng tuyển</a></li>

    <li class="breadcrumb-item active">Danh sách ứng viên</li>
</ol>

<div class="list-seeker">
    @if(isset($seekerByJobs))
        @foreach($seekerByJobs as $seekerByJob)

     <div class="seeker-item row">
        <div class="seeker-avatar col-2">
            <img height="170px" width="140px" src="{{asset('images/ky21.JPG')}}" class="thumbnail">
        </div>
        <div class="seeker-info col-8">
            <div class="seeker-name">
                <h2>{{$seekerByJob->seeker->SeekerName}}</h2>
                <a style="height: 20px; margin-left: 5px;" class="badge {{$seekerByJob->getStatus($seekerByJob->Status)['class']}}">{{$seekerByJob->getStatus($seekerByJob->Status)['name']}}</a>
            </div>
            <div class="seeker-gender"><i class="fa fa-transgender"></i>{{$seekerByJob->seeker->getGender($seekerByJob->seeker->Gender)['name']}}</div>
            <div class="seeker-email"><i class="fa fa-envelope"></i>{{$seekerByJob->seeker->Email}}</div>
            <div class="seeker-phone"><i class="fa fa-phone-volume"></i>{{$seekerByJob->seeker->Phone}}</div>
            <div class="seeker-education"><i class="fa fa-graduation-cap"></i>{{$seekerByJob->seeker->getEducation($seekerByJob->seeker->Education)['name']}}</div>
            <div class="date-apply"><i class="fa fa-calendar-alt"></i>{{$seekerByJob->created_at}}</div>
        </div>
        <div class="button col-2">
            <a href="{{route('recruiter.get.action.seeker.by.job',['status',$seekerByJob->SeekerJobId])}}"
               class="btn btn-success @if($seekerByJob->Status==1) disabled @endif"><i class="fa fa-check"></i></a>
            <a href="{{route('recruiter.get.seeker.detail', $seekerByJob->SeekerJobId)}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
            <a href="{{route('recruiter.get.action.seeker.by.job',['delete',$seekerByJob->SeekerJobId])}}"
               class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
        </div>

    </div>
        @endforeach
        @endif

</div>
@endsection