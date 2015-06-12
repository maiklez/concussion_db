@if (Auth::user()->can('can_articles'))
		<li {{ (Request::is('articles/'.$article->id.'/show*') ? ' class=current_page_item' : '') }} >
							<a href="{{ url('articles/'.$article->id.'/show') }}">Article</a>
		</li>

		@if($article->hasInReply())
		<li {{ (Request::is('articles/'.$article->id.'/inreply*') ? ' class=current_page_item' : '') }} >
							<a href="{{ url('articles/'.$article->id.'/inreply') }}">In Reply</a>
		</li>
		@endif

		<li {{ (Request::is('articles/'.$article->id.'/author*') ? ' class=current_page_item' : '') }} >
							<a href="{{ url('articles/'.$article->id.'/author') }}">Author</a>
		</li>
		
		<li {{ (Request::is('articles/'.$article->id.'/population*') ? ' class=current_page_item' : '') }} >
							<a href="{{ url('articles/'.$article->id.'/population') }}">Study Population</a>
		</li>
		
		<li {{ (Request::is('articles/'.$article->id.'/objectives*') ? ' class=current_page_item' : '') }} >
							<a href="{{ url('articles/'.$article->id.'/objectives') }}">Objectives</a>
		</li>

		<li {{ (Request::is('articles/'.$article->id.'/measures*') ? ' class=current_page_item' : '') }} >
							<a href="{{ url('articles/'.$article->id.'/measures') }}">Outcome Measures</a>
		</li>
		
		<li {{ (Request::is('articles/'.$article->id.'/implications*') ? ' class=current_page_item' : '') }} >
							<a href="{{ url('articles/'.$article->id.'/implications') }}">Implications</a>
		</li>
		
		
@endif