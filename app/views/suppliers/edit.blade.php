@extends('layouts.default')

@section('content')

<div class="container col-md-6 col-md-offset-3">

	<h3>Edit Supplier:  {{ $supplier->name}} [{{ $supplier->id }}]</h3>


	{{ Form::model($supplier, ['route' => array('suppliers.update', $supplier->id), 'method' =>  'PUT']) }}

		<?php $submit = 'Update' ?>

		@include('suppliers.partials._formFields')

	{{ Form::close() }}
</div>
@stop