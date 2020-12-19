@extends('layouts.master')
@section('main')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="{{asset('form-signup/css/signup.css')}}" rel="stylesheet" />
<link href="{{asset('css/account-package.css')}}" rel="stylesheet" />

<!------ Include the above in your HEAD tag ---------->
<div class="content">
 <div class="container register-form" >
        <div class="form">
            <div class="note">
                <h3 >Đăng ký</h3>
            </div>
            <form method="POST" enctype="multipart/form-data">
                @csrf
            <div class="form-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="title"><h5> Nhà tuyển dụng</h5></div>
                        <div class="form-group">
                            <label><h6>Tên nhà tuyển dụng<span>*</span></h6></label>
                            <input type="text" name="RecruiterName" class="form-control" placeholder="Nhập tên nhà tuyển dụng..." value=""/>
                            @if($errors->has('RecruiterName'))
                                <span class="text-danger">{{ $errors->first('RecruiterName') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label><h6>Vị trí</h6></label>
                            <input type="text" name="Position" class="form-control" placeholder="Nhập vị trí..." value=""/>
                        </div>
                        <div class="form-group">
                            <label><h6>Email<span>*</span></h6></label>
                            <input type="email" name="Email" class="form-control" placeholder="Nhập email..." value=""/>
                            @if($errors->has('Email'))
                                <span class="text-danger">{{ $errors->first('Email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label><h6>Số điện thoại<span>*</span></h6></label>
                            <input type="tel" name="Phone" class="form-control" placeholder="Nhập số điện thoại..." value=""/>
                            @if($errors->has('Phone'))
                                <span class="text-danger">{{ $errors->first('Phone') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label><h6>Password<span>*</span></h6></label>
                            <input type="password" name="Password" class="form-control" placeholder="Nhập password..." value=""/>
                            @if($errors->has('Password'))
                                <span class="text-danger">{{ $errors->first('Password') }}</span>
                            @endif
                        </div>

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
                                <a class="btn btn-success form-control btn-payment" href="{{route('recruiter.get.bill')}}">Thanh toán</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="title"><h5>Công ty</h5></div>

                        <div class="form-group">
                            <label><h6>Tên công ty<span>*</span></h6></label>
                            <input type="text" name="CompanyName" class="form-control" placeholder="Nhập tên công ty..." value=""/>
                            @if($errors->has('CompanyName'))
                                <span class="text-danger">{{ $errors->first('CompanyName') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label><h6>Địa chỉ<span>*</span></h6></label>
                            <input type="text" name="Address" class="form-control" placeholder="Nhập địa chỉ..." value=""/>
                            @if($errors->has('Address'))
                                <span class="text-danger">{{ $errors->first('Address') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label><h6>Thành phố</h6></label>
                            <select name="City" class="form-control">
                                <option disabled selected>Thành phố</option>
                                @if(isset($cities))
                                    @foreach($cities as $city)
                                        <option value="{{$city->CityId}}" >{{$city->CityName}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label><h6>Quốc gia</h6></label>
                            <input type="text" name="Country" class="form-control" placeholder="Nhập tên quốc gia..." value=""/>
                        </div>
                        <div class="form-group">
                            <label><h6>Giới thiệu về công ty</h6></label>
                            <textarea type="text" name="Introduction" class="form-control" cols="30" rows="3"
                                      placeholder="Nhập giới thiệu ..."></textarea>
                        </div>
                        <div class="form-group">
                            <label><h6>Logo công ty<span>*</span></h6></label>
                            <input  type="file" name="CompanyLogo" class="form-control" value="" />
                            @if($errors->has('CompanyLogo'))
                                <span class="text-danger">{{ $errors->first('CompanyLogo') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label><h6>Ảnh công ty</h6></label>
                            <div class="row">
                                @for( $i=1;$i<=3;$i++)
                                <input  type="file" name="Image[]" class="form-control col-4" value="" multiple="multiple" />
                                @endfor
                            </div>
                        </div>
                        <div class="form-group">
                            <label><h6>Ngày làm việc</h6></label>
                            <input  type="text" name="WorkDay" class="form-control" value="" placeholder="Nhập ngày làm việc ..." />
                        </div>
                        <div class="form-group">
                            <label><h6>Thời gian làm việc</h6></label>
                            <input  type="text" name="TimeWork" class="form-control" value="" placeholder="Nhập thời gian làm việc ..." />
                        </div>
                        <div class="form-group">
                            <label><h6>Quy mô công ty</h6></label>
                            <input  type="number" name="CompanySize" class="form-control" value="" placeholder="Nhập quy mô ..." />
                        </div>
                        <div class="form-group">
                            <label><h6>Hình thức kinh doanh</h6></label>
                            <input  type="text" name="TypeBusiness" class="form-control" value="" placeholder="Nhập hình thức kinh doanh ..." />
                        </div>
                    </div>
                </div>
                <button type="submit" class="btnSubmit btn btn-success">Submit</button>
            </div>
                {{csrf_field()}}
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
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalBill" role="dialog" style="width: auto; height: auto;">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" id="md_content" style="border-radius: 15px;">

        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
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

        $(".btn-payment").click(function(event) {
            event.preventDefault();
            let $this = $(this);
            let url = $this.attr('href');
            $.ajax({
                url: url,
            }).done(function(result) {
                if (result) {
                    $("#md_content").append(result);
                }
            });
            $("#ModalBill").modal('show');
        });
    })
</script>
@endsection