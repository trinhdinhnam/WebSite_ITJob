@extends('layouts.master')
@section('main')
<link href="{{asset('theme-seeker/css/job-detail.css')}}" rel="stylesheet" />
@if(isset($jobDetail))
<div class="content">
    <div class="content-container">
        <div class="job-detail-content">
            <div class='row'>
                @if (isset($imageCompanies))
                @foreach($imageCompanies as $image)
                <div class="col-4">
                    <div class="job-image">
                        <img height="100%" width="100%" src="{{asset( pare_url_file($image->Image)) }}"
                            class="thumbnail">
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            <div class="row">
                <div class=" col-4">
                    <div class=" company-item">
                    <div class="company-logo">
                        <img height="100%" width="100%"
                            src="{{asset( pare_url_file($jobDetail->recruiter->CompanyLogo)) }}" class="thumbnail">
                    </div>
                    <div class="company-detail">
                        <h4 class="company-name">{{$jobDetail->recruiter->CompanyName}}</h4>
                        <p class="company-introduction">{{$jobDetail->recruiter->Introduction}}</p>
                        <div class="company-typebusiness">
                            <i class="fa fa-cog" style="color: #aaaaaa;"></i>
                            <div class="typbusiness-name">{{$jobDetail->recruiter->TypeBusiness}}</div>
                        </div>
                        <div class="company-size">
                            <i class="fa fa-user-friends" style="color: #aaaaaa;"></i>
                            <div class="size-value">{{$jobDetail->recruiter->CompanySize}}</div>
                        </div>
                        <div class="company-address">
                            <i class="fa fa-map-marker-alt" style="color: #aaaaaa;"></i>
                            <div class="address-value">{{$jobDetail->recruiter->Address}}</div>
                        </div>
                        <div class="company-workday">
                            <i class="fa fa-calendar-alt" style="color: #aaaaaa;"></i>
                            <div class="workday-value">{{$jobDetail->recruiter->WorkDay}}</div>
                        </div>
                        <div class="company-worktime">
                            <i class="fa fa-clock" style="color: #aaaaaa;"></i>
                            <div class="worktime-value">{{$jobDetail->recruiter->TimeWork}}</div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-8">
                    <h2>{{$jobDetail->JobName}}</h2>
                    <div class="skill">
                        @foreach(explode(", ",$jobDetail->Skill) as $skill)
                        <div class="language-name">{{$skill}}</div>
                        @endforeach
                    </div>
                    <div class="job-address">
                        <i class="fa fa-map-marker-alt"></i>
                        <div class="address-value">{{$jobDetail->Address}}</div>
                    </div>
                    <div class="date-apply-job">
                        <i class="fas fa-file-upload" style="color: #000;"></i>
                        <div class="date-apply-job-value">Từ ngày: {{$jobDetail->StartDateApply}} - Đến ngày: {{$jobDetail->EndDateApply}}</div>
                    </div>
                    <div class="date-up-job">
                        <i class="fa fa-calendar-alt" style="color: #0010ee;"></i>
                        <div class="date-up-job-value">{{$jobDetail->formatDate($jobDetail->created_at)}}</div>
                    </div>


                    @if(\Illuminate\Support\Facades\Auth::guard('seekers')->check())

                    <a href="{{route('client.get.apply',$jobDetail->JobId)}}" class="btn-apply btn btn-danger
                                @foreach($jobApplies as $jobApply)
                                @if($jobDetail->JobId == $jobApply->JobId)
                                        dis
                                @else
                                @endif
                                @endforeach
                                  ">Ứng tuyển</a>
                    @else
                    <a href="" class="btn-apply-notlogin btn btn-danger">Ứng tuyển</a>
                    @endif
                    <h2 class="benefit-title">3 Lý Do Để Gia Nhập Công Ty</h2>
                    @foreach(explode(".",$jobDetail->Benifit) as $benifit)
                        <div style="padding-left: 40px; font-weight: 500"> *  {{$benifit}}</div>
                    @endforeach
                    <h2 class="description-title">Mô tả công việc</h2>
                    @foreach(explode(".",$jobDetail->Description) as $description)
                        <div style="padding-left: 40px;"> <li style="list-style-type: circle;">{{$description}}</li></div>
                    @endforeach
                    <h2 class="require-title">Yêu cầu</h2>
                    @foreach(explode(".",$jobDetail->Require) as $require)
                        <div style="padding-left: 40px;"> <li style="list-style-type: circle;">{{$require}}</li></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade"  id="confirmLogin" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content" style="height: auto; width: 500px; margin: auto">
            <div class="modal-header">
                <h6 style="font-size: 20px" class="modal-title"><i style="color: #15289d;" class="fas fa-question-circle"></i>
                    Thông báo</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body" id="md_content_message" >
                <div style="font-size: 17px; font-weight: 400; text-align: center" class="modal-title">Bạn có muốn đăng nhập để tiếp tục ứng tuyển?</div>
                <div style="margin: auto; margin-top: 40px">
                    <button style="margin-left: calc(100% - 150px); margin-right: 5px" id="close" type="button" class="btn btn-primary btn-ok" data-dismiss="modal">Đồng ý</button>
                    <button id="close" type="button" class="btn btn-danger btn-cancle" data-dismiss="modal">Hủy</button>
                </div>


            </div>
        </div>
    </div>
</div>
    <script type="text/javascript">
    $(function() {
        $(".btn-apply-notlogin").click(function(event) {
            event.preventDefault();
            let $this = $(this);
            let url = $this.attr('href');

            $("#confirmLogin").modal('show');
            $(".btn-ok").click(function(event) {
                $.ajax({
                    url: url,
                }).done(function(result) {
                    if (result) {
                        $("#md_content").append(result);

                    }
                    $("#myModalLogin").modal('show');
                    $('#myModalLogin').on('hidden.bs.modal', function(e) {
                        location.reload();
                    });
                });

            });        });

        $('#confirmLogin').on('hidden.bs.modal', function(e) {
            location.reload();
        });
    })
    </script>
    @endif
    @endsection