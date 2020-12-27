@extends('admin::layouts.master')
@section('content')
    <h2 class="mt-4">Danh sách giao dịch nhà tuyển dụng</h2>
    <ol class="breadcrumb mb-4 ">
        <li class="breadcrumb-item">Trang chủ</li>
        <li class="breadcrumb-item">Báo cáo thống kê</li>
        <li class="breadcrumb-item active">Lịch sử giao dịch</li>
    </ol>

    <div class="card mb-4">
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên nhà tuyển dụng</th>
                <th scope="col">Công ty</th>
                <th scope="col">Ngày giao dịch</th>
                <th scope="col">Tổng hóa đơn</th>
                <th scope="col">Ghi chú</th>
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
                        <td>
                            {{$transaction->created_at}}
                        </td>
                        <td>{{number_format($transaction->Total)}} VNĐ</td>
                        <td>
                            {{$transaction->Note}}
                        </td>
                        <td><label
                                    class="badge {{$transaction->getStatus($transaction->Status)['class']}}">{{$transaction->getStatus($transaction->Status)['name']}}</label>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    <div class="card mb-4" style="background-color: #eee; border: none">
        <nav aria-label="Page navigation" style="margin: auto">
            {!! $transactions->links() !!}
        </nav>
    </div>
    <!-- Modal -->
@stop