@extends('layouts.marster')
@section('content')
    <div class="col-sm-offset-4 col-sm-4">
        <form id="clientRegForm" class="form-horizontal" role="form">
            {{ csrf_field() }}
            <input type="hidden" id="user_id" value="{{\Auth::user()->id}}">
            <div class="form-group">
                <label for="c_name" class="col-md-4 control-label">업체명</label>

                <div class="col-md-6">
                    <input id="c_name" type="text" class="form-control" name="c_name" value="{{\Auth::user()->c_name}}"
                           required autofocus>
                    <div class="error-text"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="m_name" class="col-md-4 control-label">관리자명</label>

                <div class="col-md-6">
                    <input id="m_name" type="text" class="form-control" name="m_name" value="{{\Auth::user()->m_name}}"
                           required>
                    <div class="error-text"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="m_email" class="col-md-4 control-label">관리자 이메일</label>

                <div class="col-md-6">
                    <input id="m_email" type="text" class="form-control" name="m_email"
                           value="{{\Auth::user()->m_email}}" required>
                    <div class="error-text"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="c_id" class="col-md-4 control-label">업체ID</label>

                <div class="col-md-6">
                    <input id="c_id" type="text" class="form-control" name="c_id" value="{{\Auth::user()->c_id}}"
                           required>
                    <div class="error-text"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="phone" class="col-md-4 control-label">관리자 번호</label>

                <div class="col-md-6">
                    <input id="phone" type="text" class="form-control" name="phone" value="{{\Auth::user()->phone}}">
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
            <div class="text-center">
                <button type="button" id="client-reg-submit" class="btn btn-primary">등록</button>
            </div>
        </form>
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

            $('#client-reg-submit').click(function (e) {
                e.preventDefault();
                client_reg_ajax();
            });

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
                    type: 'PUT',
                    url: '{{route('client.update',\Auth::user()->id)}}',
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        alert('변경되었습니다.')
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