<?php
use App\Models\Role;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->delete();

        $role_admin = Role::where('role_slug', '=', 'admin')->first();
        $role_user = Role::where('role_slug', '=', 'viewer')->first();
        $role_admin_data = Role::where('role_slug', '=', 'admin_data')->first();

        $users = array(
            array(
                'role_id'      =>  $role_admin->id,
                'first_name'      => 'admin',
                'last_name'      => 'a',
                'email'      => 'maik@negadeth.es',
                'password'   => Hash::make('admin'),
                'confirmed'  => 1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'role_id'      =>  $role_user->id,
                'first_name'      => 'user',
                'last_name'      => 'u',
                'email'      => 'user@user.org',
                'password'   => Hash::make('user'),
                'confirmed'  => 1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'role_id'      =>  $role_admin_data->id,
                'first_name'      => 'data',
                'last_name'      => 'd',
                'email'      => 'data@data.org',
                'password'   => Hash::make('data'),
                'confirmed'  => 1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            )
        );

        DB::table('users')->insert( $users );
	}

}
