@yield('css')

<!-- Bootstrap Css -->
<link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ URL::asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ URL::asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<style>
    .msg-show{
        position: absolute;
        z-index: 999;
        opacity: 1;
        top: 78px;
        height: 45px;
        right: 185px;
    }
    </style>
@stack('styles')
