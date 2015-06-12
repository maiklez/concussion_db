<?php namespace App\Models\Article;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article\Traits\ArticleRelationShips;
use App\Http\Requests\ArticleCreateFormRequest;

use App\Models\Lists\ArticleClass;
use App\Models\Lists\ArticleType;

use App\Models\Lists\PopulationType;
use App\Models\Lists\PopulationClass;
use App\Models\Lists\Gender;

use App\Models\Author\Author;

use DateTime;
use Auth;

class Article extends Model {


    use ArticleRelationShips;

   protected $table = 'articles';

   
   public function hasInReply(){
        $types = $this->type;

        $has_reply = ArticleType::$COMMENTARY_ID;

        if ($types->contains($has_reply))
        {
            return true;
        }
        return false;
   }

    /**
     * create an article
     * 
     * @return Article the article that was created
     */
    public static function createArticle(ArticleCreateFormRequest $request)
    {        
        
        $article = new Article();
        $article->article_title = $request->input('article_title');
        $article->journal_title = $request->input('journal_title');

        $article->key_finding = $request->input('key_finding');

        //$idate = DateTime::createFromFormat ('Y', $request->input('year'));
        $article->year = $request->input('year');
        //Debugbar::info($idate);

        $article->volume = $request->input('volume');
        $article->issue = $request->input('issue');
        $article->page_range_min = $request->input('page_range_min');
        $article->page_range_max = $request->input('page_range_max');
        $article->doi_number = $request->input('doi_number');
        $article->doi_number_prefix = '10.1001';
        $article->doi_number_journal = 'jamaneurol';
        $article->doi_number_year = '2014';
        $article->doi_number_number = '367';
        $article->crossref_link = $request->input('ref_link');
        
        $article->summary = $request->input('summary');
		
        $article->user_id = Auth::id();
        $author = Author::find($request->input('author'));
        $article = $author->articleAuthor()->save($article);

        $article->type()->sync($request->input('types'));
        $article->classification()->sync($request->input('classification'));

        $population = new StudyPopulation();
        $article->population()->save($population);

        $inreply = new InReply();
        $article->inreply()->save($inreply);

        return $article;
    }

    /**
     * create an article
     * 
     * @return Article the article that was created
     */
    public function updateArticle(ArticleCreateFormRequest $request)
    {        

        //$article = new Article();
        $this->article_title = $request->input('article_title');
        $this->journal_title = $request->input('journal_title');
        $this->key_finding = $request->input('key_finding');

        //$idate = DateTime::createFromFormat ('Y', $request->input('year'));
        $this->year = $request->input('year');
        //Debugbar::info($idate);
        $this->volume = $request->input('volume');
        $this->issue = $request->input('issue');
        $this->page_range_min = $request->input('page_range_min');
        $this->page_range_max = $request->input('page_range_max');
        $this->doi_number = $request->input('doi_number');
        $this->doi_number_prefix = '10.1001';
        $this->doi_number_journal = 'jamaneurol';
        $this->doi_number_year = '2014';
        $this->doi_number_number = '367';
        $this->crossref_link = $request->input('ref_link');
        
        $this->summary = $request->input('summary');
        
        $this->type()->sync($request->input('types'));
        $this->classification()->sync($request->input('classification'));
	
        $this->user_id = Auth::id();
        $author = Author::find($request->input('author'));
        $author->articleAuthor()->save($this);

    }

    /**
     * create an article
     * 
     * @return Article the article that was created
     */
    public function updatePopulation(ArticleCreateFormRequest $request)
    {        

        $gender = Gender::find($request->input('gender'));
        $typepopulation = PopulationType::find($request->input('type_class'));
        $classpopulation = PopulationClass::find($request->input('class_class'));

        $gender_id = null;
        $class_id = null;
        $type_id = null;
        if(!is_null($gender)) $gender_id = $gender->id;
        if(!is_null($classpopulation)) $class_id = $classpopulation->id;
        if(!is_null($typepopulation)) $type_id = $typepopulation->id;

        $population = $this->population;
        $population->type_id = $type_id;
        $population->class_id = $class_id;
        $population->gender_id = $gender_id;

        //$population = new StudyPopulation(['type_id'=> $typepopulation->id, 'class_id'=> $classpopulation->id ,'gender_id'=>$gender->id]);
        $this->population()->save($population);
    }


}
