<?php namespace App\Models\Article;

use Illuminate\Database\Eloquent\Model;

class StudyRecomendations extends Model {

	protected $table = 'study_recomendations';

	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['recomendations'];

	/**
	 * article() one-to-one relationship method
	 * 
	 * @return QueryBuilder
	 */
	public function article()
    {
        return $this->belongsTo('App\Models\Article\Article', 'article_id');
    }

}
