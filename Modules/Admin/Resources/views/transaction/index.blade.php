@if(isset($transactions))
    <div class="card mb-4">
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">Mã giao dịch</th>
                <th scope="col">Ngày thanh toán</th>
                <th scope="col">Ngày gia hạn</th>
                <th scope="col">Gói đăng ký</th>
                <th scope="col">Số tiền thanh toán</th>
                <th scope="col">Số lượt đăng</th>
                <th scope="col">Trạng thái</th>
            </tr>
            </thead>
            <tbody>
                @foreach($transactions as $tran)
                    <tr>
                        <th>{{$tran->TransactionId}}</th>
                        <td>{{$tran->PayDate}}</td>
                        <td>{{$tran->ExipryDate}}</td>
                        <td>{{$tran->accountPackage->AccountPackageName}}</td>
                        <td>{{number_format($tran->accountPackage->Price)}} VNĐ</td>
                        <td>{{$tran->accountPackage->PostNumber}} lượt</td>

                        <td>
                            <a href="{{route('admin.get.action.transaction',['status',$tran->TransactionId])}}"
                               class="badge {{$tran->getStatus($tran->Status)['class']}}">{{$tran->getStatus($tran->Status)['name']}}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
