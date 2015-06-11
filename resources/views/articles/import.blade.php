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

{{-- Content --}}
@section('content')
	<div class="entry-content" itemprop="mainContentOfPage">
				<div class="section the_content">
		 
    
    <a href="{{ url('articles/create') }}" class="btn btn-success">New Article</a>

    <p> {{count($errors) }}  Sheets</p>
    @foreach($errors as $sheet)
        <div class="sheet">
        <p> {{count($sheet) }}  Articles</p>
        @foreach($sheet as $error1)
            <hr>
            <div class="article">
            <p> {{count($error1) }}  Messages</p>
            @foreach($error1 as $error2)
                <div class="message">
                    <p>Type: {!! $error2->action !!}  </p>
                    <p>Title: {!! $error2->article_title !!}  </p>
                    <p>Text: {!! $error2->text_error !!}  </p>
                    <p>CellType: {!! $error2->cell_type !!}  </p>
                    <p>CellValue: {!! $error2->cell_value !!}  </p>
                </div>
                <hr>
            @endforeach
            </div>

        @endforeach
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