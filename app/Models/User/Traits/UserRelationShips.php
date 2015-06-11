<?php namespace App\Models\User\Traits;

trait UserRelationShips {

	/**
	 * role() one-to-one relationship method
	 * 
	 * @return QueryBuilder
	 */
	public function role()
	{
		return $this->belongsTo('App\Models\Role');
	}

	/**
	 * users() one-to-many relationship method
	 *
	 * @return QueryBuilder
	 */
	public function statistics()
	{
		return $this->hasMany('App\Models\User\UserStatistics', 'user_id');
	}
}