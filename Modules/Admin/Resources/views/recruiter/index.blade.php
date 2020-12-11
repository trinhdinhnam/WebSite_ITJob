@extends('admin::layouts.master')
@section('content')

<h2 class="mt-4">Nhà tuyển dụng</h2>
<ol class="breadcrumb mb-4 ">
    <li class="breadcrumb-item">Trang chủ</li>
    <li class="breadcrumb-item active">Nhà tuyển dụng</li>
</ol>
<div class="card mb-4">
    <table class="table">
        <thead class="thead-light">
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
                        class="btn btn-warning js_transaction_history" style="color: #eee;" data-toggle="modal" data-id="{{$recruiter->RecruiterName}}">Lịch sử GD</a>
                    <a href="{{route('admin.get.action.recruiter',['delete',$recruiter->id])}}"
                        class="btn btn-danger">Xóa</a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
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


