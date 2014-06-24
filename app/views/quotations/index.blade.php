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
        <h1>{{ isset($heading) ? $heading : 'All Quotations' }}<h1><hr/>
        <p class="text-left">{{ link_to_route('quotations.create', 'Add new quotation', null, array('class'=>'btn btn-info')) }}</p>
    </div>
    @if ($quotations->count())
    <table id="datatable" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Item Request</th>
            <th>Product Name</th>
            <th>Supplier</th>
            <th>Validity</th>
            <th>UOM</th>
            <th>Price</th>
            <th>Options</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($quotations as $quotation)
        <tr>
            <td><em>{{ $quotation->id }}</em></td>
            <td>{{ $quotation->itemRequest['name'] }}</td>
            <td>{{ $quotation->product_name }}</td>
            <td>{{ $quotation->supplier->name }}</td>
            <td>{{ $quotation->valid_until->format('d-m-Y') }}</td>
            <td>{{ $quotation->uom }}</td>
            <td>{{ $quotation->uom_price }}</td>
            <td>{{ link_to_route('quotations.show', 'View', array($quotation->id), array('class' => 'btn btn-primary')) }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    @else
    There are no Quotations
    @endif
</div>
@stop