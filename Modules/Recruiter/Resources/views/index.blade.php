@extends('recruiter::layouts.master')
@section('content')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<link href="{{asset('theme-admin/css/home-page.css')}}" rel="stylesheet" />
<h2 class="mt-4" style="font-family: Arial, Helvetica, sans-serif; margin-bottom: 30px">Trang quản trị của nhà tuyển
    dụng</h2>
<div class="row">
    <div class="col-xl-3 col-md-6 total-trasaction">
        <div class="total-trasaction-label"><i class="fa fa-shopping-cart fa-3x"></i></div>
        <div class="total-trasaction-content">
            <div class="title">Tổng số giao dịch</div>
            <div class="value">{{$totalTran}} <a href="{{route('recruiter.get.transaction')}}">(Chi tiết)</a></div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 total-member" style="display: flex">
        <div class="total-member-label"><i class="fa fa-users fa-3x"></i></div>
        <div class="total-member-content">
            <div class="title">Hồ sơ ứng tuyển</div>
            <div class="value">{{$totalSeeker}} <a href="{{route('recruiter.get.statistical.seeker',\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->id)}}">(Chi tiết)</a></div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 total-job" style="display: flex">
        <div class="total-job-label"><i class="fa fa-file-word fa-3x"></i></div>
        <div class="total-job-content">
            <div class="title">Việc làm</div>
            <div class="value">{{$totalJob}} <a href="{{route('recruiter.get.statistical.job',\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->id)}}">(Chi tiết)</a></div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 total-review" style="display: flex">
        <div class="total-review-label"><i class="fas fa-star-half-alt fa-3x"></i></div>
        <div class="total-review-content">
            <div class="title">Đánh giá</div>
            <div class="value">{{$totalReview}} <a href="{{route('recruiter.get.statistical.review',\Illuminate\Support\Facades\Auth::guard('recruiters')->user()->id)}}">(Chi tiết)</a></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-7">
        <figure class="highcharts-figure">
            <div id="container1" data-list-month="{{$listMonth}}" data-list-revenue="{{$arrRevenueProfile}}"></div>
            <p class="highcharts-description">
            </p>
        </figure>
    </div>
    <div class="col-xl-5">
        <figure class="highcharts-figure">
            <div id="container2" data-list-revenue="{{$arrRevenueProfileByJob}}"></div>
            <p class="highcharts-description">

            </p>
        </figure>
    </div>
</div>
<div class="row">
    <div class="col-xl-7">
<div class="card mb-4" style="border-top: 5px solid #2389d6 ">
    <div class="card-header" style="font-weight: bold">
        <i class="fas fa-table mr-1"></i>
        Danh sách đơn ứng tuyển mới nhất
    </div>
    <div class="card-body">
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên ứng viên</th>
                <th scope="col">Giới thiệu</th>
                <th scope="col">Tên việc làm</th>
                <th scope="col">Ngày ứng tuyển</th>
                <th scope="col">Trạng thái</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($seekers))
                <?php $i=1 ?>
                @foreach($seekers as $seeker)
                    <tr>
                        <th scope="row">{{$i++}}</th>
                        <td>{{$seeker->SeekerName}}</td>
                        <td>{{$seeker->Introduce}}</td>
                        <td>{{$seeker->JobName}}</td>
                        <td>{{$seeker->ApplyDate}}</td>
                        <td>
                            <label
                                    class="badge {{$seeker->getStatus($seeker->Status)['class']}}">{{$seeker->getStatus($seeker->Status)['name']}}</label>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
    </div>
    <div class="col-xl-5">
        <div class="card mb-4" style="border-top: 5px solid #2389d6 ">

        <div class="card-header" style="font-weight: bold">
            <i class="fas fa-table mr-1"></i>
            Danh sách việc làm hot nhất
        </div>
        <div class="card-body">
            @if(isset($jobHots))
                @foreach($jobHots as $job)
            <div class="job-item">
                <div class="job-name">{{$job->JobName}}</div>
                <div class="badge badge-warning apply-number">{{$job->seekerNumber}} lượt ứng tuyển</div>
            </div>
                @endforeach
            @endif
        </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{asset('theme-recruiter/js/home-page.js')}}"></script>

@endsection