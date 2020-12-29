@extends('recruiter::layouts.master')
@section('content')
    <link rel="stylesheet" href="/css/complete.css">
    <div style="width: 100%; height: auto; padding-top: 100px;">
        <div class="breadcrumbs">
            <div class="product-details-area">
                <div class="container">
                    <div class="col-md-9" style="margin: auto">
                        <div id="wrap-inner">
                            <div id="complete">
                                <p style="font-weight: 600" class="info">Quý khách đã thanh toán thành công!</p>
                                <p>• Thông tin hóa đơn đăng ký dịch vụ của Quý khách đã được chờ xác nhận từ admin hệ thống.</p>
                                <p>• Quý khách sẽ tiếp tục sử dụng dịch vụ của mình khi hóa đơn của bạn được hệ thống duyệt.</p>
                                <p>• Sau 24h nếu hóa đơn của bạn chưa được xác nhận, hãy liên hệ với chúng tôi qua số điện thoại: 0395699933 để được hỗ trợ.</p>
                                <p>• Trụ sở chính: Hà Nội</p>
                                <p>Cám ơn Quý khách đã lựa chọn dịch vụ của chúng Tôi!</p>
                            </div>
                            <br>
                            <p class="btn btn-primary return"><a style="color: white" href="{{asset('recruiters/')}}">Quay lại trang chủ</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
