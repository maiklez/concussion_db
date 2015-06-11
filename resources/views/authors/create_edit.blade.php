@extends('defaults/drake_subheader_default')

{{-- Web site Title --}}
@section('title')
	{{{ $title }}} @parent
@stop

<!-- breadcrumbs -->
@section('breadcrumbs')
    <ul class="breadcrumbs">
            <li><a href="{{ url('/') }}">Home</a> <span><i class="icon-right-open"></i></span></li>
            <li><a href="{{ url('authors/index') }}">Authors</a></li>
    </ul>
    
@stop
<!-- breadcrumbs -->

{{-- Content --}}
@section('content')

	{{-- Edit Data Model Form --}}

<!-- Notifications -->
@include('partials.notifications')
<!-- ./ notifications -->



<div class="col-md-12">


<form class="form-horizontal" method="post" action="@if (isset($author)){{ URL::to('authors/' . $author->id . '/edit') }}@endif" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

<h2>Create an Author</h2>



<div class="form-group {{{ $errors->has('name') ? 'error' : '' }}}">
    {!! Form::label('Author Name') !!}
    {!! Form::text('name', Input::old('name', isset($author) ? $author->name : null), 
    													array('class'=>'form-control', 'placeholder'=>'Name')) !!}
    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
</div>

@if(isset($author))
<div class="form-group {{{ $errors->has('affiliations') ? 'error' : '' }}}">
    
    <a href="#addaffiliation" class="btn btn-success iframe">Add Affiliation</a>

    @include('authors._form.addaffiliation')
    
    {!! Form::label('Author Affiliations') !!}
    @foreach ($author->affiliations as $affiliation)
        <div>    
            <a href="{{ URL::to('articles/'.$author->id.'/'.$affiliation->id.'/destroyaffiliation') }}" alt="destroy" class="">
            <i class="glyphicon glyphicon-remove-circle" alt="destroy" ></i></a>
        </div>           
        <p>{{ $affiliation->affiliation}}</p>
        <p>{{ $affiliation->affiliation_population}}</p>
        <p>{{ $affiliation->affiliation_country}}</p>

    @endforeach

</div>
@endif

<div class="form-group">
    {!! Form::submit('Submit', ['class'=>'btn primary']) !!}
</div>

</form>
</div>

@stop

@section('styles')

@stop


{{-- Scripts --}}
@section('scripts')
	
	<script type="text/javascript">
	
	</script>

@stop