<?php namespace App\Services;

use App\Models\Lists\MyList;
use App\Models\Lists\ImplicationStudyList;
use App\Models\Lists\OutcomeMeasureList;
use App\Models\Lists\PopulationType;
use App\Models\Lists\PopulationClass;
use App\Models\Lists\ArticleType;
use App\Models\Lists\ArticleClass;

use App\Models\Article\Article;


use DB;
use Form;
use URL;
use Debugbar;

class FormCreator
{

	public function sayHello(){
		return "Hello World";
	}


	public function objectivesForm($article, $errors){
		$salida = '';

		$salida = $salida . Form::open(array('url'=>'articles/'.$article->id.'/addobjective','class'=>'ajax form-horizontal', 'method'=> 'POST'));
		$salida = $salida . '<input type="hidden" name="_token" value="'. csrf_token() .'" />';

		$error = '';
		if($errors->has('objective')){
			$error = 'error';
		}
		$salida = $salida . '<div class="form-group '.$error . '">';

		$salida = $salida . Form::label('Objective');
		$salida = $salida . Form::textArea('objective');
		$salida = $salida . $errors->first('objective', '<span class="help-block">:message</span>');

		$salida = $salida . '</div>';

		$salida = $salida . Form::submit('Add Objective', array('class'=>'btn btn-success','id'=>'mdl_save_change'));
		$salida = $salida . Form::close();



		return $salida;
	}

	public function recomendationsForm($article, $errors){
		$salida = '';

		$salida = $salida . Form::open(array('url'=>'articles/'.$article->id.'/addrecomendation','class'=>'ajax form-horizontal', 'method'=> 'POST'));
		$salida = $salida . '<input type="hidden" name="_token" value="'. csrf_token() .'" />';

		$error = '';
		if($errors->has('recomendation')){
			$error = 'error';
		}
		$salida = $salida . '<div class="form-group '.$error . '">';

		$salida = $salida . Form::label('Recomendation');
		$salida = $salida . Form::textArea('recomendation');
		$salida = $salida . $errors->first('recomendation', '<span class="help-block">:message</span>');

		$salida = $salida . '</div>';

		$salida = $salida . Form::submit('Add Recomendation', array('class'=>'btn btn-success','id'=>'mdl_save_change'));
		$salida = $salida . Form::close();



		return $salida;
	}

	public function commentsForm($article, $errors){
		$salida = '';

		$salida = $salida . Form::open(array('url'=>'articles/'.$article->id.'/addcomments','class'=>'ajax form-horizontal', 'method'=> 'POST'));
		$salida = $salida . '<input type="hidden" name="_token" value="'. csrf_token() .'" />';

		$error = '';
		if($errors->has('comment')){
			$error = 'error';
		}
		$salida = $salida . '<div class="form-group '.$error . '">';

		$salida = $salida . Form::label('Comment');
		$salida = $salida . Form::textArea('comment');
		$salida = $salida . $errors->first('comment', '<span class="help-block">:message</span>');

		$salida = $salida . '</div>';

		$salida = $salida . Form::submit('Add Comment', array('class'=>'btn btn-success','id'=>'mdl_save_change'));
		$salida = $salida . Form::close();



		return $salida;
	}

	public function inReplyCommentsForm($article, $errors){
		$salida = '';

		$salida = $salida . Form::open(array('url'=>'articles/'.$article->id.'/inreply/addcomment','class'=>'ajax form-horizontal', 'method'=> 'POST'));
		$salida = $salida . '<input type="hidden" name="_token" value="'. csrf_token() .'" />';

		$error = '';
		if($errors->has('comment')){
			$error = 'error';
		}
		$salida = $salida . '<div class="form-group '.$error . '">';

		$salida = $salida . Form::label('Comment');
		$salida = $salida . Form::textArea('comment');
		$salida = $salida . $errors->first('comment', '<span class="help-block">:message</span>');

		$salida = $salida . '</div>';

		$salida = $salida . Form::submit('Add Comment', array('class'=>'btn btn-success','id'=>'mdl_save_change'));
		$salida = $salida . Form::close();



		return $salida;
	}

