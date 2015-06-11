<?php namespace App\Models\Lists;


use Illuminate\Database\Eloquent\Model;

abstract class MyList extends Model{

	
	/**
	 * Return the parent item of the list
	 *
	 * @return void
	 */
	public abstract function parent();

	/**
	 * Return the parent item of the list
	 *
	 * @return void
	 */
	public abstract function getParent_id();

	/**
	 * Return the childs of the list
	 *
	 * @return void
	 */
	public abstract function childs();

    public function tree_parent(){
    	
    	

    	$pat = $this->parent;
    	
    	if(is_null($pat)){
    		$pat = $this;
    	}

    	while (!is_null($pat)&& !is_null($pat->parent_id)) {
    		# code...
    		$pat = $pat->parent;
    	}
    	//$id = $this->getParent_id();
    	\Debugbar::info($pat);


    	
    	return $pat;
    }

    public function hasChildren(){
    	return $this->has_children;
    }
}
