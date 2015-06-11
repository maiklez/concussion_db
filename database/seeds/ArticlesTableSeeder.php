<?php

use App\Models\Author\Author;

use App\Models\Article\Article;
use App\Models\Article\AgeRange;
use App\Models\Article\SampleSize;
use App\Models\Article\Conclusion;
use App\Models\Article\StudyObjectives;
use App\Models\Article\StudyPopulation;
use App\Models\Article\StudyResult;


use App\Models\Lists\ArticleClass;
use App\Models\Lists\ArticleType;
use App\Models\Lists\ImplicationStudyList;
use App\Models\Lists\OutcomeMeasureList;
use App\Models\Lists\PopulationType;
use App\Models\Lists\Gender;
use App\Models\Lists\PopulationClass;


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ArticlesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		
		$author = Author::find(1);

		$article = new Article();

		$artType = ArticleType::find(1);		
		$artClass = ArticleClass::find(3);

		$article->type_id = $artType->id;
		$article->class_id = $artClass->id;

		$article->article_title = 'Blood Biomarkers for Brain Injury in Concussed Professional Ice Hockey Players';
        $article->journal_title = 'JAMA Neurology';
        $article->year = date('2014');
		$article->volume = 71;
		$article->issue = 6;
		$article->page_range_min = 684;
		$article->page_range_max = 692;
		$article->doi_number = '10.1001/jamaneurol.2014.367';
		$article->doi_number_prefix = '10.1001';
		$article->doi_number_journal = 'jamaneurol';
		$article->doi_number_year = '2014';
		$article->doi_number_number = '367';
		$article->crossref_link = 'http://dx.doi.org/10.1001/jamaneurol.2014.367';

		$article->design = 'Physical and Neuropsychological examination at baseline. Blood samples collected at 1, 12, 36, and 48 hours. For concussed players, additional blood samples collected at 144 hours or the date player returned to unrestricted competition.';
		$article->summary = 'DF Summary for the article';
        
        //$article->save();

        $article = $author->articleAuthor()->save($article);

        $coauthor2 = Author::find(2);
        $coauthor3 = Author::find(3);

        $article->coauthors()->attach($coauthor2);
        $article->coauthors()->attach($coauthor3);

        $conclusions = [
		    new Conclusion(['conclussion' => 'Plasma levels of T-tau increased in ice hocky players diagnosed with sports-related concussion']),
		    new Conclusion(['conclussion' => 'T-tau levels were highest immediately after injury, levels declined during first 12h and second peak between 12&36h']),
		    new Conclusion(['conclussion' => 'T-tau concentration at 1h after concussion predicted days taken for concussion symptoms to resolve and allow safe RTP']),
   		    new Conclusion(['conclussion' => 'Plasma T-tau is a promising biomarker for use in concussion diagnosis nd in decision making regarding when an atheleter is fit for RTP'])

		];

        $article->conclusion()->saveMany($conclusions);


        $results = [
        	new StudyResult	(['result' => 'No correlation between biomarker levels at baseline and age./n', 
        						'image_link' =>'' ]),
			new StudyResult	(['result' => 'T-tau levels were significantly increase in postconcussion samples vs preseason samples (p=0.002). /n', 
        						'image_link' =>'' ]),
			new StudyResult	(['result' => 'No significant increase in S-100B in postconcussion samples vs preseason/n', 
        						'image_link' =>'' ]),
			new StudyResult	(['result' => 'Levels of T-tau (P<0.001) and S-100B (P<0.001) higher immediately after a concussion vs preseason/n', 
        						'image_link' =>'' ]),
			new StudyResult	(['result' => 'Levels of S-100B and NSE, not T-tau, increased after a friendly game without concussion vs baseline/n', 
        						'image_link' =>'' ]),
			new StudyResult	(['result' => 'T-tau had an AUC of 0.91 when 1h postconcussion samples were compared with 1h post friendly game/n', 
        						'image_link' =>'' ]),
			new StudyResult	(['result' => 'High T-tau levels at 144 hours after concussion correlated with persistence of PCS/n', 
        						'image_link' =>'' ])	    				
		];

        $article->results()->saveMany($results);

		
		$l1 = ImplicationStudyList::find(3);
		$article->implications()->attach($l1);

		$l2 = ImplicationStudyList::find(8);
		$article->implications()->attach($l2);


		$o1 = OutcomeMeasureList::find(3);
		$article->outcome_measures()->attach($o1);

		$o2 = OutcomeMeasureList::find(8);
		$article->outcome_measures()->attach($o2);


		//Study objectives
		$objective = new StudyObjectives(['objective'=> 'To determine whether sports-related concussion is associated with elevated levels of blood biochemical markers of injury to the central nervous system.']);
		$article->objectives()->save($objective);

		//Study population
		$gender = Gender::find(3);
		$typepopulation = PopulationType::find(7);

		$catpopulation = PopulationClass::find(3);


		$population = new StudyPopulation(['type_id'=> $typepopulation->id ,'class_id'=> $catpopulation->id ,  'gender_id'=>$gender->id]);
		$article->population()->save($population);

		$ageRange = new AgeRange(['medium' => 28, 'minimum' => 19, 'maximum' => 38, 'name' => '']);
		$ageRange1 = new AgeRange(['medium' => 27, 'minimum' => 19, 'maximum' => 40, 'name' => '']);

		$population->ageRange()->save($ageRange);
		$population->ageRange()->save($ageRange1);

		$samplesize = new SampleSize(['size' => 27, 'option' => '']);

		$population->sampleSize()->save($samplesize);
	}

}