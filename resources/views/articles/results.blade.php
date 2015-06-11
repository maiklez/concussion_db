@extends('defaults/drake_lateral_navbar')

{{-- Web site Title --}}
@section('title')
	{{{ $title }}} @parent
@stop

<!-- breadcrumbs -->
@section('breadcrumbs')
    <ul class="breadcrumbs">
            <li><a href="{{ url('/') }}">Home</a> <span><i class="icon-right-open"></i></span></li>
            <li><a href="{{ url('articles/index') }}">Articles</a> <span><i class="icon-right-open"></i></span></li></li>
            <li><a href="{{ url('articles/'.$article->id.'/show') }}">Article {{$article->id}}</a></li>
    </ul>
    
@stop


<!-- sidebar -->
{{-- sidebar --}}
@section('sidebar')
	@include('articles.sidebar.sidebar')	
@stop

{{-- Content --}}
@section('content')
	<div class="entry-content" itemprop="mainContentOfPage">
				<div class="section the_content">

			<!-- Notifications -->
            @include('partials.notifications')
            <!-- ./ notifications -->

            

			<h4>Results</h4>

    		@foreach ($article->results as $results) 
                <p>{{$results->result}} </p>
    		
                @if (!is_null($results->image_link))
                    <img alt="" src="{!! $results->image_link !!}" style="margin-top:-10px;">
                @endif
            <div>    
                <a href="{{ URL::to('articles/'.$article->id.'/'.$results->id.'/destroyresult') }}" alt="destroy" class="">
                <i class="glyphicon glyphicon-remove-circle" alt="destroy" ></i></a>
            </div>

			@endforeach


			<a href="#addresult" class="btn btn-success iframe">Add Result</a>
            <!-- Notifications -->
            @include('articles._form.addresult')    		
    		

	</div></div>
@stop

{{-- Scripts --}}
@section('scripts')


@stop

{{-- styles --}}
@section('styles')


@stop

{{-- datatables --}}
@section('datatables')



@stop