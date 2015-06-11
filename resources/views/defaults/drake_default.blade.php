<!DOCTYPE html>
<html lang="en-US" itemscope="itemscope" itemtype="http://schema.org/WebPage">

<!-- head -->
<head>

<!-- meta -->
<meta charset="UTF-8" />

<title>Concussion Database</title>

<meta name="description" content="At Concussion Database, we aim to improve measures for participant safety in contact sports by furthering research for sports related concussion." />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="shortcut icon" href="http://www.drakefoundation.org/wp-content/uploads/2015/02/Drake-Favicon.jpg" type="image/x-icon" />	

<!-- wp_head() -->
<script>
//<![CDATA[

//]]>
</script>

<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

<link href="{{ asset('/css/drake_theme/theme.css') }}" rel="stylesheet">
<link href="{{ asset('/css/drake_theme/theme_mficons.css') }}" rel="stylesheet">

<link href="{{ asset('/css/drake_theme/theme_grid.css') }}" rel="stylesheet">
<link href="{{ asset('/css/drake_theme/theme_layout.css') }}" rel="stylesheet">
<link href="{{ asset('/css/drake_theme/theme_variables.css') }}" rel="stylesheet">
<link href="{{ asset('/css/drake_theme/theme_style_colors.css') }}" rel="stylesheet">
<link href="{{ asset('/css/drake_theme/shortcodes.css') }}" rel="stylesheet">
<link href="{{ asset('/css/drake_theme/responsive.css') }}" rel="stylesheet">
<link href="{{ asset('/css/drake_theme/theme_style.css') }}" rel="stylesheet">

<!-- fonts -->
<link rel='stylesheet' id='Lato-css'  href='http://fonts.googleapis.com/css?family=Lato&#038;ver=4.1.1' type='text/css' media='all' />
<link rel='stylesheet' id='Roboto-css'  href='http://fonts.googleapis.com/css?family=Roboto&#038;ver=4.1.1' type='text/css' media='all' />
<link rel='stylesheet' id='Patua+One-css'  href='http://fonts.googleapis.com/css?family=Patua+One&#038;ver=4.1.1' type='text/css' media='all' />



<link rel='canonical' href='http://www.drakefoundation.org/' />
<link rel='shortlink' href='http://www.drakefoundation.org/' />



<link href="{{ asset('/css/theme_body.css') }}" rel="stylesheet">

@section('styles')
@show

<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

<!-- Simple Google Analytics Begin -->
<script>
	 
</script>
<!-- Simple Google Analytics End -->


<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<!-- end head -->

<!-- body -->
<body class="home page page-id-1748 page-template-default  color-custom layout-boxed header-below minimalist-header sticky-white nice-scroll-on hide-title-area subheader-title-left">
	
	<!-- mfn_hook_top --><!-- mfn_hook_top -->	
		
		
	<!-- #Wrapper -->
	<div id="Wrapper">
	
				
			
		<!-- navbar -->
		@include('partials.drake_navbar')
		<!-- ./ navbar -->
	
<!-- #Content -->
<div id="Content">
	<div class="content_wrapper clearfix">

		<!-- .sections_group -->
		<div class="sections_group">
		
			<!-- Content -->
			@yield('content')
			<!-- ./ content -->
			
				
		</div>
		
		<!-- .four-columns - sidebar -->
		
	</div>
</div>
<!-- #Content end -->		


<!-- mfn_hook_content_after --><!-- mfn_hook_content_after -->
<!-- #Footer -->
@include('partials.drake_footer')	


</div><!-- #Wrapper -->


<!-- mfn_hook_bottom --><!-- mfn_hook_bottom -->	
<!-- wp_footer() -->


	<!-- Javascripts -->
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script> -->
    <script src="{{asset('assets/js/wysihtml5/wysihtml5-0.3.0.js')}}"></script>
    <script src="{{asset('assets/js/wysihtml5/bootstrap-wysihtml5.js')}}"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/js/datatables-bootstrap.js')}}"></script>
    <script src="{{asset('assets/js/datatables.fnReloadAjax.js')}}"></script>
    <script src="{{asset('assets/js/jquery.colorbox.js')}}"></script>
    <script src="{{asset('assets/js/prettify.js')}}"></script>    

    <script type="text/javascript">
    	$('.wysihtml5').wysihtml5();
        $(prettyPrint);
    </script>


    @yield('scripts')


</body>
</html>