@extends('layouts.main')

@section('links')

<link rel="stylesheet" type="text/css" href="{{ URL::asset('js/datatables/css/jquery.dataTables.css') }}">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/28e7751dbec/integration/bootstrap/3/dataTables.bootstrap.css">
<style>
    table.users, table.addresses {border:1px solid #dddddd;}
    .users td, .addresses td {border:1px solid #dddddd;}
    td.details-control1, td.details-control2 {
        background: url('{{ URL::asset("js/datatables/resources/details_open.png") }}') no-repeat center center;
        cursor: pointer;
    }
    tr.shown1 td.details-control1, tr.shown2 td.details-control2 {
        background: url('{{ URL::asset("js/datatables/resources/details_close.png") }}') no-repeat center center;
    }
    tr.row-header {background-color: #DDDDDD !important;}

    td.column-header {width: 100% !important;}

    .users tr {border-bottom: 1px solid #ddd;}


</style>
<script>
    var reportname = "<?php echo $reportName; ?>";
</script>

<script class="init" type="text/javascript">

    /* Formatting function for row details - modify as you need */
    function format ( d ) {
        // `d` is the original data object for the row
        return '<table class="users" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
            '<tr class="row-header">'+
                '<td class="column-header" colspan="11">Assigned Users</td>'+
            '</tr>'+
            '<tr">'+
                '<td>User 1:</td>'+
                '<td>'+d.user1+'</td>'+
                '<td>User 6:</td>'+
                '<td>'+d.user6+'</td>'+
                '<td>User 11:</td>'+
                '<td>'+d.user11+'</td>'+
                '<td>User 16:</td>'+
                '<td>'+d.user16+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>User 2:</td>'+
                '<td>'+d.user2+'</td>'+
                '<td>User 7:</td>'+
                '<td>'+d.user7+'</td>'+
                '<td>User 12:</td>'+
                '<td>'+d.user12+'</td>'+
                '<td>User 17:</td>'+
                '<td>'+d.user17+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>User 3:</td>'+
                '<td>'+d.user3+'</td>'+
                '<td>User 8:</td>'+
                '<td>'+d.user8+'</td>'+
                '<td>User 13:</td>'+
                '<td>'+d.user13+'</td>'+
                '<td>User 18:</td>'+
                '<td>'+d.user18+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>User 4:</td>'+
                '<td>'+d.user4+'</td>'+
                '<td>User 9:</td>'+
                '<td>'+d.user9+'</td>'+
                '<td>User 14:</td>'+
                '<td>'+d.user14+'</td>'+
                '<td>User 19:</td>'+
                '<td>'+d.user19+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>User 5:</td>'+
                '<td>'+d.user5+'</td>'+
                '<td>User 10:</td>'+
                '<td>'+d.user10+'</td>'+
                '<td>User 15:</td>'+
                '<td>'+d.user15+'</td>'+
                '<td>User 20:</td>'+
                '<td>'+d.user20+'</td>'+
            '</tr>'+
            '</table>';
    }

    /* Formatting function for row details - modify as you need */
    function format2 ( d ) {
        // `d` is the original data object for the row
        return '<table class="addresses"  cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
            '<tr class="row-header">'+
                '<td class="column-header" colspan="11">Shipping Addresses</td>'+
            '</tr>'+
            '<tr>'+
                '<td>No</td>'+
                '<td>Name</td>'+
                '<td>Street</td>'+
                '<td>Street L2</td>'+
                '<td>City</td>'+
                '<td>Country</td>'+
                '<td>Zip</td>'+
            '</tr>'+
            '<tr>'+
                '<td>1:</td>'+
                '<td>'+d.name_ship1+'</td>'+
                '<td>'+d.street_ship1+'</td>'+
                '<td>'+d.street1_ship1+'</td>'+
                '<td>'+d.city_ship1+'</td>'+
                '<td>'+d.country_ship1+'</td>'+
                '<td>'+d.zip_ship1+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>2:</td>'+
                '<td>'+d.name_ship2+'</td>'+
                '<td>'+d.street_ship2+'</td>'+
                '<td>'+d.street1_ship2+'</td>'+
                '<td>'+d.city_ship2+'</td>'+
                '<td>'+d.country_ship2+'</td>'+
                '<td>'+d.zip_ship2+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>3:</td>'+
                '<td>'+d.name_ship3+'</td>'+
                '<td>'+d.street_ship3+'</td>'+
                '<td>'+d.street1_ship3+'</td>'+
                '<td>'+d.city_ship3+'</td>'+
                '<td>'+d.country_ship3+'</td>'+
                '<td>'+d.zip_ship3+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>4:</td>'+
                '<td>'+d.name_ship4+'</td>'+
                '<td>'+d.street_ship4+'</td>'+
                '<td>'+d.street1_ship4+'</td>'+
                '<td>'+d.city_ship4+'</td>'+
                '<td>'+d.country_ship4+'</td>'+
                '<td>'+d.zip_ship4+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>5:</td>'+
                '<td>'+d.name_ship5+'</td>'+
                '<td>'+d.street_ship5+'</td>'+
                '<td>'+d.street1_ship5+'</td>'+
                '<td>'+d.city_ship5+'</td>'+
                '<td>'+d.country_ship5+'</td>'+
                '<td>'+d.zip_ship5+'</td>'+
            '</tr>'+
            '</table>';
    }


    $(document).ready(function() {
        var table = $('#datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url" : "http://basepackage.v2.dev/insight/service2.php",
                "type": "POST",
                "dataSrc": "",
                "data": function ( d ) {
                    return $.extend( {}, d, {
                        "key": "sc121212",
                        "queryType" : "contracts"
                    });
                }
            },
            "deferRender": true,
            "columns": [
                {
                    "class":          'details-control1',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ''
                },
                {
                    "class":          'details-control2',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ''
                },
                { "data": "web_id" },
                { "data": "code" },
                { "data": "cname" },
                { "data": "customer" },
                { "data": "store" },
                { "data": "update_time" },
                { "data": "website", "visible": false}
            ],
            "order": [[2, 'asc']],
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-6 col-left'l><'col-xs-6 col-right'<'export-data'T>f>r>t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
            "oTableTools": {

                "sSwfPath": "{{ URL::asset('js/datatables/copy_csv_xls_pdf.swf') }}",
                "aButtons": [
                    "print",
                    {
                        "sExtends": "pdf",
                        "sFileName": "contracts.pdf",
                        "mColumns": [ 2,3,4,5,6 ]
                    },
                    {
                        "sExtends": "csv",
                        "sFileName": "contracts.csv",
                        "mColumns": "all"
                    },
                    {
                        "sExtends": "xls",
                        "sFileName": "contracts.xls",
                        "mColumns": [ 2,3,4,5,6 ]
                    }
                ]
            }
        });

        // Add event listener for opening and closing details
        $('#datatable tbody').on('click', 'td.details-control1', function () {
            console.log('clicked');
            var tr = $(this).closest('tr');
            var row = table.row( tr );

            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown1');
            }
            else {
                // Open this row
                row.child( format(row.data()) ).show();
                tr.addClass('shown1');
            }
        } );

        // Add event listener for opening and closing details
        $('#datatable tbody').on('click', 'td.details-control2', function () {
            console.log('clicked');
            var tr = $(this).closest('tr');
            var row = table.row( tr );

            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown2');
            }
            else {
                // Open this row
                row.child( format2(row.data()) ).show();
                tr.addClass('shown2');
            }
        } );


    });
</script>

@stop

@section('content')



        <h2>{{ isset($heading) ? $heading : 'Contracts!!!' }}</h2>


    <table id="datatable" class="table table-bordered datatable">
        <thead>
        <tr>
            <th>Users</th>
            <th>Ship</th>
            <th>ID</th>
            <th>Code</th>
            <th>Name</th>
            <th>Customer</th>
            <th>Store</th>
            <th>Last Updated</th>
            <th>Website</th>
        </tr>
        </thead>

    </table>


   {{ Form::open() }}
   {{ Form::close() }}


@include('layouts.partials.scripts._datatables')

@stop