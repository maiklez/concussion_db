<!-- #Header_bg -->
<div id="Header_wrapper" >

	<!-- #Header -->
	<header id="Header">
		

		<!-- .header_placeholder 4sticky  -->
		<div class="header_placeholder"></div>

		<div id="Top_bar">
			<div class="container">
				<div class="column one">

				
		<!-- #menu izquierda -->
		<div class="top_bar_left clearfix">
					
						<!-- .logo -->
						<div class="logo">
							<h1><a id="logo" href="{{url('/')}}" title="The Concussion Repository">
							<img class="scale-with-grid" src="{{asset('assets/img/Concussion-logo.png')}}" alt="The Concussion Repository" /></a></h1>				
							</div>
					
						<div class="menu_wrapper">
		<nav id="menu" class="menu-main-menu-container"><ul id="menu-main-menu" class="menu">

		<li id="menu-item-1772" {{ ((Request::is('home')||Request::is('/')) ? ' class=current-menu-item ' : '') }} >
				<a href="{{ url('/') }}"><span>Home</span></a></li>
		
		@if (!Auth::guest())
			
			@section('navbar')
			@show
			
			@if (Auth::user()->can('can_articles'))
			<li id="menu-item-1773" {{ (Request::is('articles/*') ? ' class=current-menu-item current_page_item' : '') }} >
					<a href="{{ url('articles/index') }}"><span>Articles</span></a></li>
			@endif
			@if (Auth::user()->can('can_articles'))
			<li id="menu-item-1774" {{ (Request::is('authors/*') ? ' class=current-menu-item current_page_item' : '') }}>
					<a href="{{ url('authors/index') }}"><span>Authors</span></a></li>
			@endif

			@if (Auth::user()->can('can_users'))
			<li id="menu-item-1774" {{ (Request::is('admin_users/index') ? ' class=current-menu-item current_page_item' : '') }}>
					<a href="{{ url('admin_users/index') }}"><span>Admin Users</span></a></li>
			@endif

			<li id="menu-item-1776" class="">
					<a href="{{ url('/contact_us') }}"><span>Contact Us</span></a></li>
		@endif

		</ul>

		</nav>
		<a class="responsive-menu-toggle " href="#"><i class="icon-menu"></i></a>					
						</div>			
						
						<div class="secondary_menu_wrapper">
							<!-- #secondary-menu -->
						</div>
						
						<div class="banner_wrapper">
						</div>
						
						<div class="search_wrapper">							
						</div>				
						
		</div>
					
					<!-- #menu derecha -->
		<div class="top_bar_right clearfix">					
			<div class="menu_wrapper">
			<nav id="menu" class="menu-main-menu-container">
			
				<ul id="menu-main-menu" class="menu">
				
				@if (Auth::guest())						
						<li {{ (Request::is('auth/login') ? ' class=current-menu-item current_page_item' : '') }}><a href="{{ url('/auth/login') }}"><span>Login</span></a></li>
						<li {{ (Request::is('auth/register') ? ' class=current-menu-item current_page_item' : '') }}><a href="{{ url('/auth/register') }}"><span>Register</span></a></li>
				@else
					<li><a>Logged as {{ Auth::user()->first_name }}</a></li>
					<li><a href="{{ url('/auth/logout') }}"><span>Logout</span></a></li>					
				@endif
				
				</ul>
			</nav>
		<a class="responsive-menu-toggle " href="#"><i class="icon-menu"></i></a>					
						</div>			
						
						<div class="secondary_menu_wrapper">
							<!-- #secondary-menu -->
						</div>
						
						<div class="banner_wrapper">
						</div>
						
						<div class="search_wrapper">							
						</div>				
						
					</div>
								
				</div>


				
			</div>
		</div>	
	</header>

	<!-- navbar -->
		@include('partials.drake_subheader')
	<!-- ./ navbar -->

</div>