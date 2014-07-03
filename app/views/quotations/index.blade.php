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
        var table = $('#datatable').dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-6 col-left'l><'col-xs-6 col-right'<'export-data'T>f>r>t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
            "oTableTools": {
                "sSwfPath": "js/datatables/copy_csv_xls_pdf.swf",
                "aButtons": [
                    "print",
                    {
                        "sExtends": "pdf",
                        "sFileName": "quotations.pdf"
                    },
                    {
                        "sExtends": "csv",
                        "sFileName": "quotations.csv"
                    },
                    {
                        "sExtends": "xls",
                        "sFileName": "quotations.xls"
                    }
                ]
            },
            "columnDefs": [ {
                "targets": [7,1],
                "width": "10%",
                "orderable" : false
            } ]
        });
    });
</script>

@stop

@section('content')

<h2>{{ isset($heading) ? $heading : 'All Quotations' }}</h2>
<p class="text-left">{{ link_to_route('quotations.create', 'Add new quotation', null, array('class'=>'btn btn-info')) }}</p>

    @if ($quotations->count())
    <table id="datatable" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Item Requests</th>
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
            <td>
                @foreach ($quotation->itemRequests as $request)
                    <span class="small">[ {{ link_to_route('item-requests.show', $request->id . ': ' . $request->name, $request->id) }} ]</span><br/>
                @endforeach
            </td>
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

@include('layouts.partials.scripts._datatables')
@stop