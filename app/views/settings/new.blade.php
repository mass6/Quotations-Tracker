<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@if (isset($title)) {{ $title }} @else My App @endif</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/cerulean/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/datepicker.css') }}">
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

    @yield('links')


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

@include('layouts.partials._navigation')

<div class="container">
    @if (Session::has('flash_message'))
    <div class="row alert {{ Session::get('success') ? 'alert-success' : 'alert-danger' }} clearfix">
        {{ Session::get('flash_message') }}
    </div>
    @endif

    {{ Form::open( array(
    'route' => 'settings.create',
    'method' => 'post',
    'id' => 'form-add-setting'
    ) ) }}

    {{ Form::label( 'setting_name', 'Setting Name:' ) }}
    {{ Form::text( 'setting_name', '', array(
    'id' => 'setting_name',
    'placeholder' => 'Enter Setting Name',
    'maxlength' => 20,
    'required' => true,
    ) ) }}
    {{ Form::label( 'setting_value', 'Setting Value:' ) }}
    {{ Form::text( 'setting_value', '', array(
    'id' => 'setting_value',
    'placeholder' => 'Enter Setting Value',
    'maxlength' => 30,
    'required' => true,
    ) ) }}

    {{ Form::submit( 'Add Setting', array(
    'id' => 'btn-add-setting',
    ) ) }}

    {{ Form::close() }}

</div>

<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/settings/new.js') }}"></script>


</body>
</html>


