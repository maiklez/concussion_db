<?php namespace App\Models\Author;

use Illuminate\Database\Eloquent\Model;

class Author extends Model {

	protected $table = 'authors';

	

	/**
	 * articlesCoauthor() many-to-many relationship method
	 * 
	 * @return QueryBuilder
	 */
    public function articlesCoauthor()
    {
        return $this->belongsToMany('App\Models\Article\Article', 'coauthors_article', 'author_id', 'article_id');
    }

    /**
	 * articleAuthor() one-to-many relationship method
	 * 
	 * @return QueryBuilder
	 */
    public function articleAuthor()
    {
        return $this->hasMany('App\Models\Article\Article', 'author_id');
    }

    /**
	 * articleAuthor() one-to-many relationship method
	 * 
	 * @return QueryBuilder
	 */
    public function affiliations()
    {
        return $this->hasMany('App\Models\Author\Affiliation', 'author_id');
    }
}
