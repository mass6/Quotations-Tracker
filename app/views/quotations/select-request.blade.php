@extends('layouts.default')

@section('content')


    <div class="container col-md-6 col-md-offset-3">
        <h1>New Quotation</h1>

        <h4>Select the Item Request to attached this quotation to</h4>





              {{ Form::open(array('route' => 'quotations.create')) }}






              {{ Form::close() }}

    </div>

@stop