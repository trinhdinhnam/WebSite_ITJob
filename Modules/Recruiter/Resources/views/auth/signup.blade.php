<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="{{asset('form-signup/css/signup.css')}}" rel="stylesheet" />

<!------ Include the above in your HEAD tag ---------->

<div class="signup-layout" style="background-image: url('{{asset('form-login/images/bg-01.jpg')}}');  background-repeat: no-repeat; width: 100%; height: 100%;">
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
                            <input type="text" name="City" class="form-control" placeholder="Nhập thành phố..." value=""/>
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
            </form>
        </div>
    </div>
</div>
