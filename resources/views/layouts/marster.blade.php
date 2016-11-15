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
        /*커스터마이징*/

        /*modal*/
        .modal-title{
            font-weight: bold;
        }

        .modal-content{
            padding:30px;
        }

        .modal-content .form-group{
            margin-top:15px;
        }

        .modal-body label{
            margin: 5px 0;
        }
        .input-sm{
            width: 80%;
            float: right;
        }


        /*font-color*/
        .font-orange{
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
            text-align : center;
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

        .badge{
            padding:10px 20px;
            margin-bottom: 5px;
            float:right;
        }

        /*헤더*/
        .navbar {
            margin: 0;
            box-shadow: 0px 0px 1px 1px rgba(0, 0, 0, 0.14),
            0px 0px 2px 2px rgba(0, 0, 0, 0.098),
            0px 0px 5px 1px rgba(0, 0, 0, 0.084);
            z-index: 10;
        }

        .navbar-nav{
            margin-top:  9px;
            margin-left:15px;
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

        .navbar-header{
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
        .static-section .clause-wrap div{
            padding: 5px 0;
        }

        .table-responsive th, td{
            text-align: center;
        }

        /*page*/
        h2{
            font-size: 25px;
            font-weight: bold;
            margin-top: 30px;
        }

        h3{
            font-size: 18px;
            margin-top: 29px;
        }

    </style>
@yield('styles')
<!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="app">
    <header>
        <div class="nav-top">권용무님, 반갑습니다. <a>로그아웃</a></div>
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{asset('images/Infomac-logo.jpg')}}" alt="인포맥">
                    </a>
                </div>

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">                    &nbsp;
                        @if(!Auth::guest())
                            <li><a class="" href="{{route('landing.index')}}">랜딩페이지 관리</a>
                            </li>
                            @if(Auth::user()->hasRole(['Administrator']))
                                <li><a class="" href="{{route('client.index')}}">고객 관리</a></li>
                            @endif
                            {{--<li><a href="../../manageAdmin/manageAdmin.html">Admin 관리</a></li>
                            <li><a href="../dbListpage/dbListPage.html">DB List</a></li>--}}
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">로그인</a></li>
                            {{--<li><a href="{{ url('/register') }}">회원가입</a></li>--}}
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false">
                                    {{ Auth::user()->c_name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container-fluid">
        <div class="row">
            <aside class="col-md-2 static-aside">
                <dl>
                    <dt><a class="active">목록</a></dt>
                    <dt><a href="../addLandingpage/addLandingpage.html">추가</a></dt>
                </dl>
            </aside>
        </div>
        <section class="col-md-10 static-section">
            @yield('content')
        </section>
    </main>
</div>
<!-- Scripts -->
<script src="{{elixir('js/main.js')}}"></script>
@yield('scripts')
</body>
</html>
