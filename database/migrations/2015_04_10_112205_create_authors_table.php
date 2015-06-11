<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('authors', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique();
			$table->string('email')->nullable();


			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('affiliations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('author_id')->unsigned();
			$table->foreign('author_id')->references('id')->on('authors');

			$table->string('affiliation');			
			$table->string('affiliation_population')->nullable();
			$table->string('affiliation_country')->nullable();

			$table->timestamps();
			$table->softDeletes();
		});

		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//

		Schema::drop('affiliations');		
		Schema::drop('authors');		

	}

}
