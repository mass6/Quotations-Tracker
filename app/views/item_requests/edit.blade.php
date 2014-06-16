@extends('layouts.default')

@section('content')

<div class="container col-md-6 col-md-offset-3">

	<h3>Edit Item Request:  {{ $item_request->name}} [{{ $item_request->id }}]</h3>


	{{ Form::model($item_request, ['route' => array('item-requests.update', $item_request->id), 'method' =>  'PUT']) }}

		<?php $submit = 'Update' ?>

		@include('item_requests.partials._formFields')

	{{ Form::close() }}
</div>
@stop