@extends('layouts.master')
@section('main')

<link href="{{asset('theme-admin/css/client/job-by-company.css')}}" rel="stylesheet" />
<div class="content">
    <div class="content-container">
        @if(isset($company))
        <div class="page-header">
            <div class="company-logo">
                <div class="logo">
                    <img height="100%" width="100%" src="{{asset( pare_url_file($company->CompanyLogo)) }}"
                        class="thumbnail">
                </div>
            </div>
            <div class="company-info">
                <div class="company-name">{{$company->CompanyName}}</div>
                <div class="company-address">
                    <i class="fa fa-map-marker-alt"></i>
                    <div class="address-value">{{$company->City}}</div>
                </div>
                <div class="company-type">
                    <i class="fa fa-cog" style="color: #aaaaaa; margin-top: 5px; font-size: 18px;"></i>
                    <div class="type-business">{{$company->TypeBusiness}}</div>
                    <i class="fa fa-users"></i>
                    <div class="company-size">
                        {{$company->CompanySize}} nhân sự
                    </div>
                    <i class="fa fa-globe"></i>
                    <div class="country">{{$company->Country}}</div>
                </div>
                <div class="company-date-work">
                    <i class="fa fa-calendar-alt"></i>
                    <div class="work-day">{{$company->WorkDay}}</div>
                </div>

                <div class="company-over-time">
                    <i class="fa fa-clock"></i>
                    <div class="over-time">Không OT</div>
                </div>
            </div>
            <div class="company-event">
                @if(\Illuminate\Support\Facades\Auth::guard('seekers')->check())
                <button class="btn btn-danger btn-review">Viết review</button>
                @else
                <a href="{{route('seeker.get.login')}}" class="btn btn-danger btn-review-nologin">Viết review</a>
                @endif
                <button class="btn-follow btn btn-light">Theo dõi</button>
            </div>
        </div>
        <div class="page-content row">
            <div class="col-md-8 item-list">
                <ul class="navigation-item" id="tabs">
                    <li class="btn-job-item active">Tuyển dụng</li>
                    <li class="btn-review-item">{{count($reviewByRecruiters)}} reviews</li>
                </ul>
                <ul id="tab">
                    <li class="job-list active">
                        <div class="company-name-title"> {{$company->CompanyName}} tuyển dụng</div>
                        @if(isset($jobByCompanys))
                        @foreach($jobByCompanys as $job)
                        @if($job->EndDateApply>=now())

                        <div class="job-item">
                            <div class="company-logo">
                                <div class="logo">
                                    <img height="100%" width="100%" src="{{asset( pare_url_file($job->CompanyLogo)) }}"
                                        class="thumbnail">

                                </div>
                            </div>
                            <div class="job-info">
                                <div class="job-name">
                                    <h3><a href="{{route('client.get.detail.job',$job->JobId)}}">{{$job->JobName}}</a>
                                    </h3>
                                </div>
                                <div class="job-date-apply" style="color: #1d79c0; margin-bottom: 5px">Thời gian: {{date_format(date_create($job->StartDateApply),"d/m/Y")}} - {{date_format(date_create($job->EndDateApply),"d/m/Y")}}
                                </div>
                                <div class="job-salary">
                                    <h6>Lương up to: {{number_format($job->Salary)}} VNĐ</h6>
                                </div>

                                <div class="job-description">{{$job->Description}}</div>
                                <div class="job-skill">
                                    @if(isset($job->Skill))
                                    @foreach(explode(", ",$job->Skill) as $skill)
                                    <div class="skill-item">{{$skill}}</div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="job-status">
                                @if($job->seekerNumber>=1)
                                <div style="height: 10%; width: 100%">
                                    <div class="hot-title">Hot job</div>

                                </div>
                                @else
                                <div style="height: 10%; width: 100%">
                                    <div class="hot-title" style="display: none">Hot job</div>

                                </div>
                                @endif
                                <div style="height: 80%; width: 100%">
                                    <div class="job-city ">{{$job->City}}</div>

                                </div>
                                <div style="height: 10%; width: 100%">
                                    <div class="job-created ">{{$job->formatDate($job->CreatedDate)}}</div>

                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @endif
                    </li>
                    <li class="review-page">

                        <div class="medium-score-review">
                            <div class="score-number">
                                @if($company->ReviewNumber>0){{$company->ScoreReview/$company->ReviewNumber}} @else 0
                                @endif</div>
                            @for($i =1 ;$i<=5;$i++) <i
                                class="fa fa-star @if($company->ReviewNumber>0) {{ $i <= round($company->ScoreReview/$company->ReviewNumber) ? 'active' : '' }} @endif"
                                data-key="{{$i}}"></i>
                                @endfor
                                <span class="score_text">Tốt</span>
                        </div>

                        <div class="review-list">
                            <div class="review-number">
                                {{count($reviewByRecruiters)}} reviews
                            </div>
                            @if(isset($reviewByRecruiters))
                            @foreach($reviewByRecruiters as $review)
                            <div class="review-item">
                                <h5>{{$review->Title}}</h5>
                                @for($i =1 ;$i<=5;$i++) <i
                                    class="fa fa-star {{ $i <= $review->ScoreReview ? 'active' : '' }}"
                                    data-key="{{$i}}"></i>
                                    @endfor
                                    <span class="score_text">Rất tốt</span>
                                    <div class="review-date">{{date_format($review->created_at,'d')}} Tháng
                                        {{date_format($review->created_at,'m')}}
                                        {{date_format($review->created_at,'Y')}}</div>

                                    <div class="good-review-title">Điều tôi thích</div>
                                    <div class="good-review-content">{{$review->GoodReview}}</div>

                                    <div class="notgood-review-title">Đề nghị cải thiện</div>
                                    <div class="notgood-review-content">{{$review->NotGoodReview}}</div>
                            </div>

                            @endforeach
                            @endif

                        </div>

                        <div class="review-form row hide">
                            <div class="col-12">
                                <form action="{{route('client.post.review',$company->id)}}"
                                    enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="review-form-title" style="margin-bottom: 20px;">Viết đánh giá</div>
                                    <span style="margin: 0 15px" class="list_star">
                                        @for($i=1;$i<=5;$i++) <i class="fa fa-star" data-key="{{$i}}"></i>
                                            @endfor
                                    </span>
                                    <span class="score_text">Rất tốt</span>
                                    <input type="hidden" value="" name="score_review" class="score_review">

                                    <div class="form-group" style="margin-top: 30px; clear: both;">
                                        <h6 for="name">Tiêu đề</h6>
                                        <input require type="text" class="form-control"
                                            placeholder="Nhập tiêu đề review ..." value="" name="title_review"
                                            id="title-review" autofocus>

                                    </div>
                                    <div class="form-group">
                                        <h6>Điểm tốt</h6>
                                        <textarea type="text" name="good_review_content" id="good-review-content"
                                            class="form-control" cols="30" rows="5"
                                            placeholder="Nhập vào những điểm tốt của công ty ..."></textarea>

                                    </div>
                                    <div class="form-group">
                                        <h6>Điểm cần cải thiện</h6>
                                        <textarea type="text" name="notgood_review_content" id="not-good-review-content"
                                            class="form-control" cols="30" rows="5"
                                            placeholder="Nhập vào những điểm cần cải thiện của công ty ..."></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" style="margin-bottom: 20px;" class="btn btn-primary"
                                            id="js_rating_recruiter">Gửi đánh
                                            giá</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 review-hot">
                <div class="review-banner">
                    <div class="review-title">Hãy chia sẻ ý kiến của bạn</div>
                    <div class="review-label">Review cho {{$company->CompanyName}} ngay</div>
                    @if(\Illuminate\Support\Facades\Auth::guard('seekers')->check())
                    <button ref="" class="btn btn-danger btn-review2">Viết Review</button>
                    @else
                    <a href="{{route('seeker.get.login')}}" class="btn btn-danger btn-review2-nologin">Viết review</a>
                    @endif
                </div>
                @if(isset($reviewHots))
                <div class="review-hot-list">
                    <div class="review-hot-label">Review "hot"</div>
                    @foreach($reviewHots as $reviewHot)
                    <div class="review-hot-item">
                        <div class="review-hot-title">"{{$reviewHot->Title}}"</div>
                        <span style="margin: 0 15px; display: flex; height: 40px;" class="review-hot list_star">
                            @for($i=1;$i<=5;$i++) <i
                                class="fa fa-star {{$i <= $reviewHot->ScoreReview ? 'active' : '' }}"
                                style="margin-right: 5px"></i>
                                @endfor
                        </span>
                        <div class="good-review">{{$reviewHot->GoodReview}}</div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endif
