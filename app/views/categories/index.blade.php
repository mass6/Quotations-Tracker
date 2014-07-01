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
                        "sFileName": "categories.pdf",
                        "sPdfMessage": "Your custom message would go here."
                    },
                    {
                        "sExtends": "csv",
                        "sFileName": "categories.csv"
                    },
                    {
                        "sExtends": "xls",
                        "sFileName": "categories.xls"
                    }
                ]
            },
            "columnDefs": [ {
                "targets": 2,
                "width": "20%",
                "orderable" : false
            } ]
        });
    });
</script>


@stop

@section('content')

<div class="row">
    <div class="page-header">
        <h1>All Categories</h1>
        <p class="text-left">{{ link_to_route('categories.create', 'Add new category', null, array('class'=>'btn btn-info')) }}</p>
    </div>
    @if ($categories->count())
    <table id="datatable" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Options</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($categories as $category)
        <tr>
            <td>{{ $category->name }}</td>
            <td>{{ $category->description }}</td>
            <td>
                {{ Form::open(array('method' => 'DELETE', 'route' => array('categories.destroy', $category->id), 'class'=>'form-inline')) }}
                {{ link_to_route('categories.edit', 'Edit', array($category->id), array('class' => 'btn btn-primary')) }} {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    @else
    There are no categories
    @endif
</div>

@include('layouts.partials.scripts._datatables')
@stop