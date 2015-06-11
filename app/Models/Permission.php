<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {

	/**
	 * roles() many-to-many relationship method
	 * 
	 * @return QueryBuilder
	 */
	public function roles()
	{
		return $this->belongsToMany('App\Models\Role', 'permission_role', 'permission_id');
	}
}