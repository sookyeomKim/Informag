<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>올가베베 물티슈</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{elixir('css/main.css')}}">
    <style>
        .image-wrap {
            position: relative;
        }

        .image-wrap img {
            width: 100%;
        }

        .image-wrap .button {
            position: absolute;
            bottom: 14%;
            left: 50%;
            transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -o-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
        }
    </style>

</head>
<body>

<section class="image-wrap">
    <img src="{{asset('images/otherLanding/olgabebe.jpg')}}" alt="랜딩이미지 올가베베물티슈" class="img-responsive">
    <a href="https://play.google.com/store/apps/details?id=com.jny.babymarketapp2" class="button">
        <img src="{{asset('images/otherLanding/olgabebe-button.png')}}" alt="특가공구 버튼">
    </a>
</section>
</body>
</html>
