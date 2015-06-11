<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Concussion</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<style>
        html,body {
            padding: 0px 0;
            height: 100%;
        }
        /* Wrapper for page content to push down footer */
		#wrap {
		  min-height: 100%;
		  height: auto;
		  /* Negative indent footer by its height */
		  margin: 0 auto -60px;
		  /* Pad bottom by footer height */
		  padding: 0 0 60px;
		}

		/* Set the fixed height of the footer here */
		#footer {
		  height: 60px;
		  background-color: #f5f5f5;
		  padding-top: 15px;
		}
		@section('styles')
		@show
	</style>

</head>
<body>
	
<!-- Wrap all page content here -->
<div id="wrap">

		<!-- navbar -->
		@include('partials.navbar')
		<!-- ./ navbar -->

	<!-- Container -->
	<div class="container" style="width:100%;" >

		<!-- breadcrumbs  -->
		@section('breadcrumbs')
			<!-- <ol class="breadcrumb">
					<li class="active">Home</li>
			</ol> -->			
		@show
		<!-- breadcrumbs -->




		<!-- Content -->
		@yield('content')
		<!-- ./ content -->


	</div>
	<!-- ./ container -->
</div>
	
	@include('partials.footer')



	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
