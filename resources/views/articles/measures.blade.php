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
{{-- Content --}}
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

    
            @include('articles._form.addmeasure')

            <h4>Outcome Measures</h4>

            @foreach ($article->outcome_measures as $outcome_measure)
            <div id="row">  
            <div style="display: -webkit-inline-box;">
                <p>{{  Helper::getPathList($outcome_measure) }}</p>
            
                
                <a href="{{ URL::to('articles/'.$article->id.'/'.$outcome_measure->id.'/destroymeasure') }}" alt="destroy" class="">
                <i class="glyphicon glyphicon-remove-circle" alt="destroy" ></i></a>
            </div>
            </div>
            
            @endforeach  	
    		
    		

	



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