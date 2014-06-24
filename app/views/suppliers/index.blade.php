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
        <h1>All Suppliers</h1>
        <p class="text-left">{{ link_to_route('suppliers.create', 'Add new supplier', null, array('class'=>'btn btn-info')) }}</p>
    </div>
    @if ($suppliers->count())
    <table id="datatable" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Options</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($suppliers as $supplier)
        <tr>
            <td>{{ $supplier->name }}</td>
            <td>
                {{ Form::open(array('method' => 'DELETE', 'route' => array('suppliers.destroy', $supplier->id), 'class'=>'form-inline')) }}
                {{ link_to_route('suppliers.edit', 'Edit', array($supplier->id), array('class' => 'btn btn-primary')) }} {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    @else
    There are no suppliers
    @endif
</div>
@stop