 <link href="{{asset('css/account-package.css')}}" rel="stylesheet" />
    <div class="content">
        <div class="container register-form" >
            <div class="form">
                <div class="note">
                    <h3 >Chọn gói dịch vụ</h3>
                </div>
                <div class="form-content">
                    @if(isset($acPackages))
                        @foreach($acPackages as $acPackage)
                        <div class="account-item">
                             <h3 class="package-name">{{$acPackage->AccountPackageName}}</h3>
                             <div class="price"><div class="price-label">Giá:</div>{{number_format($acPackage->Price)}}</div>
                             <div class="post-number"><div class="postnumber-label">Số lượt đăng:</div>{{$acPackage->PostNumber}}</div>
                            <input style="display: none;" value="{{$acPackage->AccountPackageId}}" name="accountPackageId" class="accountPackageId" />
                        </div>
                        @endforeach
                        @endif
                </div>
            </div>
        </div>
    </div>
