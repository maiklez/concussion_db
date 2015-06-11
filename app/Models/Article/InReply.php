<?php namespace App\Models\Article;

use Illuminate\Database\Eloquent\Model;

class InReply extends Model {

	protected $table = 'in_reply';

	/**
	 * article() one-to-many relationship method
	 * 
	 * @return QueryBuilder
	 */
	public function article()
	{
		return $this->belongsTo('App\Models\Article\Article');
	}

	/**
     * type() many-to-many relationship method
     * 
     * @return QueryBuilder
     */
    public function classification()
    {
        return $this->belongsToMany('App\Models\Lists\ArticleClass',  'in_reply_class_pivot', 'in_reply_id', 'list_id');
    }

    /**
     * type() many-to-many relationship method
     * 
     * @return QueryBuilder
     */
    public function authorsReply()
    {
        return $this->belongsToMany('App\Models\Author\Author',  'in_reply_authors_pivot', 'in_reply_id', 'author_id');
    }

    /**
	 * comments() one-to-many relationship method
	 * 
	 * @return QueryBuilder
	 */
    public function comments()
    {
        return $this->hasMany('App\Models\Article\CommentsInReply');
    }
}
