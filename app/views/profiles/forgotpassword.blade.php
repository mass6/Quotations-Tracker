@extends('layouts.default')

@section('content')

<div class="container col-md-5 col-md-offset-3"> 
	{{ Form::open(array('class' => 'form-horizontal', 'route' => 'passwordresetrequest')) }}

		<h2 class="form-signin-heading">Forgotten Password</h2>
		<p>Enter you email address and we'll send you reset code to your registered email address.</p>
		<div class="form-group">
		
		{{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter your registered email address']) }}
		{{ $errors->first('email', '<span class="label label-warning">:message</span>') }}
		</div>				

		<div class="form-group">
		{{ Form::submit( 'Submit', ['class' => 'btn btn-primary']) }} {{ link_to('login', 'Cancel', array('class'=>'btn btn-warning')) }}
		</div>

</div>

@stop