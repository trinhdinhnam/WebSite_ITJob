@extends('layouts.master')
@section('main')
    <link href="{{asset('form-signup/css/signup.css')}}" rel="stylesheet" />
    <div class="content">
    <div class="container register-form" >
        <div class="form">
            <div class="note">
                <h3 >Đăng ký</h3>
            </div>
            <form method="POST" enctype="multipart/form-data" onsubmit = "return validateForm()" name="myForm">
                @csrf
                <div class="form-content">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <label><h6>Tên người tìm việc<span>*</span></h6></label>
                                <input type="text" name="SeekerName" class="form-control" placeholder="Nhập tên người tìm việc..." value="" autofocus/>
                                @if($errors->has('SeekerName'))
                                    <span class="text-danger">{{ $errors->first('SeekerName') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label><h6>Học vấn<span>*</span></h6></label>
                                <select name="Education" class="form-control">
                                    <option disabled selected>Học vấn</option>
                                    <option value="1" >Tiến sĩ</option>
                                    <option value="2" >Thạc sĩ</option>
                                    <option value="3" >Đại học</option>
                                    <option value="4" >Cao đẳng</option>
                                    <option value="5" >Tốt nghiệp phổ thông</option>
                                </select>
                                @if($errors->has('Education'))
                                    <span class="text-danger">{{ $errors->first('Education') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label><h6>Giới tính<span>*</span></h6></label>
                                <select name="Gender" class="form-control">
                                    <option disabled selected>Giới tính</option>
                                    <option value="1" >Nam</option>
                                    <option value="0" >Nữ</option>
                                    <option value="2" >Giới tính khác</option>
                                </select>
                                @if($errors->has('Gender'))
                                    <span class="text-danger">{{ $errors->first('Gender') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label><h6>Ngày sinh<span>*</span></h6></label>
                                <input type="date" name="DateOfBirth" class="form-control"  value=""/>
                                @if($errors->has('DateOfBirth'))
                                    <span class="text-danger">{{ $errors->first('DateOfBirth') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label><h6>Email<span>*</span></h6></label>
                                <input required type="email" name="Email" class="form-control" placeholder="Nhập email..." value=""/>
                                @if($errors->has('Email'))
                                    <span class="text-danger">{{ $errors->first('Email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label><h6>Số điện thoại<span>*</span></h6></label>
                                <input type="tel" name="Phone" class="form-control" id="phone" placeholder="Nhập số điện thoại..." value=""/>
                                @if($errors->has('Phone'))
                                    <span class="text-danger">{{ $errors->first('Phone') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label><h6>Địa chỉ thường trú<span>*</span></h6></label>
                                <input type="text" name="Address" class="form-control" placeholder="Nhập địa chỉ thường trú..." value=""/>
                                @if($errors->has('Address'))
                                    <span class="text-danger">{{ $errors->first('Address') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label><h6>Địa chỉ tạm trú<span>*</span></h6></label>
                                <input type="text" name="TemporaryAddress" class="form-control" placeholder="Nhập địa chỉ tạm trú..." value=""/>
                                @if($errors->has('TemporaryAddress'))
                                    <span class="text-danger">{{ $errors->first('TemporaryAddress') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label><h6>Password<span>*</span></h6></label>
                                <input type="password" name="Password" class="form-control" placeholder="Nhập password..." value=""/>
                                @if($errors->has('Password'))
                                    <span class="text-danger">{{ $errors->first('Password') }}</span>
                                @endif
                            </div>
                            <div class="form-group" >
                                <label ><h6 style="margin-top: 45px">Avatar<span>*</span></h6></label>
                                <div class="row">
                                    <input type="file" name="Avatar" id="uploadImg" class="form-control col-8" value="" onchange="ImageFileAsURL()"/>
                                    <div id="displayImg" >
                                        <img id="avatarSeeker" height="100%" width="100%" src="{{asset('images/avatardefault3.jpg')}}"
                                             class="thumbnail">
                                    </div>
                                    @if($errors->has('Avatar'))
                                        <span class="text-danger">{{ $errors->first('Avatar') }}</span>
                                    @endif
                                </div>

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
    <script type="text/javascript">
          function ImageFileAsURL() {
              var fileSelected = document.getElementById('uploadImg').files;
              if(fileSelected.length > 0){
                  var fileToLoad = fileSelected[0];
                  var fileReader = new FileReader();
                  fileReader.onload = function (fileLoaderEvent) {
                      var srcData = fileLoaderEvent.target.result;
                      document.getElementById('avatarSeeker').src = srcData;
                      $('#cd').val(srcData);
                  }
                  fileReader.readAsDataURL(fileToLoad);
              }
          }
          $(document).ready(function() {
              $('body').on('click','.checkmobile', function() {
                  var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
                  var mobile = $('#phone').val();
                  if(mobile !==''){
                      if (vnf_regex.test(mobile) == false)
                      {
                          alert('Số điện thoại của bạn không đúng định dạng!');
                      }else{
                          alert('Số điện thoại của bạn hợp lệ!');
                      }
                  }else{
                      alert('Bạn chưa điền số điện thoại!');
                  }
              });
          });
    </script>
@endsection
