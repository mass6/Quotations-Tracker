
      <div class="form-group">
      {{ Form::label('first_name', 'First Name:') }}
      {{ Form::text('first_name', null, ['class' => 'form-control']) }}
      {{ $errors->first('first_name', '<span class="label label-warning">:message</span>') }}
      </div>

      <div class="form-group">
      {{ Form::label('last_name', 'Last Name:') }}
      {{ Form::text('last_name', null, ['class' => 'form-control']) }}
      {{ $errors->first('last_name', '<span class="label label-warning">:message</span>') }}
      
      </div>

      <div class="form-group">
      {{ Form::label('email', 'Email:') }}
      {{ Form::text('email', null, ['class' => 'form-control']) }}
      {{ $errors->first('email', '<span class="label label-warning">:message</span>') }}
      </div>

      <div class="form-group">
      {{ Form::label('avatar', 'Avatar:') }}
      {{ Form::file('avatar') }}
      {{ $errors->first('avatar', '<span class="label label-warning">:message</span>') }}
      </div>

      <div class="form-group">
      {{ Form::label('password', 'Password:') }}
      {{ Form::password('password', ['class' => 'form-control', 'autocomplete'=>'off']) }}
      {{ $errors->first('password', '<span class="label label-warning">:message</span>') }}
      </div>

      <div class="form-group">
      {{ Form::label('password_confirmation', 'Confirm:') }}
      {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
      {{ $errors->first('password_confirmation', '<span class="label label-warning">:message</span>') }}
   	</div>

      <div class="form-group">
      {{ Form::label('group_membership', 'Group Membership: ') }} 
      <p><small><em>(Contol/Command + Click to select/deselect)</em></small></p>
      {{ Form::select('group_membership[]', getGroups(), isset($membership) ? $membership : null, ['class' => 'form-control', 'multiple' => '']) }}
      {{ $errors->first('group_membership', '<span class="label label-warning">:message</span>') }}
      </div>
   	
      <div class="form-group">
		{{ Form::submit( $submit, ['class' => 'btn btn-primary']) }} {{ link_to_route('admin.users.index', 'Cancel', null, array('class'=>'btn btn-warning')) }}
		</div>