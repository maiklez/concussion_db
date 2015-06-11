<?php namespace App\Models\Article;

use Illuminate\Database\Eloquent\Model;

class StudyResult extends Model {

	protected $table = 'study_results';

	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['result', 'image_link'];

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
