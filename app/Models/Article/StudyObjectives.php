<?php namespace App\Models\Article;

use Illuminate\Database\Eloquent\Model;

class StudyObjectives extends Model {

	protected $table = 'study_objectives';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['objective'];

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
