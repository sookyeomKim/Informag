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
        /*                       common                      */
        /*modal*/
        .navbar-brand {
            padding: 0px;
            padding-left: 15px;
            height: 0;
        }

        .modal-title {
            font-weight: bold;
        }

        .modal-content {
            padding: 30px;
        }

        .modal-content .form-group {
            margin-top: 15px;
        }

        .modal-body label {
            margin: 5px 0;
        }

        .input-sm {
            width: 80%;
            float: right;
        }

        /*font-color*/
        .font-orange {
            color: #ff5a00;
            font-weight: bold;
        }

        /*테마*/
        .btn-lc1 {
            color: #fff;
            background-color: #666666;
            border-color: #666666;
        }

        .btn-lc2 {
            color: #fff;
            background-color: #999;
            border-color: #999;
        }

        .btn-lc3 {
            color: #fff;
            background-color: #ff5a00;
            border-color: #ff5a00;
        }

        .btn-lc4 {
            color: #fff;
            background-color: #000;
            border-color: #000;
        }

        /*덮어쓰기*/
        a:hover {
            cursor: pointer;
        }

        .center-block {
            text-align: center;
        }

        legend {
            border: none;
            margin-bottom: 0;
        }

        hr {
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .form-horizontal {
            margin-bottom: 40px;
        }

        .btn:hover, .btn:focus, .btn.focus {
            color: #fff;
        }

        .badge {
            padding: 10px 20px;
            margin-bottom: 5px;
        }

        /*헤더*/
        .navbar {
            margin: 0;
            box-shadow: 0px 0px 1px 1px rgba(0, 0, 0, 0.14),
            0px 0px 2px 2px rgba(0, 0, 0, 0.098),
            0px 0px 5px 1px rgba(0, 0, 0, 0.084);
            z-index: 10;
        }

        .navbar-nav {
            margin-top: 9px;
            margin-left: 15px;
        }

        .navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus {
            background-color: #666666;
            color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .26);
        }

        .nav > li > a {
            padding: 6px 10px;
            margin: 10px;
            font-size: 18px;
        }

        .navbar-default {
            background-color: #fff;
        }

        .nav-top {
            text-align: right;
            padding: 10px 20px 10px 10px;
            background-color: #666;
            color: #ffffff;
        }

        .nav-top a {
            color: #ffffff;
            padding: 10px;
        }

        .navbar-header {
            padding: 12px;
        }

        /*어사이드*/
        .static-aside {
            background-color: #dddddd;
            height: 100%;
            padding: 20px;
        }

        .static-aside dt {
            margin: 10px 0;
        }

        .static-aside a {
            color: #666;
            font-size: 18px;
            padding: 10px 20px;
            display: block;
        }

        .static-aside a.active {
            color: #fff;
            background-color: #666;
            border-radius: 10px;
            padding: 10px 20px;
            box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .26);
            display: block;
        }

        .static-aside a:hover {
            box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .26);
            border-radius: 10px;
            text-decoration: none;
        }

        /*섹션*/

        .static-section {
            box-shadow: 0px 1px 6px rgba(0, 0, 0, 0.14),
            0px 2px 9px rgba(0, 0, 0, 0.098),
            0px 5px 6px rgba(0, 0, 0, 0.084);
            padding: 20px;
        }

        .static-section h1 {
            margin-bottom: 40px;
        }

        .static-section label {
            color: #999999;
        }

        .static-section h1, .static-section legend, .static-section .legend-label {
            font-weight: bold;
        }

        .static-section legend, .static-section .legend-label {
            color: #666;
            font-size: 21px;
        }

        .static-section .submit-button-group {
            text-align: right;
        }

        .static-section .submit-button-group button {
            width: 100px;
            font-weight: bold;
        }

        .static-section .caution-wrap {
            color: #ff5a00
        }

        .static-section .url-table-wrap table tr td:nth-child(2), .static-section .url-table-wrap table tr th:nth-child(2) {
            width: 100%;
        }

        .static-section .clause-table-wrap table tr td:nth-child(3), .static-section .clause-table-wrap table tr th:nth-child(3) {
            width: 60%;
        }

        .static-section .clause-wrap div {
            padding: 5px 0;
        }

        .table-responsive th, td {
            text-align: center;
        }

        /*page*/
        h2 {
            font-size: 25px;
            font-weight: bold;
            margin-top: 30px;
        }

        h3 {
            font-size: 18px;
            margin-top: 29px;
        }

        /*                    main                  */
        /*Login*/
        #Login-container {
            padding: 10px;
            margin: 15% 20px;
            border-top: 2px solid #808080;
            border-bottom: 2px solid #808080;
        }

        #Login-box {
            width: 21%;
            height: 40%;
            margin: 0 auto;
            padding: 15px;
        }

        #Login-box h1 {
            margin-top: -3px;
        }

        #Login-box span {
            font-weight: 900;
            font-size: 16px;
        }

        #Login-box .form-group {
            margin: 5px 7px;
            display: block;
        }

        .login-id {
            display: inline-block;
            margin-left: 16px;
        }

        #Login-box button {
            width: 75px;
            height: 75px;
            color: #cc6600;
            font-size: 15px;
            background-color: black;
            text-align: center;
            border-radius: 5px;
            position: relative;
            top: -80px;
            left: 279px;
        }

        .test p {
            float: left;
        }

        .test span {
            float: right;
        }

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

        .login-inner-wrap .first-row{
            margin-right: -8px;
            margin-left: -8px;
        }

        .login-inner-wrap .second-row{
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


