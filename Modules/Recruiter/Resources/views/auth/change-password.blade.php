@extends('recruiter::layouts.master')
@section('content')
    <link href="{{asset('/css/common.css')}}" rel="stylesheet" />
    <h2 class="mt-4">Thay đổi mật khẩu"{{\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->RecruiterName}}"</h2>
    <ol class="breadcrumb mb-4 ">
        <li class="breadcrumb-item">Trang chủ</li>
        <li class="breadcrumb-item active">Thay đổi mật khẩu</li>
    </ol>
    <div class="container" style="padding-top: 0px; margin-bottom: 20px">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="">
                            @csrf
                            <div class="form-group" style="position: relative">
                                <h6 for="exampleInputEmail1">Mật khẩu cũ: </h6>
                                <input type="password" class="form-control" id="exampleInputEmail2" name="pass_old" placeholder="******">
                                @if($errors->has('pass_old'))
                                    <span class="text-danger">{{ $errors->first('pass_old') }}</span>
                                @endif
                                <a style="position: absolute;top: 54%;right: 10px;color: #337ab7  " href="javascript:;void(0)"><i class="fa fa-eye"></i></a>
                            </div>
                            <div class="form-group">
                                <h6 for="exampleInputEmail1">Mật khẩu mới: </h6>
                                <input type="password" class="form-control" id="exampleInputEmail3" name="pass_new"   placeholder="******">
                                @if($errors->has('pass_new'))
                                    <span class="text-danger">{{ $errors->first('pass_new') }}</span>
                                @endif
                                <a style="position: absolute;top: 39%;right: 30px;color: #337ab7  " href="javascript:;void(0)"><i class="fa fa-eye"></i></a>

                            </div>
                            <div class="form-group">
                                <h6 for="exampleInputEmail1">Nhập lại mật khẩu mới: </h6>
                                <input type="password" class="form-control" id="exampleInputEmail4" name="pass_confirm"  placeholder="******">
                                @if($errors->has('pass_confirm'))
                                    <span class="text-danger">{{ $errors->first('pass_confirm') }}</span>
                                @endif
                                <a style="position: absolute;top: 62%;right: 30px;color: #337ab7  " href="javascript:;void(0)"><i class="fa fa-eye"></i></a>

                            </div>
                            <button type="submit" class="btn btn-success" style="background-color: green">Cập nhật</button>
                            <br>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('theme-recruiter/js/change-password.js')}}"></script>
@stop