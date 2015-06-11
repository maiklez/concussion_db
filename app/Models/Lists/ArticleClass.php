<?php namespace App\Models\Lists;

use Illuminate\Database\Eloquent\Model;

class ArticleClass extends  MyList{

	protected $table = 'list_article_class';

	//

	//
	public function parent()
    {
        return $this->belongsTo('App\Models\Lists\ArticleClass');
    }

    public function getParent_id()
    {
        return $this->parent_id;
    }
    
    /**
	 * Return the childs of the list
	 *
	 * @return void
	 */
	public function childs()
	{
        return $this->hasMany('App\Models\Lists\ArticleClass', 'parent_id');
    }
}