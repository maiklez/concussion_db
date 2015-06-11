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


			<h4>Author's Comments</h4>
    		
    		@foreach ($article->comments as $comments)
    			
    			<p>{{  $comments->comments}}</p>
    			
    		
    		<div>    
                <a href="{{ URL::to('articles/'.$article->id.'/'.$comments->id.'/destroycomment') }}" alt="destroy" class="">
                <i class="glyphicon glyphicon-remove-circle" alt="destroy" ></i></a>
            </div>

			@endforeach

			<!-- Notifications -->
        	@include('articles._form.addcomments')
    		
    		

	



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