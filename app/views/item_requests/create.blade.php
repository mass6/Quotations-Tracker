@extends('layouts.default')

@section('content')

<div class="container col-md-6 col-md-offset-3">

    <h1>Create Item Request</h1>


    {{ Form::open(array('route' => 'item-requests.store')) }}

    <?php $submit = 'Create Request' ?>

    @include('item_requests.partials._formFields')


    {{ Form::close() }}

</div>

@stop