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
		
    

{!! Form::open(array('url'=>'admin_users/statistics','class'=>'ajax form-horizontal', 'method'=> 'POST')) !!}
<!-- CSRF Token-->
<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
<!-- ./ csrf token -->

<div class="form-group {{{ $errors->has('author') ? 'error' : '' }}}">
    
        {!!
        $iidate = '';
        if(isset($idate) && $idate!='') $iidate = $idate->format('d/m/Y H:i:s');
        !!}
		{!! Form::text('idate', $iidate, array('class' => 'form-control','placeholder' => 'Initial Date','id' => 'datetimepicker1')) !!}

		
		{!!
        $ffdate = '';
        if(isset($fdate) && $fdate!='') $ffdate = $fdate->format('d/m/Y H:i:s');
        !!}
		{!! Form::text('fdate', $ffdate, array('class' => 'form-control','placeholder' => 'Final Date','id' => 'datetimepicker2')) !!}
		
		{!! Form::submit('Search', array('class'=>'btn btn-success','id'=>'mdl_save_change'))!!}
	
		{!! $errors->first('dates', '<span class="help-block">:message</span>') !!}
</div>
{!! Form::close() !!}
    
    <table id="roles" class="default"  data-page-length='25'>
    <thead>

        <tr>
            <th class="col-md-2">User</th>
            <th class="col-md-3">activity</th>
            <th class="col-md-3">data_type</th>
            <th class="col-md-3">query</th>
            <th class="col-md-3">Time</th>
        </tr>
    </thead>
    <tbody>
    @foreach($stats as $stat)
        <tr>
            <td class="col-md-2">{{ $stat->the_user->first_name }}</td>
            <td class="col-md-3">{{ $stat->activity }}</td>
            <td class="col-md-3">{{ $stat->data_type }}</td>
            {!! 
             $sal = '';
             if (!is_null($stat->article)) $sal = $stat->article_worked->article_title;
             elseif (!is_null($stat->author)) $sal = $stat->author_worked->name;
             elseif (!is_null($stat->user)) $sal = $stat->user_worked->first_name;
             elseif($stat->activity!='list') $sal = $stat->query;
             !!}
            <td class="col-md-3">{!! $sal !!}</td>
            <td class="col-md-3">{{ $stat->created_at }}</td>
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

<script>
$('#datetimepicker1').datetimepicker({
	formatTime:'H:i:s',
	formatDate:'d.m.Y',
	format: 'd/m/Y H:i:s',
	//defaultDate:'8.12.1986',
	defaultTime:'00:00:00',
	timepickerScrollbar:false
});
$('#datetimepicker2').datetimepicker({
	formatTime:'H:i:s',
	formatDate:'d.m.Y',
	format: 'd/m/Y H:i:s',
	//defaultDate:'8.12.1986',
	defaultTime:'23:59:59',
	timepickerScrollbar:false
});
</script>

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
	<link rel="stylesheet" href="{{asset('assets/css/jquery.datetimepicker.css')}}">
	
	<link rel='stylesheet' href='http://cdn.datatables.net/plug-ins/1.10.6/integration/bootstrap/3/dataTables.bootstrap.css' type='text/css' media='all' />

@stop

{{-- datatables --}}
@section('datatables')
<script src="{{asset('assets/js/jquery.datetimepicker.js')}}"></script>

<script src="http://cdn.datatables.net/1.10.6/js/jquery.dataTables.min.js"></script>
<script src="{{asset('assets/js/datatables-bootstrap.js')}}"></script>
<script src="{{asset('assets/js/datatables.fnReloadAjax.js')}}"></script>

@stop