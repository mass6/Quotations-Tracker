@extends('layouts.default')

@section('content')

<div class="container col-md-6 col-md-offset-3">

    <h1>Create Attribute</h1>


    {{ Form::open(array('route' => 'attributes.store')) }}

    <?php $submit = 'Create Attribute' ?>

    @include('attributes.partials._formFields')


    {{ Form::close() }}

</div>

@stop