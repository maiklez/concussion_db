	<nav class="navbar navbar-default ">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"  style="margin-top: -10px;">Concussion<br>Repository</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Home</a></li>
					@if (!Auth::guest())
						@if (Auth::user()->can('can_a'))
						<li{{ (Request::is('admin/page_a') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/page_a') }}}"><span class="glyphicon glyphicon-chevron-right"></span> Page A</a></li>
						@endif
						@if (Auth::user()->can('can_b'))
						<li{{ (Request::is('admin/page_b') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/page_b') }}}"><span class="glyphicon glyphicon-chevron-right"></span> Page B</a></li>
						@endif
					@endif		
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->first_name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								@if (Auth::user()->can('can_a'))
								<li{{ (Request::is('admin/page_a') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/page_a') }}}"><span class="glyphicon glyphicon-chevron-right"></span> Page A</a></li>
								@endif
								@if (Auth::user()->can('can_b'))
								<li{{ (Request::is('admin/page_b') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/page_b') }}}"><span class="glyphicon glyphicon-chevron-right"></span> Page B</a></li>
								@endif
								

								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>