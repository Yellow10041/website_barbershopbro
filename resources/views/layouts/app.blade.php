<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&family=Lora:wght@400;500;600&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <script src="https://kit.fontawesome.com/1b6186f7ee.js" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>


@if(Request::route()->getName() === 'about')
    <body class="body-black">
@elseif (Request::route()->getName() === 'login' || Request::route()->getName() === 'register')
    <body class="body-auth">
@else
    <body>
@endif



@if(Request::route()->getName() === 'departments' || Request::route()->getName() === 'feedback')
    <div class="container-footer_fix">
        @include('inc.header')

        @yield('section')
    </div>
@else
    @include('inc.header')

    @yield('section')
@endif







<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="/js/script.js"></script>
@yield('custom-js')
@yield('header-custom-js')



</body>

</html>
