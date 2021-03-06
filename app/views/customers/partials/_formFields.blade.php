
<div class="form-group">
    {{ Form::label('code', 'Code:') }}
    {{ Form::text('code', null, ['class' => 'form-control']) }}
    {{ $errors->first('name', '<span class="label label-warning">:message</span>') }}
</div>
<div class="form-group">
    {{ Form::label('name', 'Name:') }}
    {{ Form::text('name', null, ['class' => 'form-control']) }}
    {{ $errors->first('name', '<span class="label label-warning">:message</span>') }}
</div>
<div class="form-group">
    {{ Form::label('layout', 'Layout:') }}
    {{ Form::text('layout', null, ['class' => 'form-control']) }}
    {{ $errors->first('layout', '<span class="label label-warning">:message</span>') }}
</div>

<div class="form-group">
    {{ Form::submit( $submit, ['class' => 'btn btn-primary']) }} {{ link_to_route('customers.index', 'Cancel', null, array('class'=>'btn btn-warning')) }}
</div>