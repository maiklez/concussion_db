<?php namespace App\Services;

use App\Models\Lists\ArticleType;

use App\Models\Lists\MyList;
use App\Models\Lists\ImplicationStudyList;
use App\Models\Lists\OutcomeMeasureList;
use App\Models\Lists\Gender;
use App\Models\Lists\PopulationType;
use App\Models\Lists\PopulationClass;
use App\Models\Lists\ArticleClass;

use App\Models\ImportCSV\ImportCSV;
use App\Models\ImportCSV\ImportLog;

use App\Models\Article\Article;
use App\Models\Article\ImplicationStudy;
use App\Models\Article\StudyPopulation;
use App\Models\Article\AgeRange;
use App\Models\Article\SampleSize;
use App\Models\Article\StudyResult;
use App\Models\Article\StudyObjectives;
use App\Models\Article\StudyRecomendations;
use App\Models\Article\Conclusion;
use App\Models\Article\InReply;
use App\Models\Article\Comments;

use App\Models\Author\Author;
use App\Models\Author\Affiliation;
use DB;
use Debugbar;
use Excel;

class ArticleService
{

    protected static $num_articles = 0;

    protected static $final_errors = [];

    public function incrementCount() {
        return self::$num_articles++;
    }

    public function resetCount() {
        return self::$num_articles = 0;
    }

	public function sayHello(){
		return "Hellodddddddddd";
	}

	public function importArticles($csv){
		//Debugbar::info($csv->count());
		
        $error_data = new ImportCSV();
        $error_data->file_name = 'sample2.csv';
        $error_data->save();

        //Debugbar::error($error_data->file_name);

        $excelFile = Excel::filter('chunk')->load('storage/app/'.$error_data->file_name)->chunk(250, function($results)
        {
                //$final_errors = [];
                //Debugbar::error($results);
                $fila = 0;
                $num_filas=0;
                ArticleService::resetCount(); 
                //voy a contar los articulos - solo tendrán un titulo
                $filas_article = [];
                //$num_articles = 0;
                

                foreach($results as $row)
                {
                    if(!is_null($row->article_title)){
                        $filas_article[ArticleService::$num_articles] = $fila;
                        //$num_articles++;
                        ArticleService::incrementCount();                
                        //Debugbar::info($fila.' - '.$row->article_title);
                    } 
                    $fila++; 
                    $num_filas++;  
                }

                //recorro los articulos
                for ($i=0; $i < ArticleService::$num_articles ; $i++) { 
                    //Debugbar::info($filas_article[$i].' - '. $csv->get($filas_article[$i]));

                    $ini = $filas_article[$i];

                    if($i+1<ArticleService::$num_articles)
                        $fin = $filas_article[$i+1];
                    else
                        $fin = $num_filas+1;

                    //Debugbar::info($ini. '   ' . $fin.'  article title- ');
                    
                    $articleTMP = $results->slice($ini, ($fin-$ini));

                    DB::beginTransaction();

                    $errors = $this->importAuthors($articleTMP);
                    $this->updateMailAuthor($articleTMP);
                    $errors1 = $this->createArticle($articleTMP);

                    //Debugbar::alert($errors);

                    array_push(ArticleService::$final_errors, $errors);
                    array_push(ArticleService::$final_errors, $errors1);
                    DB::commit();

                    //Debugbar::info($articleTMP);

                }
                
                        
        });

        foreach (ArticleService::$final_errors as $sheet) {
            $error_data->logs()->saveMany($sheet);
            
            
        }
        
        return ArticleService::$final_errors;
        //Debugbar::info('num articles - '.$num_articles);

        

	}

