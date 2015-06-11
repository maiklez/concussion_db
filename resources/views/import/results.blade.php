@extends('defaults/drake_lateral_navbar')

{{-- Web site Title --}}
@section('title')
	{{{ $title }}} @parent
@stop

<!-- breadcrumbs -->
@section('breadcrumbs')
    <ul class="breadcrumbs">
            <li><a href="{{ url('/') }}">Home</a> <span><i class="icon-right-open"></i></span></li>
            <li><a href="{{ url('import/results') }}">Import Results</a></li>
    </ul>
    
@stop
<!-- breadcrumbs -->

{{-- Content --}}
@section('content')
	<div class="entry-content" itemprop="mainContentOfPage">
				<div class="section the_content">
		 
   
    @foreach($results as $csv)
        
        <div class="panel panel-primary">
          
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a href="{{ url('import/'. $csv->id .'/file_results') }}" class="">{{ $csv->file_name }}</a>
                </h3>
            </div>
          <div class="panel-body">            

            <p>Articles <span class="badge">{!! $csv->numArticles() !!}</span> <span class="badge" style="background-color:#00550f;">{!! $csv->numArticlesSaved() !!}</span></p>
            <p> Items Saved <span class="badge" style="background-color:#00550f;">{!! $csv->numSaved() !!}</span> </p>
            <p> Items Not Found <span class="badge" style="background-color:#9a0b09;">{!! $csv->numNF() !!}</span> </p>
            
          </div>
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