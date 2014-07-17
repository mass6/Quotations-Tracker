@extends(getLayout())

@section('content')


	<h2>Edit Profile</h2>
	{{ Form::model($user->profile, ['route' => array('profile.update', $user->id), 'method' =>  'PATCH', 'files' => true]) }}

    <div class="form-group">
        {{ Form::label('mobile', 'Mobile:') }}
        {{ Form::text('mobile', null, ['class' => 'form-control']) }}
        {{ $errors->first('mobile', '<span class="label label-warning">:message</span>') }}
    </div>

    <div class="form-group">
        {{ Form::label('skype_name', 'Skype Name:') }}
        {{ Form::text('skype_name', null, ['class' => 'form-control']) }}
        {{ $errors->first('skype_name', '<span class="label label-warning">:message</span>') }}

    </div>

    <div class="form-group">
        {{ Form::label('bio', 'Bio:') }}
        {{ Form::textarea('bio', null, ['class' => 'form-control', 'rows'=>4]) }}
        {{ $errors->first('bio', '<span class="label label-warning">:message</span>') }}
    </div>

    <div class="form-group">
        {{ Form::label('avatar', 'Profile Photo:') }}
        {{ Form::file('avatar') }}
        {{ $errors->first('avatar', '<span class="label label-warning">:message</span>') }}
        <img src="{{ $user->profile->avatar->url('medium') }}" >
        <img src="{{ $user->profile->avatar->url('thumb') }}" >
    </div>

    <div class="form-group">
        {{ Form::submit( 'Submit', ['class' => 'btn btn-primary']) }} {{ link_to_route('profile.show', 'Cancel', $user->id, array('class'=>'btn btn-warning')) }}
    </div>

	{{ Form::close() }}


@stop