<?php namespace App\Services;


use App\Models\Lists\MyList;
use App\Models\Lists\StudyMethodList;
use App\Models\Lists\StudyObjectivesList;
use App\Models\Lists\ImplicationStudyList;
use App\Models\Lists\Gender;
use App\Models\Lists\PopulationType;
use App\Models\Lists\EventList;

use App\Models\Article\Biomarker;
use App\Models\Article\Article;
use App\Models\Article\TestResult;
use App\Models\Article\ImplicationStudy;


use App\Models\Author\Author;
use DB;
use Form;
use Debugbar;
use Request;
use Response;


class Helper
{

	public function sayHello(){
		return "Hello World";
	}

	public function getPathList(MyList $list=null){
		
		$salida = '';
		if(!is_null($list)){
			if (is_null($list->parent_id)){			
				return $list->name;
			}
			else{
				return $this->getPathList($list->parent) . '->' . $list->name;
			}
		}
		return $salida;
	}

	public function getAuthorList(){
		//Debugbar::info('getAuthorList');
		$salida = Author::orderBy('id', 'asc')->lists('name','id')->all();

		//Debugbar::info('authors');
		//Debugbar::info($salida);

		return $salida;
	}

	public function getStudyObjectivesList(){

		//Debugbar::info('getList');
		$salida = ArticleType::orderBy('id', 'asc')->lists('name','id');
		
		return $salida;
	}

	public function getGenderList(){

		//Debugbar::info('getList');
		$salida = Gender::orderBy('id', 'asc')->lists('name','id')->all();
		//Debugbar::info($salida);
		return $salida;
	}

//-------------------------------------------------
//creo que se puede borrar a partir de aqui

	
	
	public function getPopulationTypeList(){

		$salida = PopulationType::where('parent_id', '=', null)->orderBy('id', 'asc')->get();
		//Debugbar::info($salida);
		$fin=array();
		if(!is_null($salida)&& count($salida)>0){
			foreach ($salida as $study) {
				
				$tmpCH = $this->getChilds($study);
				if(!is_null($tmpCH)&&count($tmpCH)>0){

					$fin =array_add($fin,$study->name , $tmpCH);			
				}else{
					$fin =array_add($fin, $study->id , $study->name);
					Debugbar::info($fin);
				}
			}
		}else{
			$fin = array(  $salida->name, $salida->id);
		}
		//Debugbar::info($fin);		
		return $fin;
	}

	public function getImplicationsStudyList(){
		$salida = ImplicationStudyList::where('parent_id', '=', null)->orderBy('id', 'asc')->get();
		//Debugbar::info($salida);
		$fin=array();
		if(!is_null($salida)&& count($salida)>0){
			foreach ($salida as $study) {
				
				$tmpCH = $this->getChilds($study);
				if(!is_null($tmpCH)&&count($tmpCH)>0){
					//Debugbar::info($tmpCH);
					//Debugbar::info($study->name);		

					$fin =$fin + array( $study->name => $tmpCH);//array_add($fin, $study->name , $tmpCH);			
				}else{
					$fin =array_add($fin, $study->id , $study->name);
					//Debugbar::info($fin);
				}
			}
		}else{
			$fin = array(  $salida->id => $salida->name);
		}
		Debugbar::info('implications');		
		Debugbar::info($fin);		
		return $fin;
	}

	public function getImplicationsStudyForm($id, $implications){
		$salida = ImplicationStudyList::where('parent_id', '=', $id)->orderBy('id', 'asc')->get();

		$fin = '';

		if(!is_null($salida)&& count($salida)>0){
			foreach ($salida as $study) {
				
				$tmpCH = $this->getChilds($study);
				if(!is_null($tmpCH)&&count($tmpCH)>0){
					//Debugbar::info($tmpCH);
					//Debugbar::info($study->name);		

					$fin =$fin.Form::label($study->name );
					$fin = $fin.'<div clas="row" style="margin-left: 20px;">';
					$fin =$fin. $this->getImplicationsStudyForm($study->id ,$implications);
					$fin = $fin.'</div>';

				}else{
					
					$fin = $fin.'<div clas="row" style="display: flex;">';

					$encontrado = false;
					foreach( $implications as $implication )
			        {
			            if($implication->id == $study->id) {
		                   $encontrado = true;
		                }
		            }
		            if($encontrado){
		            	$fin =$fin.Form::checkbox('implications['.$study->id.']', $study->id, true);
		            }else{
		            	$fin =$fin.Form::checkbox('implications['.$study->id.']', $study->id);
		            }
					
					$fin =$fin.Form::label('implications['.$study->id.']', $study->name);
					$fin = $fin.'</div>';
				}
			}
		}else if(!is_null($salida)){
			$fin =$fin.Form::checkbox('','');
		}	
		Debugbar::info($fin);

		return $fin;
	}

