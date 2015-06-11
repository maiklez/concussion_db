<?php namespace App\Models\Article;

use Illuminate\Database\Eloquent\Model;

class StudyPopulation extends Model {

	protected $table = 'study_population';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['type_id', 'class_id','gender_id'];

	/**
	 * article() one-to-one relationship method
	 * 
	 * @return QueryBuilder
	 */
	public function article()
    {
        return $this->belongsTo('App\Models\Article\Article', 'article_id');
    }


    /**
	 * ageRange() one-to-many relationship method
	 * 
	 * @return QueryBuilder
	 */
    public function ageRange()
    {
        return $this->hasMany('App\Models\Article\AgeRange', 'population_id');
    }

     /**
	 * ageRange() one-to-many relationship method
	 * 
	 * @return QueryBuilder
	 */
    public function sampleSize()
    {
        return $this->hasMany('App\Models\Article\SampleSize', 'population_id');
    }


    /**
	 * type() one-to-many relationship method
	 * 
	 * @return QueryBuilder
	 */
	public function type()
    {
        return $this->belongsTo('App\Models\Lists\PopulationType', 'type_id');
    }

     /**
	 * type() one-to-many relationship method
	 * 
	 * @return QueryBuilder
	 */
	public function classification()
    {
        return $this->belongsTo('App\Models\Lists\PopulationClass', 'class_id');
    }

    /**
	 * type() one-to-many relationship method
	 * 
	 * @return QueryBuilder
	 */
	public function gender()
    {
        return $this->belongsTo('App\Models\Lists\Gender', 'gender_id');
    }
}
