<?php namespace App\Models\Lists;

use Illuminate\Database\Eloquent\Model;

class PopulationType extends MyList{

	protected $table = 'list_population_type';

	//

	public function parent()
    {
        return $this->belongsTo('App\Models\Lists\PopulationType');
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
        return $this->hasMany('App\Models\Lists\PopulationType', 'parent_id');
    }
}
