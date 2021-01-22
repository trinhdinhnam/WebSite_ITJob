<form method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm-8">
            <div class="form-group">
                <h6 for="name">Tên công việc <span>*</span> </h6>
                <input require type="text" class="form-control" placeholder="Tên công việc ..."
                       value="{{ old('JobName', isset($job->JobName) ?$job->JobName : '') }}" name="JobName" autofocus>
                @if($errors->has('JobName'))
                    <span class="text-danger">{{ $errors->first('JobName') }}</span>
                @endif
            </div>
            <div class="form-group">
                <h6>Yêu cầu <span>*</span></h6>
                <textarea require type="text" name="Require" class="form-control" cols="30" rows="3"
                          placeholder="Yêu cầu công việc ...">{{ old('Require', isset($job->Require) ?$job->Require : '') }}</textarea>
                @if($errors->has('Require'))
                    <span class="text-danger">{{ $errors->first('Require') }}</span>
                @endif
            </div>
            <div class="form-group">
                <h6>Mô tả <span>*</span></h6>
                <textarea require type="text" name="Description" class="form-control" cols="30" rows="3"
                          placeholder="Mô tả công việc ...">{{ old('Description', isset($job->Description) ?$job->Description : '') }}</textarea>
            </div>
            <div class="form-group">
                <h6 for="name">Địa chỉ <span>*</span></h6>
                <input require type="text" class="form-control" placeholder="Địa chỉ ..." value="{{ old('Address', isset($job->Address) ?$job->Address : '') }}"
                       name="Address">
                @if($errors->has('Address'))
                    <span class="text-danger">{{ $errors->first('Address') }}</span>
                @endif
            </div>
            <div class="form-group">
                <h6 for="name">Thành phố <span>*</span></h6>
                <select require name="City" class="form-control" id="">
                    @if (isset($cities))
                        @foreach($cities as $city)
                            <option value="{{$city->CityId}}" @if(isset($job->CityId)) @if($job->CityId==$city->CityId) selected
                                    @endif @endif>{{$city->CityName}}</option>
                        @endforeach
                    @endif
                </select>
            <!-- @if($errors->has('prod_name'))
                <span class="text-danger">{{ $errors->first('prod_name') }}</span>
                    @endif -->
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <h6 for="name">Ngày tiếp nhận hồ sơ <span>*</span></h6>
                        <input require type="date" class="form-control" value="{{ old('StartDateApply', isset($job->StartDateApply) ?$job->StartDateApply : '') }}"
                               name="StartDateApply">
                    <!-- @if($errors->has('prod_name'))
                        <span class="text-danger">{{ $errors->first('prod_name') }}</span>
                    @endif -->
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <h6 for="name">Ngày kết thúc tiếp nhận <span>*</span></h6>
                        <input require type="date" class="form-control" value="{{ old('EndDateApply', isset($job->EndDateApply) ?$job->EndDateApply : '') }}"
                               name="EndDateApply">
                    <!-- @if($errors->has('prod_name'))
                        <span class="text-danger">{{ $errors->first('prod_name') }}</span>
                    @endif -->
                    </div>
                </div>
            </div>
            <div class="form-group">
                <h6>Quyền lợi của ứng viên <span>*</span></h6>
                <textarea type="text" name="Benefit" class="form-control" cols="30" rows="3"
                          placeholder="Quyền lợi cho ứng viên ...">{{ old('Benefit', isset($job->Benifit) ?$job->Benifit : '') }}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary">Lưu</button>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <h6 for="name">Vị trí <span>*</span></h6>
                <select require name="PositionId" class="form-control" id="">
                    @if (isset($positions))
                        @foreach($positions as $position)
                            <option value="{{$position->PositionId}}" @if(isset($job->PositionId)) @if($job->PositionId==$position->PositionId) selected
                                    @endif @endif>{{$position->PositionName}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <h6 for="name">Kỹ năng <span>*</span></h6>
                <input require type="text" class="form-control" placeholder="Kỹ năng ..." value="{{ old('SkillSeeder', isset($job->Skill) ?$job->Skill : '') }}"
                       name="Skill">
            </div>
            <div class="form-group">
                <h6>Mức lương <span>*</span></h6>
                <input require type="number" name="Salary" value="{{ old('Salary', isset($job->Salary) ?$job->Salary : '') }}" class="form-control"
                       placeholder="1,000.000 VNĐ">
                @if($errors->has('Salary'))
                    <span class="text-danger">{{ $errors->first('Salary') }}</span>
                @endif
            </div>
        </div>
    </div>
    {{csrf_field()}}
</form>