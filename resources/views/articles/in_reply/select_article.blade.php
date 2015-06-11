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
            <li><a href="{{ url('articles/'.$article->id.'/show') }}">Article {{$article->id}}</a><span><i class="icon-right-open"></i></span></li></li>
            <li><a href="{{ url('articles/'.$article->id.'/inreply') }}">In Reply</a></li>
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
<!-- ./ notifications 

    los authors
    
    some info

    classifications

    coments

-->

	<h4>In Reply - Select Article</h4>
    		

       		
    @foreach ($articles as $artmp) 
                <div style="display: flex;">
                <p>{{$artmp->article_title}} </p>
                
                    
                    <a href="{{ URL::to('articles/'.$article->id.'/inreply/'.$artmp->id.'/select_article') }}" alt="select" class="">
                    <i class="glyphicon glyphicon-play" alt="select" ></i></a>
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