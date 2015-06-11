<?php namespace App\Models\Article\Traits;

trait ArticleRelationShips {

	
    /**
     * parent() many-to-many relationship method
     * 
     * @return QueryBuilder
     */
    public function articleInReply()
    {
        return $this->belongsTo('App\Models\Article\Article');
    }

    /**
	 * coauthors() many-to-many relationship method
	 * 
	 * @return QueryBuilder
	 */
    public function coauthors()
    {
        return $this->belongsToMany('App\Models\Author\Author', 'coauthors_article', 'article_id', 'author_id');
    }

    /**
	 * author() one-to-many relationship method
	 * 
	 * @return QueryBuilder
	 */
    public function author()
    {
        return $this->belongsTo('App\Models\Author\Author', 'author_id', 'id');
    }

    /**
	 * objectives() one-to-many relationship method
	 * 
	 * @return QueryBuilder
	 */
    public function objectives()
    {
        return $this->hasMany('App\Models\Article\StudyObjectives');
    }

    /**
     * recomendations() one-to-many relationship method
     * 
     * @return QueryBuilder
     */
    public function recomendations()
    {
        return $this->hasMany('App\Models\Article\StudyRecomendations');
    }

    /**
     * comments() one-to-many relationship method
     * 
     * @return QueryBuilder
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Article\Comments');
    }

    /**
	 * population() one-to-one relationship method
	 * 
	 * @return QueryBuilder
	 */
    public function population()
    {
        return $this->hasOne('App\Models\Article\StudyPopulation');
    }

     /**
	 * results() one-to-one relationship method
	 * 
	 * @return QueryBuilder
	 */
    public function results()
    {
        return $this->hasMany('App\Models\Article\StudyResult');
    }

     /**
     * implications() many-to-many relationship method
     * 
     * @return QueryBuilder
     */
    public function implications()
    {
        return $this->belongsToMany('App\Models\Lists\ImplicationStudyList', 'implications_list_pivot', 'article_id', 'list_id');
    }

    /**
     * implications() many-to-many relationship method
     * 
     * @return QueryBuilder
     */
    public function outcome_measures()
    {
        return $this->belongsToMany('App\Models\Lists\OutcomeMeasureList', 'outcome_list_pivot', 'article_id', 'list_id');
    }

     /**
	 * conclusion() one-to-many relationship method
	 * 
	 * @return QueryBuilder
	 */
    public function conclusion()
    {
        return $this->hasMany('App\Models\Article\Conclusion');
    }

	/**
     * type() many-to-many relationship method
     * 
     * @return QueryBuilder
     */
    public function type()
    {
        return $this->belongsToMany('App\Models\Lists\ArticleType',  'article_type_pivot', 'article_id', 'list_id');
    }

    /**
     * type() many-to-many relationship method
     * 
     * @return QueryBuilder
     */
    public function classification()
    {
        return $this->belongsToMany('App\Models\Lists\ArticleClass',  'article_class_pivot', 'article_id', 'list_id');
    }

    /**
     * population() one-to-one relationship method
     * 
     * @return QueryBuilder
     */
    public function inreply()
    {
        return $this->hasOne('App\Models\Article\InReply');
    }
}