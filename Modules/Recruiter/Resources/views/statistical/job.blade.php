@extends('recruiter::layouts.master')
@section('content')
    <h2 class="mt-4">Danh sách việc làm của nhà tuyển dụng</h2>
    <ol class="breadcrumb mb-4 ">
        <li class="breadcrumb-item">Trang chủ</li>
        <li class="breadcrumb-item">Báo cáo thống kê</li>
        <li class="breadcrumb-item active">Danh sách việc làm</li>
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
                <th scope="col">Ngày đăng</th>
                <th scope="col">Trạng thái</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($jobs))
                <?php $i=1 ?>
                @foreach($jobs as $job)
                    <tr>
                        <th scope="row">{{$i++}}</th>
                        <td>{{$job->JobName}}</td>
                        <td>{{$job->PositionName}}</td>
                        <td>{{$job->Skill}}</td>
                        <td>{{$job->Address}}</td>
                        <td>{{$job->CreatedDate}}</td>

                        <td>
                            <label
                               class="badge {{$job->getStatus($job->Status)['class']}}">{{$job->getStatus($job->Status)['name']}}</label>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    <div class="card mb-4" style="background-color: #eee; border: none">
        <nav aria-label="Page navigation" style="margin: auto">
            {!! $jobs->links() !!}
        </nav>
    </div>
@stop