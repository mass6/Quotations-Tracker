@extends('layouts.default')

@section('content')

<div class="container col-md-6 col-md-offset-3">
	
	<h1>Create User</h1>


	{{ Form::open(array('route' => 'admin.users.store')) }}
		
		<?php $submit = 'Create User' ?>

		@include('users.partials._formFields')
		

	{{ Form::close() }}

</div>

@stop