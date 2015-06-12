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
<!-- breadcrumbs -->

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
        @include('articles._form.coauthor')

            <div style="display: -webkit-box; max-width: 850px;">
    			<h2>{{$article->article_title}}</h2> 
                {!! 
                link_to('articles/' . $article->id . '/edit', $title = 'Edit', 
                        $attributes = array('class'=>'btn btn-success'), $secure = null)
                !!}
            </div>

            <h6>{!!$article->doi_number!!}</h6>
            <h6>{!!$article->crossref_link!!}</h6>

            <h5>Year {{$article->year}}, Volume {{$article->volume}}, Issue {{$article->issue}}</h5>
            
            <h5>Page Range  ({{$article->page_range_min}}, {{$article->page_range_max}})</h5>

            <p>key finding: {{$article->key_finding}}</p>


    		<p>{{$article->journal_title}}</p>

            <h4>Article type</h4>
            @foreach ($article->type as $types)
                
                <p>{{ Helper::getPathList( $types)}}</p>
            @endforeach

            <h4>Article classification</h4>
            @foreach ($article->classification as $class)
                
                <p>{{ Helper::getPathList( $class)}}</p>
            @endforeach

                        
            <h4>Study Population</h4>
            <p>{{Helper::getPathList( $article->population->type)}}</p>
            <p>{{Helper::getPathList( $article->population->classification)}}</p>


            <h4>Study Objectives</h4>
            @foreach ($article->objectives as $objective)                
                <p>{{ $objective->objective }}</p>
            @endforeach

            
    		<h4>Implications</h4>
            @foreach ($article->implications as $implication)
    			
    			<p>{{ Helper::getPathList( $implication)}}</p>
			@endforeach
           
           <h4>Outcome Measures</h4>
            @foreach ($article->outcome_measures as $measure)
                
                <p>{{ Helper::getPathList( $measure)}}</p>
            @endforeach

            <div class="actions">
                    <a href="#addcoauthor" class="btn btn-success iframe">Add Coauthor</a>
                    <a href="{{ url('articles/'.$article->id.'/results') }}" class="btn btn-success iframe">Add Results</a>
                    <a href="{{ url('articles/'.$article->id.'/conclusions') }}" class="btn btn-success iframe">Add Conclusions</a>
            </div>

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