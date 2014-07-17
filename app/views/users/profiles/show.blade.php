@extends('layouts.main')

@section('content')

<!--	<h2>{{ $user->first_name  . ' ' .  $user->last_name}}</h2>-->
<!--    <p class="text text-info">{{ $user->email }}</p>-->
<!---->
<!--    <ul class="list-unstyled">-->
<!--        <li>Mobile: {{ $user->profile->mobile }}</li>-->
<!--        <li>Skype Name: {{ $user->profile->skype_name }}</li>-->
<!--    </ul>-->
<!--<h5>Bio:</h5>-->
<!--    <p>{{ $user->profile->bio }}</p>-->
<!---->


<div class="profile-env">

<header class="row">

    <div class="col-sm-2">

        <a href="#" class="profile-picture">
            <img src="{{ $user->profile->avatar->url('medium') }}" class="img-responsive img-circle" />
        </a>

    </div>

    <div class="col-sm-7">

        <ul class="profile-info-sections">
            <li>
                <div class="profile-name">
                    <strong>
                        <a href="#">{{ fullname($user) }}</a>
<!--                        <a href="#" class="user-status is-online tooltip-primary" data-toggle="tooltip" data-placement="top" data-original-title="Online"></a>-->
                        <!-- User statuses available classes "is-online", "is-offline", "is-idle", "is-busy" -->						</strong>
                    <span>{{ $user->profile->position }}</span>
                </div>
            </li>
        </ul>

    </div>

    <div class="col-sm-3">

        <div class="profile-buttons">
            @if (getUser() === $user->id)
            <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-default">
                <i class="entypo-pencil"></i>
                Edit Profile
            </a>
            @endif

            <a href="mailto:{{ $user->email }}" class="btn btn-default">
                <i class="entypo-mail"></i>
            </a>
        </div>
    </div>

</header>

<section class="profile-info-tabs">
    <div class="row">
        <div class="col-sm-offset-2 col-sm-10">

            <div class="tab-content">
                <div class="tab-pane active" id="profile-info">

                    <ul class="user-details">
                        <li>
                            <a href="#">
                                <i class="entypo-suitcase"></i>
                                Position: <span>{{ $user->profile->position }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="entypo-location"></i>
                                {{ $user->profile->location }}
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="entypo-phone"></i>
                                Mobile: <span>{{ $user->profile->mobile }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="entypo-skype"></i>
                                Skype: <span>{{ $user->profile->skype_name }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="entypo-calendar"></i>
                                {{ $user->last_login->format('Y-m-d') }}
                            </a>
                        </li>
                    </ul>

                </div>

                <div class="tab-pane" id="biography">
                    <div>
                       {{ $user->profile->bio }}
                    </div>
                </div>
                <div class="tab-pane" id="edit-profile">
                    <div class="row">
                        <div class="col-md-8 well">
                        <h2>Edit Profile</h2>
                        {{ Form::model($user->profile, ['route' => array('profile.update', $user->id), 'method' =>  'PATCH', 'files' => true]) }}

                            @if (isset($errors))
                            @if ( count($errors) )
                            <div class="errors alert alert-danger">
                                @foreach ($errors->all('<li>:message</li>') as $message)
                                {{ $message }}
                                @endforeach
                            </div>

                            @endif
                            @endif

                            <div class="form-group">
                            {{ Form::label('position', 'Position:', ['class'=>'control-label']) }}
                            <div class="">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="entypo-suitcase"></i></span>
                                    {{ Form::text('position', null, ['class' => 'form-control', 'placeholder'=>'Position']) }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('location', 'Location:', ['class'=>'control-label']) }}
                            <div class="">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="entypo-location"></i></span>
                                    {{ Form::text('location', null, ['class' => 'form-control', 'placeholder'=>'Location/Site']) }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('mobile', 'Mobile:', ['class'=>'control-label']) }}
                            <div class="">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="entypo-phone"></i></span>
                                    {{ Form::text('mobile', null, ['class' => 'form-control', 'placeholder'=>'Mobile']) }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('skype_name', 'Skype Name:', ['class'=>'control-label']) }}
                            <div class="">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="entypo-skype"></i></span>
                                    {{ Form::text('skype_name', null, ['class' => 'form-control', 'placeholder'=>'Skype Name']) }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('bio', 'Biography:', ['class'=>'control-label']) }}
                            <div class="">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="entypo-book-open"></i></span>
                                    {{ Form::textarea('bio', null, ['class' => 'form-control', 'rows'=>5, 'placeholder'=>'A short biography about yourself']) }}
                                </div>
                            </div>
                            {{ $errors->first('bio', '<span class="label label-danger">:message</span>') }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('avatar', 'Profile Photo:') }}

                            <div class="">
                                {{ Form::file('avatar', ['class'=>'form-control', 'placeholder'=>'Placeholder']) }}
                            </div>
                            {{ $errors->first('avatar', '<span class="label label-warning">:message</span>') }}
                        </div>
                        <br />

                        <div class="form-group">
                            {{ Form::submit( 'Submit', ['class' => 'btn btn-primary']) }} {{ link_to_route('profile.show', 'Cancel', $user->id, array('class'=>'btn btn-warning')) }}
                        </div>

                        {{ Form::close() }}
                        </div>
                    </div>
                </div>

            </div>

            <ul class="nav nav-tabs"><!-- available classes "bordered", "right-aligned" -->

                <li class="active" id="profile-tab">
                    <a href="#profile-info" data-toggle="tab">
                        <span class="visible-xs"><i class="entypo-vcard"></i></span>
                        <span class="hidden-xs">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="#biography" data-toggle="tab">
                        <span class="visible-xs"><i class="entypo-user"></i></span>
                        <span class="hidden-xs">Bio</span>
                    </a>
                </li>
                <li class="" id="edit-tab">
                    <a href="#edit-profile" data-toggle="tab">
                        <span class="visible-xs"><i class="entypo-pencil"></i></span>
                        <span class="hidden-xs">Edit Profile</span>
                    </a>
                </li>

            </ul>

        </div>
    </div>


</section>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        <?php if (Session::has("validationfailed")) { ?>
         var errors = true;
        <?php } ?>
        if (typeof errors !== 'undefined'){
            document.getElementById('profile-tab').className = '';
            document.getElementById('profile-info').className = 'tab-pane';
            document.getElementById('edit-tab').className = 'active';
            document.getElementById('edit-profile').className = 'tab-pane active';
        }
    });

</script>



@stop