	private function createArticle($article_csv){

        $errors = [];      

		$firs_row = $article_csv->get(0);

		$author = Author::where('name', 'like', rtrim($firs_row->lead_author).'%')->first();
		
        $article = new Article();

		$article->article_title = $firs_row->article_title;
        $article->journal_title = $firs_row->journal_title;
        $article->year = $firs_row->year;
		$article->volume = $firs_row->volume;
		$article->issue = $firs_row->issue;
		$article->page_range_min = $firs_row->page_range_min;
		$article->page_range_max = $firs_row->page_range_max;
		$article->doi_number = $firs_row->doi_number;
		//$article->doi_number_prefix = '10.1001';
		//$article->doi_number_journal = 'jamaneurol';
		//$article->doi_number_year = '2014';
		//$article->doi_number_number = '367';
		$article->crossref_link = $firs_row->doi_link;
		$article->key_finding = $firs_row->key_finding;
		$article->summary = $firs_row->df_summary;
		
		try{


    		//aqui guardar articulo!!!!
    		if(is_null($author)){
                array_push($errors, new ImportLog(['action' => 'error', 
                                            'article_title' => $article->article_title, 
                                            'cell_type' =>'article', 
                                            'cell_value' => $firs_row->lead_author, 
                                            'text_error' => 'Error saving article - '. $author]));

                return $errors;
            }
            $article = $author->articleAuthor()->save($article);
            array_push($errors, new ImportLog(['action' => 'info', 
                                            'article_title' => $article->article_title, 
                                            'cell_type' =>'article', 
                                            'cell_value' => $firs_row->lead_author, 
                                            'text_error' => 'Article created']));

    		//study population
    		$gender = Gender::where('name', 'like',  rtrim ($firs_row->gender.''))->first();
    		$typepopulation = PopulationType::where('name', 'like',  rtrim ($firs_row->population_type.''))->first();
    		$classpopulation = PopulationClass::where('name', 'like',  rtrim ($firs_row->population_class.''))->first();

    		$population = new StudyPopulation();
    		$gender_id = null;
            $class_id = null;
            $type_id = null;
            if(!is_null($gender)){
                $gender_id = $gender->id;
                array_push($errors, new ImportLog(['action' => 'saved', 
                                            'article_title' => $article->article_title, 
                                            'cell_type' =>'gender', 
                                            'cell_value' => $firs_row->gender, 
                                            'text_error' => $firs_row->gender.'Gender saved']));
            }elseif (!is_null($firs_row->gender)) {
                //error buscando gender
                array_push($errors, new ImportLog(['action' => 'not_found', 
                                            'article_title' => $article->article_title, 
                                            'cell_type' =>'gender', 
                                            'cell_value' => $firs_row->gender, 
                                            'text_error' => 'Gender not found']));
                //array_push($errors, 'Gender not found.... '. $firs_row->gender);
            }
            if(!is_null($classpopulation)){
                $class_id = $classpopulation->id;
                //saved class
                array_push($errors, new ImportLog(['action' => 'saved', 
                                            'article_title' => $article->article_title, 
                                            'cell_type' =>'population_class', 
                                            'cell_value' => $firs_row->population_class, 
                                            'text_error' => $firs_row->population_class.' population_class saved']));
            }elseif (!is_null($firs_row->population_class)) {
                //error buscando class
                array_push($errors, new ImportLog(['action' => 'not_found', 
                                            'article_title' => $article->article_title, 
                                            'cell_type' =>'population_class', 
                                            'cell_value' => $firs_row->population_class, 
                                            'text_error' => 'population_class not found']));
                //array_push($errors, 'population class not found.... '. $firs_row->population_class);
            }
            if(!is_null($typepopulation)){
                $type_id = $typepopulation->id;
                array_push($errors, new ImportLog(['action' => 'saved', 
                                            'article_title' => $article->article_title, 
                                            'cell_type' =>'population_type', 
                                            'cell_value' => $firs_row->population_type, 
                                            'text_error' => $firs_row->population_type.' population_type saved']));
            }elseif (!is_null($firs_row->population_type)) {
                //error buscando type
                array_push($errors, new ImportLog(['action' => 'not_found', 
                                            'article_title' => $article->article_title, 
                                            'cell_type' =>'population_type', 
                                            'cell_value' => $firs_row->population_type, 
                                            'text_error' => 'population_type not found']));

                //array_push($errors, 'population type not found.... '. $firs_row->population_type);
            }

            $population->type_id = $type_id;
            $population->class_id = $class_id;
            $population->gender_id = $gender_id;

            $inreply = new InReply();
            $authors_inreply=[];
            $classifications_inreply=[];

            //if(!is_null($firs_row->article_doi_original)){
            //    $article_parent = Article::where('doi_number', '=', $firs_row->article_doi_original)->first();
            //    $article->parent_id = $article_parent->id;
            //    Debugbar::alert('no soy null    '. $firs_row->article_doi_original);
            //}

            //if(!is_null($firs_row->article_doi_original)){
            //    $inreply->year = $firs_row->in_reply_year;
            //    $inreply->volume = $firs_row->in_reply_volume;
            //    $inreply->issue = $firs_row->in_reply_issue;
            //    $inreply->page_range_min = $firs_row->in_reply_page_min;
            //    $inreply->page_range_max = $firs_row->in_reply_page_max;
            //    $inreply->doi_number = $firs_row->in_reply_doi_link;
            //}

    		
            $coauthors = [];

    		$age_ranges=[];
    		$sample_sizes=[];

    		$objectives=[];

    		$implications=[];
    		$outcome_measures=[];

    		$types=[];
    		$classifications=[];

    		foreach($article_csv as $row)
            {
            	
            	if(!is_null($row->coauthor)){
            		$coauthor = Author::where('name', 'like', $row->coauthor.'%')->first();
            		array_push($coauthors, $coauthor);
            	}

            	if(!is_null($row->age_range_min)){
            		$ageRange = new AgeRange(['medium' => $row->age_range_median, 
            									'minimum' =>  $row->age_range_min, 
            									'maximum' =>  $row->age_range_max, 
            									'name' =>  $row->age_range_name]);
            		array_push($age_ranges, $ageRange);
            	}

            	if(!is_null($row->sample_size_number)){
            		$samplesize = new SampleSize(['size' => $row->sample_size_number, 
            									'option' => $row->sample_size_text]);
            		array_push($sample_sizes, $samplesize);
            	}

            	
            	if(!is_null($row->objectives)){
            		$objective = new StudyObjectives(['objective'=> $row->objectives]);
            		array_push($objectives, $objective);
            	}

            	if(!is_null($row->implications_of_study)){
            		$implication = ImplicationStudyList::whereRaw( 'LOWER(`name`) like ?', array( rtrim ('%'.$row->implications_of_study )))->first();

            		if(!is_null($implication)){
            			array_push($implications, array('list_id' => $implication->id));
                        array_push($errors, new ImportLog(['action' => 'saved', 
                                            'article_title' => $article->article_title, 
                                            'cell_type' =>'implications', 
                                            'cell_value' => $row->implications_of_study, 
                                            'text_error' => $row->implications_of_study.'implications_of_study saved']));
            		}else{
                        array_push($errors, new ImportLog(['action' => 'not_found', 
                                            'article_title' => $article->article_title, 
                                            'cell_type' =>'implications', 
                                            'cell_value' => $row->implications_of_study, 
                                            'text_error' => 'implications_of_study not found']));

                        //array_push($errors, 'Implication not found.... '. $row->implications_of_study);
                    }
            	}

            	if(!is_null($row->main_outcome_measures)){
            		$outcome_meas = OutcomeMeasureList::where('name','like',  rtrim ('%'.$row->main_outcome_measures))->first();
            		if(!is_null($outcome_meas)){
            			//Debugbar::info($row->main_outcome_measures.' found as.... '. $outcome_meas->name);
            			array_push($outcome_measures, array('list_id' => $outcome_meas->id));
                        array_push($errors, new ImportLog(['action' => 'saved', 
                                            'article_title' => $article->article_title, 
                                            'cell_type' =>'outcome_measures', 
                                            'cell_value' => $row->main_outcome_measures, 
                                            'text_error' => $row->main_outcome_measures.' main_outcome_measures saved']));
            		}else{
                        array_push($errors, new ImportLog(['action' => 'not_found', 
                                            'article_title' => $article->article_title, 
                                            'cell_type' =>'outcome_measures', 
                                            'cell_value' => $row->main_outcome_measures, 
                                            'text_error' => 'main_outcome_measures not found']));
                        //array_push($errors, 'Outcome Measure not found.... '. $row->main_outcome_measures);
                    }
            	}

            	if(!is_null($row->article_type)){
            		$type = ArticleType::whereRaw( 'LOWER(`name`) like ?', array( rtrim ('%'.$row->article_type)))->first();
            		if(!is_null($type))
                    {
            			array_push($types, array('list_id' => $type->id));
                        array_push($errors, new ImportLog(['action' => 'saved', 
                                            'article_title' => $article->article_title, 
                                            'cell_type' =>'article_type', 
                                            'cell_value' => $row->article_type, 
                                            'text_error' => $row->article_type.' article_type saved']));
                        //Debugbar::alert('Type found.... '. $row->article_type);
                    }
            		else{
                        array_push($errors, new ImportLog(['action' => 'not_found', 
                                            'article_title' => $article->article_title, 
                                            'cell_type' =>'article_type', 
                                            'cell_value' => $row->article_type, 
                                            'text_error' => 'article_type not found']));
                        //array_push($errors, 'Type not found.... '. $row->article_type);
                    }
            	}

            	if(!is_null($row->classification_a)){
            		$classa = ArticleClass::where('name','like',  rtrim ('%'.$row->classification_a))->
            							where('parent_id','=', 1)->first();
            		//Debugbar::alert($row->classification_a);
            		//Debugbar::alert($classa);
            		if(!is_null($classa)){
            			//Debugbar::info($row->classification_a.' found as.... '. $classa->name);
            			array_push($classifications, array('list_id' => $classa->id));
                        array_push($errors, new ImportLog(['action' => 'saved', 
                                            'article_title' => $article->article_title, 
                                            'cell_type' =>'classification_a', 
                                            'cell_value' => $row->classification_a, 
                                            'text_error' => $row->classification_a.' classification_a saved']));
            		}
            		else{
                        array_push($errors, new ImportLog(['action' => 'not_found', 
                                            'article_title' => $article->article_title, 
                                            'cell_type' =>'classification_a', 
                                            'cell_value' => $row->classification_a, 
                                            'text_error' => 'type pathology not found']));
                        
                        //array_push($errors, 'Class A not found.... '. $row->classification_a);
                    }
            	}

            	if(!is_null($row->classification_b)){
            		$classb = ArticleClass::where('name','like',  rtrim ('%'.$row->classification_b))->
            							where('parent_id','=', 2)->first();
            		if(!is_null($classb)){
            			array_push($classifications, array('list_id' => $classb->id));
                        array_push($errors, new ImportLog(['action' => 'saved', 
                                            'article_title' => $article->article_title, 
                                            'cell_type' =>'classification_b', 
                                            'cell_value' => $row->classification_b, 
                                            'text_error' => $row->classification_b.' classification_b saved']));
            		}else{
                        array_push($errors, new ImportLog(['action' => 'not_found', 
                                            'article_title' => $article->article_title, 
                                            'cell_type' =>'classification_b', 
                                            'cell_value' => $row->classification_b, 
                                            'text_error' => 'type cohort not found']));
                        
                        //array_push($errors, 'Class B not found.... '. $row->classification_b);
                    }
            	}

            	if(!is_null($row->classification_c)){
            		$classc = ArticleClass::where('name','like', rtrim ('%'.$row->classification_c))->
            								where('parent_id','=', 3)->first();
            		if(!is_null($classc)){
            			array_push($classifications, array('list_id' => $classc->id));
                        array_push($errors, new ImportLog(['action' => 'saved', 
                                            'article_title' => $article->article_title, 
                                            'cell_type' =>'classification_c', 
                                            'cell_value' => $row->classification_c, 
                                            'text_error' => $row->classification_c.' classification_c saved']));
            		}else{
                        array_push($errors, new ImportLog(['action' => 'not_found', 
                                            'article_title' => $article->article_title, 
                                            'cell_type' =>'classification_c', 
                                            'cell_value' => $row->classification_c, 
                                            'text_error' => 'type study design not found']));
                       
                        //array_push($errors, 'Class C not found.... '. $row->classification_c);
                    }
            	}
            }
            //
            //Debugbar::info($population);
            //Debugbar::info($age_ranges);
            //Debugbar::info($sample_sizes);
            //Debugbar::info($conclusions);
            //Debugbar::info($objectives);
            
            //Debugbar::info($implications);
            //Debugbar::info($recomendations);
            //Debugbar::info($outcome_measures);
            //Debugbar::info($classifications);

            
            $article->inreply()->save($inreply);

            $article->coauthors()->saveMany($coauthors);
            array_push($errors, new ImportLog(['action' => 'saved', 
                                            'article_title' => $article->article_title, 
                                            'cell_type' =>'coauthors', 
                                            'cell_value' => count($coauthors), 
                                            'text_error' => 'Coauthors saved '.count($coauthors)]));

            $population = $article->population()->save($population);
            $population->ageRange()->saveMany($age_ranges);
            array_push($errors, new ImportLog(['action' => 'saved', 
                                            'article_title' => $article->article_title, 
                                            'cell_type' =>'age_ranges', 
                                            'cell_value' => count($age_ranges), 
                                            'text_error' => 'age_ranges saved '.count($age_ranges)]));

            $population->sampleSize()->saveMany($sample_sizes);
            array_push($errors, new ImportLog(['action' => 'saved', 
                                            'article_title' => $article->article_title, 
                                            'cell_type' =>'sample_sizes', 
                                            'cell_value' => count($sample_sizes), 
                                            'text_error' => 'sample_sizes saved '.count($sample_sizes)]));       


                         
            $article->objectives()->saveMany($objectives);
            array_push($errors, new ImportLog(['action' => 'saved', 
                                            'article_title' => $article->article_title, 
                                            'cell_type' =>'objectives', 
                                            'cell_value' => count($objectives), 
                                            'text_error' => 'objectives saved '.count($objectives)]));

            

            //$article->implications()->saveMany($implications);
            if(count($implications)>0) $article->implications()->sync($implications);            

            if(count($outcome_measures)>0) $article->outcome_measures()->sync($outcome_measures);            
            
            if(count($types)>0) $article->type()->sync($types);            
            
            if(count($classifications)>0) $article->classification()->sync($classifications);
                
        }
        catch(\Illuminate\Database\QueryException $ex)
		{
			Debugbar::error('Article already in database: ' .$article->article_title);
			Debugbar::error($ex);
            array_push($errors, new ImportLog(['action' => 'error', 
                                        'article_title' => $article->article_title, 
                                        'cell_type' =>'article_title', 
                                        'cell_value' => $article->article_title, 
                                        'text_error' => 'Article already in database:'.$ex]));

            //array_push($errors, 'Article already in database: ' .$article->article_title);
		}
		catch(\Exception $ex)
		{
			Debugbar::error('fdfdfsdfsdfsdfsdf' .$article->article_title);
			Debugbar::error($ex);
            //array_push($errors, 'fdfdfsdfsdfsdfsdf' .$article->article_title);
            array_push($errors, new ImportLog(['action' => 'error', 
                                        'article_title' => $article->article_title, 
                                        'cell_type' =>'WTF', 
                                        'cell_value' => $article->article_title, 
                                        'text_error' => 'WTF:'.$ex]));
		}

        return $errors;
	}

