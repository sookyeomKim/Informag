@extends('layouts.marster')
@section('pageTitle', 'LandingEdit')
@section('styles')
    <link rel="stylesheet" href="{{elixir('css/landing-create.css')}}">
@endsection
@section('content')
    <aside class="col-md-2 static-aside">
        <dl>
            <dt><a href="{{route('landing.index')}}">목록</a></dt>
            <dt><a class="active" href="{{route('landing.create')}}">추가</a></dt>
        </dl>
    </aside>
    <section class="col-md-10 static-section">
        <h2>게시글 수정</h2>
        <form class="form-horizontal"
              method="post"
              action="{{route('landing.update',$landing->id)}}"
              accept-charset="UTF-8"
              enctype="multipart/form-data">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            <input type="hidden" id="client_id" name="client_id" value="{{$landing->client_id}}">
            <fieldset>
                <legend>기본정보</legend>
                <hr>
                <div class="form-group">
                    <label for="lan_c_name" class="col-sm-1 control-label">업체명</label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="lan_c_name" name="lan_c_name"
                               placeholder="업체명을 입력해주세요." value="{{$landing->lan_c_name}}" readonly="readonly">
                    </div>
                </div>
                <div class="form-group">
                    <label for="lan_m_name" class="col-sm-1 control-label">제목(관리자)</label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="lan_m_name" name="lan_m_name"
                               placeholder="제목(관리자)을 입력해주세요." value="{{$landing->lan_m_name}}">
                    </div>
                </div>
                <div class="form-group input-daterange">
                    <label for="lan_start_date" class="col-sm-1 control-label">시작일</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="lan_start_date" name="lan_start_date" readonly=""
                               value="{{$landing->lan_start_date}}">
                    </div>
                    <label for="lan_end_date" class="col-sm-1 control-label">종료일</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="lan_end_date" name="lan_end_date" readonly=""
                               value="{{$landing->lan_end_date}}">
                    </div>
                </div>
            </fieldset>
            <hr>
            <fieldset>
                <legend>내용입력</legend>
                <hr>
                <div class="form-group">
                    <label for="lan_title" class="col-sm-1 control-label">제목(유저)</label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="lan_title" name="lan_title"
                               placeholder="유저명을 입력해주세요." value="{{$landing->lan_title}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="lan_kakao_id" class="col-sm-1 control-label">카카오톡ID</label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="lan_kakao_id" name="lan_kakao_id"
                               placeholder="카카오아이디를 입력해주세요." value="{{$landing->lan_kakao_id}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="lan_phone" class="col-sm-1 control-label">전화번호</label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="lan_phone" name="lan_phone"
                               placeholder="전화번호를 입력해주세요." value="{{$landing->lan_phone}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="lan_image" class="col-sm-1 control-label">본문이미지</label>
                    <div class="col-sm-11">
                        <input type="file" class="file-loading" id="lan_image" name="lan_image[]" multiple="multiple">
                    </div>
                </div>
            </fieldset>
            <hr>
            <fieldset>
                <div class="form-group">
                    <label for="lan_page_script" class="col-sm-12 legend-label">페이지 스크립트</label>
                    <div class="col-sm-12">
                        <p>페이지가 열리면 무조건 실행되는 스크립트<br>
                            구글 아날리틱스 코드, 페이스북 전환 픽셀 등의 페이지에 삽입할 스크립트를 넣어주세요.<br>
                            앞, 뒤에 &#60;script&#62;&#44;&nbsp;&#60;&#47;script&#62;라는 문구가 없을 경우 추가해주세요.</p>
                    </div>
                    <div class="col-sm-12">
                        <textarea id="lan_page_script" name="lan_page_script" class="form-control"
                                  rows="20">{{$landing->lan_page_script}}</textarea>
                    </div>
                </div>
            </fieldset>
            <hr>
            <fieldset>
                <div class="form-group">
                    <label for="lan_db_script" class="col-sm-12 legend-label">DB 스크립트</label>
                    <div class="col-sm-12">
                        <p>DB 입력 완료 후 실행되는 스크립트<br>
                            구글 아날리틱스 코드, 페이스북 전환 픽셀 등의 페이지에 삽입할 스크립트를 넣어주세요.<br>
                            앞, 뒤에 &#60;script&#62;&#44;&nbsp;&#60;&#47;script&#62;라는 문구가 없을 경우 추가해주세요.</p>
                    </div>
                    <div class="col-sm-12">
                        <textarea id="lan_db_script" name="lan_db_script" class="form-control"
                                  rows="20">{{$landing->lan_db_script}}</textarea>
                    </div>
                </div>
            </fieldset>
            <hr>
            {{--<fieldset>
                <div class="form-group">
                    <label for="dbInputSkin" class="col-sm-12 legend-label">DB입력창 스킨 설정</label>
                    <div class="col-sm-12">
                        <p>미리보기는 이미지 저장과 아래 항목들까지 작성해야 제대로 볼 수 있습니다.</p>
                    </div>
                    <div class="col-sm-11">
                        <select id="dbInputSkin" class="form-control">
                            <option>기본 스킨</option>
                            <option>스킨1</option>
                            <option>스킨2</option>
                        </select>
                    </div>
                    <div class="col-sm-1">
                        <button type="button" class="btn btn-lc1 form-control">미리보기</button>
                    </div>
                </div>
            </fieldset>--}}
            <fieldset>
                <legend>모바일에서만 실행하기</legend>
                <div class="radio">
                    <label><input type="radio" name="lan_mobile_confirm" checked="checked" value="1"
                        @if($landing->lan_mobile_confirm == 1)
                            {{'checked="checked"'}}
                                @endif>ON</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="lan_mobile_confirm" value="0"
                        @if($landing->lan_mobile_confirm == 0)
                            {{'checked="checked"'}}
                                @endif>OFF</label>
                </div>
            </fieldset>
            <hr>
            <div class="submit-button-group">
                <button type="submit" class="btn btn-lc3">저장</button>
                <button class="btn btn-lc2">취소</button>
            </div>
        </form>

        <form class="form-horizontal">
            <div class="caution-wrap">
                <p>&#8251;아래 항목은 변경시 실시간으로 반영됩니다.</p>
            </div>
            <fieldset>
                <legend>접속URL</legend>
                <p>원하는 URL에서 맨 뒤에 단어만 쓰면 됩니다. 만약 전체 URL이 http://m.medilatete.com/testurl이라면 testurl만 입력하면 됩니다.</p>
                <div class="form-group row">
                    <label for="lan-url" class="col-sm-1 control-label">URL</label>
                    <div class="col-sm-4">
                        <input type="text" id="lan-url" name="lan-url" class="form-control" placeholder="URL">
                    </div>
                    <label for="lan-url" class="col-sm-1 control-label">REF</label>
                    <div class="col-sm-4">
                        <select id="lan-ref" name="lan-ref" class="form-control">
                            <option value="facebook">페이스북</option>
                            <option value="kakao">카카오</option>
                        </select>
                    </div>
                    {{--<div class="col-sm-1">
                        <button type="button" id="url-check-button" class="btn btn-lc1 form-control">중복체크</button>
                    </div>--}}
                    <div class="col-sm-1">
                        <button type="button" id="url-add-button" class="btn btn-lc3 form-control">추가</button>
                    </div>
                </div>
                <div class="row">
                    <div class="url-table-wrap col-sm-offset-1 table-responsive">
                        <table id="url-field-table" class="table">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>미리보기</th>
                                <th>URL</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </fieldset>

            {{--복사할 URL 로우--}}
            <div class="url-table-copy">
                <table class="url-table">
                    <tr>
                        <td class="url-num"></td>
                        <td class="url-review"></td>
                        <td class="url-name"></td>
                        <td class="url-delete"></td>
                    </tr>
                </table>
            </div>
            <hr>
            <fieldset>
                <legend>DB입력 필드 구성</legend>
                <p>최대 20개 까지만 등록 가능합니다. 등록 후 삭제가 불가능하며, 비활성화만 가능합니다.<br>
                    비활성화된 항목은 유저 페이지에 노출되지 않습니다.</p>
                <div class="form-group">
                    <div class="form-type-wrap">
                        <label for="lan-db-types" class="col-sm-2 control-label">데이터타입</label>
                        <div class="col-sm-10">
                            <select id="lan-db-types" class="form-control">
                                <option value="1">DB입력창</option>
                                <option value="2">전화번호</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-input-wrap">
                        <label for="lan-db-title" class="col-sm-2 control-label">필드명</label>
                        <div class="col-sm-10">
                            <input type="text" id="lan-db-title" name="lan-db-title" class="form-control">
                        </div>
                    </div>
                    <div class="phone-input-wrap">
                        <label for="lan-db-phone" class="col-sm-2 control-label">전화번호</label>
                        <div class="col-sm-10">
                            <input type="text" id="lan-db-phone" name="lan-db-title" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12 text-right">
                        <button type="button" id="db-add-button" class="btn btn-lc3">추가</button>
                    </div>
                </div>
                <div class="db-table-wrap col-sm-offset-1">
                    <table id="db-field-table" class="table">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th class="db-name-title"></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </fieldset>
            {{--복사할 DB 로우--}}
            <div class="db-table-copy">
                <table class="db-table">
                    <tr>
                        <td class="db-num"></td>
                        <td class="db-name"></td>
                        <td class="db-delete"></td>
                    </tr>
                </table>
            </div>
            <hr>
            <fieldset>
                <legend>약관</legend>
                <p>최대 20개 까지만 등록 가능합니다. 등록 후 삭제가 불가능하며, 비활성화만 가능합니다.<br>
                    비활성화된 항목은 유저 페이지에 노출되지 않습니다.</p>
                <div class="form-group">
                    <label for="lan_terms_name" class=" col-sm-1 control-label">약관명</label>
                    <div class="col-sm-10">
                        <input type="text" id="lan_terms_name" class="form-control">
                    </div>
                    <div class="col-sm-1">
                        <button type="button" id="clause-add-button" class="btn btn-lc3">추가</button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lan_terms_content" class=" col-sm-1 control-label">내용</label>
                    <div class="col-sm-10">
                        <textarea type="text" id="lan_terms_content" class="form-control"></textarea>
                    </div>
                </div>
                <div class="clause-table-wrap col-sm-offset-1">
                    <table id="clause-field-table" class="table">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>약관명</th>
                            <th>내용</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </fieldset>

            {{--복사할 DB 로우--}}
            <div class="clause-table-copy">
                <table class="clause-table">
                    <tr>
                        <td class="clause-num"></td>
                        <td class="clause-title"></td>
                        <td class="clause-content"></td>
                        <td class="clause-manage">
                            <a type="button" class="btn btn-default">수정</a>
                            <a type="button" class="btn btn-default delete-button">삭제</a>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
        </form>
    </section>
    <div class="modal fade" id="c-name-modal" tabindex="-1" role="dialog" aria-labelledby="c-name-modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="c-name-modal">업체명 선택</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <div class="col-sm-2">
                                <select class="form-control" id="client-column-select">
                                    <option value="c_name">업체명</option>
                                    <option value="m_name">관리자 이름</option>
                                    <option value="phone">관리자 번호</option>
                                    <option value="m_email">관리자 이메일</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="client-value-text">
                            </div>
                            <div class="col-sm-2">
                                <button type="button" id="client-search-button" class="btn btn-default">검색</button>
                            </div>
                        </div>
                    </form>
                    <div id="client-list-table-wrap">
                        @include('layouts.landing.partial.client_list')
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{elixir('js/landing-create.js')}}"></script>
    <script>
        (function ($) {
            var currentVal = $("#lan-db-types").val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            });

            url_index_ajax();

            db_index_ajax();

            clause_index_ajax();

            db_input_trigger();

            $('.input-daterange').datepicker({
                todayBtn: "linked",
                language: "ko",
                startDate: "today",
                format: 'yyyy-mm-dd',
                autoclose: true
            });

            $("#lan_image").fileinput({
                browseClass: "btn btn-default",
                uploadUrl: "{{route('image.store')}}",
                uploadAsync: true,
                maxFileCount: 3,
                overwriteInitial: false,
                uploadExtraData: {
                    lan_id:{{$landing->id}}
                },
                initialPreview: [
                    @foreach($landing->images as $image)
                            "{{asset('uploads/images/'.$image->image_name)}}",
                    @endforeach
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                        @foreach($landing->images as $image)
                    {
                        caption: "{{$image->image_name}}",
                        size: 827000,
                        width: "120px",
                        url: "{{route('image.destroy',$image->id)}}",
                        key:{{$image->id}},
                        extra: {
                            image_id:{{$image->id}},
                            image_name: "{{$image->image_name}}"
                        }
                    },
                    @endforeach
                ]
            });

            /*$("#url-check-button").click(function (e) {
             e.preventDefault();
             url_check_ajax();
             });*/

            $("#url-add-button").click(function (e) {
                e.preventDefault();
                url_reg_ajax();
            });

            $("#lan-db-types").change(function () {
                var newVal = $(this).val();

                if ($('#db-field-table').find('.db-name').text() !== '') {
                    alert('필드를 먼저 전부 삭제해주세요.');
                    $(this).val(currentVal);
                    return;
                }
                currentVal = newVal;
                db_input_trigger();
            })

            $("#db-add-button").click(function () {
                db_reg_ajax();
            });

            $('#db-field-table').on('click', '.delete-button', function () {
                var id = $(this).attr('data-id');
                db_del_ajax(id)
            });

            $('#clause-add-button').click(function () {
                clause_reg_ajax();
            });

            $('#clause-field-table').on('click', '.delete-button', function () {
                var id = $(this).attr('data-id');
                clause_del_ajax(id)
            });

            $('#lan_c_name').click(function () {
                $("#c-name-modal").modal();
            });

            $('#client-search-button').click(function () {
                client_list_ajax();
                client_select();
            });

            $('#c-name-modal').on('shown.bs.modal', function () {
                client_ajax_click_event();
                client_select();
            });

            function client_ajax_click_event() {
                $('#client-list-pagination a').click(function (e) {
                    e.preventDefault();
                    var page = $(this).attr('href').split('page=')[1];
                    page === undefined ? page = 1 : page;
                    client_list_ajax(page);
                    client_select();
                });
            }

            function client_select() {
                $('#client-list-table tbody tr').click(function () {
                    var client_c_name = $(this).find('.client-c-name').text();
                    var client_num = $(this).find('.client-num').text();
                    $("#lan_c_name").val(client_c_name);
                    $("#user_id").val(client_num);
                    $('#c-name-modal').modal('hide')
                });
            }

            function client_list_ajax(page) {
                var formData = {
                    client_column_select: $('#client-column-select').val(),
                    client_value_text: $('#client-value-text').val()
                };

                $.ajax({
                    url: '{{route('landing.create')}}?page=' + page,
                    data: formData,
                    dataType: 'json'
                }).done(function (data) {
                    $('#client-list-table-wrap').html(data);
                    client_ajax_click_event();
                })
            }

            function url_index_ajax() {
                $(".url-table-copy").css({
                    "display": "none"
                });

                var formData = {
                    lan_id:{{$landing->id}}
                };

                $.ajax({
                    type: 'get',
                    url: '{{route('landingUrlField.index')}}',
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        $('#url-field-table tbody').html('');
                        $.each(data, function (key, value) {
                            var url = 'landingUrlField\/' + value.lan_url;
                            $('.url-table-copy tr .url-num').text(key + 1);
                            $('.url-table-copy tr .url-review').html('<a data-url-name="' + value.lan_url + '" class="open-landing">landing/' + value.lan_url + '</a>');
                            $('.url-table-copy tr .url-name').text('{{route('landingUrlField.index')}}' + '/' + value.lan_url);
                            $('.url-table-copy tr .url-delete').html('<a class="btn btn-default">삭제</a>');

                            var getForm = $('.url-table-copy .url-table tr');
                            var copyForm = getForm.clone(true);
                            $('#url-field-table tbody').append(copyForm)
                        });
                        open_landing();
                    },
                    error: function (data) {
                        console.log(data)
                    }
                });
            }

            function open_landing() {
                $(".url-review .open-landing").click(function (e) {
                    e.preventDefault();
                    var url = $(this).attr('data-url-name');
                    window.open("/landingUrlField/" + url, "", "width = 450, height = 650, top = 0, left = 0, menubar=no, status=no, toolbar=no")
                })
            }

            function url_reg_ajax() {
                var formData = {
                    lan_url: $('[name="lan-url"]').val(),
                    lan_ref: $('[name="lan-ref"]').val(),
                    lan_id:{{$landing->id}}
                };

                $.ajax({
                    type: 'post',
                    url: '{{route('landingUrlField.store')}}',
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        url_index_ajax();
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }

            function db_input_trigger() {
                $("#lan-db-types").each(function () {
                    $('[name="lan-db-title"]').val("");
                    if ($(this).val() === '1') {
                        $(".form-input-wrap").css({
                            'display': 'block'
                        });
                        $(".phone-input-wrap").css({
                            'display': 'none'
                        });
                        $(".db-name-title").text('DB필드명');
                    } else {
                        $(".form-input-wrap").css({
                            'display': 'none'
                        });
                        $(".phone-input-wrap").css({
                            'display': 'block'
                        });
                        $(".db-name-title").text('전화번호');
                    }
                });
            }

            function db_index_ajax() {
                $(".db-table-copy").css({
                    "display": "none"
                });

                var formData = {
                    lan_id:{{$landing->id}}
                };

                $.ajax({
                    type: 'get',
                    url: '{{route('landingDbField.index')}}',
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        if (data.length != 0) {
                            if (data[0].lan_db_types === 'phone') {
                                $('#lan-db-types').val(2)
                            } else {
                                $('#lan-db-types').val(1)
                            }
                            $('#db-field-table tbody').html('');
                            $.each(data, function (key, value) {
                                var url = 'landingUrlField\/' + value.lan_url;
                                $('.db-table-copy tr .db-num').text(key + 1);
                                $('.db-table-copy tr .db-name').text(value.lan_db_title);
                                $('.db-table-copy tr .db-delete').html('<a class="btn btn-default delete-button" data-id="' + value.id + '">삭제</a>');

                                var getForm = $('.db-table-copy .db-table tr');
                                var copyForm = getForm.clone(true);
                                $('#db-field-table tbody').append(copyForm)
                            });
                        }
                    },
                    error: function (data) {
                        console.log(data)
                    }
                });
            }

            function db_reg_ajax() {
                var field_name;
                if ($('#lan-db-types option:selected').val() === '1') {
                    field_name = $('#lan-db-title').val();
                } else {
                    if ($('#db-field-table').find('.db-name').length > 0) {
                        alert('전화번호는 한번만 입력할 수 있습니다.');
                        return;
                    }
                    field_name = $('#lan-db-phone').val();
                }

                var formData = {
                    lan_db_title: field_name,
                    lan_db_types: Number($('#lan-db-types option:selected').val()),
                    lan_id:{{$landing->id}}
                };

                $.ajax({
                    type: 'post',
                    url: '{{route('landingDbField.store')}}',
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        $('[name="lan-db-title"]').val('');
                        db_index_ajax();
                    },
                    error: function (data) {
                        console.log();
                    }
                });
            }

            function db_del_ajax(id) {
                var formData = {
                    id: id
                };

                $.ajax({
                    type: 'DELETE',
                    url: '{{route('landingDbField.destroy')}}',
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        db_index_ajax();
                    },
                    error: function (data) {
                        console.log(data)
                    }
                });
            }

            function clause_index_ajax() {
                $(".clause-table-copy").css({
                    "display": "none"
                });

                $.ajax({
                    type: 'get',
                    url: '{{route('landingClauseField.index',$landing->id)}}',
                    dataType: 'json',
                    success: function (data) {
                        $('#clause-field-table tbody').html('');
                        $.each(data, function (key, value) {
                            $('.clause-table-copy tr .clause-num').text(key + 1);
                            $('.clause-table-copy tr .clause-title').text(value.lan_terms_name);
                            $('.clause-table-copy tr .clause-content').text(value.lan_terms_content);
                            $('.clause-table-copy tr .clause-manage').find('.delete-button').attr('data-id', value.id);

                            var getForm = $('.clause-table-copy .clause-table tr');
                            var copyForm = getForm.clone(true);
                            $('#clause-field-table tbody').append(copyForm)
                        });
                    },
                    error: function (data) {
                        console.log(data)
                    }
                });
            }

            function clause_reg_ajax() {
                var formData = {
                    lan_terms_name: $('#lan_terms_name').val(),
                    lan_terms_content: $('#lan_terms_content').val(),
                    lan_id:{{$landing->id}}
                };

                $.ajax({
                    type: 'post',
                    url: '{{route('landingClauseField.store')}}',
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        $('#lan_terms_name').val('');
                        $('#lan_terms_content').val('');
                        clause_index_ajax();
                    },
                    error: function (data) {
                        console.log(data)
                    }
                });
            }

            function clause_del_ajax(id) {
                var formData = {
                    id: id
                };

                $.ajax({
                    type: 'DELETE',
                    url: '{{route('landingClauseField.destroy')}}',
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        clause_index_ajax();
                    },
                    error: function (data) {
                        console.log(data)
                    }
                });
            }
        })(jQuery);
    </script>
@endsection
{{--
<div>
    <h1>랜딩 페이지 등록</h1>
</div>
{!! Form::open(['route'=>'landing.store','method'=>'POST','files'=>'true']) !!}
{!! Form::label('image','Select Image') !!}
{!! Form::file('image[]',$attributes =['id'=>'iamge','multiple'=>'multiple']) !!}
{!! Form::label('title','제목')!!}
{!! Form::text('title')!!}
<button type="submit">등록</button>
{!! Form::close() !!}--}}
