@extends('defaults/drake_lateral_navbar')

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
	<div class="entry-content" itemprop="mainContentOfPage">
				<div class="section the_content">
		 
    
     <a href="{{ url('authors/create') }}" class="btn btn-success">New Author</a>

    <table id="articles" class="default"  data-page-length='25' style="margin-top: 15px;">
    <thead>

        <tr>
            <th class="col-md-2">Name</th>
            <th class="col-md-3">Affiliations</th>
            <th class="col-md-1">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($authors as $author)
        <tr>
            <td class="col-md-3">{{ $author->name }}</td>
            <td class="col-md-7" style="  text-align: left;">
                @foreach ($author->affiliations as $affiliation)
                   
                    <p>{{ $affiliation->affiliation}}</p>
                    <p>{{ $affiliation->population}}</p>
                    <p>{{ $affiliation->country}}</p>

                @endforeach
            </td>
            <td class="col-md-2">

                <div>
                    <a href="{{{ URL::to('authors/'.$author->id.'/edit') }}}" alt="Edit" class="">
                    <i class="glyphicon glyphicon-eye-open" alt="Edit" ></i></a>
                </div>
                 <div>    
                    <a href="{{{ URL::to('authors/'.$author->id.'/destroy') }}}" alt="destroy" class="">
                    <i class="glyphicon glyphicon-remove-circle" alt="destroy" ></i></a>
                </div>
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