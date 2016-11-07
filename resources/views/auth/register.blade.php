@extends('layouts.marster')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">업체 등록</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('c_name') ? ' has-error' : '' }}">
                            <label for="c_name" class="col-md-4 control-label">업체명</label>

                            <div class="col-md-6">
                                <input id="c_name" type="text" class="form-control" name="c_name" value="{{ old('c_name') }}" required autofocus>

                                @if ($errors->has('c_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('c_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('m_name') ? ' has-error' : '' }}">
                            <label for="m_name" class="col-md-4 control-label">관리자명</label>

                            <div class="col-md-6">
                                <input id="m_name" type="text" class="form-control" name="m_name" value="{{ old('m_name') }}" required>

                                @if ($errors->has('m_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('m_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('c_id') ? ' has-error' : '' }}">
                            <label for="c_id" class="col-md-4 control-label">업체ID</label>

                            <div class="col-md-6">
                                <input id="c_id" type="text" class="form-control" name="c_id" value="{{ old('c_id') }}" required>

                                @if ($errors->has('c_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('c_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">관리자 번호</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" >

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">비밀번호</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">비밀번호 확인</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
