<?php namespace App\Models\Article;

use Illuminate\Database\Eloquent\Model;

class Conclusion extends Model {

	protected $table = 'conclussions';

	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['conclussion'];

	/**
	 * article() one-to-many relationship method
	 * 
	 * @return QueryBuilder
	 */
	public function article()
	{
		return $this->belongsTo('App\Models\Article\Article');
	}

}
