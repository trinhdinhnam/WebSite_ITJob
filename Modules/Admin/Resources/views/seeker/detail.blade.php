@extends('admin::layouts.master')
@section('content')
    <link href="{{asset('/css/common.css')}}" rel="stylesheet" />
    <link href="{{asset('/theme-admin/css/transaction-detail.css')}}" rel="stylesheet" />
    <h2 class="mt-4">Chi tiết thông tin người tìm việc</h2>
    <ol class="breadcrumb mb-4 ">
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active">Người tìm việc</li>
        <li class="breadcrumb-item active">Chi tiết</li>
    </ol>

    <div class="main">
        <div class="content" >
            @if(isset($seekerDetail))
                <div class="form-group" style="text-align: center">
                    <img height="180px" width="150px" src="{{asset(pare_url_file($seekerDetail->Avatar))}}" class="thumbnail">
                </div>
                <div class="form-group row">
                    <h6 class="col-3">Tên người tìm việc:</h6>
                    <input type="text" class="form-control col-8 dis"
                           value="{{$seekerDetail->SeekerName}}" name="SeekerName">
                </div>
                <div class="form-group row">
                    <h6 class="col-3">Giới tính:</h6>
                    <input type="text" class="form-control col-8 dis"
                           value="{{$seekerDetail->getGender($seekerDetail->Gender)['name']}}" name="SeekerName">
                </div>
                <div class="form-group row">
                    <h6 class="col-3">Ngày sinh:</h6>
                    <input type="text" class="form-control col-8 dis"
                           value="{{$seekerDetail->DateOfBirth}}" name="SeekerName">
                </div>
                <div class="form-group row">
                    <h6 class="col-3">Học vấn</h6>
                    <input type="text" class="form-control col-8 dis"
                           value="{{$seekerDetail->getEducation($seekerDetail->Education)['name']}}" name="Education">
                </div>
                <div class="form-group row">
                    <h6 class="col-3">Số điện thoại</h6>
                    <input type="text" class="form-control col-8 dis"
                           value="{{$seekerDetail->Phone}}" name="Phone">
                </div>
                <div class="form-group row">
                    <h6 class="col-3">Email</h6>
                    <input type="text" class="form-control col-8 dis"
                           value="{{$seekerDetail->email}}" name="Email">
                </div>

                <div class="form-group row">
                    <h6 class="col-3">Địa chỉ thường trú</h6>
                    <input type="text" class="form-control col-8 dis"
                           value="{{$seekerDetail->Address}}" name="Address">
                </div>
                <div class="form-group row">
                    <h6 class="col-3">Địa chỉ tạm trú</h6>
                    <input type="text" class="form-control col-8 dis"
                           value="{{$seekerDetail->TemporaryAddress}}" name="TemporaryAddress">
                </div>

                <div class="form-group row">
                    <h6 class="col-3">Trạng thái: </h6>
                    <input type="text" class="form-control col-8 dis" style="color: red"
                           value="{{$seekerDetail->getActive($seekerDetail->Active)['name']}}" name="Active">
                </div>

            @endif
        </div>
    </div>

@stop