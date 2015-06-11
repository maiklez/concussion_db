@extends('defaults/drake_lateral_navbar')

{{-- Web site Title --}}
@section('title')
	{{{ $title }}} @parent
@stop

<!-- sidebar -->
{{-- Content --}}
@section('sidebar')
    <li {{ (Request::is('admin_users/statistics*') ? ' class=current_page_item' : '') }} >
                            <a href="{{ url('admin_users/statistics') }}">User Statistics</a>
    </li>  
@stop


{{-- Content --}}
@section('content')
	<div class="entry-content" itemprop="mainContentOfPage">
				<div class="section the_content">
		
			<div class="pull-right">
				<a href="{{{ URL::to('admin/users/create') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> Create</a>
			</div>
		
    

    <table id="roles" class="default"  data-page-length='25'>
    <thead>

        <tr>
            <th class="col-md-2">name</th>
            <th class="col-md-3">slug</th>
        </tr>
    </thead>
    <tbody>
    @foreach($roles as $role)
        <tr>
            <td class="col-md-2">{{ $role->role_title }}</td>
            <td class="col-md-3">{{ $role->role_slug }}</td>
        </tr>
    @endforeach
    </tbody>
    </table>

	<table id="users" class="row-border compact"  data-page-length='25'>
    <thead>
        <tr>
            <th class="col-md-2">first_name</th>
            <th class="col-md-3">email</th>
            <th class="col-md-3">role</th>
            <th class="col-md-3">created_at</th>
            <th class="col-md-3">actions</th>
        </tr>
    </thead>
    </table>



	</div></div>
@stop

{{-- Scripts --}}
@section('scripts')
	<script type="text/javascript">
$(document).ready(function() {
    oTable = $('#users').DataTable({
        "processing": true,
        "serverSide": true,
        "lengthChange": false,
        "searching": false,
        "ajax": "{{url('/admin_users/userdata')}}",
        "columns": [
            {data: 'first_name', name: 'first_name'},
            {data: 'email', name: 'email'},
            {data: 'rolename', name: 'role_id'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: ''}
        ]
    });
});
</script>
@stop

{{-- styles --}}
@section('styles')
	<link rel='stylesheet' href='http://cdn.datatables.net/plug-ins/1.10.6/integration/bootstrap/3/dataTables.bootstrap.css' type='text/css' media='all' />

@stop

{{-- datatables --}}
@section('datatables')

<script src="http://cdn.datatables.net/1.10.6/js/jquery.dataTables.min.js"></script>
<script src="{{asset('assets/js/datatables-bootstrap.js')}}"></script>
    <script src="{{asset('assets/js/datatables.fnReloadAjax.js')}}"></script>
@stop