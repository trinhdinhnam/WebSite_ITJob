@extends('layouts.master')
@section('main')
<link href="{{asset('theme-admin/css/client/job-by-company.css')}}" rel="stylesheet" />

<div class="page-header">
    <div class="company-logo">
        <div class="logo"></div>
    </div>
    <div class="company-info">
        <div class="company-name">NVG Solution</div>
        <div class="company-address">
            <i class="fa fa-map-marker-alt" ></i>
            <div class="address-value">Thành phố Hồ Chí Minh</div>
        </div>
        <div class="company-type">
            <i class="fa fa-cog" style="color: #aaaaaa; margin-top: 5px; font-size: 18px;"></i>
            <div class="type-business">Sản phẩm</div>
        </div>
        <div class="company-date-work">
        <i class="fa fa-calendar-alt"></i>            
        <div class="work-day">Thứ 2 - Thứ 6</div>
        </div>
    </div>
    <div class="company-event"></div>

</div>
<div class="page-content">

</div>
@endsection