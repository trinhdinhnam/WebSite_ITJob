@extends('recruiter::layouts.master')
@section('content')
    <link href="{{asset('/css/common.css')}}" rel="stylesheet" />
    <h2 class="mt-4">Thanh toán hóa đơn giao dịch </h2>
    <ol class="breadcrumb mb-4 " style="background-color: #ccc;color: #000;">
        <li class="breadcrumb-item"><a href="{{route('recruiter.home')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active" style="color: #fff;">Thanh toán hóa đơn</li>
    </ol>
    <div class="main col-lg-10" style="background-color: #ddd; margin: auto; padding: 30px">
        <div style="text-align: center; font-size: 30px; font-weight: 600;">Xác nhận thông tin hóa đơn</div>

        <div class="table-responsive" style="background-color: white; padding: 10px; border-radius: 10px">
            <form action="" id="create_form" method="post">
                @csrf
                <div class="form-group">
                    <h6 for="language">Loại giao dịch: </h6>
                    <select name="order_type" id="order_type" class="form-control">
                        <option selected value="billpayment">Thanh toán hóa đơn</option>
                    </select>
                </div>
                <div class="form-group">
                    <h6 for="bank_code">Ngân hàng:</h6>
                    <select name="bank_code" id="bank_code" class="form-control">
                        <option value="">Không chọn</option>
                        <option value="NCB"> Ngan hang NCB</option>
                        <option value="AGRIBANK"> Ngan hang Agribank</option>
                        <option value="SCB"> Ngan hang SCB</option>
                        <option value="SACOMBANK">Ngan hang SacomBank</option>
                        <option value="EXIMBANK"> Ngan hang EximBank</option>
                        <option value="MSBANK"> Ngan hang MSBANK</option>
                        <option value="NAMABANK"> Ngan hang NamABank</option>
                        <option value="VNMART"> Vi dien tu VnMart</option>
                        <option value="VIETINBANK">Ngan hang Vietinbank</option>
                        <option value="VIETCOMBANK"> Ngan hang VCB</option>
                        <option value="HDBANK">Ngan hang HDBank</option>
                        <option value="DONGABANK"> Ngan hang Dong A</option>
                        <option value="TPBANK"> Ngân hàng TPBank</option>
                        <option value="OJB"> Ngân hàng OceanBank</option>
                        <option value="BIDV"> Ngân hàng BIDV</option>
                        <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                        <option value="VPBANK"> Ngan hang VPBank</option>
                        <option value="MBBANK"> Ngan hang MBBank</option>
                        <option value="ACB"> Ngan hang ACB</option>
                        <option value="OCB"> Ngan hang OCB</option>
                        <option value="IVB"> Ngan hang IVB</option>
                        <option value="VISA"> Thanh toan qua VISA/MASTER</option>
                    </select>
                </div>
                <div class="form-group">
                    <h6 for="name">Họ và tên:</h6>
                    <input required type="text" class="form-control dis" id="name" name="name"
                           value="@if(\Illuminate\Support\Facades\Auth::guard('recruiters')->check()) {{\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->RecruiterName}}  @endif">
                </div>
                <div class="form-group">
                    <h6 for="amount">Loại dịch vụ</h6>
                    <input class="form-control dis" name="service" value="{{$accountPackage->AccountPackageName}}" />
                </div>
                <div class="form-group">
                    <h6 for="amount">Tổng tiền:</h6>
                    <input class="form-control dis" name="totalMoney" value="{{$accountPackage->Price}}" />
                    <input style="display: none" class="form-control" name="id" id="accountId" value="{{$accountPackage->AccountPackageId}}" />
                </div>
                <div class="form-group">
                    <h6 for="amount">Số lượt đăng tuyển:</h6>
                    <input class="form-control dis" name="postNumber" value="{{$accountPackage->PostNumber}}" />
                </div>
                <div class="form-group">
                    <h6 for="email">Email:</h6>
                    <input required type="email" class="form-control" id="email" name="email"
                           value="@if(\Illuminate\Support\Facades\Auth::guard('recruiters')->check()) {{\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->email}}  @endif">
                </div>
                <div class="form-group">
                    <h6 for="phone">Số điện thoại:</h6>
                    <input required type="tel" class="form-control" id="phone" name="phone"
                           value="@if(\Illuminate\Support\Facades\Auth::guard('recruiters')->check()) {{\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->Phone}}  @endif">
                </div>
                <div class="form-group">
                    <h6 for="add">Nội dung:</h6>
                    <textarea type="text" rows="5" class="form-control" id="content"
                              name="note">Thanh toán đơn hàng</textarea>
                </div>
                <div class="form-group">
                    <h6 for="language">Ngôn ngữ:</h6>
                    <select name="language" id="language" class="form-control">
                        <option value="vn">Tiếng Việt</option>
                        <option value="en">English</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary pull-right" id="btnPopup">Xác nhận thông tin</button>
            </form>
        </div>

    </div>

<link href="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.css" rel="stylesheet" />
<script src="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.js"></script>
<script type="text/javascript">
$("#btnPopup").click(function() {
    var postData = $("#create_form").serialize();
    var submitUrl = $("#create_form").attr("action");
    $.ajax({
        type: "POST",
        url: submitUrl,
        data: postData,
        dataType: 'JSON',
        success: function(x) {
            if (x.code === '00') {
                if (window.vnpay) {
                    vnpay.open({
                        width: 768,
                        height: 600,
                        url: x.data
                    });
                } else {
                    location.href = x.data;
                }
                return false;
            } else {
                alert(x.Message);
            }
        }
    });
    return false;
});
</script>
@stop