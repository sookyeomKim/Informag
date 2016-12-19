@extends('layouts.master')
@section('pageTitle', 'ClientList')
@section('content')
    <aside class="col-md-2 static-aside">
        <dl>
            <dt><a class="active">업체 목록</a></dt>
        </dl>
    </aside>
    <section class="col-md-10 static-section">
        <h2>업체 리스트</h2>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>등록일</th>
                    <th>변경일</th>
                    <th>업체명</th>
                    <th>관리자명</th>
                    <th>관리자연락처</th>
                    <th>업체아이디</th>
                    <th>상태</th>
                    <th>관리</th>
                </tr>
                </thead>
                <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td>{{$client->created_at}}</td>
                        <td>{{$client->updated_at}}</td>
                        <td>{{$client->c_name}}</td>
                        <td>{{$client->m_name}}</td>
                        <td>{{$client->phone}}</td>
                        <td>{{$client->c_id}}</td>
                        <td>{{$client->status}}</td>
                        <td>
                            <div class="btn-group">
                                <a href="javascript:void(0)" class="btn">ON</a>
                                <a href="javascript:void(0)" class="btn">OFF</a>
                            </div>
                        </td>
                        <td>
                            <button type="button" class="btn btn-default client-modi-button"
                                    data-client-id="{{$client->id}}">정보 수정
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center">
            {{$clients->links()}}
        </div>
        <button class="btn btn-lc3" data-toggle="modal" data-target="#clientRegModal">신규업체등록</button>
    </section>

    <div class="modal fade" id="clientRegModal" tabindex="-1" role="dialog" aria-labelledby="clientRegModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="clientRegForm" class="form-horizontal" role="form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">고객등록 창</h4>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <input type="hidden" id="client-id">
                        <div class="form-group">
                            <label for="c_name" class="col-md-4 control-label">업체명</label>

                            <div class="col-md-6">
                                <input id="c_name" type="text" class="form-control" name="c_name" required autofocus>
                                <div class="error-text"></div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="m_name" class="col-md-4 control-label">관리자명</label>

                            <div class="col-md-6">
                                <input id="m_name" type="text" class="form-control" name="m_name" required>
                                <div class="error-text"></div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="m_email" class="col-md-4 control-label">관리자 이메일</label>

                            <div class="col-md-6">
                                <input id="m_email" type="text" class="form-control" name="m_email" required>
                                <div class="error-text"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="c_id" class="col-md-4 control-label">업체ID</label>

                            <div class="col-md-6">
                                <input id="c_id" type="text" class="form-control" name="c_id" required>
                                <div class="error-text"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="col-md-4 control-label">관리자 연락처</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone">
                                <div class="error-text"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">비밀번호</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                                <div class="error-text"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="col-md-4 control-label">비밀번호 확인</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control"
                                       name="password_confirmation" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="clientRegSubmit" class="btn btn-primary">등록</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            });

            $('#clientRegModal').on('shown.bs.modal', function () {
                $('#c_name').focus()
            }).on('hide.bs.modal', function () {
                $('#client-id').val('');
                $('#c_name').val('');
                $('#m_name').val('');
                $('#m_email').val('');
                $('#c_id').val('');
                $('#phone').val('');
                $('#password').val('');
                $('#password_confirmation').val('');
            });

            $('#clientRegSubmit').click(function (e) {
                e.preventDefault();
                if ($('#client-id').val() !== '') {
                    client_update_ajax();
                } else {
                    client_reg_ajax();
                }
            });

            $('.client-modi-button').click(function () {
                var client_id = $(this).attr('data-client-id');
                $('#clientRegModal').modal();
                client_show_ajax(client_id);
            });

            //TODO - list를 ajax로 바꿀 것
            function client_list_ajax() {
                $.ajax({
                    type: 'POST',
                    url: '{{route('client.register')}}',
                    data: formData,
                    dataType: 'json',
                    success: function (data) {

                        window.location.href = "/client";
                    },
                    error: function (data) {
                        if (data.status === 422) {
                            $.each(JSON.parse(data.responseText), function (key, value) {
                                $("#" + key).parents('.form-group').addClass('has-error').find('.error-text').text(value).css({
                                    'color': 'red'
                                });
                            })
                        }
                    }
                });
            }

            function client_reg_ajax() {
                var formData = {
                    c_name: $('#c_name').val(),
                    m_name: $('#m_name').val(),
                    m_email: $('#m_email').val(),
                    c_id: $('#c_id').val(),
                    phone: $('#phone').val(),
                    password: $('#password').val(),
                    password_confirmation: $('#password_confirmation').val()
                };

                $.ajax({
                    type: 'POST',
                    url: '{{route('client.register')}}',
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        window.location.href = "/client";
                    },
                    error: function (data) {
                        if (data.status === 422) {
                            $.each(JSON.parse(data.responseText), function (key, value) {
                                $("#" + key).parents('.form-group').addClass('has-error').find('.error-text').text(value).css({
                                    'color': 'red'
                                });
                            })
                        }
                    }
                });
            }

            function client_show_ajax(client_id) {
                $.ajax({
                    type: 'get',
                    url: '{{url('client')}}/' + client_id,
                    dataType: 'json',
                    success: function (data) {
                        $('#client-id').val(data.id);
                        $('#c_name').val(data.c_name);
                        $('#m_name').val(data.m_name);
                        $('#m_email').val(data.m_email);
                        $('#c_id').val(data.c_id);
                        $('#phone').val(data.phone);
                    },
                    error: function (data) {
                        alert("정보를 불러오지 못 하였습니다.");
                    }
                });
            }

            function client_update_ajax() {
                var formData = {
                    c_name: $('#c_name').val(),
                    m_name: $('#m_name').val(),
                    m_email: $('#m_email').val(),
                    c_id: $('#c_id').val(),
                    phone: $('#phone').val(),
                    password: $('#password').val(),
                    password_confirmation: $('#password_confirmation').val()
                };

                $.ajax({
                    type: 'PUT',
                    url: '{{url('client')}}/' + $('#client-id').val(),
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        window.location.href = "/client";
                    },
                    error: function (data) {
                        if (data.status === 422) {
                            $.each(JSON.parse(data.responseText), function (key, value) {
                                $("#" + key).parents('.form-group').addClass('has-error').find('.error-text').text(value).css({
                                    'color': 'red'
                                });
                            })
                        }
                    }
                });
            }
        });
    </script>
@endsection


