    $(function () {
        $(".form-group a").click(function (e) {

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
