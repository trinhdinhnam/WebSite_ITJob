@extends('admin::layouts.master')
@section('content')
    <link href="{{asset('theme-admin/css/recruiter_list_by_admin.css')}}" rel="stylesheet" />

<h2 class="mt-4">Danh sách nhà tuyển dụng</h2>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang chủ</a></li>
    <li class="breadcrumb-item active">Nhà tuyển dụng</li>
</ol>
<form class="form-inline">
    <div class="form-group">
        <input type="text" class="input-recruitername" id="jobname" name="RecruiterName" placeholder="Nhập tên nhà tuyển dụng..." value="{{ \Request::get('recruiterName')}}">
        <select name="Company" id="recruiter-name" class="select-company" style="width: 150px; color: black">
            <option value="" selected>TÊN CÔNG TY</option>
            @if(isset($recruiters))
                @foreach($recruiters as $recruiter)
                    <option value="{{$recruiter->id}}" {{ \Request::get('Company') == $recruiter->id ? "selected='selected'" : ""}}>{{$recruiter->CompanyName}}</option>
                @endforeach
            @endif
        </select>
        <button type="submit" class="btn-search-recruiter">TÌM KIẾM</button>
    </div>

</form>
<div class="card mb-4">
    <table class="table">
        <thead class=" thead-dark" style="text-align: center">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên nhà tuyển dụng</th>
                <th scope="col">Chức vụ</th>
                <th scope="col">Công ty</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($recruiters))
            <?php $i=1 ?>
            @foreach($recruiters as $recruiter)
            <tr>
                <th scope="row">{{$i++}}</th>
                <td>{{$recruiter->RecruiterName}}</td>
                <td>{{$recruiter->Position}}</td>
                <td>{{$recruiter->CompanyName}}</td>

                <td>{{$recruiter->Phone}}</td>
                <td>
                    <a href="{{route('admin.get.action.recruiter',['active',$recruiter->id])}}"
                        class="badge {{$recruiter->getActive($recruiter->Active)['class']}}">{{$recruiter->getActive($recruiter->Active)['name']}}</a>
                </td>
                <td style="width: 260px;">
                    <a href="{{route('admin.get.detail.recruiter',$recruiter->id)}}" class="btn btn-primary">Xem</a>
                    <a href="{{route('admin.get.transaction',$recruiter->id)}}"
                        class="btn btn-success js_transaction_history" style="color: #eee;" data-toggle="modal" data-id="{{$recruiter->RecruiterName}}">Lịch sử GD</a>
                    <a href="{{route('admin.get.action.recruiter',['delete',$recruiter->id])}}"
                        class="btn btn-danger">Xóa</a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
    <div class="card mb-4" style="background-color: #eee; border: none">
        <nav aria-label="Page navigation" style="margin: auto">
            {!! $recruiters->links() !!}
        </nav>
    </div>


<!-- Modal -->

<div class="modal fade" id="myModalTransaction" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Chi tiết giao dịch của nhà tuyển dụng <b class="recruiter_name"></b></h4>

                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="md_content">

            </div>
            <div class="modal-footer">
                <button id="close" type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $(".js_transaction_history").click(function(event) {
            event.preventDefault();
            let $this = $(this);
            let url = $this.attr('href');
            $(".recruiter_name").text('').text($this.attr('data-id'));
            debugger
            $.ajax({
                url: url,
            }).done(function (result) {
                console.log(result);
                if(result)
                {
                    $("#md_content").append(result);
                }
            });
            $("#myModalTransaction").modal('show');
        });
    })
    $("#close").click(function(event) {
        event.preventDefault();
        location.reload();
    })
    $(".close").click(function(event) {
        event.preventDefault();
        location.reload();
    })
</script>
@endsection


