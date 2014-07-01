<div id="add-comment" class="form-group">
    {{ Form::open(array('route' => array('comments.store', $type, $id), 'method'=>'PUT')) }}
    {{ Form::label('body', 'Add Comment', ['class'=>'control-label']) }}
    {{ Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) }}<br/>
    {{ Form::submit('submit', ['class'=>'btn btn-primary']) }}
    {{ Form::close() }}
</div>
