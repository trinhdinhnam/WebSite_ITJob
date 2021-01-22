@extends('layouts.master')
@section('main')
<link href="{{asset('theme-seeker/css/apply-form.css')}}" rel="stylesheet" />
<form method="POST" enctype="multipart/form-data">
    @csrf
<div class="apply-container">
    <div class="apply-content">
        <div class="title">
            <h3>Kiểm tra và điền các thông tin còn thiếu</h3>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Họ và tên<span>*</span> </label>
            <div class="col-sm-10">
                <input type="text" value="{{\Illuminate\Support\Facades\Auth::guard('seekers')->user()->SeekerName}}" name="SeekerName" class="form-control" id="inputName" placeholder="Nhập tên đầy đủ của bạn">
                @if($errors->has('SeekerName'))
                    <span class="text-danger">{{ $errors->first('SeekerName') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Email<span>*</span> </label>
            <div class="col-sm-10">
                <input type="text" value="{{\Illuminate\Support\Facades\Auth::guard('seekers')->user()->email}}" name="SeekerEmail" class="form-control" id="inputEmail" placeholder="Nhập email của bạn">
                @if($errors->has('SeekerEmail'))
                    <span class="text-danger">{{ $errors->first('SeekerEmail') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPhone" class="col-sm-2 col-form-label">Số điện thoại<span>*</span> </label>
            <div class="col-sm-10">
                <input type="text" value="{{\Illuminate\Support\Facades\Auth::guard('seekers')->user()->Phone}}" name="SeekerPhone" class="form-control" id="inputPhone" placeholder="Nhập số điện thoại của bạn">
                @if($errors->has('SeekerPhone'))
                    <span class="text-danger">{{ $errors->first('SeekerPhone') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputAddress" class="col-sm-2 col-form-label">Địa chỉ tạm trú<span>*</span> </label>
            <div class="col-sm-10">
                <input type="text" value="{{\Illuminate\Support\Facades\Auth::guard('seekers')->user()->Address}}" name="SeekerAddress" class="form-control" id="inputAddress" placeholder="Nhập địa chỉ của bạn">
                @if($errors->has('SeekerAddress'))
                    <span class="text-danger">{{ $errors->first('SeekerAddress') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputAvatar" id="label-inputAvatar" class="col-sm-2 col-form-label">Ảnh<span>*</span> </label>
            <div class="col-sm-8">
                <input type="file" value="" class="form-control" id="inputAvatar" name="SeekerAvatar" >
            </div>
            <div id="displayImg col-sm-2" >
                <img id="avatarSeeker" height="110" width="100" src="{{asset( pare_url_file(\Illuminate\Support\Facades\Auth::guard('seekers')->user()->Avatar)) }}"
                     class="thumbnail">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">CV (.pdf)<span>*</span> </label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="inputCV" name="SeekerCVLink" placeholder="Chọn CV của bạn (.pdf)">
                @if($errors->has('SeekerCVLink'))
                    <span class="text-danger">{{ $errors->first('SeekerCVLink') }}</span>
                @endif
                <span class="text-danger" id="validateTypeFile">Bạn phải chọn định dạng CV gửi đi là (*.pdf)!</span>

            </div>
        </div>

        <div class="form-group">
            <label for="formGroupExampleInput">Những kỹ năng, dự án hay thành tựu nào chứng tỏ bạn là một ứng viên tiềm
                năng cho vị trí ứng tuyển này?</label>
            <textarea class="form-control" placeholder="Nêu nhiều ví dụ để làm hồ sơ của ban thuyết phục hơn"
                name="Introduce" id="inputIntro" cols="30" rows="3"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-danger" id="saveApply">Nộp đơn ứng tuyển</button>
        </div>
    </div>
</div>
</form>
    <script src="{{asset('theme-seeker/js/apply.js')}}"></script>
@endsection