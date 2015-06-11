<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		$this->command->info('init.....');

		
		//migration 1
		$this->call('PermissionTableSeeder');
		$this->command->info('permissions done.....');

		$this->call('RolesTableSeeder');
		$this->command->info('Roles done.....');

		$this->call('UserTableSeeder');
		$this->command->info('Users Done.....'); 
		
		$this->call('ListsTableSeeder');
		$this->command->info('Lists Done.....');

		//$this->call('AuthorsTableSeeder');
		//$this->command->info('Authors Done.....');
		
		

		//$this->call('ArticlesTableSeeder');
		//$this->command->info('Articles Done.....');
		
	}

}
