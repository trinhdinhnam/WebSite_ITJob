@extends('recruiter::layouts.master')

@section('content')
    <link href="{{asset('/css/common.css')}}" rel="stylesheet" />

    <link href="{{asset('theme-recruiter/css/seeker_list.css')}}" rel="stylesheet" />
<h2 class="mt-4">Danh sách ứng viên</h2>
<ol class="breadcrumb mb-4 ">
    <li class="breadcrumb-item"><a href="{{route('recruiter.home')}}">Trang chủ</a></li>
    <li class="breadcrumb-item"><a href="{{route('recruiter.get.list.job')}}">Thông tin đăng tuyển</a></li>

    <li class="breadcrumb-item active">Danh sách ứng viên</li>
</ol>
    <form class="form-inline">
        <div class="form-group">
            <input type="text" class="input-seekername" id="seekername" name="seekername" placeholder="Nhập tên ứng viên..." value="{{ \Request::get('jobname')}}">
            <button type="submit" class="btn-search-seeker"><i class="fa fa-search"></i></button>
        </div>
    </form>
<div class="list-seeker">
    @if(isset($seekers))
        @foreach($seekers as $seeker)

     <div class="seeker-item row">
        <div class="seeker-avatar col-2">
            <img height="170px" width="140px" src="{{asset(pare_url_file($seeker->seeker->Avatar))}}" class="thumbnail">
        </div>
        <div class="seeker-info col-8">
            <div class="seeker-name">
                <h2>{{$seeker->seeker->SeekerName}}</h2>
                <a style="height: 20px; margin-left: 5px;" class="badge {{$seeker->getStatus($seeker->Status)['class']}}">{{$seeker->getStatus($seeker->Status)['name']}}</a>
            </div>
            <div class="job-name">Vị trí: {{$seeker->job->JobName}}</div>
            <div class="seeker-gender"><i class="fa fa-transgender"></i>{{$seeker->seeker->getGender($seeker->seeker->Gender)['name']}}</div>
            <div class="seeker-email"><i class="fa fa-envelope"></i>{{$seeker->seeker->Email}}</div>
            <div class="seeker-phone"><i class="fa fa-phone-volume"></i>{{$seeker->seeker->Phone}}</div>
            <div class="seeker-education"><i class="fa fa-graduation-cap"></i>{{$seeker->seeker->getEducation($seeker->seeker->Education)['name']}}</div>
            <div class="date-apply"><i class="fa fa-calendar-alt"></i>{{$seeker->created_at}}</div>
        </div>
        <div class="button col-2">
            <a href="{{route('recruiter.get.action.seeker.by.job',['status',$seeker->SeekerJobId])}}"
               class="btn btn-success @if($seeker->Status==1) disabled @endif"><i class="fa fa-check"></i></a>
            <a href="{{route('recruiter.get.seeker.detail',$seeker->SeekerJobId)}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
            <a href=""
               class="btn btn-danger btn-delete"><i class="fa fa-trash-alt"></i></a>
        </div>

    </div>
            <div class="modal fade"  id="confirmDelete" role="dialog">
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content" style="height: auto; width: 500px; margin: auto">
                        <div class="modal-header">
                            <h6 style="font-size: 20px" class="modal-title"><i style="color: #15289d;" class="fas fa-question-circle"></i>
                                Thông báo</h6>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body" id="md_content_message" >
                            <div style="font-size: 17px; font-weight: 400; text-align: center" class="modal-title">Bạn có muốn xóa ứng viên này?</div>
                            <div style="margin: auto; margin-top: 40px">
                                <a href="{{route('recruiter.get.action.seeker.by.job',['delete',$seeker->SeekerJobId])}}" style="margin-left: calc(100% - 150px); margin-right: 5px" id="close" class="btn btn-primary btn-ok" >Đồng ý</a>
                                <button id="close" type="button" class="btn btn-danger btn-cancle" data-dismiss="modal">Hủy</button>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @endif

</div>
    <div class="card mb-4" style="background-color: #eee; border: none">
        <nav aria-label="Page navigation" style="margin: auto">
            {!! $seekers->links() !!}
        </nav>
    </div>
    <script type="text/javascript">
        $(function() {
            $(".btn-delete").click(function(event) {
                event.preventDefault();
                $("#confirmDelete").modal('show');
            });
            $('#confirmLogin').on('hidden.bs.modal', function(e) {
                location.reload();
            });
        })
    </script>
@endsection