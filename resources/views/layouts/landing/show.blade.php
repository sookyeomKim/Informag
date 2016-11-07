<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi">
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
    </style>
</head>
<body>
<section class="image-wrap">
    @foreach($landing->images as $image)
        <img src="{{asset('uploads/images/'.$image->image_name)}}" alt="" class="img-responsive">
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
                    {{ csrf_field() }}
                    @foreach($landing->db_fields as $key =>$db_field)
                        <div class="form-group">
                            <label class="col-sm-2 control-label"
                                   for="inputEmail3">{{$db_field->lan_db_title}}</label>
                            <div class="col-sm-10">
                                <input type="email" id="{{$key}}" class="form-control db-input"
                                       data-db-title="{{$db_field->lan_db_title}}"
                                       placeholder="{{$db_field->lan_db_title}}"/>
                            </div>
                        </div>
                    @endforeach
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="db-submit-button" class="btn btn-primary">신청하기</button>
            </div>
        </div>
    </div>
</div>
<script src="{{elixir('js/main.js')}}"></script>
<script>
    $(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });

        hits();

        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() == $(document).height()) {
                $("#db-reg-modal").modal();
            }
        });

        $("#db-reg-modal").on('hide.bs.modal', function () {
            $(window).scrollTop(0);
        });

        $("#db-submit-button").click(function () {
            db_reg_ajax();
        });

        function hits() {
            $.ajax({
                type: 'get',
                url: '{{route('landingUrlField.hits',$url_info->lan_id)}}'
            });
        }

        function db_reg_ajax() {
            var dbArry = [];
            var formData = {};
            $(".db-input").each(function (index) {
                var dbObj = {};
                dbObj["'" + $(this).attr('data-db-title') + "'"] = $(this).val();
                dbArry[index] = dbObj;
            });

            formData = {
                lan_id:{{$url_info->lan_id}},
                db_content: dbArry,
                db_inflow:'{{$url_info->lan_url}}'
            };

            $.ajax({
                type: 'post',
                url: '{{route('DbManageField.store')}}',
                data: formData,
                dataType: 'json',
                success: function (data) {
                    console.log(data)
                },
                error: function (data) {
                    console.log(data)
                }
            });
        }
    });
</script>
</body>
</html>
