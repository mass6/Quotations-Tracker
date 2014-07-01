@extends('layouts.main')

@section('content')

<div class="container col-md-6 col-md-offset-3">

	<h3>Edit User:  {{ $user->first_name . ' ' . $user->last_name}} [{{ $user->id }}]</h3>


	{{ Form::model($user, ['route' => array('admin.users.update', $user->id), 'method' =>  'PATCH', 'files' => true]) }}

		<?php $submit = 'Update' ?>

		@include('users.partials._formFields')

	{{ Form::close() }}
</div>
@stop