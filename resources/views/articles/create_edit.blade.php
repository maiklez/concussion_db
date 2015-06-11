@extends('defaults/drake_subheader_default')

{{-- Web site Title --}}
@section('title')
	{{{ $title }}} @parent
@stop

<!-- breadcrumbs -->
@section('breadcrumbs')
    <ul class="breadcrumbs">
            <li><a href="{{ url('/') }}">Home</a> <span><i class="icon-right-open"></i></span></li>
            <li><a href="{{ url('articles/index') }}">Articles</a> 
		@if (isset($article)) 
            <span><i class="icon-right-open"></i></span></li>		
            <li><a href="{{ url('articles/'.$article->id.'/show') }}">Article {{$article->id}}</a></li>
        @else
			</li>
        @endif
    </ul>
    
@stop
<!-- breadcrumbs -->

{{-- Content --}}
@section('content')


<!-- Notifications -->
@include('partials.notifications')
<!-- ./ notifications -->

@if (count($errors) > 0)
    <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
        There were some problems with your input.<br />
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h2>{!! $title !!}</h2>
@if (isset($article)) 
{!! 
link_to('articles/' . $article->id . '/show', $title = 'Show', $attributes = array('class'=>'btn btn-success'), $secure = null)
!!} 
@endif


<div class="" style="margin-left: 20px; width:100%;">


<form class="form-horizontal" method="post" action="@if (isset($article)){{ URL::to('articles/' . $article->id . '/edit') }}@endif" autocomplete="off">
		<!-- CSRF Token   @if (isset($article)){{ URL::to('article/' . $article->id . '/edit') }}@endif-->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->





@include('articles._form.information')


		
			
		

<!-- dasdasdasda@include('articles._form.coauthor') -->
		


	    {!! Form::submit('Submit', ['class'=>'btn primary']) !!}

</form>
</div>

@stop

@section('styles')

@stop


{{-- Scripts --}}
@section('scripts')
	@include('articles._form.information')

	

@stop