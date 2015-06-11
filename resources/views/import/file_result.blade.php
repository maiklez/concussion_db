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


        <div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
              <a href="?action=all" class="btn btn-default @if($action=='all' || is_null($action)) active @endif" role="button">All</a>
              <a href="?action=info" class="btn btn-default @if($action=='info') active @endif" role="button">Info</a>
              <a href="?type=all&action=not_found" class="btn btn-default @if($action=='not_found') active @endif" role="button">Not Found</a>
              <a href="?type=all&action=saved" class="btn btn-default @if($action=='saved') active @endif" role="button">Saved</a>
              <a href="?type=all&action=error" class="btn btn-default @if($action=='error') active @endif" role="button">Error</a>
        </div>

        @if($action=='not_found'||$action=='saved'||$action=='error')
            <div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
                  <a href="?type=all&action={!!$action !!}" 
                  class="btn btn-default @if($type=='all') active @endif" role="button">All</a>
            @foreach($atypes as $value)

                  <a href="?type={!!$value!!}&action={!!$action !!}" 
                  class="btn btn-default @if($type==$value) active @endif" role="button">{!!$value!!}</a>
            
            @endforeach
            </div>
        @endif

<div class="panel panel-primary">
          
            <div class="panel-heading">
                <h3 class="panel-title">
                   {{ $csv->file_name }}
                </h3>
            </div>
    


        <table id="results" class="default"  data-page-length='25' style="margin-top: 15px;">
        <thead>
            <tr>
                <th class="col-md-3">Data Type</th>
                <th class="col-md-2">Not Found</th>
                <th class="col-md-2">Saved</th>
                <th class="col-md-2">Error</th>
            </tr>
        </thead>
        <tbody>
        @foreach($csv->getCounters() as $val1)
            <tr>
                <th class="col-md-2">{{ $val1['type'] }}</th>
                <td class="col-md-2">{{ $val1['not_found'] }}</td>
                <td class="col-md-2">{{ $val1['saved'] }}</td>
                <td class="col-md-2">{{ $val1['error'] }}</td>
            </tr>
        @endforeach
        
            <tr>
                <th class="col-md-2"> TOTAL </th>
                <td class="col-md-2">{!! $csv->numNF() !!}</td>
                <td class="col-md-2">{!! $csv->numSaved() !!}</td>
                <td class="col-md-2"></td>
            </tr>
        </tbody>
        </table>
    <div class="panel-body">
        

        @foreach($logs as $article)
           @if(count($article)>0)<p> {{  $article[0]->article_title  }}  - {!! count($article) !!}  </p>@endif
            
        @endforeach
        
        <table id="results" class="default"  data-page-length='25' style="margin-top: 15px;">
        <thead>
            <tr>
                <th class="col-md-1">Action</th>
                <th class="col-md-4">Article Title</th>
                <th class="col-md-4">Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($logs as $article)
            @foreach($article as $log)
                <tr>
                    <td class="col-md-1">{{ $log->action }}</td>
                    <td class="col-md-4"> {{ $log->article_title }} </td>
                    <td class="col-md-4"><p> {{ $log->text_error }}</p>
                                        <p> {{ $log->cell_value }}</p>
                                        </td>
                </tr>
            @endforeach
        @endforeach
        </tbody>
        </table>

    </div>
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