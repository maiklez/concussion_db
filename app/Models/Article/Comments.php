<?php namespace App\Models\Article;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model {

	protected $table = 'authors_comments';

	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['comments'];

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
