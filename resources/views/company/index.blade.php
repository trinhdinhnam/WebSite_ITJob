@extends('layouts.master')
@section('main')

    <link href="{{asset('theme-seeker/css/list-company.css')}}" rel="stylesheet" />
    <div class="company-list">
        <div class="title">
            Danh sách công ty tuyển dụng
        </div>
        <?php $j=1 ?>

    @if(isset($recruiters))
            @foreach($recruiters as $recruiter)

        <div class="company-item">
            <div class="company-name">
                <span style="color: red">#{{$j++}}</span>
                <a style="color: black" href="{{route('client.get.job.by.company',$recruiter->id)}}">{{$recruiter->CompanyName}}</a>
            </div>
            <br>
            <div class="company-info row">
                <div class="company-logo col-md-3">
                <img height="160px" width="160px" src="{{asset( pare_url_file($recruiter->CompanyLogo)) }}"
                            class="thumbnail">
                </div>
                <div class="company-review col-md-9">
                    <div class="review-score">
                    @if($recruiter->ReviewNumber>0) <span class="score-number">{{$recruiter->ScoreReview/$recruiter->ReviewNumber}}</span>
                    @else <span class="score-text">Chưa có đánh giá</span>
                    @endif
                            @for($i =1 ;$i<=5;$i++) 
                            <i class="fa fa-star @if($recruiter->ReviewNumber>0) {{ $i <= ($recruiter->ScoreReview/$recruiter->ReviewNumber) ? 'active' : '' }} @endif"
                                data-key="{{$i}}"></i>
                     @endfor
                    </div>
                    <br>
                    <br>
                    <div class="review-content"> <img style="margin-right: 5px;" height="20px" width="20px" src="{{asset('images/comma.png')}}" class="thumbnail">{{$recruiter->Introduction}}</div>
                </div>
            </div> 
        </div>
            @endforeach
        @endif
    </div>

@endsection