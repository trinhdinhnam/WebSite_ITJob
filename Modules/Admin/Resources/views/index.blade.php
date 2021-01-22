@extends('admin::layouts.master')
@section('content')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<link href="{{asset('theme-admin/css/home-page.css')}}" rel="stylesheet" />
<h2 class="mt-4" style="font-family: Arial, Helvetica, sans-serif; margin-bottom: 30px">Trang quản trị hệ thống việc làm
    Phương Nam Recruiment</h2>
<div class="row">
    <div class="col-xl-3 col-md-6 total-trasaction">
        <div class="total-trasaction-label"><i class="fa fa-shopping-cart fa-3x"></i></div>
        <div class="total-trasaction-content">
            <div class="title">Tổng số giao dịch</div>
            <div class="value">{{$totalTran}} <a href="{{route('admin.get.statistical.revenue')}}">(Chi tiết)</a></div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 total-member" style="display: flex">
        <div class="total-member-label"><i class="fa fa-users fa-3x"></i></div>
        <div class="total-member-content">
            <div class="title">Thành viên</div>
            <div class="value">{{$totalMember}} <a href="{{route('admin.get.statistical.member')}}">(Chi tiết)</a></div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 total-job" style="display: flex">
        <div class="total-job-label"><i class="fa fa-file-word fa-3x"></i></div>
        <div class="total-job-content">
            <div class="title">Việc làm</div>
            <div class="value">{{$totalJob}} <a href="{{route('admin.get.statistical.job')}}">(Chi tiết)</a></div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 total-review" style="display: flex">
        <div class="total-review-label"><i class="fas fa-star-half-alt fa-3x"></i></div>
        <div class="total-review-content">
            <div class="title">Đánh giá</div>
            <div class="value">{{$totalReview}} <a href="{{route('admin.get.statistical.review')}}">(Chi tiết)</a></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-7">
        <figure class="highcharts-figure">
            <div id="container1" data-list-month="{{$listMonth}}" data-list-revenue="{{$arrRevenueTransaction}}" data-list-total-recruiter="{{$arrRevenueRecruiter}}"></div>
            <p class="highcharts-description">
            </p>
        </figure>
    </div>
    <div class="col-xl-5">
        <figure class="highcharts-figure">
            <div id="container2" data-list-revenue="{{$arrRevenueAccountNumber}}"></div>
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
                Danh sách giao dịch mới nhất
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên nhà tuyển dụng</th>
                            <th scope="col">Công ty</th>
                            <th scope="col">Ngày đăng ký</th>
                            <th scope="col">Gói dịch vụ</th>
                            <th scope="col">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($transactions))
                        <?php $i=1 ?>
                        @foreach($transactions as $transaction)
                        <tr>
                            <th scope="row">{{$i++}}</th>
                            <td>{{$transaction->recruiter->RecruiterName}}</td>
                            <td>{{$transaction->recruiter->CompanyName}}</td>
                            <td>{{$transaction->PayDate}}</td>
                            <td>{{$transaction->accountPackage->AccountPackageName}}</td>
                            <td>
                                <label
                                    class="badge {{$transaction->getStatus($transaction->Status)['class']}}">{{$transaction->getStatus($transaction->Status)['name']}}</label>
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
                Danh sách gói dịch vụ hot nhất năm {{getdate()['year']-1}}
            </div>
            <div class="card-body">
                @if(isset($accountPackageHot))
                @foreach($accountPackageHot as $accountPackage)
                <div class="account-item row">
                    <div class="col-8">
                        <div class="account-name">{{$accountPackage['accountName']}}</div>
                        <div class="register-number">{{$accountPackage['accountNumber']}} lượt đăng ký</div>
                    </div>
                    <div class="col-4">
                        <div class="badge badge-warning total-money">{{number_format($accountPackage['Price']*$accountPackage['accountNumber'])}} VNĐ</div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{asset('theme-admin/js/hom-page.js')}}"></script>
@endsection