	private function updateMailAuthor($article){

		foreach($article as $row)
        {
        	if(!is_null($row->corresponding_author_name)){
        		//Debugbar::info('mail  - '.$row->correspondin_author_name);
        		$ob_tmp = Author::whereRaw( 'LOWER(`name`) like ?', array( rtrim ('%'.$row->corresponding_author_name)))->first();

        		if(!is_null($ob_tmp)){
        			$ob_tmp->email = $row->corresponding_author_email;
        			//save author
        			$ob_tmp->save();
        			//Debugbar::info($ob_tmp);
        		}
        		else{
        			//Debugbar::error('ERROR UPDATING EMAIL '. $row->corresponding_author_name);
                    //array_push($errors, 'ERROR UPDATING EMAIL '. $row->corresponding_author_name);
                }
        	}
        }
	}

	private function importAuthors($article){
        $errors = [];

		$author = new Author();
		$coauthor=[];
		$affiliations=[];
		$coauthor_affiliations=[];
		//Debugbar::info(' lead author - '.$article->get(0)->lead_author);
		
		$author->name = rtrim($article->get(0)->lead_author);
        $article_title = $article->get(0)->article_title;
		try{
			$author->save();
            array_push($errors, new ImportLog(['action' => 'saved', 
                                        'article_title' => $article_title, 
                                        'cell_type' =>'author', 
                                        'cell_value' => $author->name, 
                                        'text_error' => 'Author saved:'. $author->name]));
			//author affiliations
			foreach($article as $row)
	        {
	        	$affi_tmp = new Affiliation();
	        	if(!is_null($row->lead_author_affiliation_population))
	        	{
		        	$affi_tmp->affiliation_population = $row->lead_author_affiliation_population;
		        }
		        if(!is_null($row->lead_author_affiliation_country))
	        	{
		        	$affi_tmp->affiliation_country = $row->lead_author_affiliation_country;
		        }
	        	if(!is_null($row->lead_author_affiliation))
	        	{	        	
		        	$affi_tmp->affiliation = $row->lead_author_affiliation;
		        	array_push($affiliations, $affi_tmp);	        	
		        }
	        }
	        $author->affiliations()->saveMany($affiliations);
        }
		catch(\Illuminate\Database\QueryException $ex)
		{
            //Debugbar::error('Autor en base de datos: ' .$author->name);
			//Debugbar::error($ex);
            array_push($errors, new ImportLog(['action' => 'error', 
                                        'article_title' => $article_title, 
                                        'cell_type' =>'author', 
                                        'cell_value' => $author->name, 
                                        'text_error' => 'Author already in database:'.$ex]));
		}

		$coauthor_TMP = null;
		foreach($article as $row)
        {
        	$affi_tmp = new Affiliation();
        	if(!is_null($row->coauthor))
        	{
        		if(!is_null($coauthor_TMP)) {
        			//guardar coauthor y sus coauthor_affiliations
        			$ob_tmp = Author::whereRaw( 'LOWER(`name`) like ?', array( rtrim ('%'.$coauthor_TMP->name)))->first();

        			if(is_null($ob_tmp)){
        				try{
                            $coauthor_TMP->save();
                            array_push($errors, new ImportLog(['action' => 'saved', 
                                        'article_title' => $article_title, 
                                        'cell_type' =>'coauthor', 
                                        'cell_value' => $coauthor_TMP->name, 
                                        'text_error' => 'Coauthor saved:'. $coauthor_TMP->name]));
        				    $coauthor_TMP->affiliations()->saveMany($coauthor_affiliations);
	        			    //Debugbar::info("coauthor saved");
                        }catch(\Illuminate\Database\QueryException $ex)
                        {
                            //Debugbar::error('Autor en base de datos: ' .$author->name);
                            //Debugbar::error($ex);
                            array_push($errors, new ImportLog(['action' => 'error', 
                                        'article_title' => $article_title, 
                                        'cell_type' =>'WTF coauthor', 
                                        'cell_value' => $coauthor_TMP->name, 
                                        'text_error' => 'WTF Coauthor en base de datos:'. $coauthor_TMP->name]));
                        }
        				
        			}else{
        				//$ob_tmp->affiliations()->saveMany($coauthor_affiliations);
        				//Debugbar::error('CoAutor en base de datos: ' .$ob_tmp->name);
                        array_push($errors, new ImportLog(['action' => 'error', 
                                        'article_title' => $article_title, 
                                        'cell_type' =>'coauthor', 
                                        'cell_value' => $coauthor_TMP->name, 
                                        'text_error' => 'Coauthor en base de datos:'. $coauthor_TMP->name]));
        			}
        		}
        		$coauthor_affiliations = [];
        		$coauthor_TMP = new Author();
        		$coauthor_TMP->name = $row->coauthor;
	        }

	        if(!is_null($row->coauthor_affiliation_population))
        	{
	        	$affi_tmp->affiliation_population = $row->coauthor_affiliation_population;
	        }
	        if(!is_null($row->coauthor_affiliation_country))
        	{
	        	$affi_tmp->affiliation_country = $row->coauthor_affiliation_country;
	        }
        	if(!is_null($row->coauthor_affiliation))        	{
	        	
	        	$affi_tmp->affiliation = $row->coauthor_affiliation;
	        	array_push($coauthor_affiliations, $affi_tmp);	        	
	        }
        }
        if(!is_null($coauthor_TMP)) { 					
			//guardar coauthor y sus coauthor_affiliations
			$ob_tmp = Author::whereRaw( 'LOWER(`name`) like ?', array( rtrim ('%'.$coauthor_TMP->name)))->first();
			if(is_null($ob_tmp)){
				$coauthor_TMP->save();
				$coauthor_TMP->affiliations()->saveMany($coauthor_affiliations);
                array_push($errors, new ImportLog(['action' => 'saved', 
                                        'article_title' => $article_title, 
                                        'cell_type' =>'coauthor', 
                                        'cell_value' => $coauthor_TMP->name, 
                                        'text_error' => 'Coauthor saved:'. $coauthor_TMP->name]));
    			//Debugbar::info("coauthor saved");
			}else{
				//$ob_tmp->affiliations()->saveMany($coauthor_affiliations);
				//Debugbar::error('CoAutor en base de datos: ' .$ob_tmp->name);
                array_push($errors, new ImportLog(['action' => 'error', 
                                        'article_title' => $article_title, 
                                        'cell_type' =>'coauthor', 
                                        'cell_value' => $coauthor_TMP->name, 
                                        'text_error' => 'Coauthor en base de datos:'. $coauthor_TMP->name]));
			}
        }

        return $errors;
	}



