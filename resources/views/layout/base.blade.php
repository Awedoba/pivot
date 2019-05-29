<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">


    <title>Pivot | {{isset($title)?$title:"App"}}</title>
    @include('layout.includes.css')
    @stack('styles')

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern content-left-sidebar todo-application navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">

@include('layout.includes.sidebar')

<!-- BEGIN: Content-->
<div class="app-content content">

@include('layout.includes.nav')

    <div class="content-area-wrapper">
        @include('layout.includes.alert')
        @yield('content')
    </div>
</div>
<!-- END: Content-->
</div>
<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

@include('layout.includes.footer')

@include('layout.includes.js')
@stack('scripts')
</body>
<!-- END: Body-->
</html>