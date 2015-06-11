<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Models\Role;
use Validator;

use Mail;
use DB;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticateAndRegisterUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{

		$this->middleware('guest', ['except' => 'getLogout']);
	}
	
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
			$message->from('noreply@concussiondatabase.com', 'Concussion Database')
			->to($data['email'], $data['name'])
			->subject('Verify your email address');
		});
		DB::commit();
	
	
	
	
		return $user;
	}

}
