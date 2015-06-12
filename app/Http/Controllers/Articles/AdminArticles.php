<?php namespace App\Http\Controllers\Articles;

use Illuminate\Http\Request;
use App\Models\User\User;
use Debugbar;
use DB;
use Excel;
use Auth;

use ArticleService;

use App\Http\Requests\ComparativeFormRequest;
use App\Http\Requests\ArticleCreateFormRequest;

use App\Models\Author\Author;

use App\Models\ImportCSV\ImportCSV;

use App\Models\Article\Article;
use App\Models\Article\AgeRange;
use App\Models\Article\Biomarker;
use App\Models\Article\Comparative;
use App\Models\Article\Conclusion;
use App\Models\Article\ImplicationStudy;
use App\Models\Article\StudyMethod;
use App\Models\Article\StudyObjectives;
use App\Models\Article\StudyPopulation;
use App\Models\Article\StudyResult;
use App\Models\Article\CommentsInReply;
use App\Models\Article\Comments;
use App\Models\Article\StudyRecomendations;

use App\Models\Lists\ArticleClass;
use App\Models\Lists\ArticleType;
use App\Models\Lists\ImplicationStudyList;
use App\Models\Lists\OutcomeMeasureList;
use App\Models\Lists\PopulationType;
use App\Models\Lists\PopulationClass;
use App\Models\Lists\Gender;
use App\Models\User\UserStatistics;

trait AdminArticles {

	

    /**
     * Show the form for creating a new sequence.
     *
     * @return Response
     */
    public function getImport()
    {
         // Title
        $title = 'Import Articles';

        // Grab all the users
        $user = $this->user;
        
        //https://docs.google.com/spreadsheets/d/1I23X3cuYSEBDQq_oVTh6JhShwuKKT5J6gPiuFT82G9I/export?format=csv&id=1I23X3cuYSEBDQq_oVTh6JhShwuKKT5J6gPiuFT82G9I&gid=0
        //$sal = (file_get_contents('https://docs.google.com/spreadsheets/d/1I23X3cuYSEBDQq_oVTh6JhShwuKKT5J6gPiuFT82G9I/export?format=csv&id=1I23X3cuYSEBDQq_oVTh6JhShwuKKT5J6gPiuFT82G9I&gid=0'));

        //Debugbar::info($sal);
        $results  = [];
        $excelFile = null;
        //$excelFile = \Excel::load($sal)->toObject();
        $errors = [];
        try{
            
            $errortmp = ArticleService::importArticles($excelFile);
            array_push($errors, $errortmp);
            
            //$error_data = new ImportCSV();

        }catch(Exception $ex){
            Debugbar::error($ex);
        }       
        //Debugbar::alert($errors);


        

        $articles = Article::get();
       
        //return redirect('articles/index')
        //            ->with('success', 'Article Created');
        return view('articles/import' , compact('user', 'articles', 'title', 'errors'));
    }



 	/**
     * Show the form for creating a new sequence.
     *
     * @return Response
     */
    public function getCreate()
    {
        // Title
        $title = 'New Article';

        // Show the page
        return view('articles/create_edit', compact('title'));
    }

    /**
     * Store a newly created sequence in storage.
     *
     * @return Response
     */
    public function postCreate(ArticleCreateFormRequest $request)
    {
        Debugbar::info($request->input());

       
        //year
        //volume
        //issue
        //page_range_min
        //page_range_max
        //design
        //summary
        
        try{
            DB::beginTransaction();

            $article = Article::createArticle($request);           

            $article->updatePopulation($request);           
            
            UserStatistics::ussave(Auth::user(), $article->id, 'article');
            
        }catch(Exception $ex){
            DB::rollback();
            return redirect('articles/'.$article->id.'/edit')
                    ->with('error', $ex);
        }        
        DB::commit();
        // Show the page
        return redirect('articles/'.$article->id.'/edit')
                    ->with('success', 'Article Created');
    }


    /**
     * Show the form for creating a new sequence.
     *
     * @return Response
     */
    public function getEdit($id)
    {
        $article=Article::findOrFail($id);
        $author = $article->author;

        $population = $article->population;
        
        Debugbar::info($population);
        // Title
        $title = 'Edit Article';

        // Show the page
        return view('articles/create_edit', compact('article',  'population', 'author', 'title'));
    }