	public function getList(){

		//Debugbar::info('getList');
		$salida = StudyMethodList::where('parent_id', '=', null)->orderBy('id', 'asc')->get();
		//Debugbar::info($salida);
		$fin=array();
		if(!is_null($salida)&& count($salida)>0){
			foreach ($salida as $study) {
				//$salida2 = StudyMethodList::where('parent_id', '=', $study->id)->orderBy('id', 'asc')->get();

				$tmpCH = $this->getChilds($study);
				//Debugbar::info(count($tmpCH));
				if(!is_null($tmpCH)&&count($tmpCH)>0){
					$tmp = array( $study->name => $tmpCH);					
				}else{
					//$tmp = $study->lists('name','id');
					$tmp = array( $study->id => $study->name );
				}

				//$tmp = array( $study->name => $this->getChilds($study));
				
				//$salida2 = array( $study->name => $salida2->lists('name','id'));				
				//$salida2 = array_add($salida2 , $study->id, $study->name);
				$fin =array_merge( $fin , $tmp);
			}
		}else{
			//$salida = StudyMethodList::find($id);
			$fin = array(  $salida->name, $salida->id);
		}
		//Debugbar::info($fin);		
		return $fin;
	}

	public function getChilds(MyList $list){
		$childs = $list->childs;
		$fin=array();
		if(is_null($childs)){
			$fin = $list->lists('name','id');//array( $list->name, $list->id);
		}else{
			//$fin = array();
			foreach ($childs as $child) {
				$tmpCH = $this->getChilds($child);
				if(!is_null($tmpCH)&&count($tmpCH)>0){
					//$tmp = array($child->id => $tmpCH);
					$fin =array_add($fin, $child->id , $tmpCH);
										
				}else{
					//$tmp = array( $child->id => $child->name );
					$fin =array_add($fin, $child->id , $child->name);
				}

				//$fin =array_merge( $fin , $tmp);				
			}
		}
		return $fin;
	}

	/**
     * Convert from input array to savable array.
     * @param $biomarkers
     * @return array
     */
    public function prepareBiomarkersForSave( $biomarkers )
    {
        $availableBiomarkers = Biomarker::all()->toArray();
        $preparedBiomarkers = array();
        foreach( $biomarkers as $biomarker => $value )
        {
            // If checkbox is selected
            if( $value == '1' )
            {
                // If biomarker exists
                array_walk($availableBiomarkers, function(&$value) use($biomarker, &$preparedBiomarkers){
                    if($biomarker == (int)$value['id']) {
                        $preparedBiomarkers[] = $biomarker;
                    }
                });
            }
        }
        return $preparedBiomarkers;
    }

    public function prepareBiomarkersForDisplay($biomarkers)
    {
        // Get all the available biomarkers
        $biomarkers1 = Biomarker::all();
        $availableBiomarkers = $biomarkers1->toArray();

        foreach($biomarkers1 as &$biomarker) {
            array_walk($availableBiomarkers, function(&$value) use(&$biomarker){
                 if($biomarker->name == $value['name']) {
                	$value['type_name'] = $biomarker->type->name;
                }
            });
        }

        foreach($biomarkers as &$biomarker) {
            array_walk($availableBiomarkers, function(&$value) use(&$biomarker){
                if($biomarker->name == $value['name']) {
                    $value['checked'] = true;
                }
            });
        }
        return $availableBiomarkers;
    }

    /**
     * Convert from input array to savable array.
     * @param $implications
     * @return array
     */
    public function prepareImplicationsForSave( $implications )
    {
        $availableImplications = ImplicationStudyList::all()->toArray();
        $preparedImplications = array();
        foreach( $implications as $implication => $value )
        {
            // If checkbox is selected
            if( $value == '1' )
            {
                // If implication exists
                array_walk($availableImplications, function(&$value) use($implication, &$preparedImplications){
                    if($implication == (int)$value['id']) {
                        $preparedImplications[] = $implication;
                    }
                });
            }
        }
        return $preparedImplications;
    }

    public function prepareImplicationsForDisplay($implications)
    {
        // Get all the available implications
        $availableImplications = ImplicationStudyList::all()->toArray();

        foreach($implications as &$implication) {
            array_walk($availableImplications, function(&$value) use(&$implication){
                $value['type_name'] = $implication->type->name;
                if($implication->name == $value['name']) {
                    $value['checked'] = true;
                }
            });
        }
        return $availableImplications;
    }
}