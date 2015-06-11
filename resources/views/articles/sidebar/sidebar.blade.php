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
		<li {{ (Request::is('articles/'.$article->id.'/objectives*') ? ' class=current_page_item' : '') }} >
							<a href="{{ url('articles/'.$article->id.'/objectives') }}">Objectives</a>
		</li>

		<li {{ (Request::is('articles/'.$article->id.'/recomendations*') ? ' class=current_page_item' : '') }} >
							<a href="{{ url('articles/'.$article->id.'/recomendations') }}">Recomendations</a>
		</li>
		<li {{ (Request::is('articles/'.$article->id.'/comments*') ? ' class=current_page_item' : '') }} >
							<a href="{{ url('articles/'.$article->id.'/comments') }}">Author's Comments</a>
		</li>

		<li {{ (Request::is('articles/'.$article->id.'/measures*') ? ' class=current_page_item' : '') }} >
							<a href="{{ url('articles/'.$article->id.'/measures') }}">Outcome Measures</a>
		</li>
		<li {{ (Request::is('articles/'.$article->id.'/results*') ? ' class=current_page_item' : '') }} >
							<a href="{{ url('articles/'.$article->id.'/results') }}">Results</a>
		</li>
		<li {{ (Request::is('articles/'.$article->id.'/implications*') ? ' class=current_page_item' : '') }} >
							<a href="{{ url('articles/'.$article->id.'/implications') }}">Implications</a>
		</li>
		<li {{ (Request::is('articles/'.$article->id.'/conclusions*') ? ' class=current_page_item' : '') }} >
							<a href="{{ url('articles/'.$article->id.'/conclusions') }}">Conclusions</a>
		</li>
		
		
@endif