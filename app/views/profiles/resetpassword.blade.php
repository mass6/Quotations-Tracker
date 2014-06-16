@extends('layouts.default')

@section('content')

<div class="container col-md-5 col-md-offset-3"> 
	{{-- Form::open(array('class' => 'form-horizontal', 'route' => 'passwordupdate', 'method' => 'patch'), $user['id']) --}}

	{{ Form::open(array('route' => array('passwordupdate', $user['id'], $token), 'method' => 'PATCH')) }}
	{{-- Form::hidden('user', $user) --}}

	<h2 class="form-signin-heading">Reset Password</h2>
	<p>Enter a new password.</p>
	
	<div class="form-group">
      {{ Form::label('password', 'Password:') }}
      {{ Form::password('password', ['class' => 'form-control']) }}
      {{ $errors->first('password', '<span class="label label-warning">:message</span>') }}
      </div>

      <div class="form-group">
      {{ Form::label('password_confirmation', 'Confirm:') }}
      {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
      {{ $errors->first('password_confirmation', '<span class="label label-warning">:message</span>') }}
   	</div>			

	<div class="form-group">
	{{ Form::submit( 'Submit', ['class' => 'btn btn-primary']) }} {{ link_to('login', 'Cancel', array('class'=>'btn btn-warning')) }}
	</div>

</div>


@stop