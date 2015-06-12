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

		$article->summary = 'DF Summary for the article';
        
        //$article->save();

        $article = $author->articleAuthor()->save($article);

        $coauthor2 = Author::find(2);
        $coauthor3 = Author::find(3);

        $article->coauthors()->attach($coauthor2);
        $article->coauthors()->attach($coauthor3);
		
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