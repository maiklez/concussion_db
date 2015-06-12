<?php namespace App\Http\Controllers\Articles;

use App\Models\User\User;
use App\Models\Author\Author;
use App\Models\Author\Affiliation;

use Illuminate\Http\Request;
use App\Http\Requests\AuthorCreateFormRequest;
use App\Models\User\UserStatistics;

use Auth;

trait AdminAuthors {

	
 	/**
     * Show the form for creating a new sequence.
     *
     * @return Response
     */
    public function getCreate()
    {
        // Title
        $title = 'New Author';

        // Show the page
        return view('authors/create_edit', compact('title'));
    }

    /**
     * Store a newly created sequence in storage.
     *
     * @return Response
     */
    public function postCreate(AuthorCreateFormRequest $request)
    {
        $author = new Author();
        $author->name = $request->get('name');
        $author->email = $request->get('email');
        
        $author->save();
		
        UserStatistics::ussave(Auth::user(), $author->id, 'author');
        
        return redirect('authors/'.$author->id.'/edit')->with('success', 'Your author has been created!');
    }

    /**
     * Show the form for creating a new sequence.
     *
     * @return Response
     */
    public function getEdit($id)
    {   
        $author=Author::findOrFail($id);
        
        UserStatistics::uslist(Auth::user(), $author->id, 'author');
        
        // Title
        $title = 'Edit Author';

        // Show the page
        return view('authors/create_edit', compact('author', 'title'));
    }

    /**
     * Store a newly created sequence in storage.
     * @param  integer $id The list ID
     * @return Response
     */
    public function postEdit($id, AuthorCreateFormRequest $request)
    {
        $author=Author::findOrFail($id);

        $author->name = $request->get('name');
        $author->email = $request->get('email');
        
        $author->save();
		
        UserStatistics::usupdate(Auth::user(), $author->id, 'author');
        
        return redirect('authors/'.$author->id.'/edit')->with('success', 'The author has been updated!');
    }
    
    /**
     * Store a newly created sequence in storage.
     * @param  integer $id The list ID
     * @return Response
     */
    public function postAddAffiliations($id, Request $request)
    {
    	$author=Author::findOrFail($id);
    	
    	$affiliation = new Affiliation();
    	$affiliation->affiliation = $request->get('affiliation');
    	$affiliation->affiliation_population = $request->get('population');
    	$affiliation->affiliation_country = $request->get('country');
    	
    	$author->affiliations()->save($affiliation);
    	UserStatistics::usupdate(Auth::user(), $author->id, 'author', 'postAddAffiliations');
    	
    	return redirect('authors/'.$author->id.'/edit')->with('success', 'Affiliation has been added!');
    }


    /**
     * Delete a list
     * @param  integer $id The list ID
     * @return Response
     */
    public function destroy($id)
    {
        $user = \Auth::user();
        $author=Author::findOrFail($id);
        $author->delete();
        return redirect('authors/index')
            ->with('success', 'Task deleted!');
    }


}
