<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class AuthorCreateFormRequest extends Request {
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
        return [
          'name' => 'required'          
          //,'affiliations' => 'required'
        ];
	}

	public function authorize()
    {
        return true;
    }
}