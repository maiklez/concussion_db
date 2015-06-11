<?php namespace App\Models\Lists;

use Illuminate\Database\Eloquent\Model;

class OutcomeMeasureList extends MyList{

	protected $table = 'list_outcome_measures';

	//
	public function parent()
    {
        return $this->belongsTo('App\Models\Lists\OutcomeMeasureList');
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
        return $this->hasMany('App\Models\Lists\OutcomeMeasureList', 'parent_id');
    }

}
