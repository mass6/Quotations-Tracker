@extends('layouts.main')

@section('links')

<link rel="stylesheet" type="text/css" href="{{ URL::asset('js/datatables/css/jquery.dataTables.css') }}">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/28e7751dbec/integration/bootstrap/3/dataTables.bootstrap.css">
<style>
    table form { margin-bottom: 0; }
    form ul { margin-left: 0; list-style: none; }
    .error { color: red; font-style: italic; }
</style>

<script class="init" type="text/javascript">
    $(document).ready(function() {
        $('#datatable').dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-6 col-left'l><'col-xs-6 col-right'<'export-data'T>f>r>t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
            "oTableTools": {
                "sSwfPath": "js/datatables/copy_csv_xls_pdf.swf",
                "aButtons": [
                    "print",
                    {
                        "sExtends": "pdf",
                        "sFileName": "suppliers.pdf"
                    },
                    {
                        "sExtends": "csv",
                        "sFileName": "suppliers.csv"
                    },
                    {
                        "sExtends": "xls",
                        "sFileName": "suppliers.xls"
                    }
                ]
            },
            "columnDefs": [ {
                "targets": 1,
                "width": "20%",
                "orderable" : false
            } ]
        });
    });
</script>

@stop

@section('content')

    <h2>All Suppliers</h2>
    <p class="text-left">{{ link_to_route('suppliers.create', 'Add new supplier', null, array('class'=>'btn btn-info')) }}</p>

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

@include('layouts.partials.scripts._datatables')
@stop