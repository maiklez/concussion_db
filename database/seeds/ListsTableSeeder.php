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
                'name'    => 'Original Research',
                'has_children' => 'false',
            ),
            array(
                'id'      => 2,
                'parent_id'      => null,
                'name'    => 'Commentary on original research',
                'has_children' => 'false',
            ),
            array(
                'id'      => 3,
                'parent_id'      => null,
                'name'    => 'Consensus statement',
                'has_children' => 'false',
            ),
            array(
                'id'      => 4,
                'parent_id'      => null,
                'name'    => 'Opinion article',
                'has_children' => 'false',
            ),
            array(
                'id'      => 5,
                'parent_id'      => null,
                'name'    => 'Review',
                'has_children' => 'false',
            ),
            array(
                'id'      => 6,
                'parent_id'      => null,
                'name'    => 'Meta-analysis',
                'has_children' => 'false',
            ),
            array(
                'id'      => 7,
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
                'name'    => 'classification a',
                'has_children' => '1',
            ),
            array(
                'id'      => 2,
                'parent_id'      => null,
                'name'    => 'classification b',
                'has_children' => '1',
            ),
            array(
                'id'      => 3,
                'parent_id'      => null,
                'name'    => 'classification c',
                'has_children' => '1',
            ),
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
                'name'    => 'Military',
                'has_children' => 'false',
            ),
            array(
                'id'      => 15,
                'parent_id' => 2,
                'name'    => 'Other',
                'has_children' => 'false',
            ),

            array(
                'id'      => 16,
                'parent_id' => 3,
                'name'    => 'Any',
                'has_children' => 'false',
            ),
            array(
                'id'      => 17,
                'parent_id' => 3,
                'name'    => 'Cross-sectional',
                'has_children' => 'false',
            ),
            array(
                'id'      => 18,
                'parent_id' => 3,
                'name'    => 'Longitudinal study',
                'has_children' => 'false',
            ),
            array(
                'id'      => 19,
                'parent_id' => 3,
                'name'    => 'Case-control',
                'has_children' => 'false',
            ),
            array(
                'id'      => 20,
                'parent_id' => 3,
                'name'    => 'Meta-Analysis',
                'has_children' => 'false',
            ),
            array(
                'id'      => 21,
                'parent_id' => 3,
                'name'    => 'Review',
                'has_children' => 'false',
            ),
            array(
                'id'      => 22,
                'parent_id' => 3,
                'name'    => 'Consensus Document',
                'has_children' => 'false',
            ),
            array(
                'id'      => 23,
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
                'name'    => 'Sport related',
                'has_children' => '1',
            ),
            array(
                'id'      => 2,
                'parent_id'      => null,
                'name'    => 'Non Sport related',
                'has_children' => '1',
            ),
            array(
                'id'      => 3,
                'parent_id'      => 2,
                'name'    => 'Military',
                'has_children' => 'false',
            ),
            array(
                'id'      => 4,
                'parent_id'      => 2,
                'name'    => 'Trauma Patients (etc)',
                'has_children' => 'false',
            ),

             array(
                'id'      => 5,
                'parent_id' => 1,
                'name'    => 'Athlete - Professional',
                'has_children' => '1',
            ),
              array(
                'id'      => 6,
                'parent_id' => 1,
                'name'    => 'Athlete - Amateur',
                'has_children' => 'false',
            ),
               array(
                'id'      => 7,
                'parent_id' => 1,
                'name'    => 'Athlete - Unspecified',
                'has_children' => 'false',
            ),
            array(
                'id'      => 8,
                'parent_id' => 5,
                'name'    => 'American Football',
                'has_children' => 'false',
            ),
            array(
                'id'      => 9,
                'parent_id' => 5,
                'name'    => 'Rugby',
                'has_children' => 'false',
            ),
            array(
                'id'      => 10,
                'parent_id' => 5,
                'name'    => 'Soccer',
                'has_children' => 'false',
            ),
            array(
                'id'      => 11,
                'parent_id' => 5,
                'name'    => 'Ice Hockey',
                'has_children' => 'false',
            ),
            array(
                'id'      => 12,
                'parent_id' => 5,
                'name'    => 'Other',
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
                'parent_id'      => 1,
                'name'    => 'Child',
                'has_children' => 'false',
            ),
            array(
                'id'      => 4,
                'parent_id' => 1,
                'name'    => 'Youth',
                'has_children' => 'false',
            ),
            array(
                'id'      => 5,
                'parent_id' => 1,
                'name'    => 'Adult',
                'has_children' => 'false',
            ),
            array(
                'id'      => 6,
                'parent_id' => 1,
                'name'    => 'Ederly',
                'has_children' => 'false',
            ),
            array(
                'id'      => 7,
                'parent_id' => 2,
                'name'    => 'Rodent',
                'has_children' => 'false',
            ),
            array(
                'id'      => 8,
                'parent_id' => 2,
                'name'    => 'Primate',
                'has_children' => 'false',
            ),array(
                'id'      => 9,
                'parent_id'      => null,
                'name'    => 'Any',
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
                'name'    => 'Long-term implications',
                'has_children' => 'false',
            ),
            array(
                'id'      => 2,
                'parent_id'      => null,
                'name'    => 'Prevention',
                'has_children' => 'false',
            ),
            array(
                'id'      => 3,
                'parent_id'      => null,
                'name'    => 'Diagnosis',
                'has_children' => 'false',
            ),
            array(
                'id'      => 4,
                'parent_id'      => null,
                'name'    => 'Prognosis',
                'has_children' => 'false',
            ),
            array(
                'id'      => 5,
                'parent_id'      => null,
                'name'    => 'Treatment',
                'has_children' => 'false',
            ),
            array(
                'id'      => 6,
                'parent_id'      => null,
                'name'    => 'Guidelines development (eg. RTP protocols)',
                'has_children' => '1',
            ),
            array(
                'id'      => 7,
                'parent_id'      => 6,
                'name'    => 'Consensus-based',
                'has_children' => 'false',
            ),
            array(
                'id'      => 8,
                'parent_id'      => 6,
                'name'    => 'Evidence-based',
                'has_children' => 'false',
            ),
            array(
                'id'      => 9,
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
                'name'    => 'Clinical',
                'has_children' => '1',
            ),
            array(
                'id'      => 2,
                'parent_id'      => null,
                'name'    => 'Fluid Based',
                'has_children' => '1',
            ),
            array(
                'id'      => 3,
                'parent_id'      => null,
                'name'    => 'Imaging based',
                'has_children' => '1',
            ),
            array(
                'id'      => 4,
                'parent_id'      => null,
                'name'    => 'Electrophysiological',
                'has_children' => '1',
            ),
            array(
                'id'      => 5,
                'parent_id'      => 1,
                'name'    => 'Neurosycological',
                'has_children' => '1',

            ),
            array(
                'id'      => 6,
                'parent_id'      => 1,
                'name'    => 'Symptoms',
                'has_children' => '1',

            ),
            array(
                'id'      => 7,
                'parent_id'      => 2,
                'name'    => 'Serum/Plasma/Urine',
                'has_children' => '1',

            ),
            array(
                'id'      => 8,
                'parent_id'      => 3,
                'name'    => 'MRI',
                'has_children' => '1',

            ),
            array(
                'id'      => 9,
                'parent_id'      => 3,
                'name'    => 'MRS',
                'has_children' => 'false',

            ),
            array(
                'id'      => 10,
                'parent_id'      => 3,
                'name'    => 'PET',
                'has_children' => 'false',

            ),
            array(
                'id'      => 11,
                'parent_id'      => 3,
                'name'    => 'CT',
                'has_children' => 'false',

            ),
            array(
                'id'      => 12,
                'parent_id'      => 4,
                'name'    => 'EEG',
                'has_children' => 'false',

            ),
             array(
                'id'      => 13,
                'parent_id'      => 4,
                'name'    => 'NIBS',
                'has_children' => '1',

            ),


            array(
                'id'      => 14,
                'parent_id'      => 5,
                'name'    => 'Standardized Assessment of Concussion',
                'has_children' => 'false',
            ),
            array(
                'id'      => 15,
                'parent_id'      => 5,
                'name'    => 'SCAT2',
                'has_children' => 'false',
            ),
            array(
                'id'      => 16,
                'parent_id'      => 5,
                'name'    => 'Other',
                'has_children' => 'false',
            ),
            array(
                'id'      => 17,
                'parent_id'      => 7,
                'name'    => 'S-100B (glial)',
                'has_children' => 'false',
            ),
            array(
                'id'      => 18,
                'parent_id'      => 7,
                'name'    => 'T-Tau',
                'has_children' => 'false',
            )

        );
        DB::table('list_outcome_measures')->insert( $methods );

        
        
		
	}

}