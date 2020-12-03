@extends('recruiter::layouts.master')

@section('content')
<h2 class="mt-4">Thông tin đăng tuyển <a href="{{route('recruiter.get.create.job')}}"  class="btn btn-primary" style=" float: right;">Thêm mới</a></h2>
<ol class="breadcrumb mb-4 ">
    <li class="breadcrumb-item"><a href="{{route('recruiter.home')}}">Trang chủ</a></li>
    <li class="breadcrumb-item active">Thông tin đăng tuyển</li>
</ol>
<div class="card mb-4">
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên công việc</th>
                <th scope="col">Vị trí</th>
                <th scope="col">Kỹ năng</th>
                <th scope="col">Địa chỉ</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Số ứng viên</th>
                <th scope="col">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($jobs))
            <?php $i=0 ?>
            @foreach($jobs as $job)
            <tr>
                <th scope="row">{{$i + 1}}</th>
                <td>{{$job->JobName}}</td>
                <td>{{$job->PositionName}}</td>
                <td>{{$job->Skill}}</td>
                <td>{{$job->Address}}</td>
                <td>
                </td>
                <td style="width: 100px; text-align: center;">
                    <a href="{{route('recruiter.get.seeker.by.job',$job->JobId)}}" class="btn btn-primary"
                       style="border-radius: 50%; background-color: #567; border: none; width: 37px;">
                        {{$job->seekerNumber}}</a>
                </td>
                <td style="width: 200px;">
                    <a href="{{route('recruiter.get.detail.job',$job->JobId)}}" class="btn btn-primary">Xem</a>
                    <a href="{{route('recruiter.get.edit.job',$job->JobId)}}" class="btn btn-success">Sửa</a>
                    <a href="{{route('recruiter.get.delete.job',$job->JobId)}}" class="btn btn-danger">Xóa</a>
                </td>
            </tr>
            <?php $i++ ?>

            @endforeach
            @endif
        </tbody>
    </table>
</div>
    @endsection