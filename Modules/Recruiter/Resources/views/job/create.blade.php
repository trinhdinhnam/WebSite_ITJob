@extends('recruiter::layouts.master')

@section('content')
    <link href="{{asset('/css/common.css')}}" rel="stylesheet" />

    <link href="{{asset('theme-admin/css/create_job.css')}}" rel="stylesheet" />

<h2 class="mt-4">Thông tin đăng tuyển</h2>
<ol class="breadcrumb mb-4 ">
    <li class="breadcrumb-item">Trang chủ</li>
    <li class="breadcrumb-item">Thông tin đăng tuyển</li>
    <li class="breadcrumb-item active">Thêm mới</li>

</ol>
<div class="container">
    @include("recruiter::job.form")
</div>
@endsection

