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
            
            <div id="slogan">
    			<h5>{{$article->author->name}}</h5>
                <a href="mailto:{{$article->author->email}}" style="float:right;">{{$article->author->email}}</a> 

                @foreach ($article->author->affiliations as $affiliation)
                   
                    <h6>{{ $affiliation->affiliation}}</h6>
                    <h6>{{ $affiliation->population}}</h6>
                    <h6>{{ $affiliation->country}}</h6>

                @endforeach
    		</div>
            <hr>
    		<h3>Coauthors</h3>
    		@foreach ($article->coauthors as $coauthors)
    			
                <div id="slogan">
        			<h5>{{  $coauthors->name}}</h5>
                    <div>
                        @foreach ($coauthors->affiliations as $affiliation)
                       
                            <h6>{{ $affiliation->affiliation}}</h6>
                            <h6>{{ $affiliation->population}}</h6>
                            <h6>{{ $affiliation->country}}</h6>

                        @endforeach
        		 
            		    
                        <a href="{{ URL::to('articles/'.$article->id.'/'.$coauthors->id.'/destroycoauthor') }}" alt="destroy" class="">
                        <i class="glyphicon glyphicon-remove-circle" alt="destroy" ></i></a>
                    </div>
                </div>
                <hr>
			@endforeach

			<a href="#addcoauthor" class="btn btn-success iframe">Add Coauthor</a>
			<!-- Notifications -->
        	@include('articles._form.coauthor')
    		
    		

	



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