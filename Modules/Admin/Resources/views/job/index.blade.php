@extends('admin::layouts.master')

@section('content')
    <link href="{{asset('theme-admin/css/job_list_by_admin.css')}}" rel="stylesheet" />

    <h2 class="mt-4">Thông tin đăng tuyển

</h2>
<ol class="breadcrumb mb-4 ">
    <li class="breadcrumb-item"><a href="">Trang chủ</a></li>
    <li class="breadcrumb-item active">Thông tin đăng tuyển</li>
</ol>
    <form class="form-inline">
        <div class="form-group">
            <input type="text" class="input-jobname" id="jobname" name="jobname" placeholder="Nhập tên việc làm..." value="{{ \Request::get('jobname')}}">
            <select name="recruiter" id="recruiter-name" class="select-company" style="width: 150px">
                <option value="" selected>TÊN CÔNG TY</option>
                @if(isset($recruiters))
                    @foreach($recruiters as $recruiter)
                        <option value="{{$recruiter->id}}" {{ \Request::get('recruiter') == $recruiter->id ? "selected='selected'" : ""}}>{{$recruiter->CompanyName}}</option>
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
                <th scope="col">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($jobs))
            <?php $i=1 ?>
            @foreach($jobs as $job)
            <tr>
                <th scope="row">{{$i++}}</th>
                <td>{{$job->JobName}}</td>
                <td>{{$job->position->PositionName}}</td>
                <td>{{$job->Skill}}</td>
                <td>{{$job->Address}}</td>
                <td>
                    <a href="{{route('admin.get.action.job',['active',$job->JobId])}}"
                        class="badge {{$job->getStatus($job->Status)['class']}}">{{$job->getStatus($job->Status)['name']}}</a>
                </td>
                <td>
                    <a href="{{route('admin.get.detail.job',$job->JobId)}}" class="btn btn-primary">Xem</a>
                </td>
            </tr>
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
@endsection