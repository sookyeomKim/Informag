<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{$landing->lan_title}}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{elixir('css/main.css')}}">
    <style>
        .modal-dialog-lg {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .image-wrap {
            position: relative;
        }

        .image-wrap img {
            width: 100%;
        }

        .image-wrap .button {
            position: absolute;
            left: 50%;
            transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -o-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
            width: 85%;
        }

        .db-button-wrap {
            position: fixed;
            width: 100%;
            height: 50px;
            background-color: rgba(0, 0, 0, 0.5);
            bottom: 0;
            left: 0;
            right: 0;
        }

        .db-button-wrap .btn-primary {
            margin-top: 8px;
        }
    </style>

</head>
<body>

<section class="image-wrap">
    @foreach($jpgArry as $image)
        <img src="{{asset('uploads/images/'.$image->image_name)}}" alt="{{$image->image_name}}" class="main-image">
    @endforeach

    @foreach($dbTitleArray as $key =>$db_field)
        @if($db_field->lan_db_types =='form' && $key == 0)
            <div class="db-button-wrap text-center">
                <button id="db-request-button" class="btn btn-primary">신청하기</button>
            </div>
        @elseif($db_field->lan_db_types =='phone')
            <div class="db-button-wrap text-center">
                <a href="tel:{{FormatPhoneHelper($db_field->lan_db_title)}}" class="btn btn-primary">전화걸기</a>
            </div>
        @elseif($db_field->lan_db_types =='url')
            {{--<a href="{{$db_field->lan_db_title}}" class="btn btn-primary">링크이동</a>--}}
            <a href="{{$url}}" class="button" style="bottom: {{$bottom}}%">
                @foreach($pngArry as $image)
                    <img src="{{asset('uploads/images/'.$image->image_name)}}" alt="특가공구 버튼">
                @endforeach
            </a>
        @endif
    @endforeach
</section>

<div class="modal fade" id="db-reg-modal" tabindex="-1" role="dialog" aria-labelledby="db-reg-modal-label">
    <div class="modal-dialog-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="db-reg-modal-label">필요정보</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    @foreach($dbTitleArray as $key =>$db_field)
                        <div class="form-group">
                            <label class="col-sm-2 control-label"
                                   for="inputEmail3">{{$db_field->lan_db_title}}</label>
                            <div class="col-sm-10">
                                <input type="text" id="{{$key}}" class="form-control db-input"
                                       data-db-title="{{$db_field->lan_db_title}}"
                                       placeholder="{{$db_field->lan_db_title}}"/>
                            </div>
                        </div>
                    @endforeach
                    <input type="hidden" id="lan_mobile_confirm" value="{{$landing->lan_mobile_confirm}}">
                    <input type="hidden" id="lan-page-script" value="{{$landing->lan_page_script}}">
                    <input type="hidden" id="lan-db-script" value="{{$landing->lan_db_script}}">
                </form>
                <div class="terms-wrap">
                    @foreach($landing->terms_fields as $key =>$terms_field)
                        <div class="row">
                            <div class="col-md-3">
                                <h3>약관명</h3>
                                {{$terms_field->lan_terms_name}}
                            </div>
                            <div class="col-md-9">
                                <h3>약관 내용</h3>
                                {{$terms_field->lan_terms_content}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="db-submit-button" class="btn btn-primary">신청하기</button>
            </div>
        </div>
    </div>
</div>
<script src="{{elixir('js/main.js')}}"></script>
<script>
    (function ($) {
        var lan_mobile_confirm = $('#lan_mobile_confirm').val();
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || lan_mobile_confirm === '0') {
            $.ajax({
                type: 'put',
                url: '{{route('landingUrlField.hits',$url_info->id)}}'
            });
            landing_script();
        } else {
            window.location.href = '/warning';
        }

        function landing_script() {
            var page_script_text = $('#lan-page-script').val();
            var db_script_text = $('#lan-db-script').val();
            if (page_script_text !== '') {
                $("head").append(page_script_text);
            }

            $('#db-request-button').click(function () {
                $("#db-reg-modal").modal();
            });

            $("#db-reg-modal").on('hide.bs.modal', function () {
                $(window).scrollTop(0);
            });

            $("#db-submit-button").click(function () {
                $(this).attr('disabled', true);
                var validationCheck = true;
                var emptyCheck = true;
                var unameRegExp = new RegExp(/[\{\}\[\]\/?.,;:|\)*~`!^\-_+<>@\#$%&\\\=\(\'\"]/, 'gi');
                var phoneRegExp = new RegExp(/^[\d]{10,11}$/);
                var ageRegExp = new RegExp('^[0-9]+$');
                var emailRegExp = new RegExp(/^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/, 'i');

                $('.db-input').each(function (key, value) {
                    if ($(this).val() === '') {
                        emptyCheck = false;
                    }
                });

                if (!emptyCheck) {
                    $(this).removeAttr('disabled');
                    alert("모든 내용을 입력해주세요.");
                    return false;
                }

                $('.db-input').each(function (key, value) {
                    if ($(this).attr('data-db-title') === '이름') {
                        if (unameRegExp.test($(this).val())) {
                            validationCheck = false;
                            alert("이름을 다시 입력해주세요.");
                            $(this).focus();
                        }
                    }

                    if ($(this).attr('data-db-title') === '나이') {
                        if (!ageRegExp.test($(this).val())) {
                            validationCheck = false;
                            alert("나이를 다시 입력해주세요.");
                            $(this).focus();
                        }
                    }

                    if ($(this).attr('data-db-title') === '연락처' || $(this).attr('data-db-title') === '전화번호') {
                        if (!phoneRegExp.test($(this).val())) {
                            validationCheck = false;
                            alert("번호를 다시 입력해주세요.");
                            $(this).focus();
                        }
                    }

                    if ($(this).attr('data-db-title') === '이메일') {
                        if (emailRegExp.test($(this).val())) {
                            validationCheck = false;
                            alert("이메일을 다시 입력해주세요.");
                            $(this).focus();
                        }
                    }
                });

                if (!validationCheck) {
                    $(this).removeAttr('disabled');
                    return false;
                }

                if (validationCheck) {
                    db_reg_ajax(this);
                } else {
                    alert("모두 입력해주세요.")
                }
            });

            function db_reg_ajax(thisEl) {
                var dbObj = {};
                var formData = {};

                $(".db-input").each(function (index) {
                    dbObj[$(this).attr('data-db-title')] = $(this).val();
                });

                formData = {
                    lan_id:{{$url_info->lan_id}},
                    db_content: dbObj,
                    db_inflow: '{{$url_info->lan_url}}'
                };

                $.ajax({
                    type: 'post',
                    url: '{{route('DbManageField.store')}}',
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        if (data) {
                            alert('신청이 완료되었습니다.');
                            $(thisEl).removeAttr('disabled');
                            $('<iframe id="db_script_iframe"/>').appendTo('body');
                            $('#db_script_iframe').contents().find('head').append(db_script_text);
                            $('#db_script_iframe').attr('src', $('#db_script_iframe').attr('src'));
                            $("#db-reg-modal").modal('hide');
                            $('.db-input').each(function () {
                                $(this).val('');
                            });
                        } else {
                            alert("이미 신청하셨던 분입니다.");
                            $(thisEl).removeAttr('disabled');
                            $('.db-input').each(function () {
                                $(this).val('');
                            });
                        }
                    },
                    error: function (data) {
                        alert('일시적인 오류로 신청이 안 되었습니다.');
                    }
                });
            }
        }
    })(jQuery);
</script>
</body>
</html>