	public function resultsForm($article, $errors){
		$salida = '';

		$salida = $salida . Form::open(array('url'=>'articles/'.$article->id.'/addresult','class'=>'ajax form-horizontal', 'method'=> 'POST'));
		$salida = $salida . '<input type="hidden" name="_token" value="'. csrf_token() .'" />';

		$error = '';
		if($errors->has('result')){
			$error = 'error';
		}
		$salida = $salida . '<div class="form-group '.$error . '">';
		$salida = $salida . Form::label('Result');
		$salida = $salida . Form::textArea('result');
		$salida = $salida . $errors->first('result', '<span class="help-block">:message</span>');
		$salida = $salida . '</div>';

		$error = '';
		if($errors->has('link')){
			$error = 'error';
		}
		$salida = $salida . '<div class="form-group '.$error . '">';
		$salida = $salida . Form::label('Image Link');
		$salida = $salida . Form::text('link');
		$salida = $salida . $errors->first('link', '<span class="help-block">:message</span>');
		$salida = $salida . '</div>';

		$salida = $salida . Form::submit('Add Result', array('class'=>'btn btn-success','id'=>'mdl_save_change'));
		$salida = $salida . Form::close();

		return $salida;
	}

	public function populationForm($errors, $article){
		$salida = '';

		$parents =  PopulationClass::where('parent_id', '=', null)->orderBy('id', 'asc')->get();

		$error = '';
		if($errors->has('population_class')){
			$error = 'error';
		}

		$salida = $salida . '<div class="form-group '.$error . '" style=" " >';
		$salida = $salida . '<div class="col-md-5">';
		$salida = $salida . Form::label('Population Classification');

		$population = null;
		$tree_parent = null;

		if(!is_null($article)){
			$population = $article->population;
			if(!is_null($population->classification)){
				$tree_parent = $population->classification->tree_parent();
			}
		}

		foreach ($parents as $type) {
			if(!is_null($tree_parent)&& $type->id == $tree_parent->id){
				$salida =$salida.Form::checkbox('population_class['. $type->id .']', $type->id, true,  array('class' => 'population_class'));
			}else{
				$salida =$salida.Form::checkbox('population_class['. $type->id .']', $type->id, false,  array('class' => 'population_class'));
			}
           	
			//$salida = $salida . Form::radio('population_class', $type->id);
			$salida = $salida . Form::label('pop_class',$type->name, array('style'=>'display: inline;')) . '<br>';
		}
		
		if(is_null($tree_parent)){
			$salida = $salida . Form::select('class_class', 
					array(null => 'Please select one option'),
					null, 
					array('class'=>'form-control','id'=>'class_class','style'=>''));
		}else{
			
			$salida = $salida . $this->populationClassList($tree_parent->id, $population->classification->id);
			//Debugbar::info( $this->populationClassList($population->class_id));
		}

		$salida = $salida . $errors->first('result', '<span class="help-block">:message</span>');

		$salida = $salida . '</div>';
		$salida = $salida . '</div>';

		$parents =  PopulationType::where('parent_id', '=',  null)->orderBy('id', 'asc')->get();

		$error = '';
		if($errors->has('population_type')){
			$error = 'error';
		}

		$salida = $salida . '<div class="form-group '.$error . '" style="" >';
		$salida = $salida . '<div class="col-md-5">';
		$salida = $salida . Form::label('Population Type');

		$tree_parent = null;
		
		if(!is_null($population) && !is_null($population->type)){
			$tree_parent = $population->type->tree_parent();
			Debugbar::alert($tree_parent);
		}

		foreach ($parents as $type) {
           	if(!is_null($tree_parent)&& $type->id == $tree_parent->id){
           		$salida =$salida.Form::checkbox('population_type['. $type->id .']', $type->id, true,  array('class' => 'population_type'));
           	}else{
           		$salida =$salida.Form::checkbox('population_type['. $type->id .']', $type->id, false,  array('class' => 'population_type'));
           	}       	

			//$salida = $salida . Form::radio('population_type', $type->id);
			$salida = $salida . Form::label('pop_type',$type->name, array('style'=>'display: inline;')) . '<br>';
		}

		if(is_null($tree_parent)){
			$salida = $salida . Form::select('type_class', 
					array(null => 'Please select one option'),
					null, 
					array('class'=>'form-control','id'=>'type_class','style'=>''));
		}else{
			$salida = $salida . $this->populationTypeList($tree_parent->id, $population->type->id);			
		}

		$salida = $salida . $errors->first('population_type', '<span class="help-block">:message</span>');

		$salida = $salida . '</div>';
		$salida = $salida . '</div>';

		return $salida;
	}
	public function populationTypeList($parent_id, $id=null){

		//Debugbar::info($request->input('population_type'));

		//$salida = PopulationType::where('parent_id', '=', $request->input('population_type'))->orderBy('id', 'asc')->get()->toArray();
		$salida = \ArticleService::getPopulationTypeList($parent_id);
		$any = 'Any';
		//Debugbar::error($salida);
		if(is_null($salida)){
			$salida =  array( );
			$any = 'Please select one option';
			//Debugbar::error($any);
		}

		$salida2 = Form::select('type_class', 
					array(null => $any) + $salida,
					$id, 
					array('class'=>'form-control','id'=>'type_class','style'=>''));
		//$salida = $request->input();
		//Debugbar::info($fin);		
		return $salida2;
	}
	public function populationClassList($parent_id, $id=null){

		$salida = \ArticleService::getPopulationClassList($parent_id);
		$any = 'Any';
		//Debugbar::error($salida);
		if(is_null($salida)){
			$salida =  array( );
			$any = 'Please select one option';
			//Debugbar::error($any);
		}

		$salida2 = Form::select('class_class', 
					array(null => $any) + $salida,
					$id, 
					array('class'=>'form-control','id'=>'class_class','style'=>''));	
		return $salida2;
	}

