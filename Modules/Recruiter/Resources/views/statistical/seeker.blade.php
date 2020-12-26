@extends('recruiter::layouts.master')
@section('content')
    <h2 class="mt-4">Danh sách ứng viên</h2>
    <ol class="breadcrumb mb-4 ">
        <li class="breadcrumb-item">Trang chủ</li>
        <li class="breadcrumb-item">Báo cáo thống kê</li>
        <li class="breadcrumb-item active">Danh sách ứng viên</li>
    </ol>

    <div class="card mb-4">
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên ứng viên</th>
                <th scope="col">Email</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Giới thiệu</th>
                <th scope="col">Tên việc làm</th>
                <th scope="col">Ngày ứng tuyển</th>
                <th scope="col">Trạng thái</th>

            </tr>
            </thead>
            <tbody>
            @if(isset($seekers))
                <?php $i=1 ?>
                @foreach($seekers as $seeker)
                    <tr>
                        <th scope="row">{{$i++}}</th>
                        <td>{{$seeker->SeekerName}}</td>
                        <td>{{$seeker->Email}}</td>
                        <td>{{$seeker->Phone}}</td>
                        <td>{{$seeker->Introduce}}</td>
                        <td>{{$seeker->JobName}}</td>
                        <td>{{$seeker->ApplyDate}}</td>
                        <td>
                            <label
                                    class="badge {{$seeker->getStatus($seeker->Status)['class']}}">{{$seeker->getStatus($seeker->Status)['name']}}</label>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@stop