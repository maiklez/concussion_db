<?php namespace App\Http\Controllers;

use App\Models\User\User;

class RegistrationController extends Controller {

    public function confirm($confirmation_code)
    {
        if( ! $confirmation_code)
        {
            return \Redirect::to('/');
        }

        $user = User::whereConfirmationCode($confirmation_code)->first();

        if ( ! $user)
        {
            return \Redirect::route('home');
        }

        $user->confirmed = 1;
        //$user->confirmation_code = null;
        $user->save();

        //\Flash::message('You have successfully verified your account.');

        return \Redirect::route('home');
    }
}