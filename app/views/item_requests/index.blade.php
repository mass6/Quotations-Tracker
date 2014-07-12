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
            "order": [[0, 'desc']],
            "oTableTools": {
                "sSwfPath": "js/datatables/copy_csv_xls_pdf.swf",
                "aButtons": [
                    "print",
                    {
                        "sExtends": "pdf",
                        "sFileName": "product-requests.pdf"
                    },
                    {
                        "sExtends": "csv",
                        "sFileName": "product-requests.csv"
                    },
                    {
                        "sExtends": "xls",
                        "sFileName": "product-requests.xls"
                    }
                ]
            },
            "columnDefs": [ {
                "targets": 9,
                "width": "20%",
                "orderable" : false
            } ]
        });
    });
</script>

@stop

@section('content')


        {{ link_to_route('myrequests', 'My Requests', null, ['class'=>'btn btn-warning pull-right'])  }}
        @if (isset($filtered))
        {{ link_to_route('item-requests.index', 'Show All', null, ['class'=>'btn btn-primary pull-right'])  }}
        @endif
        <h2>{{ isset($heading) ? $heading : 'All Item Requests' }}</h2>
        <p class="text-left">{{ link_to_route('item-requests.create', 'Add new Item Request', null, array('class'=>'btn btn-info')) }}</p>

    @if ($item_requests->count())
    <table id="datatable" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>Customer</th>
            <th>Product Name</th>
            <th>Request Reference</th>
            <th>Status</th>
            <th>Category</th>
            <th><span id="tippy" data-toggle="tooltip" data-placement="top" title="Number of valid quotes attached to the Item Request">#Quotes</span></th>
            <th>Assigned</th>
            <th>Created</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $counter = 1; ?>
        @foreach ($item_requests as $item_request)
        <tr>
            <td><em>{{ $item_request->id }}</em></td>
            <td>{{ $item_request->customer->name }}</td>
            <td>{{ $item_request->name }}</td>
            <td>{{ $item_request->reference }}</td>
            <td>{{ $item_request->label($item_request->status) }}</td>
            <td>{{ $item_request->category->name }}</td>
            <td>{{ count($item_request->validQuotations) }}</td>
            <td>{{ $item_request->assignedTo->first_name }}</td>
            <td>{{ $item_request->created_at->format('d-m-Y') }}</td>
            <td>{{-- link_to_route('item-requests.show', 'View', array($item_request->id), array('class' => 'btn btn-primary')) --}}
                {{ Form::open(array('class' => 'form-inline') ) }}
                {{ Form::select('actions', ['0'=>'[Select]','view'=>'View/Edit', 'new-quotation'=>'New Quote','assign-quotation'=>'Attach Quotation'], null, ['class'=>'form-control','id'=>'select-action' . $counter]) }}
                <button type="button" id="btn-inline" class="btn btn-sm btn-primary form-control" onclick="btnClicked('{{ "select-action" . $counter }}',{{ $item_request->id }})">Go</button>
                {{-- Form::button( 'Go', array('id' => 'btn-add-quotation','class' => 'btn btn-sm btn-primary form-control', 'id'=>'btn-inline', 'onclick'=>'btnClicked($item_request->id)') ) --}}
                {{ Form::close() }}
                {{-- link_to_route('quotations.createFromItemRequest', '+ Quote', array($item_request->id), array('class' => 'btn btn-info')) --}}</td>
        </tr>
        <?php $counter++; ?>
        @endforeach
        </tbody>
    </table>
    @else
    There are no Item requests
    @endif


<script type="text/javascript">
    function btnClicked(elname, id)
    {
        if ( document.getElementById(elname).value == "view" )
        {
            window.location="{{ url('/item-requests/') }}" + "/" + id
        }
        else if ( document.getElementById(elname).value == "new-quotation" )
        {
            window.location="{{ url('/quotations/create') }}" + "/" + id
        }else if ( document.getElementById(elname).value == "assign-quotation" )
        {
            alert('This functionality is to be added...')
//            window.location="{{ url('/quotations/create') }}" + "/" + id
        }
    }
</script>

@include('layouts.partials.scripts._datatables')

@stop