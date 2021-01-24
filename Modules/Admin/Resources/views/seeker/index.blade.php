@extends('admin::layouts.master')
@section('content')
    <link href="{{asset('/css/common.css')}}" rel="stylesheet" />

    <h2 class="mt-4">Danh sách người tìm việc</h2>
    <ol class="breadcrumb mb-4 ">
        <li class="breadcrumb-item">Trang chủ</li>
        <li class="breadcrumb-item">Báo cáo thống kê</li>
        <li class="breadcrumb-item active">Danh sách người tìm việc</li>
    </ol>

    <div class="card mb-4">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên người tìm việc</th>
                <th scope="col">Học vấn</th>
                <th scope="col">Email</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Địa chỉ tạm trú</th>
                <th scope="col">Địa chỉ thường trú</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($seekers))
                <?php $i=1 ?>
                @foreach($seekers as $seeker)
                    <tr>
                        <th scope="row">{{$i++}}</th>
                        <td>{{$seeker->SeekerName}}</td>
                        <td>{{$seeker->getEducation($seeker->Education)['name']}}</td>
                        <td>{{$seeker->email}}</td>
                        <td>{{$seeker->Phone}}</td>
                        <td>{{$seeker->Address}}</td>
                        <td>{{$seeker->TemporaryAddress}}</td>

                        <td>
                                <a href="{{route('admin.get.action.seeker',['active',$seeker->id])}}"
                                   class="badge {{$seeker->getActive($seeker->Active)['class']}}">{{$seeker->getActive($seeker->Active)['name']}}</a>
                        </td>
                        <td>
                            <a href="{{route('admin.get.detail.seeker',$seeker->id)}}" class="btn btn-primary">Xem</a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    <div class="card mb-4" style="background-color: #eee; border: none">
        <nav aria-label="Page navigation" style="margin: auto">
            {!! $seekers->links() !!}
        </nav>
    </div>
@stop