	public function getArticleTypeList(){

		//Debugbar::info('getList');
		$salida = ArticleType::orderBy('id', 'asc')->lists('name','id');
		
		return $salida;
	}

	public function getClassificationList(){

		$salida = ArticleClass::where('parent_id', '=', null)->orderBy('id', 'asc')->get();
		//Debugbar::info($salida);
		$fin=array();
		if(!is_null($salida)&& count($salida)>0){
			foreach ($salida as $study) {
				
				if($study->has_children)
				{
					$tmpCH = $this->getChilds($study);
					if(!is_null($tmpCH)&&count($tmpCH)>0){

						$fin =array_add($fin,$study->name , $tmpCH);			
					}else{
						$fin =array_add($fin, $study->id , $study->name);
						//Debugbar::info($fin);
					}
				}else{
					$fin =array_add($fin, $study->id , $study->name);
				}
			}
		}else{
			$fin = array(  $salida->name, $salida->id);
		}
		//Debugbar::info($fin);		
		return $fin;
	}

	public function getPopulationTypeList($id){

		$salida = PopulationType::where('parent_id', '=', $id)->orderBy('id', 'asc')->get();
		//Debugbar::info($salida);
		$fin=array();
		if(!is_null($salida)&& count($salida)>0){
			foreach ($salida as $study) {
				
				if($study->has_children)
				{
					$tmpCH = $this->getChilds($study);
					if(!is_null($tmpCH)&&count($tmpCH)>0){

						$fin =array_add($fin,$study->name , $tmpCH);			
					}else{
						$fin =array_add($fin, $study->id , $study->name);
						//Debugbar::info($fin);
					}
				}else{
					$fin =array_add($fin, $study->id , $study->name);
				}
			}
		}else{
			$fin = null;
		}
		//Debugbar::info($fin);		
		return $fin;
	}



