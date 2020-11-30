@extends('recruiter::layouts.master')

@section('content')
<link href="{{asset('theme-admin/css/create_job.css')}}" rel="stylesheet" />

<h2 class="mt-4">Thông tin đăng tuyển</h2>
<ol class="breadcrumb mb-4 ">
    <li class="breadcrumb-item">Trang chủ</li>
    <li class="breadcrumb-item">Thông tin đăng tuyển</li>
    <li class="breadcrumb-item active">Thêm mới</li>

</ol>
<div class="container">
    <form method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-sm-8">
                <div class="form-group">
                    <h6 for="name">Tên công việc</h6>
                    <input require type="text" class="form-control" placeholder="Tên công việc ..." value=""
                        name="JobName" autofocus>
                    @if($errors->has('JobName'))
                    <span class="text-danger">{{ $errors->first('JobName') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <h6>Yêu cầu</h6>
                    <textarea require type="text" name="Require" class="form-control" cols="30" rows="3"
                        placeholder="Yêu cầu công việc ..."></textarea>
                    @if($errors->has('Require'))
                    <span class="text-danger">{{ $errors->first('Require') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <h6>Mô tả</h6>
                    <textarea require type="text" name="Description" class="form-control" cols="30" rows="3"
                        placeholder="Mô tả công việc ..."></textarea>
                </div>
                <div class="form-group">
                    <h6 for="name">Địa chỉ</h6>
                    <input require type="text" class="form-control" placeholder="Địa chỉ ..." value="" name="Address">
                    @if($errors->has('Address'))
                    <span class="text-danger">{{ $errors->first('Address') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <h6 for="name">Thành phố</h6>
                    <input require type="text" class="form-control" placeholder="Thành phố ..." value="" name="City">
                    <!-- @if($errors->has('prod_name'))
                    <span class="text-danger">{{ $errors->first('prod_name') }}</span>
                    @endif -->
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <h6 for="name">Ngày tiếp nhận hồ sơ:</h6>
                            <input require type="date" class="form-control" placeholder="Địa chỉ ..." value=""
                                name="StartDateApply">
                            <!-- @if($errors->has('prod_name'))
                    <span class="text-danger">{{ $errors->first('prod_name') }}</span>
                    @endif -->
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <h6 for="name">Ngày kết thúc tiếp nhận:</h6>
                            <input require type="date" class="form-control" placeholder="Địa chỉ ..." value=""
                                name="EndDateApply">
                            <!-- @if($errors->has('prod_name'))
                    <span class="text-danger">{{ $errors->first('prod_name') }}</span>
                    @endif -->
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <h6>Ảnh công việc</h6>
                    <input require type="file" name="image" class="form-control">
                    <!-- @if($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                    @endif -->
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <h6><input type="checkbox" name="hot">Nổi bật</h6>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <h6 for="name">Vị trí:</h6>
                    <select require name="PositionId" class="form-control" id="">
                        @if (isset($positions))
                        @foreach($positions as $position)
                        <option value="{{$position->PositionId}}">{{$position->PositionName}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <h6 for="name">Kỹ năng:</h6>
                    <input require type="text" class="form-control" placeholder="Kỹ năng ..." value=""
                                name="Skill">
                </div>
                <div class="form-group">
                    <h6>Mức lương</h6>
                    <input require type="number" name="Salary" class="form-control" placeholder="100000">
                    @if($errors->has('Salary'))
                    <span class="text-danger">{{ $errors->first('Salary') }}</span>
                    @endif
                </div>
            </div>
        </div>
        {{csrf_field()}}

    </form>
</div>
@endsection

