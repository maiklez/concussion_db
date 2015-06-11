<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('import_csv', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->string('file_name');
			
			$table->integer('n_articles_read')->nullable();
			$table->integer('n_authors_read')->nullable();
			$table->integer('n_coauthors_read')->nullable();			

			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('import_log', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('csv_id')->unsigned();
			$table->foreign('csv_id')->references('id')->on('import_csv');
			
			$table->string('action');

			$table->string('article_title');
			$table->string('cell_type')->nullable();
			$table->string('cell_value')->nullable();
			$table->text('text_error');

			$table->timestamps();
		});


	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('import_log');
		Schema::drop('import_csv');
	}

}
