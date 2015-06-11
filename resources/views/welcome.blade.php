@extends('defaults/drake_default')

@section('content')

	
	<div class="entry-content" itemprop="mainContentOfPage">					

					

					<!-- drake_photo_title -->
					@include('widgets.drake_photo_title')
					<!-- ./ drake_photo_title -->

					
					@include('auth.login_form')
					

					


		<div class="section the_content"></div>			
	</div>


	

@endsection
