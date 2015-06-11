<?php namespace App\Http\Controllers\Articles;

use App\Models\User\User;
use App\Models\Author\Author;

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
        $author->affiliations = $request->get('affiliations');
       
        $author->save();

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
        $title = 'New Author';

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
        $author->affiliations = $request->get('affiliations');

        $author->save();

        return redirect('authors/'.$author->id.'/edit')->with('success', 'Your author has been updated!');

        //return \Redirect::to('authors/'.$author->id.'/edit', 
        //    array($list->id))->with('message', 'Your author has been updated!');
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
