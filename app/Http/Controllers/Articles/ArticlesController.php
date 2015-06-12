<?php namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use Helper;
use Response;
use Debugbar;
use Auth;

use App\Models\User\User;
use App\Models\Article\Article;
use App\Models\Article\Biomarker;
use App\Models\Article\TestResult;

use App\Models\ImportCSV\ImportCSV;
use App\Models\ImportCSV\ImportLog;
use App\Models\User\UserStatistics;


class ArticlesController extends Controller {

	use AdminArticles;
    
    /**
     * User Model
     * @var User
     */
    protected $user;


    /**
     * User Model
     * @var Article
     */
    protected $article;


	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Article $article)
	{
		$this->middleware('auth');

		$this->user = $user;
        $this->article = $article;
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		 // Title
        $title = 'Articles';

        // Grab all the users
        $user = $this->user;
        Debugbar::info(Auth::id());
        UserStatistics::search(Auth::user(), 'article', 'ALL');
        
        $articles = Article::get();

		return view('articles/index' , compact('user', 'articles', 'title'));
	}

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function getArticle($article_id)
    {
         // Title
        $title = 'Show Article';

        // Grab all the users
        $user = $this->user;

        $article = Article::find($article_id);
	
        UserStatistics::uslist(Auth::user(), $article->id, 'article');
        
        // Title
        $title = $article->article_title;


        return view('articles/show' , compact('user',  'article',  'title'));
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function getAuthorsArticle($article_id)
    {
         // Title
        $title = 'Show Article';

        // Grab all the users
        $user = $this->user;

        $article = Article::find($article_id);

        // Title
        $title = $article->article_title;


        return view('articles/author' , compact('user',  'article',  'title'));
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function getObjectivesArticle($article_id)
    {
         // Title
        $title = 'Show Article';

        // Grab all the users
        $user = $this->user;

        $article = Article::find($article_id);
        // Title
        $title = $article->article_title;


        return view('articles/objectives' , compact('user',  'article',  'title'));
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function getMeasuresArticle($article_id)
    {
         // Title
        $title = 'Show Article';

        // Grab all the users
        $user = $this->user;

        $article = Article::find($article_id);

        //$biomarkers = Biomarker::get();

        //$biomarkers = \Helper::prepareBiomarkersForDisplay($article->method->biomarker()->get());
        $measures = $article->outcome_measures()->get();
        \Debugbar::info($measures);

        // Title
        $title = $article->article_title;


        return view('articles/measures' , compact('user',  'article', 'measures', 'title'));
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function getImplicationsArticle($article_id)
    {
         // Title
        $title = 'Implications of Study';

        // Grab all the users
        $user = $this->user;

        $article = Article::find($article_id);

        $implications = $article->implications()->get();
                // Title
        $title = $article->article_title;


        return view('articles/implications' , compact('user',  'article', 'implications','title'));
    }

    
    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function getInReplyArticle($article_id)
    {
         // Title
        $title = 'In Reply';

        // Grab all the users
        $user = $this->user;

        $article = Article::find($article_id);

        $inreply = $article->inreply;

        $inreplyAuthors = $inreply->authorsReply()->get();

        // Title
        $title = $article->article_title;
        return view('articles/in_reply' , compact('user',  'article', 'inreply', 'inreplyAuthors', 'title'));
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function getInReplySelectArticle($article_id)
    {
         // Title
        $title = 'In Reply';

        // Grab all the users
        $user = $this->user;

        $article = Article::find($article_id);

        $articles = Article::where('id', '!=', $article_id)->get();

        $inreply = $article->inreply;

        $inreplyAuthors = $inreply->authorsReply()->get();

        // Title
        $title = $article->article_title;
        return view('articles/in_reply/select_article' , compact('user', 'articles', 'article', 'inreply', 'inreplyAuthors', 'title'));
    }
    
    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function getImportResults()
    {
        // Title
        $title = 'Import Results';

        \Debugbar::info(\Request::input('action'));
        $action = \Request::input('action');
        
        if (!is_null($action)) {
            $results = ImportCSV::all();
        }
        // Grab all the users
        $user = $this->user;

        $results = ImportCSV::all();

        return view('import/results' , compact('user',  'results',  'title'));
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function getImportFileResults($id)
    {
        // Title
        $title = 'Import Results';

        \Debugbar::info(\Request::input('type'));
        $action = \Request::input('action');
        $type = \Request::input('type');
        
        $csv = ImportCSV::findOrFail($id);
        $logs = [];
        $articles = ImportLog::select('article_title')->where('csv_id', '=', $csv->id)->distinct('article_title')->get();
        
        foreach ($articles as $value) {
            # code...
            //\Debugbar::info($value->article_title);
            $logsTmp ='';
            if ($action=='all'||is_null($action)) {
                $logsTmp = ImportLog::where('csv_id', '=', $csv->id)
                                    ->where('article_title', '=', $value->article_title)->get();

            }elseif($action=='not_found'||$action=='saved'||$action=='error'){
                if ($type=='all'){
                    $logsTmp = ImportLog::where('csv_id', '=', $csv->id)
                                    ->where('action', '=', $action)
                                    ->where('article_title', '=', $value->article_title)->get();
                }else{
                    $logsTmp = ImportLog::where('csv_id', '=', $csv->id)
                                    ->where('action', '=', $action)
                                    ->where('cell_type', '=', $type)
                                    ->where('article_title', '=', $value->article_title)->get();
                }
                
            }else{
                $logsTmp = ImportLog::where('csv_id', '=', $csv->id)
                                    ->where('action', '=', $action)
                                    ->where('article_title', '=', $value->article_title)->get();
            }
            array_push($logs, $logsTmp);
        }

        $atypes = ImportCSV::$NFTypes;
        // Grab all the users
        $user = $this->user;

        //\Debugbar::info($logs);

        return view('import/file_result' , compact('user',  'csv', 'logs', 'title', 'action', 'type', 'atypes'));
    }

}
