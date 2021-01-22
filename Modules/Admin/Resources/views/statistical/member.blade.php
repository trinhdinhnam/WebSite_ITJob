@extends('admin::layouts.master')
@section('content')
    <link href="{{asset('/css/common.css')}}" rel="stylesheet" />

    <h2 class="mt-4">Danh sách nhà tuyển dụng</h2>
    <ol class="breadcrumb mb-4 ">
        <li class="breadcrumb-item">Trang chủ</li>
        <li class="breadcrumb-item">Báo cáo thống kê</li>
        <li class="breadcrumb-item active">Danh sách nhà tuyển dụng</li>
    </ol>

    <div class="card mb-4">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên nhà tuyển dụng</th>
                <th scope="col">Chức vụ</th>
                <th scope="col">Tên công ty</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Địa chỉ</th>
                <th scope="col">Trạng thái</th>
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
                        <td>{{$recruiter->CompanyName}}</td>
                        <td>{{$recruiter->Phone}}</td>
                        <td>{{$recruiter->Address}}</td>
                        <td>
                            <label
                                    class="badge {{$recruiter->getActive($recruiter->Active)['class']}}">{{$recruiter->getActive($recruiter->Active)['name']}}</label>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    <div class="card mb-4" style="background-color: #eee; border: none">
        <nav aria-label="Page navigation" style="margin: auto">
            {!! $recruiters->links() !!}
        </nav>
    </div>
@stop