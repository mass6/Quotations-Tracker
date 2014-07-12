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
                "sSwfPath": "{{ URL::asset('/js/datatables/copy_csv_xls_pdf.swf') }}",
                "aButtons": [
                    "print",
                    {
                        "sExtends": "pdf",
                        "sFileName": "users.pdf"
                    },
                    {
                        "sExtends": "csv",
                        "sFileName": "users.csv"
                    },
                    {
                        "sExtends": "xls",
                        "sFileName": "users.xls"
                    }
                ]
            },
            "columnDefs": [ {
                "targets": [4,5],
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
   	<h1>All Users</h1>
   	<p class="text-left">{{ link_to_route('admin.users.create', 'Add new user', null, array('class'=>'btn btn-info')) }}</p>
   	</div>
   @if ($users->count())
       <table id="datatable" class="table table-striped table-bordered">
			<thead> 
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>Groups</th>
					<th>Actions</th>
					<th></th>
			    </tr>
			</thead>
			<tbody>
			@foreach ($users as $user)
			    <tr>
					<td>{{ $user->first_name }}</td>
					<td>{{ $user->last_name }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ getGroupMemberships($user->id) }}</td>
					<td>{{ link_to_route('admin.users.edit', 'Edit', array($user->id), array('class' => 'btn btn-primary')) }}</td>
					<td>
			          	{{ Form::open(array('method' => 'DELETE', 'route' => array('admin.users.destroy', $user->id))) }}
			            	{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                       	{{ Form::close() }}
                   </td>
               </tr>
           	@endforeach
			</tbody>
       </table>
       <div>
       	{{-- $users->links() --}}
       </div>
   @else
       There are no users
   @endif
   </div>
@stop