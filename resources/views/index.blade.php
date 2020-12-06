@extends('layouts.master')
@section('main')
<link href="{{asset('theme-admin/css/client/company-list.css')}}" rel="stylesheet" />
<div class="content-title">Nhà tuyển dụng hàng đầu</div>
<div class="content-list-company row">
    @if(isset($companies))
        @foreach($companies as $company)
    <div class="col-md-4">
        <div class="company-item">
            <div class="company-item-logo">
                <img height="100%" width="100%" src="{{asset( pare_url_file($company->CompanyLogo)) }}" class="thumbnail">
            </div>
            <div class="company-item-name">
                {{$company->CompanyName}}
            </div>
            <div class="company-item-info">
                <div class="job-number">
                    <a href="{{route('client.get.job.by.company', $company->RecruiterId)}}" class="btn-job-number">{{$company->jobNumber}} việc làm - </a>
                </div>
                <div class="company-address">
                    {{$company->City}}
                </div>
            </div>
        </div>
    </div>
            @endforeach
    @endif
</div>
@endsection