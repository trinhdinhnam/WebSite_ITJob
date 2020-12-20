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
                <a href="" class="btn btn-danger btn-review">Viết review</a>
                <a href="" class="btn-follow btn btn-light">Theo dõi</a>
            </div>
        </div>
        <div class="page-content row">
            <div class="col-md-8 item-list">
                <ul class="navigation-item" id="tabs">
                    <li class="btn-job-item active">Tuyển dụng</li>
                    <li class="btn-review-item">14 review</li>
                </ul>
                <ul id="tab">
                    <li class="job-list active">
                        <div class="company-name-title"> {{$company->CompanyName}} tuyển dụng</div>
                        @if(isset($company))
                        @foreach($jobByCompanys as $job)

                        <div class="job-item">
                            <div class="company-logo">
                                <div class="logo">
                                    <img height="100%" width="100%"
                                        src="{{asset( pare_url_file($job->recruiter->CompanyLogo)) }}"
                                        class="thumbnail">

                                </div>
                            </div>
                            <div class="job-info">
                                <div class="job-name">
                                    <h3><a href="{{route('client.get.detail.job',$job->JobId)}}">{{$job->JobName}}</a>
                                    </h3>
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
                                <div class="hot-title ">Hot job</div>
                                <div class="job-city ">{{$job->City}}</div>
                                <div class="job-created ">{{$job->formatDate($job->created_at)}}</div>
                            </div>
                        </div>
                        @endforeach
                        @endif

                    </li>
                    <li class="review-page">
                        <div class="medium-score-review">
                            <div class="score-number">4.0</div>
                            @for($i =1 ;$i<=5;$i++) <i class="fa fa-star" data-key="{{$i}}"></i>
                                @endfor
                                <span class="score_text">Tốt</span>
                        </div>

                        <div class="review-list">
                            <div class="review-number">
                                30 reviews
                            </div>
                            <div class="review-item">
                                <h5>Môi trường tốt</h5>
                                @for($i =1 ;$i<=5;$i++) <i class="fa fa-star" data-key="{{$i}}"></i>
                                    @endfor
                                    <span class="score_text">Rất tốt</span>
                                    <div class="review-date">Tháng bảy 2020</div>

                                    <div class="good-review-title">Điều tôi thích</div>
                                    <div class="good-review-content">Môi trường tốt, sếp tốt, nhân viên thân thiện. Quy
                                        trình làm việc rõ ràng. Có thông báo thời gian OT trước và có tiền lương nhân
                                        đôi.
                                        Trước khi lập cú đúp vào lưới Elche, Suarez bị chỉ trích rất nhiều do phong độ
                                        yếu
                                        kém, đặc biệt ở thất bại 0-2 trước Real Madrid tuần trước. HLV Diego Simeone đã
                                        phải
                                        lên tiếng bênh vực cậu học trò trước truyền thông, và may thay Suarez đã nổ súng
                                        trở
                                        lại giúp Atletico bỏ túi 3 điểm.

                                        Dĩ nhiên, việc Suarez sa sút khiến Costa hi vọng anh sẽ có nhiều thời gian ra
                                        sân
                                        hơn. Thế nhưng, sau những gì mà tuyển thủ Uruguay trình diễn trước Elche, Costa
                                        có
                                        lẽ sẽ phải tiếp tục chờ đợi cơ hội, và điều này làm anh chẳng thể nào vui nổi.

                                        Trả lời phóng viên, Costa bông đùa về cú đúp của Suarez: "Lúc tôi chấn thương
                                        thì
                                        anh ta tịt ngòi, cái gã con hoang ấy. Còn lúc tôi khỏi chấn thương quay lại thi
                                        đấu
                                        thì Suarez ghi 2 bàn". Ngay sau đó, Costa đã bày tỏ sự hạnh phúc khi thấy Suarez
                                        lập
                                        cú đúp để mang chiến thắng về cho đội bóng.</div>

                                    <div class="notgood-review-title">Đề nghị cải thiện</div>
                                    <div class="notgood-review-content">Văn phòng làm việc khá cũ, nhà vệ sinh chưa sạch
                                        sẽ.
                                    </div>
                            </div>
                            <div class="review-item">
                                <h5>Môi trường tốt</h5>
                                @for($i =1 ;$i<=5;$i++) <i class="fa fa-star" data-key="{{$i}}"></i>
                                    @endfor
                                    <span class="score_text">Rất tốt</span>
                                    <div class="review-date">Tháng bảy 2020</div>

                                    <div class="good-review-title">Điều tôi thích</div>
                                    <div class="good-review-content">Môi trường tốt, sếp tốt, nhân viên thân thiện. Quy
                                        trình làm việc rõ ràng. Có thông báo thời gian OT trước và có tiền lương nhân
                                        đôi.
                                        Trước khi lập cú đúp vào lưới Elche, Suarez bị chỉ trích rất nhiều do phong độ
                                        yếu
                                        kém, đặc biệt ở thất bại 0-2 trước Real Madrid tuần trước. HLV Diego Simeone đã
                                        phải
                                        lên tiếng bênh vực cậu học trò trước truyền thông, và may thay Suarez đã nổ súng
                                        trở
                                        lại giúp Atletico bỏ túi 3 điểm.

                                        Dĩ nhiên, việc Suarez sa sút khiến Costa hi vọng anh sẽ có nhiều thời gian ra
                                        sân
                                        hơn. Thế nhưng, sau những gì mà tuyển thủ Uruguay trình diễn trước Elche, Costa
                                        có
                                        lẽ sẽ phải tiếp tục chờ đợi cơ hội, và điều này làm anh chẳng thể nào vui nổi.

                                        Trả lời phóng viên, Costa bông đùa về cú đúp của Suarez: "Lúc tôi chấn thương
                                        thì
                                        anh ta tịt ngòi, cái gã con hoang ấy. Còn lúc tôi khỏi chấn thương quay lại thi
                                        đấu
                                        thì Suarez ghi 2 bàn". Ngay sau đó, Costa đã bày tỏ sự hạnh phúc khi thấy Suarez
                                        lập
                                        cú đúp để mang chiến thắng về cho đội bóng.</div>

                                    <div class="notgood-review-title">Đề nghị cải thiện</div>
                                    <div class="notgood-review-content">Văn phòng làm việc khá cũ, nhà vệ sinh chưa sạch
                                        sẽ.
                                    </div>
                            </div>

                        </div>

                        <div class="review-form row">
                            <div class="col-12">
                                <div class="review-form-title" style="margin-bottom: 20px;">Viết đánh giá</div>
                                <span style="margin: 0 15px" class="list_star">
                                    @for($i=1;$i<=5;$i++) 
                                        <i class="fa fa-star" data-key="{{$i}}"></i>
                                    @endfor
                                </span>
                                <span class="score_text">Rất tốt</span>
                                <input type="hidden" value="" class="number_rating">

                                <div class="form-group" style="margin-top: 30px; clear: both;">
                                    <h6 for="name">Tiêu đề</h6>
                                    <input require type="text" class="form-control"
                                        placeholder="Nhập tiêu đề review ..." value="" name="Title" autofocus>

                                </div>
                                <div class="form-group">
                                    <h6>Điểm tốt</h6>
                                    <textarea require type="text" name="GoodReview" class="form-control" cols="30"
                                        rows="5" placeholder="Nhập vào những điểm tốt của công ty ..."></textarea>

                                </div>
                                <div class="form-group">
                                    <h6>Điểm cần cải thiện</h6>
                                    <textarea require type="text" name="NotGoodReview" class="form-control" cols="30"
                                        rows="5"
                                        placeholder="Nhập vào những điểm cần cải thiện của công ty ..."></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-primary">Gửi đánh giá</button>
                                </div>
                            </div>

                        </div>
                    </li>
            </div>
            </ul>


            <div class="col-md-4 review-hot">

                <div class="review-banner">
                    <div class="review-title">Hãy chia sẻ ý kiến của bạn</div>
                    <div class="review-label">Review cho {{$company->CompanyName}} ngay</div>
                    <a href="" class="btn btn-danger btn-review2">Viết Review</a>
                </div>

                <div class="review-hot-list">

                </div>
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
});

//chọn điểm đánh giá
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
        //Xử lý ajax để tạo form đánh giá
        $(function () {
            let listStar = $(".review-form .fa-star");
            listRatingText = {
                1 : 'Không thích',
                2 : 'Tạm được',
                3 : 'Bình thường',
                4 : 'Rất tốt',
                5 : 'Tuyệt vời',
            }

            listStar.mouseover(function () {
                let $this = $(this);
                let number = $this.attr('data-key');
                listStar.removeClass('rating_active');
                $(".number_rating").val(number);
                $.each(listStar, function (key,value) {
                    if( key+1 <= number)
                    {
                        $(this).addClass('rating_active');
                    }
                })
                $(".review-form .score_text").text('').text(listRatingText[number]).show();
            });    
        });

</script>
@stop