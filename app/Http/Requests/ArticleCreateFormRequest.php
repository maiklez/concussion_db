<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use DateTime;


class ArticleCreateFormRequest extends Request {
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
        $now = new DateTime();
        return [
			'article_title'=> 'required|max:255',
			//'article_type'=> 'required|exists:list_article_type,id',
			//'classification'=> 'required|exists:list_article_class,id',
			'journal_title'=> 'required|max:255',
			'author'=> 'required|exists:authors,id',

			'year'=> 'required|integer|min:1990|max:'.$now->format ('Y'),
			'volume'=> 'required|integer',
			'issue'=> 'required|integer',
			'page_range_min'=> 'required|integer|max:'.$this->input('page_range_max'),
			'page_range_max'=> 'required|integer|min:'.$this->input('page_range_min'),
		
			'doi_number' => 'required',
			
			'ref_link'=> 'required|url'

		//'gender' => 'required',
		//'population_type' => 'required'
        ];
	}

	public function authorize()
    {
        return true;
    }
}