    /**
     * Store a newly created sequence in storage.
     *
     * @return Response
     */
    public function postEdit($id, ArticleCreateFormRequest $request)
    {
        
       
        //year
        //volume
        //issue
        //page_range_min
        //page_range_max
        //Debugbar::info($request->input());
        Debugbar::info($request->input());
        
        $article=Article::findOrFail($id);
        
        try{
            DB::beginTransaction();
            $article->updateArticle($request);

            $article->updatePopulation($request); 
            UserStatistics::usupdate(Auth::user(), $article->id, 'article', 'postEdit Article');
        }catch(Exception $ex){
            DB::rollback();
            return redirect('articles/'.$article->id.'/edit')
                    ->with('error', $ex);
        }
        DB::commit();       

        // Show the page
        return redirect('articles/'.$article->id.'/edit')
            ->with('success', 'Article Updated');
    }

    /**
     * Store a newly created sequence in storage.
     *
     * @return Response
     */
    public function postAddCoauthor($id, Request $request)
    {
        
        Debugbar::info($request->all());

        try{
            // Title
            $title = 'Author';

            $article=Article::findOrFail($id);
            $coauthor = Author::find($request->input('coauthor'));

            if($coauthor->id == $article->author_id)
                return redirect('articles/'.$id.'/author')->with('error', 'Coauthor cant be the author');

            $article->coauthors()->attach($coauthor);
            
            UserStatistics::usupdate(Auth::user(), $article->id, 'article', 'postAddCoauthor');
            
        }catch(\Exception $ex){
            // Show the page
             //Debugbar::info('saliendooo');

            return redirect('articles/'.$id.'/author')->with('error', 'Coauthor already added');
        }
        
        // Show the page
        return redirect('articles/'.$id.'/author')
            ->with('success', 'Coauthor added!');
    }

    /**
     * Delete a list
     * @param  integer $id The list ID
     * @return Response
     */
    public function destroyCoauthor($article_id, $coauthor_id)
    {
        $user = \Auth::user();
        
        $article=Article::findOrFail($article_id);
        $coauthor = Author::findOrFail($coauthor_id);


        $article->coauthors()->detach($coauthor_id); //this executes the delete-query on the pivot table

        return redirect('articles/'.$article_id.'/author')
            ->with('success', 'Coauthor deleted!');
    }

    /**
     * Store a newly created sequence in storage.
     *
     * @return Response
     */
    public function postAddImplication($id, Request $request)
    {
        
        Debugbar::info(($request->input('implications')));
        //Debugbar::info(\Helper::prepareImplicationsForSave($request->input('implications')));

        try{
            // Title
            $title = 'Implications of Study';

            $article=Article::findOrFail($id);
            //$implication = ImplicationStudyList::find($request->input('implication'));

            //$article->implication->implications()->attach($implication);
            $article->implications()->sync($request->input('implications'));
            UserStatistics::usupdate(Auth::user(), $article->id, 'article', 'postAddImplications');
            
        }catch(\Exception $ex){
            // Show the page
             //Debugbar::info('saliendooo');

            return redirect('articles/'.$id.'/implications')
                        ->with('error', 'Implication already added');
        }
        
        // Show the page
        return redirect('articles/'.$id.'/implications')
                ->with('success', 'Implication added!');       
    }

    /**
     * Delete a list
     * @param  integer $id The list ID
     * @return Response
     */
    public function destroyImplication($article_id, $result_id)
    {
        $user = \Auth::user();
        
        $article=Article::findOrFail($article_id);
        $implication = ImplicationStudyList::findOrFail($result_id);


        $article->implications()->detach($result_id); //this executes the delete-query on the pivot table

        return redirect('articles/'.$article_id.'/implications')
            ->with('success', 'Implication Updated!');
    }

    /**
     * Store a newly created sequence in storage.
     *
     * @return Response
     */
    public function postAddMeasure($id, Request $request)
    {
        
        Debugbar::info(($request->input('measures')));
        //Debugbar::info(\Helper::prepareImplicationsForSave($request->input('implications')));

        try{
            // Title
            $title = 'Main Outcome Measures';

            $article=Article::findOrFail($id);

            $article->outcome_measures()->sync($request->input('measures'));
            UserStatistics::usupdate(Auth::user(), $article->id, 'article', 'postAddOutcomeMeasures');
            
        }catch(\Exception $ex){
            // Show the page
             //Debugbar::info('saliendooo');

            return redirect('articles/'.$id.'/measures')
                        ->with('error', 'Implication already added');
        }
        
        // Show the page
        return redirect('articles/'.$id.'/measures')
                ->with('success', 'Outcome Measures Updated');       
    }

