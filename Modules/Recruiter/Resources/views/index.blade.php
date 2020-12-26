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
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        DataTable Example
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </tfoot>
                <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('theme-recruiter/js/home-page.js')}}"></script>

@endsection