	public function implicationsStudyForm($id, $implications){
		$salida = ImplicationStudyList::where('parent_id', '=', $id)->orderBy('id', 'asc')->get();

		$fin = '';

		if(!is_null($salida)&& count($salida)>0){
			foreach ($salida as $study) {
				
				//$tmpCH = $this->getChilds($study);
				//if(!is_null($tmpCH)&&count($tmpCH)>0){

				if($study->has_children){
					//Debugbar::info($tmpCH);
					//Debugbar::info($study->name);		

					$fin =$fin.Form::label($study->name );
					$fin = $fin.'<div clas="row" style="margin-left: 20px;">';
					$fin =$fin. $this->implicationsStudyForm($study->id ,$implications);
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
		//Debugbar::info($fin);

		return $fin;
	}

	public function outcomeMeasuresForm($id, $measures){
		$salida = OutcomeMeasureList::where('parent_id', '=', $id)->orderBy('id', 'asc')->get();

		$fin = '';

		if(!is_null($salida)&& count($salida)>0){
			foreach ($salida as $study) {
				
				if($study->has_children){
					//Debugbar::info($tmpCH);
					//Debugbar::info($study->name);		

					$fin =$fin.Form::label($study->name );
					$fin = $fin.'<div clas="row" style="margin-left: 20px;">';
					$fin =$fin. $this->outcomeMeasuresForm($study->id ,$measures);
					$fin = $fin.'</div>';

				}else{
					
					$fin = $fin.'<div clas="row" style="display: flex;">';

					$encontrado = false;
					foreach( $measures as $measure )
			        {
			            if($measure->id == $study->id) {
		                   $encontrado = true;
		                }
		            }
		            if($encontrado){
		            	$fin =$fin.Form::checkbox('measures['.$study->id.']', $study->id, true);
		            }else{
		            	$fin =$fin.Form::checkbox('measures['.$study->id.']', $study->id);
		            }
					
					$fin =$fin.Form::label('measures['.$study->id.']', $study->name);
					$fin = $fin.'</div>';
				}
			}
		}else if(!is_null($salida)){
			//$fin =$fin.Form::checkbox('','');
			Debugbar::info($id);
		}	
		

		return $fin;
	}

	public function typesForm($id, $types){
		$salida = ArticleType::where('parent_id', '=', $id)->orderBy('id', 'asc')->get();
		$fin = '';

		if(!is_null($salida)&& count($salida)>0){
			foreach ($salida as $study) {				
				if($study->has_children){
					$fin =$fin.Form::label($study->name );
					$fin = $fin.'<div clas="row" style="margin-left: 20px;">';
					$fin =$fin. $this->typeForm($study->id ,$types);
					$fin = $fin.'</div>';

				}else{					
					$fin = $fin.'<div clas="row" style="display: flex;">';
					$encontrado = false;
					
					if(!is_null($types)){
						foreach( $types as $type )
				        {
				            if($type->id == $study->id) {
			                   $encontrado = true;
			                }
			            }
		            }
		            if($encontrado){
		            	$fin =$fin.Form::checkbox('types['.$study->id.']', $study->id, true);
		            }else{
		            	$fin =$fin.Form::checkbox('types['.$study->id.']', $study->id);
		            }
					
					$fin =$fin.Form::label('types['.$study->id.']', $study->name);
					$fin = $fin.'</div>';
				}
			}
		}else if(!is_null($salida)){
			Debugbar::info($id);
		}
		return $fin;
	}

	public function classificationForm($id, $types){
		$salida = ArticleClass::where('parent_id', '=', $id)->orderBy('id', 'asc')->get();
		$fin = '';

		if(!is_null($salida)&& count($salida)>0){
			foreach ($salida as $study) {				
				if($study->has_children){
					$fin =$fin.Form::label($study->name );
					$fin = $fin.'<div clas="row" style="margin-left: 20px;">';
					$fin =$fin. $this->classificationForm($study->id ,$types);
					$fin = $fin.'</div>';

				}else{					
					$fin = $fin.'<div clas="row" style="display: flex;">';
					$encontrado = false;
					if(!is_null($types)){
						foreach( $types as $type )
				        {
				            if($type->id == $study->id) {
			                   $encontrado = true;
			                }
			            }
		        	}
		            if($encontrado){
		            	$fin =$fin.Form::checkbox('classification['.$study->id.']', $study->id, true);
		            }else{
		            	$fin =$fin.Form::checkbox('classification['.$study->id.']', $study->id);
		            }
					
					$fin =$fin.Form::label('classification['.$study->id.']', $study->name);
					$fin = $fin.'</div>';
				}
			}
		}else if(!is_null($salida)){
			Debugbar::info($id);
		}
		return $fin;
	}


	public function inReplyAuthorsForm($article, $authors){
		$salida = Article::find($article->parent_id);

		if(is_null($salida))
			return 'No Article Parent ';

		$author = $salida->author;
		$fin = 'To '.$salida->article_title;
		
		$fin = $fin.'<div clas="row" style="display: flex;">';

		$encontrado = false;
		foreach( $authors as $authortmp )
        {
            if($authortmp->id == $author->id) {
               $encontrado = true;
            }
        }
        if($encontrado){
        	$fin =$fin.Form::checkbox('inreplyauthor['.$author->id.']', $author->id, true);
        }else{
        	$fin =$fin.Form::checkbox('inreplyauthor['.$author->id.']', $author->id);
        }
		
		$fin =$fin.Form::label('inreplyauthor['.$author->id.']', $author->name);
		$fin = $fin.'</div>';

		$coauthors = $salida->coauthors;
		

		if(!is_null($coauthors)&& count($coauthors)>0){
			foreach ($coauthors as $coauthor) {

				$fin = $fin.'<div clas="row" style="display: flex;">';
				$encontrado = false;
				foreach( $authors as $authortmp )
		        {
		            if($authortmp->id == $coauthor->id) {
		               $encontrado = true;
		            }
		        }
		        if($encontrado){
		        	$fin =$fin.Form::checkbox('inreplyauthor['.$coauthor->id.']', $coauthor->id, true);
		        }else{
		        	$fin =$fin.Form::checkbox('inreplyauthor['.$coauthor->id.']', $coauthor->id);
		        }
				
				$fin =$fin.Form::label('inreplyauthor['.$coauthor->id.']', $coauthor->name);
				$fin = $fin.'</div>';

			}
		}

		return $fin;
	}

	public function affiliationForm($author, $errors){
		$salida = '';

		$salida = $salida . Form::open(array('url'=>'author/'.$author->id.'/addaffiliation','class'=>'ajax form-horizontal', 'method'=> 'POST'));
		$salida = $salida . '<input type="hidden" name="_token" value="'. csrf_token() .'" />';

		$error = '';
		if($errors->has('result')){
			$error = 'error';
		}
		$salida = $salida . '<div class="form-group '.$error . '">';
		$salida = $salida . Form::label('Affiliation');
		$salida = $salida . Form::text('affiliation');
		$salida = $salida . $errors->first('result', '<span class="help-block">:message</span>');
		$salida = $salida . '</div>';

		$error = '';
		if($errors->has('population')){
			$error = 'error';
		}
		$salida = $salida . '<div class="form-group '.$error . '">';
		$salida = $salida . Form::label('Population');
		$salida = $salida . Form::text('population');
		$salida = $salida . $errors->first('population', '<span class="help-block">:message</span>');
		$salida = $salida . '</div>';

		$error = '';
		if($errors->has('country')){
			$error = 'error';
		}
		$salida = $salida . '<div class="form-group '.$error . '">';
		$salida = $salida . Form::label('Country');
		$salida = $salida . Form::text('country');
		$salida = $salida . $errors->first('country', '<span class="help-block">:message</span>');
		$salida = $salida . '</div>';

		$salida = $salida . Form::submit('Add Affiliation', array('class'=>'btn btn-success','id'=>'mdl_save_change'));
		$salida = $salida . Form::close();

		return $salida;
	}

}