<link href="{{asset('theme-seeker/css/email-apply.css')}}" rel="stylesheet" />
<div class="container" style="width: 70%; margin: auto;">
    <div class="header" style="width: 100%; height: 100px; padding: 20px; background-color: rgb(43, 41, 41);">
        <img height="80px" width="240px" src="{{asset('/images/logo10.png')}}" class="thumbnail logo">
    </div>
    <div class="main" style="width: calc(100% - 8px); height: auto; padding: 20px; border: 4px solid #333;">
        <span class="title" style="font-size: 30px;font-weight: 600;color: red;margin-top: 80px;">THÔNG BÁO ỨNG TUYỂN THÀNH CÔNG</span>
        <div style="margin-top: 20px;">Chào {{$seekerName}}!</div>
        <div style="margin-top: 5px;">Cảm ơn bạn đã tham gia ứng tuyển tại hệ thống chúng tôi</div>
        <div style="margin-top: 30px;">Đơn ứng tuyển của bạn đang chờ nhà tuyển dụng xác nhận (trong 3 - 5 ngày)</div>
        <div style="margin-top: 5px;">Chúng tôi sẽ liên hệ với bạn khi đơn của bạn trứng tuyển</div>
        <div style="margin-top: 5px;">Bạn vui lòng kiếm tra email của mình thường xuyên!</div>

        <div class="apply-detail" style="width: calc(100% - 40px);height: auto;margin: auto;padding: 20px;border: 1px solid #888;margin-top: 40px;">
            <p class="apply-code">Đơn ứng tuyển của bạn <span style="font-weight: 600; color: #f33;"> #apply{{$seekerJobId}}</span> ({{$applyDate}})</p>
            <div class="row" style="display: flex">
                <div class="company-logo col-3">
                <img style="border: 1px solid #ddd" height="140px" width="140px" src="{{asset('images/fptlogo.png') }}"
                        class="thumbnail">
                </div>
                <div class="apply-info col-9" style="margin-left: 40px;">
                    <p class="company-name" style="margin-top: 0px;">Tên công ty:  <span style="font-weight: 600;"> {{$recruiter->CompanyName}}</span> </p>
                    <p class="job-name">Tên việc làm: <span style="font-weight: 600;">{{$job->JobName}}</span> </p>
                    <p>Người ứng tuyển: <span style="font-weight: 600;"> {{$seekerName}} - {{$seekerPhone}} - {{$seekerAddress}}</span> </p>
                    <p>CV ứng tuyển: <span style="font-weight: 600;"> {{$CV}} </span></p>
                    <p>Trạng thái: <span style="font-weight: 600;"> @if($Status==0) Đang chờ xác nhận @endif</span></p>


                </div>
            </div>

        </div>
    </div>
</div>