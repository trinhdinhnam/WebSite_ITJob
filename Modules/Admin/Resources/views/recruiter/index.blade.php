@extends('admin::layouts.master')

@section('content')
<h2 class="mt-4">Nhà tuyển dụng</h2>
<ol class="breadcrumb mb-4 ">
    <li class="breadcrumb-item">Trang chủ</li>
    <li class="breadcrumb-item active">Nhà tuyển dụng</li>
</ol>
<div class="card mb-4">
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>

                <th scope="col">Tên nhà tuyển dụng</th>
                <th scope="col">Chức vụ</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Tài khoản</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($recruiters))
            <?php $i=1 ?>
            @foreach($recruiters as $recruiter)
            <tr>
                <th scope="row">{{$i++}}</th>
                <td>{{$recruiter->RecruiterName}}</td>
                <td>{{$recruiter->Position}}</td>
                <td>{{$recruiter->Phone}}</td>
                <td>{{$recruiter->recruiterLevel->RecruiterLevelName}}</td>
                <td>
                    <a href="{{route('admin.get.action.recruiter',['active',$recruiter->id])}}"
                        class="badge {{$recruiter->getActive($recruiter->Active)['class']}}">{{$recruiter->getActive($recruiter->Active)['name']}}</a>
                </td>
                <td>
                    <a href="{{route('admin.get.detail.recruiter',$recruiter->id)}}" class="btn btn-primary">Xem</a>
                    <a href="{{route('admin.get.action.recruiter',['delete',$recruiter->id])}}" class="btn btn-danger">Xóa</a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    @endsection