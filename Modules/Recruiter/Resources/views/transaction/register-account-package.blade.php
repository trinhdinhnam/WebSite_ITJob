@extends('recruiter::layouts.master')
@section('content')
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="{{asset('/css/common.css')}}" rel="stylesheet" />
    <link href="{{asset('theme-recruiter/css/register-account-package.css')}}" rel="stylesheet" />
    <link href="{{asset('css/account-package.css')}}" rel="stylesheet" />
    <h2 class="mt-4">Chọn gói dịch vụ để tiếp tục sử dụng hệ thống</h2>
    <ol class="breadcrumb mb-4 " style="background-color: #ccc;color: #000;">
        <li class="breadcrumb-item"><a href="{{route('recruiter.home')}}">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="{{route('recruiter.get.list.job')}}">Lịch sử giao dịch</a></li>
        <li class="breadcrumb-item active" style="color: #fff;">Danh sách các gói dịch vụ</li>
    </ol>
    <div class="main col-8">
        <div class="form-group" style="margin-top: 50px;">
            <a href="" class="form-control btn btn-danger btn-account-package">Chọn gói dịch vụ <i class="fa fa-caret-right" style="font-size: 20px; margin-left: 5px; margin-bottom: -3px;"></i></a>
        </div>

        <div class="form-group" style="margin-top: 50px; display: none;">
            <input type="text" name="AccountPackage" class="form-control AccountPackage" placeholder="" value=""/>
        </div>
        <div id="package-select" class="form-group">
            <div class="form-content" style="border: none;">
                <div class="account-item-select">
                    <h3 class="package-name" id="package-select-name">NONE</h3>
                    <div class="price"><div class="price-label">Giá:</div><div id="package-select-price"></div></div>
                    <div class="post-number"><div class="postnumber-label">Số lượt đăng:</div><div id="package-select-postnumber"></div></div>
                    <input style="display: none;" value="" name="accountPackageId" id="package-select-id" />
                </div>
                <a class="btn btn-success form-control btn-payment" href="">Thanh toán</a>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModalAccountPackage" role="dialog" style="width: auto; height: auto;">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" id="md_content" style="border-radius: 15px;">
                <div class="content">
                    <div class="container register-form" >
                        <div class="form">
                            <div class="note">
                                <h3 >Chọn gói dịch vụ</h3>
                            </div>
                            <div class="form-content">
                                <input style="display: none;" value="{{$acPackages}}" name="acountPackages" class="acountPackages" />
                                @if(isset($acPackages))
                                    @foreach($acPackages as $acPackage)
                                        <div class="account-item item-{{$acPackage->AccountPackageId}}">
                                            <h3 class="package-name">{{$acPackage->AccountPackageName}}</h3>
                                            <div class="price"><div class="price-label">Giá:</div>{{number_format($acPackage->Price)}}</div>
                                            <div class="post-number"><div class="postnumber-label">Số lượt đăng:</div>{{$acPackage->PostNumber}}</div>
                                            <input style="display: none;" value="{{$acPackage->AccountPackageId}}" name="accountPackageId" class="accountPackageId" />
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function() {
            let data1 = 0;
            $(".btn-account-package").click(function(event) {
                event.preventDefault();
                $("#myModalAccountPackage").modal('show');
            });
            $("#package-select").addClass('hide-package');
            var data = $.parseJSON($('.acountPackages').val());
            $.each(data , function (index, value){
                $('.item-'+value.AccountPackageId).click(function (event) {
                    event.preventDefault();
                    $("#package-select-id").val(value.AccountPackageId);
                    $("#package-select-name").text(value.AccountPackageName);
                    $("#package-select-price").text(value.Price);
                    $("#package-select-postnumber").text(value.PostNumber);
                    $("#package-select").addClass('show-package');
                    $("#myModalAccountPackage").modal('hide');
                })
            });

            $(".btn-payment").click(function (event) {
                let accountId = $("#package-select-id").val();
                let $this = $(this);
                $this.attr("href", "http://phuongnamrecruiment.com:8000/recruiters/transaction/pay/order/accountId="+accountId);
            })
        })
    </script>
@endsection