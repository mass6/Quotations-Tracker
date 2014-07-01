@extends('layouts.main')

@section('content')
	<div class="container">
		<div class="jumbotron">
		  <h1>Quotations Tracker</h1>
		  <p>Welcome to the quotations tracking system. Please login to continue.</p>
		  <p>{{ link_to('/login', 'Login', array('class' => 'btn btn-primary btn-lg')) }}</p>
		</div>
	<div>
@stop