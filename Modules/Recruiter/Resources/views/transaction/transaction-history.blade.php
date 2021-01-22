@extends('recruiter::layouts.master')
@section('content')
    <link href="{{asset('/css/common.css')}}" rel="stylesheet" />
    <h2 class="mt-4">Lịch sử giao dịch @if($transactionNew->ExipryDate < now())
            <a href="{{route('recruiter.get.register.account.package')}}"  class="btn btn-primary" style=" float: right;">Đăng ký dịch vụ đăng tuyển</a>
        @else
            <a href=""  class="btn btn-primary btn-invalid" style=" float: right;">Đăng ký dịch vụ đăng tuyển</a>
        @endif</h2>
    <ol class="breadcrumb mb-4 " style="background-color: #ccc;color: #000;">
        <li class="breadcrumb-item"><a href="{{route('recruiter.home')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active" style="color: #fff;"><a>Danh sách giao dịch</a></li>
    </ol>
    @if(isset($transactions))
        <div class="card mb-4">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Mã giao dịch</th>
                    <th scope="col">Ngày thanh toán</th>
                    <th scope="col">Ngày duyệt</th>
                    <th scope="col">Gói đăng ký</th>
                    <th scope="col">Số tiền thanh toán</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Thao tác</th>

                </tr>
                </thead>
                <tbody>
                @foreach($transactions as $tran)
                    <tr>
                        <th>{{$tran->TransactionId}}</th>
                        <td>{{date_format(date_create($tran->PayDate),'d/m/Y H:i:s')}}</td>
                        <td>{{date_format(date_create($tran->Approval),'d/m/Y H:i:s')}}</td>
                        <td style="color: red; font-weight: bold">{{$tran->accountPackage->AccountPackageName}}</td>
                        <td>{{number_format($tran->accountPackage->Price)}} VNĐ</td>
                        <td style="width: 200px">
                            <label
                               class="badge {{$tran->getStatus($tran->Status)['class']}}">{{$tran->getStatus($tran->Status)['name']}}</label>
                            @if($tran->Status==1)
                            <label
                                    class="badge @if($tran->ExipryDate<now()) badge-danger @else badge-success @endif ">@if($tran->ExipryDate<now()) Hết hạn @else Còn hạn @endif</label>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('recruiter.get.detail.transaction',$tran->TransactionId)}}" class="btn btn-primary">Xem</a>

                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <div class="card mb-4" style="background-color: #eee; border: none">
        <nav aria-label="Page navigation" style="margin: auto">
            {!! $transactions->links() !!}
        </nav>
    </div>
    <div class="modal fade"  id="confirmRegisterService" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content" style="height: auto; width: 500px; margin: auto">
                <div class="modal-header">
                    <h6 style="font-size: 25px" class="modal-title"><i style="color: #e2de00; font-size: 34px;" class="fas fa-exclamation-circle"></i>
                        <span style="padding-top: 0px; margin-left: 5px; font-weight: 700">Thông báo</span></h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="md_content_message" >
                    <div style="font-size: 17px; font-weight: 400; text-align: center" class="modal-title">Dịch vụ vẫn đang trong thời hạn sử dụng. Bạn có thể thực hiện chức năng này sau khi hết hạn!</div>
                    <div style="margin: auto; margin-top: 40px">
                        <button id="close" style="margin-left: calc(100% - 80px); margin-right: 5px" type="button" class="btn btn-danger btn-cancle" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('theme-recruiter/js/transaction.js')}}"></script>

@endsection