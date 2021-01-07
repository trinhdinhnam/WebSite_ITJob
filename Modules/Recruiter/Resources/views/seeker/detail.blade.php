@extends('recruiter::layouts.master')

@section('content')
    <link href="{{asset('/css/common.css')}}" rel="stylesheet" />
<link href="{{asset('theme-recruiter/css/seeker_detail.css')}}" rel="stylesheet" />
<h2 class="mt-4">Danh sách ứng viên</h2>
<ol class="breadcrumb mb-4 ">
    <li class="breadcrumb-item"><a href="{{route('recruiter.home')}}">Trang chủ</a></li>
    <li class="breadcrumb-item"><a href="{{route('recruiter.get.list.job')}}">Thông tin đăng tuyển</a></li>
    <li class="breadcrumb-item"><a href="">Danh sách ứng viên</a></li>
    <li class="breadcrumb-item active">Hồ sơ ứng viên</li>

</ol>

<div class="seeker-detail row">
    <div class="seeker-info col-3">
        <div class="seeker-logo">
            <img height="100%" width="100%" src="{{asset('images/ky21.JPG')}}" class="thumbnail">
        </div>
        <div class="seeker-name">
            <h2>{{$seekerDetail->seeker->SeekerName}}</h2>
        </div>
        <div class="seeker-gender"><i
                class="fa fa-transgender"></i>{{$seekerDetail->seeker->getGender($seekerDetail->seeker->Gender)['name']}}</div>
        <div class="seeker-dateofbirth"><i class="fa fa-birthday-cake"></i>{{$seekerDetail->seeker->DateOfBirth}}</div>
        <div class="seeker-email"><i class="fa fa-envelope"></i>{{$seekerDetail->seeker->Email}}</div>
        <div class="seeker-phone"><i class="fa fa-phone-volume"></i>{{$seekerDetail->seeker->Phone}}</div>
        <div class="seeker-address"><i class="fa fa-map-marker-alt"></i><div class="address-value">{{$seekerDetail->seeker->Address}}</div></div>
        <div class="seeker-education"><i
                class="fa fa-graduation-cap"></i>{{$seekerDetail->seeker->getEducation($seekerDetail->seeker->Education)['name']}}</div>
        <div class="date-apply"><i class="fa fa-calendar-alt"></i>{{$seekerDetail->created_at}}</div>
        <div class="btn-accept"><a href="" class="btn btn-success @if($seekerDetail->Status==1) disabled @endif"><i class="fa fa-check"></i> Duyệt hồ sơ</a></div>

    </div>

    <div class="seeker-cv col-9">
        <embed src="{{asset('images/PHP_Internship_Fresher_TrinhDinhNam.pdf')}}" width="100%" height="1800px">
    </div>
</div>
@endsection