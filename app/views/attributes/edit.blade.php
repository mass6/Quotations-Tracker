@extends('layouts.default')

@section('content')

<div class="container col-md-6 col-md-offset-3">

	<h3>Edit Attribute:  {{ $attribute->name}} [{{ $attribute->id }}]</h3>


	{{ Form::model($attribute, ['route' => array('attributes.update', $attribute->id), 'method' =>  'PUT']) }}

		<?php $submit = 'Update' ?>

		@include('attributes.partials._formFields')

	{{ Form::close() }}
</div>
@stop