@extends('layouts.default')

@section('links')

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.0/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/28e7751dbec/integration/bootstrap/3/dataTables.bootstrap.css">
<style>
    table form { margin-bottom: 0; }
    form ul { margin-left: 0; list-style: none; }
    .error { color: red; font-style: italic; }
</style>
<script src="//cdn.datatables.net/1.10.0/js/jquery.dataTables.js" language="javascript" type="text/javascript"></script>
<script class="init" type="text/javascript">
    $(document).ready(function() {
        $('#datatable').dataTable();
    });
</script>

@stop

@section('content')

<div class="row">
    <div class="page-header">
        <h1>All Attributes</h1>
        <p class="text-left">{{ link_to_route('attributes.create', 'Add new attribute', null, array('class'=>'btn btn-info')) }}</p>
    </div>
    @if ($attributes->count())
    <table id="datatable" class="table table-striped table-bordered">
        <thead>
        <tr">
            <th class="emphasis">Name</th>
            <th>Description</th>
            <th>Type</th>
            <th>Options</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($attributes as $attribute)
        <tr>
            <td><strong>{{ $attribute->name }}</strong></td>
            <td><em>{{ $attribute->description }}</em></td>
            <td>{{ $attribute->label($attribute->type) }}</td>
            <td>{{ link_to_route('attributes.edit', 'Edit', array($attribute->id), array('class' => 'btn btn-primary')) }}</td>
            <td>
                {{ Form::open(array('method' => 'DELETE', 'route' => array('attributes.destroy', $attribute->id))) }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    @else
    There are no attributes
    @endif
</div>
@stop