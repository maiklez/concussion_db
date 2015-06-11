@extends('defaults/drake_lateral_navbar')

{{-- Web site Title --}}
@section('title')
	{{{ $title }}} @parent
@stop

<!-- breadcrumbs -->
@section('breadcrumbs')
    <ul class="breadcrumbs">
            <li><a href="{{ url('/') }}">Home</a> <span><i class="icon-right-open"></i></span></li>
            <li><a href="{{ url('articles/index') }}">Articles</a></li>
    </ul>
    
@stop
<!-- breadcrumbs -->

<!-- sidebar -->
{{-- Content --}}
@section('sidebar')
    <li {{ (Request::is('import/results*') ? ' class=current_page_item' : '') }} >
                            <a href="{{ url('import/results') }}">Import Results</a>
    </li>  
@stop

{{-- Content --}}
@section('content')
	<div class="entry-content" itemprop="mainContentOfPage">
				<div class="section the_content">
		 
    
    <a href="{{ url('articles/create') }}" class="btn btn-success">New Article</a>
    <a href="{{ url('articles/import') }}" class="btn btn-success">Import Article</a>

    <table id="articles" class="default"  data-page-length='25' style="margin-top: 15px;">
    <thead>

        <tr>
            <th class="col-md-2">Title</th>
            <th class="col-md-3">Journal</th>
            <th class="col-md-1">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($articles as $article)
        <tr>
            <td class="col-md-4">{{ $article->article_title }}</td>
            <td class="col-md-2"><a href="{{ $article->crossref_link }}">{{ $article->journal_title }}</a></td>
            <td class="col-md-4">
                <a href="{{{ URL::to('articles/'.$article->id.'/show') }}}" alt="Show" class="">
                <i class="glyphicon glyphicon-eye-open" alt="Show" ></i></a>

                <a href="{{{ URL::to('articles/'.$article->id.'/edit') }}}" alt="Edit" class="">
                <i class="glyphicon glyphicon-pencil" alt="Edit" ></i></a>

                 
            </td>
        </tr>
    @endforeach
    </tbody>
    </table>

	



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