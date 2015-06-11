<?php namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use App\Models\Lists\PopulationType;
use App\Models\Lists\MyList;

use ArticleService;
use Debugbar;
use Illuminate\Http\Request;

use Response;
use Form;
use FormCreator;

class ListsController extends Controller {

	


	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		
	}

	public function getPopulationTypeList(Request $request){


		return FormCreator::populationTypeList($request->input('population_type'));

	}

	public function getPopulationClassList(Request $request){


		return FormCreator::populationClassList($request->input('population_class'));

	}


}
