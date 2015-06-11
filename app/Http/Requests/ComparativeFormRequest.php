<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ComparativeFormRequest extends Request {
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
        return [
          'data_a'=> 'required',
		  'data_b'=> 'required',
		  'p_value'=> 'required'
		
        ];
	}

	public function authorize()
    {
        return true;
    }
}