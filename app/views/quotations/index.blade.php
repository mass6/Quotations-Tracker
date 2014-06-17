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
        <h1>{{ isset($heading) ? $heading : 'All Item Requests' }}<h1><hr/>
        <p class="text-left">{{ link_to_route('quotations.create', 'Add new quotation', null, array('class'=>'btn btn-info')) }}</p>
    </div>
    @if ($quotations->count())
    <table id="datatable" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Product Name</th>
            <th>Request Reference</th>
            <th>Category</th>
            <th>Status</th>
            <th>Assigned To</th>
            <th>Created</th>
            <th>Options</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($quotations as $quotation)
        <tr>
            <td><em>{{ $quotation->id }}</em></td>
            <td>{{ $quotation->customer->name }}</td>
            <td>{{ $quotation->name }}</td>
            <td>{{ $quotation->reference }}</td>
            <td>{{ $quotation->category->name }}</td>
            <td>{{ $quotation->label($quotation->status) }}</td>
            <td>{{ $quotation->assignedTo->first_name }}</td>
            <td>{{ $quotation->created_at->format('d-m-Y') }}</td>
            <td>{{ link_to_route('item-requests.edit', 'View / Edit', array($quotation->id), array('class' => 'btn btn-primary')) }}</td>
            <td>
                {{ Form::open(array('method' => 'DELETE', 'route' => array('item-requests.destroy', $quotation->id))) }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    @else
    There are no Quotations
    @endif
</div>
@stop