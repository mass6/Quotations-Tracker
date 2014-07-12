@extends('layouts.main')

@section('links')

<link rel="stylesheet" type="text/css" href="{{ URL::asset('js/datatables/css/jquery.dataTables.css') }}">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/28e7751dbec/integration/bootstrap/3/dataTables.bootstrap.css">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
<style>
    table form { margin-bottom: 0; }
    form ul { margin-left: 0; list-style: none; }
    .error { color: red; font-style: italic; }
</style>

<!--<script src="//cdn.datatables.net/1.10.0/js/jquery.dataTables.js" language="javascript" type="text/javascript"></script>-->
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
                        "sFileName": "customers.pdf",
                        "sPdfMessage": "Your custom message would go here."
                    },
                    {
                        "sExtends": "csv",
                        "sFileName": "customers.csv"
                    },
                    {
                        "sExtends": "xls",
                        "sFileName": "customers.xls"
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


    <h2>Customers</h2>
    <p class="text-left">{{ link_to_route('customers.create', 'Add new customer', null, array('class'=>'btn btn-info')) }}</p>

    @if ($customers->count())
    <table id="datatable" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Options</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($customers as $customer)
        <tr>
            <td>{{ $customer->name }}</td>
            <td>
                {{ Form::open(array('method' => 'DELETE', 'route' => array('customers.destroy', $customer->id), 'class'=>'form-inline')) }}
                {{ link_to_route('customers.edit', 'Edit', array($customer->id), array('class' => 'btn btn-primary')) }} {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    @else
    There are no customers
    @endif

@include('layouts.partials.scripts._datatables')
@stop