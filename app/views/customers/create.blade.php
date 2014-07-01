@extends('layouts.main')

@section('content')

<div class="container col-md-6 col-md-offset-3">

    <h1>Create Customer</h1>


    {{ Form::open(array('route' => 'customers.store')) }}

    <?php $submit = 'Create Customer' ?>

    @include('customers.partials._formFields')


    {{ Form::close() }}

</div>

@stop