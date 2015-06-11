<?php

use App\Models\Author\Author;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AuthorsTableSeeder extends Seeder {

        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
        	$author = new Author;
            $author->id = 1;
            $author->name = 'Pashtun Shahim';
            $author->affiliations = 'Clinical Neurochemistry Laboratory, Institute of Neuroscience and Physiology, Sahlgrenska Academy at University of Gothenburg, Sahlgrenska University Hospital, Mölndal, Sweden';
            $author->affiliation_country = 'Sweden';

            $author->save();

            $author = new Author();
            $author->id = 2;
            $author->name = 'Yelverton Tegner';
            $author->affiliations = 'Division of Medical Sciences, Department of Health Sciences, Luleå University of Technology, Luleå, Sweden';
            $author->affiliation_country = 'Sweden';

            $author->save();

            $author = new Author();
            $author->id = 3;
            $author->name = 'David H Wilson';
            $author->affiliations = 'Clinical Neurochemistry Laboratory, Institute of Neuroscience and Physiology, Sahlgrenska Academy at University of Gothenburg, Sahlgrenska University Hospital, Mölndal, Sweden';
            $author->affiliation_country = 'Sweden';

            $author->save();
        }

}