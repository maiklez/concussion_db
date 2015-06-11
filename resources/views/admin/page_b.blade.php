@extends('defaults/drake_lateral_navbar')


{{-- Web site Title --}}
@section('title')
Page B
@stop


<!-- breadcrumbs -->
@section('breadcrumbs')
	<ul class="breadcrumbs">
			<li><a href="{{ url('/') }}">Home</a> <span><i class="icon-right-open"></i></span></li>
			<li><a href="{{ url('admin/page_b') }}">Page B</a></li>
		</ul>
	
@stop
<!-- breadcrumbs -->


@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-7 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Page B</div>

				<div class="panel-body">
					You are logged in!
					<br>
					<br>
					I'm the Page BBBBBBBBBB
				</div>
			</div>
		</div>
	</div>
</div>
@endsection