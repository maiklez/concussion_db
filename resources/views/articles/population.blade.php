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


			<h4>Population</h4>
    		
    		@foreach ($population->ageRange as $range)
    			
    			<p>{!! $range->medium !!}({!! $range->minimum !!}, {!! $range->maximum !!}), {!! $range->name !!}</p>
    			
    		
    		<div>    
                <a href="{{ URL::to('articles/'.$article->id.'/'.$range->id.'/destroy_age_range') }}" alt="destroy" class="">
                <i class="glyphicon glyphicon-remove-circle" alt="destroy" ></i></a>
            </div>

			@endforeach
			
			@foreach ($population->sampleSize as $sample)
    			
    			<p>Sample Size: {!! $sample->size !!}, {!! $sample->option !!}</p>   			
    		
    		<div>    
                <a href="{{ URL::to('articles/'.$article->id.'/'.$sample->id.'/destroy_sample_size') }}" alt="destroy" class="">
                <i class="glyphicon glyphicon-remove-circle" alt="destroy" ></i></a>
            </div>

			@endforeach

			<!-- Age Range -->
        	@include('articles._form.add_age_range')
        	
        	<!-- Age Range -->
        	@include('articles._form.add_sample_size')
    		
    		

	



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