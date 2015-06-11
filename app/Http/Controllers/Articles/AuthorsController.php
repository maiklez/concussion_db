<?php namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;

use App\Models\User\User;
use App\Models\Author\Author;
use App\Models\User\UserStatistics;

use Auth;

class AuthorsController extends Controller {

	use AdminAuthors;
    
    /**
     * User Model
     * @var User
     */
    protected $user;


    /**
     * User Model
     * @var Author
     */
    protected $author;


	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Author $author)
	{
		$this->middleware('auth');

		$this->user = $user;
        $this->author = $author;
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		 // Title
        $title = 'Authors';

        // Grab all the users
        $user = $this->user;
        
        $authors = Author::orderby('name')->get();
        
        UserStatistics::search(Auth::user(), 'author', 'all');

		return view('authors/index' , compact('user', 'authors', 'title'));
	}

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function getAuthor($author_id)
    {
         // Title
        $title = 'Show Authors';

        // Grab all the users
        $user = $this->user;

        $author = Author::find($author_id);
		
        UserStatistics::uslist(Auth::user(), $author->id, 'author');
        
        // Title
        $title = $author->name;


        return view('authors/show' , compact('user',  'author',  'title'));
    }


}
