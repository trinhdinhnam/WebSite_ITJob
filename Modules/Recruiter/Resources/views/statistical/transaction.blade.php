@extends('recruiter::layouts.master')
@section('content')
    <h2 class="mt-4">Danh sách giao dịch nhà tuyển dụng</h2>
    <ol class="breadcrumb mb-4 ">
        <li class="breadcrumb-item">Trang chủ</li>
        <li class="breadcrumb-item">Báo cáo thống kê</li>
        <li class="breadcrumb-item active">Lịch sử giao dịch</li>
    </ol>

    <div class="card mb-4">
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">Mã giao dịch</th>
                <th scope="col">Ngày thanh toán</th>
                <th scope="col">Ngày gia hạn</th>
                <th scope="col">Gói đăng ký</th>
                <th scope="col">Số tiền thanh toán</th>
                <th scope="col">Số lượt đăng</th>
                <th scope="col">Trạng thái</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transactions as $tran)
                <tr>
                    <th>{{$tran->TransactionId}}</th>
                    <td>{{date_format(date_create($tran->PayDate),'d/m/Y H:i:s')}}</td>
                    <td>{{date_format(date_create($tran->ExipryDate),'d/m/Y H:i:s')}}</td>
                    <td style="color: red; font-weight: bold">{{$tran->accountPackage->AccountPackageName}}</td>
                    <td>{{number_format($tran->accountPackage->Price)}} VNĐ</td>
                    <td>{{$tran->accountPackage->PostNumber}} lượt</td>

                    <td>
                        <label
                                class="badge {{$tran->getStatus($tran->Status)['class']}}">{{$tran->getStatus($tran->Status)['name']}}</label>
                        <label
                                class="badge @if($tran->ExipryDate<now()) badge-danger @else badge-success @endif ">@if($tran->ExipryDate<now()) Hết hạn @else Còn hạn @endif</label>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- Modal -->
@stop