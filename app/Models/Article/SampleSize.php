<?php namespace App\Models\Article;

use Illuminate\Database\Eloquent\Model;

class SampleSize extends Model {

	protected $table = 'sample_sizes';

	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['size', 'option'];

	/**
	 * studyPopulation() one-to-many relationship method
	 * 
	 * @return QueryBuilder
	 */
	public function studyPopulation()
	{
		return $this->belongsTo('App\Models\Article\StudyPopulation');
	}
}
