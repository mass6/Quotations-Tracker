@extends('layouts.main')

@section('links')

<link rel="stylesheet" type="text/css" href="{{ URL::asset('js/datatables/css/jquery.dataTables.css') }}">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/28e7751dbec/integration/bootstrap/3/dataTables.bootstrap.css">
<!--<style>-->
<!--    table.users, table.addresses {border:1px solid #dddddd;}-->
<!--    .users td, .addresses td {border:none;}-->
<!--    td.details-control1, td.details-control2 {-->
<!--        background: url('{{ URL::asset("js/datatables/resources/details_open.png") }}') no-repeat center center;-->
<!--        cursor: pointer;-->
<!--    }-->
<!--    tr.shown1 td.details-control1, tr.shown2 td.details-control2 {-->
<!--        background: url('{{ URL::asset("js/datatables/resources/details_close.png") }}') no-repeat center center;-->
<!--    }-->
<!--    tr.row-header {background-color: #DDDDDD !important;}-->
<!--    td.column-header {width: 100% !important;color:#464646}-->
<!--    .users tr {border-bottom: 1px solid #ddd;}-->
<!--    td.col-label {color:#464646;}-->
<!--    td.col-value {border-right:1px solid #DDDDDD;}-->
<!--    table.addresses tr td.col-label {text-decoration: underline;}-->
<!---->
<!---->
<!--</style>-->


<script class="init" type="text/javascript">
    $(document).ready(function() {

        $('#datatable tfoot th').each( function () {
            var title = $('#example thead th').eq( $(this).index() ).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );

        // Datatable
        var table = $('#datatable').DataTable({
            "ajax": {
                "url" : "/ajax/products",
                "dataSrc": ""
            },
            "deferRender": true,
            stateSave: false,
            "columns": [
                { "data": "customer" },
                { "data": "sku" },
                { "data": "name" },
                { "data": "uom" },
                { "data": "price" }
            ],
            "order": [[0, 'asc']],
            "sPaginationType": "bootstrap",
            "pagingType": "full_numbers",
            "sDom": "<'row'<'col-xs-6 col-left'l><'col-xs-6 col-right'<'export-data'T>f>r>t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
            "oTableTools": {
                "sSwfPath": "{{ URL::asset('js/datatables/copy_csv_xls_pdf.swf') }}",
                "aButtons": [
                    "print",
                    {
                        "sExtends": "pdf",
                        "sFileName": "products.pdf",
                        "mColumns": "all"
                    },
                    {
                        "sExtends": "csv",
                        "sFileName": "products.csv",
                        "mColumns": "all"
                    },
                    {
                        "sExtends": "xls",
                        "sFileName": "products.xls",
                        "mColumns": "all"
                    }
                ]
            }
        });

        // Apply the filter
        table.columns().eq( 0 ).each( function ( colIdx ) {
            $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
                table
                    .column( colIdx )
                    .search( this.value )
                    .draw();
            } );
        } );

    });
</script>

@stop

@section('content')

<h2>{{ isset($heading) ? $heading : 'Products' }}</h2>


<table id="datatable" class="table table-bordered datatable">
    <thead>
    <tr>
        <th>Customer</th>
        <th>SKU</th>
        <th>Name</th>
        <th>UOM</th>
        <th>Price</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>Customer</th>
        <th>SKU</th>
        <th>Name</th>
        <th>UOM</th>
        <th>Price</th>
    </tr>
    </tfoot>
</table>

@include('layouts.partials.scripts._datatables')

@stop