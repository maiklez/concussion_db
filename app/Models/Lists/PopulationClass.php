<?php namespace App\Models\Lists;

use Illuminate\Database\Eloquent\Model;

class PopulationClass extends  MyList{

	protected $table = 'list_population_class';

	//

	/**
	 * type() one-to-many relationship method
	 * 
	 * @return QueryBuilder
	 */
	public function parent()
    {
        return $this->belongsTo('App\Models\Lists\PopulationClass', 'parent_id');
    }

    public function getparent_id()
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
        return $this->hasMany('App\Models\Lists\PopulationClass', 'parent_id');
    }

   
}
