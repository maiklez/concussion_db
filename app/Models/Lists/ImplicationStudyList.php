<?php namespace App\Models\Lists;

use Illuminate\Database\Eloquent\Model;

class ImplicationStudyList extends MyList{

	protected $table = 'list_implication_study';

	//
	public function parent()
    {
        return $this->belongsTo('App\Models\Lists\ImplicationStudyList');
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
        return $this->hasMany('App\Models\Lists\ImplicationStudyList', 'parent_id');
    }
}
