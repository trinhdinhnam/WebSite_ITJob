@extends('recruiter::layouts.master')

@section('content')
<h2 class="mt-4">Thông tin đăng tuyển <a href="{{route('recruiter.get.create.job')}}"  class="btn btn-primary" style=" float: right;">Đăng bài</a></h2>
<ol class="breadcrumb mb-4 ">
    <li class="breadcrumb-item"><a href="{{route('recruiter.home')}}">Trang chủ</a></li>
    <li class="breadcrumb-item active">Thông tin đăng tuyển</li>
</ol>
<form class="form-inline">
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control" id="jobname" name="jobname" placeholder="Nhập tên việc làm..." value="{{ \Request::get('jobname')}}">
    </div>
    <div class="form-group">
        <select name="position" id="position-name" class="form-control" style="width: 200px; margin-top: -8px; margin-right: 15px">
            <option value="" selected>Vị trí công việc</option>
            @if(isset($positions))
                @foreach($positions as $position)
                    <option value="{{$position->PositionId}}" {{ \Request::get('position') == $position->PositionId ? "selected='selected'" : ""}}>{{$position->PositionName}}</option>
                @endforeach
            @endif
        </select>
    </div>

    <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i></button>
</form>
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
                    <label class="badge {{$job->getStatus($job->Status)['class']}}">{{$job->getStatus($job->Status)['name']}}</label>
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