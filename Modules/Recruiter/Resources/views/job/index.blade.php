@extends('recruiter::layouts.master')
@section('content')
    <link href="{{asset('/css/common.css')}}" rel="stylesheet" />
    <link href="{{asset('theme-recruiter/css/job.css')}}" rel="stylesheet" />
    <div class="pull-right message-warning" style="position: absolute; right: 22px; margin-top: -10px; z-index: 1;">

            @if($transactionNew->Status==0)
                <div class="alert alert-warning">
                    Warning! Tài khoản của bạn đang chờ xét duyệt, bạn có thể liên lạc để chúng tôi kiểm tra nhanh nhất.
                </div>
            @elseif($transactionNew->ExipryDate<now())
                <div class="alert alert-warning">
                    Warning! Tài khoản của bạn đã hết hiệu lực, yêu cầu đăng ký để tiếp tục sử dụng.
                </div>
            @endif
        @if(\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->PostResidual==0)
                <div class="alert alert-warning">
                    Warning! Tài khoản của bạn đã hết lượt đăng bài, yêu cầu đăng ký để tiếp tục sử dụng.
                </div>
        @endif
    </div>
<h2 class="mt-4">Thông tin đăng tuyển <a href="{{route('recruiter.get.create.job')}}"  class="btn btn-primary @if($transactionNew->ExipryDate<now()||$transactionNew->Status==0) dis @else @endif @if(\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->PostResidual==0) dis @endif" style=" float: right;">Đăng bài</a></h2>
<ol class="breadcrumb mb-4 ">
    <li class="breadcrumb-item"><a href="{{route('recruiter.home')}}">Trang chủ</a></li>
    <li class="breadcrumb-item active">Thông tin đăng tuyển</li>
</ol>
<form class="form-inline">
    <div class="form-group">
        <input type="text" class="input-jobname" id="jobname" name="jobname" placeholder="Nhập tên việc làm..." value="{{ \Request::get('jobname')}}">
        <select name="position" id="position-name" class="select-position" style="width: 150px;">
            <option value="" selected>Vị trí công việc</option>
            @if(isset($positions))
                @foreach($positions as $position)
                    <option value="{{$position->PositionId}}" {{ \Request::get('position') == $position->PositionId ? "selected='selected'" : ""}}>{{$position->PositionName}}</option>
                @endforeach
            @endif
        </select>
        <button type="submit" class="btn-search-job">TÌM KIẾM</button>
    </div>

</form>
<div class="card mb-4">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên công việc</th>
                <th scope="col">Vị trí</th>
                <th scope="col">Kỹ năng</th>
                <th scope="col">Địa chỉ</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Số ứng viên</th>
                <th scope="col">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($jobs))
            <?php $i=0 ?>
            @foreach($jobs as $job)
            <tr>
                <th scope="row">{{$i + 1}}</th>
                <td>{{$job->JobName}}</td>
                <td>{{$job->PositionName}}</td>
                <td>{{$job->Skill}}</td>
                <td>{{$job->Address}}</td>
                <td>
                    <label class="badge {{$job->getStatus($job->Status)['class']}}">{{$job->getStatus($job->Status)['name']}}</label>
                </td>
                <td style="width: 100px; text-align: center;">
                    <a href="{{route('recruiter.get.seeker.by.job',$job->JobId)}}" class="btn btn-primary @if($transactionNew->ExipryDate<now()||$transactionNew->Status==0) dis @else @endif @if(\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->PostResidual==0) dis @endif"
                       style="border-radius: 50%; background-color: #567; border: none; width: 37px;">
                        {{$job->seekerNumber}}</a>
                </td>
                <td style="width: 200px;">
                    <a href="{{route('recruiter.get.detail.job',$job->JobId)}}" class="btn btn-primary">Xem</a>
                    <a href="{{route('recruiter.get.edit.job',$job->JobId)}}" class="btn btn-success @if($transactionNew->ExipryDate<now()||$transactionNew->Status==0) dis @else @endif @if(\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->PostResidual==0) dis @endif">Sửa</a>
                    <a href="" class="btn btn-delete btn-danger @if($transactionNew->ExipryDate<now()||$transactionNew->Status==0) dis @else @endif @if(\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->PostResidual==0) dis @endif">Xóa</a>
                </td>
            </tr>
            <?php $i++ ?>
            <div class="modal fade"  id="confirmDelete" role="dialog">
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content" style="height: auto; width: 500px; margin: auto">
                        <div class="modal-header">
                            <h6 style="font-size: 25px; text-align: center;" class="modal-title"><i style="color: #15289d; font-size: 34px;" class="fas fa-question-circle"></i>
                                <span style="margin-bottom: 20px; margin-left: 5px; font-weight: 700">Thông báo</span></h6>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body" id="md_content_message" >
                            <div style="font-size: 17px; font-weight: 400; text-align: center" class="modal-title">Bạn có muốn xóa thông tin đăng tuyển này?</div>
                            <div style="margin: auto; margin-top: 40px">
                                <a href="{{route('recruiter.get.delete.job',$job->JobId)}}" style="margin-left: calc(100% - 150px); margin-right: 5px" id="close" class="btn btn-primary btn-ok" >Đồng ý</a>
                                <button id="close" type="button" class="btn btn-danger btn-cancle" data-dismiss="modal">Hủy</button>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
<div class="card mb-4" style="background-color: #eee; border: none">
    <nav aria-label="Page navigation" style="margin: auto">
        {!! $jobs->links() !!}
    </nav>
</div>
    <script src="{{asset('theme-recruiter/js/job.js')}}"></script>
    @endsection