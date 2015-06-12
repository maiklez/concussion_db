<?php

use App\Models\Lists\BiomarkerType;
use App\Models\Lists\EventList;
use App\Models\Lists\Gender;
use App\Models\Lists\ImplicationStudy;
use App\Models\Lists\PopulationType;
use App\Models\Lists\StudyMethodList;
use App\Models\Lists\StudyObjectivesList;


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ListsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        DB::table('list_article_type')->delete();
        $artType = array(
            array(
                'id'      => 1,
                'parent_id'      => null,
                'name'    => 'Any',
                'has_children' => 'false',
            ),
        	array(
                'id'      => 2,
                'parent_id'      => null,
                'name'    => 'Original Research',
                'has_children' => 'false',
            ),
            array(
                'id'      => 3,
                'parent_id'      => null,
                'name'    => 'Commentary on original research',
                'has_children' => 'false',
            ),
            array(
                'id'      => 4,
                'parent_id'      => null,
                'name'    => 'Consensus statement',
                'has_children' => 'false',
            ),
            array(
                'id'      => 5,
                'parent_id'      => null,
                'name'    => 'Opinion article',
                'has_children' => 'false',
            ),
            array(
                'id'      => 6,
                'parent_id'      => null,
                'name'    => 'Review',
                'has_children' => 'false',
            ),
            array(
                'id'      => 7,
                'parent_id'      => null,
                'name'    => 'Meta-analysis',
                'has_children' => 'false',
            ),
            array(
                'id'      => 8,
                'parent_id'      => null,
                'name'    => 'Other',
                'has_children' => 'false',
            )
        );
        DB::table('list_article_type')->insert( $artType );

        DB::table('list_article_class')->delete();
        $artclass = array(
            array(
                'id'      => 1,
                'parent_id'      => null,
                'name'    => 'Type of pathology',
                'has_children' => '1',
            ),
            array(
                'id'      => 2,
                'parent_id'      => null,
                'name'    => 'Type of cohort',
                'has_children' => '1',
            ),
            array(
                'id'      => 3,
                'parent_id'      => null,
                'name'    => 'Type of study design',
                'has_children' => '1',
            ),
        	//Type of pathology - 1 
            array(
                'id'      => 4,
                'parent_id' => 1,
                'name'    => 'Any',
                'has_children' => 'false',
            ),
            array(
                'id'      => 5,
                'parent_id' => 1,
                'name'    => 'mTBI/Concussion',
                'has_children' => 'false',
            ),
            array(
                'id'      => 6,
                'parent_id' => 1,
                'name'    => 'TBI',
                'has_children' => 'false',
            ),
            array(
                'id'      => 7,
                'parent_id' => 1,
                'name'    => 'CTE',
                'has_children' => 'false',
            ),
            array(
                'id'      => 8,
                'parent_id' => 1,
                'name'    => 'CNI',
                'has_children' => 'false',
            ),
            array(
                'id'      => 9,
                'parent_id' => 1,
                'name'    => 'Post-concussion Syndrome (PCS)',
                'has_children' => 'false',
            ),
            array(
                'id'      => 10,
                'parent_id' => 1,
                'name'    => 'Other',
                'has_children' => 'false',
            ),
			//Type of cohort - 2
            array(
                'id'      => 11,
                'parent_id' => 2,
                'name'    => 'Any',
                'has_children' => 'false',
            ),
            array(
                'id'      => 12,
                'parent_id' => 2,
                'name'    => 'Sports-related',
                'has_children' => 'false',
            ),
            array(
                'id'      => 13,
                'parent_id' => 2,
                'name'    => 'Traumatic injury',
                'has_children' => 'false',
            ),
            array(
                'id'      => 14,
                'parent_id' => 2,
                'name'    => 'Veteran / Military',
                'has_children' => 'false',
            ),
            array(
                'id'      => 15,
                'parent_id' => 2,
                'name'    => 'Animal',
                'has_children' => 'false',
            ),
        	array(
        		'id'      => 16,
        		'parent_id' => 2,
        		'name'    => 'Other',
        		'has_children' => 'false',
        	),
			//Type of study design
            array(
                'id'      => 17,
                'parent_id' => 3,
                'name'    => 'Any',
                'has_children' => 'false',
            ),
            array(
                'id'      => 18,
                'parent_id' => 3,
                'name'    => 'Cross-sectional',
                'has_children' => 'false',
            ),
            array(
                'id'      => 19,
                'parent_id' => 3,
                'name'    => 'Longitudinal study',
                'has_children' => 'false',
            ),
            array(
                'id'      => 20,
                'parent_id' => 3,
                'name'    => 'Case-control',
                'has_children' => 'false',
            ),
            array(
                'id'      => 21,
                'parent_id' => 3,
                'name'    => 'Meta-Analysis',
                'has_children' => 'false',
            ),
            array(
                'id'      => 22,
                'parent_id' => 3,
                'name'    => 'Review',
                'has_children' => 'false',
            ),
            array(
                'id'      => 23,
                'parent_id' => 3,
                'name'    => 'Consensus Document',
                'has_children' => 'false',
            ),
            array(
                'id'      => 24,
                'parent_id' => 3,
                'name'    => 'Other',
                'has_children' => 'false',
            )
        );
        DB::table('list_article_class')->insert( $artclass );


        DB::table('list_population_class')->delete();
        $poptype = array(
            array(
                'id'      => 1,
                'parent_id'      => null,
                'name'    => 'Sports professional',
                'has_children' => '1',
            ),
        	array(
        		'id'      => 2,
        		'parent_id'      => null,
        		'name'    => 'Sports amateur',
        		'has_children' => '1',
        	),
            array(
                'id'      => 3,
                'parent_id'      => null,
                'name'    => 'Other',
                'has_children' => '1',
            ),
        	
        	//Sports professional
            array(
                'id'      => 4,
                'parent_id'      => 1,
                'name'    => 'American football (NFL)',
                'has_children' => 'false',
            ),
            array(
                'id'      => 5,
                'parent_id'      => 1,
                'name'    => 'Australian football (AFL)',
                'has_children' => 'false',
            ),
             array(
                'id'      => 6,
                'parent_id' => 1,
                'name'    => 'Rugby',
                'has_children' => 'false',
            ),
             array(
                'id'      => 7,
                'parent_id' => 1,
                'name'    => 'Ice hockey',
                'has_children' => 'false',
            ),
             array(
                'id'      => 8,
                'parent_id' => 1,
                'name'    => 'Field hockey',
                'has_children' => 'false',
            ),
             array(
                'id'      => 9,
                'parent_id' => 1,
                'name'    => 'Soccer',
                'has_children' => 'false',
            ),
             array(
                'id'      => 10,
                'parent_id' => 1,
                'name'    => 'Boxing',
                'has_children' => 'false',
            ),
             array(
                'id'      => 11,
                'parent_id' => 1,
                'name'    => 'Equestrian',
                'has_children' => 'false',
            ),
             array(
                'id'      => 12,
                'parent_id' => 1,
                'name'    => 'Mixed martial arts',
                'has_children' => 'false',
            ),
             array(
                'id'      => 13,
                'parent_id' => 1,
                'name'    => 'Other',
                'has_children' => 'false',
            ),
             array(
                'id'      => 14,
                'parent_id' => 1,
                'name'    => 'Not stated',
                'has_children' => 'false',
            ),

             //Sports amateur
            array(
                'id'      => 15,
                'parent_id'      => 2,
                'name'    => 'American football (NFL)',
                'has_children' => 'false',
            ),
            array(
                'id'      => 16,
                'parent_id'      => 2,
                'name'    => 'Australian football (AFL)',
                'has_children' => 'false',
            ),
             array(
                'id'      => 17,
                'parent_id' => 2,
                'name'    => 'Rugby',
                'has_children' => 'false',
            ),
             array(
                'id'      => 18,
                'parent_id' => 2,
                'name'    => 'Ice hockey',
                'has_children' => 'false',
            ),
             array(
                'id'      => 19,
                'parent_id' => 2,
                'name'    => 'Field hockey',
                'has_children' => 'false',
            ),
             array(
                'id'      => 20,
                'parent_id' => 2,
                'name'    => 'Soccer',
                'has_children' => 'false',
            ),
             array(
                'id'      => 21,
                'parent_id' => 2,
                'name'    => 'Boxing',
                'has_children' => 'false',
            ),
             array(
                'id'      => 22,
                'parent_id' => 2,
                'name'    => 'Equestrian',
                'has_children' => 'false',
            ),
             array(
                'id'      => 23,
                'parent_id' => 2,
                'name'    => 'Mixed martial arts',
                'has_children' => 'false',
            ),
             array(
                'id'      => 24,
                'parent_id' => 2,
                'name'    => 'Other',
                'has_children' => 'false',
            ),
             array(
                'id'      => 25,
                'parent_id' => 2,
                'name'    => 'Not stated',
                'has_children' => 'false',
            ),

            //Other
            array(
                'id'      => 26,
                'parent_id' => 3,
                'name'    => 'Military/Veterans',
                'has_children' => 'false',
            ),
            array(
                'id'      => 27,
                'parent_id' => 3,
                'name'    => 'Trauma patients',
                'has_children' => 'false',
            )

        );
        DB::table('list_population_class')->insert( $poptype );


        DB::table('list_population_type')->delete();
        $popclass = array(
            array(
                'id'      => 1,
                'parent_id'      => null,
                'name'    => 'Human',
                'has_children' => '1',
            ),
            array(
                'id'      => 2,
                'parent_id'      => null,
                'name'    => 'Animal',
                'has_children' => '1',
            ),
            array(
                'id'      => 3,
                'parent_id'      => null,
                'name'    => 'Other',
                'has_children' => '1',
            ),

            //Human - 1
            array(
                'id'      => 4,
                'parent_id'      => 1,
                'name'    => 'Any',
                'has_children' => 'false',
            ),
            array(
                'id'      => 5,
                'parent_id'      => 1,
                'name'    => 'Paediatric',
                'has_children' => 'false',
            ),
            array(
                'id'      => 6,
                'parent_id' => 1,
                'name'    => 'Youth',
                'has_children' => 'false',
            ),
            array(
                'id'      => 7,
                'parent_id' => 1,
                'name'    => 'Adult',
                'has_children' => 'false',
            ),
            array(
                'id'      => 8,
                'parent_id' => 1,
                'name'    => 'Ederly',
                'has_children' => 'false',
            ),

            //Animal - 2
            array(
                'id'      => 9,
                'parent_id'      => 2,
                'name'    => 'Any',
                'has_children' => 'false',
            ),
            array(
                'id'      => 10,
                'parent_id' => 2,
                'name'    => 'Rodent',
                'has_children' => 'false',
            ),
            array(
                'id'      => 11,
                'parent_id' => 2,
                'name'    => 'Primate',
                'has_children' => 'false',
            )
            ,array(
                'id'      => 12,
                'parent_id'      => 2,
                'name'    => 'Other',
                'has_children' => 'false',
            )

            //Other - 3
            ,array(
                'id'      => 13,
                'parent_id'      => 3,
                'name'    => 'Post-mortem',
                'has_children' => 'false',
            )
            ,array(
                'id'      => 14,
                'parent_id'      => 3,
                'name'    => 'Modelling study',
                'has_children' => 'false',
            )

        );
        DB::table('list_population_type')->insert( $popclass );

        DB::table('list_gender')->delete();
        $gender = array(
            array(
                'id'      => 1,
                'parent_id'      => null,
                'name'    => 'Male',
                'has_children' => 'false',
            ),
            array(
                'id'      => 2,
                'parent_id'      => null,
                'name'    => 'Female',
                'has_children' => 'false',
            ),
            array(
                'id'      => 3,
                'parent_id'      => null,
                'name'    => 'Presumed male (not stated)',
                'has_children' => 'false',
            ),
            array(
                'id'      => 4,
                'parent_id'      => null,
                'name'    => 'Presumed female (not stated)',
                'has_children' => 'false',
            ),
            array(
                'id'      => 5,
                'parent_id'      => null,
                'name'    => 'Male and Female',
                'has_children' => 'false',
            )
        );
        DB::table('list_gender')->insert( $gender );


        DB::table('list_implication_study')->orderBy('parent_id', 'desc')->delete();
        $implications = array(
            array(
                'id'      => 1,
                'parent_id'      => null,
                'name'    => 'Prevention',
                'has_children' => 'false',
            ),
            array(
                'id'      => 2,
                'parent_id'      => null,
                'name'    => 'Diagnosis',
                'has_children' => 'false',
            ),
            array(
                'id'      => 3,
                'parent_id'      => null,
                'name'    => 'Prognosis',
                'has_children' => 'false',
            ),
            array(
                'id'      => 4,
                'parent_id'      => null,
                'name'    => 'Treatment',
                'has_children' => 'false',
            ),
            array(
                'id'      => 5,
                'parent_id'      => null,
                'name'    => 'Guidelines',
                'has_children' => 'false',
            ),            
            array(
                'id'      => 6,
                'parent_id'      => null,
                'name'    => 'Research',
                'has_children' => 'false',
            )
        );
        DB::table('list_implication_study')->insert( $implications );


        DB::table('list_outcome_measures')->orderBy('parent_id', 'desc')->delete();
        $methods = array(
            array(
                'id'      => 1,
                'parent_id'      => null,              
                'name'    => 'Neuropsychological test',
                'has_children' => '1',
            ),
            array(
                'id'      => 2,
                'parent_id'      => null,
                'name'    => 'Symptoms',
                'has_children' => '1',
            ),
            array(
                'id'      => 3,
                'parent_id'      => null,
                'name'    => 'Fluid based',
                'has_children' => '1',
            ),
            array(
                'id'      => 4,
                'parent_id'      => null,
                'name'    => 'Imaging based',
                'has_children' => '1',
            ),
            array(
                'id'      => 5,
                'parent_id'      => null,
                'name'    => 'Neurophysiological',
                'has_children' => '1',

            ),

            //Neuropsychological test
            array(
                'id'      => 6,
                'parent_id'      => 1,
                'name'    => 'Standardized Assessment of Concussion',
                'has_children' => 'false',
            ),
            array(
                'id'      => 7,
                'parent_id'      => 1,
                'name'    => 'Rivermead Post Concussion Symptoms Questionnaire',
                'has_children' => 'false',
            ),
            array(
                'id'      => 8,
                'parent_id'      => 1,
                'name'    => 'SCAT2',
                'has_children' => 'false',
            ),
            array(
                'id'      => 9,
                'parent_id'      => 1,
                'name'    => 'SCAT3',
                'has_children' => 'false',
            ),
            array(
                'id'      => 10,
                'parent_id'      => 1,
                'name'    => 'Addenbrooke’s Cognitive Assessment ',
                'has_children' => 'false',
            ),
            array(
                'id'      => 11,
                'parent_id'      => 1,
                'name'    => 'Montreal Cognitive Assessment',
                'has_children' => 'false',
            ),
            array(
                'id'      => 12,
                'parent_id'      => 1,
                'name'    => 'Movement Disorders Society Unified Parkinson’s Disease Rating Scale',
                'has_children' => 'false',
            ),
            array(
                'id'      => 13,
                'parent_id'      => 1,
                'name'    => 'Hopkins Verbal Learning Test-Revised (HVLT-R)',
                'has_children' => 'false',
            ),
            array(
                'id'      => 14,
                'parent_id'      => 1,
                'name'    => 'Glasgow Coma Scale',
                'has_children' => 'false',
            ),
            array(
                'id'      => 15,
                'parent_id'      => 1,
                'name'    => 'King-Devick Test',
                'has_children' => 'false',
            ),
            array(
                'id'      => 16,
                'parent_id'      => 1,
                'name'    => 'Other',
                'has_children' => 'false',
            ),
            array(
                'id'      => 17,
                'parent_id'      => 1,
                'name'    => 'Not-stated',
                'has_children' => 'false',
            ),

            //Symptom
            array(
                'id'      => 18,
                'parent_id'      => 2,
                'name'    => 'Attentional dysfunction',
                'has_children' => 'false',
            ),
            array(
                'id'      => 19,
                'parent_id'      => 2,
                'name'    => 'Memory problems',
                'has_children' => 'false',
            ),
            array(
                'id'      => 20,
                'parent_id'      => 2,
                'name'    => 'Slowed processing speed',
                'has_children' => 'false',
            ),
            array(
                'id'      => 21,
                'parent_id'      => 2,
                'name'    => 'Altered mood',
                'has_children' => 'false',
            ),
            array(
                'id'      => 22,
                'parent_id'      => 2,
                'name'    => 'Depression',
                'has_children' => 'false',
            ),
            array(
                'id'      => 23,
                'parent_id'      => 2,
                'name'    => 'Ataxia',
                'has_children' => 'false',
            ),
            array(
                'id'      => 24,
                'parent_id'      => 2,
                'name'    => 'Spasticity',
                'has_children' => 'false',
            ),
            array(
                'id'      => 25,
                'parent_id'      => 2,
                'name'    => 'Loss of motor control',
                'has_children' => 'false',
            ),
            array(
                'id'      => 26,
                'parent_id'      => 2,
                'name'    => 'Other',
                'has_children' => 'false',
            ),
            array(
                'id'      => 27,
                'parent_id'      => 2,
                'name'    => 'Not stated',
                'has_children' => 'false',
            ),

            //Fluid based
            array(
                'id'      => 28,
                'parent_id'      => 3,
                'name'    => 'S-100B (glial)',
                'has_children' => 'false',
            ),
            array(
                'id'      => 29,
                'parent_id'      => 3,
                'name'    => 'NSE (also known as gamma-enolase)',
                'has_children' => 'false',
            ),
            array(
                'id'      => 30,
                'parent_id'      => 3,
                'name'    => 'T-tau',
                'has_children' => 'false',
            ),
            array(
                'id'      => 31,
                'parent_id'      => 3,
                'name'    => 'tau fragments',
                'has_children' => 'false',
            ),
            array(
                'id'      => 32,
                'parent_id'      => 3,
                'name'    => 'NFL',
                'has_children' => 'false',
            ),
            array(
                'id'      => 33,
                'parent_id'      => 3,
                'name'    => 'UCH-L1',
                'has_children' => 'false',
            ),
            array(
                'id'      => 34,
                'parent_id'      => 3,
                'name'    => 'CSF',
                'has_children' => 'false',
            ),
            array(
                'id'      => 35,
                'parent_id'      => 3,
                'name'    => 'Interleukins',
                'has_children' => 'false',
            ),
            array(
                'id'      => 36,
                'parent_id'      => 3,
                'name'    => 'Myelin basic protein',
                'has_children' => 'false',
            ),
            array(
                'id'      => 37,
                'parent_id'      => 3,
                'name'    => 'GFAP',
                'has_children' => 'false',
            ),
            array(
                'id'      => 38,
                'parent_id'      => 3,
                'name'    => 'Amyloid-beta',
                'has_children' => 'false',
            ),
            array(
                'id'      => 39,
                'parent_id'      => 3,
                'name'    => 'APP',
                'has_children' => 'false',
            ),
            array(
                'id'      => 40,
                'parent_id'      => 3,
                'name'    => 'Spectrin breakdown products',
                'has_children' => 'false',
            ),
            array(
                'id'      => 41,
                'parent_id'      => 3,
                'name'    => 'Ubiquitin carboxyl-terminal hydrolase isoenzyme L1',
                'has_children' => 'false',
            ),
            array(
                'id'      => 42,
                'parent_id'      => 3,
                'name'    => 'RNA molecules',
                'has_children' => 'false',
            ),

            //Imaging Based - 4
            array(
                'id'      => 43,
                'parent_id'      => 4,
                'name'    => 'DTI',
                'has_children' => 'false',
            ),
            array(
                'id'      => 44,
                'parent_id'      => 4,
                'name'    => 'DWI',
                'has_children' => 'false',
            ),
            array(
                'id'      => 45,
                'parent_id'      => 4,
                'name'    => 'fMRI',
                'has_children' => 'false',
            ),
            array(
                'id'      => 46,
                'parent_id'      => 4,
                'name'    => 'Resting state fMRI (rsfMRI)',
                'has_children' => 'false',
            ),
            array(
                'id'      => 47,
                'parent_id'      => 4,
                'name'    => 'T1-weighted',
                'has_children' => 'false',
            ),
            array(
                'id'      => 48,
                'parent_id'      => 4,
                'name'    => 'T2-weighted',
                'has_children' => 'false',
            ),
            array(
                'id'      => 49,
                'parent_id'      => 4,
                'name'    => 'VBM',
                'has_children' => 'false',
            ),
            array(
                'id'      => 50,
                'parent_id'      => 4,
                'name'    => 'MRS',
                'has_children' => 'false',
            ),
            array(
                'id'      => 51,
                'parent_id'      => 4,
                'name'    => 'PET',
                'has_children' => 'false',
            ),
            array(
                'id'      => 52,
                'parent_id'      => 4,
                'name'    => 'CT',
                'has_children' => 'false',
            ),
            
            // Neurophysiologycal - 5
            array(
                'id'      => 53,
                'parent_id'      => 5,
                'name'    => 'EEG',
                'has_children' => 'false',
            ),
            array(
                'id'      => 54,
                'parent_id'      => 5,
                'name'    => 'TMS',
                'has_children' => 'false',
            ),
            array(
                'id'      => 55,
                'parent_id'      => 5,
                'name'    => 'tDCS',
                'has_children' => 'false',
            ),
            array(
                'id'      => 56,
                'parent_id'      => 5,
                'name'    => 'tACS',
                'has_children' => 'false',
            ),
            array(
                'id'      => 57,
                'parent_id'      => 5,
                'name'    => 'Other',
                'has_children' => 'false',
            )
        );
        DB::table('list_outcome_measures')->insert( $methods );

        
        
		
	}

}