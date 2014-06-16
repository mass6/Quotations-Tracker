@extends('layouts.default')

@section('content')

<div class="container col-md-6 col-md-offset-3">

	<h3>Edit Customer:  {{ $customer->name}} [{{ $customer->id }}]</h3>


	{{ Form::model($customer, ['route' => array('customers.update', $customer->id), 'method' =>  'PUT']) }}

		<?php $submit = 'Update' ?>

		@include('customers.partials._formFields')

	{{ Form::close() }}
</div>
@stop