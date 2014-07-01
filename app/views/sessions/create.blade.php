@extends('layouts.main')

@section('content')

<div class="container col-md-3 col-md-offset-4"> 
	{{ Form::open(array('route' => 'sessions.store', 'class'=>'form-signin', 'role'=>'form')) }}
				<h2 class="form-signin-heading">Please sign in</h2>
					{{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Email Address', 'required'=>'', 'autofocus'=>'')) }}
					{{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password', 'required'=>'')) }}

					<label class="checkbox">
						{{ Form::checkbox('remember-me','remember-me') }}
          				Remember me
        			</label>		
					{{ Form::submit('Sign in', array('class'=>'btn btn-lg btn-primary btn-block'))}}
	{{ Form::close() }}

		<p>{{ link_to_route('forgotpassword', 'Forgot Password?') }}</p>
</div>

@stop