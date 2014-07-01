<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Neon Admin Panel" />
    <meta name="author" content="" />

    <title>Neon | Dashboard</title>


    <link rel="stylesheet" href="{{ URL::asset('js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/font-icons/entypo/css/entypo.css') }}">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/neon-core.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/neon-theme.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/neon-forms.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}">

    <script src="{{ URL::asset('js/jquery-1.11.0.min.js') }}"></script>

    @yield('links')


    <!--[if lt IE 9]><script src="{{ URL::asset('js/ie8-responsive-file-warning.js') }}"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body class="page-body" data-url="http://quotations.dev">

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

    @include('layouts.partials._sidebar')
    <div class="main-content">

@include('layouts.partials._top_bar')

@if (Session::has('flash_message'))
<div class="row alert {{ Session::get('success') ? 'alert-success' : 'alert-danger' }} clearfix" data-dismiss="alert">
    {{ Session::get('flash_message') }}
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
</div>
@endif

@yield('content')

<!-- Footer -->
<footer class="main">

    &copy; 2014 <strong>36S</strong>

</footer>

</div>

    @include('layouts.partials._chat')

</div>

<link rel="stylesheet" href="{{ URL::asset('js/jvectormap/jquery-jvectormap-1.2.2.css') }}">
<link rel="stylesheet" href="{{ URL::asset('js/rickshaw/rickshaw.min.css') }}">

<!-- Bottom Scripts -->
<script src="{{ URL::asset('js/gsap/main-gsap.js') }}"></script>
<script src="{{ URL::asset('js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.js') }}"></script>
<script src="{{ URL::asset('js/joinable.js') }}"></script>
<script src="{{ URL::asset('js/resizeable.js') }}"></script>
<script src="{{ URL::asset('js/neon-api.js') }}"></script>
<script src="{{ URL::asset('js/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ URL::asset('js/jvectormap/jquery-jvectormap-europe-merc-en.js') }}"></script>
<script src="{{ URL::asset('js/jquery.sparkline.min.js') }}"></script>
<script src="{{ URL::asset('js/rickshaw/vendor/d3.v3.js') }}"></script>
<script src="{{ URL::asset('js/rickshaw/rickshaw.min.js') }}"></script>
<script src="{{ URL::asset('js/raphael-min.js') }}"></script>
<script src="{{ URL::asset('js/morris.min.js') }}"></script>
<script src="{{ URL::asset('js/toastr.js') }}"></script>
<script src="{{ URL::asset('js/neon-chat.js') }}"></script>
<script src="{{ URL::asset('js/neon-custom.js') }}"></script>


</body>
</html>