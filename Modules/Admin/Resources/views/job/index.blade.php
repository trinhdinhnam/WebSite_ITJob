@extends('admin::layouts.master')

@section('content')
<h2 class="mt-4">Thông tin đăng tuyển </h2>
<ol class="breadcrumb mb-4 ">
    <li class="breadcrumb-item">Trang chủ</li>
    <li class="breadcrumb-item active">Thông tin đăng tuyển</li>
</ol>
<div class="card mb-4">
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>

                <th scope="col">Tên công việc</th>
                <th scope="col">Vị trí</th>
                <th scope="col">Ngôn ngữ</th>
                <th scope="col">Địa chỉ</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($jobs))
            <?php $i=1 ?>
            @foreach($jobs as $job)
            <tr>
                <th scope="row">{{$i++}}</th>
                <td>{{$job->JobName}}</td>
                <td>{{$job->Possition}}</td>
                <td>{{$job->language->LanguageName}}</td>
                <td>{{$job->Address}}</td>
                <td>
                    <a href="{{route('admin.get.action.job',['active',$job->JobId])}}"
                        class="badge {{$job->getStatus($job->Status)['class']}}">{{$job->getStatus($job->Status)['name']}}</a>
                </td>
                <td>
                    <a href="{{route('admin.get.detail.job',$job->JobId)}}" class="btn btn-primary">Xem</a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    @endsection