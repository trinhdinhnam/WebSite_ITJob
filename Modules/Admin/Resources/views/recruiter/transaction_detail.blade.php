@extends('admin::layouts.master')

@section('content')
<h2 class="mt-4">Nhà tuyển dụng</h2>
<ol class="breadcrumb mb-4 ">
    <li class="breadcrumb-item">Trang chủ</li>
    <li class="breadcrumb-item">Nhà tuyển dụng</li>
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
                <th scope="col">Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($transactionDetail))
            @foreach($transactionDetail as $tran)
            <tr>
                <th>{{$tran->PayId}}</th>
                <td>{{$tran->PayDate}}</td>
                <td>{{$tran->ExpiryDate}}</td>
                <td>{{$tran->accountPackage->AccountPackageName}}</td>
                <td>{{number_format($tran->accountPackage->Price)}} VNĐz</td>
                <td>
                <a href="{{route('admin.get.action.transaction',['status',$tran->PayId])}}"
                        class="badge {{$tran->getStatus($tran->Status)['class']}}">{{$tran->getStatus($tran->Status)['name']}}</a>
                </td>

            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    @endsection