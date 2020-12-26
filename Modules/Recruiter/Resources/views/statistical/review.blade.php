@extends('recruiter::layouts.master')
@section('content')
    <h2 class="mt-4">Danh sách đánh giá</h2>
    <ol class="breadcrumb mb-4 ">
        <li class="breadcrumb-item">Trang chủ</li>
        <li class="breadcrumb-item">Báo cáo thống kê</li>
        <li class="breadcrumb-item active">Danh sách đánh giá</li>
    </ol>

    <div class="card mb-4">
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên nhà tuyển dụng</th>
                <th scope="col">Người đánh giá</th>
                <th scope="col">Tiêu đề</th>
                <th scope="col">Điểm tốt</th>
                <th scope="col">Điểm chưa tốt</th>
                <th scope="col">Điểm đánh giá</th>
                <th scope="col">Ngày đánh giá</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($reviews))
                <?php $i=1 ?>
                @foreach($reviews as $review)
                    <tr>
                        <th scope="row">{{$i++}}</th>
                        <td>{{$review->recruiter->RecruiterName}}</td>
                        <td>{{$review->seeker->SeekerName}}</td>
                        <td>{{$review->Title}}</td>
                        <td>{{$review->GoodReview}}</td>
                        <td>{{$review->NotGoodReview}}</td>
                        <td></td>
                        <td>{{$review->created_at}}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@stop