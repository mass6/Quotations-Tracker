
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
      {{ Form::text('email', null, ['class' => 'form-control', 'autocomplete'=>'off']) }}
      {{ $errors->first('email', '<span class="label label-warning">:message</span>') }}
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

      <div id="type" class="form-group">
      {{ Form::label('type', 'User Type: ') }}
      {{ Form::select('type', [1=>'Internal', 2=>'Customer', 3=>'Supplier'], null, ['class' => 'form-control', 'id'=>'user-type', 'onChange'=>'selectCustomer(value)']) }}
      {{ $errors->first('type', '<span class="label label-warning">:message</span>') }}
      </div>

      <div class="form-group" id="div-customer" style="display:none;">
      {{ Form::label('customer', 'Customer Name: ') }}
      {{ Form::select('customer', $customers, null, ['id'=>'customer', 'class' => 'form-control']) }}
      {{ $errors->first('customer', '<span class="label label-warning">:message</span>') }}
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

      <script type="text/javascript">
          $(document).ready(function () {
              var x = 1;
              if (document.getElementById('user-type').value == 2) {
                  document.getElementById('div-customer').style.display = 'block';
              }
          });
          function selectCustomer(value)
          {
              if (value == 2){
                  document.getElementById('div-customer').style.display = 'block';
              } else {
                  document.getElementById('div-customer').style.display = 'none';
                  document.getElementById('customer').value = null;
              }
          }

      </script>