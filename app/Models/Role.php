<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    /**
	 * users() one-to-many relationship method
	 * 
	 * @return QueryBuilder
	 */
	public function users()
	{
		return $this->hasMany('App\Models\User\User');
	}

	/**
	 * permissions() many-to-many relationship method
	 * 
	 * @return QueryBuilder
	 */
	public function permissions()
	{
		return $this->belongsToMany('App\Models\Permission' , 'permission_role', 'role_id');
	}


	/**
	 * permissions() many-to-many relationship method
	 * 
	 * @return QueryBuilder
	 */
	public static function normalUser()
	{
		return Role::where('role_slug', '=', 'viewer')->first();
	}

	/**
	 * permissions() many-to-many relationship method
	 * 
	 * @return QueryBuilder
	 */
	public function adminUser()
	{
		return Role::where('role_slug', '=', 'admin')->first();
	}
}