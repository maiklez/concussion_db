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
<!-- ./ notifications 

    los authors
    
    some info

    classifications

    coments

-->

			<h4>In Reply</h4>
    		

        <div class="" style="margin-left: 20px; width:100%;">
            <form class="form-horizontal" method="post" action="@if (isset($article)){{ URL::to('articles/' . $article->id . '/updateinreply') }}@endif" autocomplete="off">
                <!-- CSRF Token   @if (isset($article)){{ URL::to('article/' . $article->id . '/edit') }}@endif-->
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <!-- ./ csrf token -->

                @include('articles._form.in_reply')

                {!! Form::submit('Submit', ['class'=>'btn primary']) !!}

            </form>
        </div>


    		@foreach ($inreply->comments as $comment)
    			<div> 
        			<p>{{  $comment->comments}}</p>		
        		
        		   
                    <a href="{{ URL::to('articles/'.$article->id.'/inreply/'.$comment->id.'/destroyinreplycomment') }}" alt="destroy" class="">
                    <i class="glyphicon glyphicon-remove-circle" alt="destroy" ></i></a>
                </div>

			@endforeach

			{!! FormCreator::inReplyCommentsForm($article, $errors) !!} 		
    		

	



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