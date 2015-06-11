<?php namespace App\Models\ImportCSV;

use Illuminate\Database\Eloquent\Model;



class ImportCSV extends Model {

   protected $table = 'import_csv';

   public static $SavedTypes = ['population_class', 'population_type', 'outcome_measures', 'article_type', 'implications', 'classification', 'author'];
   
   public static $NFTypes = ['gender', 'population_class', 'population_type', 'outcome_measures', 
                    'article_type', 'implications', 'classification_a', 'classification_b', 'classification_c', 'author', 'coauthor', 'article'];

   /**
     * objectives() one-to-many relationship method
     * 
     * @return QueryBuilder
     */
    public function logs()
    {
        return $this->hasMany('App\Models\ImportCSV\ImportLog', 'csv_id');
    }

    public function numArticles(){

        $num_articles = $this->logs()->distinct()->select('article_title')->get()->count();

        return $num_articles;
    }

    public function numArticlesSaved(){

        $num_articles = $this->logs()->where('action', '=', 'info')->where('cell_type', '=', 'article')->get()->count();

        return $num_articles;
    }

    public function numSaved(){

        $num_articles = $this->logs()->where('action', '=', 'saved')->whereIn('cell_type', ImportCSV::$NFTypes)->get()->count();

        return $num_articles;
    }

    public function numNF(){

        $num_articles = $this->logs()->where('action', '=', 'not_found')->whereIn('cell_type', ImportCSV::$NFTypes)->get()->count();

        return $num_articles;
    }

    public function getCounters(){

        $result = [];
        foreach (ImportCSV::$NFTypes as $value) {
            $num_articles = $this->logs()->where('action', '=', 'not_found')->where('cell_type', '=', $value)->get()->count();
            $asaved = $this->logs()->where('action', '=', 'saved')->where('cell_type', '=', $value)->get()->count();

            $aerror = $this->logs()->where('action', '=', 'error')->where('cell_type', '=', $value)->get()->count();

            array_push($result, ['type' => $value, 
                                    'not_found' => $num_articles,
                                    'saved' => $asaved,
                                    'error' => $aerror]);
        }
        //$num_articles = $this->logs()->where('action', '=', 'not_found')->whereIn('cell_type', ImportCSV::$NFTypes)->get()->count();
        \Debugbar::info($result);
        return $result;
    }

}
