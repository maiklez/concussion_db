<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PermissionTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('permissions')->delete();


        $permissions = array(
            array(
                'permission_title'      => 'Can administrate Articles and Authors',
                'permission_slug'      => 'can_articles',
                
            ),
            array(
                'permission_title'      => 'Can administrate Aplication Lists',
                'permission_slug'      => 'can_lists',
            ),
            array(
                'permission_title'      => 'Can administrate Users',
                'permission_slug'      => 'can_users',
            )
        );

        DB::table('permissions')->insert( $permissions );

        
	}

}