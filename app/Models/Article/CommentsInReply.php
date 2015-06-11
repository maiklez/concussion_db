<?php namespace App\Models\Article;

use Illuminate\Database\Eloquent\Model;

class CommentsInReply extends Model {

	protected $table = 'in_reply_comments';

	
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
	public function inReply()
	{
		return $this->belongsTo('App\Models\Article\InReply');
	}

}
