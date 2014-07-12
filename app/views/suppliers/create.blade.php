@extends('layouts.main')

@section('content')

<div class="container col-md-6 col-md-offset-3">

    <h1>Create Supplier</h1>


    {{ Form::open(array('route' => 'suppliers.store')) }}

    <?php $submit = 'Create Supplier' ?>

    @include('suppliers.partials._formFields')


    {{ Form::close() }}

</div>

@stop