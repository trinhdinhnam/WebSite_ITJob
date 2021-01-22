@extends('admin::layouts.master')
@section('content')
    <link href="{{asset('/css/common.css')}}" rel="stylesheet" />
    <link href="{{asset('/theme-admin/css/transaction-detail.css')}}" rel="stylesheet" />
    <h2 class="mt-4">Chi tiết giao dịch</h2>
    <ol class="breadcrumb mb-4 ">
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active">Nhà tuyển dụng</li>
        <li class="breadcrumb-item active">Chi tiết giao dịch</li>
    </ol>


    <div class="main">
        <div class="title" >Giao dịch <span style="color: red">#gd{{$transactionDetail->TransactionId}}</span></div>
        <div class="content" >
            @if(isset($transactionDetail))
            <div class="form-group row">
                <h6 class="col-3">Ngân hàng:</h6>
                <input type="text" class="form-control col-8 dis"
                       value="{{$transactionDetail->BankName}}" name="BankName">
            </div>
            <div class="form-group row">
                <h6 class="col-3">Tài khoản:</h6>
                <input type="text" class="form-control col-8 dis"
                       value="9704198526191432198" name="BankAccount">
            </div>
            <div class="form-group row">
                <h6 class="col-3">Họ tên người tuyển dụng:</h6>
                <input type="text" class="form-control col-8 dis"
                       value="{{$transactionDetail->recruiter->RecruiterName}}" name="RecruiterName">
            </div>
            <div class="form-group row">
                <h6 class="col-3">Tên công ty:</h6>
                <input type="text" class="form-control col-8 dis"
                       value="{{$transactionDetail->recruiter->CompanyName}}" name="CompanyName">
            </div>
            <div class="form-group row">
                <h6 class="col-3">Email: </h6>
                <input type="text" class="form-control col-8 dis"
                       value="{{$transactionDetail->Email}}" name="Email">
            </div>
            <div class="form-group row">
                <h6 class="col-3">Số điện thoại: </h6>
                <input type="text" class="form-control col-8 dis"
                       value="{{$transactionDetail->Phone}}" name="Phone">
            </div>
            <div class="form-group row">
                <h6 class="col-3">Ngày thanh toán: </h6>
                <input type="text" class="form-control col-8 dis"
                       value="{{$transactionDetail->PayDate}}" name="PayDate">
            </div>
            <div class="form-group row">
                <h6 class="col-3">Ngày xét duyệt: </h6>
                <input type="text" class="form-control col-8 dis"
                       value="{{$transactionDetail->ApprovalDate}}" name="ApprovalDate">
            </div>
            <div class="form-group row">
                <h6 class="col-3">Ngày gia hạn: </h6>
                <input type="text" class="form-control col-8 dis"
                       value="{{$transactionDetail->ExipryDate}}" name="ExipryDate">
            </div>
            <div class="form-group row">
                <h6 class="col-3" style="opacity: unset ">Gói dịch vụ: </h6>
                <input type="text" class="form-control col-8 dis"
                       value="{{$transactionDetail->accountPackage->AccountPackageName}}" name="AccountName">
            </div>
            <div class="form-group row">
                <h6 class="col-3">Tổng hóa đơn: </h6>
                <input type="text" class="form-control col-8 dis"
                       value="{{$transactionDetail->Total}} VNĐ" name="Total">
            </div>
            <div class="form-group row">
                <h6 class="col-3">Trạng thái: </h6>
                <input type="text" class="form-control col-8 dis" style="color: red"
                       value="{{$transactionDetail->getStatus($transactionDetail->Status)['name']}}" name="Status">
            </div>
            <div class="form-group row">
                <h6 class="col-3">Ghi chú: </h6>
                <textarea type="text" name="Note" class="form-control col-8 dis" cols="30" rows="4"
                          >{{$transactionDetail->Note}}</textarea>
            </div>
        @endif
        </div>
    </div>

@stop