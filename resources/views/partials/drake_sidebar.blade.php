





<!-- .four-columns - sidebar -->
<div class="sidebar sidebar-1 four columns">
	<div class="widget-area clearfix ">
		<aside id="widget_mfn_menu-2" class="widget widget_mfn_menu"><h3>@yield('title')</h3>
		<ul class="menu">

		@section('sidebar')
		@show
		
		<li {{ (Request::is('contact_us') ? ' class=current_page_item' : '') }} ><a href="{{ url('contact_us') }}">Contact Us</a></li>
		</ul>
		</aside>
	</div>
</div>