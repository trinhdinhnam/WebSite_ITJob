@extends('layouts.master')
@section('main')
    <div class="container" style="padding-top: 90px; margin-bottom: 20px">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="title" style="margin: auto; font-size: 35px;">
                            Cập nhật mật khẩu
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="card-body">
                        <form method="POST" action="">
                            @csrf

                            <div class="form-group" style="position: relative">
                                <label for="exampleInputEmail1">Mật khẩu cũ: </label>
                                <input type="password" class="form-control" id="exampleInputEmail2" name="pass_old" placeholder="******">
                                @if($errors->has('pass_old'))
                                    <span class="text-danger">{{ $errors->first('pass_old') }}</span>
                                @endif
                                <a style="position: absolute;top: 60%;right: 10px;color: #337ab7  " href="javascript:;void(0)"><i class="fa fa-eye"></i></a>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mật khẩu mới: </label>
                                <input type="password" class="form-control" id="exampleInputEmail3" name="pass_new"   placeholder="******">
                                @if($errors->has('pass_new'))
                                    <span class="text-danger">{{ $errors->first('pass_new') }}</span>
                                @endif
                                <a style="position: absolute;top: 55%;right: 30px;color: #337ab7  " href="javascript:;void(0)"><i class="fa fa-eye"></i></a>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nhập lại mật khẩu mới: </label>
                                <input type="password" class="form-control" id="exampleInputEmail4" name="pass_confirm"  placeholder="******">
                                @if($errors->has('pass_confirm'))
                                    <span class="text-danger">{{ $errors->first('pass_confirm') }}</span>
                                @endif
                                <a style="position: absolute;top: 72%;right: 30px;color: #337ab7  " href="javascript:;void(0)"><i class="fa fa-eye"></i></a>

                            </div>
                            <button type="submit" class="btn btn-success" style="background-color: green">Cập nhật</button>
                            <br>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $(".form-group a").click(function () {
                let $this = $(this);
                if($this.hasClass('active')){
                    $this.parents('.form-group').find('input').attr('type','password')
                    $this.removeClass('active');
                }else{
                    $this.parents('.form-group').find('input').attr('type','text')
                    $this.addClass('active');
                }
            });
        });
    </script>
@endsection