@endsection

@section('script')

<script type="text/javascript">
$("ul#tabs li").click(function(e) {
    if (!$(this).hasClass("active")) {
        var tabNum = $(this).index();
        var nthChild = tabNum + 1;
        $("ul#tabs li.active").removeClass("active");
        $(this).addClass("active");
        $("ul#tab li.active").removeClass("active");
        $("ul#tab li:nth-child(" + nthChild + ")").addClass("active");
    }
})

$(".btn.btn-danger.btn-review, .btn-review2").click(function(e) {
    e.preventDefault();

    $("ul#tabs li.active").removeClass("active");
    $(".btn-review-item").addClass("active");
    $(".job-list").removeClass('active');
    $(".review-page").addClass('active');
    if ($(".review-form").hasClass('hide')) {
        $(".review-form").addClass('show').removeClass('hide');
    } else {
        $(".review-form").addClass('hide').removeClass('show');

    }
})

//Xử lý ajax để tạo form đánh giá
$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let listStar = $(".list_star .fa-star");
    listRatingText = {
        1: 'Không thích',
        2: 'Tạm được',
        3: 'Bình thường',
        4: 'Rất tốt',
        5: 'Tuyệt vời',
    }

    listStar.click(function() {

        let $this = $(this);
        let number = $this.attr('data-key');
        listStar.removeClass('rating_active')
        $(".score_review").val(number);
        $.each(listStar, function(key, value) {
            if (key + 1 <= number) {
                $(this).addClass('rating_active')
            }
        });
        $(".review-form .col-12 .score_text").text('').text(listRatingText[number]).show();
    });

    $(function() {
        var click = 1;
        $(".btn-review-nologin, .btn-review2-nologin").click(function(event) {
            event.preventDefault();
            let $this = $(this);
            let url = $this.attr('href');
            $.ajax({
                url: url,
            }).done(function(result) {
                if (result) {
                    $("#md_content").append(result);
                }
            });
            $("#myModalLogin").modal('show');
        });

        $('#myModalLogin').on('hidden.bs.modal', function(e) {
            location.reload();
        });

    })

    // $("#js_rating_recruiter").click(function(event) {
    //     event.preventDefault();
    //     let $this = $(this);
    //     let url = $this.attr('href');
    //     let title_review = $("#title-review").val();
    //     let good_review_content = $("#good-review-content").val();
    //     let notgood_review_content = $("#not-good-review-content").val();
    //     let score_review = $(".score_review").val();
    //     if (title_review && score_review) {
    //         $.ajax({
    //             url: url,
    //             type: 'POST',
    //             contentType: 'application/json',
    //             dataType: 'json',
    //             data: {
    //                 'title_review': title_review,
    //                 'good_review_content': good_review_content,
    //                 'notgood_review_content': notgood_review_content,
    //                 'score_review': score_review
    //             }
    //         }).done(function(result) {
    //             if (result) {
    //                 alert("Bạn đã gửi review thành công");
    //                 location.reload();
    //             } else {
    //                 alert("Bạn chưa gửi được review của mình");
    //                 //location.reload();
    //             }
    //         });
    //     }
    // });
});
</script>
@stop