	public function getPopulationClassList($id){

		$salida = PopulationClass::where('parent_id', '=', $id)->orderBy('id', 'asc')->get();
		//Debugbar::info($salida);
		$fin=array();
		if(!is_null($salida)&& count($salida)>0){
			foreach ($salida as $study) {
				
				if($study->hasChildren())
				{
					$tmpCH = $this->getChilds($study);
                    Debugbar::info($tmpCH);
					if(!is_null($tmpCH)&&count($tmpCH)>0){

						$fin =array_add($fin,$study->name , $tmpCH);			
					}else{
						$fin =array_add($fin, $study->id , $study->name);
						//Debugbar::info($fin);
					}
				}else{
					$fin =array_add($fin, $study->id , $study->name);
				}
			}
		}else{
			$fin = null;
		}
		//Debugbar::info($fin);		
		return $fin;
	}

	public function getChilds(MyList $list){
		$childs = $list->childs;
		$fin=array();
		
        if(is_null($childs)){
			$fin = $list->lists('name','id');
		}
		else
		{
			foreach ($childs as $child) 
			{
				if($child->hasChildren())
				{
					$tmpCH = $this->getChilds($child);
                    //Debugbar::alert($child);
					if(!is_null($tmpCH)&&count($tmpCH)>0)
					{
						$fin =array_add($fin, $child->name , $tmpCH);											
					}
					else
					{
						$fin =array_add($fin, $child->id , $child->name);
					}				
				}
				else
				{
					$fin =array_add($fin, $child->id , $child->name);
				}				
			}
		}
		return $fin;
	}

}
