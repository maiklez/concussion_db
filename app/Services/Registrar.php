<?php namespace App\Services;

use App\Models\User\User;
use App\Models\Role;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
use Mail;
use DB;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		DB::beginTransaction();
	    $confirmation_code = str_random(30);

		//por defecto le pongo el rol de viewer
		$role_id = Role::normalUser();

		//Flash::info($role_id);

		$user = User::create([
			'role_id'	=> $role_id->id,
			'first_name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'confirmation_code' => $confirmation_code			
		]);

		Mail::send('emails.verification', ['confirmation_code' => $confirmation_code], function($message) use ($data)
		{
            $message->from('yo@negadeth.es', 'Negadito')
            	->to($data['email'], $data['name'])
                ->subject('Verify your email address');
        });
		DB::commit();




		return $user;
	}

}
