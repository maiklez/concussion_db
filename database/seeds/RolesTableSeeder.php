<?php

use App\Models\Role;
use App\Models\Permission;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RolesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('roles')->delete();

        $roles = array(
            array(
                'role_title'      => 'Administrator All',
                'role_slug'      => 'admin',
            ),
            array(
                'role_title'      => 'Viewer',
                'role_slug'      => 'viewer',
            ),
            array(
                'role_title'      => 'Administrator Aplication Data',
                'role_slug'      => 'admin_data',
            )
        );

        DB::table('roles')->insert( $roles );

        DB::table('permission_role')->delete();

        $pArticles = Permission::where('permission_slug','=','can_articles')->first();
        $pLists = Permission::where('permission_slug','=','can_lists')->first();
        $pUsers = Permission::where('permission_slug','=','can_users')->first();

        $role_admin = Role::where('role_slug', '=', 'admin')->first();
        $role_user = Role::where('role_slug', '=', 'viewer')->first();
        $role_admin_data = Role::where('role_slug', '=', 'admin_data')->first();

        $permission_role = array(
            array(
                'permission_id'      => $pUsers->id,
                'role_id'      		 => $role_admin->id,
            ),
            array(
                'permission_id'      => $pLists->id,
                'role_id'      		 => $role_admin->id,
            ),
            array(
                'permission_id'      => $pArticles->id,
                'role_id'            => $role_admin->id,
            ),
            array(
                'permission_id'      => $pArticles->id,
                'role_id'      		 => $role_admin_data->id,
            ),
            array(
                'permission_id'      => $pLists->id,
                'role_id'            => $role_admin_data->id,
            )
        );

        DB::table('permission_role')->insert($permission_role);
	}

}