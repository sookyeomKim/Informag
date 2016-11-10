@extends('layouts.marster')
@section('styles')
    <link rel="stylesheet" href="{{elixir('css/landing-create.css')}}">
@endsection
@section('content')
    <aside class="col-md-2 static-aside">
        <dl>
            <dt><a href="{{route('landing.index')}}" class="btn btn-default">목록</a></dt>
        </dl>
    </aside>
    <section class="col-md-10 static-section">
        <h1>게시글 수정</h1>
        <hr>
        <form class="form-horizontal" method="POST" action="{{route('landing.store')}}" accept-charset="UTF-8"
              enctype="multipart/form-data">
            {{ csrf_field() }}

            <fieldset>
                <legend>기본정보</legend>
                <hr>
                <div class="form-group">
                    <label for="lan_c_name" class="col-sm-1 control-label">업체명</label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="lan_c_name" name="lan_c_name"
                               placeholder="업체명을 선택해주세요." readonly="readonly">
                    </div>
                </div>
                <div class="form-group">
                    <label for="lan_m_name" class="col-sm-1 control-label">제목(관리자)</label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="lan_m_name" name="lan_m_name"
                               placeholder="제목(관리자)을 입력해주세요.">
                    </div>
                </div>
                <div class="form-group input-daterange">
                    <label for="lan_start_date" class="col-sm-1 control-label">시작일</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="lan_start_date" name="lan_start_date" readonly="">
                    </div>
                    <label for="lan_end_date" class="col-sm-1 control-label">종료일</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="lan_end_date" name="lan_end_date" readonly="">
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
                               placeholder="유저명을 입력해주세요.">
                    </div>
                </div>
                <div class="form-group">
                    <label for="lan_kakao_id" class="col-sm-1 control-label">카카오톡ID</label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="lan_kakao_id" name="lan_kakao_id"
                               placeholder="카카오아이디를 입력해주세요.">
                    </div>
                </div>
                <div class="form-group">
                    <label for="lan_phone" class="col-sm-1 control-label">전화번호</label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="lan_phone" name="lan_phone"
                               placeholder="전화번호를 입력해주세요.">
                    </div>
                </div>
                <div class="form-group">
                    <label for="lan_image" class="col-sm-1 control-label">본문이미지</label>
                    <div class="col-sm-11">
                        <input type="file" class="file" id="lan_image" name="lan_image[]" multiple="multiple">
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
                        <textarea id="lan_page_script" name="lan_page_script" class="form-control"></textarea>
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
                        <textarea id="lan_db_script" name="lan_db_script" class="form-control"></textarea>
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
                <input type="radio" name="lan_mobile_confirm" checked="checked" value="1">
                <input type="radio" name="lan_mobile_confirm" value="0">
            </fieldset>
            <hr>
            <div class="submit-button-group">
                <button type="submit" class="btn btn-lc3">저장</button>
                <button class="btn btn-lc2">취소</button>
            </div>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script src="{{elixir('js/landing-create.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });

        $('.input-daterange').datepicker({
            todayBtn: "linked",
            language: "ko",
            startDate: "today",
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        $('#lan_image').fileinput({
            browseClass: "btn btn-default",
            showUpload: false,
            maxFileCount: 3
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
                var c_name_txt = $(this).find('.client-c-name').text();
                $("#lan_c_name").val(c_name_txt);
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
