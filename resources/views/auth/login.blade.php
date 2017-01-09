<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{elixir('css/main.css')}}">
    <style>

        .login-wrap {
            margin: 300px 0;
            border-top: 2px solid #000;
            border-bottom: 2px solid #000;
        }

        .login-inner-wrap {
            width: 361px;
            margin: 0 auto;
        }

        .login-inner-wrap h1 img {
            padding: 10px;
        }

        .login-inner-wrap .col-sm-9, .login-inner-wrap .col-sm-3 {
            padding-right: 10px;
            padding-left: 10px;
        }

        .login-inner-wrap .first-row {
            margin-right: -8px;
            margin-left: -8px;
        }

        .login-inner-wrap .second-row {
            padding: 10px;
            margin: 0 auto;
        }

        .login-inner-wrap .control-label {
            padding-right: 0px;
        }

        .login-submit-button {
            padding: 30px 20px;
            color: #ff5a00;
            background-color: #000;
        }
    </style>
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div class="login-wrap">
    <div class="login-inner-wrap">
        <h1><img src="{{asset('images/Login-logo.jpg')}}" alt="로그인 로고"></h1>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            <div class="row first-row">
                <div class="col-sm-9">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('c_id') ? ' has-error' : '' }}">
                        <label for="c_id" class="col-sm-3 control-label">아이디</label>
                        <div class="col-sm-9">
                            <input id="c_id" type="text" class="form-control" name="c_id" value="{{ old('c_id') }}"
                                   required
                                   autofocus>
                            @if ($errors->has('c_id'))
                                <span class="help-block">
                    <strong>{{ $errors->first('c_id') }}</strong>
                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-sm-3 control-label">패스워드</label>
                        <div class="col-sm-9">
                            <input id="password" type="password" class="form-control" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-default login-submit-button">LOGIN</button>
                </div>
            </div>
            <div class="row text-center">
                <a href="{{url('password/reset')}}">비밀번호 변경하기</a>
            </div>
            <div class="row second-row">
                <img src="images/warning-msg.jpg">
            </div>
        </form>
    </div>
</div>
<!-- Scripts -->
<script src="{{elixir('js/main.js')}}"></script>
</body>
</html>