    /**
     * Delete a list
     * @param  integer $id The list ID
     * @return Response
     */
    public function destroyMeasure($article_id, $result_id)
    {
        $user = \Auth::user();
        
        $article=Article::findOrFail($article_id);
        $implication = OutcomeMeasureList::findOrFail($result_id);


        $article->outcome_measures()->detach($result_id); //this executes the delete-query on the pivot table

        return redirect('articles/'.$article_id.'/measures')
            ->with('success', 'Outcome Measure deleted!');
    }


    /**
     * Store a newly created sequence in storage.
     *
     * @return Response
     */
    public function postAddObjective($id, Request $request)
    {
       try{
            // Title
            $title = 'Study Objectives';

            $article=Article::findOrFail($id);
            //$conclusion = Conclusion::find($request->input('conclusion'));

            Debugbar::info($request->all());
            $objective = new StudyObjectives();
            $objective->objective = $request->input('objective');

            $article->objectives()->save($objective);
            
            
        }catch(\Exception $ex){

            return redirect('articles/'.$id.'/objectives')->with('error', 'Objective already added'. $ex);
        }
        
        // Show the page
        return redirect('articles/'.$id.'/objectives')
                    ->with('success', 'Objective added!');
    }

    /**
     * Delete a list
     * @param  integer $id The list ID
     * @return Response
     */
    public function destroyObjective($article_id, $objective_id)
    {
        $user = \Auth::user();
        
        //$article=Article::findOrFail($article_id);
        $objective = StudyObjectives::findOrFail($objective_id);

        $objective->delete();

        return redirect('articles/'.$article_id.'/objectives')
            ->with('success', 'Study Objective deleted!');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function selectArticle($article_id, $result_id)
    {
        
        // Grab all the users
        $user = $this->user;

        $article = Article::find($article_id);

        $parent = Article::find($result_id);

        $article->parent_id = $parent->id;

        $article->inreply->authorsReply()->detach();

        $article->save();
        
        return redirect('articles/'.$article_id.'/inreply')
                ->with('success', 'Article Parent selected');;
    }

    /**
     * Store a newly created sequence in storage.
     *
     * @return Response
     */
    public function postUpdateInReply($id, Request $request)
    {
        
        Debugbar::info($request->all());

        try{
            
            $article=Article::findOrFail($id);
            
            $inreply = $article->inreply;

            $inreply->authorsReply()->sync($request->input('inreplyauthor'));
            $inreply->classification()->sync($request->input('classification'));


            $inreply->year = $request->input('year');
            $inreply->volume = $request->input('volume');
            $inreply->issue = $request->input('issue');
            $inreply->page_range_min = $request->input('page_range_min');
            $inreply->page_range_max = $request->input('page_range_max');
            $inreply->doi_number = $request->input('doi_number');

            $article->inreply()->save($inreply);
            
            
        }catch(\Exception $ex){
            // Show the page
             Debugbar::info($ex);
            return redirect('articles/'.$id.'/inreply')
                        ->with('error', ''.$ex);
        }
        
        // Show the page
        return redirect('articles/'.$id.'/inreply')
                ->with('success', 'In Reply Updated');       
    }

    /**
     * Store a newly created sequence in storage.
     *
     * @return Response
     */
    public function postAddCommentInReply($id, Request $request)
    {
        
        Debugbar::info($request->all());

        try{
            
            $article=Article::findOrFail($id);
            $comment = new CommentsInReply();
            $comment->comments = $request->input('comment');

            $inreply = $article->inreply;

            $inreply->comments()->save($comment);
            
            
        }catch(\Exception $ex){
            // Show the page
             Debugbar::info($ex);
            return redirect('articles/'.$id.'/inreply')
                        ->with('error', ''.$ex);
        }
        
        // Show the page
        return redirect('articles/'.$id.'/inreply')
                ->with('success', 'Comment added!');       
    }

    /**
     * Delete a list
     * @param  integer $id The list ID
     * @return Response
     */
    public function destroyInReplyComment($article_id, $comment_id)
    {
        $user = \Auth::user();
        
        $comment = CommentsInReply::findOrFail($comment_id);

        $comment->delete();

        return redirect('articles/'.$article_id.'/inreply')
            ->with('success', 'Comment deleted!');
    }
}
