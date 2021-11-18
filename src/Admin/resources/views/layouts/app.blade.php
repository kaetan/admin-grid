<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{!!  \App\Helpers\Admin\Assets::getAssetCssUrl() !!}" type="text/css" />
</head>
<body class="{{ (isset($_COOKIE['menuMinimize']) && (bool)$_COOKIE['menuMinimize']) ? 'mini-navbar' : '' }}">

<!-- Wrapper-->
<div id="wrapper">
    <!-- Notifications-->
    @if(!empty(session('notifyInfo')))
        <div class="js-toastr-message hidden"
             data-toastr="warning">{{ session('notifyInfo') }}</div>
    @endif
    @if(!empty(session('notifyError')))
        <div class="js-toastr-message hidden"
             data-toastr="error">{{ session('notifyError') }}</div>
@endif
    <!-- Navigation -->
    @include('_partials.navigation')

    <!-- Page wraper -->
    <div id="page-wrapper" class="gray-bg">

        <!-- Page wrapper -->
        @include('_partials.topnavbar')
    {{--{!! Breadcrumbs::render() !!}--}}

        <!-- Main view  -->
        <div class="wrapper wrapper-content">
            @yield('content')
        </div>

        <!-- Footer -->
        @include('_partials.footer')
        {{--@include('_partials.fixed-footer')--}}
    </div>
    <!-- End page wrapper-->

</div>
<!-- End wrapper-->

<script src="{!! \App\Helpers\Admin\Assets::getAssetJsUrl() !!}" type="text/javascript"></script>
</body>
</html>
