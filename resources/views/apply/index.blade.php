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
            <label for="staticEmail" class="col-sm-2 col-form-label">Tên: </label>
            <div class="col-sm-10">
                <input type="text" value="{{\Illuminate\Support\Facades\Auth::guard('seekers')->user()->SeekerName}}" class="form-control" id="inputName" placeholder="Nhập tên đầy đủ của bạn">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Email: </label>
            <div class="col-sm-10">
                <input type="text" value="{{\Illuminate\Support\Facades\Auth::guard('seekers')->user()->email}}" class="form-control" id="inputEmail" placeholder="Nhập email của bạn">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">CV: </label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="inputCV" name="CVLink" placeholder="Chọn CV của bạn">
            </div>
        </div>

        <div class="form-group">
            <label for="formGroupExampleInput">Những kỹ năng, dự án hay thành tựu nào chứng tỏ bạn là một ứng viên tiềm
                năng cho vị trí ứng tuyển này?</label>
            <textarea class="form-control" placeholder="Nêu nhiều ví dụ để làm hồ sơ của ban thuyết phục hơn"
                name="Introduce" id="inputIntro" cols="30" rows="3"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-danger">Nộp đơn ứng tuyển</button>
        </div>
    </div>
</div>
</form>
@endsection