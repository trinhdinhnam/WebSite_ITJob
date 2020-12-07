@extends('layouts.master')
@section('main')
<link href="{{asset('theme-admin/css/client/company-list.css')}}" rel="stylesheet" />
<div class="header">
    <div class="header-container">
        <div class="job-number">
            {{$jobNumber->jobNumber}} việc làm cho lập trình viên
        </div>
        <form class="form-inline header-search" action="{{route('client.search.job')}}" method="GET"
            style="margin-bottom: 20px">
            <div class="skill-search">
                <i class="fa fa-search"></i>
                <input type="text" class="search-input" name="skillname" placeholder="Tìm kiếm theo kỹ năng"
                    value="{{\Request::get('skillname')}}">
            </div>
            <div class="city-search">
                <i class="fa fa-map-marker-alt"></i>
                <select name="City" id="city-select">
                    <option disabled selected>Thành phố</option>
                    @if(isset($cities))
                        @foreach($cities as $city)
                            <option value="{{$city->CityId}}" {{ \Request::get('City') == $city->CityId ? "selected='selected'" : ""}}>{{$city->CityName}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <button type="submit" class="btn-search btn btn-danger">
                <h4>Tìm kiếm</h4>
            </button>
        </form>
        <div class="position">
            @if(isset($positions))
            @foreach($positions as $position)
            <a href="{{route('client.get.job.by.position',$position->PositionId)}}" type="button" class=" btn btn-dark"
                id="position">{{$position->PositionName}}</a>
            @endforeach
            @endif
        </div>
    </div>
</div>
<div class="content">
    <div class="content-container">
        <div class="content-title">Nhà tuyển dụng hàng đầu</div>
        <div class="content-list-company row">
            @if(isset($companies))
            @foreach($companies as $company)
            <div class="col-md-4">
                <div class="company-item">
                    <div class="company-item-logo">
                        <img height="100%" width="100%" src="{{asset( pare_url_file($company->CompanyLogo)) }}"
                            class="thumbnail">
                    </div>
                    <div class="company-item-name">
                        {{$company->CompanyName}}
                    </div>
                    <div class="company-item-info">
                        <div class="job-number">
                            <a href="{{route('client.get.job.by.company', $company->RecruiterId)}}"
                                class="btn-job-number">{{$company->jobNumber}} việc làm - </a>
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
    </div>
</div>

@endsection