<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') | {{ Session::has('sitename') ? Session::get('sitename') : 'Forex Trade' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}">
    @include('layouts.head-css')
</head>

@section('body')
    @if (Auth::user()->role_id == config('constant.CLIENT_ROLE'))

        <body data-topbar="dark" data-layout="horizontal">
        @else

            <body data-sidebar="dark">
    @endif
@show
<!-- Begin page -->
<div id="layout-wrapper">
    @if (Auth::user()->role_id == config('constant.CLIENT_ROLE'))
        @include('layouts.horizontal')
    @else
        @include('layouts.topbar')
        @include('layouts.sidebar')
    @endif
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            @include('components.message')
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        @include('layouts.footer')
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->
<!-- Right Sidebar -->
{{-- @include('layouts.right-sidebar') --}}
<!-- /Right-bar -->

<!-- JAVASCRIPT -->
@include('layouts.vendor-scripts')
</body>

</html>
