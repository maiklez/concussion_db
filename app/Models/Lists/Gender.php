<?php namespace App\Models\Lists;

use Illuminate\Database\Eloquent\Model;

class Gender extends MyList{

	protected $table = 'list_gender';

	//

	//
	public function parent()
    {
        return $this->belongsTo('App\Models\Lists\Gender');
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
        return $this->hasMany('App\Models\Lists\Gender', 'parent_id');
    }

}