@extends('layouts.master')
@section('main')
    <div class="container" style="padding-top: 60px; margin-bottom: 20px">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header" >
                        <div class="title" style="margin: auto; font-size: 35px;">
                            Cập nhật thông tin cá nhân
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="card-body">
                        <form method="POST" action="{{route('client.post.change.info',\Illuminate\Support\Facades\Auth::guard('seekers')->user()->id)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">Họ và tên</label>
                                <div class="col-md-8">
                                    <input id="name"  type="text" class="form-control @error('SeekerName') is-invalid @enderror" name="SeekerName" value="{{ \Illuminate\Support\Facades\Auth::guard('seekers')->user()->SeekerName }}" required autocomplete="name" autofocus>
                                    @if($errors->has('SeekerName'))
                                        <span class="text-danger">{{ $errors->first('SeekerName') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">Học vấn</label>
                                <div class="col-md-8">
                                    <select name="Education" class="form-control" id="">
                                        <option value="1" @if(\Illuminate\Support\Facades\Auth::guard('seekers')->user()->Education==1) selected @endif >Tiến sĩ</option>
                                        <option value="2" @if(\Illuminate\Support\Facades\Auth::guard('seekers')->user()->Education==2) selected @endif>Thạc sĩ</option>
                                        <option value="3" @if(\Illuminate\Support\Facades\Auth::guard('seekers')->user()->Education==3) selected @endif>Đại học</option>
                                        <option value="4" @if(\Illuminate\Support\Facades\Auth::guard('seekers')->user()->Education==4) selected @endif>Cao đẳng</option>
                                        <option value="5" @if(\Illuminate\Support\Facades\Auth::guard('seekers')->user()->Education==5) selected @endif>Tốt nghiệp phổ thông</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">Ngày sinh</label>
                                <div class="col-md-8">
                                    <input id="dateofbirth" name="DateOfBirth"  type="date" class="form-control" value="{{ \Illuminate\Support\Facades\Auth::guard('seekers')->user()->DateOfBirth }}" required autocomplete="name" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-3 col-form-label text-md-right">Email</label>
                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control @error('Email') is-invalid @enderror" name="Email" value="{{\Illuminate\Support\Facades\Auth::guard('seekers')->user()->email }}" required autocomplete="email">
                                    @if($errors->has('Email'))
                                        <span class="text-danger">{{$errors->first('Email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-3 col-form-label text-md-right">Số điện thoại</label>

                                <div class="col-md-8 ">
                                    <input id="phone" type="text" class="form-control " name="Phone" value="{{\Illuminate\Support\Facades\Auth::guard('seekers')->user()->Phone}}" required autocomplete="phone">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-3 col-form-label text-md-right">Địa chỉ</label>

                                <div class="col-md-8">
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="Address" value="{{\Illuminate\Support\Facades\Auth::guard('seekers')->user()->Address}}" required autocomplete="address">
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-3 col-form-label text-md-right" style="margin-top: 120px;">Avatar</label>
                                <div class="col-md-8" style="display: flex;">
                                    <input id="uploadImg" style="height: 45px; margin-top: 120px" type="file" class="form-control col-8" name="Avatar" autocomplete="avatar" onchange="ImageFileAsURL()">
                                    <img id="avatarSeeker" height="170px" width="120px" style="margin-left: 15px" src="{{asset( pare_url_file(\Illuminate\Support\Facades\Auth::guard('seekers')->user()->Avatar)) }}"
                                         class="thumbnail col-4">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" style="background-color: green" class="btn btn-success signin">
                                        {{ __('Cập nhật') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function validateForm() {
            return checkPhone();
        }
        function checkPhone() {
            var phone = document.forms["myForm"]["phone"].value;
            var phoneNum = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
            if(phone.value.match(phoneNum)) {
                return true;
            }
            else {
                document.getElementById("phone").className = document.getElementById("phone").className + " error";
                return false;
            }
        }
        function ImageFileAsURL() {
            var fileSelected = document.getElementById('uploadImg').files;
            if(fileSelected.length > 0){
                var fileToLoad = fileSelected[0];
                var fileReader = new FileReader();
                fileReader.onload = function (fileLoaderEvent) {
                    var srcData = fileLoaderEvent.target.result;
                    document.getElementById('avatarSeeker').src = srcData;
                }
                fileReader.readAsDataURL(fileToLoad);
            }
        }
    </script>
@endsection
