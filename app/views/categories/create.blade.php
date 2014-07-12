@extends('layouts.main')

@section('content')

<div class="container col-md-6 col-md-offset-3">

    <h1>Create Category</h1>


    {{ Form::open(array('route' => 'categories.store')) }}

    <?php $submit = 'Create Category' ?>

    @include('categories.partials._formFields')


    {{ Form::close() }}

</div>

@stop