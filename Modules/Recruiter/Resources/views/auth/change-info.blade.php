@extends('recruiter::layouts.master')
@section('content')
    <h2 class="mt-4">Thay đổi thông tin cá nhân "{{\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->RecruiterName}}"</h2>
    <ol class="breadcrumb mb-4 ">
        <li class="breadcrumb-item">Trang chủ</li>
        <li class="breadcrumb-item active">Thay đổi thông tin cá nhân</li>
    </ol>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="{{asset('form-signup/css/signup.css')}}" rel="stylesheet" />
    <!------ Include the above in your HEAD tag ---------->
    <div class="content" style="padding-top: 0px; background-color: white">
        <div class="container register-form" style="background-color: white;">
            <div class="form">
                <form method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="title"><h5> Nhà tuyển dụng</h5></div>
                                <div class="form-group">
                                    <label><h6>Tên nhà tuyển dụng<span>*</span></h6></label>
                                    <input type="text" name="RecruiterName" class="form-control" placeholder="Nhập tên nhà tuyển dụng..." value="{{\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->RecruiterName}}"/>
                                    @if($errors->has('RecruiterName'))
                                        <span class="text-danger">{{ $errors->first('RecruiterName') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label><h6>Vị trí</h6></label>
                                    <input type="text" name="Position" class="form-control" placeholder="Nhập vị trí..." value="{{\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->Position}}"/>
                                </div>
                                <div class="form-group">
                                    <label><h6>Email<span>*</span></h6></label>
                                    <input type="email" name="Email" class="form-control" placeholder="Nhập email..." value="{{\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->email}}"/>
                                    @if($errors->has('Email'))
                                        <span class="text-danger">{{ $errors->first('Email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label><h6>Số điện thoại<span>*</span></h6></label>
                                    <input type="tel" name="Phone" class="form-control" placeholder="Nhập số điện thoại..." value="{{\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->Phone}}"/>
                                    @if($errors->has('Phone'))
                                        <span class="text-danger">{{ $errors->first('Phone') }}</span>
                                    @endif
                                </div>


                            </div>
                            <div class="col-md-6">
                                <div class="title"><h5>Công ty</h5></div>

                                <div class="form-group">
                                    <label><h6>Tên công ty<span>*</span></h6></label>
                                    <input type="text" name="CompanyName" class="form-control" placeholder="Nhập tên công ty..." value="{{\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->CompanyName}}"/>
                                    @if($errors->has('CompanyName'))
                                        <span class="text-danger">{{ $errors->first('CompanyName') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label><h6>Địa chỉ<span>*</span></h6></label>
                                    <input type="text" name="Address" class="form-control" placeholder="Nhập địa chỉ..." value="{{\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->Address}}"/>
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
                                                <option value="{{$city->CityId}}" @if(isset(\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->CityId)) @if(\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->CityId==$city->CityId) selected
                                                        @endif @endif>{{$city->CityName}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label><h6>Quốc gia</h6></label>
                                    <input type="text" name="Country" class="form-control" placeholder="Nhập tên quốc gia..." value="{{\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->Country}}"/>
                                </div>
                                <div class="form-group">
                                    <label><h6>Giới thiệu về công ty</h6></label>
                                    <textarea type="text" name="Introduction" class="form-control" cols="30" rows="3"
                                              placeholder="Nhập giới thiệu ...">{{\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->Introduction}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label><h6>Logo công ty<span>*</span></h6></label>
                                    <div>
                                        <input  type="file" name="CompanyLogo" class="form-control col-9" value="" style="float: left; margin-top: 30px;" />
                                        <img id="CompanyLogo" height="100px" width="80px" style="margin-left: 5px; float: left; margin-top: -31px;border: 1px solid #ddd;" src="{{asset( pare_url_file(\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->CompanyLogo)) }}"
                                             class="CompanyLogoData">
                                    </div>

                                    @if($errors->has('CompanyLogo'))
                                        <span class="text-danger">{{ $errors->first('CompanyLogo') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label><h6>Ảnh công ty</h6></label>
                                    <div class="row">
                                        @if(isset($imageCompanies))
                                            @foreach($imageCompanies as $image)
                                            <div class="col-4" style="margin-top: 30px">
                                                <img height="80px" width="120px" style="margin: -31px 0 5px 3px; float: left;border: 1px solid #ddd;" src="{{asset( pare_url_file($image->Image)) }}"
                                                     class="ImageData">
                                                <input  type="file" name="Image[]" class="form-control" value="" multiple="multiple" />
                                            </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label><h6>Ngày làm việc</h6></label>
                                    <input  type="text" name="WorkDay" class="form-control" value="{{\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->WorkDay}}" placeholder="Nhập ngày làm việc ..." />
                                </div>
                                <div class="form-group">
                                    <label><h6>Thời gian làm việc</h6></label>
                                    <input  type="text" name="TimeWork" class="form-control" value="{{\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->TimeWork}}" placeholder="Nhập thời gian làm việc ..." />
                                </div>
                                <div class="form-group">
                                    <label><h6>Quy mô công ty</h6></label>
                                    <input  type="number" name="CompanySize" class="form-control" value="{{\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->CompanySize}}" placeholder="Nhập quy mô ..." />
                                </div>
                                <div class="form-group">
                                    <label><h6>Hình thức kinh doanh</h6></label>
                                    <input  type="text" name="TypeBusiness" class="form-control" value="{{\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->TypeBusiness}}" placeholder="Nhập hình thức kinh doanh ..." />
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btnSubmit btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection