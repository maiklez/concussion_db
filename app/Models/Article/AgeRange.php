<?php namespace App\Models\Article;

use Illuminate\Database\Eloquent\Model;

class AgeRange extends Model {

	protected $table = 'age_ranges';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['medium', 'minimum','maximum', 'name'];

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
