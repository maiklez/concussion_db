<?php namespace App\Models\Author;

use Illuminate\Database\Eloquent\Model;

class Affiliation extends Model {

	protected $table = 'affiliations';

	

	/**
	 * author() many-to-one relationship method
	 * 
	 * @return QueryBuilder
	 */
    public function author()
    {
        return $this->belongsTo('App\Models\Author\Author', 'author_id');
    }

}
