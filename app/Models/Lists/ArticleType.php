<?php namespace App\Models\Lists;

use Illuminate\Database\Eloquent\Model;

class ArticleType extends  MyList{

	protected $table = 'list_article_type';

	public static $COMMENTARY_ID = 3;
	//

	//
	public function parent()
    {
        return $this->belongsTo('App\Models\Lists\ArticleType');
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
        return $this->hasMany('App\Models\Lists\ArticleType', 'parent_id');
    }

    public function isCommentary(){
    	//its a commetary on original research
    	if($this->id == $COMMENTARY_ID )
    		return true;
    	else
    		return false;
    }

}